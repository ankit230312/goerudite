<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Board;
use App\Models\AcademicSession;
use App\Models\Rfq;
use App\Models\RfqReceipt;
use App\Models\RfqResponse;
use App\Models\PurchaseRecord;
use App\Models\Catalogue;

class PublisherController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $sentRfqs = Rfq::where('user_id', $user->id)
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($rfq) {
                return [
                    'type' => 'sent',
                    'rfq' => $rfq,
                ];
            });

        $receivedRfqs = $this->rfqRecipientQuery($user)
            ->where('user_id', '!=', $user->id)
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($rfq) {
                return [
                    'type' => 'received',
                    'rfq' => $rfq,
                ];
            });

        $operationLogs = $sentRfqs
            ->concat($receivedRfqs)
            ->sortByDesc(function ($item) {
                return $item['rfq']->created_at;
            })
            ->take(10)
            ->values();

        $locationFilters = $this->getRfqLocationFilters();

        return view('publisher.dashboard', array_merge([
            'operationLogs' => $operationLogs,
        ], $locationFilters, $this->getMasterLists()));
    }

    public function profile()
    {
        $profile = User::find(auth()->id());
        return view('publisher.profile', array_merge(compact('profile'), $this->getMasterLists()));
    }

    public function update_profile(Request $request)
    {
        try {
            $data = $request->validate([
                'business_name' => 'required',
                'contact_person' => 'required|string|max:255',
                'publisher_type' => 'required|string|max:100',
                'email' => 'required|email',
                'mobile' => 'required',
                'address' => 'nullable',
                'state' => 'nullable',
                'city' => 'nullable',
                'website_link' => 'nullable',
                'established' => 'nullable',
                'board' => 'nullable',
                'about' => 'nullable',
                'gst' => 'nullable|string|max:50',
                'pan' => 'nullable|string|max:50',
                'pincode' => 'nullable|string|max:20',
                'document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'profile' => 'nullable|image|max:2048',
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

    public function rfq_inbox()
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

    public function receive_rfq($id)
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

    public function rfq_details($id)
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

    public function close_rfq($id)
    {
        $rfq = Rfq::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $rfq->update(['status' => 'closed']);

        return response()->json(['status' => true, 'message' => 'RFQ closed successfully']);
    }

    public function store_rfq_response(Request $request)
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

    public function update_rfq(Request $request, $id)
    {
        $rfq = Rfq::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $data = $request->validate([
            'school_name' => 'required',
            'state' => 'required',
            'city' => 'required',
            'academic_session' => 'required',
            'books' => 'required',
            'delivery_from' => 'required|date',
            'delivery_to' => 'required|date',
            'urgency' => 'required',
            'evaluation_criteria' => 'required|array',
            'rfq_closing_date' => 'required|date',
            'notes' => 'nullable',
        ]);

        $rfq->update($data);

        return response()->json(['status' => true, 'message' => 'RFQ updated successfully']);
    }

    public function manage_records()
    {
        $purchase_records = PurchaseRecord::where('user_id', auth()->id())->latest()->get();
        return view('publisher.manage-records', compact('purchase_records'));
    }

    public function save_purchase_record(Request $request)
    {
        return $this->savePurchaseRecord($request);
    }

    public function update_purchase_record(Request $request)
    {
        return $this->updatePurchaseRecord($request);
    }

    public function delete_purchase_record(Request $request)
    {
        return $this->deletePurchaseRecord($request);
    }

    public function download_invoice($id)
    {
        return $this->downloadInvoice($id);
    }

    private function getMasterLists(): array
    {
        $boards = Board::where('status', 'active')->orderBy('name')->get();
        $academicSessions = AcademicSession::where('status', 'active')->orderBy('name')->get();

        return compact('boards', 'academicSessions');
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

    private function savePurchaseRecord(Request $request)
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
                'invoice_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'return_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'document_name' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $data = $validator->validated();
            $data['user_id'] = auth()->id();

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

    private function updatePurchaseRecord(Request $request)
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
                'invoice_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'return_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'document_name' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $record = PurchaseRecord::where('id', $request->id)->where('user_id', auth()->id())->firstOrFail();

            $data = $validator->validated();
            unset($data['id']);

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

    private function deletePurchaseRecord(Request $request)
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

    private function downloadInvoice($id)
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
}
