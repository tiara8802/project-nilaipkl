<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem PKL SMK Negeri 1 Kota Cirebon</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3a0ca3;
            --success: #4cc9f0;
            --info: #4895ef;
            --warning: #f72585;
            --light: #f8f9fa;
            --dark: #212529;
            --sidebar-bg: #1a1a2e;
            --card-shadow: 0 10px 40px rgba(0,0,0,0.08);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
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
        
        /* Sidebar Modern */
        .sidebar {
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, #16213e 100%);
            height: 100vh;
            position: fixed;
            width: 280px;
            z-index: 1000;
            box-shadow: 5px 0 30px rgba(0,0,0,0.1);
            transition: var(--transition);
            display: flex;
            flex-direction: column;
        }
        
        .sidebar-brand {
            padding: 30px 25px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
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
            color: rgba(255,255,255,0.6);
            font-size: 0.85rem;
            margin: 0;
        }
        
        .user-info {
            padding: 25px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
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
            border: 4px solid rgba(255,255,255,0.2);
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
            color: rgba(255,255,255,0.6);
            font-size: 0.9rem;
            margin: 0;
        }
        
        .sidebar-menu {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 0;
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
            color: rgba(255,255,255,0.7);
            padding: 15px 25px;
            display: flex;
            align-items: center;
            transition: var(--transition);
            border-left: 4px solid transparent;
            text-decoration: none;
        }
        
        .nav-link:hover {
            color: white;
            background: rgba(255,255,255,0.05);
            border-left-color: var(--primary);
        }
        
        .nav-link.active {
            color: white;
            background: rgba(255,255,255,0.08);
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
        
        /* TOMBOL LOGOUT DI SIDEBAR - JELAS DAN PASTI KELIHATAN */
        .logout-section {
            padding: 20px 25px;
            border-top: 1px solid rgba(255,255,255,0.1);
            background: rgba(0,0,0,0.1);
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
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
            border-radius: 12px;
            position: relative;
            overflow: hidden;
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
        
        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 30px;
            transition: var(--transition);
            min-height: 100vh;
        }
        
        /* Topbar */
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
        
        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-menu {
            position: relative;
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
        
        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }
        
        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.12);
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: linear-gradient(180deg, var(--primary) 0%, var(--secondary) 100%);
        }
        
        .stat-icon {
            width: 70px;
            height: 70px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 30px;
            color: white;
        }
        
        .stat-card:nth-child(1) .stat-icon { background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%); }
        .stat-card:nth-child(2) .stat-icon { background: linear-gradient(135deg, #4cc9f0 0%, #4895ef 100%); }
        .stat-card:nth-child(3) .stat-icon { background: linear-gradient(135deg, #f72585 0%, #b5179e 100%); }
        .stat-card:nth-child(4) .stat-icon { background: linear-gradient(135deg, #7209b7 0%, #560bad 100%); }
        
        .stat-content h3 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--dark);
        }
        
        .stat-content p {
            color: #6c757d;
            font-size: 0.95rem;
            margin: 0;
        }
        
        /* Welcome Card */
        .welcome-card {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 25px;
            padding: 40px;
            color: white;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(67, 97, 238, 0.3);
        }
        
        .welcome-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 30px 30px;
            opacity: 0.1;
        }
        
        .welcome-content h2 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .welcome-content p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 25px;
            max-width: 600px;
        }
        
        .welcome-illustration {
            position: absolute;
            right: 40px;
            bottom: 0;
            width: 200px;
        }
        
        /* Quick Actions */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .section-header h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
            margin: 0;
        }
        
        .quick-actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .action-btn {
            background: white;
            border: none;
            border-radius: 18px;
            padding: 25px 20px;
            text-align: center;
            transition: var(--transition);
            cursor: pointer;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            position: relative;
            overflow: hidden;
            text-decoration: none;
            display: block;
        }
        
        .action-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
        }
        
        .action-btn:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        
        .action-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 24px;
            color: white;
        }
        
        .action-btn:nth-child(1) .action-icon { background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%); }
        .action-btn:nth-child(2) .action-icon { background: linear-gradient(135deg, #4cc9f0 0%, #4895ef 100%); }
        .action-btn:nth-child(3) .action-icon { background: linear-gradient(135deg, #f72585 0%, #b5179e 100%); }
        .action-btn:nth-child(4) .action-icon { background: linear-gradient(135deg, #7209b7 0%, #560bad 100%); }
        
        .action-btn h5 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--dark);
        }
        
        .action-btn p {
            color: #6c757d;
            font-size: 0.9rem;
            margin: 0;
        }
        
        /* Recent Data Table */
        .recent-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: var(--card-shadow);
            margin-bottom: 40px;
        }
        
        .table-container {
            overflow-x: auto;
            border-radius: 15px;
        }
        
        .custom-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .custom-table thead {
            background: linear-gradient(90deg, #f8f9fa 0%, #e9ecef 100%);
        }
        
        .custom-table th {
            padding: 18px 20px;
            text-align: left;
            font-weight: 600;
            color: var(--dark);
            border-bottom: 2px solid #dee2e6;
        }
        
        .custom-table td {
            padding: 16px 20px;
            border-bottom: 1px solid #eee;
        }
        
        .custom-table tbody tr {
            transition: var(--transition);
        }
        
        .custom-table tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.03);
        }
        
        .badge {
            padding: 8px 15px;
            border-radius: 10px;
            font-weight: 500;
            font-size: 0.85rem;
        }
        
        .badge-success { background: rgba(40, 167, 69, 0.1); color: #28a745; }
        .badge-warning { background: rgba(255, 193, 7, 0.1); color: #ffc107; }
        .badge-danger { background: rgba(220, 53, 69, 0.1); color: #dc3545; }
        .badge-info { background: rgba(23, 162, 184, 0.1); color: #17a2b8; }
        .badge-primary { background: rgba(67, 97, 238, 0.1); color: #4361ee; }
        
        /* Empty State */
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
        
        /* Responsive */
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
        }
        
        @media (max-width: 768px) {
            .main-content {
                padding: 20px;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .quick-actions-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .welcome-illustration {
                display: none;
            }
        }
        
        @media (max-width: 576px) {
            .quick-actions-grid {
                grid-template-columns: 1fr;
            }
            
            .topbar {
                flex-direction: column;
                gap: 20px;
                align-items: flex-start;
            }
            
            .topbar-actions {
                width: 100%;
                justify-content: space-between;
            }
        }
        
        /* Animations */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }
        
        /* Menu Toggle for Mobile */
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
        
        /* ANIMASI KHUSUS UNTUK TOMBOL LOGOUT */
        .logout-btn-sidebar::after {
            content: '';
            position: absolute;
            top: 50%;
            left: -100%;
            width: 100%;
            height: 2px;
            background: rgba(255, 255, 255, 0.5);
            transform: translateY(-50%);
            transition: left 0.5s ease;
        }
        
        .logout-btn-sidebar:hover::after {
            left: 100%;
        }
    </style>
</head>
<body>
    <!-- Menu Toggle for Mobile -->
    <button class="menu-toggle" id="menuToggle">
        <i class="fas fa-bars"></i>
    </button>
    
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <!-- Brand -->
        <div class="sidebar-brand">
            <div class="brand-logo">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="brand-text">
                <h3>PKL System</h3>
                <p>SMK Negeri 1 Kota Cirebon</p>
            </div>
        </div>
        
        <!-- User Info -->
        <div class="user-info">
            <div class="user-avatar">
                <i class="fas fa-user-tie"></i>
            </div>
            <div class="user-details">
                <h5>{{ Auth::guard('guru')->user()->nama ?? 'Administrator' }}</h5>
                <p>{{ Auth::guard('guru')->user()->jabatan ?? 'Guru Pembimbing' }}</p>
                <span class="badge badge-primary mt-2">
                    {{ Auth::guard('guru')->user()->is_admin ? 'Administrator' : 'Guru' }}
                </span>
            </div>
        </div>
        
        <!-- Menu Items - ✅ FIXED: GANTI SISWA & NILAI PKL DENGAN PRAKERIN -->
        <div class="sidebar-menu">
            <div class="menu-items">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    
                    <!-- ✅ MENU DATA PKL (PRAKERIN) -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('prakerin.index') ? 'active' : '' }}" href="{{ route('prakerin.index') }}">
                            <i class="fas fa-file-alt"></i>
                            <span class="nav-text">Data PKL</span>
                        </a>
                    </li>
                    
                    <!-- ✅ MENU TAMBAH PKL -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('prakerin.create') ? 'active' : '' }}" href="{{ route('prakerin.create') }}">
                            <i class="fas fa-plus-circle"></i>
                            <span class="nav-text">Tambah PKL</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('prakerin.cetak.semua') ? 'active' : '' }}" href="{{ route('prakerin.cetak.semua') }}">
                            <i class="fas fa-print"></i>
                            <span class="nav-text">Cetak Semua</span>
                        </a>
                    </li>
                    
                    </li> 
                </ul>
            </div>
            
            <!-- TOMBOL LOGOUT - JELAS DAN PASTI KELIHATAN -->
            <div class="logout-section">
                <button class="logout-btn-sidebar" id="logoutBtn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Keluar dari Sistem</span>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Topbar -->
        <div class="topbar fade-in">
            <div class="page-title">
                <h1>Dashboard</h1>
                <p>Selamat datang di sistem pengelolaan nilai PKL</p>
            </div>
            
            <div class="topbar-actions">
                <div class="user-menu">
                    <button class="user-btn">
                        <div class="user-avatar-sm">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="user-info-sm">
                            <div class="user-name">{{ Auth::guard('guru')->user()->nama ?? 'Administrator' }}</div>
                            <div class="user-role">{{ Auth::guard('guru')->user()->is_admin ? 'Admin' : 'Guru' }}</div>
                        </div>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Welcome Card - ✅ FIXED: GANTI ROUTE SISWA DENGAN PRAKERIN -->
        <div class="welcome-card fade-in" data-aos="fade-up">
            <div class="welcome-content">
                <h2>Selamat Datang, {{ Auth::guard('guru')->user()->nama ?? 'Administrator' }}! 👋</h2>
                <p>Sistem Pengelolaan Nilai Praktik Kerja Lapangan SMK Negeri 1 Kota Cirebon siap membantu Anda mengelola data PKL dengan mudah dan efisien.</p>
                <a href="{{ route('prakerin.index') }}" class="btn btn-light btn-lg px-4">
                    <i class="fas fa-rocket me-2"></i> Mulai Kerja
                </a>
            </div>
            <div class="welcome-illustration">
                <i class="fas fa-chart-line fa-7x" style="opacity: 0.2;"></i>
            </div>
        </div>
        
        <!-- Stats Grid -->
        <div class="stats-grid fade-in" data-aos="fade-up" data-aos-delay="100">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $stats['total_nilai'] ?? 0 }}</h3>
                    <p>Total Data PKL</p>
                </div>
            </div>
            
            <!-- <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $stats['selesai'] ?? 0 }}</h3>
                    <p>Selesai</p>
                </div>
            </div> -->
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ number_format($stats['nilai_rata_rata_semua'] ?? 0, 1) }}</h3>
                    <p>Rata-rata Nilai</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ \App\Models\Prakerin::distinct('nis')->count('nis') }}</h3>
                    <p>Siswa PKL</p>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions - ✅ FIXED: GANTI SEMUA ROUTE SISWA & NILAI PKL -->
        <div class="section-header fade-in" data-aos="fade-up" data-aos-delay="150">
            <h3><i class="fas fa-bolt me-2 text-warning"></i> Aksi Cepat</h3>
        </div>
        
        <div class="quick-actions-grid fade-in" data-aos="fade-up" data-aos-delay="200">
            <a href="{{ route('prakerin.create') }}" class="action-btn">
                <div class="action-icon">
                    <i class="fas fa-plus-circle"></i>
                </div>
                <h5>Input PKL Baru</h5>
                <p>Tambahkan data PKL dan nilai</p>
            </a>
            
            <a href="{{ route('prakerin.index') }}" class="action-btn">
                <div class="action-icon">
                    <i class="fas fa-list"></i>
                </div>
                <h5>Lihat Data PKL</h5>
                <p>Kelola semua data PKL</p>
            </a>
            
            <a href="{{ route('prakerin.cetak.semua') }}" class="action-btn">
                <div class="action-icon">
                    <i class="fas fa-print"></i>
                </div>
                <h5>Cetak Sertifikat</h5>
                <p>Cetak sertifikat PKL</p>
            </a>
            
            <a href="{{ route('sertifikat.cetak', ['nis' => '2021001']) }}" class="action-btn">
                <div class="action-icon">
                    <i class="fas fa-file-pdf"></i>
                </div>
                <h5>Contoh Sertifikat</h5>
                <p>Preview sertifikat PKL</p>
            </a>
        </div>
        
        <!-- Recent Data - ✅ FIXED: MENAMPILKAN 3 DATA TERBARU SAJA -->
        <div class="recent-card fade-in" data-aos="fade-up" data-aos-delay="250">
            <div class="section-header">
                <h3><i class="fas fa-history me-2 text-info"></i> Data PKL Terbaru</h3>
                <a href="{{ route('prakerin.index') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-arrow-right me-1"></i> Lihat Semua
                </a>
            </div>
            
            @if(isset($recentNilai) && $recentNilai->count() > 0)
                <div class="table-container">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>NIS</th>
                                <th>Keahlian</th>
                                <th>Tempat PKL</th>
                                <th>Nilai Rata-rata</th>
                                <th>Status</th>
                                <th>Paket Keahlian</th>
                                <th>Nilai Rata-rata</th>  
                                <th>Huruf</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // Ambil hanya 3 data terbaru
                                $recentData = $recentNilai->take(3);
                            @endphp
                            
                            @foreach($recentData as $index => $prakerin)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                        <div>
                                            <strong>{{ $prakerin->nama }}</strong>
                                            <div class="small text-muted">{{ $prakerin->no_sertifikat }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge badge-info">{{ $prakerin->nis }}</span></td>
                                <td>{{ $prakerin->keahlian }}</td>
                                <td>{{ $prakerin->tempat_pkl }}</td>
                                <td>
                                    @php
                                        $rata = $prakerin->rata_rata ?? 0;
                                        $colorClass = 'badge-success';
                                        if($rata < 70) $colorClass = 'badge-danger';
                                        elseif($rata < 80) $colorClass = 'badge-warning';
                                    @endphp
                                    <span class="badge {{ $colorClass }}">
                                        {{ number_format($rata, 2) }}
                                    </span>
                                </td>
                                <td>
                                    {!! $prakerin->status_label ?? '<span class="badge badge-primary">Aktif</span>' !!}
                                </td>
                            </tr>
                            @endforeach
                            
                            @if($recentNilai->count() > 3)
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="fas fa-ellipsis-h me-2"></i> 
                                     data lainnya...
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-inbox"></i>
                    </div>
                    <h4>Belum ada data PKL</h4>
                    <p>Mulai dengan menginput data PKL pertama</p>
                    <a href="{{ route('prakerin.create') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus me-2"></i> Input Data PKL
                    </a>
                </div>
            @endif
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
    // Initialize AOS
    AOS.init({
        duration: 800,
        once: true,
        offset: 100
    });
    
    // Menu Toggle for Mobile
    document.getElementById('menuToggle').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('active');
    });
    
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        const sidebar = document.getElementById('sidebar');
        const menuToggle = document.getElementById('menuToggle');
        
        if (window.innerWidth <= 992) {
            if (!sidebar.contains(event.target) && !menuToggle.contains(event.target) && sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        }
    });
    
    // Add hover animation to stat cards
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Dynamic greeting based on time
    const hour = new Date().getHours();
    const greeting = hour < 12 ? 'Selamat Pagi' : hour < 15 ? 'Selamat Siang' : hour < 18 ? 'Selamat Sore' : 'Selamat Malam';
    const welcomeTitle = document.querySelector('.welcome-content h2');
    if (welcomeTitle) {
        welcomeTitle.innerHTML = welcomeTitle.innerHTML.replace('Selamat Datang', greeting);
    }
    
    // ========== LOGOUT CONFIRMATION - DIBAIKIN ========== //
    document.getElementById('logoutBtn').addEventListener('click', function() {
        Swal.fire({
            title: '<div style="font-size: 1.8rem; font-weight: 700; color: #f72585; margin-bottom: 10px;"><i class="fas fa-sign-out-alt me-2"></i>Konfirmasi Logout</div>',
            html: `
                <div style="text-align: center; padding: 15px 0;">
                    <div style="width: 80px; height: 80px; margin: 0 auto 20px; background: linear-gradient(135deg, #f72585 0%, #b5179e 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-sign-out-alt" style="font-size: 32px; color: white;"></i>
                    </div>
                    <h3 style="font-size: 1.4rem; font-weight: 600; color: #333; margin-bottom: 10px;">Yakin ingin keluar?</h3>
                    <p style="color: #666; font-size: 1rem; margin-bottom: 5px;">Anda akan keluar dari Sistem PKL</p>
                    <p style="color: #999; font-size: 0.9rem;">Pastikan semua pekerjaan Anda sudah disimpan.</p>
                </div>
                <div style="background: #f8f9fa; padding: 15px; border-radius: 10px; margin-top: 20px; border-left: 4px solid #4361ee;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-user-circle" style="font-size: 20px; color: #4361ee;"></i>
                        <div>
                            <div style="font-weight: 600; color: #333;">{{ Auth::guard('guru')->user()->nama ?? 'Administrator' }}</div>
                            <div style="font-size: 0.85rem; color: #666;">{{ Auth::guard('guru')->user()->is_admin ? 'Administrator' : 'Guru' }}</div>
                        </div>
                    </div>
                </div>
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f72585',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-sign-out-alt me-2"></i>Ya, Keluar Sekarang',
            cancelButtonText: '<i class="fas fa-times me-2"></i>Batalkan',
            reverseButtons: true,
            background: '#fff',
            color: '#212529',
            width: 450,
            padding: '30px',
            borderRadius: '20px',
            customClass: {
                popup: 'logout-confirmation-popup',
                icon: 'logout-confirmation-icon',
                confirmButton: 'logout-confirm-btn',
                cancelButton: 'logout-cancel-btn'
            },
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading animation
                Swal.fire({
                    title: 'Sedang memproses...',
                    html: '<div style="margin: 20px 0;"><div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"></div></div><p style="color: #666;">Tunggu sebentar, Anda sedang keluar dari sistem</p>',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    willOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Buat form logout setelah 1 detik
                setTimeout(() => {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route("logout") }}';
                    
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    
                    form.appendChild(csrfToken);
                    document.body.appendChild(form);
                    form.submit();
                }, 1500);
            }
        });
    });
    
    // Auto-hide any existing Bootstrap alerts
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            if (alert.classList.contains('alert-dismissible')) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        });
    }, 5000);
</script>
    
    <style>
        /* Animasi untuk SweetAlert popup */
        .animated-popup {
            animation: sweetAlertCenter 0.3s ease-out !important;
            border-radius: 20px !important;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3) !important;
            font-family: 'Inter', sans-serif !important;
        }
        
        @keyframes sweetAlertCenter {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        .swal2-icon-success .swal2-icon-content {
            color: #28a745 !important;
            font-size: 3.5rem !important;
        }
        
        .swal2-title {
            font-size: 1.5rem !important;
            font-weight: 700 !important;
            color: #28a745 !important;
            margin-bottom: 5px !important;
        }
        
        .swal2-icon {
            width: 80px !important;
            height: 80px !important;
            margin: 10px auto 15px !important;
            border-width: 4px !important;
        }
        
        /* Progress bar timer */
        .swal2-timer-progress-bar {
            background: #4361ee !important;
            height: 4px !important;
        }
        
        /* Custom styling untuk logout confirmation */
        .logout-confirmation-popup {
            border-radius: 20px !important;
            box-shadow: 0 25px 50px rgba(247, 37, 133, 0.2) !important;
            border: 1px solid rgba(247, 37, 133, 0.1) !important;
        }
        
        .logout-confirmation-icon {
            display: none !important;
        }
        
        .logout-confirm-btn {
            background: linear-gradient(135deg, #f72585 0%, #b5179e 100%) !important;
            border: none !important;
            border-radius: 10px !important;
            padding: 12px 30px !important;
            font-weight: 600 !important;
            font-size: 1rem !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 5px 15px rgba(247, 37, 133, 0.3) !important;
        }
        
        .logout-confirm-btn:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 20px rgba(247, 37, 133, 0.4) !important;
        }
        
        .logout-cancel-btn {
            background: #f8f9fa !important;
            border: 2px solid #dee2e6 !important;
            color: #495057 !important;
            border-radius: 10px !important;
            padding: 12px 30px !important;
            font-weight: 600 !important;
            font-size: 1rem !important;
            transition: all 0.3s ease !important;
        }
        
        .logout-cancel-btn:hover {
            background: #e9ecef !important;
            border-color: #adb5bd !important;
            transform: translateY(-2px) !important;
        }
        
        /* Animasi untuk popup logout */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translate3d(0, -20px, 0);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }
        
        @keyframes fadeOutUp {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
                transform: translate3d(0, -20px, 0);
            }
        }
        
        .animate__animated {
            animation-duration: 0.3s;
            animation-fill-mode: both;
        }
        
        .animate__fadeInDown {
            animation-name: fadeInDown;
        }
        
        .animate__fadeOutUp {
            animation-name: fadeOutUp;
        }
    </style>
</body>
</html>