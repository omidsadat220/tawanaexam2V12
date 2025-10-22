<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\classcategory;
use App\Models\ClassSubject;
use Illuminate\Http\Request;

class classsubjectController extends Controller
{
    
    public function AllSubject()
    {

        $allData = ClassSubject::with(['classcategory'])->get();

        return view('admin.backend.class_subject.all_subject', compact('allData'));
    }

    //end method 

    public function AddSubject()
    {

        $categories = classcategory::all();

        return view('admin.backend.class_subject.add_subject', compact('categories'));
    }

    public function StoreSubject(Request $request)
    {
        $request->validate([
            'class_category_id' => 'required|integer',
            'subject_name'      => 'required|array|min:1',
            'subject_name.*'    => 'required|string|max:255',
        ]);

        // store all subjects in ONE row
        ClassSubject::create([
            'class_category_id' => $request->class_category_id,
            'subject_name'      => json_encode($request->subject_name),
        ]);

        return redirect()->route('all.subject')->with([
            'message' => 'Subjects Inserted Successfully',
            'alert-type' => 'success'
        ]);
    }

    //end method 

    public function EditSubject($id)
    {

        $categories = ClassCategory::all(); // all categories for the dropdown
        $editData = ClassSubject::with('classcategory')->findOrFail($id); // only one subject

        return view('admin.backend.class_subject.edit_subject', compact('editData', 'categories'));
    }

    //end method 

    public function UpdateSubject(Request $request)
    {
        $subject = ClassSubject::findOrFail($request->id);

        $subject->update([
            'class_category_id' => $request->class_category_id,
            'subject_name'      => $request->subject_name,
        ]);

        return redirect()->route('all.subject')->with('success', 'Subject updated successfully.');
    }

    public function DeleteSubject($id)
    {

        $subject = ClassSubject::find($id)->delete();

        $notification = array(
            'message' => 'Subject is  Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
