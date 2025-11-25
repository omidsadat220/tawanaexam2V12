<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\department;
use App\Models\DepartmentSubject;
use App\Models\Exam;
use App\Models\TeacherExam;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ExamController extends Controller
{
    public function AllTeacherExam() {
         $teacherId = auth()->id();

    // Get all exams of the current teacher
    $exams = Exam::with(['department', 'subject'])
        ->where('teacher_id', $teacherId)
        ->get();

    // Get departments and subjects that have exams of the current teacher
    $departments = Department::with(['subjects.exams' => function($query) use ($teacherId) {
        $query->where('teacher_id', $teacherId);
    }])
    ->whereHas('subjects.exams', function ($query) use ($teacherId) {
        $query->where('teacher_id', $teacherId);
    })
    ->get();

        return view('teacher.backend.teacher_exam.all_teacher_exam', compact('departments', 'exams'));
    }

      public function AddTeacherExam()
    {
        $depart = Department::all();
        $firstDepartId = Department::first()->id ?? null;
        $subjects = DepartmentSubject::where('department_id', $firstDepartId)->get();

        return view('teacher.backend.teacher_exam.add_teacher_exam', compact('depart', 'subjects'));
    }

    public function StoreTeacherExam(Request $request)
    {

        $request->validate([
            'department_id' => 'required',
            'subject_id' => 'required',
            'exam_title' => 'required',
            'start_time' => 'required|integer',
        ]);


        Exam::create([
             'teacher_id'    => auth()->id(),
            'department_id' => $request->department_id,
            'subject_id' => $request->subject_id,
            'exam_title' => $request->exam_title,
            'start_time' => $request->start_time,
        ]);

        $notification = [
            'message' => 'Exam Created Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.teacher.exam')->with($notification);
    }

     public function EditTeacherExam($id)
    {
        $exam = Exam::with(['department', 'subject'])->findOrFail($id);

        $departments = Department::with(['subjects', 'subjects.exams'])->get();

        $subjects = $exam->department ? $exam->department->subjects : collect();

        return view('teacher.backend.teacher_exam.edit_teacher_exam', compact('exam', 'departments', 'subjects'));
    }

    public function UpdateTeacherExam(Request $request){
        $examId = $request->id;
        // Validate the request
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'subject_id' => [
                'required',
                Rule::exists('department_subjects', 'id')->where(function ($query) use ($request) {
                    $query->where('department_id', $request->department_id);
                }),
            ],
            'exam_title' => 'required|string|max:255',
            'start_time' => 'required|integer',
        ], [
            'subject_id.exists' => 'Selected subject does not belong to the chosen department.'
        ]);

        // Find the exam and make sure it belongs to the logged-in teacher
        $exam = Exam::where('id', $examId)
                    ->where('teacher_id', auth()->id())
                    ->firstOrFail();

        // Update the exam (teacher_id is NOT updated)
        $exam->update($request->only('department_id', 'subject_id', 'exam_title', 'start_time'));

        return redirect()->route('all.teacher.exam')->with([
            'message' => 'Exam updated successfully',
            'alert-type' => 'success'
        ]);
    }


    public function DeleteTeacherExam($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();

        return redirect()->route('all.teacher.exam')->with([
            'message' => 'Exam deleted successfully',
            'alert-type' => 'success'
        ]);
    }


}
