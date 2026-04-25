<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow — Register</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../../../Public/Css/Register.css">
</head>
<body>
    <div class="login-page">
        <div class="page-bg"></div>

        <!-- Main Card (Posisi dibalik: Ilustrasi Kiri, Form Kanan) -->
        <div class="main-card">
            
            <!-- === Kiri: Ilustrasi + Kartu Mengapung === -->
            <div class="panel-left-illustration">
                <div class="float-card float-card-1">
                    <div class="fc-priority high"></div>
                    <div class="fc-title">Raw Material Check</div>
                    <div class="fc-tags"><span class="fc-tag fc-tag-quality">Quality</span></div>
                    <div class="fc-meta">
                        <span class="fc-id">#RM-9281</span>
                        <div class="fc-avatars">
                            <div class="fc-avatar" style="background:#4da6ff;">D</div>
                        </div>
                    </div>
                </div>

                <div class="float-card float-card-2">
                    <div class="fc-priority medium"></div>
                    <div class="fc-title">Parts Staging Area</div>
                    <div class="fc-progress-bar"><div class="fc-progress-fill" style="width:45%;"></div></div>
                    <div class="fc-meta">
                        <span class="fc-id">#STG-1023</span>
                    </div>
                </div>

                <div class="float-card float-card-3">
                    <div class="fc-priority low"></div>
                    <div class="fc-title">Inventory Update</div>
                    <div class="fc-tags"><span class="fc-tag fc-tag-logistics">Logistics</span></div>
                    <div class="fc-meta">
                        <span class="fc-id">#INV-5521</span>
                        <div class="fc-avatars">
                            <div class="fc-avatar" style="background:#ffaa00;">T</div>
                        </div>
                    </div>
                </div>

                <div class="panel-illustration">
                    <!-- SVG Pekerja Industri (sama) -->
                    <svg viewBox="0 0 300 380" fill="none" xmlns="http://www.w3.org/2000/svg" class="person-svg">
                        <ellipse cx="150" cy="360" rx="90" ry="18" fill="rgba(0,180,160,0.06)"/>
                        <rect x="118" y="280" width="22" height="70" rx="8" fill="#2a3a4a"/><rect x="158" y="280" width="22" height="70" rx="8" fill="#2a3a4a"/>
                        <rect x="112" y="336" width="34" height="18" rx="6" fill="#1a2530"/><rect x="152" y="336" width="34" height="18" rx="6" fill="#1a2530"/>
                        <rect x="115" y="340" width="28" height="3" rx="1.5" fill="#ffaa00"/><rect x="155" y="340" width="28" height="3" rx="1.5" fill="#ffaa00"/>
                        <rect x="105" y="180" width="88" height="110" rx="12" fill="#00b4a0"/>
                        <rect x="105" y="210" width="88" height="4" rx="2" fill="#c8f0e8" opacity="0.7"/><rect x="105" y="250" width="88" height="4" rx="2" fill="#c8f0e8" opacity="0.7"/>
                        <path d="M130 180 L149 200 L168 180" fill="#009688"/><rect x="135" y="174" width="28" height="10" rx="4" fill="#009688"/>
                        <rect x="78" y="185" width="24" height="75" rx="10" fill="#00b4a0"/><rect x="196" y="185" width="24" height="75" rx="10" fill="#00b4a0"/>
                        <rect x="80" y="250" width="20" height="40" rx="8" fill="#d4a574"/><rect x="198" y="250" width="20" height="40" rx="8" fill="#d4a574"/>
                        <rect x="192" y="282" width="38" height="52" rx="5" fill="#f0f4f8" stroke="#c8d0dc" stroke-width="1.5"/>
                        <rect x="200" y="292" width="24" height="3" rx="1.5" fill="#c8d0dc"/><rect x="200" y="300" width="18" height="3" rx="1.5" fill="#c8d0dc"/><rect x="200" y="308" width="22" height="3" rx="1.5" fill="#c8d0dc"/><rect x="200" y="316" width="14" height="3" rx="1.5" fill="#c8d0dc"/>
                        <path d="M197 293 L199 296 L203 290" stroke="#00b4a0" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                        <path d="M197 301 L199 304 L203 298" stroke="#00b4a0" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                        <circle cx="90" cy="292" r="10" fill="#d4a574"/>
                        <rect x="140" y="150" width="18" height="22" rx="6" fill="#d4a574"/>
                        <ellipse cx="149" cy="125" rx="38" ry="42" fill="#d4a574"/>
                        <ellipse cx="149" cy="95" rx="44" ry="22" fill="#ffaa00"/><rect x="105" y="90" width="88" height="16" rx="4" fill="#ffaa00"/><rect x="105" y="98" width="88" height="4" rx="2" fill="#e69500"/><ellipse cx="149" cy="108" rx="48" ry="6" fill="#e69500"/><rect x="125" y="86" width="18" height="4" rx="2" fill="#ffcc44" opacity="0.5"/>
                        <circle cx="134" cy="124" r="3.5" fill="#1a2530"/><circle cx="162" cy="124" r="3.5" fill="#1a2530"/>
                        <circle cx="135.5" cy="122.5" r="1.2" fill="white"/><circle cx="163.5" cy="122.5" r="1.2" fill="white"/>
                        <path d="M126 115 Q134 111 140 115" stroke="#1a2530" stroke-width="2.5" fill="none" stroke-linecap="round"/><path d="M156 115 Q162 111 170 115" stroke="#1a2530" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                        <path d="M149 128 Q151 134 149 136" stroke="#c4956a" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                        <path d="M138 142 Q149 152 160 142" stroke="#b07a56" stroke-width="2" fill="none" stroke-linecap="round"/>
                        <ellipse cx="111" cy="125" rx="6" ry="9" fill="#d4a574"/><ellipse cx="187" cy="125" rx="6" ry="9" fill="#d4a574"/>
                        <rect x="116" y="218" width="24" height="32" rx="4" fill="white" stroke="#c8d0dc" stroke-width="1"/><rect x="120" y="222" width="16" height="8" rx="2" fill="#4da6ff"/><rect x="120" y="234" width="16" height="2" rx="1" fill="#c8d0dc"/><rect x="120" y="239" width="12" height="2" rx="1" fill="#c8d0dc"/><rect x="125" y="215" width="6" height="5" rx="1" fill="#c8d0dc"/>
                    </svg>
                </div>
                <div class="panel-glow"></div>
                <canvas class="panel-particles" id="particleCanvas"></canvas>
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

                <p class="register-text" style="margin-top: 24px;">Already have an account? <a href="./V_login.php" class="register-link" id="loginLink">Login now</a></p>
            </div>
        </div>
    </div>

    <!-- Toast -->
    <div class="toast-container" id="toastContainer"></div>

    <script src="../../../Public/Js/Register.js"></script>
</body>
</html>