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
        $departments = department::with(['subjects', 'subjects.exams'])->get();
        $exams = Exam::with(['department', 'subject'])->get();

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

        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'subject_id' => 'required|exists:department_subjects,id',
            'exam_title' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i'
        ]);


        Exam::create([
            'department_id' => $request->department_id,
            'subject_id' => $request->subject_id,
            'exam_title' => $request->exam_title,
            'start_time' => $request->start_time
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

    public function UpdateTeacherExam(Request $request)
    {

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
            // 'start_time' => 'required|date_format:H:i',
        ], [
            'subject_id.exists' => 'Selected subject does not belong to the chosen department.'
        ]);

        // Find the exam
        $exam = Exam::findOrFail($examId);

        // Update the exam
        $exam->update($request->only('department_id', 'subject_id', 'exam_title', 'start_time'));

        // Redirect back with success message
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
