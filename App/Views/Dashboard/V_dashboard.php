<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Kanban Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= $GLOBALS['baseURL'] ?>/Public/Css/Dashboard.css?v=<?= time() ?>">
</head>
<body>
    <div class="theme-flash" id="themeFlash"></div>

    <div class="app-layout">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-logo">
                <div class="logo-icon">
                    <i class="fa-solid fa-list-check"></i>
                </div>
                <div class="logo-text">E-Kanban</div>
            </div>
            <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
                <i class="fa-solid fa-chevron-left"></i>
            </button>

            <div class="sidebar-section">
                <div class="sidebar-section-title">Menu</div>
                <div class="nav-item" data-page="overview">
                    <i class="fa-solid fa-house"></i>
                    <span class="nav-item-text">Overview</span>
                    <span class="tooltip">Overview</span>
                </div>
                <div class="nav-item active" data-page="dashboard">
                    <i class="fa-solid fa-table-columns"></i>
                    <span class="nav-item-text">Dashboard</span>
                    <span class="tooltip">Dashboard</span>
                </div>
                <div class="nav-item" data-page="calendar">
                    <i class="fa-regular fa-calendar"></i>
                    <span class="nav-item-text">Calendar</span>
                    <span class="tooltip">Calendar</span>
                </div>
                <div class="nav-item" data-page="messages">
                    <i class="fa-regular fa-comment-dots"></i>
                    <span class="nav-item-text">Messages</span>
                    <span class="nav-badge">3</span>
                    <span class="tooltip">Messages</span>
                </div>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-section-title">Projects</div>
                <div class="nav-item" data-page="marketing">
                    <i class="fa-solid fa-bullhorn"></i>
                    <span class="nav-item-text">Marketing</span>
                    <span class="tooltip">Marketing</span>
                </div>
                <div class="nav-item" data-page="mobile-app">
                    <i class="fa-solid fa-mobile-screen"></i>
                    <span class="nav-item-text">Mobile App</span>
                    <span class="tooltip">Mobile App</span>
                </div>
                <div class="nav-item" data-page="web-design">
                    <i class="fa-solid fa-palette"></i>
                    <span class="nav-item-text">Web Design</span>
                    <span class="tooltip">Web Design</span>
                </div>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-section-title">Settings</div>
                <div class="nav-item" data-page="team">
                    <i class="fa-solid fa-users"></i>
                    <span class="nav-item-text">Team</span>
                    <span class="tooltip">Team</span>
                </div>
                <div class="nav-item" data-page="settings">
                    <i class="fa-solid fa-gear"></i>
                    <span class="nav-item-text">Settings</span>
                    <span class="tooltip">Settings</span>
                </div>
            </div>

            <div class="sidebar-bottom">
                <div class="user-profile">
                    <div class="user-avatar"><?= strtoupper(substr($_SESSION['username'] ?? 'U', 0, 1)) ?></div>
                    <div class="user-info">
                        <div class="user-name"><?= htmlspecialchars($_SESSION['username'] ?? 'User') ?></div>
                        <div class="user-role"><?= htmlspecialchars($_SESSION['role'] ?? 'Role') ?></div>
                    </div>
                    <i class="fa-solid fa-ellipsis-vertical user-more-icon" id="userMoreIcon"></i>
                    <div class="user-dropdown" id="userDropdown">
                        <a href="#" class="dropdown-item">
                            <i class="fa-regular fa-user"></i> My Profile
                        </a>
                        <a href="<?= $GLOBALS['baseURL'] ?>/logout" class="dropdown-item logout-item">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </aside>

        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <h1>Good morning, <span><?= htmlspecialchars($_SESSION['username'] ?? 'User') ?></span></h1>
                    <p>Here's what's happening with your projects today.</p>
                </div>
                <div class="header-right">
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Search tasks..." id="searchInput">
                    </div>
                    <button class="theme-toggle" id="themeToggle" aria-label="Toggle theme">
                        <i class="fa-solid fa-moon"></i>
                        <i class="fa-solid fa-sun"></i>
                    </button>
                    <button class="icon-btn" id="notifBtn" aria-label="Notifications">
                        <i class="fa-regular fa-bell"></i>
                        <span class="badge-dot"></span>
                    </button>
                    <button class="btn-primary" id="addTaskBtn">
                        <i class="fa-solid fa-plus"></i>
                        New Task
                    </button>
                </div>
            </header>

            <section class="stats-grid" aria-label="Task Statistics">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-list-check"></i></div>
                    <div class="stat-label">Total Tasks</div>
                    <div class="stat-value" id="totalTasks">5</div>
                    <div class="stat-change up"><i class="fa-solid fa-arrow-up"></i> 12% this week</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-spinner"></i></div>
                    <div class="stat-label">In Progress</div>
                    <div class="stat-value" id="inProgressTasks">1</div>
                    <div class="stat-change up"><i class="fa-solid fa-arrow-up"></i> Active now</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-circle-check"></i></div>
                    <div class="stat-label">Completed Today</div>
                    <div class="stat-value" id="completedTasks">0</div>
                    <div class="stat-change down"><i class="fa-solid fa-arrow-down"></i> None yet</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-clock"></i></div>
                    <div class="stat-label">Overdue</div>
                    <div class="stat-value" id="overdueTasks">2</div>
                    <div class="stat-change down"><i class="fa-solid fa-arrow-up"></i> Needs attention</div>
                </div>
            </section>

            <section aria-label="Task Board">
                <div class="board-header">
                    <h2 class="board-title">Task Board</h2>
                    <div class="board-filters">
                        <button class="filter-btn active" data-filter="all">All</button>
                        <button class="filter-btn" data-filter="high">High Priority</button>
                        <button class="filter-btn" data-filter="overdue">Overdue</button>
                    </div>
                </div>

                <div class="kanban-board" id="kanbanBoard">
                    <div class="kanban-column column-backlog" data-status="backlog">
                        <div class="column-header">
                            <div class="column-header-left">
                                <div class="column-dot"></div>
                                <span class="column-name">Backlog</span>
                                <span class="column-count" id="count-backlog">2</span>
                            </div>
                            <button class="add-task-btn" data-column="backlog" aria-label="Add task to Backlog"><i class="fa-solid fa-plus"></i></button>
                        </div>
                        <div class="task-list" data-status="backlog"></div>
                    </div>

                    <div class="kanban-column column-todo" data-status="todo">
                        <div class="column-header">
                            <div class="column-header-left">
                                <div class="column-dot"></div>
                                <span class="column-name">To Do</span>
                                <span class="column-count" id="count-todo">2</span>
                            </div>
                            <button class="add-task-btn" data-column="todo" aria-label="Add task to To Do"><i class="fa-solid fa-plus"></i></button>
                        </div>
                        <div class="task-list" data-status="todo"></div>
                    </div>

                    <div class="kanban-column column-inprogress" data-status="inprogress">
                        <div class="column-header">
                            <div class="column-header-left">
                                <div class="column-dot"></div>
                                <span class="column-name">In Progress</span>
                                <span class="column-count" id="count-inprogress">1</span>
                            </div>
                            <button class="add-task-btn" data-column="inprogress" aria-label="Add task to In Progress"><i class="fa-solid fa-plus"></i></button>
                        </div>
                        <div class="task-list" data-status="inprogress"></div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <div class="modal-overlay" id="modalOverlay">
        <div class="modal" role="dialog" aria-modal="true" aria-label="Add new task">
            <h3 class="modal-title">Create New Task</h3>
            <div class="form-group">
                <label class="form-label" for="taskTitle">Task Title</label>
                <input type="text" class="form-input" id="taskTitle" placeholder="Enter task title...">
            </div>
            <div class="form-group">
                <label class="form-label" for="taskDesc">Description</label>
                <textarea class="form-textarea" id="taskDesc" placeholder="Brief description..."></textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="taskPriority">Priority</label>
                    <select class="form-select" id="taskPriority">
                        <option value="low">Low</option>
                        <option value="medium" selected>Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="taskDue">Due Date</label>
                    <input type="date" class="form-input" id="taskDue">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="taskColumn">Column</label>
                    <select class="form-select" id="taskColumn">
                        <option value="backlog">Backlog</option>
                        <option value="todo" selected>To Do</option>
                        <option value="inprogress">In Progress</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="taskTag">Tag</label>
                    <select class="form-select" id="taskTag">
                        <option value="design">Design</option>
                        <option value="marketing">Marketing</option>
                        <option value="dev">Development</option>
                        <option value="urgent">Urgent</option>
                        <option value="research">Research</option>
                    </select>
                </div>
            </div>
            <div class="modal-actions">
                <button class="btn-cancel" id="modalCancel">Cancel</button>
                <button class="btn-primary" id="modalSubmit"><i class="fa-solid fa-plus"></i> Create Task</button>
            </div>
        </div>
    </div>

    <div class="toast-container" id="toastContainer"></div>

    <script src="<?= $GLOBALS['baseURL'] ?>/Public/Js/Dashboard.js?v=<?= time() ?>"></script>
</body>
</html>