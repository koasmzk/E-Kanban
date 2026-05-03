// ═══════════════════════════════════════════════
// 🌟 THEME MANAGEMENT (Default: Light)
// ═══════════════════════════════════════════════
const sidebar       = document.getElementById('sidebar');
const sidebarToggle = document.getElementById('sidebarToggle');
const themeToggle   = document.getElementById('themeToggle');
const themeFlash    = document.getElementById('themeFlash');

function loadTheme() {
    // Cek localStorage, jika kosong maka defaultnya 'light'
    const savedTheme = localStorage.getItem('theme') || 'light';
    
    if (savedTheme === 'light') {
        document.body.classList.add('light-mode');
    } else {
        document.body.classList.remove('light-mode');
    }
    updateThemeLabel();
}

function updateThemeLabel() {
    const label = themeToggle?.querySelector('.theme-label');
    const isLight = document.body.classList.contains('light-mode');
    if (label) label.textContent = isLight ? 'Light Mode' : 'Dark Mode';
}

if (themeToggle) {
    themeToggle.addEventListener('click', () => {
        if (themeFlash) {
            themeFlash.classList.add('active');
            setTimeout(() => themeFlash.classList.remove('active'), 200);
        }

        document.body.classList.toggle('light-mode');
        const isLight = document.body.classList.contains('light-mode');
        localStorage.setItem('theme', isLight ? 'light' : 'dark');
        updateThemeLabel();
    });
}

// ═══════════════════════════════════════════════
// 📦 SIDEBAR MANAGEMENT
// ═══════════════════════════════════════════════
function loadSidebarState() {
    if (localStorage.getItem('sidebar-collapsed') === 'true') {
        sidebar?.classList.add('collapsed');
    }
}

if (sidebarToggle) {
    sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
        localStorage.setItem('sidebar-collapsed', sidebar.classList.contains('collapsed'));
    });
}

// Navigasi menggunakan data-href (karena di HTML pakai div bukan <a>)
document.querySelectorAll('.nav-item[data-href]').forEach(item => {
    item.style.cursor = 'pointer';
    item.addEventListener('click', () => {
        window.location.href = item.dataset.href;
    });
});

// ═══════════════════════════════════════════════
// 🔍 TABLE SEARCH
// ═══════════════════════════════════════════════
const searchInput = document.getElementById('searchInput');
if (searchInput) {
    searchInput.addEventListener('input', () => {
        const val = searchInput.value.toLowerCase().trim();
        const rows = document.querySelectorAll('#partsTable tbody tr:not(.empty-row)');
        
        rows.forEach(row => {
            const name = row.dataset.name || '';
            const number = row.dataset.number || '';
            // Tampilkan row jika cocok, sembunyikan jika tidak
            row.style.display = (name.includes(val) || number.includes(val)) ? '' : 'none';
        });
    });
}

// ═══════════════════════════════════════════════
// ➕ MODAL TAMBAH / EDIT
// ═══════════════════════════════════════════════
const modalOverlay = document.getElementById('modalOverlay');
const modalClose   = document.getElementById('modalClose');
const modalCancel  = document.getElementById('modalCancel');
const btnTambah    = document.getElementById('btnTambah');
const modalTitle   = document.getElementById('modalTitle');
const partForm     = document.getElementById('partForm'); // Ambil element form

const formId     = document.getElementById('formId');
const formName   = document.getElementById('formName');
const formNumber = document.getElementById('formNumber');
const formDesc   = document.getElementById('formDesc');

function openAddModal() {
    if (modalTitle) modalTitle.textContent = 'Tambah Part';
    
    // PERBAIKAN: Ubah action dari /update ke /store (jika sebelumnya dipakai edit)
    // Karena di HTML defaultnya sudah /store, kita cukup replace kalau ada /update
    if (partForm) partForm.action = partForm.action.replace('/update', '/store');
    
    if (formId) formId.value = '';
    if (formName) formName.value = '';
    if (formNumber) formNumber.value = '';
    if (formDesc) formDesc.value = '';
    
    modalOverlay?.classList.add('active');
    setTimeout(() => formName?.focus(), 100);
}

function closeModal() {
    modalOverlay?.classList.remove('active');
}

if (btnTambah) btnTambah.addEventListener('click', openAddModal);
if (modalClose) modalClose.addEventListener('click', closeModal);
if (modalCancel) modalCancel.addEventListener('click', closeModal);
if (modalOverlay) {
    modalOverlay.addEventListener('click', e => {
        if (e.target === modalOverlay) closeModal();
    });
}

// Tombol Edit di dalam Tabel
document.querySelectorAll('.btn-edit').forEach(btn => {
    btn.addEventListener('click', () => {
        if (modalTitle) modalTitle.textContent = 'Edit Part';
        
        // PERBAIKAN: Ubah action dari /store ke /update
        if (partForm) partForm.action = partForm.action.replace('/store', '/update');
        
        if (formId) formId.value = btn.dataset.id;
        if (formName) formName.value = btn.dataset.name;
        if (formNumber) formNumber.value = btn.dataset.number;
        if (formDesc) formDesc.value = btn.dataset.desc;
        
        modalOverlay?.classList.add('active');
    });
});

// ═══════════════════════════════════════════════
// 🗑️ MODAL HAPUS
// ═══════════════════════════════════════════════
const deleteOverlay = document.getElementById('deleteOverlay');
const deleteClose   = document.getElementById('deleteClose');
const deleteCancel  = document.getElementById('deleteCancel');
const deleteName    = document.getElementById('deleteName');
const deleteId      = document.getElementById('deleteId');

function closeDeleteModal() {
    deleteOverlay?.classList.remove('active');
}

document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', () => {
        if (deleteId) deleteId.value = btn.dataset.id;
        if (deleteName) deleteName.textContent = btn.dataset.name;
        deleteOverlay?.classList.add('active');
    });
});

if (deleteClose) deleteClose.addEventListener('click', closeDeleteModal);
if (deleteCancel) deleteCancel.addEventListener('click', closeDeleteModal);
if (deleteOverlay) {
    deleteOverlay.addEventListener('click', e => {
        if (e.target === deleteOverlay) closeDeleteModal();
    });
}

// Global Escape Key
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
        closeModal();
        closeDeleteModal();
    }
});

// ═══════════════════════════════════════════════
// 👤 USER DROPDOWN
// ═══════════════════════════════════════════════
const userMoreIcon = document.getElementById('userMoreIcon');
const userDropdown = document.getElementById('userDropdown');

if (userMoreIcon && userDropdown) {
    userMoreIcon.addEventListener('click', e => {
        e.stopPropagation();
        userDropdown.classList.toggle('active');
    });
    document.addEventListener('click', e => {
        if (!userDropdown.contains(e.target) && !userMoreIcon.contains(e.target)) {
            userDropdown.classList.remove('active');
        }
    });
}

// ═══════════════════════════════════════════════
// 🚀 INITIALIZATION
// ═══════════════════════════════════════════════
loadTheme();
loadSidebarState();