const tasks = [
    {
        id: 1,
        title: 'Q2 Marketing',
        description: 'Plan Q2 marketing strategy and budget allocation for all channels.',
        priority: 'medium',
        status: 'diterima',
        tags: ['marketing'],
        due: '2025-01-15',
        overdue: true,
        assignees: [
            { initials: 'SK', color: '#ff6b6b' },
            { initials: 'JM', color: '#4da6ff' }
        ],
        progress: 20
    },
    {
        id: 2,
        title: 'Ad Copy Drafts',
        description: 'Write ad copy variations for social media campaigns.',
        priority: 'low',
        status: 'diterima',
        tags: ['marketing', 'design'],
        due: '2025-01-20',
        overdue: false,
        assignees: [{ initials: 'LW', color: '#fbbf24' }],
        progress: 0
    },
    {
        id: 3,
        title: 'Mobile App v2',
        description: 'Design and prototype Mobile App v2 with improved UX flows.',
        priority: 'high',
        status: 'diproses',
        tags: ['dev', 'design'],
        due: '2025-01-10',
        overdue: true,
        assignees: [
            { initials: 'AJ', color: '#6c5ce7' },
            { initials: 'RP', color: '#00d68f' }
        ],
        progress: 0
    },
    {
        id: 4,
        title: 'User Research Report',
        description: 'Compile findings from user interviews and usability tests.',
        priority: 'medium',
        status: 'discan',
        tags: ['research'],
        due: '2025-02-01',
        overdue: false,
        assignees: [{ initials: 'EM', color: '#ff6b6b' }],
        progress: 0
    },
    {
        id: 5,
        title: 'Landing Page Redesign',
        description: 'Redesign the main landing page with new brand guidelines and improved conversion flow.',
        priority: 'high',
        status: 'diantar',
        tags: ['design', 'urgent'],
        due: '2025-01-25',
        overdue: false,
        assignees: [
            { initials: 'AJ', color: '#6c5ce7' },
            { initials: 'SK', color: '#ff6b6b' },
            { initials: 'LW', color: '#fbbf24' }
        ],
        progress: 65
    }
];

let nextId = 6;
let currentFilter = 'all';
let draggedCard = null;

const sidebar       = document.getElementById('sidebar');
const sidebarToggle = document.getElementById('sidebarToggle');
const themeToggle   = document.getElementById('themeToggle');
const themeFlash    = document.getElementById('themeFlash');
const modalOverlay  = document.getElementById('modalOverlay');
const modalCancel   = document.getElementById('modalCancel');
const modalSubmit   = document.getElementById('modalSubmit');

// open  = diterima + diproses
// inprogress = discan
// completed  = diantar
const FILTER_MAP = {
    all:        ['diterima', 'diproses', 'discan', 'diantar'],
    open:       ['diterima', 'diproses'],
    inprogress: ['discan'],
    completed:  ['diantar'],
};

function renderTasks() {
    const statuses = ['diterima', 'diproses', 'discan', 'diantar'];
    const visibleStatuses = FILTER_MAP[currentFilter];
    const searchVal = document.getElementById('searchInput').value.toLowerCase().trim();

    statuses.forEach(status => {
        const list = document.querySelector(`.task-list[data-status="${status}"]`);
        const column = document.querySelector(`.kanban-column[data-status="${status}"]`);
        if (!list || !column) return;

        // Sembunyikan kolom yang tidak relevan dengan filter aktif
        column.style.display = visibleStatuses.includes(status) ? '' : 'none';

        list.innerHTML = '';

        let filtered = tasks.filter(t => t.status === status);

        if (searchVal) {
            filtered = filtered.filter(t =>
                t.title.toLowerCase().includes(searchVal) ||
                t.description.toLowerCase().includes(searchVal)
            );
        }

        filtered.forEach(task => list.appendChild(createTaskCard(task)));

        const countEl = document.getElementById(`count-${status}`);
        if (countEl) countEl.textContent = tasks.filter(t => t.status === status).length;
    });

    updateStats();
}

