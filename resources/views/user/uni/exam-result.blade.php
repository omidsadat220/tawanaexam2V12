<?php

$totalQuestion = App\Models\uni_answer_q::count();
$Answer = App\Models\CorrectAns::count();

$currectAnsower = App\Models\CorrectAns::where('correct_answer', 'correct_answer')->count();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Quiz Results - Advanced Dark Mode</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      /* Custom scroll bar for dark mode */
      ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
      }
      ::-webkit-scrollbar-track {
        background: #1f2937;
      }
      ::-webkit-scrollbar-thumb {
        background-color: #16a34a; /* green */
        border-radius: 10px;
        border: 2px solid #1f2937;
      }
      /* Smooth shadow */
      .shadow-soft {
        box-shadow: 0 10px 30px -15px rgba(22, 163, 74, 0.5);
      }
    </style>
  </head>
  <body
    class="bg-gray-900 text-gray-300 font-sans min-h-screen flex flex-col items-center py-12 px-4 sm:px-6 lg:px-8"
  >
    <main
      class="bg-gray-800 max-w-3xl w-full rounded-lg shadow-soft p-8 space-y-8 select-none"
    >
      <header class="text-center">
        <h1 class="text-3xl font-extrabold text-green-500 drop-shadow-md mb-2">
          Your Results
        </h1>
        <div
          class="bg-gray-700 rounded-md p-5 grid grid-cols-2 gap-4 text-gray-200 text-sm sm:text-base"
        >
          <div class="flex justify-between border-b border-gray-600 pb-2">
            <span>Correct Answers:</span>
            <span>{{ $correct }}</span>
          </div>
          <div class="flex justify-between border-b border-gray-600 pb-2">
            <span>Wrong Answers:</span>
            <span>{{ $wrong }}</span>
          </div>
          <div class="flex justify-between border-b border-gray-600 pb-2">
            <span>Total Questions:</span>
            <span>{{ $totalQuestions }}</span>
          </div>
          <div class="flex justify-between pb-2">
            <span>Score:</span>
            <span>{{ $score }}%</span>
          </div>
        </div>
      </header>

     

      <section class="text-center">
       
       <button
        id="backButton"
        class="bg-gray-700 hover:bg-green-600 text-green-400 hover:text-gray-900 font-semibold py-2 px-6 rounded-md shadow-md transition duration-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 inline-flex items-center space-x-2 mx-auto"
          >
          <a href="{{ route('user.certificate') }}"><span>Certificate</span></a>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5 text-green-500"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
            aria-hidden="true"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M9 5l7 7-7 7"
            />
          </svg>
        </button> <br><br>

        

      </section>

      @if($wrong > 0)
  <div class="bg-gray-700 rounded-lg shadow px-6 py-6 text-center text-gray-200">
      <h3 class="font-bold text-red-400 text-lg mb-2">
          You got {{ $wrong }} answers wrong.
      </h3>
      <p class="text-yellow-300 font-semibold">
          Don’t worry — mistakes are proof that you are trying and learning! 🚀
      </p>
  </div>
@else
  <div class="bg-gray-700 rounded-lg shadow px-6 py-6 text-center text-green-400 font-bold">
      🎉 Excellent! You answered everything correctly. Keep up the great work!
  </div>
@endif



{{--       
    @foreach($wrongQuestions as $item)
      <article
        class="bg-gray-700 rounded-lg shadow px-6 py-5 sm:py-6 text-gray-300 leading-relaxed max-h-96 overflow-y-auto no-scrollbar"
      >
        <h3 class="font-bold text-gray-200 mb-3">
          Review of Incorrect Answers
        </h3>
        <p>
          <strong>Question:</strong> {{ $item->question }}
        </p>
        <ul class="mt-2 space-y-1">
            <li>A) {{ $item->question_one }}</li>
            <li>B) {{ $item->question_two }}</li>
            <li>C) {{ $item->question_three }}</li>
            <li>D) {{ $item->question_four }}</li>
        </ul>

        <p class="mt-2">Your Answer:
        <span class="text-red-400 font-semibold">{{ $item->user_answer }}</span>
        </p>
        <p class="mt-1">Correct Answer:
        <span class="text-green-400 font-semibold">{{ $item->real_answer }}</span>
        </p>
      </article>
      @endforeach --}}

   <section class="text-center">
        
        <button
          id="backButton"
          class="bg-gray-700 hover:bg-green-600 text-green-400 hover:text-gray-900 font-semibold py-2 px-6 rounded-md shadow-md transition duration-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 inline-flex items-center space-x-2 mx-auto"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5 text-green-500"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
            aria-hidden="true"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M15 19l-7-7 7-7"
            />
          </svg>
        <a href="{{ route('user.dashboard') }}"><span style="padding-right: 8px">Back</span></a>
        </button>
      </section>


      
    </main>

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
  </body>
</html>
