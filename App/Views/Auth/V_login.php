<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow — Material & Part Flow</title>
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
                    <div class="logo-text">TaskFlow</div>
                    <span class="logo-badge">Industrial</span>
                </div>

                <h1 class="login-title">Welcome back</h1>
                <p class="login-subtitle">Sign in to monitor your material & part flow.</p>

                <form id="loginForm" novalidate>
                    <div class="form-group">
                        <label class="form-label" for="username">Username</label>
                        <div class="input-wrapper">
                            <i class="fa-regular fa-user input-icon"></i>
                            <input type="text" class="form-input" id="username" placeholder="Enter your username" autocomplete="username">
                        </div>
                        <span class="form-error" id="usernameError"></span>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-lock input-icon"></i>
                            <input type="password" class="form-input" id="password" placeholder="Enter your password" autocomplete="current-password">
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
                            Remember me
                        </label>
                        <a href="#" class="forgot-link" id="forgotLink">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn-login" id="loginBtn">
                        <span class="btn-text">Login</span>
                        <span class="btn-loader" style="display:none;"><i class="fa-solid fa-spinner fa-spin"></i></span>
                    </button>
                </form>

                <div class="divider"><span>or continue with</span></div>

                <div class="social-login">
                    <button class="social-btn" aria-label="Login with Google">
                        <svg viewBox="0 0 24 24" width="18" height="18"><path fill="#EA4335" d="M5.27 9.76A7.08 7.08 0 0 1 12 4.91c1.69 0 3.22.59 4.42 1.56l3.31-3.31A11.97 11.97 0 0 0 12 0 12 12 0 0 0 1.24 6.65l4.03 3.11Z"/><path fill="#34A853" d="M16.04 18.01A7.4 7.4 0 0 1 12 19.09a7.08 7.08 0 0 1-6.73-4.85l-4.03 3.11A12 12 0 0 0 12 24c3.08 0 5.92-1.12 8.09-3.01l-4.05-2.98Z"/><path fill="#4A90D9" d="M20.09 20.99A11.82 11.82 0 0 0 24 12c0-.79-.08-1.57-.22-2.32H12v4.64h6.73a5.87 5.87 0 0 1-2.69 3.69l4.05 2.98Z"/><path fill="#FBBC05" d="M5.27 14.24A7.2 7.2 0 0 1 4.91 12c0-.78.13-1.54.36-2.24L1.24 6.65A12 12 0 0 0 0 12c0 1.94.46 3.77 1.24 5.35l4.03-3.11Z"/></svg>
                    </button>
                    <button class="social-btn" aria-label="Login with Apple">
                        <i class="fa-brands fa-apple" style="font-size:20px;"></i>
                    </button>
                    <button class="social-btn" aria-label="Login with SSO">
                        <i class="fa-solid fa-building" style="font-size:16px;"></i>
                    </button>
                </div>

                <p class="register-text">Not a member? <a href="#" class="register-link" id="registerLink">Register now</a></p>
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
                <span class="guide-title">Guide Book</span>
                <span class="guide-desc">Learn how to use TaskFlow</span>
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