<?php
// Ambil flash message dan old input dari session jika ada
 $errors = $_SESSION['register_errors'] ?? [];
 $oldInput = $_SESSION['old_input'] ?? [];
unset($_SESSION['register_errors'], $_SESSION['old_input']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun E-Kanban</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= $GLOBALS['baseURL'] ?>/Public/Css/Register.css?v=<?= time() ?>">
</head>
<body>
    <div class="login-page">
        <div class="main-card">
            <!-- === Kiri: Ilustrasi === -->
            <div class="panel-left-illustration">
                <div class="illustration-wrapper">
                    <img src="<?= $GLOBALS['baseURL'] ?>/Public/Assets/Img/Illustration.png" alt="TaskFlow Illustration" class="illustration-img">
                </div>
                <div class="illustration-tagline">
                    <span class="tagline-accent"></span>
                    <h2 class="tagline-text">E-Kanban Untuk Meningkatkan<br>Efisiensi Material Flow</h2>
                </div>
            </div>

            <!-- === Kanan: Form Register === -->
            <div class="panel-right-form">
                <div class="login-logo">
                    <div class="logo-icon"><i class="fa-solid fa-tasks"></i></div>
                    <div class="logo-text">E-Kanban</div>
                </div>

                <h1 class="login-title">Buat Akun</h1>
                <p class="login-subtitle">Mulai membuat akun anda dengan mudah!</p>

                <!-- Error Global dari Server (Jika JS mati/bypass) -->
                <?php if (!empty($errors)): ?>
                    <div style="color: #dc3545; background: #f8d7da; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 0.85rem;">
                        <ul style="margin-left: 15px; margin-bottom: 0;">
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- ✮ PERBAIKAN: Tambah action, method, dan pastikan id ada ✮ -->
                <form id="registerForm" action="./register/store" method="POST" novalidate>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="fullname">Full Name</label>
                            <div class="input-wrapper">
                                <i class="fa-regular fa-id-card input-icon"></i>
                                <!-- ✮ PERBAIKAN: Tambah name="fullname" dan value old input ✮ -->
                                <input type="text" class="form-input" id="fullname" name="fullname" placeholder="Nama Anda?" autocomplete="name" value="<?= htmlspecialchars($oldInput['fullname'] ?? '') ?>">
                            </div>
                            <span class="form-error" id="fullnameError"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="regUsername">Username</label>
                            <div class="input-wrapper">
                                <i class="fa-regular fa-user input-icon"></i>
                                <!-- ✮ PERBAIKAN: Tambah name="username" dan value old input ✮ -->
                                <input type="text" class="form-input" id="regUsername" name="username" placeholder="Panggilan?" autocomplete="username" value="<?= htmlspecialchars($oldInput['username'] ?? '') ?>">
                            </div>
                            <span class="form-error" id="regUsernameError"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">Email Address</label>
                        <div class="input-wrapper">
                            <i class="fa-regular fa-envelope input-icon"></i>
                            <!-- ✮ PERBAIKAN: Tambah name="email" dan value old input ✮ -->
                            <input type="email" class="form-input" id="email" name="email" placeholder="Masukkan Email Anda" autocomplete="email" value="<?= htmlspecialchars($oldInput['email'] ?? '') ?>">
                        </div>
                        <span class="form-error" id="emailError"></span>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="regPassword">Password</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-lock input-icon"></i>
                                <!-- ✮ PERBAIKAN: Tambah name="password" (tidak pakai value old untuk password) ✮ -->
                                <input type="password" class="form-input" id="regPassword" name="password" placeholder="8 Karakter!" autocomplete="new-password">
                            </div>
                            <span class="form-error" id="regPasswordError"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="confirmPassword">Confirm</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-lock input-icon"></i>
                                <!-- ✮ PERBAIKAN: Tambah name="confirm_password" ✮ -->
                                <input type="password" class="form-input" id="confirmPassword" name="confirm_password" placeholder="Mohon Ulangi" autocomplete="new-password">
                            </div>
                            <span class="form-error" id="confirmPasswordError"></span>
                        </div>
                    </div>

                    <button type="submit" class="btn-login" id="registerBtn">
                        <span class="btn-text">Buat Akun Saya!</span>
                        <span class="btn-loader" style="display:none;"><i class="fa-solid fa-spinner fa-spin"></i></span>
                    </button>
                </form>

                <p class="register-text" style="margin-top: 24px;">Sudah Punya Akun? <a href="/login" class="register-link" id="loginLink">Ayo Masuk!</a></p>
            </div>
        </div>
    </div>

    <div class="toast-container" id="toastContainer"></div>
    <script src="<?= $GLOBALS['baseURL'] ?>/Public/Js/Register.js?v=<?= time() ?>"></script>
</body>
</html>