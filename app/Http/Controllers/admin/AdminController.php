<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAnswer;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
         $results = UserAnswer::with(['user', 'exam', 'department'])
            ->get()
            ->groupBy(['user_id', 'exam_id']) // group by user + exam
            ->map(function ($examGroups) {

                return $examGroups->map(function ($answers) {

                    $correct = $answers->filter(function ($a) {
                        return $a->selected_answer == $a->correct_answer;
                    })->count();

                    $wrong = $answers->filter(function ($a) {
                        return $a->selected_answer != $a->correct_answer;
                    })->count();

                    return [
                        'user'       => $answers->first()->user,
                        'department' => $answers->first()->department,
                        'exam'       => $answers->first()->exam,
                        'correct'    => $correct,
                        'wrong'      => $wrong,
                        'score'      => $correct, // score = correct answers count
                    ];
                });
            });

        return view('admin.index', compact('results'));
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
