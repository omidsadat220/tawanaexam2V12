<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\UserAnswer;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function TeacherDashboard()    {
            $userId = Auth::id(); // اگر میخوای همه دانش‌آموزان رو ببینی، این خط نیاز نیست
    $answers = UserAnswer::with(['user', 'exam.department', 'exam.subject'])
                ->get(); // میتونی ->where('user_id', $userId) بذاری اگر فقط کاربر لاگین شده مدنظره

    // گروه‌بندی بر اساس user_id و exam_id
    $grouped = $answers->groupBy(['user_id', 'exam_id']);

    $results = [];

    foreach ($grouped as $userId => $examGroup) {
        foreach ($examGroup as $examId => $rows) {

            $correct = $rows->filter(function($row) {
                return $row->selected_answer == $row->correct_answer;
            })->count();

            $wrong = $rows->filter(function($row) {
                return $row->selected_answer != $row->correct_answer;
            })->count();

            $score = $correct; // نمره = تعداد جواب‌های درست

            $results[] = [
                'user' => $rows->first()->user,
                'exam' => $rows->first()->exam,
                'department' => $rows->first()->exam->department,
                'subject' => $rows->first()->exam->subject,
                'correct' => $correct,
                'wrong' => $wrong,
                'score' => $score,
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
