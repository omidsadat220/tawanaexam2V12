<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit User Profile</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg,
                    #0a0a0a 0%,
                    #1a1a1a 50%,
                    #0f0f0f 100%);
            min-height: 100vh;
            color: #ffffff;
            direction: ltr;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 600px;
            max-width: 800px;
            margin: auto;
            /* background-color: blue; */
        }

        .header {
            text-align: center;
            margin-bottom: 0px;
            position: relative;
            /* background-color: red; */
            padding-bottom: 10px;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(45deg, #00ff88, #00cc6a, #00ff88);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradientShift 3s ease-in-out infinite;
            margin-bottom: 0px;
        }

        @keyframes gradientShift {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        .header p {
            color: #888;
            font-size: 1em;
        }

        .profile-card {
            /* background-color: green; */
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(0, 255, 136, 0.2);
            border-radius: 20px;
            padding: 20px;
            padding-top: 80px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
        }

        .profile-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #00ff88, #00cc6a, #00ff88);
            background-size: 200% 100%;
            animation: shimmer 2s linear infinite;
        }

        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        .avatar-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(45deg, #00ff88, #00cc6a);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            font-size: 3rem;
            color: #000;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 0 30px rgba(0, 255, 136, 0.5);
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .avatar-upload {
            display: none;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #00ff88;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 15px 20px;
            background: rgba(255, 255, 255, 0.08);
            border: 2px solid rgba(0, 255, 136, 0.3);
            border-radius: 12px;
            color: #ffffff;
            font-size: 1rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #00ff88;
            box-shadow: 0 0 20px rgba(0, 255, 136, 0.3);
            background: rgba(255, 255, 255, 0.12);
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #888;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .button-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 40px;
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            min-width: 140px;
        }

        .btn-primary {
            background: linear-gradient(45deg, #00ff88, #00cc6a);
            color: #000;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 255, 136, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            border: 2px solid rgba(0, 255, 136, 0.3);
            padding: 15px 60px;
        }

        .btn-secondary:hover {
            background: rgba(0, 255, 136, 0.1);
            border-color: #00ff88;
            transform: translateY(-2px);
        }

        .btn::before {
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

        .btn:hover::before {
            left: 100%;
        }

        .status-message {
            text-align: center;
            margin-top: 20px;
            padding: 15px;
            border-radius: 10px;
            font-weight: 600;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .status-success {
            background: rgba(0, 255, 136, 0.2);
            color: #00ff88;
            border: 1px solid rgba(0, 255, 136, 0.3);
        }

        .status-error {
            background: rgba(255, 0, 0, 0.2);
            color: #ff4444;
            border: 1px solid rgba(255, 0, 0, 0.3);
        }

        .floating-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: #00ff88;
            border-radius: 50%;
            animation: float 6s infinite linear;
        }

        #gender option {
            color: #000;
            background-color: rgba(255, 255, 255, 0.1);
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
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .profile-card {
                padding: 25px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .header h1 {
                font-size: 2rem;
            }

            .button-group {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="floating-particles" id="particles"></div>

    <div class="container">
        <div class="header">
            <h1><i class="fas fa-user-edit"></i> Edit Password</h1>
            <p>Update your personal information</p>
        </div>

        <div class="profile-card ">
            {{-- <div class="avatar-section">
                <div class="avatar" onclick="document.getElementById('avatar-upload').click()">
                    @if($user->photo)
                    <img id="avatar-preview" src="{{ asset($user->photo) }}" alt="Avatar">
                    @else
                    <i class="fas fa-user" id="avatar-icon"></i>
                    @endif
                </div>
                <input type="file" id="avatar-upload" name="avatar" class="avatar-upload" accept="image/*">
                <p style="color: #888; font-size: 0.9rem">Click to change photo</p>
            </div> --}}

            <form id="password-form" action="{{ route('user.uprofile.updatepassword') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label for="old_password"><i class="fa-solid fa-unlock-keyhole"></i> Old Password</label>
                        <input type="password" id="old_password" name="old_password" placeholder="Enter old password"
                            required />
                    </div>
                    <div class="form-group">
                        <label for="new_password"><i class="fa-solid fa-lock"></i> New Password</label>
                        <input type="password" id="new_password" name="new_password" placeholder="Enter new password"
                            required />
                    </div>
                    <div class="form-group">
                        <label for="new_password_confirmation"><i class="fa-solid fa-lock"></i> Confirm New
                            Password</label>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                            placeholder="Confirm new password" required />
                    </div>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
                    <button type="reset" class="btn btn-secondary"><i class="fas fa-undo"></i> Reset</button>
                </div>
            </form>


            @if(session('message'))
                <div class="status-message {{ session('alert-type') == 'success' ? 'status-success' : 'status-error' }}">
                    {{ session('message') }}
                </div>
            @endif


            <div id="status-message" class="status-message"></div>
        </div>
    </div>

    <script>
        // Create floating particles
        function createParticles() {
            const particlesContainer = document.getElementById("particles");
            const particleCount = 50;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement("div");
                particle.className = "particle";
                particle.style.left = Math.random() * 100 + "%";
                particle.style.animationDelay = Math.random() * 6 + "s";
                particle.style.animationDuration = Math.random() * 3 + 3 + "s";
                particlesContainer.appendChild(particle);
            }
        }

        // Reset form
        function resetForm() {
            document.getElementById("edit-form").reset();
            const avatar = document.querySelector(".avatar");
            avatar.innerHTML = '<i class="fas fa-user"></i>';
            showStatus("Form reset successfully", "success");
        }

        // Show status message
        function showStatus(message, type) {
            const statusDiv = document.getElementById("status-message");
            statusDiv.textContent = message;
            statusDiv.className = `status-message status-${type}`;
            statusDiv.style.opacity = "1";

            setTimeout(() => {
                statusDiv.style.opacity = "0";
            }, 3000);
        }


        // Add smooth hover effects to form inputs
        document
            .querySelectorAll("input, textarea, select")
            .forEach((element) => {
                element.addEventListener("mouseenter", function () {
                    this.style.transform = "translateY(-2px)";
                });

                element.addEventListener("mouseleave", function () {
                    this.style.transform = "translateY(0)";
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
