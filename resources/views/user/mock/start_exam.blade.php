<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Advanced Online Exam System with Images</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap");

        * { font-family: "Inter", sans-serif; }
        body { background-color: rgb(38, 38, 38); min-height: 100vh; color: #e2e8f0; }
        .gradient-border { position: relative; background: rgb(38, 38, 38); border-radius: 16px; padding: 1px; }
        .gradient-border::before { content: ""; position: absolute; top: 0; left: 0; right: 0; bottom: 0; border-radius: 16px; padding: 2px; background: rgb(38, 38, 38); -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0); mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0); -webkit-mask-composite: xor; mask-composite: exclude; }
        .option-hover:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(99, 241, 106, 0.3); }
        .question-number { transition: all 0.3s ease; }
        .question-number:hover { transform: scale(1.1); background: linear-gradient(135deg, #63f176 0%, #050505 100%); }
        .question-image { transition: all 0.3s ease; cursor: zoom-in; }
        .question-image:hover { transform: scale(1.02); box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4); }
        .image-modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.9); z-index: 1000; justify-content: center; align-items: center; }
        .modal-content { max-width: 90%; max-height: 90%; }
        @keyframes pulse { 0% { transform: scale(1); } 50% { transform: scale(1.05); } 100% { transform: scale(1); } }
        .pulse { animation: pulse 2s infinite; }
        .floating-particles { position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 0; overflow: hidden; }
        .particle { position: absolute; width: 4px; height: 4px; background: #00ff88; border-radius: 50%; opacity: 0; animation: float linear infinite; }
        @keyframes float { 0% { transform: translateY(100vh) rotate(0deg); opacity: 0; } 10% { opacity: 1; } 90% { opacity: 1; } 100% { transform: translateY(-50px) rotate(360deg); opacity: 0; } }
        .bg-img { background-image: url("{{ asset('assets/img/hb.png') }}"); background-position: center; background-size: cover; }
        .bg-gray { background-color: #373737; }
        .bg-in-gray { background-color: #252525; }
    </style>
</head>

<body class="min-h-screen py-8 px-4">

    <!-- Image Modal -->
    <div id="imageModal" class="image-modal">
        <div class="modal-content">
            <img id="modalImage" src="" alt="" class="w-full h-full object-contain" />
        </div>
        <button onclick="closeModal()"
            class="absolute top-4 right-4 text-white text-2xl bg-gray-800 p-2 rounded-full hover:bg-gray-700">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="gradient-border mb-8">
            <div class="bg-img rounded-2xl p-6 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-green-600 opacity-10 rounded-full -translate-x-16 -translate-y-16"></div>
                <div class="absolute bottom-0 left-0 w-40 h-40 bg-green-600 opacity-10 rounded-full translate-x-20 translate-y-20"></div>
                <div class="flex flex-col md:flex-row justify-between items-center relative z-10">
                    
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-green-400 to-green-700 bg-clip-text text-transparent">
                            Tawana Technology Exam Center
                        </h1>
                        <p class="text-gray-400 mt-2">Specialized Web Programming Questions </p>
                    </div>
                    <div class="flex items-center space-x-4 mt-4 md:mt-0">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-400 rounded-full mr-2 animate-pulse"></div>
                            <span class="text-sm text-green-400">Online</span>
                        </div>
                        {{-- <div class="text-gray-400 text-sm">
                            <i class="far fa-clock mr-1"></i> <span id="timer">45:00</span>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <!-- Exam Form -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                
                <div class="lg:col-span-9 order-1 lg:order-1">
                    <form method="POST" action="{{ route('mock.exam.submit', $exam->id) }}">
                        @csrf
                        <div class="gradient-border">
                            <div class="bg-gray rounded-2xl p-6 md:p-8 relative overflow-hidden">
                                @foreach ($questions as $index => $item)
                                    <div class="question-block gradient-border mb-8"
                                        data-index="{{ $index }}"
                                        style="{{ $index == 0 ? '' : 'display:none;' }}">
                                        <div class="bg-in-gray rounded-xl p-6">
                                            <h2 class="text-xl font-semibold text-white mb-4">{{ $item->question }}</h2>

                                            @if($item->image)
                                                <img src="{{ asset($item->image) }}"
                                                    alt="Question Image"
                                                    class="question-image mb-4 w-full max-w-md cursor-pointer"
                                                    onclick="openModal('{{ asset($item->image) }}')" />
                                            @endif

                                            <div class="space-y-4">
                                                @for ($i = 1; $i <= 4; $i++)
                                                    @php
                                                        $option = 'option' . $i;
                                                        $label = chr(64 + $i);
                                                    @endphp
                                                    <label
                                                        class="option-hover flex items-center bg-gray rounded-xl p-4 cursor-pointer transition-all hover:bg-gray-700">
                                                        <input type="radio"
                                                            name="answers[{{ $item->id }}]"
                                                            value="{{ $item->$option }}"
                                                            class="hidden" required />
                                                        <div
                                                            class="w-6 h-6 rounded-full border-2 border-gray-600 flex items-center justify-center mr-3">
                                                            <div class="w-3 h-3 rounded-full bg-green-500 opacity-0"></div>
                                                        </div>
                                                        <span class="text-gray-300 flex-1">{{ $item->$option }}</span>
                                                        <span class="text-xs text-gray-500 ml-2">{{ $label }}</span>
                                                    </label>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="flex flex-wrap justify-between mt-8 gap-3">
                                    <button type="button" id="prevBtn"
                                        class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-all mr-3"
                                        style="display:none;">
                                        Previous
                                    </button>

                                    <button type="button" id="nextBtn"
                                        class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all">
                                        Next
                                    </button>

                                    <button type="submit" id="submitBtn"
                                        class="px-6 py-3 bg-gradient-to-r from-green-600 to-dark-600 text-white rounded-lg hover:from-dark-700 hover:to-green-700 transition-all duration-300 flex items-center pulse"
                                        style="display:none;">
                                        Submit Exam <i class="fas fa-paper-plane ml-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Sidebar -->
                    <div class="lg:col-span-3 order-2 lg:order-2">
                        <div class="relative sticky top-6 rounded-2xl bg-[#0f172a] shadow-md">
                            <div class="p-5 rounded-2xl bg-[#0f172a]"> <!-- فقط p-5 به جای p-4 -->
                                <h3 class="text-sm font-semibold mb-3 flex items-center text-gray-100">
                                    <i class="fas fa-list-ol text-purple-300 mr-2"></i>
                                    Questions
                                </h3>

                                <!-- Numbers -->
                                <div class="grid grid-cols-5 gap-2 mb-3">
                                    @foreach($questions as $index => $item)
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
        // Timer
        function startTimer(duration, display) {
            let timer = duration, minutes, seconds;
            setInterval(function() {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;
                display.textContent = minutes + ":" + seconds;
                if (--timer < 0) { timer = 0; }
            }, 1000);
        }
        window.onload = function() {
            const fortyFiveMinutes = 45 * 60;
            const display = document.querySelector("#timer");
            startTimer(fortyFiveMinutes, display);
        };

        // Particles
        function createParticles(count = 50) {
            const container = document.getElementById("particles");
            container.innerHTML = "";
            for (let i = 0; i < count; i++) {
                const p = document.createElement("div");
                p.className = "particle";
                p.style.left = Math.random() * 100 + "%";
                p.style.animationDelay = Math.random() * 5 + "s";
                p.style.animationDuration = Math.random() * 3 + 3 + "s";
                container.appendChild(p);
            }
        }
        document.addEventListener("DOMContentLoaded", () => { createParticles(20); });

        // Image Modal
        function openModal(src) {
            document.getElementById('modalImage').src = src;
            document.getElementById('imageModal').style.display = 'flex';
        }
        function closeModal() {
            document.getElementById('imageModal').style.display = 'none';
        }

        // Option click style
        document.querySelectorAll("label").forEach((label) => {
            label.addEventListener("click", function() {
                const parent = this.closest(".space-y-4");
                parent.querySelectorAll(".option-hover div > div").forEach((el) => {
                    el.style.opacity = "0";
                });
                this.querySelector("div > div").style.opacity = "1";
            });
        });

        // Next and Previous Button
        document.addEventListener("DOMContentLoaded", function() {
            let current = 0;
            const blocks = document.querySelectorAll(".question-block");
            const nextBtn = document.getElementById("nextBtn");
            const prevBtn = document.getElementById("prevBtn");
            const submitBtn = document.getElementById("submitBtn");

            nextBtn.addEventListener("click", () => {
                const curBlock = blocks[current];
                const chosen = curBlock.querySelector('input[type="radio"]:checked');
                if (!chosen) {
                    alert("Please select an answer before proceeding.");
                    return;
                }

                curBlock.style.display = "none";
                current++;

                if (current < blocks.length) {
                    blocks[current].style.display = "block";
                    prevBtn.style.display = "inline-block"; // 👈 اینجا ظاهر شود
                }

                if (current === blocks.length - 1) {
                    nextBtn.style.display = "none";
                    submitBtn.style.display = "inline-block";
                }
            });

            prevBtn.addEventListener("click", () => {
                blocks[current].style.display = "none";
                current--;
                blocks[current].style.display = "block";

                nextBtn.style.display = "inline-block";
                submitBtn.style.display = "none";

                if (current === 0) {
                    prevBtn.style.display = "none";
                }
            });
        });

        // Question Number Click
        // Click on sidebar numbers
        document.querySelectorAll(".q-number").forEach((num) => {
            num.addEventListener("click", function() {
                const index = parseInt(this.getAttribute("data-index"));
                const blocks = document.querySelectorAll(".question-block");

                blocks.forEach((b, i) => {
                    b.style.display = i === index ? "block" : "none";
                });

                // Update active color
                document.querySelectorAll(".q-number").forEach(n => {
                    n.classList.remove("bg-green-600");
                    n.classList.add("bg-gray-700");
                });
                this.classList.add("bg-green-600");

                // Update buttons visibility
                const prevBtn = document.getElementById("prevBtn");
                const nextBtn = document.getElementById("nextBtn");
                const submitBtn = document.getElementById("submitBtn");

                prevBtn.style.display = index === 0 ? "none" : "inline-block";
                nextBtn.style.display = index === blocks.length - 1 ? "none" : "inline-block";
                submitBtn.style.display = index === blocks.length - 1 ? "inline-block" : "none";

                current = index; // Update current for next/prev buttons
            });
        });

        // Update Stats
function updateStats() {
    const blocks = document.querySelectorAll(".question-block");
    let answered = 0;
    let withImages = 0;

    blocks.forEach((block, index) => {
        const checked = block.querySelector('input[type="radio"]:checked');
        if (checked) {
            answered++;
            // شماره پاسخ داده شده سبز شود
            const qNum = document.querySelectorAll(".q-number")[index];
            if (qNum) {
                qNum.classList.add("bg-green-600");
                qNum.classList.remove("bg-gray-700");
            }
        } else {
            // اگر پاسخ داده نشده، خاکستری باشد
            const qNum = document.querySelectorAll(".q-number")[index];
            if (qNum) {
                qNum.classList.remove("bg-green-600");
                qNum.classList.add("bg-gray-700");
            }
        }

        // بررسی وجود تصویر
        const img = block.querySelector("img");
        if (img) withImages++;
    });

    const remaining = blocks.length - answered;

    document.getElementById("answeredCount").textContent = answered + " questions";
    document.getElementById("withImagesCount").textContent = withImages + " questions";
    document.getElementById("remainingCount").textContent = remaining + " questions";
}

// اجرای اولیه Stats
updateStats();

// آپدیت Stats هر بار که کاربر گزینه‌ای انتخاب کند
document.querySelectorAll("input[type='radio']").forEach(input => {
    input.addEventListener("change", updateStats);
});

// مدیریت Next و Previous بدون محدودیت انتخاب
document.addEventListener("DOMContentLoaded", function() {
    let current = 0;
    const blocks = document.querySelectorAll(".question-block");
    const nextBtn = document.getElementById("nextBtn");
    const prevBtn = document.getElementById("prevBtn");
    const submitBtn = document.getElementById("submitBtn");

    // نمایش سوال فعلی
    blocks.forEach((b, i) => b.style.display = i === current ? "block" : "none");
    prevBtn.style.display = "none";
    submitBtn.style.display = blocks.length === 1 ? "inline-block" : "none";

    nextBtn.addEventListener("click", () => {
        blocks[current].style.display = "none";
        current++;
        if (current >= blocks.length) current = blocks.length - 1; // جلوگیری از overflow
        blocks[current].style.display = "block";

        prevBtn.style.display = current === 0 ? "none" : "inline-block";
        nextBtn.style.display = current === blocks.length - 1 ? "none" : "inline-block";
        submitBtn.style.display = current === blocks.length - 1 ? "inline-block" : "none";

        updateStats();
    });

    prevBtn.addEventListener("click", () => {
        blocks[current].style.display = "none";
        current--;
        if (current < 0) current = 0;
        blocks[current].style.display = "block";

        prevBtn.style.display = current === 0 ? "none" : "inline-block";
        nextBtn.style.display = current === blocks.length - 1 ? "none" : "inline-block";
        submitBtn.style.display = current === blocks.length - 1 ? "inline-block" : "none";

        updateStats();
    });

    // کلیک روی شماره سوال‌ها
    const qNumbers = document.querySelectorAll(".q-number");
    qNumbers.forEach((num, index) => {
        num.addEventListener("click", () => {
            blocks[current].style.display = "none";
            current = index;
            blocks[current].style.display = "block";

            prevBtn.style.display = current === 0 ? "none" : "inline-block";
            nextBtn.style.display = current === blocks.length - 1 ? "none" : "inline-block";
            submitBtn.style.display = current === blocks.length - 1 ? "inline-block" : "none";

            updateStats();
        });
    });
});


</script>

</body>

</html>
