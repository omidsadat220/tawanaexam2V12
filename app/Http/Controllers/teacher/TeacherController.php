<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\UserAnswer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function TeacherDashboard(){
        $teacherId = Auth::id();

        $studentIds = DB::table('select_teachers')
            ->where('teacher_id', $teacherId)
            ->pluck('student_id');

        $answers = UserAnswer::with(['user', 'exam.department', 'exam.subject'])
            ->whereIn('user_id', $studentIds)
            ->get();

        $grouped = $answers->groupBy(['user_id', 'exam_id']);
        $results = [];

        foreach ($grouped as $userId => $examGroup) {
            foreach ($examGroup as $examId => $rows) {

                $correct = $rows->filter(fn($row) => $row->selected_answer == $row->correct_answer)->count();
                $wrong   = $rows->filter(fn($row) => $row->selected_answer != $row->correct_answer)->count();

                $results[] = [
                    'user' => $rows->first()->user,
                    'exam' => $rows->first()->exam,
                    'department' => $rows->first()->exam->department,
                    'subject' => $rows->first()->exam->subject,
                    'correct' => $correct,
                    'wrong' => $wrong,
                    'score' => $correct,
                ];
            }
        }

        return view('teacher.index', compact('results'));
    }

    public function TeacherLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
