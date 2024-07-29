<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Beranda</title>
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            justify-content: center;
            align-items: center;
            display: flex;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border: 1px solid #888;
            width: 90%;
            max-width: 400px;
            border-radius: 10px;
            position: relative;
        }

        .modal-img {
            max-width: 100%;
            height: auto;
            width: 200px;
            /* Adjust the size as needed */
        }

        .close {
            color: #aaa;
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: black;
        }

        .login-modal {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        .login-modal img {
            width: 100%;
            max-width: 330px;
            height: auto;
            margin-bottom: 20px;
        }

        .login-modal h1,
        .login-modal p {
            margin: 0;
            text-align: center;
        }

        .login-modal h1 {
            font-size: 24px;
            font-weight: 500;
            margin-bottom: 15px;
        }

        .login-modal p {
            font-size: 16px;
            font-weight: 400;
            margin-bottom: 20px;
        }

        .login-modal input[type="text"],
        .login-modal input[type="password"] {
            width: 100%;
            height: 40px;
            background: #fbfbfb;
            border-radius: 5px;
            border: 1px solid #80469a;
            margin-bottom: 15px;
            padding: 10px;
            box-sizing: border-box;
            position: relative;
        }

        .password-container {
            position: relative;
            width: 100%;
            margin-bottom: 15px;
        }

        .show-password {
            position: absolute;
            right: 10px;
            top: 10px;
            cursor: pointer;
            font-size: 18px;
            color: #80469a;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-bottom: 15px;
        }

        .remember-forgot label {
            display: flex;
            align-items: center;
            font-size: 14px;
            font-weight: 500;
            color: #80469a;
        }

        .remember-forgot input[type="checkbox"] {
            margin-right: 5px;
        }

        .login-button {
            width: 100%;
            height: 40px;
            background: #80469a;
            border-radius: 5px;
            border: 1px solid #f49273;
            color: white;
            font-size: 16px;
            font-weight: 700;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .lupa-password {
            font-size: 14px;
            font-weight: relative;
            color: #80469a;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <button id="loginBtn">Login</button>

    <!-- Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="login-modal">

                <div class="modal-img">
                    <img src="{{ asset('assets/logocurug.jpeg') }}" alt="Curug Sangereng">
                </div>

                <h1>Curug Sangereng</h1>
                <p>Silakan login menggunakan akun Anda.</p>
                <input type="text" id="username" placeholder="Username">
                
                <!-- Password container with eye icon -->
                <div class="password-container">
                    <input type="password" id="password" placeholder="Password">
                    <span class="show-password" id="togglePassword">&#128065;</span>
                </div>

                <div class="remember-forgot">
                    <label><input type="checkbox">Remember Me</label>
                    <a href="#" class="lupa-password">Lupa Password?</a>
                </div>
                <div class="login-button" id="submitBtn">Masuk</div>
                <div class="error-message" id="errorMessage"></div>
            </div>
        </div>
    </div>

    <script>
        var modal = document.getElementById("loginModal");
        var btn = document.getElementById("loginBtn");
        var span = document.getElementsByClassName("close")[0];
        var submitBtn = document.getElementById("submitBtn");
        var errorMessage = document.getElementById("errorMessage");
        var togglePassword = document.getElementById("togglePassword");
        var passwordInput = document.getElementById("password");

        btn.onclick = function () {
            modal.style.display = "flex";
        }

        span.onclick = function () {
            modal.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        submitBtn.onclick = function () {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            if (username === "admin" && password === "admin") {
                // Mengarahkan ke halaman 2beranda.blade.php
                window.location.href = "{{ url('/beranda') }}"; // Sesuaikan dengan URL yang benar di Laravel
            } else {
                errorMessage.textContent = "Username atau password salah.";
            }
        }

        togglePassword.onclick = function () {
            // Toggle the type attribute
            const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
            passwordInput.setAttribute("type", type);

            // Change the icon
            togglePassword.textContent = type === "password" ? "\u{1F441}" : "\u{1F441}\u{FE0E}";
        }
    </script>

</body>

</html>
