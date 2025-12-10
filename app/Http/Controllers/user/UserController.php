<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\CorrectAns;
use App\Models\department;
use App\Models\DepartmentSubject;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\NewQuestion;
use App\Models\qestion;
use App\Models\SelectTeacher;
use App\Models\UserAnswer;
use App\Models\FinalExamResult;
use App\Models\SetClassStudent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\uni_answer_q;
use App\Models\VoucherCode;

class UserController extends Controller
{
    public function UserDashboard()
    {
        return view('user.dashboard');
    }

    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function UserFinalexamdah()
    {
        return view('user.finalexamdash');
    }

    public function UserProfile()
{
    $user = auth()->user();

    // گرفتن وچرهای جدید کاربر (is_used = 0)
    $vouchers = VoucherCode::where('user_id', $user->id)
                           ->where('is_used', false)
                           ->get();

    // همهٔ آن‌ها را به حالت استفاده شده تغییر بده
    // VoucherCode::where('user_id', $user->id)
    //            ->where('is_used', false)
    //            ->update(['is_used' => true]);

    // داده‌های مورد نیاز view
    $teachers = \App\Models\User::where('role', 'teacher')->get();
    $selectedTeacher = \App\Models\SelectTeacher::where('student_id', $user->id)->first();

    return view('user.uprofile.userprofile', compact('user','teachers','selectedTeacher','vouchers'));
}


    public function UserEditprofile()
    {
        $user = Auth::user();
        return view('user.uprofile.usereditprofile', compact('user'));
    }


