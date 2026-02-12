<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa - Sistem PKL SMK Negeri 1 Kota Cirebon</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        /* ===== VARIABLES ===== */
        :root {
            --primary: #4361ee;
            --primary-dark: #3a0ca3;
            --secondary: #4cc9f0;
            --success: #28a745;
            --info: #17a2b8;
            --warning: #ffc107;
            --danger: #dc3545;
            --danger-light: #f72585;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --sidebar-bg: #1a1a2e;
            --card-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            --transition: all 0.2s ease;
            --border-radius: 12px;
            --border-radius-sm: 8px;
            --border-radius-lg: 16px;
        }

        /* ===== RESET & BASE ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fb;
            color: #333;
            overflow-x: hidden;
            line-height: 1.5;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, #16213e 100%);
            height: 100vh;
            position: fixed;
            width: 260px;
            z-index: 1000;
            box-shadow: 5px 0 20px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .brand-logo {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
        }

        .brand-logo i {
            font-size: 22px;
            color: white;
        }

        .brand-text h3 {
            color: white;
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 3px;
        }

        .brand-text p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.8rem;
            margin: 0;
        }

        .user-info {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .user-avatar {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--secondary) 0%, var(--info) 100%);
            border-radius: 50%;
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid rgba(255, 255, 255, 0.2);
        }

        .user-avatar i {
            font-size: 32px;
            color: white;
        }

        .user-details h5 {
            color: white;
            font-weight: 600;
            margin-bottom: 5px;
            font-size: 1rem;
        }

        .user-details p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.8rem;
            margin: 0;
        }

        .sidebar-menu {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .menu-items {
            flex: 1;
            padding: 20px 0;
            overflow-y: auto;
        }

        .nav-item {
            margin-bottom: 2px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.7);
            padding: 12px 20px;
            display: flex;
            align-items: center;
            transition: var(--transition);
            border-left: 3px solid transparent;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .nav-link:hover,
        .nav-link.active {
            color: white;
            background: rgba(255, 255, 255, 0.05);
            border-left-color: var(--primary);
        }

        .nav-link i {
            font-size: 18px;
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }

        .logout-section {
            padding: 15px 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.1);
        }

        .logout-btn-sidebar {
            background: linear-gradient(135deg, rgba(247, 37, 133, 0.2) 0%, rgba(181, 23, 158, 0.2) 100%);
            color: white;
            border: 1px solid rgba(247, 37, 133, 0.3);
            padding: 12px 20px;
            width: 100%;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            border-radius: 8px;
            transition: var(--transition);
            cursor: pointer;
        }

        .logout-btn-sidebar:hover {
            background: linear-gradient(135deg, rgba(247, 37, 133, 0.3) 0%, rgba(181, 23, 158, 0.3) 100%);
            transform: translateY(-2px);
        }

        .logout-btn-sidebar i {
            font-size: 18px;
            color: #ff6b9d;
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            margin-left: 260px;
            padding: 25px;
            transition: var(--transition);
            min-height: 100vh;
        }

        /* ===== TOPBAR ===== */
        .topbar {
            background: white;
            border-radius: var(--border-radius-lg);
            padding: 18px 25px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .page-title h1 {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 3px;
        }

        .page-title p {
            color: var(--gray);
            margin: 0;
            font-size: 0.9rem;
        }

        .user-btn {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 8px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: var(--transition);
        }

        .user-btn:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .user-avatar-sm {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-avatar-sm i {
            color: white;
            font-size: 16px;
        }

        .user-name {
            font-weight: 600;
            color: var(--dark);
            font-size: 0.9rem;
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--gray);
        }

        /* ===== CONTENT CARD ===== */
        .content-card {
            background: white;
            border-radius: var(--border-radius-lg);
            padding: 25px;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .card-header-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #edf2f7;
        }

        .card-header-custom h2 {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-header-custom h2 i {
            color: var(--primary);
            font-size: 1.5rem;
        }

        /* ===== FILTER SECTION ===== */
        .filter-section {
            background: #f8fafc;
            border-radius: var(--border-radius);
            padding: 20px;
            margin-bottom: 25px;
            border: 1px solid #edf2f7;
        }

        .filter-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            align-items: end;
        }

        .form-label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 6px;
            font-size: 0.85rem;
        }

        .form-control-custom {
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 14px;
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .form-control-custom:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
            outline: none;
        }

        /* ===== BUTTONS ===== */
        .btn {
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
        }

        .btn-sm {
            padding: 7px 14px;
            font-size: 0.85rem;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.2);
            color: white;
        }

        .btn-success-custom {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }

        .btn-success-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.2);
        }

        .btn-info-custom {
            background: linear-gradient(135deg, #0dcaf0, #0aa2c0);
            color: white;
        }

        .btn-secondary-custom {
            background: linear-gradient(135deg, #6c757d, #495057);
            color: white;
        }

        .btn-group-custom {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        /* ===== STATISTICS CARDS ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 18px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
            border: 1px solid #edf2f7;
            display: flex;
            align-items: center;
            transition: var(--transition);
        }

        .stat-card:hover {
            border-color: var(--primary);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.05);
            transform: translateY(-2px);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 20px;
            color: white;
        }

        .stat-icon.bg-primary {
            background: linear-gradient(135deg, #4361ee, #3a0ca3);
        }

        .stat-icon.bg-info {
            background: linear-gradient(135deg, #4cc9f0, #4895ef);
        }

        .stat-icon.bg-warning {
            background: linear-gradient(135deg, #f72585, #b5179e);
        }

        .stat-icon.bg-success {
            background: linear-gradient(135deg, #7209b7, #560bad);
        }

        .stat-content h3 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1.2;
        }

        .stat-content p {
            margin: 3px 0 0;
            color: var(--gray);
            font-size: 0.8rem;
            font-weight: 500;
        }

        /* ===== TABLE RESPONSIVE - HORIZONTAL SCROLL ===== */
        .table-responsive-custom {
            border-radius: var(--border-radius);
            overflow-x: auto;
            overflow-y: visible;
            border: 1px solid #edf2f7;
            background: white;
            -webkit-overflow-scrolling: touch;
        }

        .table-custom {
            margin-bottom: 0;
            width: 100%;
            min-width: 1100px;  /* Lebar minimum yang pas */
            border-collapse: collapse;
        }

        .table-custom thead {
            background: #f8fafc;
        }

        .table-custom th {
            padding: 14px 16px;
            font-weight: 600;
            color: #1e293b;
            border-bottom: 1px solid #e2e8f0;
            white-space: nowrap;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table-custom td {
            padding: 14px 16px;
            vertical-align: middle;
            border-bottom: 1px solid #edf2f7;
            font-size: 0.9rem;
            white-space: nowrap;
        }

        .table-custom tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.02);
        }

        /* ===== BADGES ===== */
        .badge-custom {
            padding: 5px 12px;
            border-radius: 30px;
            font-weight: 500;
            font-size: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .badge-primary-custom {
            background: rgba(67, 97, 238, 0.08);
            color: #4361ee;
        }

        .badge-success-custom {
            background: rgba(40, 167, 69, 0.08);
            color: #28a745;
        }

        .badge-warning-custom {
            background: rgba(255, 193, 7, 0.08);
            color: #ffc107;
        }

        .badge-info-custom {
            background: rgba(23, 162, 184, 0.08);
            color: #17a2b8;
        }

        /* ===== STATUS BADGE ===== */
        .status-badge {
            padding: 5px 12px;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .status-active {
            background: rgba(40, 167, 69, 0.08);
            color: #28a745;
            border: 1px solid rgba(40, 167, 69, 0.2);
        }

        .status-completed {
            background: rgba(67, 97, 238, 0.08);
            color: #4361ee;
            border: 1px solid rgba(67, 97, 238, 0.2);
        }

        .status-upcoming {
            background: rgba(255, 193, 7, 0.08);
            color: #ffc107;
            border: 1px solid rgba(255, 193, 7, 0.2);
        }

        /* ===== ACTION BUTTONS - HORIZONTAL ===== */
        .action-buttons {
            display: flex;
            gap: 6px;
            justify-content: flex-start;
            flex-wrap: nowrap;  /* Penting: jangan wrap */
        }

        .btn-action {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            border: none;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-action-view {
            background: rgba(13, 202, 240, 0.08);
            color: #0dcaf0;
        }

        .btn-action-view:hover {
            background: #0dcaf0;
            color: white;
            transform: translateY(-2px);
        }

        .btn-action-edit {
            background: rgba(255, 193, 7, 0.08);
            color: #ffc107;
        }

        .btn-action-edit:hover {
            background: #ffc107;
            color: white;
            transform: translateY(-2px);
        }

        .btn-action-delete {
            background: rgba(220, 53, 69, 0.08);
            color: #dc3545;
        }

        .btn-action-delete:hover {
            background: #dc3545;
            color: white;
            transform: translateY(-2px);
        }

        .btn-action-nilai {
            background: rgba(40, 167, 69, 0.08);
            color: #28a745;
        }

        .btn-action-nilai:hover {
            background: #28a745;
            color: white;
            transform: translateY(-2px);
        }

        .btn-action-star {
            background: rgba(23, 162, 184, 0.08);
            color: #17a2b8;
        }

        .btn-action-star:hover {
            background: #17a2b8;
            color: white;
            transform: translateY(-2px);
        }

        .btn-action.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* ===== AVATAR ===== */
        .avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1rem;
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 50px 20px;
        }

        .empty-icon {
            font-size: 70px;
            color: #e2e8f0;
            margin-bottom: 20px;
        }

        .empty-state h4 {
            color: #1e293b;
            margin-bottom: 12px;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .empty-state p {
            color: #64748b;
            margin-bottom: 20px;
            font-size: 0.95rem;
        }

        /* ===== PAGINATION ===== */
        .pagination-custom {
            margin-top: 20px;
        }

        .pagination-custom .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .pagination-custom .page-link {
            border-radius: 8px;
            margin: 0 3px;
            border: 1px solid #e2e8f0;
            color: #1e293b;
            font-weight: 500;
            transition: var(--transition);
            padding: 8px 14px;
            font-size: 0.85rem;
        }

        .pagination-custom .page-link:hover {
            background-color: #f8fafc;
            border-color: var(--primary);
            color: var(--primary);
        }

        /* ===== MENU TOGGLE MOBILE ===== */
        .menu-toggle {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1001;
            background: var(--primary);
            color: white;
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 10px;
            font-size: 18px;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.2);
        }

        /* ===== SCROLLBAR CUSTOM ===== */
        .table-responsive-custom::-webkit-scrollbar {
            height: 6px;
        }

        .table-responsive-custom::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .table-responsive-custom::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .table-responsive-custom::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                width: 260px;
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            .menu-toggle {
                display: block;
            }
            .filter-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 20px;
            }
            .card-header-custom {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
            .stats-grid {
                grid-template-columns: 1fr;
            }
            .table-custom {
                min-width: 1000px;
            }
        }

        @media (max-width: 576px) {
            .topbar {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
            .topbar-actions {
                width: 100%;
            }
            .user-btn {
                width: 100%;
                justify-content: center;
            }
            .btn-group-custom {
                width: 100%;
            }
            .btn-group-custom .btn {
                flex: 1;
            }
        }

        .fade-in {
            animation: fadeIn 0.4s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <!-- Mobile Menu Toggle -->
    <button class="menu-toggle" id="menuToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- ===== SIDEBAR ===== -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-logo">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="brand-text">
                <h3>PKL System</h3>
                <p>SMK Negeri 1 Kota Cirebon</p>
            </div>
        </div>

        <div class="user-info">
            <div class="user-avatar">
                <i class="fas fa-user-tie"></i>
            </div>
            <div class="user-details">
                <h5>{{ Auth::guard('guru')->user()->nama ?? 'Administrator' }}</h5>
                <p>{{ Auth::guard('guru')->user()->jabatan ?? 'Guru Pembimbing' }}</p>
                <span class="badge badge-primary-custom mt-2 px-3 py-1">
                    {{ Auth::guard('guru')->user()->is_admin ? 'Administrator' : 'Guru' }}
                </span>
            </div>
        </div>

        <div class="sidebar-menu">
            <div class="menu-items">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('siswa.index') }}">
                            <i class="fas fa-users"></i>
                            <span class="nav-text">Data Siswa</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('nilai-pkl.index') }}">
                            <i class="fas fa-file-alt"></i>
                            <span class="nav-text">Nilai PKL</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-chart-pie"></i>
                            <span class="nav-text">Laporan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-cog"></i>
                            <span class="nav-text">Pengaturan</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="logout-section">
                <button class="logout-btn-sidebar" id="logoutBtn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Keluar dari Sistem</span>
                </button>
            </div>
        </div>
    </div>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="main-content" id="mainContent">
        <!-- Topbar -->
        <div class="topbar fade-in">
            <div class="page-title">
                <h1>Data Siswa</h1>
                <p><i class="fas fa-info-circle me-1 text-muted"></i>Kelola data siswa Praktik Kerja Lapangan</p>
            </div>
            <div class="topbar-actions">
                <button class="user-btn">
                    <div class="user-avatar-sm">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <div class="user-name">{{ Auth::guard('guru')->user()->nama ?? 'Administrator' }}</div>
                        <div class="user-role">Online</div>
                    </div>
                </button>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-grid fade-in">
            <div class="stat-card">
                <div class="stat-icon bg-primary">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $siswas->total() ?? 0 }}</h3>
                    <p>Total Siswa</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon bg-info">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $siswaAktif ?? 0 }}</h3>
                    <p>Sedang PKL</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon bg-warning">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $siswaSelesai ?? 0 }}</h3>
                    <p>Selesai PKL</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon bg-success">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $siswaSudahNilai ?? 0 }}</h3>
                    <p>Sudah Dinilai</p>
                </div>
            </div>
        </div>

        <!-- Main Content Card -->
        <div class="content-card fade-in">
            <!-- Card Header -->
            <div class="card-header-custom">
                <h2>
                    <i class="fas fa-list-check text-primary"></i>
                    Daftar Siswa PKL
                </h2>
                <div class="btn-group-custom">
                    <a href="{{ route('siswa.create') }}" class="btn btn-primary-custom btn-sm">
                        <i class="fas fa-plus-circle"></i>
                        Tambah Siswa
                    </a>
                    <button class="btn btn-success-custom btn-sm" onclick="exportToExcel()">
                        <i class="fas fa-file-excel"></i>
                        Export
                    </button>
                    <button class="btn btn-info-custom btn-sm" onclick="printTable()">
                        <i class="fas fa-print"></i>
                        Cetak
                    </button>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="filter-section">
                <form id="filterForm" method="GET" action="{{ route('siswa.index') }}">
                    <div class="filter-row">
                        <div>
                            <label class="form-label">Cari Siswa</label>
                            <input type="text" class="form-control form-control-custom" name="search"
                                value="{{ request('search') }}" placeholder="Nama / NIS / Tempat PKL">
                        </div>
                        <div>
                            <label class="form-label">Paket Keahlian</label>
                            <select class="form-control form-control-custom" name="paket_keahlian" id="filterPaket">
                                <option value="">Semua Paket</option>
                                @foreach($paketKeahlian as $paket)
                                    <option value="{{ $paket }}" {{ request('paket_keahlian') == $paket ? 'selected' : '' }}>
                                        {{ $paket }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="form-label">Status PKL</label>
                            <select class="form-control form-control-custom" name="status" id="filterStatus">
                                <option value="">Semua Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Sedang PKL</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai PKL</option>
                                <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>Belum PKL</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary-custom flex-grow-1">
                                <i class="fas fa-filter"></i>
                                Filter
                            </button>
                            <a href="{{ route('siswa.index') }}" class="btn btn-secondary-custom" title="Reset">
                                <i class="fas fa-sync-alt"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- ===== TABLE DENGAN HORIZONTAL SCROLL ===== -->
            <div class="table-responsive-custom">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Siswa</th>
                            <th>NIS</th>
                            <th>Paket Keahlian</th>
                            <th>Tempat, Tgl Lahir</th>
                            <th>Tempat PKL</th>
                            <th>Periode PKL</th>
                            <th>Status</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswas as $index => $siswa)
                            @php
                                $today = now();
                                $statusClass = 'status-upcoming';
                                $statusText = 'Belum PKL';
                                $statusIcon = 'fa-clock';

                                if ($siswa->tanggal_mulai_pkl && $siswa->tanggal_selesai_pkl) {
                                    $start = \Carbon\Carbon::parse($siswa->tanggal_mulai_pkl);
                                    $end = \Carbon\Carbon::parse($siswa->tanggal_selesai_pkl);

                                    if ($today->between($start, $end)) {
                                        $statusClass = 'status-active';
                                        $statusText = 'Sedang PKL';
                                        $statusIcon = 'fa-briefcase';
                                    } elseif ($today->gt($end)) {
                                        $statusClass = 'status-completed';
                                        $statusText = 'Selesai';
                                        $statusIcon = 'fa-check-circle';
                                    }
                                }

                                $hasNilai = $siswa->nilaiPkl()->exists();
                                $no = $siswas->firstItem() + $index;
                            @endphp
                            <tr>
                                <td class="fw-bold">{{ $no }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle me-2" style="background: linear-gradient(135deg, {{ $hasNilai ? '#28a745' : '#ffc107' }}, {{ $hasNilai ? '#20c997' : '#fd7e14' }});">
                                            {{ strtoupper(substr($siswa->nama, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-semibold">{{ $siswa->nama }}</div>
                                            <span class="badge-custom {{ $hasNilai ? 'badge-success-custom' : 'badge-warning-custom' }} mt-1">
                                                <i class="fas {{ $hasNilai ? 'fa-check-circle' : 'fa-clock' }}"></i>
                                                {{ $hasNilai ? 'Sudah dinilai' : 'Belum dinilai' }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge-custom badge-primary-custom">
                                        <i class="fas fa-id-card"></i>
                                        {{ $siswa->nis }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge-custom badge-info-custom">
                                        <i class="fas fa-code-branch"></i>
                                        {{ $siswa->paket_keahlian }}
                                    </span>
                                </td>
                                <td>
                                    <div>{{ $siswa->tempat_lahir }}</div>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d/m/Y') }}</small>
                                </td>
                                <td>
                                    @if($siswa->tempat_pkl)
                                        <div>{{ $siswa->tempat_pkl }}</div>
                                        @if($siswa->telepon_pkl)
                                            <small class="text-muted">{{ $siswa->telepon_pkl }}</small>
                                        @endif
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($siswa->tanggal_mulai_pkl && $siswa->tanggal_selesai_pkl)
                                        <small>{{ \Carbon\Carbon::parse($siswa->tanggal_mulai_pkl)->format('d/m/Y') }}</small><br>
                                        <small class="text-muted">s/d {{ \Carbon\Carbon::parse($siswa->tanggal_selesai_pkl)->format('d/m/Y') }}</small>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="status-badge {{ $statusClass }}">
                                        <i class="fas {{ $statusIcon }}"></i>
                                        {{ $statusText }}
                                    </span>
                                </td>
                                <td>
                                    <!-- ACTION BUTTONS - HORIZONTAL, TIDAK WRAP -->
                                    <div class="action-buttons">
                                        <a href="{{ route('siswa.show', $siswa->id) }}" 
                                           class="btn-action btn-action-view" 
                                           title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('siswa.edit', $siswa->id) }}" 
                                           class="btn-action btn-action-edit" 
                                           title="Edit Data">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        @if(!$hasNilai)
                                            <a href="{{ route('nilai-pkl.create', ['siswa' => $siswa->id]) }}" 
                                               class="btn-action btn-action-nilai" 
                                               title="Input Nilai">
                                                <i class="fas fa-file-alt"></i>
                                            </a>
                                            <button class="btn-action btn-action-delete" 
                                                    title="Hapus"
                                                    onclick="confirmDelete({{ $siswa->id }}, '{{ addslashes($siswa->nama) }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @else
                                            <a href="{{ route('nilai-pkl.show', $siswa->nilaiPkl->id) }}" 
                                               class="btn-action btn-action-star" 
                                               title="Lihat Nilai">
                                                <i class="fas fa-star"></i>
                                            </a>
                                            <span class="btn-action disabled" title="Tidak bisa dihapus">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="fas fa-user-graduate"></i>
                                        </div>
                                        <h4>Belum Ada Data Siswa</h4>
                                        <p class="text-muted">Mulai dengan menambahkan data siswa baru</p>
                                        <a href="{{ route('siswa.create') }}" class="btn btn-primary-custom">
                                            <i class="fas fa-plus-circle me-2"></i>
                                            Tambah Siswa
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($siswas->count() > 0)
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted small">
                        <i class="fas fa-info-circle me-1"></i>
                        Menampilkan {{ $siswas->firstItem() }} - {{ $siswas->lastItem() }} dari {{ $siswas->total() }} data
                    </div>
                    <nav>
                        <ul class="pagination pagination-custom">
                            {{ $siswas->withQueryString()->links('pagination::bootstrap-4') }}
                        </ul>
                    </nav>
                </div>
            @endif
        </div>
    </div>

    <!-- Delete Form -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('#filterPaket, #filterStatus').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Pilih...',
                allowClear: true
            });
        });

        // Mobile Menu Toggle
        $('#menuToggle').click(function() {
            $('#sidebar').toggleClass('active');
        });

        // Close sidebar when clicking outside
        $(document).click(function(e) {
            if ($(window).width() <= 992) {
                if (!$(e.target).closest('#sidebar').length && !$(e.target).closest('#menuToggle').length) {
                    $('#sidebar').removeClass('active');
                }
            }
        });

        // Confirm Delete
        function confirmDelete(id, nama) {
            Swal.fire({
                title: 'Hapus Data?',
                html: `
                    <div class="text-center">
                        <div style="width: 70px; height: 70px; margin: 0 auto 15px; background: #f72585; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-trash-alt" style="font-size: 30px; color: white;"></i>
                        </div>
                        <p style="font-size: 1.1rem; margin-bottom: 10px;">Yakin ingin menghapus siswa:</p>
                        <p style="font-weight: 700; color: #f72585; font-size: 1.2rem;">${nama}</p>
                        <p style="color: #6c757d; font-size: 0.9rem; margin-top: 15px;">Data yang dihapus tidak dapat dikembalikan!</p>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f72585',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-trash-alt me-2"></i>Ya, Hapus',
                cancelButtonText: '<i class="fas fa-times me-2"></i>Batal',
                reverseButtons: true,
                borderRadius: '16px'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#deleteForm').attr('action', '/siswa/' + id).submit();
                }
            });
        }

        // Export to Excel
        function exportToExcel() {
            Swal.fire({
                title: 'Export Data',
                text: 'Sedang menyiapkan file...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            setTimeout(() => {
                const table = document.querySelector('.table-custom');
                let csv = [];

                // Headers
                const headers = [];
                table.querySelectorAll('thead th').forEach(th => {
                    if (!th.textContent.includes('Aksi')) {
                        headers.push(`"${th.textContent.trim()}"`);
                    }
                });
                csv.push(headers.join(','));

                // Rows
                table.querySelectorAll('tbody tr').forEach(row => {
                    if (row.cells.length > 1) {
                        const cols = [];
                        for (let i = 0; i < row.cells.length - 1; i++) {
                            let text = row.cells[i].textContent.trim().replace(/\s+/g, ' ');
                            cols.push(`"${text}"`);
                        }
                        csv.push(cols.join(','));
                    }
                });

                const blob = new Blob(["\uFEFF" + csv.join('\n')], { type: 'text/csv;charset=utf-8;' });
                const link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = `data-siswa-${new Date().toISOString().slice(0, 10)}.csv`;
                link.click();

                Swal.fire({
                    title: 'Berhasil!',
                    text: 'File siap diunduh',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                });
            }, 1000);
        }

        // Print Table
        function printTable() {
            const table = document.querySelector('.table-custom').cloneNode(true);
            
            // Remove action column
            table.querySelectorAll('tr').forEach(row => {
                if (row.cells.length > 8) {
                    row.deleteCell(8);
                }
            });

            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <html>
                <head>
                    <title>Data Siswa PKL</title>
                    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
                    <style>
                        body { font-family: 'Inter', sans-serif; padding: 30px; }
                        h2 { color: #4361ee; margin-bottom: 20px; }
                        table { width: 100%; border-collapse: collapse; }
                        th { background: #1e293b; color: white; padding: 12px; text-align: left; }
                        td { padding: 10px; border-bottom: 1px solid #e2e8f0; }
                    </style>
                </head>
                <body>
                    <h2>Data Siswa PKL - SMK Negeri 1 Kota Cirebon</h2>
                    <p>Tanggal: ${new Date().toLocaleDateString('id-ID')}</p>
                    ${table.outerHTML}
                </body>
                </html>
            `);
            
            printWindow.document.close();
            printWindow.focus();
            setTimeout(() => printWindow.print(), 300);
        }

        // Auto submit filter
        $('#filterPaket, #filterStatus').change(function() {
            $('#filterForm').submit();
        });

        // Logout
        $('#logoutBtn').click(function() {
            Swal.fire({
                title: 'Konfirmasi Logout',
                text: 'Apakah Anda yakin ingin keluar?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#f72585',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-sign-out-alt me-2"></i>Ya, Keluar',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = $('<form>', {
                        method: 'POST',
                        action: '{{ route("logout") }}'
                    }).append($('<input>', {
                        type: 'hidden',
                        name: '_token',
                        value: '{{ csrf_token() }}'
                    }));
                    $('body').append(form);
                    form.submit();
                }
            });
        });

        // Success message
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            timer: 3000,
            showConfirmButton: false,
            position: 'top-end',
            toast: true,
            background: '#d4edda',
            color: '#155724'
        });
        @endif
    </script>
</body>

</html>