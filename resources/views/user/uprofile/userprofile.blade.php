<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Profile - TST Exam Center</title>

    <!-- locle bootstrap 5 cdn css -->
    <link rel="stylesheet" href="./bootstrap5/css/bootstrap.min.css" />

    <!-- locle bootstrap 5 cdn js -->
    <link rel="stylesheet" href="./bootstrap5/js/bootstrap.bundle.min.js" />

    <!-- Bootstrap 5 CSS CDN -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

    <!-- Bootstrap icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        body {
            background-color: #121212;
            /* Dark background */
            color: #e0e0e0;
            /* Light text color */
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Top navbar style */
        .topbar {
            width: 90%;
            background: #1f1f1f;
            color: #e0e0e0;
            padding: 0.5rem 1rem;
            margin: 1rem auto;
        }

        .topbar .title {
            font-weight: 700;
            font-size: 1.3rem;
            letter-spacing: 1px;
            padding: 2px 8px;
        }

        /* User Profile Dropdown Styles */
        .user-profile-dropdown {
            position: relative;
        }

        .user-avatar {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .user-avatar:hover {
            transform: translateY(-2px);
        }

        .avatar-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #4caf50;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .avatar-img:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.4);
        }

        .user-name {
            color: #e0e0e0;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .dropdown-arrow {
            color: #4caf50;
            font-size: 0.8rem;
            transition: transform 0.3s ease;
        }

        .user-avatar.active .dropdown-arrow {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 8px;
            background: #2c2c2c;
            border: 1px solid #4caf50;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            min-width: 200px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-20px) scale(0.95);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            overflow: hidden;
        }

        .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            color: #e0e0e0;
            font-weight: 500;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .dropdown-item a {
            text-decoration: none;
            color: #e0e0e0;
            font-weight: 500;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background: rgba(76, 175, 80, 0.1);
            color: #4caf50;
            transform: translateX(5px);
        }

        .dropdown-item i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .dropdown-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #4caf50, transparent);
            margin: 8px 0;
        }

        /* Profile Section Styles */
        .profile-container {
            max-width: 90%;
            margin: 2rem auto;
            overflow: hidden;
        }

        .profile-header {
            padding-top: 25px;
            text-align: center;
            color: white;
            border-radius: 5px;
            border-top: 10px double #4caf50;
        }

        .profile-avatar-large {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid white;
            margin: 0 auto 1rem;
            object-fit: cover;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .profile-name {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .profile-email {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .profile-content {
            padding: 2rem 0px;
        }

        .profile-section {
            margin-bottom: 2rem;
        }

        .profile-section-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #4caf50;
            margin-bottom: 1rem;
            border-bottom: 2px solid #4caf50;
            padding-bottom: 0.5rem;
        }

        .profile-field {
            display: flex;
            align-items: center;
            padding: 1rem;
            background: rgba(76, 175, 80, 0.05);
            border-radius: 8px;
            margin-bottom: 1rem;
            border: 1px solid rgba(76, 175, 80, 0.2);
        }

        .profile-field-label {
            font-weight: 600;
            color: #4caf50;
            min-width: 150px;
            margin-right: 1rem;
        }

        .profile-field-value {
            color: #e0e0e0;
            flex-grow: 1;
        }

        .edit-btn {
            background: linear-gradient(135deg, #4caf50, #2e7d32);
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-left: 1rem;
        }

        .edit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.4);
        }

        .back-btn {
            background: rgba(255, 255, 255, 0.1);
            color: #e0e0e0;
            border: 1px solid #4caf50;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin-top: 1rem;
        }

        .back-btn:hover {
            background: rgba(76, 175, 80, 0.1);
            color: #4caf50;
            transform: translateY(-2px);
        }

        /* Add subtle animation to background elements when alert is shown */
        .welcome-alert.show~.profile-container {
            filter: blur(2px);
            transition: filter 0.5s ease;
        }

        .welcome-alert.show~header {
            filter: blur(2px);
            transition: filter 0.5s ease;
        }

        /* Exam History Styles */
        .exam-history-section {
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #4caf50;
            margin-bottom: 1rem;
            border-bottom: 2px solid #4caf50;
            padding-bottom: 0.5rem;
        }

        .exam-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .exam-box {
            background: #2c2c2c;
            border: 1px solid #4caf50;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .exam-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(76, 175, 80, 0.4);
        }

        .exam-header {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-bottom: 1rem;
            color: #4caf50;
        }

        .exam-icon {
            font-size: 2rem;
        }

        .exam-status {
            font-size: 0.9rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
            text-transform: uppercase;
        }

        .exam-status.passed {
            background-color: rgba(76, 175, 80, 0.1);
            color: #4caf50;
        }

        .exam-status.failed {
            background-color: rgba(255, 72, 72, 0.1);
            color: #ff4d4d;
        }

        .exam-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #e0e0e0;
        }

        .exam-date {
            font-size: 0.9rem;
            color: #999;
            margin-bottom: 0.8rem;
        }

        .exam-score {
            font-size: 1.8rem;
            font-weight: 700;
            color: #4caf50;
            margin-bottom: 0.8rem;
        }

        .exam-details {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            font-size: 0.85rem;
            color: #999;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .detail-item i {
            font-size: 0.9rem;
        }

        /* Social Media Share Box Styles */
        .social-share-box {
            background: #2c2c2c;
            border: 1px solid #4caf50;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .share-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 1rem;
            color: #4caf50;
        }

        .share-icon {
            font-size: 2rem;
        }

        .share-description {
            font-size: 0.9rem;
            color: #999;
            margin-bottom: 1.5rem;
        }

        .social-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 8px 15px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid #4caf50;
        }

        .social-btn:hover {
            background: rgba(76, 175, 80, 0.1);
            color: #4caf50;
            transform: translateY(-2px);
        }

        .social-btn.facebook {
            background: #1877f2;
            color: white;
        }

        .social-btn.twitter {
            background: #1da1f2;
            color: white;
        }

        .social-btn.instagram {
            background: linear-gradient(45deg,
                    #f09433,
                    #e6683c,
                    #dc2743,
                    #cc2366,
                    #bc1888);
            color: white;
        }

        .social-btn.linkedin {
            background: #0077b5;
            color: white;
        }

        /* Responsive adjustments for exam grid */
        @media (max-width: 1024px) {
            .exam-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 1rem;
            }
        }

        @media (max-width: 768px) {
            .exam-grid {
                grid-template-columns: 1fr;
            }

            .social-buttons {
                flex-direction: column;
                align-items: center;
            }

            .social-btn {
                width: 100%;
                max-width: 200px;
            }
        }

        /* profile box css */

        .profile-card {
            animation: fadeInUp 0.7s cubic-bezier(0.4, 2, 0.6, 1) both;
            background-color: #0f0f0f;
            background-image: url("{{ asset('assets/img/hb.png') }}");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
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

        /*  added  */
        .profile-card {
            animation: fadeInUp 0.7s cubic-bezier(0.4, 2, 0.6, 1) both;
            background-color: #0f0f0f;
            display: flex;
            justify-content: center;
            align-items: center;
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

        .stat-card:hover {
            transform: translateY(-6px) scale(1.03);
            box-shadow: 0 8px 32px rgba(34, 197, 94, 0.15);
        }

        .dark-mode {
            background: var(--dark-bg) !important;
            color: #e5e7eb !important;
        }

        .dark-mode .profile-card {
            background: #23232a !important;
            color: #e5e7eb !important;
        }

        .dark-mode .stat-card {
            background: #23232a !important;
            color: #e5e7eb !important;
        }

        .dark-mode .timeline-dot {
            background: var(--primary) !important;
            border-color: #23232a !important;
        }

        .timeline-dot {
            transition: background 0.3s;
        }

        /*  added  */

        .profile-card {
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

        .stat-card:hover {
            transform: translateY(-6px) scale(1.03);
            box-shadow: 0 8px 32px rgba(34, 197, 94, 0.15);
        }

        .dark-mode {
            background: var(--dark-bg) !important;
            color: #e5e7eb !important;
        }

        .dark-mode .profile-card {
            background: #23232a !important;
            color: #e5e7eb !important;
        }

        .dark-mode .stat-card {
            background: #23232a !important;
            color: #e5e7eb !important;
        }

        .dark-mode .timeline-dot {
            background: var(--primary) !important;
            border-color: #23232a !important;
        }

        .timeline-dot {
            transition: background 0.3s;
        }

        /* profile box css */

        /* exam card */
        .exam-card {
            background-color: transparent;
            color: #fff;
            box-shadow: 0 0 10px green;
            border: 1px solid green;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .exam-card:hover {
            transform: translateY(-2px);
        }

        /* Container for particles */
        .floating-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            /* Allow clicks through */
            z-index: -1;
            /* Behind all elements */
            overflow: hidden;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
        }

        /* Each particle */
        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: #00ff88;
            border-radius: 50%;
            opacity: 0;
            animation: float linear infinite;
        }

        /* Float animation */
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

        #profile-card {
            background-color: rgb(38, 38, 38);
        }
    </style>
</head>

<body>
    <div class="floating-particles" id="particles"></div>

    <!-- Profile Container -->
    <div class="profile-container">
        <!-- Profile Header -->
        <div class="profile-header">
            <!-- Profile Card -->
            <div
                class="profile-card bg-dark rounded-2xl shadow-xl p-8 flex flex-col md:flex-row items-center gap-8 relative">
                <!-- Profile Picture -->
                <div class="relative">
                    <img src="{{asset(Auth::user()->photo)}}"
                        class="rounded-full w-40 h-40 border-4 border-green-400 shadow-lg" />
                    <span
                        class="absolute bottom-2 right-2 w-5 h-5 bg-green-500 border-2 border-white rounded-full animate-pulse"></span>
                </div>

                <!-- Profile Info -->
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">

                        <h2 class="text-3xl font-bold">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</h2>
                        <span
                            class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold flex items-center gap-1">
                            <i class="fas fa-user-graduate text-green-500"></i> Student
                        </span>
                    </div>
                    <p class="text-gray-500 mb-4" style="color: #fff; text-align: left">
                        {{ Auth::user()->role ?? 'web developer' }}
                    </p>
                    <div class="flex flex-wrap gap-4 mb-2">

                        <div class="flex items-center gap-2 text-gray-600" style="color: #fff">
                            <i class="fas fa-calendar-alt text-green-500"></i> Joined:
                            <span class="font-semibold"
                                style="color: #fff">{{ Auth::user()->created_at->format('Y') }}</span>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <a href="{{ route('user.dashboard') }}"
                            class="btn-sm mt-2 px-4 py-1 rounded-lg bg-green-500 text-white font-semibold shadow hover:bg-green-600 transition flex items-center gap-2">
                            Home
                        </a>
                        <a href="{{ route('user.uprofile.usereditprofile') }}"
                            class="btn-sm mt-2 px-4 py-1 rounded-lg bg-green-500 text-white font-semibold shadow hover:bg-green-600 transition flex items-center gap-2">
                            Edit Profile
                        </a>
                        <a href="{{ route('user.uprofile.change-password') }}"
                            class="mt-2 px-4 py-1 rounded-lg bg-green-500 text-white font-semibold shadow hover:bg-green-600 transition flex items-center gap-2">
                            Change Password
                        </a>
                    </div>
                </div>
            </div>
            <!-- Profile Card -->
        </div>


        <!-- Profile Content -->
        <div class="profile-content">
            <!-- Exam History Section -->
            <div class="exam-history-section">
                <h2 class="section-title">
                    <i class="bi bi-calendar-check me-2"></i>
                    Coming Soon
                </h2>

                <div class="exam-grid">
                    <!-- Banner section with image and text block -->
                    <div class="banner-container shadow-sm">
                        <!-- Exam Cards -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <!-- card start-->
                            <div class="rounded-xl bg-dark shadow-md overflow-hidden exam-card" id="subject_card">
                                <div class="bg-gradient-to-r from-green-500 to-green-400 h-2"></div>
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-bold text-gray-800 text-white">
                                            Front End
                                        </h3>
                                        <div
                                            class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                            coming soon
                                        </div>
                                    </div>
                                    <p class="text-gray-600 mb-4 text-white" style="height: 50px; overflow: auto">
                                        html ,css, bootstrap , javascript , react ,
                                    </p>
                                    <div class="flex items-center mb-4">
                                        <i class="fas fa-calendar-alt text-green-400 mr-2"></i>
                                        <span class="text-sm text-white-500">April 10, 2024 - 10:00 AM</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-check-circle text-green-400 mr-2"></i>
                                        <span class="text-sm text-white-500">Score: 93/100</span>
                                    </div>
                                    <div class="mt-6">
                                        <div class="flex justify-between mb-1">
                                            <span class="text-sm font-sm text-white-500">Performance</span>
                                            <span class="text-sm font-sm text-white-500">97%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-green-500 h-2.5 rounded-full" style="width: 97%"></div>
                                        </div>
                                    </div>

                                    <div class="mt-6 flex space-x-3">
                                        <button
                                            class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                            Review
                                        </button>
                                        <button
                                            class="p-2 text-green-500 hover:bg-gray-100 rounded-lg focus:outline-none">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- card end-->
                            <!-- card start-->
                            <div class="rounded-xl bg-dark shadow-md overflow-hidden exam-card" id="subject_card">
                                <div class="bg-gradient-to-r from-green-500 to-green-400 h-2"></div>
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-bold text-gray-800 text-white">
                                            Back End
                                        </h3>
                                        <div
                                            class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                            coming soon
                                        </div>
                                    </div>
                                    <p class="text-gray-600 mb-4 text-white" style="height: 50px; overflow: auto">
                                        Mysql , PhP , Laravel
                                    </p>
                                    <div class="flex items-center mb-4">
                                        <i class="fas fa-calendar-alt text-green-400 mr-2"></i>
                                        <span class="text-sm text-white-500">April 10, 2024 - 10:00 AM</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-check-circle text-green-400 mr-2"></i>
                                        <span class="text-sm text-white-500">Score: 93/100</span>
                                    </div>
                                    <div class="mt-6">
                                        <div class="flex justify-between mb-1">
                                            <span class="text-sm font-sm text-white-500">Performance</span>
                                            <span class="text-sm font-sm text-white-500">97%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-green-500 h-2.5 rounded-full" style="width: 97%"></div>
                                        </div>
                                    </div>

                                    <div class="mt-6 flex space-x-3">
                                        <button
                                            class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                            Review
                                        </button>
                                        <button
                                            class="p-2 text-green-500 hover:bg-gray-100 rounded-lg focus:outline-none">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- card end-->
                            <!-- card start-->
                            <div class="rounded-xl bg-dark shadow-md overflow-hidden exam-card" id="subject_card">
                                <div class="bg-gradient-to-r from-green-500 to-green-400 h-2"></div>
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-bold text-gray-800 text-white">
                                            Front End
                                        </h3>
                                        <div
                                            class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                            coming soon
                                        </div>
                                    </div>
                                    <p class="text-gray-600 mb-4 text-white" style="height: 50px; overflow: auto">
                                        html ,css, bootstrap , javascript , react ,
                                    </p>
                                    <div class="flex items-center mb-4">
                                        <i class="fas fa-calendar-alt text-green-400 mr-2"></i>
                                        <span class="text-sm text-white-500">April 10, 2024 - 10:00 AM</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-check-circle text-green-400 mr-2"></i>
                                        <span class="text-sm text-white-500">Score: 93/100</span>
                                    </div>
                                    <div class="mt-6">
                                        <div class="flex justify-between mb-1">
                                            <span class="text-sm font-sm text-white-500">Performance</span>
                                            <span class="text-sm font-sm text-white-500">97%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-green-500 h-2.5 rounded-full" style="width: 97%"></div>
                                        </div>
                                    </div>

                                    <div class="mt-6 flex space-x-3">
                                        <button
                                            class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                            Review
                                        </button>
                                        <button
                                            class="p-2 text-green-500 hover:bg-gray-100 rounded-lg focus:outline-none">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- card end-->
                            <!-- card start-->
                            <div class="rounded-xl bg-dark shadow-md overflow-hidden exam-card" id="subject_card">
                                <div class="bg-gradient-to-r from-green-500 to-green-400 h-2"></div>
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-bold text-gray-800 text-white">
                                            Back End
                                        </h3>
                                        <div
                                            class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                            coming soon
                                        </div>
                                    </div>
                                    <p class="text-gray-600 mb-4 text-white" style="height: 50px; overflow: auto">
                                        Mysql , PhP , Laravel
                                    </p>
                                    <div class="flex items-center mb-4">
                                        <i class="fas fa-calendar-alt text-green-400 mr-2"></i>
                                        <span class="text-sm text-white-500">April 10, 2024 - 10:00 AM</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-check-circle text-green-400 mr-2"></i>
                                        <span class="text-sm text-white-500">Score: 93/100</span>
                                    </div>
                                    <div class="mt-6">
                                        <div class="flex justify-between mb-1">
                                            <span class="text-sm font-sm text-white-500">Performance</span>
                                            <span class="text-sm font-sm text-white-500">97%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-green-500 h-2.5 rounded-full" style="width: 97%"></div>
                                        </div>
                                    </div>

                                    <div class="mt-6 flex space-x-3">
                                        <button
                                            class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                            Review
                                        </button>
                                        <button
                                            class="p-2 text-green-500 hover:bg-gray-100 rounded-lg focus:outline-none">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- card end-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap 5 JavaScript Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- User Profile Dropdown JavaScript -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Show welcome alert when page loads
            showWelcomeAlert();

            const userAvatar = document.getElementById("userAvatar");
            const userDropdown = document.getElementById("userDropdown");
            let isDropdownOpen = false;

            // Toggle dropdown on avatar click
            userAvatar.addEventListener("click", function (e) {
                e.stopPropagation();
                toggleDropdown();
            });

            // Close dropdown when clicking outside
            document.addEventListener("click", function (e) {
                if (
                    !userAvatar.contains(e.target) &&
                    !userDropdown.contains(e.target)
                ) {
                    closeDropdown();
                }
            });

            // Handle dropdown item clicks
            const dropdownItems = document.querySelectorAll(".dropdown-item");
            dropdownItems.forEach((item) => {
                item.addEventListener("click", function () {
                    const action = this.querySelector("span").textContent.toLowerCase();
                    handleDropdownAction(action);
                    closeDropdown();
                });
            });

            function toggleDropdown() {
                if (isDropdownOpen) {
                    closeDropdown();
                } else {
                    openDropdown();
                }
            }

            function openDropdown() {
                userDropdown.classList.add("show");
                userAvatar.classList.add("active");
                isDropdownOpen = true;
            }

            function closeDropdown() {
                userDropdown.classList.remove("show");
                userAvatar.classList.remove("active");
                isDropdownOpen = false;
            }

            function handleDropdownAction(action) {
                switch (action) {
                    case "profile":
                        // Already on profile page
                        console.log("Already on profile page");
                        break;
                    case "settings":
                        // Add settings page navigation here
                        console.log("Settings clicked");
                        break;
                    case "logout":
                        window.location.href = "./signin.html";
                        break;
                    default:
                        console.log("Unknown action:", action);
                }
            }

            // Close dropdown on escape key
            document.addEventListener("keydown", function (e) {
                if (e.key === "Escape" && isDropdownOpen) {
                    closeDropdown();
                }
            });
        });

        // Welcome Alert Functions
        function showWelcomeAlert() {
            const alert = document.getElementById("welcomeAlert");

            // Show alert with smooth animation
            setTimeout(() => {
                alert.classList.add("show");
            }, 100);

            // Auto-hide alert after 8 seconds (longer for full-screen experience)
            setTimeout(() => {
                hideWelcomeAlert();
            }, 2000);
        }

        function hideWelcomeAlert() {
            const alert = document.getElementById("welcomeAlert");
            alert.classList.add("hide");

            // Remove alert from DOM after animation completes
            setTimeout(() => {
                alert.remove();
            }, 1000);
        }

        function continueToProfile() {
            // Hide the welcome alert and show the profile content
            hideWelcomeAlert();
        }
    </script>



    {{-- body datted animation start --}}
    <script>
        function createParticles(count = 50) {
            const container = document.getElementById("particles");
            container.innerHTML = ""; // Clear existing particles

            for (let i = 0; i < count; i++) {
                const p = document.createElement("div");
                p.className = "particle";
                p.style.left = Math.random() * 100 + "%";
                p.style.animationDelay = Math.random() * 5 + "s";
                p.style.animationDuration = Math.random() * 3 + 3 + "s";
                container.appendChild(p);
            }
        }

        // Run after DOM is ready
        document.addEventListener("DOMContentLoaded", () => {
            createParticles(30); // You can change number of particles
        });
    </script>
    {{-- body datted animation end --}}





</body>

</html>