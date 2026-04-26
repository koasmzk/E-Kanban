<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk E-Kanban</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../../../Public/Css/Login.css?v=2">
</head>
<body>
    <div class="login-page">
        <div class="main-card">
            <!-- === Kiri: Form Login === -->
            <div class="panel-left">
                <div class="login-logo">
                    <div class="logo-icon"><i class="fa-solid fa-bolt"></i></div>
                    <div class="logo-text">E-Kanban</div>
                </div>

                <h1 class="login-title">Selamat Datang</h1>
                <p class="login-subtitle">Silahkan masuk dengan akun anda</p>

                <form id="loginForm" novalidate>
                    <div class="form-group">
                        <label class="form-label" for="username">Username</label>
                        <div class="input-wrapper">
                            <i class="fa-regular fa-user input-icon"></i>
                            <input type="text" class="form-input" id="username" placeholder="Masukkan Username" autocomplete="username">
                        </div>
                        <span class="form-error" id="usernameError"></span>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-lock input-icon"></i>
                            <input type="password" class="form-input" id="password" placeholder="Masukkan Password" autocomplete="current-password">
                            <button type="button" class="toggle-password" id="togglePassword" aria-label="Toggle password visibility">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                        <span class="form-error" id="passwordError"></span>
                    </div>

                    <div class="form-options">
                        <label class="checkbox-label">
                            <input type="checkbox" id="rememberMe">
                            <span class="checkmark"></span>
                            Ingat Saya?
                        </label>
                        <a href="#" class="forgot-link" id="forgotLink">Lupa Password?</a>
                    </div>

                    <button type="submit" class="btn-login" id="loginBtn">
                        <span class="btn-text">Masuk</span>
                        <span class="btn-loader" style="display:none;"><i class="fa-solid fa-spinner fa-spin"></i></span>
                    </button>
                </form>
                <br>
                <p class="register-text">Belum punya akun? <a href=".\V_register.php" class="register-link" id="registerLink">Ayo Buat!</a></p>
            </div>

            <!-- === Kanan: Ilustrasi === -->
            <div class="panel-right">
                <div class="illustration-wrapper">
                    <img src="../../../Public/Assets/Img/Illustration.png" alt="TaskFlow Illustration" class="illustration-img">
                </div>
                <div class="illustration-tagline">
                    <span class="tagline-accent"></span>
                    <h2 class="tagline-text">E-Kanban Untuk Meningkatkan<br>Efisiensi Material Flow</h2>
                </div>
            </div>
        </div>

        <!-- Guide Book Box -->
        <div class="guide-book-box" id="guideBookBox">
            <div class="guide-icon-wrapper"><i class="fa-solid fa-book-open"></i></div>
            <div class="guide-text">
                <span class="guide-title">Buku Panduan</span>
                <span class="guide-desc">Klik Untuk Mempelajari</span>
            </div>
            <i class="fa-solid fa-arrow-right guide-arrow"></i>
        </div>
    </div>

    <!-- Modal Guide Book -->
    <div class="guide-overlay" id="guideOverlay">
        <div class="guide-modal">
            <div class="guide-modal-header">
                <div class="guide-modal-title"><i class="fa-solid fa-book-open"></i><h3>TaskFlow Industrial Guide</h3></div>
                <button class="guide-close-btn" id="guideCloseBtn" aria-label="Close guide"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="guide-modal-body">
                <div class="guide-step"><div class="guide-step-number">1</div><div class="guide-step-content"><h4>Dashboard Overview</h4><p>After logging in, the dashboard displays real-time statistics: Total Materials, In Progress, Completed Today, and Overdue items.</p></div></div>
                <div class="guide-step"><div class="guide-step-number">2</div><div class="guide-step-content"><h4>Kanban Board — Material Flow</h4><p>Materials and parts are organized in columns: Backlog, To Do, and In Progress. Each card shows priority, part ID, and assigned operator.</p></div></div>
                <div class="guide-step"><div class="guide-step-number">3</div><div class="guide-step-content"><h4>Drag & Drop Status Updates</h4><p>Move material or part cards between columns by dragging them. This instantly updates the status and notifies the team.</p></div></div>
                <div class="guide-step"><div class="guide-step-number">4</div><div class="guide-step-content"><h4>Create Material / Part Tickets</h4><p>Click "New Task" or the "+" icon on any column to create a ticket. Specify part number, priority, due date, and category.</p></div></div>
                <div class="guide-step"><div class="guide-step-number">5</div><div class="guide-step-content"><h4>Filter & Search</h4><p>Filter by High Priority or Overdue to focus on critical items. Search by part ID or material name.</p></div></div>
                <div class="guide-step"><div class="guide-step-number">6</div><div class="guide-step-content"><h4>Sidebar & Theme</h4><p>Navigate between Overview, Dashboard, Calendar, and Messages via sidebar. Toggle dark/light mode for your environment.</p></div></div>
            </div>
            <div class="guide-modal-footer">
                <button class="guide-nav-btn" id="guidePrevBtn" disabled><i class="fa-solid fa-chevron-left"></i> Previous</button>
                <div class="guide-dots" id="guideDots"></div>
                <button class="guide-nav-btn" id="guideNextBtn">Next <i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>
    </div>

    <div class="toast-container" id="toastContainer"></div>
    <script src="../../../Public/Js/Login.js?v=2"></script>
</body>
</html>