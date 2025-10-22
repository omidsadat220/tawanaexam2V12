<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TST Exam Center</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
      integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <!-- Bootstrap 5 CSS CDN -->
    <!-- Bootstrap icons CDN for icons used in cards -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <script src="https://cdn.tailwindcss.com"></script>

    <link
      rel="stylesheet"
      href="https://cssanimation.io/?animation=ca__fx-clipCircleCollapseOut&category=Clip-Path&theme=dark"
    />

    <!-- <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    /> -->

    <style>
      :root {
        --icon-color: #28a745; /* Green color */
        --week-color: #28a745; /* Green for headers */
        --bg-dark: #3838385f;
        --card-bg: #1e1e1e;
        --text-dark: #e0e0e0;
        --border-dark: #333;
      }

      body {
        background-color: rgb(38, 38, 38); /* Dark background */
        color: #e0e0e0; /* Light text color */
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      }

      /* Top navbar style */
      .topbar {
        width: 90%;
        background: #1f1f1f; /* Darker navbar */
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
        right: -10px;
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
        /* max-width: 1140px; */
        max-width: 90%;
        height: auto;
        margin:20px auto;
        background: rgb(38, 38, 38);
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
        border-radius: 3px;
        overflow: hidden;
        display: flex;
        align-items: center;
        padding: 20px 0px;
        border-bottom: 10px double #2e7d32; /* Green border */
        border-top: 10px double #2e7d32; /* Green border */
      }

      #exam-container {
        /* background-color: red; */
        width: 100%;
      }

      #exam-card {
        width: 25%;
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
        background: linear-gradient(
          135deg,
          #4caf50,
          #2e7d32
        ); /* Green gradient */
        color: white;
        font-weight: 700;
        font-size: 1.8rem;
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
        max-width: 1140px;
        margin: 2rem auto 1rem;
        font-weight: 700;
        font-size: 1.25rem;
      }

      /* Responsive tweaks */
      @media (max-width: 1024px) {
        body {
          padding: 0 1rem; /* Add padding for smaller screens */
        }
        .banner-container {
          flex-direction: column;
          height: auto;
        }

        .topbar {
          width: 100%; /* Full width on smaller screens */
          padding: 0.5rem; /* Adjust padding */
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
          padding: 0 1rem; /* Add padding for smaller screens */
        }
        .topbar {
          width: 100%; /* Full width on smaller screens */
          padding: 0.5rem; /* Adjust padding */
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
        }
      }

      /* Style the input background */
      .input-field {
        background-color: rgb(15, 126, 63);
        color: white; /* text color when typing */
        padding: 8px;
        border: none;
        border-radius: 5px;
      }

      /* Style placeholder text */
      .input-field::placeholder {
        color: yellow; /* placeholder color */
        opacity: 1; /* make sure it’s not faded */
      }

      /*  acoordion exam hitory ----------------------------- */
      .container_accordion {
        max-width: 90%;
        margin: 0 auto;
        margin-top: 30px;
        background-color: rgb(38, 38, 38);
      }

      .week {
        background-color: rgba(40, 167, 69, 0.1);
        border-left: 4px solid var(--green);
        margin-bottom: 15px;
        border-radius: 5px;
        overflow: hidden;
        transition: all 0.3s ease;
      }

      .week-header {
        padding: 15px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-weight: 600;
      }

      .week-header:hover {
        background-color: rgba(40, 167, 69, 0.2);
      }

      .week-title {
        display: flex;
        align-items: center;
      }

      .week-icon {
        color: var(--green);
        margin-right: 10px;
        font-size: 1.2rem;
      }

      .stats {
        display: flex;
        gap: 10px;
      }

      .stat {
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
      }

      .correct-stat {
        background-color: var(--green);
      }

      .incorrect-stat {
        background-color: var(--red);
      }

      .week-content {
        padding: 0 15px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease-out;
      }

      .week.active .week-content {
        padding: 15px;
        max-height: 1000px;
      }

      .question {
        background-color: var(--card-bg);
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 15px;
        position: relative;
        overflow: hidden;
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.3s ease;
      }

      .week.active .question {
        opacity: 1;
        transform: translateY(0);
      }

      .question-number {
        display: inline-block;
        width: 25px;
        height: 25px;
        line-height: 25px;
        text-align: center;
        background-color: rgba(40, 167, 69, 0.2);
        border-radius: 50%;
        color: var(--green);
        font-weight: bold;
        font-size: 0.8rem;
        margin-right: 10px;
      }

      .question-text {
        font-weight: bold;
      }

      .question-status {
        position: absolute;
        right: 15px;
        top: 15px;
        padding: 2px 10px;
        border-radius: 3px;
        font-size: 0.8rem;
      }

      .correct {
        background-color: rgba(40, 167, 69, 0.2);
        border-left: 3px solid var(--green);
      }

      .correct .question-status {
        background-color: var(--green);
      }

      .incorrect {
        background-color: rgba(220, 53, 69, 0.2);
        border-left: 3px solid var(--red);
      }

      .incorrect .question-status {
        background-color: var(--red);
      }

      .question-detail {
        margin-top: 10px;
        font-size: 0.9rem;
        color: #aaa;
      }

      .chevron {
        transition: transform 0.3s ease;
      }

      .week.active .chevron {
        transform: rotate(180deg);
      }

      /* accordion exam history ----------------------------- */

      /* select category css start */

      .cards-container {
        width: 90%;
        /* background-color: red; */
        /* padding: 1rem 0rem; */
        margin: auto;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
      }

      .cards-container h1 {
        color: #4caf50;
        font-size: 2.5rem;
        font-weight: 700;
        font-family: sans-serif;
        margin-bottom: 0.5rem;
        text-align: center;
        letter-spacing: 1px;
        /* background-color: red; */
      }
      /*  CONTAINER dropdown css start ----------------- */
      .dropdowns-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        width: 100%;
        max-width: 900px;
      }

      .custom-select-wrapper {
        position: relative;
        width: 100%;
      }
      /*  */

      /*  */
      .custom-select {
        background: rgb(38, 38, 38);
        /* border: 2px solid #333; */
        border-radius: 10px;
        border: none;
        outline: none;

        padding: 12px 16px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 0px 10px rgba(3, 255, 61, 0.245);

        transition: 0.3s;
      }

      .custom-select:hover {
        border-color: rgb(38, 38, 38);
      }

      .arrow {
        transition: transform 0.3s;
      }

      .arrow.rotate {
        transform: rotate(180deg);
      }

      .custom-options {
        position: absolute;
        top: 110%;
        left: 0;
        right: 0;
        background: rgb(38, 38, 38);
        border: 1px solid #333;
        border-radius: 10px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.6);
        overflow: hidden;
        display: none;
        flex-direction: column;
        animation: fadeIn 0.3s ease;
        z-index: 10;
      }

      .custom-options.active {
        display: flex;
      }

      .custom-options div {
        padding: 12px 16px;
        cursor: pointer;
        transition: 0.2s;
      }

      .custom-options div:hover {
        /* background: #33; */
        background: #28a745;
        color: #fff;
      }

      .custom-options .selected {
        background: #28a745;
        color: #fff;
      }

      @keyframes fadeIn {
        from {
          opacity: 0;
          transform: translateY(-10px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
      /*  CONTAINER dropdown css end ----------------- */

      /*animation body datted Container for particles */
      .floating-particles {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none; /* Allow clicks through */
        z-index: -1; /* Behind all elements */
        overflow: hidden;
        background-color: rgb(38, 38, 38);

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
    </style>
  </head>
  <body>
    <div class="floating-particles" id="particles"></div>

    <!-- Top black navbar -->
    <header class="header">
      <div class="topbar d-flex justify-content-between align-items-center">
        <div class="title">TAWANA | Exam Center</div>
        <div class="user-profile-dropdown">
          <div class="user-avatar">
            <span class="user-name">Roman Noori |</span>

            <img
             src="{{ asset('assets/img/roman.png') }}"
              alt="User Avatar"
              class="avatar-img"
              id="userAvatar"
            />
          </div>
          <div class="dropdown-menu" id="userDropdown">
            <div class="dropdown-item">
              <i class="bi bi-person-circle"></i>
               <a href="{{ route('user.uprofile.userprofile') }}">Profile</a>
            </div>
            <div class="dropdown-item">
              <i class="bi bi-gear"></i>
              <a href="./edituser.html">Settings</a>
            </div>
            <div class="dropdown-divider"></div>
            <div class="dropdown-item">
              <i class="bi bi-box-arrow-right"></i>
              <a href="./signin.html">Logout</a>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- Top black navbar -->

    <!-- Cards container -->
    <div class="cards-container">
      <h1>Select Exam</h1>
      <div class="dropdowns-container">
        <!-- Dropdown 1 -->
        <div class="custom-select-wrapper">
          <div class="custom-select">
            <span class="selected-text">Category</span>
            <span class="arrow"><i class="fa-solid fa-angle-down"></i></span>
          </div>
          <div class="custom-options">
            <div>FullStack</div>
            <div>ICDL</div>
            <div>Networking</div>
            <div>Cuber Security</div>
            <div>Programming</div>
          </div>
        </div>

        <!-- Dropdown 2 -->
        <div class="custom-select-wrapper">
          <div class="custom-select">
            <span class="selected-text">Sub Category</span>
            <span class="arrow"><i class="fa-solid fa-angle-down"></i></span>
          </div>
          <div class="custom-options">
            <div>Wen Designing</div>
            <div>Web Development</div>
            <div>Network+</div>
            <div>Cicso</div>
            <div>CompTiA</div>
            <div>CEh</div>
            <div>PWK</div>
          </div>
        </div>

        <!-- Dropdown 3 -->
        <div class="custom-select-wrapper">
          <div class="custom-select">
            <span class="selected-text">Subject</span>
            <span class="arrow"><i class="fa-solid fa-angle-down"></i></span>
          </div>
          <div class="custom-options">
            <div>Html</div>
            <div>CSS</div>
            <div>Bootsrtap</div>
            <div>JavaScript</div>
            <div>React</div>
            <div>Php</div>
            <div>Mysql</div>
            <div>Laravel</div>
            <div>A Plus+</div>
            <div>Network+</div>
          
          </div>
        </div>
      </div>
      </div>
    </div>
    <!-- Cards container -->

    <!-- exam card start -->
    <div class="banner-container shadow-sm">
      <!-- Exam Cards -->
      <div
        class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 justify-items-center"
        id="exam-container"
      >
        <div
          class="bg-dark rounded-xl shadow-md overflow-hidden exam-card w-full"
        >
          <div class="bg-gradient-to-r from-green-500 to-white-400 h-2"></div>
          <div class="p-6">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-lg font-bold text-green-600">HTML WEEK 1</h3>
              <div
                class="border-1 border-success text-green-500 text-xs font-semibold px-2.5 py-0.5 rounded-full"
              >
                Active <i class="fa-solid fa-lock-open"></i>
              </div>
            </div>

            <div class="flex items-center mb-4">
              <i class="fas fa-calendar-alt text-green-600 mr-2"></i>
              <span class="text-sm text-white-500"
                >May 15, 2024 - 09:00 AM</span
              >
            </div>
            <div class="flex items-center">
              <i class="fas fa-clock text-green-600 mr-2"></i>
              <span class="text-sm text-white-600">2 hours</span>
            </div>
            <div class="mt-6">
              <div class="flex justify-between mb-1">
                <span class="text-sm font-medium text-white-700"
                  >Preparation</span
                >
                <span class="text-sm font-medium text-white-700">65%</span>
              </div>
              <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div
                  class="bg-green-500 h-2.5 rounded-full"
                  style="width: 65%"
                ></div>
              </div>
            </div>
            <div class="mt-6 flex space-x-3">
              <button
                class="flex-1 px-4 py-2 bg-gradient-to-r from-green-500 to-white-400 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-700 focus:ring-offset-2"
              >
                Start
              </button>
              <button
                class="p-2 text-gray-500 hover:bg-gray-100 rounded-lg focus:outline-none"
              >
                <i class="fas fa-ellipsis-v"></i>
              </button>
            </div>
          </div>
        </div>
        <div
          class="bg-dark rounded-xl shadow-md overflow-hidden exam-card w-full"
        >
          <div class="bg-gradient-to-r from-green-500 to-white-400 h-2"></div>
          <div class="p-6">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-lg font-bold text-green-600">HTML WEEK 2</h3>
              <div
                class="border-1 border-success text-green-500 text-xs font-semibold px-2.5 py-0.5 rounded-full"
              >
                Inactive  <i class="fa-solid fa-lock"></i>
              </div>
            </div>

            <div class="flex items-center mb-4">
              <i class="fas fa-calendar-alt text-green-600 mr-2"></i>
              <span class="text-sm text-white-500"
                >May 15, 2024 - 09:00 AM</span
              >
            </div>
            <div class="flex items-center">
              <i class="fas fa-clock text-green-600 mr-2"></i>
              <span class="text-sm text-white-600">2 hours</span>
            </div>
            <div class="mt-6">
              <div class="flex justify-between mb-1">
                <span class="text-sm font-medium text-white-700"
                  >Preparation</span
                >
                <span class="text-sm font-medium text-white-700">65%</span>
              </div>
              <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div
                  class="bg-green-500 h-2.5 rounded-full"
                  style="width: 65%"
                ></div>
              </div>
            </div>
            <div class="mt-6 flex space-x-3">
              <button
                class="flex-1 px-4 py-2 bg-gradient-to-r from-green-500 to-white-400 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-700 focus:ring-offset-2"
              >
                Start
              </button>
              <button
                class="p-2 text-gray-500 hover:bg-gray-100 rounded-lg focus:outline-none"
              >
                <i class="fas fa-ellipsis-v"></i>
              </button>
            </div>
          </div>
        </div>
        <div
          class="bg-dark rounded-xl shadow-md overflow-hidden exam-card w-full"
        >
          <div class="bg-gradient-to-r from-green-500 to-white-400 h-2"></div>
          <div class="p-6">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-lg font-bold text-green-600">HTML WEEK 3</h3>
              <div
                class="border-1 border-success text-green-500 text-xs font-semibold px-2.5 py-0.5 rounded-full"
              >
                Inactive  <i class="fa-solid fa-lock"></i>
              </div>
            </div>

            <div class="flex items-center mb-4">
              <i class="fas fa-calendar-alt text-green-600 mr-2"></i>
              <span class="text-sm text-white-500"
                >May 15, 2024 - 09:00 AM</span
              >
            </div>
            <div class="flex items-center">
              <i class="fas fa-clock text-green-600 mr-2"></i>
              <span class="text-sm text-white-600">2 hours</span>
            </div>
            <div class="mt-6">
              <div class="flex justify-between mb-1">
                <span class="text-sm font-medium text-white-700"
                  >Preparation</span
                >
                <span class="text-sm font-medium text-white-700">65%</span>
              </div>
              <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div
                  class="bg-green-500 h-2.5 rounded-full"
                  style="width: 65%"
                ></div>
              </div>
            </div>
            <div class="mt-6 flex space-x-3">
              <button
                class="flex-1 px-4 py-2 bg-gradient-to-r from-green-500 to-white-400 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-700 focus:ring-offset-2"
              >
                Start
              </button>
              <button
                class="p-2 text-gray-500 hover:bg-gray-100 rounded-lg focus:outline-none"
              >
                <i class="fas fa-ellipsis-v"></i>
              </button>
            </div>
          </div>
        </div>
        <div
          class="bg-dark rounded-xl shadow-md overflow-hidden exam-card w-full"
        >
          <div class="bg-gradient-to-r from-green-500 to-white-400 h-2"></div>
          <div class="p-6">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-lg font-bold text-green-600">HTML WEEK 4</h3>
              <div
                class="border-1 border-success text-green-500 text-xs font-semibold px-2.5 py-0.5 rounded-full"
              >
                Inactive  <i class="fa-solid fa-lock"></i>
              </div>
            </div>

            <div class="flex items-center mb-4">
              <i class="fas fa-calendar-alt text-green-600 mr-2"></i>
              <span class="text-sm text-white-500"
                >May 15, 2024 - 09:00 AM</span
              >
            </div>
            <div class="flex items-center">
              <i class="fas fa-clock text-green-600 mr-2"></i>
              <span class="text-sm text-white-600">2 hours</span>
            </div>
            <div class="mt-6">
              <div class="flex justify-between mb-1">
                <span class="text-sm font-medium text-white-700"
                  >Preparation</span
                >
                <span class="text-sm font-medium text-white-700">65%</span>
              </div>
              <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div
                  class="bg-green-500 h-2.5 rounded-full"
                  style="width: 65%"
                ></div>
              </div>
            </div>
            <div class="mt-6 flex space-x-3">
              <button
                class="flex-1 px-4 py-2 bg-gradient-to-r from-green-500 to-white-400 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-700 focus:ring-offset-2"
              >
                Start
              </button>
              <button
                class="p-2 text-gray-500 hover:bg-gray-100 rounded-lg focus:outline-none"
              >
                <i class="fas fa-ellipsis-v"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- exam card start -->

    <!-- acoordion exam history -->
    <div class="container_accordion">
      <!-- week1 -->
      <div class="week">
        <div class="week-header">
          <div class="week-title">
            <span class="week-icon"
              ><i class="fa-solid fa-book-open-reader"></i
            ></span>
            HTML Week 1
          </div>
          <div class="" style="width: 80%">
            <div class="flex justify-between">
              <span class="text-sm font-medium text-light mb-1"
                >Performance</span
              >
              <span class="text-sm font-medium text-gray-700 text-light"
                >93%</span
              >
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
              <div
                class="bg-green-500 h-2.5 rounded-full"
                style="width: 85%"
              ></div>
            </div>
          </div>
          <div class="stats">
            <div class="stat correct-stat">
              <i class="fa-solid fa-chevron-down"></i>
            </div>
          </div>
        </div>
        <div class="week-content">
          <div class="question correct" style="transition-delay: 0.1s">
            <span class="question-number">1</span>
            <span class="question-text"
              >HTML stands for HyperText Markup Language</span
            >
            <div class="question-status">Correct</div>
            <div class="question-detail">All students answered correctly</div>
          </div>

          <div class="question correct" style="transition-delay: 0.2s">
            <span class="question-number">2</span>
            <span class="question-text"
              >The &lt;head&gt; section contains metadata</span
            >
            <div class="question-status">Correct</div>
            <div class="question-detail">4/5 students answered correctly</div>
          </div>

          <div class="question incorrect" style="transition-delay: 0.3s">
            <span class="question-number">3</span>
            <span class="question-text">&lt;br&gt; needs a closing tag</span>
            <div class="question-status">Incorrect</div>
            <div class="question-detail">3/5 students got this wrong</div>
          </div>

          <div class="question correct" style="transition-delay: 0.4s">
            <span class="question-number">4</span>
            <span class="question-text">HTML5 is the latest version</span>
            <div class="question-status">Correct</div>
            <div class="question-detail">All students answered correctly</div>
          </div>

          <div class="question incorrect" style="transition-delay: 0.5s">
            <span class="question-number">5</span>
            <span class="question-text"
              >All HTML elements must have attributes</span
            >
            <div class="question-status">Incorrect</div>
            <div class="question-detail">2/5 students answered incorrectly</div>
          </div>
        </div>
      </div>

      <!-- week2 -->
      <div class="week">
        <div class="week-header">
          <div class="week-title">
            <span class="week-icon"
              ><i class="fa-solid fa-book-open-reader"></i
            ></span>
            HTML Week 2
          </div>
          <div class="" style="width: 80%">
            <div class="flex justify-between">
              <span class="text-sm font-medium text-light mb-1"
                >Performance</span
              >
              <span class="text-sm font-medium text-gray-700 text-light"
                >70%</span
              >
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
              <div
                class="bg-green-500 h-2.5 rounded-full"
                style="width: 70%"
              ></div>
            </div>
          </div>
          <div class="stats">
            <div class="stat correct-stat">
              <i class="fa-solid fa-chevron-down"></i>
            </div>
          </div>
        </div>
        <div class="week-content">
          <div class="question correct" style="transition-delay: 0.1s">
            <span class="question-number">1</span>
            <span class="question-text"
              >HTML stands for HyperText Markup Language</span
            >
            <div class="question-status">Correct</div>
            <div class="question-detail">All students answered correctly</div>
          </div>

          <div class="question correct" style="transition-delay: 0.2s">
            <span class="question-number">2</span>
            <span class="question-text"
              >The &lt;head&gt; section contains metadata</span
            >
            <div class="question-status">Correct</div>
            <div class="question-detail">4/5 students answered correctly</div>
          </div>

          <div class="question incorrect" style="transition-delay: 0.3s">
            <span class="question-number">3</span>
            <span class="question-text">&lt;br&gt; needs a closing tag</span>
            <div class="question-status">Incorrect</div>
            <div class="question-detail">3/5 students got this wrong</div>
          </div>

          <div class="question correct" style="transition-delay: 0.4s">
            <span class="question-number">4</span>
            <span class="question-text">HTML5 is the latest version</span>
            <div class="question-status">Correct</div>
            <div class="question-detail">All students answered correctly</div>
          </div>

          <div class="question incorrect" style="transition-delay: 0.5s">
            <span class="question-number">5</span>
            <span class="question-text"
              >All HTML elements must have attributes</span
            >
            <div class="question-status">Incorrect</div>
            <div class="question-detail">2/5 students answered incorrectly</div>
          </div>
        </div>
      </div>

      <!-- week3 -->
      <div class="week">
        <div class="week-header">
          <div class="week-title">
            <span class="week-icon"
              ><i class="fa-solid fa-book-open-reader"></i
            ></span>
            HTML Week 3
          </div>
          <div class="" style="width: 80%">
            <div class="flex justify-between">
              <span class="text-sm font-medium text-light mb-1"
                >Performance</span
              >
              <span class="text-sm font-medium text-gray-700 text-light"
                >50%</span
              >
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
              <div
                class="bg-green-500 h-2.5 rounded-full"
                style="width: 50%"
              ></div>
            </div>
          </div>
          <div class="stats">
            <div class="stat correct-stat">
              <i class="fa-solid fa-chevron-down"></i>
            </div>
          </div>
        </div>
        <div class="week-content">
          <div class="question correct" style="transition-delay: 0.1s">
            <span class="question-number">1</span>
            <span class="question-text"
              >HTML stands for HyperText Markup Language</span
            >
            <div class="question-status">Correct</div>
            <div class="question-detail">All students answered correctly</div>
          </div>

          <div class="question correct" style="transition-delay: 0.2s">
            <span class="question-number">2</span>
            <span class="question-text"
              >The &lt;head&gt; section contains metadata</span
            >
            <div class="question-status">Correct</div>
            <div class="question-detail">4/5 students answered correctly</div>
          </div>

          <div class="question incorrect" style="transition-delay: 0.3s">
            <span class="question-number">3</span>
            <span class="question-text">&lt;br&gt; needs a closing tag</span>
            <div class="question-status">Incorrect</div>
            <div class="question-detail">3/5 students got this wrong</div>
          </div>

          <div class="question correct" style="transition-delay: 0.4s">
            <span class="question-number">4</span>
            <span class="question-text">HTML5 is the latest version</span>
            <div class="question-status">Correct</div>
            <div class="question-detail">All students answered correctly</div>
          </div>

          <div class="question incorrect" style="transition-delay: 0.5s">
            <span class="question-number">5</span>
            <span class="question-text"
              >All HTML elements must have attributes</span
            >
            <div class="question-status">Incorrect</div>
            <div class="question-detail">2/5 students answered incorrectly</div>
          </div>
        </div>
      </div>
      <!-- week4 -->
      <div class="week">
        <div class="week-header">
          <div class="week-title">
            <span class="week-icon"
              ><i class="fa-solid fa-book-open-reader"></i
            ></span>
            HTML Week 4
          </div>
          <div class="" style="width: 80%">
            <div class="flex justify-between">
              <span class="text-sm font-medium text-light mb-1"
                >Performance</span
              >
              <span class="text-sm font-medium text-gray-700 text-light"
                >93%</span
              >
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
              <div
                class="bg-green-500 h-2.5 rounded-full"
                style="width: 85%"
              ></div>
            </div>
          </div>
          <div class="stats">
            <div class="stat correct-stat">
              <i class="fa-solid fa-chevron-down"></i>
            </div>
          </div>
        </div>
        <div class="week-content">
          <div class="question correct" style="transition-delay: 0.1s">
            <span class="question-number">1</span>
            <span class="question-text"
              >HTML stands for HyperText Markup Language</span
            >
            <div class="question-status">Correct</div>
            <div class="question-detail">All students answered correctly</div>
          </div>

          <div class="question correct" style="transition-delay: 0.2s">
            <span class="question-number">2</span>
            <span class="question-text"
              >The &lt;head&gt; section contains metadata</span
            >
            <div class="question-status">Correct</div>
            <div class="question-detail">4/5 students answered correctly</div>
          </div>

          <div class="question incorrect" style="transition-delay: 0.3s">
            <span class="question-number">3</span>
            <span class="question-text">&lt;br&gt; needs a closing tag</span>
            <div class="question-status">Incorrect</div>
            <div class="question-detail">3/5 students got this wrong</div>
          </div>

          <div class="question correct" style="transition-delay: 0.4s">
            <span class="question-number">4</span>
            <span class="question-text">HTML5 is the latest version</span>
            <div class="question-status">Correct</div>
            <div class="question-detail">All students answered correctly</div>
          </div>

          <div class="question incorrect" style="transition-delay: 0.5s">
            <span class="question-number">5</span>
            <span class="question-text"
              >All HTML elements must have attributes</span
            >
            <div class="question-status">Incorrect</div>
            <div class="question-detail">2/5 students answered incorrectly</div>
          </div>
        </div>
      </div>
    </div>
    <!-- acoordion exam history -->

    <!-- dropdowns-container script -->
    <script>
      document.querySelectorAll(".custom-select-wrapper").forEach((wrapper) => {
        const customSelect = wrapper.querySelector(".custom-select");
        const optionsContainer = wrapper.querySelector(".custom-options");
        const arrow = wrapper.querySelector(".arrow");
        const selectedText = wrapper.querySelector(".selected-text");
        const options = wrapper.querySelectorAll(".custom-options div");

        customSelect.addEventListener("click", () => {
          optionsContainer.classList.toggle("active");
          arrow.classList.toggle("rotate");
        });

        options.forEach((option) => {
          option.addEventListener("click", () => {
            options.forEach((opt) => opt.classList.remove("selected"));
            option.classList.add("selected");
            selectedText.textContent = option.textContent;
            optionsContainer.classList.remove("active");
            arrow.classList.remove("rotate");
          });
        });

        window.addEventListener("click", (e) => {
          if (!wrapper.contains(e.target)) {
            optionsContainer.classList.remove("active");
            arrow.classList.remove("rotate");
          }
        });
      });
    </script>
    <!-- dropdowns-container script -->

    <!-- Bootstrap 5 JavaScript Bundle with Popper - For future dynamic behavior if needed -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- acoordion script -->
    <script>
      // Toggle week sections
      document.querySelectorAll(".week-header").forEach((header) => {
        header.addEventListener("click", function () {
          const week = this.parentElement;
          week.classList.toggle("active");

          // Close other weeks if this one opens
          if (week.classList.contains("active")) {
            document.querySelectorAll(".week").forEach((w) => {
              if (w !== week) w.classList.remove("active");
            });
          }
        });
      });

      // Animate questions when week opens
      function animateQuestions(week) {
        const questions = week.querySelectorAll(".question");
        questions.forEach((question, index) => {
          question.style.transitionDelay = `${index * 0.1}s`;
        });
      }

      // Initialize first week as open
      document.addEventListener("DOMContentLoaded", function () {
        const firstWeek = document.querySelector(".week");
        animateQuestions(firstWeek);
      });
    </script>
    <!-- accordion script -->

    <!-- User Profile Dropdown JavaScript -->
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
  </body>
</html>
