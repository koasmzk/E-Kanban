<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow — Login</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../../../Public/Css/Login.css">
</head>
<body>
    <div class="login-layout">
        <!-- === Sisi Kiri: Form Login === -->
        <div class="login-left">
            <!-- Logo -->
            <div class="login-logo">
                <div class="logo-icon"><i class="fa-solid fa-bolt"></i></div>
                <div class="logo-text">TaskFlow</div>
            </div>

            <!-- Form Container -->
            <div class="login-form-container">
                <h1 class="login-title">Welcome back!</h1>
                <p class="login-subtitle">Simplify your workflow and manage tasks effortlessly with TaskFlow.</p>

                <form id="loginForm" novalidate>
                    <!-- Username -->
                    <div class="form-group">
                        <label class="form-label" for="username">Username</label>
                        <div class="input-wrapper">
                            <i class="fa-regular fa-user input-icon"></i>
                            <input type="text" class="form-input" id="username" placeholder="Enter your username" autocomplete="username">
                        </div>
                        <span class="form-error" id="usernameError"></span>
                    </div>

                    <!-- Password -->
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

                    <!-- Remember & Forgot -->
                    <div class="form-options">
                        <label class="checkbox-label">
                            <input type="checkbox" id="rememberMe">
                            <span class="checkmark"></span>
                            Remember me
                        </label>
                        <a href="#" class="forgot-link" id="forgotLink">Forgot password?</a>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn-login" id="loginBtn">
                        <span class="btn-text">Login</span>
                        <span class="btn-loader" style="display:none;"><i class="fa-solid fa-spinner fa-spin"></i></span>
                    </button>
                </form>

                <!-- Divider -->
                <div class="divider">
                    <span>or continue with</span>
                </div>

                <!-- Social Login -->
                <div class="social-login">
                    <button class="social-btn" aria-label="Login with Google">
                        <svg viewBox="0 0 24 24" width="18" height="18"><path fill="#EA4335" d="M5.27 9.76A7.08 7.08 0 0 1 12 4.91c1.69 0 3.22.59 4.42 1.56l3.31-3.31A11.97 11.97 0 0 0 12 0 12 12 0 0 0 1.24 6.65l4.03 3.11Z"/><path fill="#34A853" d="M16.04 18.01A7.4 7.4 0 0 1 12 19.09a7.08 7.08 0 0 1-6.73-4.85l-4.03 3.11A12 12 0 0 0 12 24c3.08 0 5.92-1.12 8.09-3.01l-4.05-2.98Z"/><path fill="#4A90D9" d="M20.09 20.99A11.82 11.82 0 0 0 24 12c0-.79-.08-1.57-.22-2.32H12v4.64h6.73a5.87 5.87 0 0 1-2.69 3.69l4.05 2.98Z"/><path fill="#FBBC05" d="M5.27 14.24A7.2 7.2 0 0 1 4.91 12c0-.78.13-1.54.36-2.24L1.24 6.65A12 12 0 0 0 0 12c0 1.94.46 3.77 1.24 5.35l4.03-3.11Z"/></svg>
                    </button>
                    <button class="social-btn" aria-label="Login with Apple">
                        <i class="fa-brands fa-apple" style="font-size:20px;"></i>
                    </button>
                    <button class="social-btn" aria-label="Login with GitHub">
                        <i class="fa-brands fa-github" style="font-size:18px;"></i>
                    </button>
                </div>

                <!-- Register -->
                <p class="register-text">Not a member? <a href="#" class="register-link" id="registerLink">Register now</a></p>
            </div>
        </div>

        <!-- === Sisi Kanan: Ilustrasi === -->
        <div class="login-right">
            <!-- Konten dekoratif -->
            <div class="illustration-content">
                <!-- Kartu Kanban Mengapung -->
                <div class="float-card float-card-1">
                    <div class="fc-priority high"></div>
                    <div class="fc-title">Design Sprint</div>
                    <div class="fc-tags"><span class="fc-tag">Design</span></div>
                    <div class="fc-avatars">
                        <div class="fc-avatar" style="background:#6c5ce7;">A</div>
                        <div class="fc-avatar" style="background:#ff6b6b; margin-left:-6px;">S</div>
                    </div>
                </div>

                <div class="float-card float-card-2">
                    <div class="fc-priority medium"></div>
                    <div class="fc-title">Backend API</div>
                    <div class="fc-progress-bar"><div class="fc-progress-fill" style="width:65%;"></div></div>
                    <div class="fc-avatars">
                        <div class="fc-avatar" style="background:#4da6ff;">R</div>
                    </div>
                </div>

                <div class="float-card float-card-3">
                    <div class="fc-priority low"></div>
                    <div class="fc-title">User Research</div>
                    <div class="fc-tags"><span class="fc-tag">Research</span></div>
                </div>

                <!-- Ilustrasi Utama -->
                <div class="main-illustration">
                    <div class="illust-person">
                        <!-- SVG Person -->
                        <svg viewBox="0 0 280 340" fill="none" xmlns="http://www.w3.org/2000/svg" class="person-svg">
                            <!-- Body / Shirt -->
                            <ellipse cx="140" cy="300" rx="80" ry="40" fill="rgba(108,92,231,0.15)"/>
                            <path d="M90 180 C90 160 100 140 140 140 C180 140 190 160 190 180 L195 300 C195 310 180 320 140 320 C100 320 85 310 85 300 Z" fill="#6c5ce7"/>
                            <!-- Collar -->
                            <path d="M120 145 L140 170 L160 145" stroke="#5a4bd1" stroke-width="3" fill="none"/>
                            <!-- Head -->
                            <circle cx="140" cy="110" r="42" fill="#f4c7a3"/>
                            <!-- Hair -->
                            <path d="M98 105 C98 70 115 55 140 55 C165 55 182 70 182 105 C182 95 170 80 140 80 C110 80 98 95 98 105Z" fill="#2d1b69"/>
                            <!-- Eyes closed (meditating) -->
                            <path d="M122 108 Q128 103 134 108" stroke="#2d1b69" stroke-width="2" fill="none" stroke-linecap="round"/>
                            <path d="M148 108 Q154 103 160 108" stroke="#2d1b69" stroke-width="2" fill="none" stroke-linecap="round"/>
                            <!-- Smile -->
                            <path d="M130 122 Q140 130 150 122" stroke="#c4856c" stroke-width="2" fill="none" stroke-linecap="round"/>
                            <!-- Arms crossed / resting -->
                            <path d="M90 190 C70 200 60 230 80 250" stroke="#f4c7a3" stroke-width="14" fill="none" stroke-linecap="round"/>
                            <path d="M190 190 C210 200 220 230 200 250" stroke="#f4c7a3" stroke-width="14" fill="none" stroke-linecap="round"/>
                            <!-- Hands on knees -->
                            <circle cx="80" cy="252" r="10" fill="#f4c7a3"/>
                            <circle cx="200" cy="252" r="10" fill="#f4c7a3"/>
                            <!-- Legs crossed -->
                            <path d="M110 290 C100 300 80 310 70 305" stroke="#3a3d52" stroke-width="16" fill="none" stroke-linecap="round"/>
                            <path d="M170 290 C180 300 200 310 210 305" stroke="#3a3d52" stroke-width="16" fill="none" stroke-linecap="round"/>
                        </svg>
                    </div>

                    <!-- Glow di belakang -->
                    <div class="illust-glow"></div>
                </div>

                <!-- Teks Inspirasi -->
                <div class="illustration-text">
                    <h2>Make your work easier<br>and organized</h2>
                    <p>Manage projects, track progress, and collaborate seamlessly with TaskFlow's intuitive Kanban board.</p>
                </div>

                <!-- Statistik Mini -->
                <div class="mini-stats">
                    <div class="mini-stat">
                        <div class="mini-stat-icon"><i class="fa-solid fa-list-check"></i></div>
                        <div>
                            <div class="mini-stat-value">2,400+</div>
                            <div class="mini-stat-label">Tasks Completed</div>
                        </div>
                    </div>
                    <div class="mini-stat">
                        <div class="mini-stat-icon"><i class="fa-solid fa-users"></i></div>
                        <div>
                            <div class="mini-stat-value">500+</div>
                            <div class="mini-stat-label">Active Teams</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- === Kotak Guide Book Mengapung === -->
        <div class="guide-book-box" id="guideBookBox">
            <div class="guide-icon-wrapper">
                <i class="fa-solid fa-book-open"></i>
            </div>
            <div class="guide-text">
                <span class="guide-title">Guide Book</span>
                <span class="guide-desc">Learn how to use TaskFlow</span>
            </div>
            <i class="fa-solid fa-arrow-right guide-arrow"></i>
        </div>
    </div>

    <!-- === Modal Guide Book === -->
    <div class="guide-overlay" id="guideOverlay">
        <div class="guide-modal">
            <div class="guide-modal-header">
                <div class="guide-modal-title">
                    <i class="fa-solid fa-book-open"></i>
                    <h3>TaskFlow User Guide</h3>
                </div>
                <button class="guide-close-btn" id="guideCloseBtn" aria-label="Close guide">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="guide-modal-body">
                <!-- Step 1 -->
                <div class="guide-step">
                    <div class="guide-step-number">1</div>
                    <div class="guide-step-content">
                        <h4>Dashboard Overview</h4>
                        <p>After logging in, you'll see the main dashboard with task statistics cards showing Total Tasks, In Progress, Completed Today, and Overdue counts at the top.</p>
                    </div>
                </div>
                <!-- Step 2 -->
                <div class="guide-step">
                    <div class="guide-step-number">2</div>
                    <div class="guide-step-content">
                        <h4>Kanban Board</h4>
                        <p>Your tasks are organized in columns: Backlog, To Do, and In Progress. Each card shows priority, description, tags, due date, and assigned team members.</p>
                    </div>
                </div>
                <!-- Step 3 -->
                <div class="guide-step">
                    <div class="guide-step-number">3</div>
                    <div class="guide-step-content">
                        <h4>Drag & Drop</h4>
                        <p>Move tasks between columns by dragging and dropping them. This automatically updates the task status and the statistics counters.</p>
                    </div>
                </div>
                <!-- Step 4 -->
                <div class="guide-step">
                    <div class="guide-step-number">4</div>
                    <div class="guide-step-content">
                        <h4>Create New Tasks</h4>
                        <p>Click the "New Task" button or the "+" icon on any column to create a task. Fill in the title, description, priority, due date, and tags.</p>
                    </div>
                </div>
                <!-- Step 5 -->
                <div class="guide-step">
                    <div class="guide-step-number">5</div>
                    <div class="guide-step-content">
                        <h4>Filter & Search</h4>
                        <p>Use the filter buttons (All, High Priority, Overdue) to focus on specific tasks. The search bar lets you find tasks by title or description.</p>
                    </div>
                </div>
                <!-- Step 6 -->
                <div class="guide-step">
                    <div class="guide-step-number">6</div>
                    <div class="guide-step-content">
                        <h4>Sidebar Navigation</h4>
                        <p>Use the sidebar to switch between Overview, Dashboard, Calendar, and Messages. Collapse it using the arrow button for more workspace. Toggle between dark and light mode with the theme button.</p>
                    </div>
                </div>
            </div>
            <div class="guide-modal-footer">
                <button class="guide-nav-btn" id="guidePrevBtn" disabled><i class="fa-solid fa-chevron-left"></i> Previous</button>
                <div class="guide-dots" id="guideDots"></div>
                <button class="guide-nav-btn" id="guideNextBtn">Next <i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>
    </div>

    <!-- === Toast === -->
    <div class="toast-container" id="toastContainer"></div>

    <script src="../../../Public/Js/Login.js"></script>
</body>
</html>