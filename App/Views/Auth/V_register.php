<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow — Register</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../../../Public/Css/Register.css?v=2">
</head>
<body>
    <div class="login-page">
        <div class="main-card">
            <!-- === Kiri: Ilustrasi === -->
            <div class="panel-left-illustration">
                <div class="illustration-wrapper">
                    <img src="../../../Public/Assets/Img/Illustration.png" alt="TaskFlow Illustration" class="illustration-img">
                </div>
                <div class="illustration-tagline">
                    <span class="tagline-accent"></span>
                    <h2 class="tagline-text">E-Kanban Untuk Meningkatkan<br>Efisiensi Material Flow</h2>
                </div>
            </div>

            <!-- === Kanan: Form Register === -->
            <div class="panel-right-form">
                <div class="login-logo">
                    <div class="logo-icon"><i class="fa-solid fa-bolt"></i></div>
                    <div class="logo-text">TaskFlow</div>
                    <span class="logo-badge">Industrial</span>
                </div>

                <h1 class="login-title">Create Account</h1>
                <p class="login-subtitle">Start tracking your material flow today.</p>

                <form id="registerForm" novalidate>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="fullname">Full Name</label>
                            <div class="input-wrapper">
                                <i class="fa-regular fa-id-card input-icon"></i>
                                <input type="text" class="form-input" id="fullname" placeholder="Your name" autocomplete="name">
                            </div>
                            <span class="form-error" id="fullnameError"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="regUsername">Username</label>
                            <div class="input-wrapper">
                                <i class="fa-regular fa-user input-icon"></i>
                                <input type="text" class="form-input" id="regUsername" placeholder="Username" autocomplete="username">
                            </div>
                            <span class="form-error" id="regUsernameError"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">Email Address</label>
                        <div class="input-wrapper">
                            <i class="fa-regular fa-envelope input-icon"></i>
                            <input type="email" class="form-input" id="email" placeholder="name@company.com" autocomplete="email">
                        </div>
                        <span class="form-error" id="emailError"></span>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="regPassword">Password</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-lock input-icon"></i>
                                <input type="password" class="form-input" id="regPassword" placeholder="Min 8 chars" autocomplete="new-password">
                            </div>
                            <span class="form-error" id="regPasswordError"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="confirmPassword">Confirm</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-lock input-icon"></i>
                                <input type="password" class="form-input" id="confirmPassword" placeholder="Repeat" autocomplete="new-password">
                            </div>
                            <span class="form-error" id="confirmPasswordError"></span>
                        </div>
                    </div>

                    <div class="form-options" style="margin-bottom: 22px;">
                        <label class="checkbox-label">
                            <input type="checkbox" id="agreeTerms">
                            <span class="checkmark"></span>
                            I agree to the Terms & Conditions
                        </label>
                    </div>

                    <button type="submit" class="btn-login" id="registerBtn">
                        <span class="btn-text">Create Account</span>
                        <span class="btn-loader" style="display:none;"><i class="fa-solid fa-spinner fa-spin"></i></span>
                    </button>
                </form>

                <p class="register-text" style="margin-top: 24px;">Already have an account? <a href="#" class="register-link" id="loginLink">Login now</a></p>
            </div>
        </div>
    </div>

    <div class="toast-container" id="toastContainer"></div>
    <script src="../../../Public/Js/Register.js?v=2"></script>
</body>
</html>