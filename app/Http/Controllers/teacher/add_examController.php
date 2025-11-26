<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\AddExam;
use App\Models\department;
use App\Models\DepartmentSubject;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\NewQuestion;
use App\Models\User;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
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

    // ------------ teacher new question method start --------------

    public function AllTeacherNewQuestion() {
        $new = NewQuestion::with(['department', 'subject'])
                ->where('user_id', auth()->id())
                ->latest()
                ->get();
        return view('teacher.backend.new_question.index', compact('new'));
    }

    public function AddTeacherNewQuestion(){
        $depart = Department::all();
        $firstDepartId = Department::first()->id ?? null;
        $subjects = DepartmentSubject::where('department_id', $firstDepartId)->get();

        return view('teacher.backend.new_question.add', compact('depart', 'subjects'));
    }

    public function StoreTeacherNewQuestion(Request $request) {
         $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'subject_id' => 'required|exists:department_subjects,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        if ($request->file('image')) {
           $image = $request->file('image');
           $manager = new ImageManager(new Driver());
           $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
           $img = $manager->read($image);
           $img->resize(100,100)->save(public_path('upload/new_question/'.$name_gen));
           $save_url = 'upload/new_question/'.$name_gen;

           NewQuestion::create([
                'department_id' => $request->department_id,
                'subject_id' => $request->subject_id,
                'user_id' => auth()->id(),
                'question' => $request->question,
                'option1' => $request->option1,
                'option2' => $request->option2,
                'option3' => $request->option3,
                'option4' => $request->option4,
                'correct_answer' => $request->correct_answer,
                'image' => $save_url,
           ]);
           
              $notification = array(
                'message' => 'New Qestion Inserted Successfully',
                'alert-type' => 'success'
              );

                return redirect()->route('all.teacher.new.question')->with($notification);
        }else{
             NewQuestion::create([
                'department_id' => $request->department_id,
                'subject_id' => $request->subject_id,
                'user_id' => auth()->id(),
                'question' => $request->question,
                'option1' => $request->option1,
                'option2' => $request->option2,
                'option3' => $request->option3,
                'option4' => $request->option4,
                'correct_answer' => $request->correct_answer,
           ]);
           
              $notification = array(
                'message' => 'New Qestion Inserted Successfully',
                'alert-type' => 'success'
              );

                return redirect()->route('all.teacher.new.question')->with($notification);
        }
    }

    public function EditTeacherNewQuestion($id) {
        $editData = NewQuestion::findOrFail($id);
        $departments = Department::all();
        $subjects = DepartmentSubject::where('department_id', $editData->department_id)->get();

        return view('teacher.backend.new_question.edit', compact('editData', 'departments', 'subjects'));
    }

    public function UpdateTeacherNewQuestion(Request $request, $id)
{
    $validated = $request->validate([
        'department_id' => 'required|exists:departments,id',
        'subject_id' => 'required|exists:department_subjects,id',
        'question' => 'required|string',
        'option1' => 'required|string',
        'option2' => 'required|string',
        'option3' => 'required|string',
        'option4' => 'required|string',
        'correct_answer' => 'required|string',
    ]);

    $newQuestion = NewQuestion::findOrFail($id);

    if ($request->file('image')) {
        // حذف عکس قبلی
        if (file_exists(public_path($newQuestion->image))) {
            @unlink(public_path($newQuestion->image));
        }

        $image = $request->file('image');
        $manager = new ImageManager(new Driver());
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $img = $manager->read($image);
        $img->resize(100, 100)->save(public_path('upload/new_question/' . $name_gen));
        $save_url = 'upload/new_question/' . $name_gen;

        $newQuestion->update([
            'department_id' => $request->department_id,
            'subject_id' => $request->subject_id,
            'question' => $request->question,
            'option1' => $request->option1,
            'option2' => $request->option2,
            'option3' => $request->option3,
            'option4' => $request->option4,
            'correct_answer' => $request->correct_answer,
            'image' => $save_url,
        ]);
    } else {
        $newQuestion->update([
            'department_id' => $request->department_id,
            'subject_id' => $request->subject_id,
            'question' => $request->question,
            'option1' => $request->option1,
            'option2' => $request->option2,
            'option3' => $request->option3,
            'option4' => $request->option4,
            'correct_answer' => $request->correct_answer,
        ]);
    }

    $notification = array(
        'message' => 'New Question Updated Successfully',
        'alert-type' => 'success'
    );

    return redirect()->route('all.teacher.new.question')->with($notification);
}

