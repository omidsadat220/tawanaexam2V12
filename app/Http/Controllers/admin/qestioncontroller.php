<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\department;
use App\Models\DepartmentSubject;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\NewQuestion;
use App\Models\qestion;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Container\Attributes\Auth;

class qestioncontroller extends Controller
{
    public function AllQestion() {
        $alldata = qestion::with(['exam'])->get();
        return view('admin.backend.qestion.all_qestion', compact('alldata' , ));
    }

    //end method 

    public function AddQestion()
{
    $questions = qestion::with('exam')->latest()->get();
    $exams = Exam::all();
    
    return view('admin.backend.qestion.add_qestion', compact('questions', 'exams' , ));
}

    //end method 

    public function StoreQestion(Request $request) {
          if ($request->file('image')) {
           $image = $request->file('image');
           $manager = new ImageManager(new Driver());
           $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
           $img = $manager->read($image);
           $img->resize(100,90)->save(public_path('upload/qestion/'.$name_gen));
           $save_url = 'upload/qestion/'.$name_gen;

           qestion::create([
                'exam_id' => $request->exam_id,
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
                'message' => 'qestion Inserted Successfully',
                'alert-type' => 'success'
              );

                return redirect()->route('all.qestion')->with($notification);
        }
        else{
             qestion::create([
                'exam_id' => $request->exam_id,
                'user_id' => auth()->id(),
                'question' => $request->question,
                'option1' => $request->option1,
                'option2' => $request->option2,
                'option3' => $request->option3,
                'option4' => $request->option4,
                'correct_answer' => $request->correct_answer,
                
                

           ]);
           
              $notification = array(
                'message' => 'qestion Inserted Successfully',
                'alert-type' => 'success'
              );

                return redirect()->route('all.qestion')->with($notification);
        }
    }

    //end method

    public function EditQestion($id) {
        $editData = qestion::findOrFail($id);
        $exams = Exam::all();
        return view('admin.backend.qestion.edit_qestion', compact('editData', 'exams'));
    }
    //end method

public function UpdateQestion(Request $request)
{
    $qestion_id = $request->id;
    $qestion = qestion::findOrFail($qestion_id);

    if ($request->file('image')) {
        $image = $request->file('image');
        $manager = new ImageManager(new Driver());
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $img = $manager->read($image);
        $img->resize(100, 90)->save(public_path('upload/qestion/' . $name_gen));
        $save_url = 'upload/qestion/' . $name_gen;

        if (file_exists(public_path($qestion->image))) {
            @unlink(public_path($qestion->image));
        }

        $qestion->update([
            'exam_id' => $request->exam_id,
            'user_id' => auth()->id(),
            'question' => $request->question,
            'option1' => $request->option1,
            'option2' => $request->option2,
            'option3' => $request->option3,
            'option4' => $request->option4,
            'correct_answer' => $request->correct_answer,
            'image' => $save_url,
        ]);
    } else {
        // 🔹 این بخش برای زمانی است که عکس جدید انتخاب نشده
        $qestion->update([
            'exam_id' => $request->exam_id,
            'user_id' => auth()->id(),
            'question' => $request->question,
            'option1' => $request->option1,
            'option2' => $request->option2,
            'option3' => $request->option3,
            'option4' => $request->option4,
            'correct_answer' => $request->correct_answer,
        ]);
    }

    $notification = [
        'message' => 'Question Updated Successfully',
        'alert-type' => 'success',
    ];

    return redirect()->route('all.qestion')->with($notification);
}


    //end method 

    public function DeleteQestion($id) {
        $qestion = qestion::findOrFail($id);
        if (file_exists(public_path($qestion->image))) {
            @unlink(public_path($qestion->image));
        }
        $qestion->delete();

        $notification = array(
            'message' => 'qestion Deleted Successfully',
            'alert-type' => 'success'
          );

            return redirect()->route('all.qestion')->with($notification);
    }

    // ----------------  All New Question ------------------

    public function AllNewQestion() {
        $new = NewQuestion::all();
        return view('admin.backend.new_question.index', compact('new'));
    }

    public function AddNewQestion(){
        $depart = Department::all();
        $firstDepartId = Department::first()->id ?? null;
        $subjects = DepartmentSubject::where('department_id', $firstDepartId)->get();

        return view('admin.backend.new_question.add', compact('depart', 'subjects'));
    }

    public function StoreNewQestion(Request $request) {
        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'subject_id' => 'required|exists:department_subjects,id',
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

                return redirect()->route('all.new.question')->with($notification);
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

                return redirect()->route('all.new.question')->with($notification);
        }
    }

    public function EditNewQestion($id) {
        $editData = NewQuestion::findOrFail($id);
        $departments = Department::all();
        $subjects = DepartmentSubject::where('department_id', $editData->department_id)->get();

        return view('admin.backend.new_question.edit', compact('editData', 'departments', 'subjects'));
    }

    public function UpdateNewQestion(Request $request, $id)
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

    return redirect()->route('all.new.question')->with($notification);
}

    public function DeleteNewQestion($id) {
        $newQuestion = NewQuestion::findOrFail($id);
        if (file_exists(public_path($newQuestion->image))) {
            @unlink(public_path($newQuestion->image));
        }
        $newQuestion->delete();

        $notification = array(
            'message' => 'New Question Deleted Successfully',
            'alert-type' => 'success'
          );

            return redirect()->route('all.new.question')->with($notification);
    }


    // ----------------  All Set Exam ------------------

    public function AllSetExam() {
        $examQuestions = \App\Models\ExamQuestion::with('exam')
        ->select('exam_id')
        ->groupBy('exam_id')
        ->get();

        return view('admin.backend.set_exam.index', compact('examQuestions'));
    }

    public function AddSetExam(){
        $depart = Department::all();
        $firstDepartId = Department::first()->id ?? null;
        $subjects = DepartmentSubject::where('department_id', $firstDepartId)->get();
        $exams = Exam::all();

        return view('admin.backend.set_exam.add', compact('depart', 'firstDepartId', 'subjects', 'exams'));
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


public function StoreSetExam(Request $request)
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

    return redirect()->route('all.set.exam')->with('success', 'Exam questions saved successfully!');
}

    public function EditSetExam($exam_id)
{
    $exam = Exam::findOrFail($exam_id);

    $selectedQuestions = ExamQuestion::where('exam_id', $exam_id)->pluck('question_id')->toArray();

    $exams = Exam::all();

    $depart = Department::all();
    $firstDepartId = Department::first()->id ?? null;
    $subjects = DepartmentSubject::where('department_id', $firstDepartId)->get();

    return view('admin.backend.set_exam.edit', compact(
        'exam',
        'exams',
        'selectedQuestions',
        'depart',
        'subjects'
    ));
}

public function UpdateSetExam(Request $request, $exam_id)
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

    return redirect()->route('all.set.exam')->with('success', 'Exam updated successfully!');
}

public function DeleteSetExam($id){
    ExamQuestion::where('exam_id', $id)->delete();

    // $exam = Exam::findOrFail($id);
    // $exam->delete();

    return redirect()->route('all.set.exam');
}

}
