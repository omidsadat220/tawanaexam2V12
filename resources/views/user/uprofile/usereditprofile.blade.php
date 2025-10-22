<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit User Profile</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <style>
        /* --- استایل‌ها بدون تغییر --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 50%, #0f0f0f 100%);
            min-height: 100vh;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 600px;
            max-width: 800px;
            margin: auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(45deg, #00ff88, #00cc6a, #00ff88);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradientShift 3s ease-in-out infinite;
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

        .profile-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(0, 255, 136, 0.2);
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
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
            overflow: hidden;
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
            margin-bottom: 20px;
        }

        .form-group label {
            color: #00ff88;
            margin-bottom: 8px;
            display: block;
        }

        .form-group input {
            width: 100%;
            padding: 18px;
            border: 2px solid rgba(0, 255, 136, 0.3);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
        }

        .form-group input:focus {
            outline: none;
            border-color: #00ff88;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
            margin-bottom: 10px;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-primary {
            background: linear-gradient(45deg, #00ff88, #00cc6a);
            color: #000;
        }

        .btn-secondary {
            background: transparent;
            border: 2px solid #00ff88;
            color: #fff;
        }

        .status-message {
            text-align: center;
            margin-top: 20px;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
        }

        .status-success {
            background: rgba(0, 255, 136, 0.2);
            color: #00ff88;
        }





        /* body datted animation css start ------------------- */
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

        /* body datted animation css start ------------------- */
    </style>
</head>

<body>
    <div class="floating-particles" id="particles"></div>

    <div class="container">
        <div class="header">
            <h1><i class="fas fa-user-edit"></i> Edit Profile</h1>
            <p>Update your personal information</p>
        </div>

        <div class="profile-card">
            <form id="edit-form" action="{{ route('user.uprofile.update') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="avatar-section">
                    <div class="avatar" onclick="document.getElementById('avatar-upload').click()">
                        @if($user->photo)
                            <img id="avatar-preview" src="{{ asset($user->photo) }}" alt="Avatar">
                        @else
                            <i class="fas fa-user" id="avatar-icon"></i>
                        @endif
                    </div>
                    <input type="file" id="avatar-upload" name="avatar" class="avatar-upload" accept="image/*">
                    <p style="color: #888; font-size: 0.9rem">Click to change photo</p>
                </div>


                <div class="form-row">
                    <div class="form-group">
                        <label for="name"><i class="fas fa-user"></i> Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    </div>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                    <button type="reset" class="btn btn-secondary"><i class="fas fa-undo"></i> Reset</button>
                </div>

                @if(session('success'))
                    <div class="status-message status-success">
                        {{ session('success') }}
                    </div>
                @endif
            </form>

        </div>

    </div>

    <script>
        // Avatar preview
        document.getElementById('avatar-upload').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    let preview = document.getElementById('avatar-preview');
                    let icon = document.getElementById('avatar-icon');

                    if (preview) {
                        preview.src = e.target.result;
                    } else {
                        let img = document.createElement("img");
                        img.id = "avatar-preview";
                        img.src = e.target.result;
                        img.style.width = "100%";
                        img.style.height = "100%";
                        img.style.objectFit = "cover";
                        img.style.borderRadius = "50%";
                        document.querySelector(".avatar").appendChild(img);
                        if (icon) icon.style.display = "none";
                    }
                }
                reader.readAsDataURL(file);
            }
        });
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