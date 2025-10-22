<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>TST Exam Center</title>
    <!-- Bootstrap icons CDN for icons used in cards -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cssanimation.io/?animation=ca__fx-clipCircleCollapseOut&category=Clip-Path&theme=dark" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
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
            max-width: 90%;
            background: #1f1f1f;
            /* Darker navbar */
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

        .topbar .user-info a {
            color: #e0e0e0;
            text-decoration: none;
            font-weight: 700;
            margin-left: 8px;
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
            /* background: rgba(76, 175, 80, 0.1); */
            /* border: 1px solid rgba(76, 175, 80, 0.3); */
            transition: all 0.3s ease;
        }

        .user-avatar:hover {
            /* background: rgba(76, 175, 80, 0.2); */
            /* border-color: rgba(76, 175, 80, 0.5); */
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
            right: -15px;
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

        /* Responsive adjustments for dropdown */
        @media (max-width: 768px) {
            .user-avatar {
                padding: 6px 10px;
            }

            .user-name {
                font-size: 0.85rem;
            }

            .dropdown-menu {
                right: -20px;
                min-width: 180px;
            }
        }

        /* Main banner container and content */
        .banner-container {
            max-width: 90%;
            height: 50vh;
            margin: 1rem auto;
            background: #1f1f1f;
            /* Dark background for banner */
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
            border-radius: 3px;
            overflow: hidden;
            display: flex;
            align-items: center;
            border-bottom: 10px double #2e7d32;
            /* Green border */
            border-top: 10px double #2e7d32;
            /* Green border */
        }

        /* Left image side */
        .banner-image {
            flex: 1 1 60%;
            filter: grayscale(100%);
            max-height: 95%;
            object-fit: cover;
            display: block;
            width: 100%;
        }

        /* Right background area with text */
        .banner-text-area {
            flex: 1 1 40%;
            background: linear-gradient(135deg,
                    #4caf50,
                    #2e7d32);
            /* Green gradient */
            color: white;
            font-weight: 700;
            font-size: 1.8rem;
            font-family: "Tempus Sans ITC";
            letter-spacing: 1px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 95%;
            clip-path: polygon(13% 0, 100% 0%, 100% 100%, 0% 100%);
            padding: 0 1rem;
            text-align: center;
        }

        /* Section title "Home" */
        .section-title {
            max-width: 90%;
            margin: 2rem auto 1rem;
            font-weight: 700;
            font-size: 1.25rem;
        }

        /* Cards container */
        .cards-container {
            max-width: 90%;
            margin: 0 auto 3rem;
            display: flex;
            gap: 1.25rem;
            flex-wrap: wrap;
            justify-content: start;
        }

        /* Each card styling */
        .card-custom {
            flex: 1 1 180px;
            max-width: 25%;
            border-radius: 1rem;
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            cursor: pointer;
            transform: scale(1.05) rotateY(15deg);
            filter: drop-shadow(inset 5px 5px 50px rgba(74, 222, 128, 0.3));
            box-shadow: inset 0 6.7px 5.3px rgba(0, 0, 0, 0.1),
                0 12.5px 10px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            /* background: rgba(8, 221, 15, 0.349);
        box-shadow: 0 0px 15px rgba(10, 244, 57, 0.628),
          0 0px 15px rgba(10, 244, 57, 0.627); */
            color: #fff;
        }

        .card-custom:hover {
            transform: translateY(-2px);
        }

        /* Left text inside cards */
        .card-text {
            flex-grow: 1;
            font-weight: 700;
            font-size: 1rem;
            color: #e0e0e0;
            /* Light text color */
        }

        .card-text a {
            text-decoration: none;
            color: #4caf50;
            /* Green link color */
            border-bottom: 1.5px solid #4caf50;
            /* Green underline */
        }

        /* Arrow icon next to text */
        .arrow-icon {
            font-weight: 700;
            font-size: 1.2rem;
            margin-left: 4px;
            color: #4caf50;
            /* Green arrow color */
        }

        /* Icon container on right side of card */
        .icon-container {
            background: linear-gradient(145deg,
                    #4caf50,
                    #2e7d32);
            /* Green gradient */
            border-radius: 0.5rem;
            padding: 8px 10px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            width: 40px;
            height: 40px;
            user-select: none;
        }

        /* Responsive tweaks */
        @media (max-width: 1024px) {
            body {
                padding: 0 1rem;
                /* Add padding for smaller screens */
            }

            .banner-container {
                flex-direction: column;
                height: auto;
            }

            .topbar {
                width: 100%;
                /* Full width on smaller screens */
                padding: 0.5rem;
                /* Adjust padding */
                display: flex;
                flex-direction: row;
                align-items: center;
            }

            .banner-image {
                flex: unset;
                width: 100%;
                height: 180px;
            }

            .banner-text-area {
                flex: unset;
                width: 100%;
                height: 80px;
            }

            .banner-text-area {
                font-size: 1.4rem;
            }

            .cards-container {
                justify-content: center;
            }
        }

        /* Responsive tweaks */
        @media (max-width: 768px) {
            body {
                padding: 0 1rem;
                /* Add padding for smaller screens */
            }

            .topbar {
                width: 100%;
                /* Full width on smaller screens */
                padding: 0.5rem;
                /* Adjust padding */
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .banner-container {
                flex-direction: column;
                height: auto;
            }

            .banner-image {
                flex: unset;
                width: 100%;
                height: 180px;
            }

            .banner-text-area {
                font-size: 1.4rem;
            }

            .cards-container {
                justify-content: center;
                flex-wrap: wrap;
            }

            .wrapper .button:hover {
                height: 60px;
                width: 60px;
                border: none;
            }
        }

        /* Cards container */
        .cards-container {
            max-width: 90%;
            margin: 0 auto 3rem;
            display: flex;
            gap: 1.25rem;
            flex-wrap: wrap;
            justify-content: start;
        }

        /* Each card styling */
        .card-custom {
            flex: 1 1 180px;
            max-width: 25%;
            border-radius: 1rem;
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            cursor: pointer;
            /* background-color:rgba(10, 244, 57, 0.628); */
            transform: scale(1.05) rotateY(15deg);
            /* filter: drop-shadow(inset 5px 5px 50px rgba(74, 222, 128, 0.3)); */
            box-shadow: inset0 0px 15px rgba(10, 244, 57, 0.628),
                0 0px 15px rgba(10, 244, 57, 0.627);
            transition: all 0.3s ease;
            /* background: rgba(8, 221, 15, 0.349); */
            /* box-shadow: 0 0px 15px rgba(10, 244, 57, 0.628),
          0 0px 15px rgba(10, 244, 57, 0.627); */
            box-shadow: 0 0px 15px rgba(10, 244, 57, 0.628),
                0 0px 15px rgba(10, 244, 57, 0.627);
            color: #fff;
        }

        .card-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 0px 15px rgba(10, 244, 57, 0.628),
                0 0px 15px rgba(10, 244, 57, 0.627);
        }

        /* حالت ریسپانسیو در 768px → دو کارت در هر ردیف */
        @media (max-width: 768px) {
            .card-custom {
                flex: 1 1 calc(50% - 1.25rem);
                max-width: calc(50% - 1.25rem);
            }
        }

        /* حالت ریسپانسیو در 480px → یک کارت در هر ردیف */
        @media (max-width: 480px) {
            .card-custom {
                flex: 1 1 100%;
                max-width: 100%;
            }
        }

        /* social media css start ------------------------------------------------ */
        .wrapper {
            max-width: 90%;
            width: 90%;
            min-height: 100px;
            margin: 1rem auto;
            /* border: 1px solid green; */
            /* background-color: rgba(60, 255, 0, 0.308); */
            display: flex;
            flex-direction: row;
            justify-content: center;
            /* position: absolute;
        bottom: 5%; */
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
            background: #16a34a15;
        }

        .wrapper .button:hover {
            width: 200px;
            /* border: none; */
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

        /* social media css end ----------------------------------------------- */
        /*  body animation datted css start-----------  */
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

        /*  body animation datted css end------------  */
    </style>
</head>

<body>
    <!--  body animation datted html start -->
    <div class="floating-particles" id="particles"></div>
    <!--  body animation datted html end -->

    <!-- Top black navbar -->



    @php
        $user = Auth::user();
        if ($user && $user->role == 'user') {
            $profileData = $user;
        }
    @endphp



    <header class="header">
        <div class="topbar d-flex justify-content-between align-items-center">
            <div class="title">TAWANA | Exam Center</div>
            <div class="user-profile-dropdown">
                <div class="user-avatar">
                    <span class="user-name">{{ $profileData->name }} |</span>



                    {{-- when we create the image folder you can incomment --}}
                    {{-- <img class="rounded-circle header-profile-user"
                        src="{{ (!empty($profileData->photo)) ? url('upload/client_images/'.$profileData->photo) : url('upload/no_image.jpg') }}"
                        --}} <img src="{{ asset($profileData->photo) }}" class="avatar-img" id="userAvatar" />
                </div>
                <div class="dropdown-menu" id="userDropdown">
                    <div class="dropdown-item">
                        <i class="fa-solid fa-user"></i>
                        <a href="{{ route('user.uprofile.userprofile') }}">Profile</a>
                    </div>
                    <div class="dropdown-item">
                        <i class="bi bi-gear"></i>
                        <a href="{{ route('user.uprofile.usereditprofile') }}">Settings</a>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-item">
                        <i class="bi bi-box-arrow-right"></i>
                        <a href="{{ route('user.logout') }}">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Banner section with image and text block -->
    <div class="banner-container shadow-sm">
        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/0ad2cb31-e920-484f-a8e0-0cd5b072859d.png"
            alt="Four diverse smiling students sitting in a row at computer desks in an exam center, grayscale photo"
            class="banner-image" />
        <div class="banner-text-area">Online Exam Made Easy</div>
    </div>

    <div class="option">
        <!-- Section title -->
        <h4 class="section-title">Home</h4>

        <!-- Cards container -->
        <!-- Cards container -->
        <div class="cards-container">
            <!-- Card 1: Take Test -->
            <div class="card-custom" role="button" tabindex="0" aria-label="Take Test">
                <div class="card-text">
                    <a href="{{route('user.unicode')}}">Final Exam</a>
                    <span class="arrow-icon">↻</span>
                </div>

                <div class="icon-container" aria-hidden="true">
                    <i class="bi bi-display-fill"></i>
                </div>
            </div>

            <!-- Card 2: Resume Test -->
            <div class="card-custom ca__fx-clipGridReveal" role="button" tabindex="0" aria-label="Resume Test">
                <div class="card-text">
                    <a href="{{ route('mock.exam') }}">Mock Exam</a>
                    <span class="arrow-icon">↻</span>
                </div>
                <div class="icon-container" aria-hidden="true">
                    <i class="bi bi-pencil-square"></i>
                </div>
            </div>

            <!-- Card 3: Test History -->
            <div class="card-custom" role="button" tabindex="0" aria-label="Test History">
                <div class="card-text">
                    <a href= "{{ route('mock.exam') }}">Certificate</a>
                    <span class="arrow-icon">↻</span>
                </div>
                <div class="icon-container" aria-hidden="true">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </div>
            </div>

            <!-- Card 4: Contact Us -->
            <div class="card-custom" role="button" tabindex="0" aria-label="Contact Us">
                <div class="card-text">
                    <a href="https://tawanatechnology.com/about">Contact Us</a> <span class="arrow-icon">↻</span>
                </div>
                <div class="icon-container" aria-hidden="true">
                    <i class="bi bi-telephone-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- social media -->
    <div class="wrapper">
        <a href="https://www.facebook.com/ECDI1?mibextid=LQQJ4d" class="button">
            <div class="icon">
                <i class="fab fa-facebook-f"></i>
            </div>
            <span>Facebook</span>
        </a>
        <a href="https://twitter.com/CyberAcdi" class="button">
            <div class="icon">
                <i class="fa-brands fa-x-twitter"></i>
            </div>
            <span>Twitter</span>
        </a>
        <a href="https://www.instagram.com/tawana_technology" class="button">
            <div class="icon">
                <i class="fab fa-instagram"></i>
            </div>
            <span>Instagram</span>
        </a>
        <a href="https://t.me/KACDI" class="button">
            <div class="icon">
                <i class="fa-brands fa-telegram"></i>
            </div>
            <span>Telegram</span>
        </a>
        <a href="https://www.youtube.com/channel/UChtfH_vkJfThhBGduzmpBWw" class="button">
            <div class="icon">
                <i class="fab fa-youtube"></i>
            </div>
            <span>YouTube</span>
        </a>
    </div>

    <!-- Bootstrap 5 JavaScript Bundle with Popper - For future dynamic behavior if needed -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
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
                        window.location.href = "./edituser.html";
                        break;
                    case "settings":
                        // Add settings page navigation here
                        console.log("Settings clicked");
                        break;
                    case "logout":
                        window.location.href = "./1.html";
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
    </script>

    <!--  body animation datted script start -->
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
    <!--  body animation datted script end -->
</body>

</html>