<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\department;
use App\Models\DepartmentSubject;
use App\Models\User;
use App\Models\SetClassStudent;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class StudentController extends Controller
{
   public function AllStudent()
    {
        $students = User::where('role', 'user')->get();
        return view('teacher.backend.student.manage_student', compact('students'));
    }

    public function SetClass($id) {
            $student = User::find($id);
            $subjects = DepartmentSubject::latest()->get();


            $setClass = SetClassStudent::where('user_id', $id)->latest()->first();
            $student->department_id = $setClass ? $setClass->department_id : null;

            return view('teacher.backend.student.set_class', compact('student', 'subjects'));

    } 

    public function StoreSetClass(Request $request)
{
    $setClass = SetClassStudent::where('user_id', $request->user_id)->latest()->first();

    if($setClass) {
        $setClass->subject_id = $request->subject_id;
        $setClass->save();
    } else {
        SetClassStudent::create([
            'user_id' => $request->user_id,
            'subject_id' => $request->subject_id,
        ]);

    }

    return redirect()->route('manage.student');
}
}