function createTaskCard(task) {
    const card = document.createElement('div');
    card.className = 'task-card';
    card.draggable = true;
    card.dataset.id = task.id;

    const priorityLabel = task.priority.charAt(0).toUpperCase() + task.priority.slice(1);
    const dueDate  = new Date(task.due);
    const today    = new Date(); today.setHours(0, 0, 0, 0);
    const isOverdue = dueDate < today;
    const dueText  = dueDate.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });

    const tagsHtml = task.tags.map(tag =>
        `<span class="task-tag tag-${tag}">${tag.charAt(0).toUpperCase() + tag.slice(1)}</span>`
    ).join('');

    const assigneesHtml = task.assignees.map(a =>
        `<div class="task-assignee" style="background:${a.color}" title="${a.initials}">${a.initials}</div>`
    ).join('');

    const progressHtml = task.progress > 0 ? `
        <div class="task-progress">
            <div class="progress-bar-bg">
                <div class="progress-bar-fill" style="width:${task.progress}%;background:${task.progress >= 60 ? 'var(--green)' : task.progress >= 30 ? 'var(--orange)' : 'var(--red)'}"></div>
            </div>
            <span class="progress-text">${task.progress}% complete</span>
        </div>` : '';

    card.innerHTML = `
        <div class="task-priority priority-${task.priority}">
            <i class="fa-solid fa-flag" style="font-size:9px"></i> ${priorityLabel}
        </div>
        <div class="task-title">${task.title}</div>
        <div class="task-desc">${task.description}</div>
        ${progressHtml}
        <div class="task-tags">${tagsHtml}</div>
        <div class="task-footer">
            <div class="task-due ${isOverdue ? 'overdue' : ''}">
                <i class="fa-regular fa-calendar"></i>
                ${dueText}${isOverdue ? ' (Overdue)' : ''}
            </div>
            <div class="task-assignees">${assigneesHtml}</div>
        </div>`;

    card.addEventListener('dragstart', handleDragStart);
    card.addEventListener('dragend', handleDragEnd);
    return card;
}

function updateStats() {
    animateValue('totalTasks',      tasks.length);
    animateValue('openTasks',       tasks.filter(t => ['diterima', 'diproses'].includes(t.status)).length);
    animateValue('inProgressTasks', tasks.filter(t => t.status === 'discan').length);
    animateValue('completedTasks',  tasks.filter(t => t.status === 'diantar').length);
}

function animateValue(id, target) {
    const el = document.getElementById(id);
    if (!el) return;
    const current = parseInt(el.textContent) || 0;
    if (current === target) return;
    let val = current;
    const step = target > current ? 1 : -1;
    const iv = setInterval(() => {
        val += step;
        el.textContent = val;
        if (val === target) clearInterval(iv);
    }, 80);
}

function handleDragStart(e) {
    draggedCard = this;
    this.classList.add('dragging');
    e.dataTransfer.effectAllowed = 'move';
    e.dataTransfer.setData('text/plain', this.dataset.id);
}

function handleDragEnd() {
    this.classList.remove('dragging');
    draggedCard = null;
    document.querySelectorAll('.kanban-column').forEach(c => c.classList.remove('drag-over'));
}

document.querySelectorAll('.kanban-column').forEach(column => {
    column.addEventListener('dragover', e => {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';
        column.classList.add('drag-over');
    });
    column.addEventListener('dragleave', () => column.classList.remove('drag-over'));
    column.addEventListener('drop', e => {
        e.preventDefault();
        column.classList.remove('drag-over');
        if (!draggedCard) return;
        const task = tasks.find(t => t.id === parseInt(draggedCard.dataset.id));
        const newStatus = column.dataset.status;
        if (task && task.status !== newStatus) {
            task.status = newStatus;
            renderTasks();
            showToast('success', `Task dipindahkan ke ${getStatusLabel(newStatus)}`);
        }
    });
});

function getStatusLabel(s) {
    return { diterima: 'Diterima', diproses: 'Diproses', discan: 'Discan', diantar: 'Diantar' }[s] || s;
}

document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        currentFilter = btn.dataset.filter;
        renderTasks();
    });
});

