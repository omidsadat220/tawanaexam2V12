<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DepartmentSubject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function getSubjectsByDepartment($department_id)
    {
        $subjects = DepartmentSubject::where('department_id', $department_id)->get();

        return response()->json($subjects->map(function ($subject) {
            return [
                'id' => $subject->id,
                'name' => $subject->subject_name,
            ];
        }));
    }
}
