// === Referensi DOM ===
const registerForm = document.getElementById('registerForm');
const registerBtn = document.getElementById('registerBtn');
const loginLink = document.getElementById('loginLink');
const mainCard = document.querySelector('.main-card');

// === Cek Transisi saat Load ===
(function checkTransitionOnLoad() {
    const transitionState = localStorage.getItem('taskflow_transition');
    if (transitionState === 'from_login' && mainCard) {
        mainCard.style.animation = '';
        void mainCard.offsetWidth;
        mainCard.classList.add('page-transition-in-right');
        localStorage.removeItem('taskflow_transition');
        const cleanup = () => { mainCard.classList.remove('page-transition-in-right'); mainCard.removeEventListener('animationend', cleanup); };
        mainCard.addEventListener('animationend', cleanup);
        setTimeout(cleanup, 700);
    } else if (mainCard) {
        mainCard.style.animation = 'cardEntry 0.55s cubic-bezier(0.16, 1, 0.3, 1) backwards';
    }
})();

// === Toggle Password ===
document.querySelectorAll('.toggle-password').forEach(btn => {
    btn.addEventListener('click', () => {
        const input = btn.parentElement.querySelector('.form-input'); if (!input) return;
        const isPassword = input.type === 'password'; input.type = isPassword ? 'text' : 'password';
        btn.innerHTML = isPassword ? '<i class="fa-regular fa-eye-slash"></i>' : '<i class="fa-regular fa-eye"></i>';
    });
});

// === Validasi ===
registerForm.addEventListener('submit', (e) => {
    e.preventDefault(); let valid = true;
    ['fullname', 'regUsername', 'email', 'regPassword', 'confirmPassword'].forEach(clearError);
    const fullname = document.getElementById('fullname').value.trim();
    const username = document.getElementById('regUsername').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('regPassword').value;
    const confirm = document.getElementById('confirmPassword').value;
    const terms = document.getElementById('agreeTerms').checked;
    if (!fullname) { showError('fullname', 'Required'); valid = false; }
    if (!username || username.length < 3) { showError('regUsername', 'Min 3 chars'); valid = false; }
    if (!email || !/^\S+@\S+\.\S+$/.test(email)) { showError('email', 'Invalid email'); valid = false; }
    if (!password || password.length < 8) { showError('regPassword', 'Min 8 chars'); valid = false; }
    if (password !== confirm) { showError('confirmPassword', 'Not match'); valid = false; }
    if (!terms) { showToast('error', 'You must agree to the terms'); valid = false; }
    if (!valid) return;
    registerBtn.classList.add('loading'); registerBtn.disabled = true;
    setTimeout(() => {
        registerBtn.classList.remove('loading'); registerBtn.disabled = false;
        showToast('success', 'Account created! Redirecting to login...');
        setTimeout(() => triggerTransitionToLogin(), 1500);
    }, 2000);
});

function showError(field, message) { const input = document.getElementById(field); const errorEl = document.getElementById(field + 'Error'); if (input) input.classList.add('error'); if (errorEl) errorEl.textContent = message; }
function clearError(field) { const input = document.getElementById(field); const errorEl = document.getElementById(field + 'Error'); if (input) input.classList.remove('error'); if (errorEl) errorEl.textContent = ''; }
document.querySelectorAll('.form-input').forEach(input => { input.addEventListener('input', () => clearError(input.id)); });

// === Transisi ke Login ===
loginLink.addEventListener('click', (e) => { e.preventDefault(); triggerTransitionToLogin(); });

function triggerTransitionToLogin() {
    const targetUrl = './V_login.php';
    if (!mainCard) { window.location.href = targetUrl; return; }
    localStorage.setItem('taskflow_transition', 'from_register');
    mainCard.style.animation = '';
    void mainCard.offsetWidth;
    mainCard.classList.add('page-transition-out-right');
    let hasNavigated = false;
    const navigate = () => { if (hasNavigated) return; hasNavigated = true; window.location.href = targetUrl; };
    mainCard.addEventListener('animationend', function handler() { mainCard.removeEventListener('animationend', handler); navigate(); });
    setTimeout(navigate, 600);
}

// === Toast ===
function showToast(type, message) {
    const container = document.getElementById('toastContainer'); const toast = document.createElement('div'); toast.className = `toast ${type}`;
    const icons = { success: 'fa-solid fa-circle-check', error: 'fa-solid fa-circle-xmark', info: 'fa-solid fa-circle-info' };
    toast.innerHTML = `<i class="${icons[type]}"></i><span>${message}</span>`; container.appendChild(toast);
    setTimeout(() => { if (toast.parentNode) toast.parentNode.removeChild(toast); }, 3000);
}

// === Partikel ===
(function initParticles() {
    const canvas = document.getElementById('particleCanvas'); if (!canvas) return;
    const panel = canvas.parentElement; const ctx = canvas.getContext('2d'); let particles = []; let animId;
    function resize() { canvas.width = panel.clientWidth; canvas.height = panel.clientHeight; }
    function createParticle() { return { x: Math.random() * canvas.width, y: Math.random() * canvas.height, size: Math.random() * 1.6 + 0.4, speedX: (Math.random() - 0.5) * 0.2, speedY: (Math.random() - 0.5) * 0.2, opacity: Math.random() * 0.25 + 0.06 }; }
    function init() { resize(); particles = []; const count = Math.floor((canvas.width * canvas.height) / 14000); for (let i = 0; i < Math.min(count, 50); i++) particles.push(createParticle()); }
    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        particles.forEach(p => { p.x += p.speedX; p.y += p.speedY; if (p.x < 0) p.x = canvas.width; if (p.x > canvas.width) p.x = 0; if (p.y < 0) p.y = canvas.height; if (p.y > canvas.height) p.y = 0; ctx.beginPath(); ctx.arc(p.x, p.y, Math.max(0.4, p.size), 0, Math.PI * 2); ctx.fillStyle = `rgba(0, 180, 160, ${p.opacity})`; ctx.fill(); });
        for (let i = 0; i < particles.length; i++) { for (let j = i + 1; j < particles.length; j++) { const dx = particles[i].x - particles[j].x, dy = particles[i].y - particles[j].y, dist = Math.sqrt(dx * dx + dy * dy); if (dist < 100) { ctx.beginPath(); ctx.moveTo(particles[i].x, particles[i].y); ctx.lineTo(particles[j].x, particles[j].y); ctx.strokeStyle = `rgba(0, 180, 160, ${0.04 * (1 - dist / 100)})`; ctx.lineWidth = 0.5; ctx.stroke(); } } }
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