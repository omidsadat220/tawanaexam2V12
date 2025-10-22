<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\DepartmentSubject;
use App\Models\Exam;
use App\Models\qestion;
use App\Models\TeacherQuestion;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class QestionController extends Controller
{
    public function AllTeacherQestion() {
        $alldata = qestion::with(['exam'])->where('user_id', auth()->id())->get();
        return view('teacher.backend.qestion.all_teacher_qestion', compact('alldata'));
    }

    //end method 


    public function AddTeacherQestion() {
    $questions = qestion::with('exam')->latest()->get();
    $exams = Exam::all();
    
    return view('teacher.backend.qestion.add_teacher_qestion', compact('questions', 'exams'));
    }

    //end method 

    public function StoreTeacherQestion(Request $request) {
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
                return redirect()->route('all.teacher.qestion')->with($notification);
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

                return redirect()->route('all.teacher.qestion')->with($notification);

    }
}

    //end method 

    public function EditTeacherQestion($id) {
        $editData = qestion::findOrFail($id);
        $exams = Exam::all();
        return view('teacher.backend.qestion.edit_teacher_qestion', compact('editData', 'exams'));
    }

    //end method

    public function UpdateTeacherQestion(Request $request) {

       $qestion_id = $request->id;
        $qestion = qestion::find($qestion_id);

        if ($request->file('image')) {
           $image = $request->file('image');
           $manager = new ImageManager(new Driver());
           $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
           $img = $manager->read($image);
           $img->resize(100,90)->save(public_path('upload/qestion/'.$name_gen));
           $save_url = 'upload/qestion/'.$name_gen;

           if (file_exists(public_path($qestion->image))) {
             @unlink(public_path($qestion->image));
           }

           qestion::find($qestion_id)->update([
                'exam_id' => $request->exam_id,
                // 'user_id' => auth()->id(),
                'question' => $request->question,
                'option1' => $request->option1,
                'option2' => $request->option2,
                'option3' => $request->option3,
                'option4' => $request->option4,
                'correct_answer' => $request->correct_answer,
                'image' => $save_url

           ]);
           
              $notification = array(
                'message' => 'qestion Inserted Successfully',
                'alert-type' => 'success'
              );
            }else {
        $qestion->update([
            'exam_id' => $request->exam_id,
            'question' => $request->question,
            'option1' => $request->option1,
            'option2' => $request->option2,
            'option3' => $request->option3,
            'option4' => $request->option4,
            'correct_answer' => $request->correct_answer,
        ]);
    }

    return redirect()->route('all.teacher.qestion')->with($notification);
    }

    //end method

    public function DeleteTeacherQestion($id) {
        $qestion = qestion::findOrFail($id);
        if (file_exists(public_path($qestion->image))) {
            @unlink(public_path($qestion->image));
        }
        $qestion->delete();

        $notification = array(
            'message' => 'qestion Deleted Successfully',
            'alert-type' => 'success'
          );

            return redirect()->route('all.teacher.qestion')->with($notification);
    }
}
