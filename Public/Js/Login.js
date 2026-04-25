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
const mainCard = document.querySelector('.main-card');

let currentGuideStep = 0;
const totalGuideSteps = 6;

// === Cek Transisi saat Halaman Dimuat ===
(function checkTransitionOnLoad() {
    const transitionState = localStorage.getItem('taskflow_transition');

    if (transitionState === 'from_register' && mainCard) {
        // Datang dari Register: animasi masuk dari kiri
        mainCard.style.animation = '';
        void mainCard.offsetWidth; // Force reflow
        mainCard.classList.add('page-transition-in-left');
        localStorage.removeItem('taskflow_transition');

        const cleanup = () => {
            mainCard.classList.remove('page-transition-in-left');
            mainCard.removeEventListener('animationend', cleanup);
        };
        mainCard.addEventListener('animationend', cleanup);
        setTimeout(cleanup, 700);

    } else if (mainCard) {
        // Load biasa: animasi entry default
        mainCard.classList.add('animate-entry');
        const cleanup = () => {
            mainCard.classList.remove('animate-entry');
            mainCard.removeEventListener('animationend', cleanup);
        };
        mainCard.addEventListener('animationend', cleanup);
    }
})();

// === Toggle Password ===
togglePasswordBtn.addEventListener('click', () => {
    const isPassword = passwordInput.type === 'password';
    passwordInput.type = isPassword ? 'text' : 'password';
    togglePasswordBtn.innerHTML = isPassword
        ? '<i class="fa-regular fa-eye-slash"></i>'
        : '<i class="fa-regular fa-eye"></i>';
});

// === Validasi & Submit ===
loginForm.addEventListener('submit', (e) => {
    e.preventDefault();
    let valid = true;
    clearError('username');
    clearError('password');

    const username = usernameInput.value.trim();
    const password = passwordInput.value.trim();

    if (!username) { showError('username', 'Username is required'); valid = false; }
    else if (username.length < 3) { showError('username', 'Min 3 characters'); valid = false; }

    if (!password) { showError('password', 'Password is required'); valid = false; }
    else if (password.length < 6) { showError('password', 'Min 6 characters'); valid = false; }

    if (!valid) return;

    loginBtn.classList.add('loading');
    loginBtn.disabled = true;

    setTimeout(() => {
        loginBtn.classList.remove('loading');
        loginBtn.disabled = false;
        showToast('success', 'Login successful! Redirecting...');
        setTimeout(() => showToast('info', 'Would redirect to dashboard (index.html)'), 1500);
    }, 1800);
});

function showError(field, message) {
    document.getElementById(field).classList.add('error');
    document.getElementById(field + 'Error').textContent = message;
}

function clearError(field) {
    document.getElementById(field).classList.remove('error');
    document.getElementById(field + 'Error').textContent = '';
}

usernameInput.addEventListener('input', () => clearError('username'));
passwordInput.addEventListener('input', () => clearError('password'));

// === Lupa Password ===
forgotLink.addEventListener('click', (e) => {
    e.preventDefault();
    showToast('info', 'Password reset link sent to your email');
});

// === Transisi ke Register ===
registerLink.addEventListener('click', (e) => {
    e.preventDefault();

    if (!mainCard) {
        window.location.href = './V_register.php';
        return;
    }

    localStorage.setItem('taskflow_transition', 'from_login');

    // Hapus semua class animasi sebelumnya
    mainCard.classList.remove('animate-entry', 'page-transition-in-left');
    mainCard.style.animation = '';

    // Force reflow
    void mainCard.offsetWidth;

    // Tambahkan class transisi keluar
    mainCard.classList.add('page-transition-out-left');

    let hasNavigated = false;

    const navigate = () => {
        if (hasNavigated) return;
        hasNavigated = true;
        window.location.href = './V_register.php';
    };

    mainCard.addEventListener('animationend', function handler() {
        mainCard.removeEventListener('animationend', handler);
        navigate();
    });

    // Fallback
    setTimeout(navigate, 600);
});

// === Guide Book ===
guideBookBox.addEventListener('click', () => openGuideModal());

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
guideOverlay.addEventListener('click', (e) => { if (e.target === guideOverlay) closeGuideModal(); });

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && guideOverlay.classList.contains('active')) closeGuideModal();
    if (guideOverlay.classList.contains('active')) {
        if (e.key === 'ArrowRight') navigateGuide(1);
        if (e.key === 'ArrowLeft') navigateGuide(-1);
    }
});

guidePrevBtn.addEventListener('click', () => navigateGuide(-1));
guideNextBtn.addEventListener('click', () => navigateGuide(1));

function navigateGuide(dir) {
    currentGuideStep += dir;
    if (currentGuideStep < 0) currentGuideStep = 0;
    if (currentGuideStep >= totalGuideSteps) {
        closeGuideModal();
        showToast('success', "You're all set! Ready to monitor your production line.");
        return;
    }
    renderGuideStep();
}

