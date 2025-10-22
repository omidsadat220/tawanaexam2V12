<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exam Results - Tawana Technology</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen py-8 px-4">

    <div class="max-w-5xl mx-auto">

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

        <div class="mt-8 text-center">
            <p class="text-xl font-bold text-green-400">
                Your Score: {{ $totalScore }} / {{ $userAnswers->count() }}
            </p>
        </div>
    </div>

</body>
</html>
