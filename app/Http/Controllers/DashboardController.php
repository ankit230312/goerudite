<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\SchoolClass;
use App\Models\Board;
use App\Models\AcademicSession;
use App\Models\Rfq;
use App\Models\RfqReceipt;
use App\Models\PurchaseRecord;
use App\Models\Catalogue;
use App\Models\RfqResponse;
use App\Models\Medium;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{


    public function admin()
    {
        $user = auth()->user();
        $class_arr = SchoolClass::latest()->get();
        $profileTotalStudents = $user->total_students;
        $currentTotalStudents = $class_arr->sum('total_students');
        $remainingStudents = $profileTotalStudents !== null
            ? max(0, (int) $profileTotalStudents - (int) $currentTotalStudents)
            : null;

        $followersCount = RfqResponse::whereHas('rfq', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->distinct('responder_user_id')
            ->count('responder_user_id');

        $rfqCreatedCount = Rfq::where('user_id', $user->id)->count();

        $totalStudentsCount = $user->total_students ?? null;
        if ($totalStudentsCount === null) {
            $totalStudentsCount = (int) SchoolClass::sum('total_students');
        }

        $manageRecordsCount = PurchaseRecord::where('user_id', $user->id)->count();

        $pendingRfqCount = $this->rfqRecipientQuery($user)
            ->whereDoesntHave('receipts', function ($query) use ($user) {
                $query->where('user_id', $user->id)->whereNotNull('received_at');
            })
            ->count();

        $stats = [
            ['label' => 'Followers', 'icon' => 'fa-user', 'value' => $followersCount],
            ['label' => 'Add to Cart', 'icon' => 'fa-cart-plus', 'value' => $rfqCreatedCount],
            ['label' => 'Remaining Students', 'icon' => 'fa-graduation-cap', 'value' => $remainingStudents],
            ['label' => 'Manage Records', 'icon' => 'fa-clipboard-list', 'value' => $manageRecordsCount],
            ['label' => 'Notification RFQ', 'icon' => 'fa-bell', 'value' => $pendingRfqCount],
        ];

        // 1️⃣ RFQs created by user
        $rfqCreated = Rfq::where('user_id', $user->id)
            ->with('user')
            ->get()
            ->map(function ($rfq) {
                return [
                    'id' => $rfq->id,
                    'school_name' => $rfq->school_name,
                    'created_at' => $rfq->created_at,
                    'action' => 'created',
                    'name' => null,
                    'role' => null,
                ];
            });

        // 2️⃣ RFQs received by user
        $rfqReceived = RfqReceipt::where('user_id', $user->id)
            ->with('rfq')
            ->get()
            ->map(function ($receipt) {
                return [
                    'id' => $receipt->rfq->id,
                    'school_name' => $receipt->rfq->school_name,
                    'created_at' => $receipt->created_at,
                    'action' => 'received'
                ];
            });

        // 3️⃣ RFQs responded by user
        $rfqResponded = RfqResponse::where('responder_user_id', $user->id)
            ->with(['rfq', 'company'])
            ->get()
            ->map(function ($response) {
                return [
                    'id' => $response->rfq->id,
                    'school_name' => $response->rfq->school_name,
                    'company_name' => $response->company->name ?? null,
                    'created_at' => $response->created_at,
                    'action' => 'responded',
                    'name' => $response->company->business_name ?? null,
                    'role' => $response->company->role ?? null,
                ];
            });

        // 4️⃣ Merge, sort and take 10 logs
        $operationLogs = $rfqCreated
            ->merge($rfqReceived)
            ->merge($rfqResponded)
            ->sortByDesc('created_at')
            ->take(10)
            ->map(function ($item) {
                return (object) $item;  //  <- Convert to object
            })
            ->values();

        return view('admin.dashboard', compact('operationLogs', 'stats'));
    }



    public function boards()
    {
        $boards = Board::latest()->get();
        return view('admin.boards', compact('boards'));
    }

    public function academic_sessions()
    {
        $sessions = AcademicSession::latest()->get();
        return view('admin.academic-sessions', compact('sessions'));
    }

    public function student_record()
    {
        $user = auth()->user();
        $class_arr = SchoolClass::where('user_id', $user->id)
            ->latest()
            ->get();

        return view('admin.student-record', array_merge(
            compact('class_arr'),
            $this->getMasterLists()
        ));
    }

    public function save_class(Request $request)
    {
        $user = auth()->user();

        try {

            $validator = Validator::make($request->all(), [

                'class_name' => 'required',
                'academic_session' => 'required',
                'board' => 'required',
                'medium' => 'required',
                'sections' => 'required|numeric',
                'total_students' => 'required|numeric',
                'boys' => 'nullable|numeric',
                'girls' => 'nullable|numeric',
                'expected_admissions' => 'nullable|numeric',
                'subjects' => 'nullable|string',
                'publisher' => 'nullable|string',
                'syllabus' => 'nullable|string',
            ]);



            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            // Optional logical validation
            if (
                ($request->boys ?? 0) + ($request->girls ?? 0)
                > $request->total_students
            ) {
                return response()->json([
                    'status' => false,
                    'errors' => [
                        'total_students' => ['Total students must be greater than boys + girls']
                    ]
                ], 422);
            }

            $profileTotalStudents = auth()->user()->total_students;
            if ($profileTotalStudents !== null) {
                $currentTotalStudents = (int) SchoolClass::sum('total_students');
                $remainingStudents = (int) $profileTotalStudents - $currentTotalStudents;
                $remainingStudents = max(0, $remainingStudents);

                if ((int) $request->total_students > $remainingStudents) {
                    return response()->json([
                        'status' => false,
                        'errors' => [
                            'total_students' => ["Total students must be less than or equal to remaining students ($remainingStudents)"]
                        ]
                    ], 422);
                }
            }

            $data = $validator->validated();
            $data['user_id'] = $user->id;

            $class = SchoolClass::create($data);


            return response()->json([
                'status' => true,
                'class' => $class
            ]);

        } catch (ValidationException $e) {

            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function update_class(Request $request)
    {
        try {

            $data = $request->validate([
                'class_name' => 'required',
                'academic_session' => 'required',
                'board' => 'required',
                'medium' => 'required',
                'sections' => 'required|numeric',
                'total_students' => 'required|numeric',
                'boys' => 'nullable|numeric',
                'girls' => 'nullable|numeric',
                'expected_admissions' => 'nullable|numeric',
                'subjects' => 'nullable|string',
                'publisher' => 'nullable|string',
                'syllabus' => 'nullable|string',
            ]);

            $profileTotalStudents = auth()->user()->total_students;
            if ($profileTotalStudents !== null) {
                $currentTotalStudents = (int) SchoolClass::where('id', '!=', $request->id)->sum('total_students');
                $remainingStudents = (int) $profileTotalStudents - $currentTotalStudents;
                $remainingStudents = max(0, $remainingStudents);

                if ((int) $request->total_students > $remainingStudents) {
                    return response()->json([
                        'status' => false,
                        'errors' => [
                            'total_students' => ["Total students must be less than or equal to remaining students ($remainingStudents)"]
                        ]
                    ], 422);
                }
            }

            SchoolClass::where('id', $request->id)->update($data);

            return response()->json([
                'status' => true
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function delete_class(Request $request)
    {
        SchoolClass::where('id', $request->id)->delete();

        return response()->json([
            'status' => true
        ]);
    }

    public function save_board(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:boards,name',
                'status' => 'required|in:active,inactive',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $board = Board::create($validator->validated());

            return response()->json([
                'status' => true,
                'board' => $board,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update_board(Request $request)
    {
        try {
            $data = $request->validate([
                'id' => 'required|exists:boards,id',
                'name' => 'required|string|max:255|unique:boards,name,' . $request->id,
                'status' => 'required|in:active,inactive',
            ]);

            $board = Board::findOrFail($data['id']);
            $board->update([
                'name' => $data['name'],
                'status' => $data['status'],
            ]);

            return response()->json([
                'status' => true,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function delete_board(Request $request)
    {
        Board::where('id', $request->id)->delete();

        return response()->json([
            'status' => true,
        ]);
    }

    public function save_medium(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'board_id' => 'required|integer|exists:boards,id',
                'medium_name' => 'required|string|max:255',
                'status' => 'required|in:active,inactive',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $data = $validator->validated();
            $data['user_id'] = auth()->id(); // If needed

            $medium = Medium::create($data);

            return response()->json([
                'status' => true,
                'medium' => $medium,
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function update_medium(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|integer|exists:mediums,medium_id',
                'board_id' => 'required|integer|exists:boards,id',
                'medium_name' => 'required|string|max:255',
                'status' => 'required|in:active,inactive',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $data = $validator->validated();

            // Fetch via correct primary key
            $medium = Medium::where('medium_id', $data['id'])->first();

            if (!$medium) {
                return response()->json([
                    'status' => false,
                    'message' => 'Medium not found',
                ], 404);
            }

            // Update
            $medium->update([
                'board_id' => $data['board_id'],
                'medium_name' => $data['medium_name'],
                'status' => $data['status'],
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Medium updated successfully',
                'medium' => $medium,
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function delete_medium(Request $request)
    {
        Medium::where('medium_id', $request->id)->delete();

        return response()->json([
            'status' => true,
        ]);
    }

    public function getMediums($board_id)
    {
        $mediums = Medium::where('board_id', $board_id)
            ->where('status', 'active')
            ->get(['medium_id', 'medium_name']);

        return response()->json($mediums);
    }

    public function save_academic_session(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:academic_sessions,name',
                'status' => 'required|in:active,inactive',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $session = AcademicSession::create($validator->validated());

            return response()->json([
                'status' => true,
                'session' => $session,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update_academic_session(Request $request)
    {
        try {
            $data = $request->validate([
                'id' => 'required|exists:academic_sessions,id',
                'name' => 'required|string|max:255|unique:academic_sessions,name,' . $request->id,
                'status' => 'required|in:active,inactive',
            ]);

            $session = AcademicSession::findOrFail($data['id']);
            $session->update([
                'name' => $data['name'],
                'status' => $data['status'],
            ]);

            return response()->json([
                'status' => true,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function delete_academic_session(Request $request)
    {
        AcademicSession::where('id', $request->id)->delete();

        return response()->json([
            'status' => true,
        ]);
    }


    public function distributor()
    {
        $user = auth()->user();
        $acknowledgedRfqIds = $this->acknowledgedRfqIds($user);

        $followersCount = $this->rfqRecipientQuery($user)
            ->distinct('user_id')
            ->count('user_id');

        $catalogueCount = Catalogue::where('user_id', $user->id)->count();

        $activeRequestCount = Rfq::where('user_id', $user->id)
            ->where('status', 'active')
            ->count();

        $manageRecordsCount = PurchaseRecord::where('user_id', $user->id)->count();

        $pendingRfqCount = $this->rfqRecipientQuery($user)
            ->whereDoesntHave('receipts', function ($query) use ($user) {
                $query->where('user_id', $user->id)->whereNotNull('received_at');
            })
            ->count();

        $stats = [
            ['label' => 'Followers', 'icon' => 'fa-user', 'value' => $followersCount],
            ['label' => 'Add to Cart', 'icon' => 'fa-cart-plus', 'value' => $catalogueCount],
            ['label' => 'Active Request', 'icon' => 'fa-graduation-cap', 'value' => $activeRequestCount],
            ['label' => 'Manage Records', 'icon' => 'fa-clipboard-list', 'value' => $manageRecordsCount],
            ['label' => 'Notification RFQ', 'icon' => 'fa-bell', 'value' => $pendingRfqCount],
        ];

        $operationLogsQuery = $this->rfqRecipientQuery($user)
            ->where('user_id', '!=', $user->id)
            ->latest();
        $operationLogs = $operationLogsQuery->take(10)->get();

        return view('distributor.dashboard', compact('operationLogs', 'acknowledgedRfqIds', 'stats'));
    }

    public function retailer()
    {
        $user = auth()->user();
        $acknowledgedRfqIds = $this->acknowledgedRfqIds($user);

        $followersCount = $this->rfqRecipientQuery($user)
            ->distinct('user_id')
            ->count('user_id');

        $catalogueCount = Catalogue::where('user_id', $user->id)->count();

        $activeRequestCount = Rfq::where('user_id', $user->id)
            ->where('status', 'active')
            ->count();

        $manageRecordsCount = PurchaseRecord::where('user_id', $user->id)->count();

        $pendingRfqCount = $this->rfqRecipientQuery($user)
            ->whereDoesntHave('receipts', function ($query) use ($user) {
                $query->where('user_id', $user->id)->whereNotNull('received_at');
            })
            ->count();

        $stats = [
            ['label' => 'Followers', 'icon' => 'fa-user', 'value' => $followersCount],
            ['label' => 'Add to Cart', 'icon' => 'fa-cart-plus', 'value' => $catalogueCount],
            ['label' => 'Active Request', 'icon' => 'fa-graduation-cap', 'value' => $activeRequestCount],
            ['label' => 'Manage Records', 'icon' => 'fa-clipboard-list', 'value' => $manageRecordsCount],
            ['label' => 'Notification RFQ', 'icon' => 'fa-bell', 'value' => $pendingRfqCount],
        ];

        $operationLogsQuery = $this->rfqRecipientQuery($user)
            ->where('user_id', '!=', $user->id)
            ->latest();
        $operationLogs = $operationLogsQuery->take(10)->get();

        return view('retailer.dashboard', compact('operationLogs', 'acknowledgedRfqIds', 'stats'));
    }

    public function publisher()
    {
        $user = auth()->user();
        $acknowledgedRfqIds = $this->acknowledgedRfqIds($user);

        $followersCount = $this->rfqRecipientQuery($user)
            ->distinct('user_id')
            ->count('user_id');

        $catalogueCount = Catalogue::where('user_id', $user->id)->count();

        $activeRequestCount = Rfq::where('user_id', $user->id)
            ->where('status', 'active')
            ->count();

        $manageRecordsCount = PurchaseRecord::where('user_id', $user->id)->count();

        $pendingRfqCount = $this->rfqRecipientQuery($user)
            ->whereDoesntHave('receipts', function ($query) use ($user) {
                $query->where('user_id', $user->id)->whereNotNull('received_at');
            })
            ->count();

        $stats = [
            ['label' => 'Followers', 'icon' => 'fa-user', 'value' => $followersCount],
            ['label' => 'Add to Cart', 'icon' => 'fa-cart-plus', 'value' => $catalogueCount],
            ['label' => 'Active Request', 'icon' => 'fa-graduation-cap', 'value' => $activeRequestCount],
            ['label' => 'Manage Records', 'icon' => 'fa-clipboard-list', 'value' => $manageRecordsCount],
            ['label' => 'Notification RFQ', 'icon' => 'fa-bell', 'value' => $pendingRfqCount],
        ];

        $operationLogsQuery = $this->rfqRecipientQuery($user)
            ->where('user_id', '!=', $user->id)
            ->latest();
        $operationLogs = $operationLogsQuery->take(10)->get();

        return view('publisher.dashboard', compact('operationLogs', 'acknowledgedRfqIds', 'stats'));
    }

    public function profile()
    {
        #dd("rgjkerl");
        $profile = User::find(auth()->id());
        return view('admin.profile', array_merge(compact('profile'), $this->getMasterLists()));
    }

    public function update_profile(Request $request)
    {

        try {

            $data = $request->validate([
                'business_name' => 'required',
                'school_type' => 'required|string|max:255',
                // 'business_category' => 'required|string|max:100',
                'email' => 'required|email',
                'mobile' => 'required',
                'address' => 'nullable',
                'state' => 'nullable',
                'city' => 'nullable',
                'gst' => 'nullable|string|max:50',
                'pan' => 'nullable|string|max:50',
                'pincode' => 'nullable|string|max:20',
                'document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'profile' => 'nullable|image|max:2048',
                'total_students' => 'nullable|numeric',
                'website_link' => 'nullable|string|max:255',
                'established' => 'nullable',
                'board' => 'nullable|string|max:100',
                'about' => 'nullable|string',
            ]);

            if ($request->hasFile('document')) {
                $data['document'] = $request->file('document')->store('documents', 'public');
            }

            if ($request->hasFile('profile')) {
                $data['profile'] = $request->file('profile')->store('profiles', 'public');
            }

            User::updateOrCreate(
                ['id' => auth()->id()],
                $data
            );

            return response()->json(['status' => true]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function distributor_profile()
    {
        #dd("rgjkerl");
        $profile = User::find(auth()->id());
        return view('distributor.profile', array_merge(compact('profile'), $this->getMasterLists()));
    }

    public function mediums()
    {
        $user = auth()->user();
        $boards = Board::where('status', 'active')->latest()->get();

        // Load mediums with board name

        $mediums = Medium::with('board')->where('user_id', $user->id)->latest()->get();

        return view('admin.medium', compact('boards', 'mediums'));
    }

    public function distributor_update_profile(Request $request)
    {
        try {

            $data = $request->validate([
                'contact_person' => 'required|string|max:255',
                'business_name' => 'required|string|max:255',
                'business_category' => 'required|string|max:100',
                'email' => 'required|email',
                'mobile' => 'required|string|max:20',
                'address' => 'nullable|string',
                'gst' => 'nullable|string|max:50',
                'pan' => 'nullable|string|max:50',
                'pincode' => 'nullable|string|max:20',
                'state' => 'nullable|string|max:100',
                'city' => 'nullable|string|max:100',
                'website_link' => 'nullable|string|max:255',
                'board' => 'nullable|string|max:100',
                'about' => 'nullable|string',
                'profile' => 'nullable|image|max:2048',
                'document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);



            if ($request->hasFile('profile')) {
                $data['profile'] = $request->file('profile')->store('profiles', 'public');
            }
            if ($request->hasFile('document')) {
                $data['document'] = $request->file('document')->store('documents', 'public');
            }

            User::updateOrCreate(
                ['id' => auth()->id()],
                $data
            );

            return response()->json(['status' => true]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function retailer_profile()
    {
        $profile = User::find(auth()->id());
        return view('retailer.profile', array_merge(compact('profile'), $this->getMasterLists()));
    }

    public function retailer_update_profile(Request $request)
    {
        try {

            $data = $request->validate([
                'business_name' => 'required',
                'school_type' => 'nullable',
                'email' => 'required|email',
                'mobile' => 'required',
                'address' => 'nullable',
                'total_students' => 'nullable|numeric',
                'state' => 'nullable',
                'city' => 'nullable',
                'website_link' => 'nullable',
                'established' => 'nullable',
                'board' => 'nullable',
                'about' => 'nullable',
                'profile' => 'nullable|image|max:2048',
            ]);

            if ($request->hasFile('profile')) {
                $data['profile'] = $request->file('profile')->store('profiles', 'public');
            }

            User::updateOrCreate(
                ['id' => auth()->id()],
                $data
            );

            return response()->json(['status' => true]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function publisher_profile()
    {
        $profile = User::find(auth()->id());
        return view('publisher.profile', array_merge(compact('profile'), $this->getMasterLists()));
    }

    public function publisher_update_profile(Request $request)
    {
        try {

            $data = $request->validate([
                'business_name' => 'required',
                'school_type' => 'nullable',
                'email' => 'required|email',
                'mobile' => 'required',
                'address' => 'nullable',
                'total_students' => 'nullable|numeric',
                'state' => 'nullable',
                'city' => 'nullable',
                'website_link' => 'nullable',
                'established' => 'nullable',
                'board' => 'nullable',
                'about' => 'nullable',
                'profile' => 'nullable|image|max:2048',
            ]);

            if ($request->hasFile('profile')) {
                $data['profile'] = $request->file('profile')->store('profiles', 'public');
            }

            User::updateOrCreate(
                ['id' => auth()->id()],
                $data
            );

            return response()->json(['status' => true]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function rfq_inbox()
    {
        $activeRfqs = Rfq::where('status', 'active')->where('user_id', auth()->id())->get();
        $historyRfqs = Rfq::where('status', 'closed')->where('user_id', auth()->id())->get();
        $locationFilters = $this->getRfqLocationFilters();

        return view('admin.rfq-inbox', array_merge([
            'activeRfqs' => $activeRfqs,
            'historyRfqs' => $historyRfqs,
        ], $locationFilters, $this->getMasterLists()));
    }

    public function store_rfq(Request $request)
    {


        try {
            $this->saveRfq($request);

            return response()->json(['status' => true, 'message' => 'RFQ created successfully']);
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update_rfq(Request $request, $id)
    {
        $rfq = Rfq::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $request->validate([
            'school_name' => 'required',
            'city' => 'required',
            'academic_session' => 'required',
            'books' => 'required|array',
            'delivery_from' => 'required|date',
            'delivery_to' => 'required|date',
            'urgency' => 'required',
            'evaluation_criteria' => 'required|array',
            'rfq_closing_date' => 'required|date',
            'notes' => 'nullable',
        ]);

        $rfq->update($request->all());

        return response()->json(['status' => true, 'message' => 'RFQ updated successfully']);
    }

    public function close_rfq($id)
    {
        $rfq = Rfq::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $rfq->update(['status' => 'closed']);

        return response()->json(['status' => true, 'message' => 'RFQ closed successfully']);
    }

    public function rfq_details($id)
    {
        $rfq = Rfq::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        return response()->json(['success' => true, 'rfq' => $rfq]);
    }

    public function rfq_responses($id)
    {
        $rfq = Rfq::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $responses = RfqResponse::query()
            ->leftJoin('users', 'users.id', '=', 'rfq_responses.responder_company_id')
            ->where('rfq_responses.rfq_id', $rfq->id)
            ->orderByDesc('rfq_responses.submitted_at')
            ->get([
                'rfq_responses.id',
                'rfq_responses.rfq_id',
                'rfq_responses.responder_user_id',
                'rfq_responses.responder_role',
                'rfq_responses.indicative_unit_price',
                'rfq_responses.total_indicative_value',
                'rfq_responses.available_quantity',
                'rfq_responses.delivery_from',
                'rfq_responses.delivery_to',
                'rfq_responses.stock_status',
                'rfq_responses.additional_notes',
                'rfq_responses.status',
                'rfq_responses.submitted_at',
                'rfq_responses.created_at',
                'rfq_responses.updated_at',
                'users.business_name',
                'users.city',
                'users.state',
            ]);

        return response()->json([
            'success' => true,
            'responses' => $responses,
        ]);
    }

    public function send_rfq(Request $request, $id)
    {
        $rfq = Rfq::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $data = $request->validate([
            'target_roles' => 'required|array|min:1',
            'target_roles.*' => 'in:distributor,retailer,publisher',
            'target_state' => 'nullable|string|max:100',
            'target_city' => 'nullable|string|max:100',
        ]);

        $rfq->update([
            'target_roles' => array_values($data['target_roles']),
            'target_state' => $data['target_state'] ?? null,
            'target_city' => $data['target_city'] ?? null,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'RFQ sent successfully',
        ]);
    }

    public function distributor_rfq_inbox()
    {
        $user = auth()->user();
        $acknowledgedRfqIds = $this->acknowledgedRfqIds($user);

        $activeRfqs = Rfq::where('status', 'active')->where('user_id', $user->id)->get();
        $historyRfqs = Rfq::where('status', 'closed')->where('user_id', $user->id)->get();
        $receivedRfqsQuery = $this->rfqRecipientQuery($user)
            ->where('user_id', '!=', $user->id)
            ->where('status', 'active')
            ->latest();
        $receivedRfqs = $receivedRfqsQuery->get();
        $locationFilters = $this->getRfqLocationFilters();

        return view('distributor.rfq-inbox', array_merge([
            'activeRfqs' => $activeRfqs,
            'historyRfqs' => $historyRfqs,
            'receivedRfqs' => $receivedRfqs,
            'acknowledgedRfqIds' => $acknowledgedRfqIds,
        ], $locationFilters, $this->getMasterLists()));
    }

    public function distributor_receive_rfq($id)
    {
        $user = auth()->user();

        $rfq = $this->rfqRecipientQuery($user)
            ->where('id', $id)
            ->where('user_id', '!=', $user->id)
            ->firstOrFail();

        RfqReceipt::updateOrCreate(
            [
                'rfq_id' => $rfq->id,
                'user_id' => $user->id,
            ],
            [
                'received_at' => now(),
            ]
        );

        return response()->json([
            'status' => true,
            'message' => 'RFQ marked as received',
        ]);
    }

    public function distributor_store_rfq(Request $request)
    {
        try {
            $this->saveRfq($request);

            return response()->json(['status' => true, 'message' => 'RFQ created successfully']);
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function distributor_rfq_details($id)
    {
        $user = auth()->user();

        $rfq = Rfq::where('id', $id)
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhere(function ($recipientQuery) use ($user) {
                        $this->rfqRecipientQuery($user, $recipientQuery);
                    });
            })
            ->firstOrFail();



        $sender = User::select('id', 'role', 'business_name', 'city', 'state')
            ->where('id', $rfq->user_id)
            ->first();

        $response = RfqResponse::where('rfq_id', $rfq->id)
            ->where('responder_company_id', $user->id)
            ->orderByDesc('submitted_at')
            ->first();

        return response()->json([
            'success' => true,
            'rfq' => $rfq,
            'sender' => $sender,
            'response' => $response,
        ]);
    }

    public function distributor_send_rfq(Request $request, $id)
    {
        $rfq = Rfq::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $data = $request->validate([
            'target_roles' => 'required|array|min:1',
            'target_roles.*' => 'in:distributor,retailer,publisher',
            'target_state' => 'nullable|string|max:100',
            'target_city' => 'nullable|string|max:100',
        ]);

        $rfq->update([
            'target_roles' => array_values($data['target_roles']),
            'target_state' => $data['target_state'] ?? null,
            'target_city' => $data['target_city'] ?? null,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'RFQ sent successfully',
        ]);
    }

    public function distributor_close_rfq($id)
    {
        $rfq = Rfq::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $rfq->update(['status' => 'closed']);

        return response()->json(['status' => true, 'message' => 'RFQ closed successfully']);
    }

    public function distributor_store_rfq_response(Request $request)
    {
        $user = auth()->user();



        $rfq = Rfq::where('id', $request->rfq_id)
            ->where('user_id', '!=', $user->id)
            ->where(function ($query) use ($user) {
                $this->rfqRecipientQuery($user, $query);
            })
            ->firstOrFail();

        $data = $request->validate([
            'rfq_id' => 'required|integer',
            'indicative_unit_price' => 'nullable|numeric|min:0',
            'total_indicative_value' => 'nullable|numeric|min:0',
            'available_quantity' => 'required|integer|min:1',
            'delivery_from' => 'required|date',
            'delivery_to' => 'required|date|after_or_equal:delivery_from',
            'stock_status' => 'nullable|in:in_stock,partially_available,to_be_arranged',
            'additional_notes' => 'nullable|string',
            'confirm_indicative' => 'required|accepted',
        ]);

        $responseData = [
            'rfq_id' => $rfq->id,
            'responder_user_id' => $rfq->user_id,
            'responder_company_id' => $user->id,
            'responder_role' => $user->role,
            'indicative_unit_price' => $data['indicative_unit_price'] ?? null,
            'total_indicative_value' => $data['total_indicative_value'] ?? null,
            'available_quantity' => $data['available_quantity'],
            'delivery_from' => $data['delivery_from'],
            'delivery_to' => $data['delivery_to'],
            'stock_status' => $data['stock_status'] ?? null,
            'additional_notes' => $data['additional_notes'] ?? null,
            'status' => 'RESPONSE_SUBMITTED',
            'submitted_at' => now(),
        ];

        RfqResponse::updateOrCreate(
            [
                'rfq_id' => $rfq->id,
                'responder_company_id' => $user->id,
            ],
            $responseData
        );

        RfqReceipt::updateOrCreate(
            [
                'rfq_id' => $rfq->id,
                'user_id' => $user->id,
            ],
            [
                'received_at' => now(),
            ]
        );

        return response()->json([
            'status' => true,
            'message' => 'RFQ response submitted successfully',
        ]);
    }

    public function publisher_rfq_inbox()
    {
        $user = auth()->user();
        $acknowledgedRfqIds = $this->acknowledgedRfqIds($user);

        $activeRfqs = Rfq::where('status', 'active')->where('user_id', $user->id)->get();
        $historyRfqs = Rfq::where('status', 'closed')->where('user_id', $user->id)->get();
        $receivedRfqsQuery = $this->rfqRecipientQuery($user)
            ->where('user_id', '!=', $user->id)
            ->where('status', 'active')
            ->latest();
        $receivedRfqs = $receivedRfqsQuery->get();
        $locationFilters = $this->getRfqLocationFilters();

        return view('publisher.rfq-inbox', array_merge([
            'activeRfqs' => $activeRfqs,
            'historyRfqs' => $historyRfqs,
            'receivedRfqs' => $receivedRfqs,
            'acknowledgedRfqIds' => $acknowledgedRfqIds,
        ], $locationFilters, $this->getMasterLists()));
    }

    public function publisher_receive_rfq($id)
    {
        $user = auth()->user();

        $rfq = $this->rfqRecipientQuery($user)
            ->where('id', $id)
            ->where('user_id', '!=', $user->id)
            ->firstOrFail();

        RfqReceipt::updateOrCreate(
            [
                'rfq_id' => $rfq->id,
                'user_id' => $user->id,
            ],
            [
                'received_at' => now(),
            ]
        );

        return response()->json([
            'status' => true,
            'message' => 'RFQ marked as received',
        ]);
    }

    public function publisher_store_rfq(Request $request)
    {
        try {
            $this->saveRfq($request);

            return response()->json(['status' => true, 'message' => 'RFQ created successfully']);
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function publisher_send_rfq(Request $request, $id)
    {
        $rfq = Rfq::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $data = $request->validate([
            'target_roles' => 'required|array|min:1',
            'target_roles.*' => 'in:distributor,retailer,publisher',
            'target_state' => 'nullable|string|max:100',
            'target_city' => 'nullable|string|max:100',
        ]);

        $rfq->update([
            'target_roles' => array_values($data['target_roles']),
            'target_state' => $data['target_state'] ?? null,
            'target_city' => $data['target_city'] ?? null,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'RFQ sent successfully',
        ]);
    }

    public function publisher_rfq_details($id)
    {
        $user = auth()->user();

        $rfq = Rfq::where('id', $id)
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhere(function ($recipientQuery) use ($user) {
                        $this->rfqRecipientQuery($user, $recipientQuery);
                    });
            })
            ->firstOrFail();

        $sender = User::select('id', 'role', 'business_name', 'city', 'state')
            ->where('id', $rfq->user_id)
            ->first();

        $response = RfqResponse::where('rfq_id', $rfq->id)
            ->where('responder_company_id', $user->id)
            ->orderByDesc('submitted_at')
            ->first();

        return response()->json([
            'success' => true,
            'rfq' => $rfq,
            'sender' => $sender,
            'response' => $response,
        ]);
    }

    public function publisher_close_rfq($id)
    {
        $rfq = Rfq::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $rfq->update(['status' => 'closed']);

        return response()->json(['status' => true, 'message' => 'RFQ closed successfully']);
    }

    public function publisher_store_rfq_response(Request $request)
    {
        $user = auth()->user();

        $rfq = Rfq::where('id', $request->rfq_id)
            ->where('user_id', '!=', $user->id)
            ->where(function ($query) use ($user) {
                $this->rfqRecipientQuery($user, $query);
            })
            ->firstOrFail();

        $data = $request->validate([
            'rfq_id' => 'required|integer',
            'indicative_unit_price' => 'nullable|numeric|min:0',
            'total_indicative_value' => 'nullable|numeric|min:0',
            'available_quantity' => 'required|integer|min:1',
            'delivery_from' => 'required|date',
            'delivery_to' => 'required|date|after_or_equal:delivery_from',
            'stock_status' => 'nullable|in:in_stock,partially_available,to_be_arranged',
            'additional_notes' => 'nullable|string',
            'confirm_indicative' => 'required|accepted',
        ]);

        $responseData = [
            'rfq_id' => $rfq->id,
            'responder_user_id' => $rfq->user_id,
            'responder_company_id' => $user->id,
            'responder_role' => $user->role,
            'indicative_unit_price' => $data['indicative_unit_price'] ?? null,
            'total_indicative_value' => $data['total_indicative_value'] ?? null,
            'available_quantity' => $data['available_quantity'],
            'delivery_from' => $data['delivery_from'],
            'delivery_to' => $data['delivery_to'],
            'stock_status' => $data['stock_status'] ?? null,
            'additional_notes' => $data['additional_notes'] ?? null,
            'status' => 'RESPONSE_SUBMITTED',
            'submitted_at' => now(),
        ];

        RfqResponse::updateOrCreate(
            [
                'rfq_id' => $rfq->id,
                'responder_company_id' => $user->id,
            ],
            $responseData
        );

        RfqReceipt::updateOrCreate(
            [
                'rfq_id' => $rfq->id,
                'user_id' => $user->id,
            ],
            [
                'received_at' => now(),
            ]
        );

        return response()->json([
            'status' => true,
            'message' => 'RFQ response submitted successfully',
        ]);
    }

    public function publisher_update_rfq(Request $request, $id)
    {
        return $this->update_rfq($request, $id);
    }

    public function publisher_manage_records()
    {
        $purchase_records = PurchaseRecord::where('user_id', auth()->id())->latest()->get();
        return view('publisher.manage-records', compact('purchase_records'));
    }

    public function publisher_save_purchase_record(Request $request)
    {
        return $this->distributor_save_purchase_record($request);
    }

    public function publisher_update_purchase_record(Request $request)
    {
        return $this->distributor_update_purchase_record($request);
    }

    public function publisher_delete_purchase_record(Request $request)
    {
        return $this->distributor_delete_purchase_record($request);
    }

    public function publisher_download_invoice($id)
    {
        return $this->distributor_download_invoice($id);
    }

    public function retailer_rfq_inbox()
    {
        $user = auth()->user();
        $acknowledgedRfqIds = $this->acknowledgedRfqIds($user);

        $activeRfqs = Rfq::where('status', 'active')->where('user_id', $user->id)->get();
        $historyRfqs = Rfq::where('status', 'closed')->where('user_id', $user->id)->get();
        $receivedRfqsQuery = $this->rfqRecipientQuery($user)
            ->where('user_id', '!=', $user->id)
            ->where('status', 'active')
            ->latest();
        $receivedRfqs = $receivedRfqsQuery->get();
        $locationFilters = $this->getRfqLocationFilters();

        return view('retailer.rfq-inbox', array_merge([
            'activeRfqs' => $activeRfqs,
            'historyRfqs' => $historyRfqs,
            'receivedRfqs' => $receivedRfqs,
            'acknowledgedRfqIds' => $acknowledgedRfqIds,
        ], $locationFilters, $this->getMasterLists()));
    }

    public function retailer_receive_rfq($id)
    {
        $user = auth()->user();

        $rfq = $this->rfqRecipientQuery($user)
            ->where('id', $id)
            ->where('user_id', '!=', $user->id)
            ->firstOrFail();

        RfqReceipt::updateOrCreate(
            [
                'rfq_id' => $rfq->id,
                'user_id' => $user->id,
            ],
            [
                'received_at' => now(),
            ]
        );

        return response()->json([
            'status' => true,
            'message' => 'RFQ marked as received',
        ]);
    }

    public function retailer_store_rfq(Request $request)
    {
        try {
            $this->saveRfq($request);
            return response()->json(['status' => true, 'message' => 'RFQ created successfully']);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function retailer_send_rfq(Request $request, $id)
    {
        $rfq = Rfq::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $data = $request->validate([
            'target_roles' => 'required|array|min:1',
            'target_roles.*' => 'in:distributor,retailer,publisher',
            'target_state' => 'nullable|string|max:100',
            'target_city' => 'nullable|string|max:100',
        ]);

        $rfq->update([
            'target_roles' => array_values($data['target_roles']),
            'target_state' => $data['target_state'] ?? null,
            'target_city' => $data['target_city'] ?? null,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'RFQ sent successfully',
        ]);
    }

    public function retailer_rfq_details($id)
    {
        $user = auth()->user();

        $rfq = Rfq::where('id', $id)
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhere(function ($recipientQuery) use ($user) {
                        $this->rfqRecipientQuery($user, $recipientQuery);
                    });
            })
            ->firstOrFail();

        $sender = User::select('id', 'role', 'business_name', 'city', 'state')
            ->where('id', $rfq->user_id)
            ->first();

        $response = RfqResponse::where('rfq_id', $rfq->id)
            ->where('responder_company_id', $user->id)
            ->orderByDesc('submitted_at')
            ->first();

        return response()->json([
            'success' => true,
            'rfq' => $rfq,
            'sender' => $sender,
            'response' => $response,
        ]);
    }

    public function retailer_close_rfq($id)
    {
        $rfq = Rfq::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $rfq->update(['status' => 'closed']);

        return response()->json(['status' => true, 'message' => 'RFQ closed successfully']);
    }

    public function retailer_store_rfq_response(Request $request)
    {
        $user = auth()->user();

        $rfq = Rfq::where('id', $request->rfq_id)
            ->where('user_id', '!=', $user->id)
            ->where(function ($query) use ($user) {
                $this->rfqRecipientQuery($user, $query);
            })
            ->firstOrFail();

        $data = $request->validate([
            'rfq_id' => 'required|integer',
            'indicative_unit_price' => 'nullable|numeric|min:0',
            'total_indicative_value' => 'nullable|numeric|min:0',
            'available_quantity' => 'required|integer|min:1',
            'delivery_from' => 'required|date',
            'delivery_to' => 'required|date|after_or_equal:delivery_from',
            'stock_status' => 'nullable|in:in_stock,partially_available,to_be_arranged',
            'additional_notes' => 'nullable|string',
            'confirm_indicative' => 'required|accepted',
        ]);

        $responseData = [
            'rfq_id' => $rfq->id,
            'responder_user_id' => $rfq->user_id,
            'responder_company_id' => $user->id,
            'responder_role' => $user->role,
            'indicative_unit_price' => $data['indicative_unit_price'] ?? null,
            'total_indicative_value' => $data['total_indicative_value'] ?? null,
            'available_quantity' => $data['available_quantity'],
            'delivery_from' => $data['delivery_from'],
            'delivery_to' => $data['delivery_to'],
            'stock_status' => $data['stock_status'] ?? null,
            'additional_notes' => $data['additional_notes'] ?? null,
            'status' => 'RESPONSE_SUBMITTED',
            'submitted_at' => now(),
        ];

        RfqResponse::updateOrCreate(
            [
                'rfq_id' => $rfq->id,
                'responder_company_id' => $user->id,
            ],
            $responseData
        );

        RfqReceipt::updateOrCreate(
            [
                'rfq_id' => $rfq->id,
                'user_id' => $user->id,
            ],
            [
                'received_at' => now(),
            ]
        );

        return response()->json([
            'status' => true,
            'message' => 'RFQ response submitted successfully',
        ]);
    }

    private function getRfqLocationFilters(): array
    {
        return [
            'states' => User::whereNotNull('state')
                ->where('state', '!=', '')
                ->distinct()
                ->orderBy('state')
                ->pluck('state'),
            'cities' => User::whereNotNull('city')
                ->where('city', '!=', '')
                ->distinct()
                ->orderBy('city')
                ->pluck('city'),
        ];
    }

    private function saveRfq(Request $request): void
    {
        $books = json_decode($request->books, true);
        $request->merge([
            'books' => $books,
            'evaluation_criteria' => $request->evaluation,
        ]);

        $data = $request->validate([
            'school_name' => 'required',
            'state' => 'required',
            'city' => 'required',
            'target_roles' => 'nullable|array',
            'target_roles.*' => 'in:distributor,retailer,publisher',
            'target_state' => 'nullable|string|max:100',
            'target_city' => 'nullable|string|max:100',
            'academic_session' => 'required',
            'books' => 'required|array',
            'delivery_from' => 'required|date',
            'delivery_to' => 'required|date',
            'urgency' => 'required',
            'evaluation_criteria' => 'required|array',
            'rfq_closing_date' => 'required|date',
            'notes' => 'nullable',
            'confirm_rfq' => 'required|accepted'
        ]);

        Rfq::create([
            'user_id' => auth()->id(),
            'school_name' => $data['school_name'],
            'state' => $data['state'],
            'city' => $data['city'],
            'target_roles' => !empty($data['target_roles']) ? array_values($data['target_roles']) : null,
            'target_state' => $data['target_state'] ?? null,
            'target_city' => $data['target_city'] ?? null,
            'academic_session' => $data['academic_session'],
            'books' => $books,
            'delivery_from' => $data['delivery_from'],
            'delivery_to' => $data['delivery_to'],
            'urgency' => $data['urgency'],
            'evaluation_criteria' => $data['evaluation_criteria'],
            'rfq_closing_date' => $data['rfq_closing_date'],
            'notes' => $data['notes'] ?? null,
            'confirmed' => true,
        ]);
    }

    private function rfqRecipientQuery(User $user, $query = null)
    {
        $query = $query ?: Rfq::query();

        return $query
            ->whereJsonContains('target_roles', $user->role)
            ->where(function ($stateQuery) use ($user) {
                $stateQuery->whereNull('target_state')
                    ->orWhere('target_state', '')
                    ->orWhere('target_state', $user->state);
            })
            ->where(function ($cityQuery) use ($user) {
                $cityQuery->whereNull('target_city')
                    ->orWhere('target_city', '')
                    ->orWhere('target_city', $user->city);
            });
    }

    private function acknowledgedRfqIds(User $user): array
    {
        return RfqReceipt::where('user_id', $user->id)
            ->whereNotNull('received_at')
            ->pluck('rfq_id')
            ->toArray();
    }

    public function manage_records()
    {
        $purchase_records = PurchaseRecord::where('user_id', auth()->id())->latest()->get();
        return view('admin.manage-records', compact('purchase_records'));
    }

    public function save_purchase_record(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'record_name' => 'required|string|max:255',
                'invoice_no' => 'nullable|string|max:255',
                'purchase_date' => 'required|date',
                'item_name' => 'required|string|max:255',
                'gst_details' => 'nullable|string|max:255',
                'delivery_status' => 'required|in:delivered,pending,cancelled',
                'payment_status' => 'required|in:paid,pending,partial',
                'supplier' => 'required|string|max:255',
                'quantity' => 'required|integer|min:1',
                'amount' => 'required|numeric|min:0',
                'invoice_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:12048',
                'return_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:12048',
                'document_name' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:12048',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $data = $validator->validated();
            $data['user_id'] = auth()->id();

            // Handle file uploads
            if ($request->hasFile('invoice_file')) {
                $data['invoice_file'] = $request->file('invoice_file')->store('purchase_records', 'public');
            }
            if ($request->hasFile('return_file')) {
                $data['return_file'] = $request->file('return_file')->store('purchase_records', 'public');
            }
            if ($request->hasFile('document_name')) {
                $data['document_name'] = $request->file('document_name')->store('purchase_records', 'public');
            }

            PurchaseRecord::create($data);

            return response()->json([
                'status' => true,
                'message' => 'Purchase record saved successfully'
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update_purchase_record(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:purchase_records,id',
                'record_name' => 'required|string|max:255',
                'invoice_no' => 'nullable|string|max:255',
                'purchase_date' => 'required|date',
                'item_name' => 'required|string|max:255',
                'gst_details' => 'nullable|string|max:255',
                'delivery_status' => 'required|in:delivered,pending,cancelled',
                'payment_status' => 'required|in:paid,pending,partial',
                'supplier' => 'required|string|max:255',
                'quantity' => 'required|integer|min:1',
                'amount' => 'required|numeric|min:0',
                'invoice_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:12048',
                'return_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:12048',
                'document_name' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:12048',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $record = PurchaseRecord::where('id', $request->id)->where('user_id', auth()->id())->firstOrFail();

            $data = $validator->validated();
            unset($data['id']); // Remove id from data array

            // Handle file uploads (only if new files are provided)
            if ($request->hasFile('invoice_file')) {
                $data['invoice_file'] = $request->file('invoice_file')->store('purchase_records', 'public');
            }
            if ($request->hasFile('return_file')) {
                $data['return_file'] = $request->file('return_file')->store('purchase_records', 'public');
            }
            if ($request->hasFile('document_name')) {
                $data['document_name'] = $request->file('document_name')->store('purchase_records', 'public');
            }

            $record->update($data);

            return response()->json([
                'status' => true,
                'message' => 'Purchase record updated successfully'
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function delete_purchase_record(Request $request)
    {
        try {
            $record = PurchaseRecord::where('id', $request->id)->where('user_id', auth()->id())->firstOrFail();
            $record->delete();

            return response()->json([
                'status' => true,
                'message' => 'Purchase record deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function download_invoice($id)
    {
        try {
            $record = PurchaseRecord::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

            if (!$record->invoice_file) {
                return response()->json(['status' => false, 'message' => 'No invoice file found'], 404);
            }

            $filePath = storage_path('app/public/' . $record->invoice_file);

            if (!file_exists($filePath)) {
                return response()->json(['status' => false, 'message' => 'File not found'], 404);
            }

            return response()->download($filePath, basename($record->invoice_file));

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function distributor_manage_records()
    {
        $purchase_records = PurchaseRecord::where('user_id', auth()->id())->latest()->get();
        return view('distributor.manage-records', compact('purchase_records'));
    }

    public function distributor_save_purchase_record(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'record_name' => 'required|string|max:255',
                'invoice_no' => 'nullable|string|max:255',
                'purchase_date' => 'required|date',
                'item_name' => 'required|string|max:255',
                'gst_details' => 'nullable|string|max:255',
                'delivery_status' => 'required|in:delivered,pending,cancelled',
                'payment_status' => 'required|in:paid,pending,partial',
                'supplier' => 'required|string|max:255',
                'quantity' => 'required|integer|min:1',
                'amount' => 'required|numeric|min:0',
                'invoice_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:12048',
                'return_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:12048',
                'document_name' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:12048',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $data = $validator->validated();
            $data['user_id'] = auth()->id();

            // Handle file uploads
            if ($request->hasFile('invoice_file')) {
                $data['invoice_file'] = $request->file('invoice_file')->store('purchase_records', 'public');
            }
            if ($request->hasFile('return_file')) {
                $data['return_file'] = $request->file('return_file')->store('purchase_records', 'public');
            }
            if ($request->hasFile('document_name')) {
                $data['document_name'] = $request->file('document_name')->store('purchase_records', 'public');
            }

            PurchaseRecord::create($data);

            return response()->json([
                'status' => true,
                'message' => 'Purchase record saved successfully'
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function distributor_update_purchase_record(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:purchase_records,id',
                'record_name' => 'required|string|max:255',
                'invoice_no' => 'nullable|string|max:255',
                'purchase_date' => 'required|date',
                'item_name' => 'required|string|max:255',
                'gst_details' => 'nullable|string|max:255',
                'delivery_status' => 'required|in:delivered,pending,cancelled',
                'payment_status' => 'required|in:paid,pending,partial',
                'supplier' => 'required|string|max:255',
                'quantity' => 'required|integer|min:1',
                'amount' => 'required|numeric|min:0',
                'invoice_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:12048',
                'return_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:12048',
                'document_name' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:12048',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $record = PurchaseRecord::where('id', $request->id)->where('user_id', auth()->id())->firstOrFail();

            $data = $validator->validated();
            unset($data['id']); // Remove id from data array

            // Handle file uploads (only if new files are provided)
            if ($request->hasFile('invoice_file')) {
                $data['invoice_file'] = $request->file('invoice_file')->store('purchase_records', 'public');
            }
            if ($request->hasFile('return_file')) {
                $data['return_file'] = $request->file('return_file')->store('purchase_records', 'public');
            }
            if ($request->hasFile('document_name')) {
                $data['document_name'] = $request->file('document_name')->store('purchase_records', 'public');
            }

            $record->update($data);

            return response()->json([
                'status' => true,
                'message' => 'Purchase record updated successfully'
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function distributor_delete_purchase_record(Request $request)
    {
        try {
            $record = PurchaseRecord::where('id', $request->id)->where('user_id', auth()->id())->firstOrFail();
            $record->delete();

            return response()->json([
                'status' => true,
                'message' => 'Purchase record deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function distributor_download_invoice($id)
    {
        try {
            $record = PurchaseRecord::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

            if (!$record->invoice_file) {
                return response()->json(['status' => false, 'message' => 'No invoice file found'], 404);
            }

            $filePath = storage_path('app/public/' . $record->invoice_file);

            if (!file_exists($filePath)) {
                return response()->json(['status' => false, 'message' => 'File not found'], 404);
            }

            return response()->download($filePath, basename($record->invoice_file));

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function manage_cateloge()
    {
        $catalogues = Catalogue::where('user_id', auth()->id())->latest()->get();
        return view('distributor.manage-cateloge', array_merge(compact('catalogues'), $this->getMasterLists()));
    }

    public function save_catalogue(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'catalogue_title' => 'required|string|max:255',
                'publisher_brand_name' => 'nullable|string|max:255',
                'academic_session' => 'required|string|max:50',
                'applicable_board' => 'required|string|max:100',
                'medium' => 'required|string|max:100',
                'print_length' => 'nullable|integer|min:1',
                'published_on' => 'nullable|date',
                'isbn_13' => 'nullable|string|max:100',
                'isbn_10' => 'nullable|string|max:100',
                'reading_age' => 'nullable|string|max:100',
                'dimensions' => 'nullable|string|max:255',
                'volume_part_numbers' => 'nullable|string|max:255',
                'mrp' => 'required|numeric|min:0',
                'category' => 'nullable|string|max:100',
                'cover_upload' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'sample_upload' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'description' => 'nullable|string',
                'confirm_catalogue' => 'required|accepted',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $data = $validator->validated();
            $data['user_id'] = auth()->id();
            $data['confirmed'] = true;

            if ($request->hasFile('cover_upload')) {
                $data['cover_file'] = $request->file('cover_upload')->store('catalogues', 'public');
            }

            if ($request->hasFile('sample_upload')) {
                $data['sample_file'] = $request->file('sample_upload')->store('catalogues', 'public');
            }

            unset($data['cover_upload'], $data['sample_upload'], $data['confirm_catalogue']);

            Catalogue::create($data);

            return response()->json([
                'status' => true,
                'message' => 'Catalogue saved successfully'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function delete_catalogue(Request $request)
    {
        try {
            $catalogue = Catalogue::where('id', $request->id)->where('user_id', auth()->id())->firstOrFail();
            $catalogue->delete();

            return response()->json([
                'status' => true,
                'message' => 'Catalogue deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update_catalogue(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'catalogue_id' => 'required|exists:catalogues,id',
                'catalogue_title' => 'required|string|max:255',
                'publisher_brand_name' => 'nullable|string|max:255',
                'academic_session' => 'required|string|max:50',
                'applicable_board' => 'required|string|max:100',
                'medium' => 'required|string|max:100',
                'print_length' => 'nullable|integer|min:1',
                'published_on' => 'nullable|date',
                'isbn_13' => 'nullable|string|max:100',
                'isbn_10' => 'nullable|string|max:100',
                'reading_age' => 'nullable|string|max:100',
                'dimensions' => 'nullable|string|max:255',
                'volume_part_numbers' => 'nullable|string|max:255',
                'mrp' => 'required|numeric|min:0',
                'category' => 'nullable|string|max:100',
                'cover_upload' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'sample_upload' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'description' => 'nullable|string',
                'confirm_catalogue' => 'required|accepted',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $catalogue = Catalogue::where('id', $request->catalogue_id)
                ->where('user_id', auth()->id())
                ->firstOrFail();

            $data = $validator->validated();
            $data['confirmed'] = true;

            if ($request->hasFile('cover_upload')) {
                $data['cover_file'] = $request->file('cover_upload')->store('catalogues', 'public');
            }

            if ($request->hasFile('sample_upload')) {
                $data['sample_file'] = $request->file('sample_upload')->store('catalogues', 'public');
            }

            unset($data['catalogue_id'], $data['cover_upload'], $data['sample_upload'], $data['confirm_catalogue']);

            $catalogue->update($data);

            return response()->json([
                'status' => true,
                'message' => 'Catalogue updated successfully'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function getMasterLists(): array
    {
        $boards = Board::where('status', 'active')->orderBy('name')->get();
        $academicSessions = AcademicSession::where('status', 'active')->orderBy('name')->get();

        return compact('boards', 'academicSessions');
    }

    public function distributor_boards()
    {
        $boards = Board::latest()->get();
        return view('distributor.boards', compact('boards'));

    }
    public function distributor_save_board(Request $request)
    {


        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:boards,name',
                'status' => 'required|in:active,inactive',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }


            $board = Board::create($validator->validated());

            return response()->json([
                'status' => true,
                'board' => $board,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function distributor_update_board(Request $request)
    {
        try {
            $data = $request->validate([
                'id' => 'required|exists:boards,id',
                'name' => 'required|string|max:255|unique:boards,name,' . $request->id,
                'status' => 'required|in:active,inactive',
            ]);

            $board = Board::findOrFail($data['id']);
            $board->update([
                'name' => $data['name'],
                'status' => $data['status'],
            ]);

            return response()->json([
                'status' => true,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function distributor_delete_board(Request $request)
    {
        Board::where('id', $request->id)->delete();

        return response()->json([
            'status' => true,
        ]);
    }

    public function distributor_academic_sessions()
    {
        $sessions = AcademicSession::latest()->get();
        return view('admin.academic-sessions', compact('sessions'));
    }

    public function distributor_save_academic_session(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:academic_sessions,name',
                'status' => 'required|in:active,inactive',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $session = AcademicSession::create($validator->validated());

            return response()->json([
                'status' => true,
                'session' => $session,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function distributor_update_academic_session(Request $request)
    {
        try {
            $data = $request->validate([
                'id' => 'required|exists:academic_sessions,id',
                'name' => 'required|string|max:255|unique:academic_sessions,name,' . $request->id,
                'status' => 'required|in:active,inactive',
            ]);

            $session = AcademicSession::findOrFail($data['id']);
            $session->update([
                'name' => $data['name'],
                'status' => $data['status'],
            ]);

            return response()->json([
                'status' => true,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function distributor_delete_academic_session(Request $request)
    {
        AcademicSession::where('id', $request->id)->delete();

        return response()->json([
            'status' => true,
        ]);
    }

    public function distributor_save_medium(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'board_id' => 'required|integer|exists:boards,id',
                'medium_name' => 'required|string|max:255',
                'status' => 'required|in:active,inactive',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $data = $validator->validated();
            $data['user_id'] = auth()->id(); // If needed

            $medium = Medium::create($data);

            return response()->json([
                'status' => true,
                'medium' => $medium,
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function distributor_update_medium(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|integer|exists:mediums,medium_id',
                'board_id' => 'required|integer|exists:boards,id',
                'medium_name' => 'required|string|max:255',
                'status' => 'required|in:active,inactive',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $data = $validator->validated();

            // Fetch via correct primary key
            $medium = Medium::where('medium_id', $data['id'])->first();

            if (!$medium) {
                return response()->json([
                    'status' => false,
                    'message' => 'Medium not found',
                ], 404);
            }

            // Update
            $medium->update([
                'board_id' => $data['board_id'],
                'medium_name' => $data['medium_name'],
                'status' => $data['status'],
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Medium updated successfully',
                'medium' => $medium,
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function distributor_delete_medium(Request $request)
    {
        Medium::where('medium_id', $request->id)->delete();

        return response()->json([
            'status' => true,
        ]);
    }
    public function distributor_mediums()
    {
        $boards = Board::where('status', 'active')->latest()->get();

        // Load mediums with board name
        $mediums = Medium::with('board')->latest()->get();

        return view('admin.medium', compact('boards', 'mediums'));
    }

}
