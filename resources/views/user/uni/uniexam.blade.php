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

        * {
            font-family: "Inter", sans-serif;
        }

        body {
            background-color: rgb(38, 38, 38);
            min-height: 100vh;
            color: #e2e8f0;
        }

        .gradient-border {
            position: relative;
            background: rgb(38, 38, 38);
            border-radius: 16px;
            padding: 1px;
        }

        .gradient-border::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 16px;
            padding: 2px;
            background: rgb(38, 38, 38);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
        }

        .option-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(99, 241, 106, 0.3);
        }

        .question-number {
            transition: all 0.3s ease;
        }

        .question-number:hover {
            transform: scale(1.1);
            background: linear-gradient(135deg, #63f176 0%, #050505 100%);
        }

        .question-image {
            transition: all 0.3s ease;
            cursor: zoom-in;
        }

        .question-image:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        }

        .image-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            max-width: 90%;
            max-height: 90%;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        .floating-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: #00ff88;
            border-radius: 50%;
            opacity: 0;
            animation: float linear infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-50px) rotate(360deg);
                opacity: 0;
            }
        }
        
           .bg-img { 
            background-image: url("{{ asset('assets/img/hb.png') }}");
            background-position: center;
            background-size: cover;
           }


           .bg-gray {
            background-color: #373737;
           }

           .bg-in-gray{
            background-color: #252525;
           }
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
                <div
                    class="absolute top-0 right-0 w-32 h-32 bg-green-600 opacity-10 rounded-full -translate-x-16 -translate-y-16">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-40 h-40 bg-green-600 opacity-10 rounded-full translate-x-20 translate-y-20">
                </div>
                <div class="flex flex-col md:flex-row justify-between items-center relative z-10">
                    @php $category = App\Models\Category::first(); @endphp
                    <div>
                        <h1
                            class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-green-400 to-green-700 bg-clip-text text-transparent">
                            Tawana Technology Exam Center
                        </h1>
                        <p class="text-gray-400 mt-2">Specialized Web Programming Questions {{ $category->uni_name }}
                        </p>
                    </div>
                    <div class="flex items-center space-x-4 mt-4 md:mt-0">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-400 rounded-full mr-2 animate-pulse"></div>
                            <span class="text-sm text-green-400">Online</span>
                        </div>
                        <div class="text-gray-400 text-sm">
                            <i class="far fa-clock mr-1"></i> <span id="timer">45:00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Exam Form -->
        <form method="POST" action="{{ route('exam.submit') }}">
            @csrf
            <div class="gradient-border">
                <div class="bg-gray rounded-2xl p-6 md:p-8 relative overflow-hidden">
                    @php $answers = \App\Models\uni_answer_q::all(); @endphp

                    @foreach ($answers as $item)
                        <div class="gradient-border mb-8">
                            <div class="bg-in-gray rounded-xl p-6">
                                <h2 class="text-xl font-semibold text-white mb-4">{{ $item->question }}</h2>

                                <!-- Options -->
                                <div class="space-y-4">
                                    <label
                                        class="option-hover flex items-center bg-gray rounded-xl p-4 cursor-pointer">
                                        <input type="radio" name="answers[{{ $item->id }}]"
                                            value="{{ $item->question_one }}" class="hidden" />
                                        <div
                                            class="w-6 h-6 rounded-full border-2 border-gray-600 flex items-center justify-center mr-3">
                                            <div class="w-3 h-3 rounded-full bg-green-500 opacity-0"></div>
                                        </div>
                                        <span class="text-gray-300 flex-1">{{ $item->question_one }}</span>
                                        <span class="text-xs text-white-500 ml-2">A</span>
                                    </label>

                                    <label
                                        class="option-hover flex items-center bg-gray rounded-xl p-4 cursor-pointer">
                                        <input type="radio" name="answers[{{ $item->id }}]"
                                            value="{{ $item->question_two }}" class="hidden" />
                                        <div
                                            class="w-6 h-6 rounded-full border-2 border-gray-600 flex items-center justify-center mr-3">
                                            <div class="w-3 h-3 rounded-full bg-purple-500 opacity-0"></div>
                                        </div>
                                        <span class="text-gray-300 flex-1">{{ $item->question_two }}</span>
                                        <span class="text-xs text-gray-500 ml-2">B</span>
                                    </label>

                                    <label
                                        class="option-hover flex items-center bg-gray rounded-xl p-4 cursor-pointer">
                                        <input type="radio" name="answers[{{ $item->id }}]"
                                            value="{{ $item->question_three }}" class="hidden" />
                                        <div
                                            class="w-6 h-6 rounded-full border-2 border-gray-600 flex items-center justify-center mr-3">
                                            <div class="w-3 h-3 rounded-full bg-purple-500 opacity-0"></div>
                                        </div>
                                        <span class="text-gray-300 flex-1">{{ $item->question_three }}</span>
                                        <span class="text-xs text-gray-500 ml-2">C</span>
                                    </label>

                                    <label
                                        class="option-hover flex items-center bg-gray rounded-xl p-4 cursor-pointer">
                                        <input type="radio" name="answers[{{ $item->id }}]"
                                            value="{{ $item->question_four }}" class="hidden" />
                                        <div
                                            class="w-6 h-6 rounded-full border-2 border-gray-600 flex items-center justify-center mr-3">
                                            <div class="w-3 h-3 rounded-full bg-purple-500 opacity-0"></div>
                                        </div>
                                        <span class="text-gray-300 flex-1">{{ $item->question_four }}</span>
                                        <span class="text-xs text-gray-500 ml-2">D</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Submit Button -->
                    <div class="flex justify-center mt-8">
                        <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-green-600 to-dark-600 text-white rounded-lg hover:from-dark-700 hover:to-green-700 transition-all duration-300 flex items-center pulse">
                            Submit Exam <i class="fas fa-paper-plane ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="floating-particles" id="particles"></div>

    <script>
        // Timer
        function startTimer(duration, display) {
            let timer = duration,
                minutes, seconds;
            setInterval(function() {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;
                display.textContent = minutes + ":" + seconds;
                if (--timer < 0) {
                    timer = 0;
                }
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
        document.addEventListener("DOMContentLoaded", () => {
            createParticles(20);
        });

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
    </script>
</body>

</html>
