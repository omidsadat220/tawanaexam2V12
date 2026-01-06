<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exam Results - Tawana Technology</title>
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- <script>
    // Disable the browser back button
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
</script> --}}

    
<style>
.dashboard-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #029941ff, #179d02ff);
    color: #fff !important;
    padding: 10px 22px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 8px;
    border: none;
    box-shadow: 0 4px 10px rgba(0, 234, 105, 0.3);
    text-decoration: none;
    transition: all 0.3s ease;
}

.dashboard-btn:hover {
    background: linear-gradient(135deg, #0bd200ff, #32a800ff);
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(0, 234, 0, 0.4);
}

.dashboard-btn:active {
    transform: scale(0.97);
}
</style>


</head>
<body class="bg-gray-900 text-white min-h-screen py-8 px-4">

    {{-- <div class="max-w-5xl mx-auto">

        <h1 class="text-3xl font-bold mb-6 text-center text-green-400">
            Exam Results: {{ $exam->exam_title }}
        </h1>

        <p class="text-center text-gray-400 mb-6">
            Attempted on: {{ $latestAttempt->created_at->format('F d, Y - h:i A') }}
        </p>

        @php $totalScore = 0; @endphp

        <div class="space-y-6">
            @foreach ($userAnswers as $answer)
                @php
                    $isCorrect = $answer->selected_answer === $answer->correct_answer;
                    if ($isCorrect) $totalScore++;
                @endphp

                <div class="p-6 rounded-xl shadow-md {{ $isCorrect ? 'bg-green-700' : 'bg-red-700' }}">
                    <h3 class="text-lg font-medium mb-2">Question: {{ $answer->question->question ?? 'N/A' }}</h3>

                    @if(!empty($answer->question) && !empty($answer->question->image))
                        <img src="{{ asset($answer->question->image) }}" 
                            alt="Question Image" 
                            class="mb-2 w-full max-h-64 object-contain rounded">
                    @endif


                    <p><strong>Your Answer:</strong> {{ $answer->selected_answer }}</p>
                    <p><strong>Correct Answer:</strong> {{ $answer->correct_answer }}</p>

                    <p class="mt-2 font-bold">
                        Result: 
                        @if($isCorrect)
                           <span class="text-green-300">Correct ✅</span> 
                           
                        @else
                           <span class="text-red-300">Wrong ❌</span> 
                          

                        @endif
                    </p>
                </div>
            @endforeach
        </div>

  

       <a href="{{ route('user.dashboard') }}" class="dashboard-btn">
        <i class="fas fa-tachometer-alt me-2"></i> Go To Dashboard
        </a>
    </div> --}}


    {{-- all the boxes get the colors --}}
    {{-- <div class="max-w-5xl mx-auto bg-gray-800 rounded-2xl p-6 md:p-8 space-y-6">

        <h1 class="text-3xl font-bold mb-6 text-center text-green-400">
            Exam Results: {{ $exam->exam_title }}
        </h1>

        <p class="text-center text-gray-400 mb-6">
            Attempted on: {{ $latestAttempt->created_at->format('F d, Y - h:i A') }}
        </p>

        @php $totalScore = 0; @endphp

        @foreach ($userAnswers as $answer)
            @php
                $q = $answer->question; // جدول qestions
                if(!$q) continue; // اگر سوال پیدا نشد از ادامه رد شو
                $isCorrect = $answer->selected_answer === $q->correct_answer;
                if ($isCorrect) $totalScore++;
                $options = [$q->option1, $q->option2, $q->option3, $q->option4];
            @endphp

            <div class="question-block gradient-border rounded-xl p-6 {{ $isCorrect ? 'bg-green-700' : 'bg-gray-900' }}">
                <h3 class="text-lg font-semibold text-white mb-4">
                    Question: {{ $q->question }}
                </h3>

                @if(!empty($q->image))
                    <img src="{{ asset($q->image) }}" 
                        alt="Question Image" 
                        class="mb-4 w-full max-h-64 object-contain rounded">
                @endif

                <div class="space-y-4">
                    @foreach($options as $key => $option)
                        @php
                            $optionLetter = ['A','B','C','D'][$key];
                            $isSelected = $answer->selected_answer === $option;
                            $isRight = $q->correct_answer === $option;
                            $bgColor = 'bg-gray-700 hover:bg-gray-600';
                            if(!$isCorrect && $isSelected) $bgColor = 'bg-red-600';
                            if($isRight) $bgColor = 'bg-green-600';
                        @endphp

                        <label class="option-hover flex items-center {{ $bgColor }} rounded-xl p-4 cursor-pointer transition-all">
                            <div class="w-6 h-6 rounded-full border-2 border-gray-600 flex items-center justify-center mr-3">
                                <div class="w-3 h-3 rounded-full 
                                            {{ $isRight ? 'bg-green-500 opacity-100' : ($isSelected ? 'bg-red-500 opacity-100' : 'opacity-0') }}">
                                </div>
                            </div>
                            <span class="text-white flex-1">{{ $option }}</span>
                            <span class="text-xs text-gray-300 ml-2">{{ $optionLetter }}</span>
                        </label>
                    @endforeach
                </div>

                <p class="mt-4 font-bold text-white">
                    Result: 
                    @if($isCorrect)
                        <span class="text-green-300">Correct ✅</span>
                    @else
                        <span class="text-red-300">Wrong ❌</span>
                    @endif
                </p>
            </div>
        @endforeach

        <div class="mt-8 text-center">
            <p class="text-xl font-bold text-green-400">
                Your Score: {{ $totalScore }} / {{ $userAnswers->count() }}
            </p>
        </div>

        <a href="{{ route('user.dashboard') }}" class="dashboard-btn mt-4 inline-flex items-center justify-center">
            <i class="fas fa-tachometer-alt me-2"></i> Go To Dashboard
        </a>
    </div> --}}


    {{-- only the check box get the color --}}
    <div class="max-w-5xl mx-auto bg-gray-800 rounded-2xl p-6 md:p-8 space-y-6">

        <h1 class="text-3xl font-bold mb-6 text-center text-green-400">
            Exam Results: {{ $exam->exam_title }}
        </h1>

        <p class="text-center text-gray-400 mb-6">
            Attempted on: {{ $latestAttempt->created_at->format('F d, Y - h:i A') }}
        </p>
       

        @php $totalScore = 0; @endphp

        @foreach ($userAnswers as $answer)
            @php
                $q = $answer->question;
                if(!$q) continue;

                $isCorrect = $answer->selected_answer === $q->correct_answer;
                if ($isCorrect) {
                    $totalScore++;
                    continue; // ✅ فقط سوال‌های اشتباه نمایش داده نشوند
                }

                $options = [$q->option1, $q->option2, $q->option3, $q->option4];
            @endphp

            {{-- فقط سوال‌های اشتباه --}}
            <div class="question-block gradient-border rounded-xl p-6 bg-gray-900">
                <h3 class="text-lg font-semibold text-white mb-4">
                    Question: {{ $q->question }}
                </h3>

                @if(!empty($q->image))
                    <img src="{{ asset($q->image) }}" 
                        alt="Question Image" 
                        class="mb-4 w-full max-h-64 object-contain rounded">
                @endif

                <div class="space-y-4">
                    @foreach($options as $key => $option)
                        @php
                            $optionLetter = ['A','B','C','D'][$key];
                            $isSelected = $answer->selected_answer === $option;
                            $isRight = $q->correct_answer === $option;
                        @endphp

                        <label class="option-hover flex items-center bg-gray-700 hover:bg-gray-600 rounded-xl p-4 cursor-pointer transition-all">
                            <div class="w-6 h-6 rounded-full border-2 border-gray-600 flex items-center justify-center mr-3">
                                <div class="w-3 h-3 rounded-full 
                                            {{ $isRight ? 'bg-green-500 opacity-100' : ($isSelected ? 'bg-red-500 opacity-100' : 'opacity-0') }}">
                                </div>
                            </div>
                            <span class="text-white flex-1">{{ $option }}</span>
                            <span class="text-xs text-gray-300 ml-2">{{ $optionLetter }}</span>
                        </label>
                    @endforeach
                </div>

                <p class="mt-4 font-bold text-white">
                    Result: 
                    <span class="text-red-300">Wrong ❌</span>
                </p>
            </div>
        @endforeach


        @php
            $totalQuestions = $userAnswers->count();
            $percentage = $totalQuestions > 0 ? round(($totalScore / $totalQuestions) * 100) : 0;

            if ($percentage < 40) {
                $color = 'from-red-500 via-red-600 to-red-500';
                $glow = 'shadow-[0_0_25px_rgba(239,68,68,0.8)]';
                $status = 'FAILED ❌';
            } elseif ($percentage < 70) {
                $color = 'from-yellow-400 via-yellow-500 to-yellow-400';
                $glow = 'shadow-[0_0_25px_rgba(234,179,8,0.8)]';
                $status = 'AVERAGE ⚠️';
            } else {
                $color = 'from-green-400 via-emerald-500 to-green-400';
                $glow = 'shadow-[0_0_25px_rgba(34,197,94,0.9)]';
                $status = 'PASSED ✅';
            }
        @endphp

        <div class="mt-10">
            
            <!-- Header -->
            <div class="flex justify-between items-center mb-3">
                <span class="text-sm uppercase tracking-widest text-gray-400">
                    Exam Performance
                </span>
                <span class="text-sm font-bold text-white">
                    {{ $status }}
                </span>
            </div>

            <!-- Progress Container -->
            <div class="relative w-full h-7 rounded-full bg-gray-700 overflow-hidden shadow-inner">

                <!-- Glow -->
                <div
                    class="absolute inset-0 rounded-full bg-gradient-to-r {{ $color }} blur-lg opacity-40"
                    style="width: {{ $percentage }}%">
                </div>

                <!-- Progress -->
                <div
                    id="progressBar"
                    class="relative h-full rounded-full bg-gradient-to-r {{ $color }} {{ $glow }}
                        transition-all duration-1000 ease-out"
                    style="width: 0%">
                </div>

                <!-- Percentage Text -->
                <div class="absolute inset-0 flex items-center justify-center text-xs font-bold text-white tracking-wider">
                    <span id="progressText">0%</span>
                    <span class="ml-2 text-gray-300">
                        ({{ $totalScore }} / {{ $totalQuestions }})
                    </span>
                </div>
            </div>
        </div>


         <div class="mt-8 text-center">
            <p class="text-xl font-bold text-green-400">
                Your Score: {{ $totalScore }} / {{ $userAnswers->count() }}
            </p>
        </div>

        <a href="{{ route('user.dashboard') }}" class="dashboard-btn mt-4 inline-flex items-center justify-center">
            <i class="fas fa-tachometer-alt me-2"></i> Go To Dashboard
        </a>
    </div>


<script>
    const target = {{ $percentage }};
    let current = 0;

    const bar = document.getElementById('progressBar');
    const text = document.getElementById('progressText');

    const interval = setInterval(() => {
        if (current >= target) {
            clearInterval(interval);
        } else {
            current++;
            bar.style.width = current + '%';
            text.textContent = current + '%';
        }
    }, 15);
</script>


 <script>
      // Back button event (for demo purposes: alert or history back)
      document.getElementById("backButton").addEventListener("click", () => {
        if (window.history.length > 1) {
          window.history.back();
        } else {
          alert("Back button pressed - implement navigation.");
        }
      });
    </script>

    <script>
        history.pushState(null, null, location.href);
        window.onpopstate = () => location.replace('/user/dashboard');
    </script>


</body>
</html>