function renderGuideStep() {
    const steps = document.querySelectorAll('.guide-step');
    steps.forEach((s, i) => s.classList.toggle('active', i === currentGuideStep));

    guideDotsContainer.innerHTML = '';
    for (let i = 0; i < totalGuideSteps; i++) {
        const dot = document.createElement('div');
        dot.className = `guide-dot${i === currentGuideStep ? ' active' : ''}`;
        dot.addEventListener('click', () => { currentGuideStep = i; renderGuideStep(); });
        guideDotsContainer.appendChild(dot);
    }

    guidePrevBtn.disabled = currentGuideStep === 0;
    guideNextBtn.innerHTML = currentGuideStep === totalGuideSteps - 1
        ? 'Get Started <i class="fa-solid fa-check"></i>'
        : 'Next <i class="fa-solid fa-chevron-right"></i>';

    const active = steps[currentGuideStep];
    if (active) active.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

// === Toast ===
function showToast(type, message) {
    const container = document.getElementById('toastContainer');
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    const icons = { success: 'fa-solid fa-circle-check', error: 'fa-solid fa-circle-xmark', info: 'fa-solid fa-circle-info' };
    toast.innerHTML = `<i class="${icons[type]}"></i><span>${message}</span>`;
    container.appendChild(toast);
    setTimeout(() => { if (toast.parentNode) toast.parentNode.removeChild(toast); }, 3000);
}

// === Parallax ===
const panelRight = document.querySelector('.panel-right');
if (panelRight) {
    panelRight.addEventListener('mousemove', (e) => {
        const rect = panelRight.getBoundingClientRect();
        const cx = ((e.clientX - rect.left) / rect.width - 0.5) * 2;
        const cy = ((e.clientY - rect.top) / rect.height - 0.5) * 2;

        document.querySelectorAll('.float-card').forEach((card, i) => {
            const depth = (i + 1) * 3;
            card.style.transform = `translate(${cx * depth}px, ${cy * depth}px)`;
        });

        const illust = document.querySelector('.panel-illustration');
        if (illust) illust.style.transform = `translate(${cx * 4}px, ${cy * 3}px)`;
    });

    panelRight.addEventListener('mouseleave', () => {
        document.querySelectorAll('.float-card').forEach(card => { card.style.transform = ''; });
        const illust = document.querySelector('.panel-illustration');
        if (illust) illust.style.transform = '';
    });
}

// === Partikel ===
(function initParticles() {
    const canvas = document.getElementById('particleCanvas');
    if (!canvas) return;

    const panel = canvas.parentElement;
    const ctx = canvas.getContext('2d');
    let particles = [];
    let animId;

    function resize() { canvas.width = panel.clientWidth; canvas.height = panel.clientHeight; }
    function createParticle() {
        return { x: Math.random() * canvas.width, y: Math.random() * canvas.height, size: Math.random() * 1.6 + 0.4, speedX: (Math.random() - 0.5) * 0.2, speedY: (Math.random() - 0.5) * 0.2, opacity: Math.random() * 0.25 + 0.06 };
    }
    function init() { resize(); particles = []; const count = Math.floor((canvas.width * canvas.height) / 14000); for (let i = 0; i < Math.min(count, 50); i++) particles.push(createParticle()); }
    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        particles.forEach(p => {
            p.x += p.speedX; p.y += p.speedY;
            if (p.x < 0) p.x = canvas.width; if (p.x > canvas.width) p.x = 0;
            if (p.y < 0) p.y = canvas.height; if (p.y > canvas.height) p.y = 0;
            ctx.beginPath(); ctx.arc(p.x, p.y, Math.max(0.4, p.size), 0, Math.PI * 2);
            ctx.fillStyle = `rgba(0, 180, 160, ${p.opacity})`; ctx.fill();
        });
        for (let i = 0; i < particles.length; i++) {
            for (let j = i + 1; j < particles.length; j++) {
                const dx = particles[i].x - particles[j].x, dy = particles[i].y - particles[j].y;
                const dist = Math.sqrt(dx * dx + dy * dy);
                if (dist < 100) {
                    ctx.beginPath(); ctx.moveTo(particles[i].x, particles[i].y);
                    ctx.lineTo(particles[j].x, particles[j].y);
                    ctx.strokeStyle = `rgba(0, 180, 160, ${0.04 * (1 - dist / 100)})`;
                    ctx.lineWidth = 0.5; ctx.stroke();
                }
            }
        }
        animId = requestAnimationFrame(animate);
    }
    const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    init(); if (!prefersReduced) animate();
    window.addEventListener('resize', () => { cancelAnimationFrame(animId); init(); if (!prefersReduced) animate(); });
})();

// === Input Focus ===
document.querySelectorAll('.form-input').forEach(input => {
    input.addEventListener('focus', () => input.closest('.input-wrapper').classList.add('focused'));
    input.addEventListener('blur', () => input.closest('.input-wrapper').classList.remove('focused'));
});