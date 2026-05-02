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
        assignees: [
            { initials: 'LW', color: '#fbbf24' }
        ],
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
        assignees: [
            { initials: 'EM', color: '#ff6b6b' }
        ],
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

const sidebar = document.getElementById('sidebar');
const sidebarToggle = document.getElementById('sidebarToggle');
const themeToggle = document.getElementById('themeToggle');
const themeFlash = document.getElementById('themeFlash');
const modalOverlay = document.getElementById('modalOverlay');
const addTaskBtn = document.getElementById('addTaskBtn');
const modalCancel = document.getElementById('modalCancel');
const modalSubmit = document.getElementById('modalSubmit');

function renderTasks() {
    const statuses = ['diterima', 'diproses', 'discan', 'diantar'];

    statuses.forEach(status => {
        const list = document.querySelector(`.task-list[data-status="${status}"]`);
        if (!list) return;
        list.innerHTML = '';

        let filtered = tasks.filter(t => t.status === status);
        if (currentFilter === 'high') {
            filtered = filtered.filter(t => t.priority === 'high');
        } else if (currentFilter === 'overdue') {
            filtered = filtered.filter(t => t.overdue);
        }

        const searchVal = document.getElementById('searchInput').value.toLowerCase().trim();
        if (searchVal) {
            filtered = filtered.filter(t =>
                t.title.toLowerCase().includes(searchVal) ||
                t.description.toLowerCase().includes(searchVal)
            );
        }

        filtered.forEach(task => {
            const card = createTaskCard(task);
            list.appendChild(card);
        });

        const totalInColumn = tasks.filter(t => t.status === status).length;
        const countEl = document.getElementById(`count-${status}`);
        if (countEl) countEl.textContent = totalInColumn;
    });

    updateStats();
}

function createTaskCard(task) {
    const card = document.createElement('div');
    card.className = 'task-card';
    card.draggable = true;
    card.dataset.id = task.id;

    const priorityClass = `priority-${task.priority}`;
    const priorityLabel = task.priority.charAt(0).toUpperCase() + task.priority.slice(1);

    const dueDate = new Date(task.due);
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    const isOverdue = dueDate < today;
    const dueText = dueDate.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });

    const tagsHtml = task.tags.map(tag => {
        const tagClass = `tag-${tag}`;
        const tagLabel = tag.charAt(0).toUpperCase() + tag.slice(1);
        return `<span class="task-tag ${tagClass}">${tagLabel}</span>`;
    }).join('');

    const assigneesHtml = task.assignees.map(a =>
        `<div class="task-assignee" style="background: ${a.color}" title="${a.initials}">${a.initials}</div>`
    ).join('');

    const progressHtml = task.progress > 0 ? `
        <div class="task-progress">
            <div class="progress-bar-bg">
                <div class="progress-bar-fill" style="width: ${task.progress}%; background: ${task.progress >= 60 ? 'var(--green)' : task.progress >= 30 ? 'var(--orange)' : 'var(--red)'}"></div>
            </div>
            <span class="progress-text">${task.progress}% complete</span>
        </div>
    ` : '';

    card.innerHTML = `
        <div class="task-priority ${priorityClass}">
            <i class="fa-solid fa-flag" style="font-size: 9px;"></i> ${priorityLabel}
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
        </div>
    `;

    card.addEventListener('dragstart', handleDragStart);
    card.addEventListener('dragend', handleDragEnd);

    return card;
}

function updateStats() {
    const total = tasks.length;
    const inProgress = tasks.filter(t => t.status === 'diproses').length;
    const completed = tasks.filter(t => t.status === 'diantar').length;
    const overdue = tasks.filter(t => t.overdue).length;

    animateValue('totalTasks', total);
    animateValue('inProgressTasks', inProgress);
    animateValue('completedTasks', completed);
    animateValue('overdueTasks', overdue);
}

function animateValue(elementId, target) {
    const el = document.getElementById(elementId);
    const current = parseInt(el.textContent) || 0;
    if (current === target) return;

    let start = current;
    const step = target > current ? 1 : -1;
    const interval = setInterval(() => {
        start += step;
        el.textContent = start;
        if (start === target) clearInterval(interval);
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
    document.querySelectorAll('.kanban-column').forEach(col => col.classList.remove('drag-over'));
}

document.querySelectorAll('.kanban-column').forEach(column => {
    column.addEventListener('dragover', e => {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';
        column.classList.add('drag-over');
    });

    column.addEventListener('dragleave', () => {
        column.classList.remove('drag-over');
    });

    column.addEventListener('drop', e => {
        e.preventDefault();
        column.classList.remove('drag-over');

        if (!draggedCard) return;

        const taskId = parseInt(draggedCard.dataset.id);
        const newStatus = column.dataset.status;
        const task = tasks.find(t => t.id === taskId);

        if (task && task.status !== newStatus) {
            task.status = newStatus;
            renderTasks();
            showToast('success', `Task moved to ${getStatusLabel(newStatus)}`);
        }
    });
});

function getStatusLabel(status) {
    const labels = { diterima: 'Diterima', diproses: 'Diproses', discan: 'Discan', diantar: 'Diantar' };
    return labels[status] || status;
}

document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        currentFilter = btn.dataset.filter;
        renderTasks();
    });
});

