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
            'books' => $request->books,
            'delivery_from' => $request->delivery_from,
            'delivery_to' => $request->delivery_to,
            'urgency' => $request->urgency,
            'evaluation_criteria' => $request->evaluation_criteria,
            'rfq_closing_date' => $request->rfq_closing_date,
            'notes' => $request->notes,
            'confirmed' => true,
        ]);

        return response()->json(['status' => true, 'message' => 'RFQ created successfully']);
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

}
