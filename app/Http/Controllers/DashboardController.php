<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\SchoolClass;


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
    
}
