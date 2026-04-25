<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow — Material & Part Flow</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../../../Public/Css/Login.css">
</head>
<body>
    <div class="login-page">
        <!-- Background halus -->
        <div class="page-bg"></div>

        <!-- Main Card -->
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
                <br>
                <p class="register-text">Not a member? <a href="./V_register.php" class="register-link" id="registerLink">Register now</a></p>
            </div>

            <!-- === Kanan: Ilustrasi + Kartu Mengapung === -->
            <div class="panel-right">
                <!-- Kartu mengapung -->
                <div class="float-card float-card-1">
                    <div class="fc-priority high"></div>
                    <div class="fc-title">Material Inspection</div>
                    <div class="fc-tags"><span class="fc-tag fc-tag-quality">Quality</span></div>
                    <div class="fc-meta">
                        <span class="fc-id">#MAT-0841</span>
                        <div class="fc-avatars">
                            <div class="fc-avatar" style="background:#4da6ff;">B</div>
                            <div class="fc-avatar" style="background:#ff6b6b; margin-left:-6px;">S</div>
                        </div>
                    </div>
                </div>

                <div class="float-card float-card-2">
                    <div class="fc-priority medium"></div>
                    <div class="fc-title">Parts Assembly Line B</div>
                    <div class="fc-progress-bar"><div class="fc-progress-fill" style="width:72%;"></div></div>
                    <div class="fc-meta">
                        <span class="fc-id">#PRT-0293</span>
                        <div class="fc-avatars">
                            <div class="fc-avatar" style="background:#00d68f;">R</div>
                        </div>
                    </div>
                </div>

                <div class="float-card float-card-3">
                    <div class="fc-priority low"></div>
                    <div class="fc-title">Shipping Request</div>
                    <div class="fc-tags"><span class="fc-tag fc-tag-logistics">Logistics</span></div>
                    <div class="fc-meta">
                        <span class="fc-id">#SHP-1567</span>
                    </div>
                </div>

                <div class="float-card float-card-4">
                    <div class="fc-priority medium"></div>
                    <div class="fc-title">Quality Check B12</div>
                    <div class="fc-tags"><span class="fc-tag fc-tag-quality">Quality</span></div>
                    <div class="fc-meta">
                        <span class="fc-id">#QC-0412</span>
                        <div class="fc-avatars">
                            <div class="fc-avatar" style="background:#ffaa00;">M</div>
                        </div>
                    </div>
                </div>

                <!-- Ilustrasi Pekerja Industri -->
                <div class="panel-illustration">
                    <svg viewBox="0 0 300 380" fill="none" xmlns="http://www.w3.org/2000/svg" class="person-svg">
                        <ellipse cx="150" cy="360" rx="90" ry="18" fill="rgba(0,180,160,0.06)"/>
                        <rect x="118" y="280" width="22" height="70" rx="8" fill="#2a3a4a"/>
                        <rect x="158" y="280" width="22" height="70" rx="8" fill="#2a3a4a"/>
                        <rect x="112" y="336" width="34" height="18" rx="6" fill="#1a2530"/>
                        <rect x="152" y="336" width="34" height="18" rx="6" fill="#1a2530"/>
                        <rect x="115" y="340" width="28" height="3" rx="1.5" fill="#ffaa00"/>
                        <rect x="155" y="340" width="28" height="3" rx="1.5" fill="#ffaa00"/>
                        <rect x="105" y="180" width="88" height="110" rx="12" fill="#00b4a0"/>
                        <rect x="105" y="210" width="88" height="4" rx="2" fill="#c8f0e8" opacity="0.7"/>
                        <rect x="105" y="250" width="88" height="4" rx="2" fill="#c8f0e8" opacity="0.7"/>
                        <path d="M130 180 L149 200 L168 180" fill="#009688"/>
                        <rect x="135" y="174" width="28" height="10" rx="4" fill="#009688"/>
                        <rect x="78" y="185" width="24" height="75" rx="10" fill="#00b4a0"/>
                        <rect x="196" y="185" width="24" height="75" rx="10" fill="#00b4a0"/>
                        <rect x="80" y="250" width="20" height="40" rx="8" fill="#d4a574"/>
                        <rect x="198" y="250" width="20" height="40" rx="8" fill="#d4a574"/>
                        <rect x="192" y="282" width="38" height="52" rx="5" fill="#f0f4f8" stroke="#c8d0dc" stroke-width="1.5"/>
                        <rect x="200" y="292" width="24" height="3" rx="1.5" fill="#c8d0dc"/>
                        <rect x="200" y="300" width="18" height="3" rx="1.5" fill="#c8d0dc"/>
                        <rect x="200" y="308" width="22" height="3" rx="1.5" fill="#c8d0dc"/>
                        <rect x="200" y="316" width="14" height="3" rx="1.5" fill="#c8d0dc"/>
                        <path d="M197 293 L199 296 L203 290" stroke="#00b4a0" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                        <path d="M197 301 L199 304 L203 298" stroke="#00b4a0" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                        <circle cx="90" cy="292" r="10" fill="#d4a574"/>
                        <rect x="140" y="150" width="18" height="22" rx="6" fill="#d4a574"/>
                        <ellipse cx="149" cy="125" rx="38" ry="42" fill="#d4a574"/>
                        <ellipse cx="149" cy="95" rx="44" ry="22" fill="#ffaa00"/>
                        <rect x="105" y="90" width="88" height="16" rx="4" fill="#ffaa00"/>
                        <rect x="105" y="98" width="88" height="4" rx="2" fill="#e69500"/>
                        <ellipse cx="149" cy="108" rx="48" ry="6" fill="#e69500"/>
                        <rect x="125" y="86" width="18" height="4" rx="2" fill="#ffcc44" opacity="0.5"/>
                        <circle cx="134" cy="124" r="3.5" fill="#1a2530"/>
                        <circle cx="162" cy="124" r="3.5" fill="#1a2530"/>
                        <circle cx="135.5" cy="122.5" r="1.2" fill="white"/>
                        <circle cx="163.5" cy="122.5" r="1.2" fill="white"/>
                        <path d="M126 115 Q134 111 140 115" stroke="#1a2530" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                        <path d="M156 115 Q162 111 170 115" stroke="#1a2530" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                        <path d="M149 128 Q151 134 149 136" stroke="#c4956a" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                        <path d="M138 142 Q149 152 160 142" stroke="#b07a56" stroke-width="2" fill="none" stroke-linecap="round"/>
                        <ellipse cx="111" cy="125" rx="6" ry="9" fill="#d4a574"/>
                        <ellipse cx="187" cy="125" rx="6" ry="9" fill="#d4a574"/>
                        <rect x="116" y="218" width="24" height="32" rx="4" fill="white" stroke="#c8d0dc" stroke-width="1"/>
                        <rect x="120" y="222" width="16" height="8" rx="2" fill="#4da6ff"/>
                        <rect x="120" y="234" width="16" height="2" rx="1" fill="#c8d0dc"/>
                        <rect x="120" y="239" width="12" height="2" rx="1" fill="#c8d0dc"/>
                        <rect x="125" y="215" width="6" height="5" rx="1" fill="#c8d0dc"/>
                    </svg>
                </div>

                <!-- Glow di belakang ilustrasi -->
                <div class="panel-glow"></div>

                <!-- Canvas partikel -->
                <canvas class="panel-particles" id="particleCanvas"></canvas>
            </div>
        </div>

        <!-- Guide Book Box Mengapung -->
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
                <div class="guide-modal-title">
                    <i class="fa-solid fa-book-open"></i>
                    <h3>TaskFlow Industrial Guide</h3>
                </div>
                <button class="guide-close-btn" id="guideCloseBtn" aria-label="Close guide">
                    <i class="fa-solid fa-xmark"></i>
                </button>
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

    <!-- Toast -->
    <div class="toast-container" id="toastContainer"></div>

    <script src="../../../Public/Js/Login.js"></script>
</body>
</html>