// === Referensi DOM ===
const loginForm = document.getElementById('loginForm');
const usernameInput = document.getElementById('username');
const passwordInput = document.getElementById('password');
const togglePasswordBtn = document.getElementById('togglePassword');
const loginBtn = document.getElementById('loginBtn');
const guideBookBox = document.getElementById('guideBookBox');
const guideOverlay = document.getElementById('guideOverlay');
const guideCloseBtn = document.getElementById('guideCloseBtn');
const guidePrevBtn = document.getElementById('guidePrevBtn');
const guideNextBtn = document.getElementById('guideNextBtn');
const guideDotsContainer = document.getElementById('guideDots');
const forgotLink = document.getElementById('forgotLink');
const registerLink = document.getElementById('registerLink');

// === State Guide Book ===
let currentGuideStep = 0;
const totalGuideSteps = 6;

// === Toggle Password Visibility ===
togglePasswordBtn.addEventListener('click', () => {
    const isPassword = passwordInput.type === 'password';
    passwordInput.type = isPassword ? 'text' : 'password';
    togglePasswordBtn.innerHTML = isPassword
        ? '<i class="fa-regular fa-eye-slash"></i>'
        : '<i class="fa-regular fa-eye"></i>';
});

// === Validasi & Submit Form ===
loginForm.addEventListener('submit', (e) => {
    e.preventDefault();
    let valid = true;

    // Reset error
    clearError('username');
    clearError('password');

    const username = usernameInput.value.trim();
    const password = passwordInput.value.trim();

    if (!username) {
        showError('username', 'Username is required');
        valid = false;
    } else if (username.length < 3) {
        showError('username', 'Username must be at least 3 characters');
        valid = false;
    }

    if (!password) {
        showError('password', 'Password is required');
        valid = false;
    } else if (password.length < 6) {
        showError('password', 'Password must be at least 6 characters');
        valid = false;
    }

    if (!valid) return;

    // Simulasi loading
    loginBtn.classList.add('loading');
    loginBtn.disabled = true;

    setTimeout(() => {
        loginBtn.classList.remove('loading');
        loginBtn.disabled = false;
        showToast('success', 'Login successful! Redirecting to dashboard...');

        // Simulasi redirect
        setTimeout(() => {
            // window.location.href = 'index.html';
            showToast('info', 'Would redirect to dashboard (index.html)');
        }, 1500);
    }, 1800);
});

function showError(field, message) {
    const input = document.getElementById(field);
    const errorEl = document.getElementById(field + 'Error');
    input.classList.add('error');
    errorEl.textContent = message;
}

function clearError(field) {
    const input = document.getElementById(field);
    const errorEl = document.getElementById(field + 'Error');
    input.classList.remove('error');
    errorEl.textContent = '';
}

// Real-time hapus error saat mengetik
usernameInput.addEventListener('input', () => clearError('username'));
passwordInput.addEventListener('input', () => clearError('password'));

// === Lupa Password ===
forgotLink.addEventListener('click', (e) => {
    e.preventDefault();
    showToast('info', 'Password reset link has been sent to your email');
});

// === Register ===
registerLink.addEventListener('click', (e) => {
    e.preventDefault();
    showToast('info', 'Registration page coming soon');
});

// === Guide Book Box ===
guideBookBox.addEventListener('click', () => {
    openGuideModal();
});

function openGuideModal() {
    currentGuideStep = 0;
    renderGuideStep();
    guideOverlay.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeGuideModal() {
    guideOverlay.classList.remove('active');
    document.body.style.overflow = '';
}

guideCloseBtn.addEventListener('click', closeGuideModal);

guideOverlay.addEventListener('click', (e) => {
    if (e.target === guideOverlay) closeGuideModal();
});

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && guideOverlay.classList.contains('active')) {
        closeGuideModal();
    }
    if (guideOverlay.classList.contains('active')) {
        if (e.key === 'ArrowRight') navigateGuide(1);
        if (e.key === 'ArrowLeft') navigateGuide(-1);
    }
});

// Navigasi Guide
guidePrevBtn.addEventListener('click', () => navigateGuide(-1));
guideNextBtn.addEventListener('click', () => navigateGuide(1));

function navigateGuide(direction) {
    currentGuideStep += direction;
    if (currentGuideStep < 0) currentGuideStep = 0;
    if (currentGuideStep >= totalGuideSteps) {
        closeGuideModal();
        showToast('success', 'You\'re all set! Ready to login.');
        return;
    }
    renderGuideStep();
}

