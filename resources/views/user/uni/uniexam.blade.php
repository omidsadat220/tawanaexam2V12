<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Advanced Online Exam with Sidebar</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<style>
@import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap");
* { font-family: "Inter", sans-serif; }
body { background-color: rgb(38,38,38); color: #e2e8f0; min-height: 100vh; }

.gradient-border { position: relative; background: rgb(38,38,38); border-radius: 16px; padding: 1px; }
.gradient-border::before { content: ""; position: absolute; top:0; left:0; right:0; bottom:0; border-radius:16px; padding:2px; background: rgb(38,38,38); -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0); mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0); -webkit-mask-composite: xor; mask-composite: exclude; }

.option-hover { transition: all 0.3s; cursor:pointer; }
.option-hover:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(99,241,106,0.3); }
.question-item { transition: all 0.3s ease; }
.w-3 { transition: opacity 0.2s; }
.bg-gray { background-color:#373737; }
.bg-in-gray { background-color:#252525; }
.bg-green-600 { background-color:#16a34a; }
.bg-img { background-image: url('{{ asset("assets/img/hb.png") }}'); background-position:center; background-size:cover; }
.pulse { animation: pulse 2s infinite; }
@keyframes pulse { 0% {transform:scale(1);} 50% {transform:scale(1.05);} 100% {transform:scale(1);} }
.floating-particles { position:fixed; top:0; left:0; width:100%; height:100%; pointer-events:none; z-index:0; overflow:hidden; }
.particle { position:absolute; width:4px; height:4px; background:#00ff88; border-radius:50%; opacity:0; animation:float linear infinite; }
@keyframes float { 0%{transform:translateY(100vh) rotate(0deg); opacity:0;} 10%{opacity:1;} 90%{opacity:1;} 100%{transform:translateY(-50px) rotate(360deg); opacity:0;} }
</style>
</head>

<body class="min-h-screen py-8 px-4">

<div class="max-w-7xl mx-auto">

<!-- Header -->
<div class="gradient-border mb-8">
    <div class="bg-img rounded-2xl p-6 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-green-600 opacity-10 rounded-full -translate-x-16 -translate-y-16"></div>
        <div class="absolute bottom-0 left-0 w-40 h-40 bg-green-600 opacity-10 rounded-full translate-x-20 translate-y-20"></div>
        <div class="flex flex-col md:flex-row justify-between items-center relative z-10">
            <h1 class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-green-400 to-green-700 bg-clip-text text-transparent">Tawana Technology Exam Center</h1>
            <div class="flex items-center space-x-4 mt-4 md:mt-0">
                <div class="flex items-center mt-5">
                    <div class="w-3 h-3 bg-green-400 rounded-full mr-2 mt-5 animate-pulse"></div>
                    <span class="text-sm text-green-400 mt-5">Online</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Grid -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

<!-- Questions -->
<div class="lg:col-span-9 order-1">
<form method="POST" action="{{ route('exam.submit') }}" id="examForm">
    @csrf

<div class="gradient-border">
<div class="bg-gray rounded-2xl p-6 md:p-8 relative overflow-hidden">

    <input type="hidden" name="category_id" value="{{ request()->route('id') }}">
    
{{-- @php $answers = \App\Models\uni_answer_q::all(); @endphp --}}
<div id="questionsContainer">
@foreach ($answers as $index => $item)
<div class="question-item {{ $index==0?'block':'hidden' }}" data-index="{{ $index }}">
    <div class="bg-in-gray rounded-xl p-6 mb-6">
        <h2 class="text-xl font-semibold text-white mb-4">{{ $item->question }}</h2>
        <div class="space-y-4">
            @foreach(['question_one','question_two','question_three','question_four'] as $idx => $option)
            <label class="option-hover flex items-center bg-gray rounded-xl p-4 cursor-pointer">
                <input type="radio" name="answers[{{ $item->id }}]" value="{{ $item->$option }}" class="hidden" />
                <div class="w-6 h-6 rounded-full border-2 border-gray-600 flex items-center justify-center mr-3">
                    <div class="w-3 h-3 rounded-full bg-green-500 opacity-0"></div>
                </div>
                <span class="text-gray-300 flex-1">{{ $item->$option }}</span>
                <span class="text-xs text-gray-500 ml-2">{{ chr(65 + $idx) }}</span>
            </label>
            @endforeach
        </div>
    </div>
</div>
@endforeach
</div>

<div class="flex flex-wrap justify-between mt-8 gap-3">
    <button type="button" id="prevBtn" class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-all" style="display:none;">Previous</button>
    <button type="button" id="nextBtn" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all">Next</button>
    <button type="submit" id="submitBtn" class="px-6 py-3 bg-gradient-to-r from-green-600 to-green-800 text-white rounded-lg hover:from-green-700 hover:to-green-900 transition-all duration-300 flex items-center pulse" style="display:none;">
        Submit Exam <i class="fas fa-paper-plane ml-2"></i>
    </button>
</div>

</div>
</div>
</form>
</div>

<!-- Sidebar -->
<!-- Sidebar -->
<div class="lg:col-span-3 order-2 lg:order-2">
    <div class="relative sticky top-6 rounded-2xl bg-[#11860f] shadow-md">
        <div class="p-5 rounded-2xl bg-[#198754]">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-sm font-semibold mb-0">
                    <i class="fas fa-list-ol text-purple-300 mr-2"></i>
                    Questions
                </h3>
                <div class="timer-container text-right">
                    <h3 class="mb-0">Time Left: <span id="exam-timer">00:00</span></h3>
                </div>
            </div>
            
            <!-- Numbers -->
            <div class="grid grid-cols-5 gap-2 mb-3" id="sidebarNumbers">
                @foreach($answers as $index => $item)
                    <div 
                        class="q-number {{ $index == 0 ? 'bg-green-600' : 'bg-gray-700' }} text-white text-sm flex justify-center items-center rounded-md py-1.5 cursor-pointer"
                        data-index="{{ $index }}">
                        @if($item->image)
                            <i class="fas fa-image fa-xs"></i>
                        @else
                            {{ $index + 1 }}
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Stats -->
            <div class="p-4 rounded-xl bg-[#1e293b]">
                <div class="flex justify-between mb-2">
                    <span class="text-xs text-gray-400">Answered:</span>
                    <span id="answeredCount" class="text-xs text-green-400">0 questions</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="text-xs text-gray-400">With Images:</span>
                    <span id="withImagesCount" class="text-xs text-blue-400">0 questions</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-xs text-gray-400">Remaining:</span>
                    <span id="remainingCount" class="text-xs text-yellow-400">0 questions</span>
                </div>
            </div>

            <!-- Button -->
            <button
                class="w-full mt-3 py-2.5 bg-gradient-to-r from-green-600 to-emerald-700 text-white text-sm font-medium rounded-lg hover:from-green-700 hover:to-emerald-800 transition-all duration-300 flex items-center justify-center gap-2">
                <i class="fas fa-paper-plane text-xs"></i> Finish Exam
            </button>
        </div>
    </div>
</div>

</div>
</div>

<div class="floating-particles" id="particles"></div>

<script>
// Particles
const particleContainer = document.getElementById('particles');
for(let i=0;i<50;i++){
    let p = document.createElement('div');
    p.className = 'particle';
    p.style.left = Math.random()*100+'%';
    p.style.animationDuration = (5+Math.random()*5)+'s';
    p.style.animationDelay = (Math.random()*5)+'s';
    particleContainer.appendChild(p);
}

// Variables
let current = 0;
const questions = document.querySelectorAll(".question-item");
const qNumbers = document.querySelectorAll(".q-number");
const nextBtn = document.getElementById("nextBtn");
const prevBtn = document.getElementById("prevBtn");
const submitBtn = document.getElementById("submitBtn");
const answeredCountEl = document.getElementById("answeredCount");
const withImagesCountEl = document.getElementById("withImagesCount");
const remainingCountEl = document.getElementById("remainingCount");
const timerEl = document.getElementById("exam-timer");

// Show question function
function showQuestion(index){
    questions.forEach((q,i)=> q.classList.toggle('hidden', i!==index));
    prevBtn.style.display = index===0?'none':'inline-block';
    nextBtn.style.display = index===questions.length-1?'none':'inline-block';
    submitBtn.style.display = index===questions.length-1?'inline-block':'none';
    updateSidebar();
    updateStats();
}

// Update sidebar numbers
function updateSidebar(){
    questions.forEach((q,index)=>{
        const answered = q.querySelector('input[type="radio"]:checked');
        if(answered){
            qNumbers[index].classList.add("bg-green-600");
            qNumbers[index].classList.remove("bg-gray-700");
        } else {
            qNumbers[index].classList.remove("bg-green-600");
            qNumbers[index].classList.add("bg-gray-700");
        }
    });
}

// Update stats
function updateStats(){
    let answered = 0;
    let withImages = 0;
    questions.forEach(q=>{
        if(q.querySelector('input[type="radio"]:checked')) answered++;
        if(q.querySelector('img')) withImages++;
    });
    answeredCountEl.textContent = answered + " questions";
    withImagesCountEl.textContent = withImages + " questions";
    remainingCountEl.textContent = (questions.length - answered) + " questions";
}

// Option click behavior
document.querySelectorAll(".option-hover").forEach(box=>{
    box.addEventListener("click", function(){
        const radio = this.querySelector("input[type='radio']");
        if(radio) radio.checked = true;

        const allOptions = this.closest('.space-y-4').querySelectorAll('.option-hover');
        allOptions.forEach(opt=>{
            opt.classList.remove("bg-green-600");
            const circle = opt.querySelector('.w-3');
            if(circle) circle.style.opacity='0';
        });

        this.classList.add("bg-green-600");
        const circle = this.querySelector('.w-3');
        if(circle) circle.style.opacity='1';

        updateSidebar();
        updateStats();
    });
});

// Next/Prev buttons
nextBtn.addEventListener('click', ()=>{
    if(current < questions.length-1) current++;
    showQuestion(current);
});
prevBtn.addEventListener('click', ()=>{
    if(current > 0) current--;
    showQuestion(current);
});

// Click on sidebar numbers
qNumbers.forEach((num,i)=>{
    num.addEventListener('click', ()=>{
        current=i;
        showQuestion(current);
    });
});

// Show first question
showQuestion(current);

// Timer (45 min)
let duration = {{ $timer }} * 60; // دقیقه × 60 = ثانیه
startTimer(duration, document.getElementById('exam-timer'));
function startTimer(duration, display){
    let timer = duration;
    const interval = setInterval(()=>{
        let minutes = Math.floor(timer/60);
        let seconds = timer % 60;
        minutes = minutes < 10 ? '0'+minutes : minutes;
        seconds = seconds < 10 ? '0'+seconds : seconds;
        display.textContent = minutes + ":" + seconds;
        if(timer-- <= 0) clearInterval(interval);
    }, 1000);
}
startTimer(duration, timerEl);

// submit the data do db when time finished
function startTimer(duration, display){
    let timer = duration;
    const interval = setInterval(()=>{
        let minutes = Math.floor(timer/60);
        let seconds = timer % 60;
        minutes = minutes < 10 ? '0'+minutes : minutes;
        seconds = seconds < 10 ? '0'+seconds : seconds;
        display.textContent = minutes + ":" + seconds;

        if(timer-- <= 0){
            clearInterval(interval);
            // فرم خودکار submit شود
            document.getElementById('examForm').submit();
        }
    }, 1000);
}

</script>


</body>
</html>
