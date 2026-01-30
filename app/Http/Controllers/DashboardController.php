<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\SchoolClass;
use App\Models\Rfq;
use App\Models\PurchaseRecord;


class DashboardController extends Controller
{
    public function admin()
    {
        return view('admin.dashboard');
    }

    public function student_record()
    {
        $class_arr = SchoolClass::latest()->get();
        return view('admin.student-record',compact('class_arr'));
    }

    public function save_class(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'class_name'           => 'required',
                'academic_session'     => 'required',
                'board'                => 'required',
                'medium'               => 'required',
                'sections'             => 'required|numeric',
                'total_students'       => 'required|numeric',
                'boys'                 => 'nullable|numeric',
                'girls'                => 'nullable|numeric',
                'expected_admissions'  => 'nullable|numeric',
                'subjects'             => 'nullable|string',
                'publisher'            => 'nullable|string',
                'syllabus'             => 'nullable|string',
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

            $class = SchoolClass::create($validator->validated());

            return response()->json([
                'status' => true,
                'class'  => $class
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
                'class_name'           => 'required',
                'academic_session'     => 'required',
                'board'                => 'required',
                'medium'               => 'required',
                'sections'             => 'required|numeric',
                'total_students'       => 'required|numeric',
                'boys'                 => 'nullable|numeric',
                'girls'                => 'nullable|numeric',
                'expected_admissions'  => 'nullable|numeric',
                'subjects'             => 'nullable|string',
                'publisher'            => 'nullable|string',
                'syllabus'             => 'nullable|string',
            ]);

            SchoolClass::where('id',$request->id)->update($data);

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


    public function distributor()
    {
        return view('distributor.dashboard');
    }

    public function retailer()
    {
        return view('retailer.dashboard');
    }

    public function publisher()
    {
        return view('publisher.dashboard');
    }

    public function profile()
    {
        $profile = User::find(auth()->id());
        return view('admin.profile',compact('profile'));
    }

    public function update_profile(Request $request)
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
                'website_link' => 'nullable',
                'established' => 'nullable',
                'board' => 'nullable',
                'about' => 'nullable',
                'profile' => 'nullable|image|max:2048',
            ]);

            if ($request->hasFile('profile')) {
                $data['profile'] = $request->file('profile')->store('profiles','public');
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
        return view('admin.rfq-inbox', compact('activeRfqs', 'historyRfqs'));
    }

    public function store_rfq(Request $request)
    {
        try {

            $books = json_decode($request->books, true);
            $request->merge(['books' => $books,'evaluation_criteria' => $request->evaluation]);
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
                'confirm_rfq' => 'required|accepted'
            ]);

            

            Rfq::create([
                'user_id' => auth()->id(),
                'school_name' => $request->school_name,
                'city' => $request->city,
                'academic_session' => $request->academic_session,
                'books' => json_encode($books),
                'delivery_from' => $request->delivery_from,
                'delivery_to' => $request->delivery_to,
                'urgency' => $request->urgency,
                'evaluation_criteria' => json_encode($request->evaluation_criteria),
                'rfq_closing_date' => $request->rfq_closing_date,
                'notes' => $request->notes,
                'confirmed' => true,
            ]);

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
                'invoice_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'return_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'document_name' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
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
                'invoice_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'return_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'document_name' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
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

}
