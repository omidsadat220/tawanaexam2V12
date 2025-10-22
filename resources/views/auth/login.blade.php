<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Advanced Authentication System | Service</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('favicon-32x32.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <!-- <link rel="stylesheet" href="./css/signin.css"> -->
    <style>
        * {
            font-family: "IranSans", sans-serif;
            box-sizing: border-box;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html,
        body {
            overflow-x: hidden;
            width: 100%;
            max-width: 100vw;
            background: linear-gradient(135deg,
                    #0a0a0a 0%,
                    #1a1a1a 50%,
                    #0f0f0f 100%);
        }

         /* Responsive for screens smaller than 720px */
            @media (max-width: 720px) {
            .center {
                width: 90%;
                padding: 20px 30px;
                font-size: 16px;
            }
            }
        

        /* Advanced Background with Animated Gradients */
        .auth-container {
            overflow-x: hidden !important;
            overflow-y: hidden;

            background-size: cover;
            animation: gradientShift 15s ease infinite;
            height: 100vh;
            position: relative;
        }

        #container_login {
            max-width: 100vw;
            background-image: url("{{ asset('assets/img/login_bg.png') }}");
            background-repeat: no-repeat;
            background-position: center;
            background-size: 100% 100%;
            background-color: rgb(38, 38, 38);
            /* background-color: red; */
            max-width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: end !important;
            align-items: center;
            position: relative;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        /* Advanced Glass Card */
        @media (min-width: 999px) {

            .auth-card {
                background-color: rgb(38, 38, 38);
                border: 1px solid rgba(0, 255, 94, 0.5);
                width: 22rem;
                height: 30rem;

                position: absolute;
                right: -60% !important;
             
                /* box-shadow: 0px 0px 20px #16a34a; */
            }

        }


        @media (min-width: 370px) {
         
         
            .auth-card {
                background-color: rgb(38, 38, 38);
                border: 1px solid rgba(0, 255, 94, 0.5);
                width: 22rem;
                height: 30rem;
                position:absolute;
                right:0;
                left:0;
                   bottom: 19%;
            }

        }

        


        .auth-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg,
                    transparent,
                    rgba(34, 197, 94, 0.1),
                    transparent);
            transition: left 0.5s;
        }

        .auth-card::after {
            content: "";
            position: absolute;
            top: -20px;
            left: -20px;
            right: -20px;
            bottom: -20px;
            background: radial-gradient(circle at center,
                    rgba(34, 197, 94, 0.3) 0%,
                    transparent 70%);
            z-index: -1;
            filter: blur(20px);
            animation: glowPulse 3s ease-in-out infinite;
        }

        @keyframes glowPulse {

            0%,
            100% {
                opacity: 0.5;
                transform: scale(1);
            }

            50% {
                opacity: 0.8;
                transform: scale(1.05);
            }
        }

        .auth-card:hover::before {
            left: 100%;
        }

        /* Advanced Tab Design */
        .tab-selector {
            background: linear-gradient(135deg,
                    rgba(30, 41, 59, 0.9) 0%,
                    rgba(15, 23, 42, 0.9) 100%);
            border-bottom: 1px solid rgba(34, 197, 94, 0.2);
            position: relative;
            display: flex;
            width: 100%;
            overflow: hidden;
        }

        .tab-item {
            position: relative;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .tab-item::before {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, #22c55e, #16a34a);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform: translateX(-50%);
        }

        .tab-item.active::before {
            width: 100%;
        }

        .tab-item:hover {
            background: rgba(34, 197, 94, 0.1);
            transform: translateY(-1px);
        }

        /* Advanced Input Fields */
        .input-group {
            position: relative;
            margin-top: 0;
            margin-bottom: 1.5rem;
            /* background-color: yellow; */
        }

        .input-field {
            width: 100%;
            padding: 0.7rem 1rem 0.7rem 4rem;
            background: rgba(30, 41, 59, 0.6);
            border: 2px solid rgba(34, 197, 94, 0.2);
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
            box-sizing: border-box;
            min-width: 0;
            /* margin-left: -5%; */
        }

        .input-field:focus {
            outline: none;
            border-color: #22c55e;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.1),
                0 8px 25px rgba(34, 197, 94, 0.2);
            transform: translateY(-2px);
        }

        .input-field::placeholder {
            color: rgba(156, 163, 175, 0.7);
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #22c55e;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .input-field:focus+.input-icon {
            color: #16a34a;
            transform: translateY(-50%) scale(1.1);
        }

        /* Advanced Button Design */
        .auth-btn {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            border: none;
            width: 80%;
            border-radius: 12px;
            padding: 0.7rem 1rem;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
            box-sizing: border-box;
            min-width: 0;
            margin-left: 10%;
        }

        .auth-btn::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg,
                    transparent,
                    rgba(255, 255, 255, 0.2),
                    transparent);
            transition: left 0.5s;
        }

        .auth-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(34, 197, 94, 0.4),
                0 0 0 1px rgba(34, 197, 94, 0.2);
        }

        .auth-btn:hover::before {
            left: 100%;
        }

        .auth-btn:active {
            transform: translateY(-1px);
        }

        /* Advanced Checkbox Design */
        .custom-checkbox {
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            flex-wrap: nowrap;
        }

        .custom-checkbox input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .checkmark {
            position: relative;
            width: 20px;
            height: 20px;
            background: rgba(30, 41, 59, 0.6);
            border: 2px solid rgba(34, 197, 94, 0.3);
            border-radius: 4px;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .custom-checkbox input:checked~.checkmark {
            background: #22c55e;
            border-color: #22c55e;
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
            left: 6px;
            top: 2px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .custom-checkbox input:checked~.checkmark:after {
            display: block;
        }

        /* Advanced Verification Code Input */
        .code-input {
            width: 3.5rem;
            height: 3.5rem;
            margin: 0 0.5rem;
            font-size: 1.5rem;
            text-align: center;
            background: rgba(30, 41, 59, 0.6);
            border: 2px solid rgba(34, 197, 94, 0.3);
            border-radius: 12px;
            color: white;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
            box-sizing: border-box;
            min-width: 0;
        }

        .code-input:focus {
            border-color: #22c55e;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.1),
                0 8px 25px rgba(34, 197, 94, 0.2);
            transform: scale(1.05);
            outline: none;
        }

        /* Advanced Loading Animation */
        .loader {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(34, 197, 94, 0.2);
            border-top: 3px solid #22c55e;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Advanced Success Animation */
        .success-icon {
            animation: successPop 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        @keyframes successPop {
            0% {
                transform: scale(0);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Advanced Page Transitions */
        .page {
            animation: slideIn 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            /* border: 1px solid black; */
            /* overflow-y: scroll; */
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Advanced Link Hover Effects */
        .link-hover {
            position: relative;
            transition: all 0.3s ease;
        }

        .link-hover::after {
            content: "";
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #22c55e, #16a34a);
            transition: width 0.3s ease;
        }

        .link-hover:hover::after {
            width: 100%;
        }

        @media (max-width: 1200px) {
            .auth-card {
                background-color: rgb(38, 38, 38);
                position: absolute;
              <!--  right: 2%;-->
                bottom: 13%;
                /* box-shadow: 0px 0px 20px #16a34a; */
            }
        }

        /* Advanced Responsive Design */
        @media (max-width: 768px) {
            .auth-container {
                overflow-x: hidden;
                width: 100vw;
            }

            .auth-card {
                margin: 0.5rem;
                border-radius: 16px;
                width: 90%;
                max-width: 440px;
                min-width: 352px;
               
            }

            .container {
                padding: 0.5rem;
                width: 100vw;
                max-width: 100vw;
                overflow-x: hidden;
                display:flex;
                align-items:center;
                justify-content:center;
            }

            .input-field {
                padding: 0.875rem 0.875rem 0.875rem 2.5rem;
                font-size: 0.95rem;
                width: 100%;
                box-sizing: border-box;
                /* margin-left: -5%; */
            }

            .input-icon {
                left: 0.875rem;
                font-size: 1rem;
            }

            .code-input {
                width: 2.75rem;
                height: 2.75rem;
                font-size: 1.1rem;
                margin: 0 0.25rem;
                box-sizing: border-box;
            }

            .tab-item {
                padding: 0.75rem 0.5rem;
                font-size: 0.9rem;
                min-width: 0;
                flex: 1;
            }

            .tab-item i {
                font-size: 0.9rem;
            }

            h2 {
                font-size: 1.75rem !important;
                word-wrap: break-word;
            }

            .w-16 {
                width: 3rem;
                height: 3rem;
            }

            .w-16 i {
                font-size: 1.25rem;
            }

            /* Fix Remember me alignment */
            .custom-checkbox {
                align-items: center;
                gap: 0.5rem;
            }

            .checkmark {
                flex-shrink: 0;
            }

            .typing {
                top: 15%;
                display: none;
            }
        }

        @media (max-width: 480px) {
            .auth-container {
                overflow-x: hidden;
                width: 100vw;
            }

            .auth-card {
                margin:auto;
                border-radius: 12px;
                width: 95%;
                max-width: 385px;
                min-width: 308px;
            }

            .container {
                padding: 0.25rem;
                width: 100vw;
                max-width: 100vw;
                overflow-x: hidden;
            }

            .input-field {
                padding: 0.75rem 0.75rem 0.75rem 2.25rem;
                font-size: 0.9rem;
                width: 100%;
                box-sizing: border-box;
                min-width: 0;
            }

            .input-icon {
                left: 0.75rem;
                font-size: 0.9rem;
            }

            .code-input {
                width: 2.5rem;
                height: 2.5rem;
                font-size: 1rem;
                margin: 0 0.2rem;
                box-sizing: border-box;
                min-width: 0;
            }

            .tab-item {
                padding: 0.5rem 0.25rem;
                font-size: 0.85rem;
            }

            .tab-item i {
                font-size: 0.85rem;
                margin-right: 0.25rem;
            }

            h2 {
                font-size: 1.5rem !important;
            }

            .w-16 {
                width: 2.5rem;
                height: 2.5rem;
            }

            .w-16 i {
                font-size: 1rem;
            }

            .checkmark {
                width: 16px;
                height: 16px;
            }

            .checkmark:after {
                left: 5px;
                top: 1px;
                width: 4px;
                height: 8px;
            }
        }

    

        @media (max-width: 360px) {
            .auth-container {
                overflow-x: hidden;
                width: 100vw;
            }

            .auth-card {
                
                border-radius: 8px;
                width: 98%;
                max-width: 352px;
                min-width: 286px;
                margin: auto;
            }

            .container {
                padding: 0.125rem;
                width: 100vw;
                max-width: 100vw;
                overflow-x: scroll;
            }

            .input-field {
                padding: 0.625rem 0.625rem 0.625rem 2rem;
                font-size: 0.85rem;
                width: 110%;
                box-sizing: border-box;
                min-width: 0;
            }

            .input-icon {
                left: 0.625rem;
                font-size: 0.85rem;
            }

            .code-input {
                width: 2.25rem;
                height: 2.25rem;
                font-size: 0.9rem;
                margin: 0 0.15rem;
                box-sizing: border-box;
                min-width: 0;
            }

            .tab-item {
                padding: 0.375rem 0.125rem;
                font-size: 0.8rem;
            }

            .tab-item i {
                font-size: 0.8rem;
                margin-right: 0.125rem;
            }

            h2 {
                font-size: 1.25rem !important;
            }

            .w-16 {
                width: 2rem;
                height: 2rem;
            }

            .w-16 i {
                font-size: 0.875rem;
            }
        }

        /* Advanced Error States */
        .error-shake {
            animation: shake 0.5s cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
        }

        @keyframes shake {

            10%,
            90% {
                transform: translate3d(-1px, 0, 0);
            }

            20%,
            80% {
                transform: translate3d(2px, 0, 0);
            }

            30%,
            50%,
            70% {
                transform: translate3d(-4px, 0, 0);
            }

            40%,
            60% {
                transform: translate3d(4px, 0, 0);
            }
        }

        /* Advanced Password Strength Indicator */
        .password-strength {
            height: 4px;
            background: rgba(30, 41, 59, 0.6);
            border-radius: 2px;
            margin-top: 0.5rem;
            overflow: hidden;
        }

        .strength-bar {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak {
            background: #ef4444;
            width: 25%;
        }

        .strength-medium {
            background: #f59e0b;
            width: 50%;
        }

        .strength-strong {
            background: #22c55e;
            width: 75%;
        }

        .strength-very-strong {
            background: #16a34a;
            width: 100%;
        }

        /* confirm password start-------------------------------------------------- */
        .strength-barc {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak {
            background: #ef4444;
            width: 25%;
        }

        .strength-medium {
            background: #f59e0b;
            width: 50%;
        }

        .strength-strong {
            background: #22c55e;
            width: 75%;
        }

        .strength-very-strong {
            background: #16a34a;
            width: 100%;
        }

        /* confirm password end-------------------------------------------------- */

        /* new added */
        #loginEmail::placeholder {
            color: #16a34a;
        }

        /* new added */
        #loginPassword::placeholder {
            color: #16a34a;
        }

        /* social media css start ------------------------------------------------ */
        .wrapper {
            /* border: 1px solid green; */
            /* background-color: rgba(60, 255, 0, 0.308); */
            position: absolute;
            bottom: 5%;
        }

        .wrapper .button {
            display: inline-block;
            height: 60px;
            width: 60px;
            float: left;
            text-decoration: none;
            margin: 0 5px;
            overflow: hidden;
            background: transparent;
            border-radius: 50px;
            cursor: pointer;
            box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-out;
            border: 1px solid green;
        }

        .wrapper .button:hover {
            width: 200px;
            background: #16a34a15;
        }

        .wrapper .button .icon {
            display: inline-block;
            height: 60px;
            width: 60px;
            color: #16a34a;
            text-align: center;
            border-radius: 50px;
            box-sizing: border-box;
            line-height: 60px;
            transition: all 0.3s ease-out;
        }

        .wrapper .button:nth-child(1):hover {
            border: 1px solid #4267b2;
        }

        .wrapper .button:nth-child(2):hover {
            border: 1px solid #1da1f2;
        }

        .wrapper .button:nth-child(3):hover {
            border: 1px solid#e1306c;
        }

        .wrapper .button:nth-child(4):hover {
            border: 1px solid#4267b2;
        }

        .wrapper .button:nth-child(5):hover {
            border: 1px solid#ff0000;
        }

        .wrapper .button:nth-child(1):hover .icon {
            background: #4267b2;
        }

        .wrapper .button:nth-child(2):hover .icon {
            background: #1da1f2;
        }

        .wrapper .button:nth-child(3):hover .icon {
            background: #e1306c;
        }

        .wrapper .button:nth-child(4):hover .icon {
            background: #4267b2;
        }

        .wrapper .button:nth-child(5):hover .icon {
            background: #ff0000;
        }

        .wrapper .button .icon i {
            font-size: 25px;
            line-height: 60px;
            transition: all 0.3s ease-out;
        }

        .wrapper .button:hover .icon i {
            color: #fff;
        }

        .wrapper .button span {
            font-size: 20px;
            font-weight: 500;
            line-height: 60px;
            margin-left: 10px;
            transition: all 0.3s ease-out;
        }

        .wrapper .button:nth-child(1) span {
            color: #4267b2;
        }

        .wrapper .button:nth-child(2) span {
            color: #1da1f2;
        }

        .wrapper .button:nth-child(3) span {
            color: #e1306c;
        }

        .wrapper .button:nth-child(4) span {
            color: #fff;
        }

        .wrapper .button:nth-child(5) span {
            color: #ff0000;
        }

        @media (max-width: 992px) {
            .wrapper {
                position: absolute;
                bottom: 5%;
            }

            .wrapper .button {
                display: inline-block;
                height: 40px;
                width: 40px;
            }

            .wrapper .button:hover {
                width: 40px;
                background: #16a34a15;
            }

            .wrapper .button .icon {
                height: 40px;
                width: 40px;
                transition: all 0.3s ease-out;
                /* background-color: blue; */
                display: flex;
                flex-direction: row;
                justify-content: center;
                align-items: center;
            }

            .wrapper .button .icon i {
                font-size: 20px;
                line-height: 20px;
            }
        }

        /* social media css end ----------------------------------------------- */
        /* auto type css start ------------------------------------------------ */
        .typing {
            font-size: 50px;
            font-weight: bold;
            position: absolute;
            top: 15%;
            font-family: "Tempus Sans ITC";
            color: #16a34a;
            font-weight: 900;
            letter-spacing: 1px;
        }

        #text {
            font-weight: bold;
            font-family: "Tempus Sans ITC";
            color: #16a34a;
            font-weight: 900;
            letter-spacing: 1px;
        }

        .cursor {
            display: inline-block;
            width: 2px;
            height: 1em;
            background: #16a34a;
            margin-left: 3px;
            animation: blink 0.8s infinite;
        }

        @keyframes blink {

            0%,
            50% {
                opacity: 1;
            }

            50.1%,
            100% {
                opacity: 0;
            }
        }

        /* auto type css end -------------------------------------------------- */

        /* <!-- body animation datted css start --> */

        /* Container for particles */
        .floating-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            /* Allow clicks through */
            z-index: 0;
            /* Behind all elements */
            overflow: hidden;
            /* background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%); */
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

        /* <!-- body animation datted css end --> */

        

    </style>
</head>

<body class="min-h-screen auth-container">
    <div class="container" id="container_login">
        <!-- auto type -->
        <div class="typing">
             <span id="text"> </span><span class="cursor"></span>
        </div>
        <!-- auto type -->
        <!-- login card -->
        <div class="auth-card max-w-sm mx-auto rounded-2xl shadow-2xl overflow-hidden " >
            <!-- Advanced Tab Selector -->
            <div class="tab-selector flex " >
                <div class="tab-item flex-1 text-center py-4 cursor-pointer active text-white"
                    onclick="showPage('loginPage')" style="background-color: rgb(38, 38, 38)">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </div>
                <div class="tab-item flex-1 text-center py-4 cursor-pointer text-white" onclick="showPage('signupPage')"
                    style="background-color: rgb(38, 38, 38)">
                    <i class="fas fa-user-plus mr-2"></i>Sign Up
                </div>
            </div>

            <!-- Advanced Loading State -->
            <div id="loadingState" class="hidden p-8">
                <div class="flex flex-col items-center justify-center py-12">
                    <div class="loader mb-6"></div>
                    <p class="text-gray-300 text-lg font-medium">
                        Processing your request...
                    </p>
                    <div class="mt-4 flex space-x-2">
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-bounce"></div>
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-bounce" style="animation-delay: 0.1s">
                        </div>
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-bounce" style="animation-delay: 0.2s">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div id="mainContent" class="px-8">
                <!-- Login Page -->

                <form method="POST" id="loginPage" class="page mt-5" action="{{ route('login') }}">
                    @csrf
                    <div class="text-center mb-4">

                        <h2 class="text-3xl font-bold text-white pt-4">Welcome Back</h2>
                        <p class="text-gray-400">Sign in to your account</p>
                    </div>

                    <div class="input-group">
                        <input type="email" id="loginEmail" name="email" class="input-field"
                            placeholder="Enter your email" style="background-color: transparent" />
                        <i class="fas fa-envelope input-icon"></i>
                        <p id="loginEmailError" class="hidden text-sm text-red-400 mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>The entered email
                            is not valid
                        </p>
                    </div>

                    <div class="input-group">
                        <input type="password" name="password" id="loginPassword" class="input-field"
                            placeholder="Enter your password" style="background-color: transparent" />
                        <i class="fas fa-lock input-icon"></i>
                        <button type="button"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-green-500 transition-colors"
                            onclick="togglePasswordVisibility('loginPassword')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <p id="loginPasswordError" class="hidden text-sm text-red-400 mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>Password must be
                            at least 8 characters
                        </p>
                    </div>

                    <div class="flex items-center justify-between mb-5">
                        <label class="custom-checkbox flex items-center cursor-pointer">
                            <input type="checkbox" id="rememberMe" />
                            <span class="checkmark mr-3"></span>
                            <span class="text-sm text-gray-300">Remember me</span>
                        </label>
                        <button id="forgotPasswordBtn"
                            class="text-sm text-green-500 hover:text-green-400 link-hover font-medium"
                            onclick="showPage('forgotPasswordPage')">
                            Forgot Password?
                        </button>
                    </div>

                    <button type="submit" class="auth-btn text-lg">
                        <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                    </button>
                </form>

                <!-- Signup Page -->
                {{-- <form id="signupPage" class="page hidden mt-3 bg-info"> --}}
                    <form method="POST" action="{{ route('register') }}" id="signupPage"
                        class="page hidden mt-3 bg-info ">
                        @csrf
                        <div class="text-center">

                            <h2 class="text-3xl font-bold text-white mb-3 mt-5">
                                Create Account
                            </h2>

                        </div>
                        {{-- user name --}}
                        <div class="input-group">
                            <input type="text" name="name" id="name" class="input-field"
                                placeholder="Enter your username" required style="background-color: transparent" />
                            <i class="fas fa-user input-icon"></i>
                            <p id="signupUsernameError" class="hidden text-sm text-red-400 mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>Username must be
                                at least 3 characters
                            </p>
                        </div>
                        {{-- email --}}
                        <div class="input-group">
                            <input type="email" name="email" id="email" class="input-field" required
                                placeholder="Enter your email" style="background-color: transparent" />
                            <i class="fas fa-envelope input-icon"></i>
                            <p id="signupEmailError" class="hidden text-sm text-red-400 mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>The entered email
                                is not valid
                            </p>
                        </div>
                        <!-- enter passwd -->
                        <div class="input-group">
                            <input type="password" name="password" id="signupPassword" class="input-field"
                                placeholder="Create a strong password" style="background-color: transparent" required />
                            <i class="fas fa-lock input-icon"></i>
                            <button type="button"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-green-500 transition-colors"
                                onclick="togglePasswordVisibility('signupPassword')">
                                <i class="fas fa-eye"></i>
                            </button>
                            {{-- <div class="password-strength">
                                <div id="strengthBar" class="strength-bar"></div>
                            </div> --}}

                        </div>
                        <!-- confirm passwd -->
                        <div class="input-group" style="margin-top: -15px">
                            <input type="password" name="password_confirmation" id="signupConfirmPassword"
                                class="input-field" placeholder="Confirm Password "
                                style="background-color: transparent" required />
                            <i class="fas fa-lock input-icon"></i>
                            <button type="button"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-green-500 transition-colors"
                                onclick="togglePasswordVisibility('signupConfirmPassword')">
                                <i class="fas fa-eye"></i>
                            </button>

                            {{-- <p id="signupPasswordError" class="hidden text-sm text-red-400 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>Password must be
                                at least 8 characters
                            </p> --}}
                        </div>

                        <button id="signupBtn" class="auth-btn text-lg">
                            <i class="fas fa-user-plus mr-2"></i>Create Account
                        </button>


                    </form>

                    <!-- Forgot Password Page -->
                    <form id="forgotPasswordPage" class="page hidden pt-5">
                        <div class="text-center mb-8">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-key text-white text-2xl"></i>
                            </div>
                            <h2 class="text-3xl font-bold text-white mb-2">Reset Password</h2>
                            <p class="text-gray-400">
                                Enter your email to receive a reset link
                            </p>
                        </div>

                        <div class="input-group">
                            <input type="email" id="forgotEmail" class="input-field" placeholder="Enter your email" />
                            <i class="fas fa-envelope input-icon"></i>
                            <p id="forgotEmailError" class="hidden text-sm text-red-400 mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>The entered email
                                is not valid
                            </p>
                        </div>

                        <button id="sendResetLinkBtn" class="auth-btn text-lg">
                            <i class="fas fa-paper-plane mr-2"></i>Send Reset Link
                        </button>

                        <div class="text-center mt-8">
                            <button id="backToLoginBtn"
                                class="text-green-500 hover:text-green-400 link-hover font-medium"
                                onclick="showPage('loginPage')">
                                <i class="fas fa-arrow-left mr-2"></i>Back to Login
                            </button>
                        </div>
                    </form>

                    <!-- Verification Page -->
                    <form id="verificationPage" class="page hidden pt-3">
                        <div class="text-center mb-4">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-shield-alt text-white text-2xl"></i>
                            </div>
                            <h2 class="text-3xl font-bold text-white mb-2">
                                Two-Factor Verification
                            </h2>
                            <p class="text-gray-400">Enter the 6-digit code sent to</p>
                            <p class="text-green-500 font-medium" id="verificationEmail">
                                example@example.com
                            </p>
                        </div>

                        <div class="flex justify-center mb-4">
                            <input type="text" maxlength="1" class="code-input" oninput="moveToNext(this, 'code2')"
                                onkeydown="moveToPrevious(event, this)" />
                            <input type="text" maxlength="1" id="code2" class="code-input"
                                oninput="moveToNext(this, 'code3')" onkeydown="moveToPrevious(event, this)" />
                            <input type="text" maxlength="1" id="code3" class="code-input"
                                oninput="moveToNext(this, 'code4')" onkeydown="moveToPrevious(event, this)" />
                            <input type="text" maxlength="1" id="code4" class="code-input"
                                oninput="moveToNext(this, 'code5')" onkeydown="moveToPrevious(event, this)" />
                            <input type="text" maxlength="1" id="code5" class="code-input"
                                oninput="moveToNext(this, 'code6')" onkeydown="moveToPrevious(event, this)" />
                            <input type="text" maxlength="1" id="code6" class="code-input"
                                onkeydown="moveToPrevious(event, this)" />
                        </div>

                        <button id="verifyBtn" class="auth-btn text-lg">
                            <i class="fas fa-check mr-2"></i>Verify Code
                        </button>

                        <div class="text-center mt-1">
                            <span class="text-gray-400">Didn't receive the code? </span>
                            <button id="resendCodeBtn"
                                class="text-green-500 hover:text-green-400 link-hover font-medium">
                                Resend Code
                            </button>
                        </div>
                    </form>

                    <!-- Success Message -->
                    <div id="successMessage" class="hidden p-8">
                        <div class="flex flex-col items-center justify-center py-12">
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center mb-6 success-icon">
                                <i class="fas fa-check text-white text-3xl"></i>
                            </div>
                            <h3 id="successTitle" class="text-2xl font-bold text-white mb-4">
                                Success!
                            </h3>
                            <p id="successText" class="text-center text-gray-300 mb-8">
                                Operation completed successfully
                            </p>
                            <button id="successActionBtn" class="auth-btn">
                                <i class="fas fa-arrow-right mr-2"></i>Continue
                            </button>
                        </div>
                    </div>
            </div>
        </div>
        <!-- login card -->

        <!-- social media -->
        <div class="wrapper">
            <a href="#" class="button">
                <div class="icon">
                    <i class="fab fa-facebook-f"></i>
                </div>
                <span>Facebook</span>
            </a>
            <a href="#" class="button">
                <div class="icon">
                    <i class="fa-brands fa-x-twitter"></i>
                </div>
                <span>Twitter</span>
            </a>
            <a href="#" class="button">
                <div class="icon">
                    <i class="fab fa-instagram"></i>
                </div>
                <span>Instagram</span>
            </a>
            <a href="#" class="button">
                <div class="icon">
                    <i class="fa-brands fa-telegram"></i>
                </div>
                <span>Telegram</span>
            </a>
            <a href="#" class="button">
                <div class="icon">
                    <i class="fab fa-youtube"></i>
                </div>
                <span>YouTube</span>
            </a>
        </div>
    </div>
    <div class="floating-particles" id="particles"></div>

    <script>
        // Password visibility toggle
        function togglePasswordVisibility(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.parentElement.querySelector("button i");

            if (input.type === "password") {
                input.type = "text";
                icon.className = "fas fa-eye-slash";
            } else {
                input.type = "password";
                icon.className = "fas fa-eye";
            }
        }

        // Password strength indicator
        function updatePasswordStrength(password) {
            const strengthBar = document.getElementById("strengthBar");
            if (!strengthBar) return;

            let strength = 0;
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            strengthBar.className = "strength-bar";
            if (strength <= 1) {
                strengthBar.classList.add("strength-weak");
            } else if (strength <= 2) {
                strengthBar.classList.add("strength-medium");
            } else if (strength <= 3) {
                strengthBar.classList.add("strength-strong");
            } else {
                strengthBar.classList.add("strength-very-strong");
            }
        }

        // Verification code navigation
        function moveToNext(current, nextId) {
            if (current.value.length === 1) {
                document.getElementById(nextId).focus();
            }
        }

        function moveToPrevious(event, current) {
            if (event.key === "Backspace" && current.value.length === 0) {
                const prev = current.previousElementSibling;
                if (prev) {
                    prev.focus();
                }
            }
        }

        // Show page function with advanced animations
        function showPage(pageId) {
            const pages = document.querySelectorAll(".page");
            const tabs = document.querySelectorAll(".tab-item");

            // Update tab states
            tabs.forEach((tab) => {
                tab.classList.remove("active");
            });

            if (pageId === "loginPage") {
                tabs[0].classList.add("active");
            } else if (pageId === "signupPage") {
                tabs[1].classList.add("active");
            }

            // Hide all pages with animation
            pages.forEach((page) => {
                page.style.opacity = "0";
                page.style.transform = "translateY(20px)";
                setTimeout(() => {
                    page.classList.add("hidden");
                }, 200);
            });

            // Show target page with animation
            setTimeout(() => {
                const targetPage = document.getElementById(pageId);
                targetPage.classList.remove("hidden");
                setTimeout(() => {
                    targetPage.style.opacity = "1";
                    targetPage.style.transform = "translateY(0)";
                }, 50);
            }, 200);
        }

        // DOM Elements
        const loginPage = document.getElementById("loginPage");
        const signupPage = document.getElementById("signupPage");
        const forgotPasswordPage = document.getElementById("forgotPasswordPage");
        const verificationPage = document.getElementById("verificationPage");
        const successMessage = document.getElementById("successMessage");
        const loadingState = document.getElementById("loadingState");
        const mainContent = document.getElementById("mainContent");

        // Button event listeners
        document.getElementById("loginBtn").addEventListener("click", () => {
            const email = document.getElementById("loginEmail").value;
            const password = document.getElementById("loginPassword").value;

            if (validateLoginForm(email, password)) {
                showLoading();
                simulateServerRequest(() => {
                    hideLoading();
                    document.getElementById("verificationEmail").textContent = email;
                    showPage("verificationPage");
                });
            }
        });

        document.getElementById("signupBtn").addEventListener("click", () => {
            const name = document.getElementById("signupName").value;
            const username = document.getElementById("signupUsername").value;
            const email = document.getElementById("signupEmail").value;
            const password = document.getElementById("signupPassword").value;
            const agreeTerms = document.getElementById("agreeTerms").checked;

            if (
                validateSignupForm(
                    name,
                    username,
                    email,
                    password,
                    confirm,
                    agreeTerms
                )
            ) {
                showLoading();
                simulateServerRequest(() => {
                    hideLoading();

                    // Set success message
                    document.getElementById("successTitle").textContent =
                        "Account Created!";
                    document.getElementById("successText").textContent =
                        "A confirmation email has been sent to " +
                        email +
                        ". Please check your email.";
                    document.getElementById("successActionBtn").innerHTML =
                        '<i class="fas fa-sign-in-alt mr-2"></i>Sign In';

                    // Set success button action
                    document.getElementById("successActionBtn").onclick = () => {
                        document.getElementById("loginEmail").value = email;
                        showPage("loginPage");
                    };

                    showSuccess();
                });
            }
        });

        document
            .getElementById("sendResetLinkBtn")
            .addEventListener("click", () => {
                const email = document.getElementById("forgotEmail").value;

                if (validateEmail(email, "forgotEmailError")) {
                    showLoading();
                    simulateServerRequest(() => {
                        hideLoading();

                        // Set success message
                        document.getElementById("successTitle").textContent =
                            "Reset Link Sent!";
                        document.getElementById("successText").textContent =
                            "A password reset link has been sent to " +
                            email +
                            ". Please check your email.";
                        document.getElementById("successActionBtn").innerHTML =
                            '<i class="fas fa-arrow-left mr-2"></i>Back to Login';

                        // Set success button action
                        document.getElementById("successActionBtn").onclick = () => {
                            showPage("loginPage");
                        };

                        showSuccess();
                    });
                }
            });

        document.getElementById("verifyBtn").addEventListener("click", () => {
            showLoading();
            simulateServerRequest(() => {
                hideLoading();

                // Set success message
                document.getElementById("successTitle").textContent = "Welcome!";
                document.getElementById("successText").textContent =
                    "You have successfully logged in to the system.";
                document.getElementById("successActionBtn").innerHTML =
                    '<i class="fas fa-tachometer-alt mr-2"></i>Go to Dashboard';

                // Set success button action
                document.getElementById("successActionBtn").onclick = () => {
                    alert("Welcome to the dashboard! 🎉");
                    showPage("loginPage");
                };

                showSuccess();
            });
        });

        document.getElementById("resendCodeBtn").addEventListener("click", () => {
            showLoading();
            simulateServerRequest(() => {
                hideLoading();
                alert("Verification code has been resent to your email. 📧");
            });
        });

        // Validation functions
        function validateEmail(email, errorElementId) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const errorElement = document.getElementById(errorElementId);

            if (!email || !emailRegex.test(email)) {
                errorElement.classList.remove("hidden");
                errorElement.parentElement.classList.add("error-shake");
                setTimeout(() => {
                    errorElement.parentElement.classList.remove("error-shake");
                }, 500);
                return false;
            } else {
                errorElement.classList.add("hidden");
                return true;
            }
        }

        function validatePassword(password, errorElementId) {
            const errorElement = document.getElementById(errorElementId);

            if (!password || password.length < 8) {
                errorElement.classList.remove("hidden");
                errorElement.parentElement.classList.add("error-shake");
                setTimeout(() => {
                    errorElement.parentElement.classList.remove("error-shake");
                }, 500);
                return false;
            } else {
                errorElement.classList.add("hidden");
                return true;
            }
        }

        function validateName(name, errorElementId) {
            const errorElement = document.getElementById(errorElementId);

            if (!name || name.length < 3) {
                errorElement.classList.remove("hidden");
                errorElement.parentElement.classList.add("error-shake");
                setTimeout(() => {
                    errorElement.parentElement.classList.remove("error-shake");
                }, 500);
                return false;
            } else {
                errorElement.classList.add("hidden");
                return true;
            }
        }

        function validateUsername(username, errorElementId) {
            const errorElement = document.getElementById(errorElementId);

            if (!username || username.length < 3) {
                errorElement.classList.remove("hidden");
                errorElement.parentElement.classList.add("error-shake");
                setTimeout(() => {
                    errorElement.parentElement.classList.remove("error-shake");
                }, 500);
                return false;
            } else {
                errorElement.classList.add("hidden");
                return true;
            }
        }

        function validateLoginForm(email, password) {
            const emailValid = validateEmail(email, "loginEmailError");
            const passwordValid = validatePassword(password, "loginPasswordError");
            return emailValid && passwordValid;
        }

        function validateSignupForm(name, username, email, password, agreeTerms) {
            const nameValid = validateName(name, "signupNameError");
            const usernameValid = validateUsername(username, "signupUsernameError");
            const emailValid = validateEmail(email, "signupEmailError");
            const passwordValid = validatePassword(password, "signupPasswordError");

            // Check terms agreement
            const termsErrorElement = document.getElementById("agreeTermsError");
            if (!agreeTerms) {
                termsErrorElement.classList.remove("hidden");
                return false;
            } else {
                termsErrorElement.classList.add("hidden");
            }

            return nameValid && usernameValid && emailValid && passwordValid;
        }

        // UI state management functions
        function showLoading() {
            mainContent.style.opacity = "0";
            mainContent.style.transform = "translateY(20px)";
            setTimeout(() => {
                mainContent.classList.add("hidden");
                loadingState.classList.remove("hidden");
            }, 200);
        }

        function hideLoading() {
            loadingState.classList.add("hidden");
            mainContent.classList.remove("hidden");
            setTimeout(() => {
                mainContent.style.opacity = "1";
                mainContent.style.transform = "translateY(0)";
            }, 50);
        }

        function showSuccess() {
            mainContent.style.opacity = "0";
            mainContent.style.transform = "translateY(20px)";
            setTimeout(() => {
                mainContent.classList.add("hidden");
                successMessage.classList.remove("hidden");
            }, 200);
        }

        // Simulate server request
        function simulateServerRequest(callback) {
            setTimeout(() => {
                callback();
            }, 2000);
        }

        // Initialize page
        document.addEventListener("DOMContentLoaded", () => {
            // Add password strength monitoring
            document
                .getElementById("signupPassword")
                .addEventListener("input", (e) => {
                    updatePasswordStrength(e.target.value);
                });

            // Add input validation on blur
            document.getElementById("loginEmail").addEventListener("blur", () => {
                validateEmail(
                    document.getElementById("loginEmail").value,
                    "loginEmailError"
                );
            });

            document
                .getElementById("loginPassword")
                .addEventListener("blur", () => {
                    validatePassword(
                        document.getElementById("loginPassword").value,
                        "loginPasswordError"
                    );
                });

            document.getElementById("signupName").addEventListener("blur", () => {
                validateName(
                    document.getElementById("signupName").value,
                    "signupNameError"
                );
            });

            document
                .getElementById("signupUsername")
                .addEventListener("blur", () => {
                    validateUsername(
                        document.getElementById("signupUsername").value,
                        "signupUsernameError"
                    );

                });

            document.getElementById("signupEmail").addEventListener("blur", () => {
                validateEmail(
                    document.getElementById("signupEmail").value,
                    "signupEmailError"
                );
            });

            document
                .getElementById("signupPassword")
                .addEventListener("blur", () => {
                    validatePassword(
                        document.getElementById("signupPassword").value,
                        "signupPasswordError"
                    );
                });

            document.getElementById("forgotEmail").addEventListener("blur", () => {
                validateEmail(
                    document.getElementById("forgotEmail").value,
                    "forgotEmailError"
                );
            });

            // Initialize with login page
            showPage("loginPage");
        });
    </script>

    <!-- auto type script -->
    <script>
        const textEl = document.getElementById("text");
        const words = ["Tawana Exam Center"];
        let wordIndex = 0;
        let charIndex = 0;
        let deleting = false;

        function typeEffect() {
            const currentWord = words[wordIndex];
            if (!deleting) {
                textEl.textContent = currentWord.slice(0, ++charIndex);
                if (charIndex === currentWord.length) {
                    deleting = true;
                    setTimeout(typeEffect, 1500); // wait before deleting
                    return;
                }
            } else {
                textEl.textContent = currentWord.slice(0, --charIndex);
                if (charIndex === 0) {
                    deleting = false;
                    wordIndex = (wordIndex + 1) % words.length;
                }
            }
            setTimeout(typeEffect, deleting ? 70 : 100);
        }

        typeEffect();
    </script>

    <!-- body animation datted script start -->
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
            createParticles(20); // You can change number of particles
        });
    </script>
    <!-- body animation datted script end -->
</body>

</html>