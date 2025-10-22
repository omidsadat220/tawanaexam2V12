<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\AddExam;
use App\Models\department;
use App\Models\DepartmentSubject;
use App\Models\User;
use Illuminate\Http\Request;

class add_examController extends Controller
{
    public function AllAddExam() {
        $alldata = AddExam::with('user', 'department', 'subject')->get();

        return view('teacher.backend.add_exam.all_exam_view', compact('alldata'));
    }

    //end method 

    public function AddExam() {
        $alldata = AddExam::all();
        $depart = department::all();
        $users = User::where('role', 'user')->get();
        $firstDepartId = Department::first()->id ?? null;
        $subjects = DepartmentSubject::where('department_id', $firstDepartId)->get();

        return view('teacher.backend.add_exam.add_exam_view', compact('alldata' , 'depart', 'subjects' , 'users'));
    }

    // end method

    public function StoreAddExam(Request $request) {

        $validatedData = $request->validate([
            'user_id' => 'required',
            'department_id' => 'required',
            'subject_id' => 'required',
            'exam_time' => 'required|date_format:H:i',
        ]);

        $addexam = new AddExam();
        $addexam->user_id = $request->user_id;
        $addexam->department_id = $request->department_id;
        $addexam->subject_id = $request->subject_id;
        $addexam->exam_time = $request->exam_time;
        $addexam->save();


        $notification = [
            'message' => 'Exam Created Successfully',
            'alert-type' => 'success'
        ];


        return redirect()->route('all.add.exam')->with($notification);
        // return redirect()->back()->with($notification);

    }

    // end method

    public function EditAddExam($id) {

        $addexam = AddExam::with([ 'user' , 'department', 'subject'])->findOrFail($id);

        $editdata = AddExam::find($id);
        $depart = department::all();
        $users = User::where('role', 'user')->get();
        $firstDepartId = Department::first()->id ?? null;
        $subjects = DepartmentSubject::where('department_id', $firstDepartId)->get();

        return view('teacher.backend.add_exam.edit_add_exam', compact('editdata', 'depart', 'subjects' , 'users' , 'addexam'));
    }

    public function UpdateAddExam(Request $request) {

        $addexam = AddExam::find($request->id);
        $addexam->user_id = $request->user_id;
        $addexam->department_id = $request->department_id;
        $addexam->subject_id = $request->subject_id;
        $addexam->exam_time = $request->exam_time;
        $addexam->save();

        $notification = [
            'message' => 'Exam Updated Successfully',
            'alert-type' => 'info'
        ];

        return redirect()->route('all.add.exam')->with($notification);
    }

    public function DeleteAddExam($id) {
        $addexam = AddExam::find($id);
        $addexam->delete();

        $notification = [
            'message' => 'Exam Deleted Successfully',
            'alert-type' => 'info'
        ];

        return redirect()->route('all.add.exam')->with($notification);
    }
}
