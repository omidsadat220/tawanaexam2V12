<?php

$totalQuestion = App\Models\uni_answer_q::count();
$Answer = App\Models\CorrectAns::count();
$currectAnsower = App\Models\CorrectAns::where('correct_answer', 'correct_answer')->count();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Final Exam Results - Tawana Technology</title>
    <script src="https://cdn.tailwindcss.com"></script>

<style>
.dashboard-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #007bff, #0056d2);
    color: #fff !important;
    padding: 10px 22px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 8px;
    border: none;
    box-shadow: 0 4px 10px rgba(0, 91, 234, 0.3);
    text-decoration: none;
    transition: all 0.3s ease;
}
.dashboard-btn:hover {
    background: linear-gradient(135deg, #0056d2, #0041a8);
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(0, 91, 234, 0.4);
}
.dashboard-btn:active {
    transform: scale(0.97);
}
</style>

</head>

<body class="bg-gray-900 text-gray-200 min-h-screen py-10 px-4">

<div class="max-w-4xl mx-auto bg-gray-800 rounded-2xl p-8 shadow-xl">

    <h1 class="text-3xl font-bold text-center text-green-400 mb-6">
        Final Exam Results
    </h1>

    <div class="bg-gray-900 p-6 rounded-xl shadow mb-8 grid grid-cols-2 gap-4 text-lg">
        <p class="flex justify-between"><span>Correct Answers:</span><span>{{ $correct }}</span></p>
        <p class="flex justify-between"><span>Wrong Answers:</span><span>{{ $wrong }}</span></p>
        <p class="flex justify-between"><span>Total Questions:</span><span>{{ $totalQuestions }}</span></p>
        <p class="flex justify-between"><span>Score:</span><span>{{ $score }}%</span></p>
    </div>

    {{-- PASS / FAIL MESSAGE --}}
    @if($score >= 50)
        <div class="bg-green-700 text-white p-6 rounded-xl text-center mb-8">
            🎉 Congratulations! You passed the exam with {{ $score }}%!
        </div>
    @else
        <div class="bg-red-700 text-white p-6 rounded-xl text-center mb-8">
            ❌ Unfortunately, you did not pass the exam. Your score is {{ $score }}%.
            <p class="text-yellow-300 mt-2">Don’t give up — try again and improve! 🚀</p>
        </div>
    @endif


    {{-- WRONG QUESTIONS LIST --}}
    {{-- @foreach($wrongQuestions as $item)
        <div class="bg-gray-900 p-6 rounded-xl mb-6 border border-gray-700">
            <h3 class="text-xl font-semibold text-white mb-3">
                Question: {{ $item->question }}
            </h3>

            <ul class="space-y-2 text-gray-300">
                <li>A) {{ $item->question_one }}</li>
                <li>B) {{ $item->question_two }}</li>
                <li>C) {{ $item->question_three }}</li>
                <li>D) {{ $item->question_four }}</li>
            </ul>

            <p class="mt-3">
                <strong>Your Answer:</strong>
                <span class="text-red-400">{{ $item->user_answer }}</span>
            </p>

            <p>
                <strong>Correct Answer:</strong>
                <span class="text-green-400">{{ $item->real_answer }}</span>
            </p>
        </div>
    @endforeach --}}


    {{-- BUTTONS --}}
   <div class="flex justify-between mt-10">

        <a href="{{ route('user.dashboard') }}" class="dashboard-btn">
            ⬅ Back to Dashboard
        </a>

        {{-- SHOW CERTIFICATE ONLY IF SCORE >= 50 --}}
        @if($score >= 50)
            <a href="{{ route('user.certificate') }}" class="dashboard-btn">
                🎓 Download Certificate
            </a>
        @endif

    </div>

</div>

<script>
    history.pushState(null, null, location.href);
    window.onpopstate = () => location.replace('/user/dashboard');
</script>

</body>
</html>