public function DeleteTeacherNewQuestion($id) {
        $newQuestion = NewQuestion::findOrFail($id);
        if (file_exists(public_path($newQuestion->image))) {
            @unlink(public_path($newQuestion->image));
        }
        $newQuestion->delete();

        $notification = array(
            'message' => 'New Question Deleted Successfully',
            'alert-type' => 'success'
          );

            return redirect()->route('all.teacher.new.question')->with($notification);
    }

    // ----------------  All Set Exam ------------------

    public function AllTeacherSetExam() {
    $teacherId = auth()->id();

    $examQuestions = \App\Models\ExamQuestion::with(['exam'])
        ->whereHas('exam', function($query) use ($teacherId) {
            $query->where('teacher_id', $teacherId);
        })
        ->select('exam_id')
        ->groupBy('exam_id')
        ->get();

    return view('teacher.backend.set_exam.index', compact('examQuestions'));
}


    public function AddTeacherSetExam(){
        $depart = Department::all();
        $firstDepartId = Department::first()->id ?? null;
        $subjects = DepartmentSubject::where('department_id', $firstDepartId)->get();
        $exams = Exam::all();

        return view('teacher.backend.set_exam.add', compact('depart', 'firstDepartId', 'subjects', 'exams'));
    }

    public function getQuestions($subject_id)
{
    $questions = \App\Models\NewQuestion::where('subject_id', $subject_id)->get();

    $data = $questions->map(function ($q) {
        return [
            'id' => $q->id, // ✅ اضافه کن
            'question' => $q->question,
            'options' => [
                $q->option1,
                $q->option2,
                $q->option3,
                $q->option4,
            ],
            'correct_answer' => $q->correct_answer,
            'image' => $q->image ? asset($q->image) : null,
        ];
    });

    return response()->json($data);
}

    public function StoreTeacherSetExam(Request $request)
{
    $request->validate([
        'exam_id' => 'required',
    ]);

    if (!$request->has('question_ids') || count($request->question_ids) === 0) {
        return redirect()->back()->with('error', 'Please select at least one question.');
    }

    foreach ($request->question_ids as $question_id) {
        \App\Models\ExamQuestion::create([
            'exam_id' => $request->exam_id,
            'question_id' => $question_id,
        ]);
    }

    return redirect()->route('all.teacher.set.exam')->with('success', 'Exam questions saved successfully!');
}

    public function EditTeacherSetExam($exam_id)
{
    $exam = Exam::findOrFail($exam_id);

    $selectedQuestions = ExamQuestion::where('exam_id', $exam_id)->pluck('question_id')->toArray();

    $exams = Exam::all();

    $depart = Department::all();
    $firstDepartId = Department::first()->id ?? null;
    $subjects = DepartmentSubject::where('department_id', $firstDepartId)->get();

    return view('teacher.backend.set_exam.edit', compact(
        'exam',
        'exams',
        'selectedQuestions',
        'depart',
        'subjects'
    ));
}

    public function UpdateTeacherSetExam(Request $request, $exam_id)
{
    $request->validate([
        'exam_id' => 'required',
        'question_ids' => 'required|array|min:1',
    ]);

    ExamQuestion::where('exam_id', $exam_id)->delete();

    foreach ($request->question_ids as $question_id) {
        ExamQuestion::create([
            'exam_id' => $exam_id,
            'question_id' => $question_id,
        ]);
    }

    return redirect()->route('all.teacher.set.exam')->with('success', 'Exam updated successfully!');
}

public function DeleteTeacherSetExam($id){
    ExamQuestion::where('exam_id', $id)->delete();

    // $exam = Exam::findOrFail($id);
    // $exam->delete();

    return redirect()->route('all.teacher.set.exam')->with('success', 'Exam deleted successfully!');
}

}