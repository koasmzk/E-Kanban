<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* === CSS Variables === */
        :root {
            --bg-deep: #0d0f13;
            --bg-main: #13161c;
            --bg-card: #1a1d26;
            --bg-card-hover: #1f2330;
            --bg-sidebar: #111318;
            --border: #252833;
            --border-light: #2e3244;
            --fg: #e8eaf0;
            --fg-muted: #8b8fa5;
            --fg-dim: #5c6078;
            --accent: #6c5ce7;
            --accent-glow: rgba(108, 92, 231, 0.15);
            --green: #00d68f;
            --green-bg: rgba(0, 214, 143, 0.1);
            --orange: #ffaa00;
            --orange-bg: rgba(255, 170, 0, 0.1);
            --red: #ff4d6a;
            --red-bg: rgba(255, 77, 106, 0.1);
            --blue: #4da6ff;
            --blue-bg: rgba(77, 166, 255, 0.1);
            --purple-bg: rgba(108, 92, 231, 0.1);
            --sidebar-width: 260px;
            --radius: 12px;
            --radius-sm: 8px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg-deep);
            color: var(--fg);
            overflow: hidden;
            height: 100vh;
        }

        /* === Layout === */
        .app-layout {
            display: flex;
            height: 100vh;
        }

        /* === Sidebar === */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--bg-sidebar);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            position: relative;
            z-index: 10;
        }

        .sidebar::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 1px;
            height: 100%;
            background: linear-gradient(to bottom, var(--accent), transparent 40%, transparent 60%, var(--accent));
            opacity: 0.3;
        }

        .sidebar-logo {
            padding: 24px 24px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid var(--border);
        }

        .logo-icon {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--accent), #a78bfa);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: white;
            box-shadow: 0 4px 16px rgba(108, 92, 231, 0.3);
        }

        .logo-text {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 20px;
            font-weight: 700;
            color: var(--fg);
            letter-spacing: -0.5px;
        }

        .sidebar-section {
            padding: 20px 16px 8px;
        }

        .sidebar-section-title {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: var(--fg-dim);
            padding: 0 8px;
            margin-bottom: 8px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: all 0.2s ease;
            color: var(--fg-muted);
            font-size: 14px;
            font-weight: 500;
            position: relative;
            margin-bottom: 2px;
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 15px;
        }

        .nav-item:hover {
            background: var(--bg-card);
            color: var(--fg);
        }

        .nav-item.active {
            background: var(--accent-glow);
            color: var(--accent);
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 20px;
            background: var(--accent);
            border-radius: 0 4px 4px 0;
        }

        .nav-badge {
            margin-left: auto;
            background: var(--red);
            color: white;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 10px;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding: 16px;
            border-top: 1px solid var(--border);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .user-profile:hover {
            background: var(--bg-card);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, #ff6b6b, #ffa07a);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
            color: white;
        }

        .user-info {
            flex: 1;
        }

        .user-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--fg);
        }

        .user-role {
            font-size: 11px;
            color: var(--fg-dim);
        }

        /* === Main Content === */
        .main-content {
            flex: 1;
            overflow-y: auto;
            padding: 28px 32px;
            background: var(--bg-main);
            position: relative;
        }

        /* Subtle background glow */
        .main-content::before {
            content: '';
            position: fixed;
            top: -200px;
            right: -200px;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(108, 92, 231, 0.05), transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        .main-content > * {
            position: relative;
            z-index: 1;
        }

        /* Scrollbar */
        .main-content::-webkit-scrollbar {
            width: 6px;
        }
        .main-content::-webkit-scrollbar-track {
            background: transparent;
        }
        .main-content::-webkit-scrollbar-thumb {
            background: var(--border-light);
            border-radius: 3px;
        }

        /* === Header === */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .header-left h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 28px;
            font-weight: 700;
            color: var(--fg);
            letter-spacing: -0.5px;
        }

        .header-left h1 span {
            color: var(--accent);
        }

        .header-left p {
            font-size: 14px;
            color: var(--fg-muted);
            margin-top: 4px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .search-box {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 8px 14px;
            transition: border-color 0.2s ease;
        }

        .search-box:focus-within {
            border-color: var(--accent);
        }

        .search-box i {
            color: var(--fg-dim);
            font-size: 14px;
        }

        .search-box input {
            background: none;
            border: none;
            outline: none;
            color: var(--fg);
            font-size: 13px;
            font-family: 'DM Sans', sans-serif;
            width: 180px;
        }

        .search-box input::placeholder {
            color: var(--fg-dim);
        }

        .icon-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            cursor: pointer;
            color: var(--fg-muted);
            font-size: 15px;
            transition: all 0.2s ease;
            position: relative;
        }

        .icon-btn:hover {
            background: var(--bg-card-hover);
            color: var(--fg);
            border-color: var(--border-light);
        }

        .icon-btn .badge {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 8px;
            height: 8px;
            background: var(--red);
            border-radius: 50%;
            border: 2px solid var(--bg-card);
        }

        .btn-primary {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 9px 18px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: var(--radius-sm);
            font-size: 13px;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 16px rgba(108, 92, 231, 0.25);
        }

        .btn-primary:hover {
            background: #7c6cf7;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(108, 92, 231, 0.35);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        /* === Stats Cards === */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            cursor: default;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            border-radius: 12px 12px 0 0;
        }

        .stat-card:nth-child(1)::before { background: var(--accent); }
        .stat-card:nth-child(2)::before { background: var(--blue); }
        .stat-card:nth-child(3)::before { background: var(--green); }
        .stat-card:nth-child(4)::before { background: var(--red); }

        .stat-card:hover {
            border-color: var(--border-light);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }

        .stat-card .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            margin-bottom: 14px;
        }

        .stat-card:nth-child(1) .stat-icon { background: var(--purple-bg); color: var(--accent); }
        .stat-card:nth-child(2) .stat-icon { background: var(--blue-bg); color: var(--blue); }
        .stat-card:nth-child(3) .stat-icon { background: var(--green-bg); color: var(--green); }
        .stat-card:nth-child(4) .stat-icon { background: var(--red-bg); color: var(--red); }

        .stat-label {
            font-size: 13px;
            color: var(--fg-muted);
            margin-bottom: 6px;
        }

        .stat-value {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 32px;
            font-weight: 700;
            color: var(--fg);
            letter-spacing: -1px;
        }

        .stat-change {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            font-weight: 500;
            margin-top: 8px;
            padding: 2px 8px;
            border-radius: 6px;
        }

        .stat-change.up {
            color: var(--green);
            background: var(--green-bg);
        }

        .stat-change.down {
            color: var(--red);
            background: var(--red-bg);
        }

        /* === Kanban Board === */
        .board-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .board-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 18px;
            font-weight: 600;
        }

        .board-filters {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-btn {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            transition: all 0.2s ease;
            border: 1px solid var(--border);
            background: transparent;
            color: var(--fg-muted);
        }

        .filter-btn:hover {
            border-color: var(--border-light);
            color: var(--fg);
        }

        .filter-btn.active {
            background: var(--accent-glow);
            border-color: var(--accent);
            color: var(--accent);
        }

        .kanban-board {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            min-height: 400px;
        }

        .kanban-column {
            background: var(--bg-deep);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 16px;
            min-height: 300px;
            transition: background 0.2s ease;
        }

        .kanban-column.drag-over {
            background: rgba(108, 92, 231, 0.03);
            border-color: var(--accent);
        }

        .column-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border);
        }

        .column-header-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .column-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .column-backlog .column-dot { background: var(--fg-dim); }
        .column-todo .column-dot { background: var(--blue); }
        .column-inprogress .column-dot { background: var(--orange); }

        .column-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--fg);
        }

        .column-count {
            font-size: 12px;
            font-weight: 600;
            color: var(--fg-dim);
            background: var(--bg-card);
            padding: 2px 8px;
            border-radius: 10px;
        }

        .add-task-btn {
            width: 26px;
            height: 26px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            border: 1px dashed var(--border-light);
            border-radius: 6px;
            color: var(--fg-dim);
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .add-task-btn:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: var(--accent-glow);
        }

        /* === Task Card === */
        .task-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 14px;
            margin-bottom: 10px;
            cursor: grab;
            transition: all 0.25s ease;
            position: relative;
        }

        .task-card:hover {
            border-color: var(--border-light);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
        }

        .task-card:active {
            cursor: grabbing;
        }

        .task-card.dragging {
            opacity: 0.5;
            transform: rotate(3deg);
        }

        .task-priority {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 5px;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .priority-high {
            background: var(--red-bg);
            color: var(--red);
        }

        .priority-medium {
            background: var(--orange-bg);
            color: var(--orange);
        }

        .priority-low {
            background: var(--green-bg);
            color: var(--green);
        }

        .task-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--fg);
            margin-bottom: 6px;
            line-height: 1.4;
        }

        .task-desc {
            font-size: 12px;
            color: var(--fg-muted);
            line-height: 1.5;
            margin-bottom: 12px;
        }

        .task-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 12px;
        }

        .task-tag {
            font-size: 11px;
            font-weight: 500;
            padding: 3px 8px;
            border-radius: 5px;
            background: var(--bg-deep);
            color: var(--fg-muted);
            border: 1px solid var(--border);
        }

        .task-tag.tag-design { color: #f472b6; border-color: rgba(244, 114, 182, 0.3); background: rgba(244, 114, 182, 0.08); }
        .task-tag.tag-marketing { color: #fbbf24; border-color: rgba(251, 191, 36, 0.3); background: rgba(251, 191, 36, 0.08); }
        .task-tag.tag-dev { color: var(--blue); border-color: rgba(77, 166, 255, 0.3); background: rgba(77, 166, 255, 0.08); }
        .task-tag.tag-urgent { color: var(--red); border-color: rgba(255, 77, 106, 0.3); background: rgba(255, 77, 106, 0.08); }
        .task-tag.tag-research { color: var(--accent); border-color: rgba(108, 92, 231, 0.3); background: rgba(108, 92, 231, 0.08); }

        .task-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .task-due {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            color: var(--fg-dim);
        }

        .task-due.overdue {
            color: var(--red);
        }

        .task-due i {
            font-size: 11px;
        }

        .task-assignees {
            display: flex;
            align-items: center;
        }

        .task-assignee {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 700;
            color: white;
            margin-left: -6px;
            border: 2px solid var(--bg-card);
        }

        .task-assignee:first-child {
            margin-left: 0;
        }

        /* Progress bar */
        .task-progress {
            margin-bottom: 10px;
        }

        .progress-bar-bg {
            height: 4px;
            background: var(--border);
            border-radius: 2px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            border-radius: 2px;
            transition: width 0.5s ease;
        }

        .progress-text {
            font-size: 11px;
            color: var(--fg-dim);
            margin-top: 4px;
        }

        /* === Modal === */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 100;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 28px;
            width: 460px;
            max-width: 90vw;
            animation: modalIn 0.25s ease;
        }

        @keyframes modalIn {
            from { opacity: 0; transform: translateY(20px) scale(0.96); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .modal-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--fg-muted);
            margin-bottom: 6px;
            display: block;
        }

        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 10px 14px;
            background: var(--bg-deep);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            color: var(--fg);
            font-size: 13px;
            font-family: 'DM Sans', sans-serif;
            transition: border-color 0.2s ease;
            outline: none;
        }

        .form-input:focus, .form-select:focus, .form-textarea:focus {
            border-color: var(--accent);
        }

        .form-textarea {
            resize: vertical;
            min-height: 70px;
        }

        .form-select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%238b8fa5' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 32px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 24px;
        }

        .btn-cancel {
            padding: 9px 18px;
            background: transparent;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            color: var(--fg-muted);
            font-size: 13px;
            font-weight: 500;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-cancel:hover {
            border-color: var(--border-light);
            color: var(--fg);
        }

        /* === Toast === */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 200;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .toast {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 12px 18px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            color: var(--fg);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
            animation: toastIn 0.3s ease, toastOut 0.3s ease 2.7s forwards;
            min-width: 260px;
        }

        .toast i {
            font-size: 16px;
        }

        .toast.success i { color: var(--green); }
        .toast.error i { color: var(--red); }
        .toast.info i { color: var(--blue); }

        @keyframes toastIn {
            from { opacity: 0; transform: translateX(40px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes toastOut {
            from { opacity: 1; transform: translateX(0); }
            to { opacity: 0; transform: translateX(40px); }
        }

        /* === Animations === */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .stat-card { animation: fadeInUp 0.4s ease backwards; }
        .stat-card:nth-child(1) { animation-delay: 0.05s; }
        .stat-card:nth-child(2) { animation-delay: 0.1s; }
        .stat-card:nth-child(3) { animation-delay: 0.15s; }
        .stat-card:nth-child(4) { animation-delay: 0.2s; }

        .kanban-column { animation: fadeInUp 0.4s ease backwards; }
        .kanban-column:nth-child(1) { animation-delay: 0.25s; }
        .kanban-column:nth-child(2) { animation-delay: 0.3s; }
        .kanban-column:nth-child(3) { animation-delay: 0.35s; }

        /* Subtle pulse on stat values */
        @keyframes countUp {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }

        .stat-value {
            animation: countUp 0.5s ease backwards;
        }

        /* Floating dot animation in sidebar */
        @keyframes floatDot {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-3px); }
        }

        .nav-item.active .nav-dot-indicator {
            animation: floatDot 2s ease-in-out infinite;
        }

        /* === Responsive === */
        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 900px) {
            .sidebar {
                display: none;
            }
            .kanban-board {
                grid-template-columns: 1fr;
            }
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>
    <div class="app-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-logo">
                <div class="logo-icon"><i class="fa-solid fa-bolt"></i></div>
                <div class="logo-text">TaskFlow</div>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-section-title">Menu</div>
                <div class="nav-item" data-page="overview">
                    <i class="fa-solid fa-house"></i>
                    <span>Overview</span>
                </div>
                <div class="nav-item active" data-page="dashboard">
                    <i class="fa-solid fa-table-columns"></i>
                    <span>Dashboard</span>
                </div>
                <div class="nav-item" data-page="calendar">
                    <i class="fa-regular fa-calendar"></i>
                    <span>Calendar</span>
                </div>
                <div class="nav-item" data-page="messages">
                    <i class="fa-regular fa-comment-dots"></i>
                    <span>Messages</span>
                    <span class="nav-badge">3</span>
                </div>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-section-title">Projects</div>
                <div class="nav-item" data-page="marketing">
                    <i class="fa-solid fa-bullhorn"></i>
                    <span>Marketing</span>
                </div>
                <div class="nav-item" data-page="mobile-app">
                    <i class="fa-solid fa-mobile-screen"></i>
                    <span>Mobile App</span>
                </div>
                <div class="nav-item" data-page="web-design">
                    <i class="fa-solid fa-palette"></i>
                    <span>Web Design</span>
                </div>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-section-title">Settings</div>
                <div class="nav-item" data-page="team">
                    <i class="fa-solid fa-users"></i>
                    <span>Team</span>
                </div>
                <div class="nav-item" data-page="settings">
                    <i class="fa-solid fa-gear"></i>
                    <span>Settings</span>
                </div>
            </div>

            <div class="sidebar-bottom">
                <div class="user-profile">
                    <div class="user-avatar">A</div>
                    <div class="user-info">
                        <div class="user-name">Alex Johnson</div>
                        <div class="user-role">Product Manager</div>
                    </div>
                    <i class="fa-solid fa-ellipsis-vertical" style="color: var(--fg-dim); font-size: 14px;"></i>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="header-left">
                    <h1>Good morning, <span>Alex</span></h1>
                    <p>Here's what's happening with your projects today.</p>
                </div>
                <div class="header-right">
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Search tasks..." id="searchInput">
                    </div>
                    <button class="icon-btn" id="notifBtn" aria-label="Notifications">
                        <i class="fa-regular fa-bell"></i>
                        <span class="badge"></span>
                    </button>
                    <button class="btn-primary" id="addTaskBtn">
                        <i class="fa-solid fa-plus"></i>
                        New Task
                    </button>
                </div>
            </header>

            <!-- Stats Cards -->
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

            <!-- Kanban Board -->
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
                    <!-- Kolom Backlog -->
                    <div class="kanban-column column-backlog" data-status="backlog">
                        <div class="column-header">
                            <div class="column-header-left">
                                <div class="column-dot"></div>
                                <span class="column-name">Backlog</span>
                                <span class="column-count" id="count-backlog">2</span>
                            </div>
                            <button class="add-task-btn" data-column="backlog" aria-label="Add task to Backlog"><i class="fa-solid fa-plus"></i></button>
                        </div>
                        <div class="task-list" data-status="backlog">
                            <!-- Kartu tugas akan di-render oleh JS -->
                        </div>
                    </div>

                    <!-- Kolom To Do -->
                    <div class="kanban-column column-todo" data-status="todo">
                        <div class="column-header">
                            <div class="column-header-left">
                                <div class="column-dot"></div>
                                <span class="column-name">To Do</span>
                                <span class="column-count" id="count-todo">2</span>
                            </div>
                            <button class="add-task-btn" data-column="todo" aria-label="Add task to To Do"><i class="fa-solid fa-plus"></i></button>
                        </div>
                        <div class="task-list" data-status="todo">
                        </div>
                    </div>

                    <!-- Kolom In Progress -->
                    <div class="kanban-column column-inprogress" data-status="inprogress">
                        <div class="column-header">
                            <div class="column-header-left">
                                <div class="column-dot"></div>
                                <span class="column-name">In Progress</span>
                                <span class="column-count" id="count-inprogress">1</span>
                            </div>
                            <button class="add-task-btn" data-column="inprogress" aria-label="Add task to In Progress"><i class="fa-solid fa-plus"></i></button>
                        </div>
                        <div class="task-list" data-status="inprogress">
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- Modal Tambah Tugas -->
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

    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>

    <script>
        // === Data Tugas ===
        const tasks = [
            {
                id: 1,
                title: 'Q2 Marketing',
                description: 'Plan Q2 marketing strategy and budget allocation for all channels.',
                priority: 'medium',
                status: 'backlog',
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
                status: 'backlog',
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
                status: 'todo',
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
                status: 'todo',
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
                status: 'inprogress',
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

        // === Render Semua Tugas ===
        function renderTasks() {
            const statuses = ['backlog', 'todo', 'inprogress'];

            statuses.forEach(status => {
                const list = document.querySelector(`.task-list[data-status="${status}"]`);
                list.innerHTML = '';

                // Filter tugas berdasarkan filter aktif
                let filtered = tasks.filter(t => t.status === status);
                if (currentFilter === 'high') {
                    filtered = filtered.filter(t => t.priority === 'high');
                } else if (currentFilter === 'overdue') {
                    filtered = filtered.filter(t => t.overdue);
                }

                // Pencarian
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

                // Update jumlah di header kolom
                const totalInColumn = tasks.filter(t => t.status === status).length;
                document.getElementById(`count-${status}`).textContent = totalInColumn;
            });

            updateStats();
        }

        // === Buat Kartu Tugas ===
        function createTaskCard(task) {
            const card = document.createElement('div');
            card.className = 'task-card';
            card.draggable = true;
            card.dataset.id = task.id;

            // Prioritas
            const priorityClass = `priority-${task.priority}`;
            const priorityLabel = task.priority.charAt(0).toUpperCase() + task.priority.slice(1);

            // Tenggat
            const dueDate = new Date(task.due);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            const isOverdue = dueDate < today;
            const dueText = dueDate.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });

            // Tag
            const tagsHtml = task.tags.map(tag => {
                const tagClass = `tag-${tag}`;
                const tagLabel = tag.charAt(0).toUpperCase() + tag.slice(1);
                return `<span class="task-tag ${tagClass}">${tagLabel}</span>`;
            }).join('');

            // Assignee
            const assigneesHtml = task.assignees.map(a =>
                `<div class="task-assignee" style="background: ${a.color}" title="${a.initials}">${a.initials}</div>`
            ).join('');

            // Progress (hanya tampil jika > 0)
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

            // Drag events
            card.addEventListener('dragstart', handleDragStart);
            card.addEventListener('dragend', handleDragEnd);

            return card;
        }

        // === Update Statistik ===
        function updateStats() {
            const total = tasks.length;
            const inProgress = tasks.filter(t => t.status === 'inprogress').length;
            const completed = tasks.filter(t => t.status === 'completed').length;
            const overdue = tasks.filter(t => t.overdue).length;

            animateValue('totalTasks', total);
            animateValue('inProgressTasks', inProgress);
            animateValue('completedTasks', completed);
            animateValue('overdueTasks', overdue);
        }

        // Animasi angka naik
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

        // === Drag & Drop ===
        function handleDragStart(e) {
            draggedCard = this;
            this.classList.add('dragging');
            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/plain', this.dataset.id);
        }

        function handleDragEnd(e) {
            this.classList.remove('dragging');
            draggedCard = null;
            document.querySelectorAll('.kanban-column').forEach(col => col.classList.remove('drag-over'));
        }

        // Setup drag & drop pada kolom
        document.querySelectorAll('.kanban-column').forEach(column => {
            column.addEventListener('dragover', e => {
                e.preventDefault();
                e.dataTransfer.dropEffect = 'move';
                column.classList.add('drag-over');
            });

            column.addEventListener('dragleave', e => {
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
            const labels = { backlog: 'Backlog', todo: 'To Do', inprogress: 'In Progress' };
            return labels[status] || status;
        }

        // === Filter ===
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                currentFilter = btn.dataset.filter;
                renderTasks();
            });
        });

        // === Pencarian ===
        document.getElementById('searchInput').addEventListener('input', () => {
            renderTasks();
        });

        // === Navigasi Sidebar ===
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', () => {
                document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
                item.classList.add('active');
                showToast('info', `Navigated to ${item.querySelector('span').textContent}`);
            });
        });

        // === Modal ===
        const modalOverlay = document.getElementById('modalOverlay');
        const addTaskBtn = document.getElementById('addTaskBtn');
        const modalCancel = document.getElementById('modalCancel');
        const modalSubmit = document.getElementById('modalSubmit');

        // Buka modal dari tombol header
        addTaskBtn.addEventListener('click', () => {
            openModal('todo');
        });

        // Buka modal dari tombol + di kolom
        document.querySelectorAll('.add-task-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const column = btn.dataset.column;
                openModal(column);
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

        // ESC untuk tutup modal
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeModal();
        });

        // Submit tugas baru
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

        // === Notifikasi ===
        document.getElementById('notifBtn').addEventListener('click', () => {
            showToast('info', '2 overdue tasks need your attention');
        });

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

            // Hapus toast setelah 3 detik
            setTimeout(() => {
                if (toast.parentNode) toast.parentNode.removeChild(toast);
            }, 3000);
        }

        // === Greeting Dinamis Berdasarkan Waktu ===
        function updateGreeting() {
            const hour = new Date().getHours();
            const h1 = document.querySelector('.header-left h1');
            let greeting;

            if (hour < 12) greeting = 'Good morning';
            else if (hour < 18) greeting = 'Good afternoon';
            else greeting = 'Good evening';

            h1.innerHTML = `${greeting}, <span>Alex</span>`;
        }

        // === Inisialisasi ===
        updateGreeting();
        renderTasks();
    </script>
</body>
</html>