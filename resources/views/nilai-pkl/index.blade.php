<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Nilai PKL - Sistem PKL SMK Negeri 1 Kota Cirebon</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

    <style>
        /* ===== VARIABLES ===== */
        :root {
            --primary: #4361ee;
            --secondary: #3a0ca3;
            --success: #4cc9f0;
            --info: #4895ef;
            --warning: #f72585;
            --danger: #dc3545;
            --light: #f8f9fa;
            --dark: #212529;
            --sidebar-bg: #1a1a2e;
            --card-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, #16213e 100%);
            height: 100vh;
            position: fixed;
            width: 280px;
            z-index: 1000;
            box-shadow: 5px 0 30px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            padding: 30px 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            flex-shrink: 0;
        }

        .brand-logo {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .brand-logo i {
            font-size: 24px;
            color: white;
        }

        .brand-text h3 {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .brand-text p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.85rem;
            margin: 0;
        }

        .user-info {
            padding: 25px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            flex-shrink: 0;
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--success) 0%, var(--info) 100%);
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 4px solid rgba(255, 255, 255, 0.2);
        }

        .user-avatar i {
            font-size: 36px;
            color: white;
        }

        .user-details h5 {
            color: white;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .user-details p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
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
            padding: 25px 0;
            overflow-y: auto;
        }

        .nav-item {
            margin-bottom: 5px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.7);
            padding: 15px 25px;
            display: flex;
            align-items: center;
            transition: var(--transition);
            border-left: 4px solid transparent;
            text-decoration: none;
        }

        .nav-link:hover,
        .nav-link.active {
            color: white;
            background: rgba(255, 255, 255, 0.05);
            border-left-color: var(--primary);
        }

        .nav-link i {
            font-size: 20px;
            margin-right: 12px;
            width: 24px;
        }

        .nav-text {
            font-size: 0.95rem;
            font-weight: 500;
        }

        .logout-section {
            padding: 20px 25px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.1);
            flex-shrink: 0;
            margin-top: auto;
        }

        .logout-btn-sidebar {
            background: linear-gradient(135deg, rgba(247, 37, 133, 0.2) 0%, rgba(181, 23, 158, 0.2) 100%);
            color: white;
            border: 1px solid rgba(247, 37, 133, 0.3);
            padding: 16px 25px;
            width: 100%;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 15px;
            font-weight: 600;
            border-radius: 12px;
            transition: var(--transition);
            cursor: pointer;
        }

        .logout-btn-sidebar:hover {
            background: linear-gradient(135deg, rgba(247, 37, 133, 0.3) 0%, rgba(181, 23, 158, 0.3) 100%);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(247, 37, 133, 0.3);
            border-color: rgba(247, 37, 133, 0.5);
        }

        .logout-btn-sidebar i {
            font-size: 20px;
            color: #ff6b9d;
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            margin-left: 280px;
            padding: 30px;
            transition: var(--transition);
            min-height: 100vh;
        }

        /* ===== TOPBAR ===== */
        .topbar {
            background: white;
            border-radius: 15px;
            padding: 20px 30px;
            margin-bottom: 30px;
            box-shadow: var(--card-shadow);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 5px;
        }

        .page-title p {
            color: #6c757d;
            margin: 0;
            font-size: 0.95rem;
        }

        .user-btn {
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: var(--transition);
        }

        .user-btn:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.1);
        }

        .user-avatar-sm {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-avatar-sm i {
            color: white;
            font-size: 18px;
        }

        .user-name {
            font-weight: 600;
            color: var(--dark);
        }

        .user-role {
            font-size: 0.85rem;
            color: #6c757d;
        }

        /* ===== CONTENT CARD ===== */
        .content-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
        }

        .card-header-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f1f3f9;
        }

        .card-header-custom h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* ===== FILTER SECTION ===== */
        .filter-section {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 25px;
            border: 1px solid #e9ecef;
        }

        .filter-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            align-items: end;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .form-control-custom {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 10px 15px;
            transition: var(--transition);
        }

        .form-control-custom:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
        }

        /* ===== BUTTONS ===== */
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border: none;
            border-radius: 10px;
            padding: 10px 25px;
            color: white;
            font-weight: 600;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(67, 97, 238, 0.3);
            color: white;
        }

        .btn-success-custom {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
            border-radius: 10px;
            padding: 10px 25px;
            color: white;
            font-weight: 600;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-success-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
        }

        .btn-info-custom {
            background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 100%);
            border: none;
            border-radius: 10px;
            padding: 10px 25px;
            color: white;
            font-weight: 600;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-info-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(13, 202, 240, 0.3);
        }

        .btn-secondary-custom {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            border: none;
            border-radius: 10px;
            padding: 10px 25px;
            color: white;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-secondary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(108, 117, 125, 0.3);
        }

        /* ===== STATISTICS CARDS ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.03);
            border: 1px solid #e9ecef;
            display: flex;
            align-items: center;
            transition: var(--transition);
        }

        .stat-card:hover {
            border-color: var(--primary);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.08);
        }

        .stat-icon {
            width: 55px;
            height: 55px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 22px;
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
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1.2;
        }

        .stat-content p {
            margin: 5px 0 0;
            color: #6c757d;
            font-size: 0.85rem;
            font-weight: 500;
        }

        /* ===== TABLE STYLES ===== */
        .table-responsive-custom {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid #e9ecef;
        }

        .table-custom {
            margin-bottom: 0;
            width: 100%;
        }

        .table-custom thead {
            background: linear-gradient(90deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .table-custom th {
            padding: 16px 20px;
            font-weight: 700;
            color: #495057;
            border-bottom: 2px solid #dee2e6;
            white-space: nowrap;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table-custom td {
            padding: 16px 20px;
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
        }

        .table-custom tbody tr {
            transition: var(--transition);
        }

        .table-custom tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.03);
        }

        /* ===== BADGES ===== */
        .badge-custom {
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.85rem;
        }

        .badge-primary-custom {
            background: rgba(67, 97, 238, 0.1);
            color: #4361ee;
        }

        .badge-info-custom {
            background: rgba(23, 162, 184, 0.1);
            color: #17a2b8;
        }

        /* ===== PREDIKAT BADGE ===== */
        .predikat-badge {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .predikat-a {
            background: rgba(40, 167, 69, 0.15);
            color: #28a745;
            border: 2px solid #28a745;
        }

        .predikat-b {
            background: rgba(13, 202, 240, 0.15);
            color: #0dcaf0;
            border: 2px solid #0dcaf0;
        }

        .predikat-c {
            background: rgba(255, 193, 7, 0.15);
            color: #ffc107;
            border: 2px solid #ffc107;
        }

        .predikat-d {
            background: rgba(253, 126, 20, 0.15);
            color: #fd7e14;
            border: 2px solid #fd7e14;
        }

        .predikat-e {
            background: rgba(220, 53, 69, 0.15);
            color: #dc3545;
            border: 2px solid #dc3545;
        }

        /* ===== PROGRESS BAR ===== */
        .progress-custom {
            height: 24px;
            border-radius: 12px;
            background-color: #e9ecef;
            overflow: hidden;
            min-width: 120px;
        }

        .progress-bar-custom {
            font-size: 11px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            height: 100%;
        }

        .bg-gradient-success {
            background: linear-gradient(90deg, #28a745, #20c997);
        }

        .bg-gradient-info {
            background: linear-gradient(90deg, #17a2b8, #0dcaf0);
        }

        .bg-gradient-warning {
            background: linear-gradient(90deg, #ffc107, #fd7e14);
        }

        .bg-gradient-danger {
            background: linear-gradient(90deg, #dc3545, #f72585);
        }

        /* ===== ACTION BUTTONS ===== */
        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-action {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            border: none;
            text-decoration: none;
            font-size: 16px;
        }

        .btn-action-view {
            background: rgba(13, 202, 240, 0.1);
            color: #0dcaf0;
        }

        .btn-action-view:hover {
            background: #0dcaf0;
            color: white;
            transform: translateY(-2px);
        }

        .btn-action-print {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }

        .btn-action-print:hover {
            background: #28a745;
            color: white;
            transform: translateY(-2px);
        }

        .btn-action-edit {
            background: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }

        .btn-action-edit:hover {
            background: #ffc107;
            color: white;
            transform: translateY(-2px);
        }

        .btn-action-delete {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }

        .btn-action-delete:hover {
            background: #dc3545;
            color: white;
            transform: translateY(-2px);
        }

        .btn-action-export {
            background: rgba(23, 162, 184, 0.1);
            color: #17a2b8;
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-icon {
            font-size: 80px;
            color: #dee2e6;
            margin-bottom: 20px;
        }

        .empty-state h4 {
            color: #6c757d;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .empty-state p {
            color: #adb5bd;
            margin-bottom: 25px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        /* ===== PAGINATION ===== */
        .pagination-custom .page-item.active .page-link {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-color: var(--primary);
            color: white;
        }

        .pagination-custom .page-link {
            border-radius: 8px;
            margin: 0 4px;
            border: 1px solid #e9ecef;
            color: #495057;
            font-weight: 500;
            transition: var(--transition);
            padding: 8px 14px;
        }

        .pagination-custom .page-link:hover {
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }

        /* ===== MENU TOGGLE MOBILE ===== */
        .menu-toggle {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1001;
            background: var(--primary);
            color: white;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 12px;
            font-size: 20px;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
            transition: var(--transition);
        }

        .menu-toggle:hover {
            transform: scale(1.1);
        }

        /* ===== ANIMATIONS ===== */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1200px) {
            .sidebar {
                width: 250px;
            }
            .main-content {
                margin-left: 250px;
            }
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
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
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
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
            .table-custom th,
            .table-custom td {
                padding: 12px 15px;
                font-size: 0.85rem;
            }
        }

        @media (max-width: 576px) {
            .topbar {
                flex-direction: column;
                gap: 20px;
                align-items: flex-start;
            }
            .topbar-actions {
                width: 100%;
            }
            .user-btn {
                width: 100%;
                justify-content: center;
            }
            .card-header-custom .d-flex {
                flex-direction: column;
                width: 100%;
            }
            .btn-primary-custom,
            .btn-success-custom,
            .btn-info-custom {
                width: 100%;
                justify-content: center;
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
                <span class="badge badge-primary-custom mt-2">
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
                        <a class="nav-link" href="{{ route('siswa.index') }}">
                            <i class="fas fa-users"></i>
                            <span class="nav-text">Data Siswa</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('nilai-pkl.index') }}">
                            <i class="fas fa-file-alt"></i>
                            <span class="nav-text">Nilai PKL</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-chart-bar"></i>
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
                <h1>Daftar Nilai PKL</h1>
                <p>Kelola semua nilai Praktik Kerja Lapangan siswa</p>
            </div>
            <div class="topbar-actions">
                <button class="user-btn">
                    <div class="user-avatar-sm">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <div class="user-name">{{ Auth::guard('guru')->user()->nama ?? 'Administrator' }}</div>
                        <div class="user-role">{{ Auth::guard('guru')->user()->is_admin ? 'Admin' : 'Guru' }}</div>
                    </div>
                </button>
            </div>
        </div>

        <!-- Content Card -->
        <div class="content-card fade-in">
            <!-- Card Header -->
            <div class="card-header-custom">
                <h2>
                    <i class="fas fa-file-alt text-primary"></i>
                    Data Nilai Praktik Kerja Lapangan
                </h2>
                <div class="d-flex gap-2">
                    <a href="{{ route('nilai-pkl.create') }}" class="btn btn-primary-custom">
                        <i class="fas fa-plus"></i>
                        Input Nilai Baru
                    </a>
                    <button class="btn btn-success-custom" onclick="exportToExcel()">
                        <i class="fas fa-file-excel"></i>
                        Export
                    </button>
                    <button class="btn btn-info-custom" onclick="printNilaiTable()">
                        <i class="fas fa-print"></i>
                        Cetak
                    </button>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="filter-section">
                <form id="filterForm" method="GET" action="{{ route('nilai-pkl.index') }}">
                    <div class="filter-row">
                        <div>
                            <label class="form-label">Cari Siswa</label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-custom" name="search"
                                    value="{{ request('search') }}" placeholder="Nama atau NIS...">
                                <button class="btn btn-primary-custom" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div>
                            <label class="form-label">Paket Keahlian</label>
                            <select class="form-control form-control-custom" name="paket_keahlian" id="filterPaket">
                                <option value="">Semua Paket</option>
                                @foreach([
                                    'Teknik Komputer dan Jaringan (TKJ)',
                                    'Rekayasa Perangkat Lunak (RPL)',
                                    'Multimedia',
                                    'Akuntansi',
                                    'Administrasi Perkantoran',
                                    'Pemasaran',
                                    'Tata Boga',
                                    'Tata Busana',
                                    'Teknik Kendaraan Ringan (TKR)',
                                    'Teknik dan Bisnis Sepeda Motor (TBSM)',
                                ] as $paket)
                                    <option value="{{ $paket }}" {{ request('paket_keahlian') == $paket ? 'selected' : '' }}>
                                        {{ $paket }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="form-label">Periode PKL</label>
                            <input type="month" class="form-control form-control-custom" name="bulan"
                                value="{{ request('bulan') }}" placeholder="Pilih bulan">
                        </div>
                        <div class="d-flex gap-2 align-items-end">
                            <button type="submit" class="btn btn-primary-custom flex-grow-1">
                                <i class="fas fa-filter"></i>
                                Filter
                            </button>
                            <a href="{{ route('nilai-pkl.index') }}" class="btn btn-secondary-custom">
                                <i class="fas fa-sync-alt"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Statistics Cards -->
            <div class="stats-grid mb-4">
                <div class="stat-card">
                    <div class="stat-icon bg-primary">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $totalNilai ?? 0 }}</h3>
                        <p>Total Nilai PKL</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-info">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $nilaiPkls->total() ?? 0 }}</h3>
                        <p>Siswa Dinilai</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-warning">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ date('Y') }}</h3>
                        <p>Tahun Ajaran</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-success">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ isset($rataRata) ? number_format($rataRata, 1) : '0.0' }}</h3>
                        <p>Rata-rata Nilai</p>
                    </div>
                </div>
            </div>

            <!-- Data Table -->
            <div class="table-responsive-custom">
                <table class="table table-custom" id="nilaiTable">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Siswa</th>
                            <th>NIS</th>
                            <th>Paket Keahlian</th>
                            <th>Tempat PKL</th>
                            <th>Nilai Rata-rata</th>
                            <th>Predikat</th>
                            <th>Periode PKL</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($nilaiPkls as $index => $nilai)
                            @php
                                $rataRataNilai = $nilai->rata_rata ?? 0;
                                $huruf = $nilai->huruf_rata_rata ?? 'E';
                                
                                $predikatClass = 'predikat-e';
                                if ($huruf == 'A') $predikatClass = 'predikat-a';
                                elseif ($huruf == 'B') $predikatClass = 'predikat-b';
                                elseif ($huruf == 'C') $predikatClass = 'predikat-c';
                                elseif ($huruf == 'D') $predikatClass = 'predikat-d';
                                
                                $progressClass = 'bg-gradient-danger';
                                if ($rataRataNilai >= 86) $progressClass = 'bg-gradient-success';
                                elseif ($rataRataNilai >= 71) $progressClass = 'bg-gradient-info';
                                elseif ($rataRataNilai >= 56) $progressClass = 'bg-gradient-warning';
                                
                                $no = $loop->iteration + (($nilaiPkls->currentPage() - 1) * $nilaiPkls->perPage());
                            @endphp
                            <tr>
                                <td class="text-center fw-bold">{{ $no }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3"
                                            style="width: 45px; height: 45px; background: linear-gradient(135deg, var(--primary), var(--secondary)) !important;">
                                            <span class="text-white fw-bold">
                                                {{ strtoupper(substr($nilai->siswa->nama ?? 'N', 0, 1)) }}
                                            </span>
                                        </div>
                                        <div>
                                            <strong>{{ $nilai->siswa->nama ?? 'N/A' }}</strong>
                                            @if($nilai->siswa->kelas)
                                                <div class="small text-muted">{{ $nilai->siswa->kelas }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-primary-custom">{{ $nilai->siswa->nis ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <span class="badge badge-info-custom">{{ $nilai->siswa->paket_keahlian ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <div class="small fw-medium">{{ $nilai->tempat_pkl ?? '-' }}</div>
                                    @if($nilai->no_surat)
                                        <div class="small text-muted">No: {{ $nilai->no_surat }}</div>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2" style="min-width: 140px;">
                                        <div class="progress-custom flex-grow-1">
                                            <div class="progress-bar-custom {{ $progressClass }}"
                                                style="width: {{ $rataRataNilai }}%;">
                                                {{ number_format($rataRataNilai, 1) }}
                                            </div>
                                        </div>
                                        <span class="fw-bold">{{ number_format($rataRataNilai, 1) }}</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="predikat-badge {{ $predikatClass }}">
                                        {{ $huruf }}
                                    </span>
                                </td>
                                <td>
                                    @if($nilai->tgl_mulai && $nilai->tgl_selesai)
                                        <div class="small">
                                            <i class="fas fa-calendar-alt me-1 text-muted"></i>
                                            {{ \Carbon\Carbon::parse($nilai->tgl_mulai)->format('d/m/Y') }}
                                        </div>
                                        <div class="small text-muted">
                                            s/d {{ \Carbon\Carbon::parse($nilai->tgl_selesai)->format('d/m/Y') }}
                                        </div>
                                    @elseif($nilai->tgl_mulai)
                                        <div class="small">
                                            {{ \Carbon\Carbon::parse($nilai->tgl_mulai)->format('d/m/Y') }}
                                        </div>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('nilai-pkl.show', $nilai->id) }}"
                                            class="btn-action btn-action-view"
                                            title="Lihat Detail Nilai">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('nilai-pkl.cetak', $nilai->id) }}"
                                            class="btn-action btn-action-print"
                                            title="Cetak Sertifikat"
                                            target="_blank">
                                            <i class="fas fa-print"></i>
                                        </a>
                                        <a href="{{ route('nilai-pkl.edit', $nilai->id) }}"
                                            class="btn-action btn-action-edit"
                                            title="Edit Nilai">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn-action btn-action-delete"
                                            title="Hapus Nilai"
                                            onclick="confirmDelete({{ $nilai->id }}, '{{ addslashes($nilai->siswa->nama ?? 'Nilai ini') }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="fas fa-file-alt"></i>
                                        </div>
                                        <h4>Belum ada data nilai PKL</h4>
                                        <p class="text-muted">Mulai dengan menginput nilai PKL pertama untuk siswa</p>
                                        <div class="d-flex justify-content-center gap-3">
                                            <a href="{{ route('nilai-pkl.create') }}" class="btn btn-primary-custom">
                                                <i class="fas fa-plus me-2"></i> Input Nilai Baru
                                            </a>
                                            <a href="{{ route('siswa.index') }}" class="btn btn-secondary-custom">
                                                <i class="fas fa-users me-2"></i> Lihat Daftar Siswa
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($nilaiPkls->count() > 0)
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Menampilkan {{ $nilaiPkls->firstItem() }} - {{ $nilaiPkls->lastItem() }} dari {{ $nilaiPkls->total() }} data
                    </div>
                    <nav>
                        <ul class="pagination pagination-custom">
                            {{ $nilaiPkls->withQueryString()->links('pagination::bootstrap-4') }}
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
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#nilaiTable').DataTable({
                paging: false,
                searching: false,
                ordering: true,
                info: false,
                order: [[0, 'asc']],
                language: {
                    emptyTable: 'Tidak ada data nilai PKL',
                    zeroRecords: 'Tidak ada data yang ditemukan'
                }
            });

            // Initialize Select2
            $('#filterPaket').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Semua Paket Keahlian'
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
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                html: `
                    <div class="text-center py-3">
                        <div class="mb-3">
                            <i class="fas fa-trash-alt fa-4x" style="color: #f72585;"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Hapus Data Nilai?</h5>
                        <p class="mb-2">Apakah Anda yakin ingin menghapus nilai PKL siswa:</p>
                        <p class="fw-bold text-danger mb-3">"${name}"</p>
                        <p class="text-muted small">Data yang telah dihapus tidak dapat dikembalikan.</p>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f72585',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-trash-alt me-2"></i>Ya, Hapus',
                cancelButtonText: '<i class="fas fa-times me-2"></i>Batal',
                reverseButtons: true,
                background: '#fff',
                borderRadius: '20px'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#deleteForm').attr('action', '{{ url("nilai-pkl") }}/' + id).submit();
                }
            });
        }

        // Export to Excel
        function exportToExcel() {
            Swal.fire({
                title: 'Export Data',
                text: 'Sedang menyiapkan file Excel...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            setTimeout(() => {
                const table = document.getElementById('nilaiTable');
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
                    const cols = [];
                    row.querySelectorAll('td').forEach((td, index) => {
                        if (index !== 8) {
                            let text = td.textContent.trim().replace(/[\n\r]+/g, ' ').replace(/\s+/g, ' ');
                            cols.push(`"${text}"`);
                        }
                    });
                    csv.push(cols.join(','));
                });

                const blob = new Blob(["\uFEFF" + csv.join('\n')], { type: 'text/csv;charset=utf-8;' });
                const link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = `nilai-pkl-export-${new Date().toISOString().slice(0, 10)}.csv`;
                link.click();

                Swal.fire({
                    title: 'Export Berhasil!',
                    text: 'File Excel telah siap diunduh',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                });
            }, 1000);
        }

        // Print Table
        function printNilaiTable() {
            const table = document.getElementById('nilaiTable').cloneNode(true);
            
            table.querySelectorAll('tr').forEach(row => {
                if (row.children.length > 8) {
                    row.removeChild(row.children[8]);
                }
            });

            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <html>
                <head>
                    <title>Laporan Nilai PKL - SMK Negeri 1 Kota Cirebon</title>
                    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
                    <style>
                        body { font-family: 'Inter', sans-serif; padding: 30px; }
                        h1 { color: #1e293b; font-size: 24px; margin-bottom: 5px; }
                        h2 { color: #4361ee; font-size: 18px; margin-bottom: 20px; }
                        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
                        th { background: #1e293b; color: white; padding: 12px; text-align: left; }
                        td { padding: 10px; border-bottom: 1px solid #e2e8f0; }
                        .footer { margin-top: 50px; text-align: center; color: #64748b; font-size: 12px; }
                    </style>
                </head>
                <body>
                    <div style="text-align: center; margin-bottom: 30px;">
                        <h1>LAPORAN NILAI PRAKTIK KERJA LAPANGAN</h1>
                        <h2>SMK NEGERI 1 KOTA CIREBON</h2>
                        <p>Tahun Ajaran ${new Date().getFullYear()}</p>
                    </div>
                    ${table.outerHTML}
                    <div class="footer">
                        <p>Dicetak pada: ${new Date().toLocaleString('id-ID')}</p>
                        <p>Oleh: {{ Auth::guard('guru')->user()->nama ?? 'Administrator' }}</p>
                    </div>
                </body>
                </html>
            `);
            
            printWindow.document.close();
            printWindow.focus();
            setTimeout(() => {
                printWindow.print();
                printWindow.close();
            }, 250);
        }

        // Auto submit filter
        $('#filterPaket').change(function() {
            $('#filterForm').submit();
        });

        // Logout
        $('#logoutBtn').click(function() {
            Swal.fire({
                title: 'Konfirmasi Logout',
                text: 'Apakah Anda yakin ingin keluar dari sistem?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#f72585',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-sign-out-alt me-2"></i>Ya, Keluar',
                cancelButtonText: '<i class="fas fa-times me-2"></i>Batal',
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

        // Session messages
        @if(session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            icon: 'success',
            timer: 3000,
            showConfirmButton: false,
            position: 'top-end',
            toast: true,
            background: '#d4edda',
            color: '#155724'
        });
        @endif

        @if(session('error'))
        Swal.fire({
            title: 'Error!',
            text: '{{ session("error") }}',
            icon: 'error',
            confirmButtonColor: '#4361ee',
            background: '#f8d7da',
            color: '#721c24'
        });
        @endif
    </script>
</body>

</html>