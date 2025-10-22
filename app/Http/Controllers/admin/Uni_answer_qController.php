<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\uni_answer_q;
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
        $answer = uni_answer_q::all();

        return view('admin.backend.answer.add_answer', compact('answer', 'category'));
    }

    public function  StoreAnswer(Request $request)
    {

        uni_answer_q::insert([
            'category_id' => $request->category_id,
            'question' => $request->question,
            'question_one' => $request->question_one,
            'question_two' => $request->question_two,
            'question_three' => $request->question_three,
            'question_four' => $request->question_four,
            'correct_answer' => $request->correct_answer,
        ]);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

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


        $answer = uni_answer_q::findOrFail($request->ans_id);

        $answer->update([
            'category_id' => $request->category_id,
            'question' => $request->question,
            'question_one' => $request->question_one,
            'question_two' => $request->question_two,
            'question_three' => $request->question_three,
            'question_four' => $request->question_four,
            'correct_answer' => $request->correct_answer,
        ]);

        // Notification
        $notification = array(
            'message' => 'Answer update Successfully',
            'alert-type' => 'success'
        );



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
