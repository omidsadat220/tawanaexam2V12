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
    $teacher_id = auth()->id(); // استاد فعلی
    $students = User::where('role', 'user')
        ->whereHas('selectedTeacher', function ($query) use ($teacher_id) {
            $query->where('teacher_id', $teacher_id);
        })
        ->get();

    return view('teacher.backend.student.manage_student', compact('students'));
}

public function SetClass($id)
{
    $student = User::findOrFail($id);
    $subjects = DepartmentSubject::latest()->get();
    $departments = Department::all();

    $setClass = SetClassStudent::where('user_id', $id)->latest()->first();

    if ($setClass) {
        $student->department_id = $setClass->department_id;
        $student->subject_id = $setClass->subject_id;
    }

    return view('teacher.backend.student.set_class', compact('student', 'subjects', 'departments'));
}


public function StoreSetClass(Request $request)
{
    $request->validate([
        'user_id' => 'required|integer',
        'department_id' => 'required|integer',
        'subject_id' => 'required|integer',
    ]);

    $setClass = SetClassStudent::firstOrNew(['user_id' => $request->user_id]);

    $setClass->department_id = $request->department_id;
    $setClass->subject_id = $request->subject_id;
    $setClass->save();

    return redirect()->route('manage.student')->with('success', 'Class set successfully.');
}



}
