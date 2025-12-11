<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Profile - TST Exam Center</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .profile-container {
            max-width: 90%;
            margin: 2rem auto;
        }

        /* Header / Profile Card */
        .profile-header {
            padding-top: 25px;
            text-align: center;
            color: white;
            border-radius: 5px;
            border-top: 10px double #4caf50;
            margin-bottom: 2rem;
        }

        .profile-card {
            background-color: #0f0f0f;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 0.7s cubic-bezier(0.4, 2, 0.6, 1) both;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .profile-header h2 {
            font-size: 2rem;
            font-weight: 700;
        }

        /* Exam Grid */
        .exam-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .exam-card {
            background-color: #2c2c2c;
            border: 1px solid #4caf50;
            border-radius: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }

        .exam-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(76, 175, 80, 0.4);
        }

        .exam-card .header-bar {
            height: 6px;
            background: linear-gradient(to right, #4caf50, #2e7d32);
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .exam-card .p-6 {
            padding: 1.5rem;
        }

        .exam-card h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #e0e0e0;
            margin-bottom: 0.5rem;
        }

        .exam-card .exam-date,
        .exam-card .exam-score {
            font-size: 0.9rem;
            color: #999;
            margin-bottom: 0.5rem;
        }

        .exam-card .btn {
            width: 100%;
            border-radius: 0.5rem;
        }

        /* Floating particles */
        .floating-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
            overflow: hidden;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
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
    </style>
</head>

<body>
    <div class="floating-particles" id="particles"></div>

    <!-- Header -->
    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-card">
                <h2>Your Certificates</h2>
            </div>
        </div>

        <!-- Exam Grid -->
        <div class="exam-grid">
    @forelse($certificates as $certificate)
        <div class="exam-card" style="width: 250px; height: 280px;">
            <div class="header-bar" style="height:4px; background: linear-gradient(to right, #4caf50, #2e7d32);"></div>
            <div class="p-4 flex flex-col justify-between h-full">
                <div>
                    <h4 class="text-white font-bold">{{ $certificate->subject->subject_name ?? 'Unknown Subject' }}</h4>
                    <p class="text-gray-300 text-sm">
                        <strong>Name:</strong> {{ $certificate->result->user->name ?? 'N/A' }}<br>
                        <strong>Lastname:</strong> {{ $certificate->result->user->lastname ?? 'N/A' }}
                    </p>
                    <p class="text-gray-400 text-sm mt-1">
                        {{ $certificate->description ?? 'No description provided.' }}
                    </p>
                </div>

                <div class="mt-3">
                    <div class="exam-date text-gray-300 text-xs mb-1">
                        <i class="fas fa-calendar-alt"></i> 
                        {{ \Carbon\Carbon::parse($certificate->created_at)->format('F d, Y - h:i A') }}
                    </div>
                    <div class="exam-score text-green-500 font-semibold mb-2">
                        <i class="fas fa-check-circle"></i> 
                        Score: {{ $certificate->result->score ?? 'N/A' }}/100
                    </div>
                    {{-- <a href="{{ route('certificate.download', $certificate->id) }}" 
                       class="btn btn-success btn-sm w-full">
                        Review
                    </a> --}}
                    <a href="" 
                       class="btn btn-success btn-sm w-full">
                        Review
                    </a>
                </div>
            </div>
        </div>
    @empty
        <p class="text-white">You haven't passed any exams yet.</p>
    @endforelse
</div>

    </div>

    <!-- Scripts -->
    <script>
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
        document.addEventListener("DOMContentLoaded", () => createParticles(30));
    </script>
</body>

</html>