document.getElementById('searchInput').addEventListener('input', renderTasks);

document.querySelectorAll('.nav-item:not(.theme-nav-item)').forEach(item => {
    item.addEventListener('click', () => {
        document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
        item.classList.add('active');
    });
});

sidebarToggle.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
    localStorage.setItem('sidebar-collapsed', sidebar.classList.contains('collapsed'));
});

function loadSidebarState() {
    if (localStorage.getItem('sidebar-collapsed') === 'true') {
        sidebar.classList.add('collapsed');
    }
}

// Theme toggle — sekarang nav item di sidebar
themeToggle.addEventListener('click', () => {
    themeFlash.classList.add('active');
    setTimeout(() => themeFlash.classList.remove('active'), 200);

    document.body.classList.toggle('light-mode');
    const isLight = document.body.classList.contains('light-mode');
    localStorage.setItem('theme', isLight ? 'light' : 'dark');

    const label = themeToggle.querySelector('.theme-label');
    if (label) label.textContent = isLight ? 'Light Mode' : 'Dark Mode';
});

function loadTheme() {
    if (localStorage.getItem('theme') === 'light') {
        document.body.classList.add('light-mode');
        const label = themeToggle.querySelector('.theme-label');
        if (label) label.textContent = 'Light Mode';
    }
}

document.querySelectorAll('.add-task-btn').forEach(btn => {
    btn.addEventListener('click', () => openModal(btn.dataset.column));
});

function openModal(defaultColumn) {
    document.getElementById('taskColumn').value = defaultColumn;
    document.getElementById('taskTitle').value   = '';
    document.getElementById('taskDesc').value    = '';
    document.getElementById('taskPriority').value = 'medium';
    document.getElementById('taskDue').value     = '';
    document.getElementById('taskTag').value     = 'design';
    modalOverlay.classList.add('active');
    setTimeout(() => document.getElementById('taskTitle').focus(), 100);
}

function closeModal() { modalOverlay.classList.remove('active'); }

modalCancel.addEventListener('click', closeModal);
modalOverlay.addEventListener('click', e => { if (e.target === modalOverlay) closeModal(); });
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });

modalSubmit.addEventListener('click', () => {
    const title    = document.getElementById('taskTitle').value.trim();
    const desc     = document.getElementById('taskDesc').value.trim();
    const priority = document.getElementById('taskPriority').value;
    const due      = document.getElementById('taskDue').value;
    const column   = document.getElementById('taskColumn').value;
    const tag      = document.getElementById('taskTag').value;

    if (!title) {
        showToast('error', 'Task title is required');
        document.getElementById('taskTitle').focus();
        return;
    }

    const dueDate = due ? new Date(due) : new Date(Date.now() + 7 * 86400000);
    const today   = new Date(); today.setHours(0, 0, 0, 0);

    tasks.push({
        id: nextId++, title, priority, status: column, tags: [tag],
        description: desc || 'No description provided.',
        due: due || dueDate.toISOString().split('T')[0],
        overdue: dueDate < today,
        assignees: [{ initials: 'AJ', color: '#6c5ce7' }],
        progress: 0
    });

    closeModal();
    renderTasks();
    showToast('success', `Task "${title}" berhasil dibuat`);
});

function showToast(type, message) {
    const container = document.getElementById('toastContainer');
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    const icons = { success: 'fa-circle-check', error: 'fa-circle-xmark', info: 'fa-circle-info' };
    toast.innerHTML = `<i class="fa-solid ${icons[type]}"></i><span>${message}</span>`;
    container.appendChild(toast);
    setTimeout(() => toast.parentNode?.removeChild(toast), 3000);
}

function updateGreeting() {
    const h1 = document.querySelector('.header-left h1');
    if (!h1) return;
    const username = h1.dataset.username || 'User';
    const hour = new Date().getHours();
    const greeting = hour < 12 ? 'Good morning' : hour < 18 ? 'Good afternoon' : 'Good evening';
    h1.innerHTML = `${greeting}, <span>${username}</span>`;
}

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

loadTheme();
loadSidebarState();
updateGreeting();
renderTasks();