    public function UserProfileUpdate(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|max:2048',
        ]);


        $user->name  = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('avatar')) {
            $avatarName = time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('avatars'), $avatarName);
            $user->photo = 'avatars/' . $avatarName;
        }

        $user->save();

        return redirect()->route('user.uprofile.userprofile')
            ->with('success', 'Profile updated successfully!');
    }



    public function UserChangepassword()
    {
        return view('user.uprofile.change-password');
    }

    public function UserPasswordUpdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->with([
                'message' => 'Old Password Does Not Match',
                'alert-type' => 'error'
            ]);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('user.dashboard')->with([
            'message' => 'Password Changed Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function selectTeacher(Request $request) {
        $request->validate([
            'teacher_id' => 'required|exists:users,id',
        ]);

        // ذخیره انتخاب کاربر
        SelectTeacher::updateOrCreate(
            ['student_id' => auth()->id()],
            ['teacher_id' => $request->teacher_id]
        );

        return redirect()->back()->with('success', 'Teacher selected successfully!');
    }



   
    public function UserUnicode()
    {
        $categories = Category::all(); // fetch categories
        return view('user.uni.unicode', compact('categories'));
    }

    // login with voucher

    public function loginWithVoucher(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $voucher = VoucherCode::where('code', $request->code)
                    ->where('category_id', $request->category_id)
                    ->where('is_used', false)
                    ->first();

        if (!$voucher) {
            return back()->with('error', 'Invalid or used voucher for this category.');
        }

        // Log in the user
        Auth::loginUsingId($voucher->user_id);

        // Mark voucher as used (or delete if you want one-time)
        $voucher->delete();

        // Redirect to selected exam route
        return redirect()->route('user.uniexam', ['category_id' => $request->category_id]);
    }


    //Exam Page
    public function UserUniexam($id)
    {

        $category = Category::findOrFail($id);
        $timer = $category->timer;
        return view('user.uni.uniexam', compact('category', 'timer'));
    }

    public function UpdateExam(Request $request)
    {

        $cat_id = $request->cat_id;

        $correct = CorrectAns::findOrFail($request->cat_id);

        $correct->update([
            'question' => $request->question,
            'correct_answer' => $request->correct_answer,
        ]);

        $notification = [
            'message' => 'Answer Add  Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }


    // userVaryfucode
    public function UserVarifyCode(Request $request)
    {
    $request->validate([
        'code' => 'required|string',
        'category_id' => 'required|exists:categories,id',
    ]);

    $voucher = VoucherCode::where('code', $request->code)
        ->where('category_id', $request->category_id)
        ->where('is_used', false)
        ->first();

    if (!$voucher) {
        return back()->with('error', 'Invalid or already used voucher for this category.');
    }

    // Optional: log in the user
    $user = User::find($voucher->user_id);
    if ($user) {
        Auth::login($user);
    }

    // Mark voucher as used
    $voucher->is_used = true;
    $voucher->save();

    // Correct redirect to match route parameter
    return redirect()->route('user.uniexam', ['id' => $request->category_id]);
        }

        //SubmitExam
        public function SubmitExam(Request $request)
        {
            $userId = auth()->id() ?? 1;
            foreach ($request->answers as $questionId => $answer) {
                $question = \App\Models\uni_answer_q::find($questionId);

                \App\Models\CorrectAns::create([
                    'user_id' => $userId,
                    'question' => $question->question,
                    'correct_answer' => $answer,
                ]);
            }

            return redirect()->route('user.examresult');
        }
    //End Method

    //Start UserExamResult

    public function UserExamResult(){
    $userId = Auth::id();

    // 1️⃣ آخرین زمان امتحان کاربر
    $lastExamTime = CorrectAns::where('user_id', $userId)
        ->latest('created_at')
        ->value('created_at');

    if (!$lastExamTime) {
        return back()->with('error', 'No exam found!');
    }

    // 2️⃣ گرفتن category_id از uni_answer_qs (چون در correct_ans وجود ندارد)
    $categoryId = CorrectAns::join('uni_answer_qs', 'correct_ans.question', '=', 'uni_answer_qs.question')
        ->where('correct_ans.user_id', $userId)
        ->where('correct_ans.created_at', $lastExamTime)
        ->value('uni_answer_qs.category_id');

    // 3️⃣ تعداد کل سوالات
    $totalQuestions = CorrectAns::where('user_id', $userId)
        ->where('created_at', $lastExamTime)
        ->count();

    // 4️⃣ تعداد جواب‌های درست
    $correct = CorrectAns::join('uni_answer_qs', 'correct_ans.question', '=', 'uni_answer_qs.question')
        ->where('correct_ans.user_id', $userId)
        ->where('correct_ans.created_at', $lastExamTime)
        ->whereColumn('correct_ans.correct_answer', 'uni_answer_qs.correct_answer')
        ->count();

    // 5️⃣ جواب‌های اشتباه
    $wrong = $totalQuestions - $correct;

    // 6️⃣ درصد نمره
    $score = $totalQuestions > 0 ? round(($correct / $totalQuestions) * 100, 2) : 0;

    // 7️⃣ سوالات اشتباه
    $wrongQuestions = CorrectAns::join('uni_answer_qs', 'correct_ans.question', '=', 'uni_answer_qs.question')
        ->where('correct_ans.user_id', $userId)
        ->where('correct_ans.created_at', $lastExamTime)
        ->whereColumn('correct_ans.correct_answer', '!=', 'uni_answer_qs.correct_answer')
        ->select(
            'uni_answer_qs.question',
            'uni_answer_qs.correct_answer as real_answer',
            'correct_ans.correct_answer as user_answer',
            'uni_answer_qs.question_one',
            'uni_answer_qs.question_two',
            'uni_answer_qs.question_three',
            'uni_answer_qs.question_four'
        )
        ->get();

    // 8️⃣ ذخیره امتیاز در final_exam_results
    \App\Models\FinalExamResult::create([
        'user_id' => $userId,
        'category_id' => $categoryId,
        'score' => $score
    ]);

    // 9️⃣ ارسال به ویو
    return view('user.uni.exam-result', compact(
        'totalQuestions',
        'correct',
        'wrong',
        'score',
        'wrongQuestions'
    ));
}



    //UserCertificate
    public function UserCertificate()
    {
        return view('user.uni.certificate');
    }


    ////////////////////////////
    public function MockExam(){
        // $user_id = Auth::user()->id;
        // $set_class = SetClassStudent::all();
        // $department = department::all();
        // $department_subject = DepartmentSubject::all();
        $user_id = Auth::id();
             // Get the set_class record for this user
             $set_class = SetClassStudent::where('user_id', $user_id)
                ->with('department.subjects') // eager load department and its subjects
                ->first();
        return view('user.mock.mock_exam', compact('set_class'));
    }

    public function ListExam($subject_id)
{
    $user_id = Auth::id();

    // بررسی اینکه کاربر به چه set_class اختصاص دارد
    $set_class = SetClassStudent::where('user_id', $user_id)->first();
    if (!$set_class) {
        return redirect()->back()->with('error', 'You are not assigned to any department.');
    }

    // گرفتن موضوع (subject) مورد نظر
    $subject = DepartmentSubject::where('id', $subject_id)
                ->where('department_id', $set_class->department_id)
                ->firstOrFail();

    // گرفتن تمام امتحانات این موضوع
    $exams = Exam::where('subject_id', $subject->id)->get();

    foreach ($exams as $exam) {

        // آخرین تلاش کاربر برای این امتحان
        $latestAttempt = UserAnswer::where('exam_id', $exam->id)
            ->where('user_id', $user_id)
            ->latest('created_at')
            ->first();

        if ($latestAttempt) {
            // فقط پاسخ‌های همان تلاش آخر
            $correctAnswers = UserAnswer::where('exam_id', $exam->id)
                ->where('user_id', $user_id)
                ->whereDate('created_at', $latestAttempt->created_at->toDateString())
                ->whereTime('created_at', $latestAttempt->created_at->format('H:i:s'))
                ->whereColumn('selected_answer', 'correct_answer')
                ->count();
        } else {
            $correctAnswers = 0;
        }

        // کل سوالات امتحان از جدول exam_questions
        $totalQuestions = \App\Models\ExamQuestion::where('exam_id', $exam->id)->count();

        // مقادیر برای Blade
        $exam->total_questions = $totalQuestions;
        $exam->correct_answers = $correctAnswers;

        // درصد پیشرفت
        $exam->progress = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0;
    }

    // مسیر درست Blade (بر اساس فولدر شما)
    return view('user.mock.list_exam', compact('subject', 'exams'));
}



    // MockExamStart


public function MockExamStart($exam_id)
    {
        $user_id = Auth::id();

        // گرفتن امتحان
        $exam = Exam::findOrFail($exam_id);

        // گرفتن تمام سوالات این امتحان از جدول exam_questions با relation به new_questions
        $questions = ExamQuestion::with('question') // رابطه با NewQuestion
                        ->where('exam_id', $exam_id)
                        ->get()
                        ->map(function($item){
                            return $item->question; // فقط رکورد اصلی سوال
                        });

        return view('user.mock.start_exam', compact('exam', 'questions'));
    }

    // ثبت پاسخ‌ها
    public function MockExamSubmit(Request $request, $exam_id)
    {
        $user_id = Auth::id();
        $exam = Exam::findOrFail($exam_id);

        foreach($request->answers as $question_id => $selected_answer) {

            // گرفتن سوال از جدول new_questions
            $question = NewQuestion::find($question_id);
            if(!$question) continue; // اگر سوال موجود نبود، رد شود

            // ذخیره در جدول user_answers
            UserAnswer::create([
                'user_id' => $user_id,
                'exam_id' => $exam->id,
                'question_id' => $question->id, // foreign key درست به new_questions
                'department_id' => $exam->department_id,
                'selected_answer' => $selected_answer,
                'correct_answer' => $question->correct_answer,
            ]);
        }

        return redirect()->route('mock.exam.results', $exam->id)
                         ->with('success', 'Your exam has been submitted successfully!');
    }

         public function examResults($exam_id)
        {
          $exam = Exam::findOrFail($exam_id);

    // get latest attempt of this user for this exam
    $latestAttempt = UserAnswer::where('exam_id', $exam_id)
        ->where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->first();

    if (!$latestAttempt) {
        return redirect()->back()->with('error', 'No answers found for this exam.');
    }

    // get all answers created at the same time (that one attempt)
    $userAnswers = UserAnswer::with('question')
    ->where('exam_id', $exam_id)
    ->where('user_id', Auth::id())
    ->whereDate('created_at', $latestAttempt->created_at->toDateString())
    ->whereTime('created_at', $latestAttempt->created_at->format('H:i:s'))
    ->get();


    return view('user.mock.exam_results', compact('exam', 'userAnswers', 'latestAttempt'));
        }
}