function renderGuideStep() {
    const steps = document.querySelectorAll('.guide-step');
    steps.forEach((step, i) => {
        step.classList.toggle('active', i === currentGuideStep);
    });

    // Dots
    guideDotsContainer.innerHTML = '';
    for (let i = 0; i < totalGuideSteps; i++) {
        const dot = document.createElement('div');
        dot.className = `guide-dot${i === currentGuideStep ? ' active' : ''}`;
        dot.addEventListener('click', () => {
            currentGuideStep = i;
            renderGuideStep();
        });
        guideDotsContainer.appendChild(dot);
    }

    // Tombol navigasi
    guidePrevBtn.disabled = currentGuideStep === 0;
    guideNextBtn.innerHTML = currentGuideStep === totalGuideSteps - 1
        ? 'Get Started <i class="fa-solid fa-check"></i>'
        : 'Next <i class="fa-solid fa-chevron-right"></i>';

    // Scroll ke step aktif
    const activeStep = steps[currentGuideStep];
    if (activeStep) {
        activeStep.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
}

// === Toast ===
function showToast(type, message) {
    const container = document.getElementById('toastContainer');
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;

    const icons = {
        success: 'fa-solid fa-circle-check',
        error: 'fa-solid fa-circle-xmark',
        info: 'fa-solid fa-circle-info'
    };

    toast.innerHTML = `<i class="${icons[type]}"></i><span>${message}</span>`;
    container.appendChild(toast);

    setTimeout(() => {
        if (toast.parentNode) toast.parentNode.removeChild(toast);
    }, 3000);
}

// === Inisialisasi Guide Dots (saat modal pertama kali) ===
// Tidak perlu karena dots dirender dinamis

// === Efek Partikel di Sisi Kanan ===
(function initParticles() {
    const rightPanel = document.querySelector('.login-right');
    if (!rightPanel) return;

    const canvas = document.createElement('canvas');
    canvas.style.cssText = 'position:absolute;inset:0;z-index:0;pointer-events:none;';
    rightPanel.appendChild(canvas);

    const ctx = canvas.getContext('2d');
    let particles = [];
    let animId;

    function resize() {
        canvas.width = rightPanel.clientWidth;
        canvas.height = rightPanel.clientHeight;
    }

    function createParticle() {
        return {
            x: Math.random() * canvas.width,
            y: Math.random() * canvas.height,
            size: Math.random() * 2 + 0.5,
            speedX: (Math.random() - 0.5) * 0.3,
            speedY: (Math.random() - 0.5) * 0.3,
            opacity: Math.random() * 0.4 + 0.1
        };
    }

    function init() {
        resize();
        particles = [];
        const count = Math.floor((canvas.width * canvas.height) / 12000);
        for (let i = 0; i < Math.min(count, 80); i++) {
            particles.push(createParticle());
        }
    }

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        particles.forEach(p => {
            p.x += p.speedX;
            p.y += p.speedY;

            if (p.x < 0) p.x = canvas.width;
            if (p.x > canvas.width) p.x = 0;
            if (p.y < 0) p.y = canvas.height;
            if (p.y > canvas.height) p.y = 0;

            ctx.beginPath();
            ctx.arc(p.x, p.y, Math.max(0.5, p.size), 0, Math.PI * 2);
            ctx.fillStyle = `rgba(108, 92, 231, ${p.opacity})`;
            ctx.fill();
        });

        // Garis penghubung antar partikel yang dekat
        for (let i = 0; i < particles.length; i++) {
            for (let j = i + 1; j < particles.length; j++) {
                const dx = particles[i].x - particles[j].x;
                const dy = particles[i].y - particles[j].y;
                const dist = Math.sqrt(dx * dx + dy * dy);
                if (dist < 100) {
                    ctx.beginPath();
                    ctx.moveTo(particles[i].x, particles[i].y);
                    ctx.lineTo(particles[j].x, particles[j].y);
                    ctx.strokeStyle = `rgba(108, 92, 231, ${0.08 * (1 - dist / 100)})`;
                    ctx.lineWidth = 0.5;
                    ctx.stroke();
                }
            }
        }

        animId = requestAnimationFrame(animate);
    }

    // Cek preferensi reduced motion
    const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    init();
    if (!prefersReduced) {
        animate();
    }

    window.addEventListener('resize', () => {
        cancelAnimationFrame(animId);
        init();
        if (!prefersReduced) animate();
    });
})();

// === Input Focus Animation ===
document.querySelectorAll('.form-input').forEach(input => {
    input.addEventListener('focus', () => {
        input.closest('.input-wrapper').classList.add('focused');
    });
    input.addEventListener('blur', () => {
        input.closest('.input-wrapper').classList.remove('focused');
    });
});