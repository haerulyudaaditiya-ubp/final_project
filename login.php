<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
    $valid_email = 'admin@admin.com';
    $valid_password = 'admin123';
    
    if ($_POST['email'] === $valid_email && $_POST['password'] === $valid_password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['role'] = 'user';
        $_SESSION['email'] = $_POST['email'];
        header("Location: new_user/dashboard.php");
        exit();
    } else {
        $_SESSION['error'] = "Gagal login";
        header("Location: login.php");
        exit();
    }
}

$error = '';
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']); // Hapus error dari sesi
}

require 'header.php';
?>

<body>
    <div class="auth-container d-flex justify-content-center align-items-center min-vh-100 wrapper">
        <div class="auth-card text-center shadow p-4">
            <!-- Logo -->
            <div class="auth-logo mb-4">
                <img src="img/logo.png" alt="Logo" class="auth-logo">
            </div>

            <!-- Login Form -->
            <div class="form-box login">
                <h3 class="auth-title mb-4">Please login to use the platform</h3>
                
                <form id="loginForm" method="POST" action="">
                    <div class="input-box mb-3">
                        <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control auth-input" placeholder="Email address" required>
                    </div>
                    <div class="input-box mb-3">
                        <span class="icon"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" name="password" class="form-control auth-input" placeholder="Password" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <label>
                            <input type="checkbox" id="rememberMe"> Remember me
                        </label>
                        <a href="#" class="auth-link">Forgot your password?</a>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block auth-btn mt-3">Login</button>

                    <!-- Error Message -->
                    <?php if ($error): ?>
                        <p class="text-danger mt-2"><?= $error; ?></p>
                    <?php endif; ?>

                    <div class="logreg-link mt-3">
                        <p>Don't have an account? <a href="#" class="register-link">Register</a></p>
                    </div>
                </form>
            </div>

            <!-- Register Form -->
            <div class="form-box register" style="display: none;">
                <h3 class="auth-title mb-4">Create an Account</h3>

                <form id="registerForm">
                    <div class="input-box mb-3">
                        <span class="icon"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control auth-input" placeholder="Username" required>
                    </div>
                    <div class="input-box mb-3">
                        <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" class="form-control auth-input" placeholder="Email address" required>
                    </div>
                    <div class="input-box mb-3">
                        <span class="icon"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" class="form-control auth-input" placeholder="Password" required>
                    </div>

                    <div class="d-flex justify-content-start mt-3">
                        <label>
                            <input type="checkbox" id="terms"> I agree to the terms & conditions
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block auth-btn mt-3">Register</button>

                    <div class="logreg-link mt-3">
                        <p>Already have an account? <a href="#" class="login-link">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const loginLink = document.querySelector('.login-link');
            const registerLink = document.querySelector('.register-link');
            const loginForm = document.querySelector('.form-box.login');
            const registerForm = document.querySelector('.form-box.register');
            const rememberMe = document.querySelector('#rememberMe');
            const terms = document.querySelector('#terms');
            const loginFormElement = document.querySelector('#loginForm');
            const registerFormElement = document.querySelector('#registerForm');

            // Form switch logic
            if (registerLink) {
                registerLink.addEventListener('click', function (e) {
                    e.preventDefault();
                    loginForm.style.display = 'none';
                    registerForm.style.display = 'block';
                });
            }

            if (loginLink) {
                loginLink.addEventListener('click', function (e) {
                    e.preventDefault();
                    registerForm.style.display = 'none';
                    loginForm.style.display = 'block';
                });
            }

            // Validate Remember Me checkbox
            loginFormElement.addEventListener('submit', function (e) {
                if (!rememberMe.checked) {
                    e.preventDefault();
                    alert('Please check the Remember Me box before logging in.');
                }
            });

            // Validate Terms & Conditions checkbox
            registerFormElement.addEventListener('submit', function (e) {
                if (!terms.checked) {
                    e.preventDefault();
                    alert('Please agree to the terms & conditions before registering.');
                }
            });
        });
    </script>
</body>
</html>
