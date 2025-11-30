<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\uni_answer_q;
use App\Models\department;
use App\Models\DepartmentSubject;
use Illuminate\Http\Request;

class Uni_answer_qController extends Controller
{
    public function AllAnswer()
    {
        $allData = uni_answer_q::with('category')->get();
        return view('admin.backend.answer.all_answer', compact('allData'));
    }


    public function AddAnswer()
    {
        $category = Category::all();
        // $answer = uni_answer_q::all();
        $depart = Department::all();
        $firstDepartId = Department::first()->id ?? null;
        $subjects = DepartmentSubject::where('department_id', $firstDepartId)->get();

        return view('admin.backend.answer.add_answer', compact('depart', 'category','firstDepartId','subjects'));
    }

    public function StoreAnswer(Request $request)    {
        $request->validate([
            'category_id' => 'required',
            'question_ids' => 'required|array',
        ]);

        foreach ($request->question_ids as $q_id) {
            $question = \App\Models\NewQuestion::find($q_id);

            if ($question) {
                uni_answer_q::create([
                    'category_id' => $request->category_id,
                    'question' => $question->question,
                    'question_one' => $question->option1,
                    'question_two' => $question->option2,
                    'question_three' => $question->option3,
                    'question_four' => $question->option4,
                    'correct_answer' => $question->correct_answer,
                ]);
            }
        }

        $notification = [
            'message' => 'Questions saved successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.answer')->with($notification);
    }


    public function EditAnswer($id)
    {
        $answer = uni_answer_q::findOrFail($id);
        $category = Category::all();

        return view('admin.backend.answer.edit_answer', compact('answer', 'category'));
    }

    public function UpdateAnswer(Request $request)
{
    $request->validate([
        'ans_id' => 'required',
        'category_id' => 'required',
        'question_id' => 'required', // ID سوالی که میخوای بروزرسانی کنی
    ]);

    $answer = uni_answer_q::findOrFail($request->ans_id);
    $question = NewQuestion::find($request->question_id);

    if ($question) {
        $answer->update([
            'category_id' => $request->category_id,
            'question' => $question->question,
            'question_one' => $question->option1,
            'question_two' => $question->option2,
            'question_three' => $question->option3,
            'question_four' => $question->option4,
            'correct_answer' => $question->correct_answer,
        ]);
    }

    $notification = [
        'message' => 'Answer updated successfully',
        'alert-type' => 'success'
    ];

    return redirect()->route('all.answer')->with($notification);
}


    public function DeleteAnswer($id)
    {

        uni_answer_q::find($id)->delete();

        $notification = array(
            'message' => 'Answer Delete Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);
    }
}
