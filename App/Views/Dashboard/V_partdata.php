<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Part — E-Kanban</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= $GLOBALS['baseURL'] ?>/Public/Css/Dashboard.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= $GLOBALS['baseURL'] ?>/Public/Css/Partdata.css?v=<?= time() ?>">
</head>
<body>
    <div class="theme-flash" id="themeFlash"></div>

    <div class="app-layout">
        <!-- Sidebar identik dengan Dashboard -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-logo">
                <div class="logo-icon"><i class="fa-solid fa-list-check"></i></div>
                <div class="logo-text">E-Kanban</div>
            </div>
            <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
                <i class="fa-solid fa-chevron-left"></i>
            </button>

            <div class="sidebar-section">
                <div class="sidebar-section-title">Menu</div>
                <div class="nav-item" data-href="<?= $GLOBALS['baseURL'] ?>/dashboard">
                    <i class="fa-solid fa-house"></i>
                    <span class="nav-item-text">Dashboard</span>
                    <span class="tooltip">Dashboard</span>
                </div>
                <div class="nav-item" data-href="<?= $GLOBALS['baseURL'] ?>/kanban-request">
                    <i class="fa-solid fa-table-columns"></i>
                    <span class="nav-item-text">Kanban Request</span>
                    <span class="tooltip">Kanban Request</span>
                </div>
                <div class="nav-item" data-href="<?= $GLOBALS['baseURL'] ?>/request-list">
                    <i class="fa-regular fa-calendar"></i>
                    <span class="nav-item-text">Request List</span>
                    <span class="tooltip">Request List</span>
                </div>
                <div class="nav-item" data-href="<?= $GLOBALS['baseURL'] ?>/notifikasi">
                    <i class="fa-regular fa-bell"></i>
                    <span class="nav-item-text">Notifikasi</span>
                    <span class="nav-badge">3</span>
                    <span class="tooltip">Notifikasi</span>
                </div>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-section-title">Master Data</div>
                <div class="nav-item active" data-href="<?= $GLOBALS['baseURL'] ?>/data-part">
                    <i class="fa-solid fa-boxes-stacked"></i>
                    <span class="nav-item-text">Data Part</span>
                    <span class="tooltip">Data Part</span>
                </div>
                <div class="nav-item" data-href="<?= $GLOBALS['baseURL'] ?>/line-aktif">
                    <i class="fa-solid fa-diagram-project"></i>
                    <span class="nav-item-text">Line Aktif</span>
                    <span class="tooltip">Line Aktif</span>
                </div>
                <div class="nav-item" data-href="<?= $GLOBALS['baseURL'] ?>/history">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    <span class="nav-item-text">History</span>
                    <span class="tooltip">History</span>
                </div>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-section-title">Settings</div>
                <div class="nav-item" data-href="<?= $GLOBALS['baseURL'] ?>/team">
                    <i class="fa-solid fa-users"></i>
                    <span class="nav-item-text">Team</span>
                    <span class="tooltip">Team</span>
                </div>
                <div class="nav-item" data-href="<?= $GLOBALS['baseURL'] ?>/settings">
                    <i class="fa-solid fa-gear"></i>
                    <span class="nav-item-text">Settings</span>
                    <span class="tooltip">Settings</span>
                </div>
                <div class="nav-item theme-nav-item" id="themeToggle">
                    <i class="fa-solid fa-moon theme-icon-dark"></i>
                    <i class="fa-solid fa-sun theme-icon-light"></i>
                    <span class="nav-item-text theme-label">Dark Mode</span>
                    <span class="tooltip">Toggle Theme</span>
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
                        <a href="#" class="dropdown-item"><i class="fa-regular fa-user"></i> My Profile</a>
                        <a href="<?= $GLOBALS['baseURL'] ?>/logout" class="dropdown-item logout-item">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <div class="page-breadcrumb">
                        <span class="breadcrumb-parent">Master Data</span>
                        <i class="fa-solid fa-chevron-right breadcrumb-sep"></i>
                        <span class="breadcrumb-current">Data Part</span>
                    </div>
                    <h1 class="page-title">Data Part</h1>
                    <p class="page-subtitle">Kelola daftar part yang tersedia dalam sistem.</p>
                </div>
                <div class="header-actions">
                    <button class="btn-primary" id="btnTambah">
                        <i class="fa-solid fa-plus"></i> Tambah Part
                    </button>
                </div>
            </header>

            <!-- Flash Message -->
            <?php if (!empty($_SESSION['flash_success'])): ?>
                <div class="flash flash-success">
                    <i class="fa-solid fa-circle-check"></i>
                    <?= htmlspecialchars($_SESSION['flash_success']) ?>
                </div>
                <?php unset($_SESSION['flash_success']); ?>
            <?php endif; ?>
            <?php if (!empty($_SESSION['flash_error'])): ?>
                <div class="flash flash-error">
                    <i class="fa-solid fa-circle-xmark"></i>
                    <?= htmlspecialchars($_SESSION['flash_error']) ?>
                </div>
                <?php unset($_SESSION['flash_error']); ?>
            <?php endif; ?>

            <!-- Table Card -->
            <div class="table-card">
                <div class="table-toolbar">
                    <div class="table-info">
                        <span class="table-count"><?= count($parts) ?> part terdaftar</span>
                    </div>
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="searchInput" placeholder="Cari nama atau part number...">
                    </div>
                </div>

                <div class="table-wrapper">
                    <table class="data-table" id="partsTable">
                        <thead>
                            <tr>
                                <th class="col-no">#</th>
                                <th>Nama Part</th>
                                <th>Part Number</th>
                                <th>Deskripsi</th>
                                <th>Dibuat</th>
                                <th class="col-action">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($parts)): ?>
                                <tr class="empty-row">
                                    <td colspan="6">
                                        <div class="empty-state">
                                            <i class="fa-solid fa-boxes-stacked"></i>
                                            <p>Belum ada data part</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($parts as $i => $part): ?>
                                    <tr data-name="<?= strtolower(htmlspecialchars($part['name'])) ?>"
                                        data-number="<?= strtolower(htmlspecialchars($part['part_number'])) ?>">
                                        <td class="col-no"><?= $i + 1 ?></td>
                                        <td class="td-name"><?= htmlspecialchars($part['name']) ?></td>
                                        <td>
                                            <span class="badge-part-number">
                                                <?= htmlspecialchars($part['part_number']) ?>
                                            </span>
                                        </td>
                                        <td class="td-desc"><?= htmlspecialchars($part['description'] ?: '—') ?></td>
                                        <td class="td-date">
                                            <?= date('d M Y', strtotime($part['created_at'])) ?>
                                        </td>
                                        <td class="col-action">
                                            <div class="action-btns">
                                                <button class="btn-icon btn-edit" title="Edit"
                                                    data-id="<?= $part['id'] ?>"
                                                    data-name="<?= htmlspecialchars($part['name'], ENT_QUOTES) ?>"
                                                    data-number="<?= htmlspecialchars($part['part_number'], ENT_QUOTES) ?>"
                                                    data-desc="<?= htmlspecialchars($part['description'] ?? '', ENT_QUOTES) ?>">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button class="btn-icon btn-delete" title="Hapus"
                                                    data-id="<?= $part['id'] ?>"
                                                    data-name="<?= htmlspecialchars($part['name'], ENT_QUOTES) ?>">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Tambah / Edit -->
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal" role="dialog" aria-modal="true">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle">Tambah Part</h3>
                <button class="modal-close" id="modalClose"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form id="partForm" method="POST">
                <input type="hidden" name="id" id="formId">
                <div class="form-group">
                    <label class="form-label" for="formName">Nama Part <span class="required">*</span></label>
                    <input type="text" class="form-input" id="formName" name="name" placeholder="Contoh: Baut M8" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="formNumber">Part Number <span class="required">*</span></label>
                    <input type="text" class="form-input" id="formNumber" name="part_number" placeholder="Contoh: BT-M8-001" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="formDesc">Deskripsi</label>
                    <textarea class="form-textarea" id="formDesc" name="description" placeholder="Deskripsi singkat part..."></textarea>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" id="modalCancel">Batal</button>
                    <button type="submit" class="btn-primary" id="modalSubmit">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal-overlay" id="deleteOverlay">
        <div class="modal modal-sm" role="dialog" aria-modal="true">
            <div class="modal-header">
                <h3 class="modal-title">Hapus Part</h3>
                <button class="modal-close" id="deleteClose"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <p class="delete-confirm-text">
                Yakin ingin menghapus <strong id="deleteName"></strong>? Tindakan ini tidak dapat dibatalkan.
            </p>
            <form method="POST" action="<?= $GLOBALS['baseURL'] ?>/data-part/delete">
                <input type="hidden" name="id" id="deleteId">
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" id="deleteCancel">Batal</button>
                    <button type="submit" class="btn-danger">
                        <i class="fa-solid fa-trash"></i> Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="toast-container" id="toastContainer"></div>

    <script src="<?= $GLOBALS['baseURL'] ?>/Public/Js/Partdata.js?v=<?= time() ?>"></script>
</body>
</html>