document.getElementById('searchInput').addEventListener('input', () => {
    renderTasks();
});

document.querySelectorAll('.nav-item').forEach(item => {
    item.addEventListener('click', () => {
        document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
        item.classList.add('active');
        showToast('info', `Navigated to ${item.querySelector('.nav-item-text').textContent}`);
    });
});

sidebarToggle.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
    const isCollapsed = sidebar.classList.contains('collapsed');
    localStorage.setItem('sidebar-collapsed', isCollapsed);
    showToast('info', isCollapsed ? 'Sidebar collapsed' : 'Sidebar expanded');
});

function loadSidebarState() {
    const saved = localStorage.getItem('sidebar-collapsed');
    if (saved === 'true') {
        sidebar.classList.add('collapsed');
    }
}

themeToggle.addEventListener('click', () => {
    themeFlash.classList.add('active');
    setTimeout(() => themeFlash.classList.remove('active'), 200);

    document.body.classList.toggle('light-mode');
    const isLight = document.body.classList.contains('light-mode');
    localStorage.setItem('theme', isLight ? 'light' : 'dark');
    showToast('info', isLight ? 'Switched to Light Mode' : 'Switched to Dark Mode');
});

function loadTheme() {
    const saved = localStorage.getItem('theme');
    if (saved === 'light') {
        document.body.classList.add('light-mode');
    }
}

addTaskBtn.addEventListener('click', () => {
    openModal('diterima');
});

document.querySelectorAll('.add-task-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        openModal(btn.dataset.column);
    });
});

function openModal(defaultColumn) {
    document.getElementById('taskColumn').value = defaultColumn;
    document.getElementById('taskTitle').value = '';
    document.getElementById('taskDesc').value = '';
    document.getElementById('taskPriority').value = 'medium';
    document.getElementById('taskDue').value = '';
    document.getElementById('taskTag').value = 'design';
    modalOverlay.classList.add('active');
    setTimeout(() => document.getElementById('taskTitle').focus(), 100);
}

function closeModal() {
    modalOverlay.classList.remove('active');
}

modalCancel.addEventListener('click', closeModal);
modalOverlay.addEventListener('click', e => {
    if (e.target === modalOverlay) closeModal();
});

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeModal();
});

modalSubmit.addEventListener('click', () => {
    const title = document.getElementById('taskTitle').value.trim();
    const desc = document.getElementById('taskDesc').value.trim();
    const priority = document.getElementById('taskPriority').value;
    const due = document.getElementById('taskDue').value;
    const column = document.getElementById('taskColumn').value;
    const tag = document.getElementById('taskTag').value;

    if (!title) {
        showToast('error', 'Task title is required');
        document.getElementById('taskTitle').focus();
        return;
    }

    const dueDate = due ? new Date(due) : new Date(Date.now() + 7 * 24 * 60 * 60 * 1000);
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    const isOverdue = dueDate < today;

    const newTask = {
        id: nextId++,
        title: title,
        description: desc || 'No description provided.',
        priority: priority,
        status: column,
        tags: [tag],
        due: due || dueDate.toISOString().split('T')[0],
        overdue: isOverdue,
        assignees: [
            { initials: 'AJ', color: '#6c5ce7' }
        ],
        progress: 0
    };

    tasks.push(newTask);
    closeModal();
    renderTasks();
    showToast('success', `Task "${title}" created successfully`);
});

document.getElementById('notifBtn').addEventListener('click', () => {
    showToast('info', '2 overdue tasks need your attention');
});

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

function updateGreeting() {
    const hour = new Date().getHours();
    const h1 = document.querySelector('.header-left h1');
    const username = h1.dataset.username || 'User';
    let greeting;

    if (hour < 12) greeting = 'Good morning';
    else if (hour < 18) greeting = 'Good afternoon';
    else greeting = 'Good evening';

    h1.innerHTML = `${greeting}, <span>${username}</span>`;
}

const userMoreIcon = document.getElementById('userMoreIcon');
const userDropdown = document.getElementById('userDropdown');

if (userMoreIcon && userDropdown) {
    userMoreIcon.addEventListener('click', (e) => {
        e.stopPropagation();
        userDropdown.classList.toggle('active');
    });

    document.addEventListener('click', (e) => {
        if (!userDropdown.contains(e.target) && !userMoreIcon.contains(e.target)) {
            userDropdown.classList.remove('active');
        }
    });
}

loadTheme();
loadSidebarState();
updateGreeting();
renderTasks();