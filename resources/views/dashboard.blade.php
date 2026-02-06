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
            min-height: 100vh;
            position: fixed;
            width: 280px;
            z-index: 1000;
            box-shadow: 5px 0 30px rgba(0,0,0,0.1);
            transition: var(--transition);
        }
        
        .sidebar-brand {
            padding: 30px 25px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
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
            padding: 25px 0;
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
        
        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 30px;
            transition: var(--transition);
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
        
        .stat-trend {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 10px;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .trend-up { color: #28a745; }
        .trend-down { color: #dc3545; }
        
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

        /* Toast Notification */
        .toast-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
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
                <h5>{{ Auth::user()->name ?? 'Administrator' }}</h5>
                <p>{{ Auth::user()->jabatan ?? 'Guru Pembimbing' }}</p>
                <span class="badge badge-primary mt-2">{{ Auth::user()->is_admin ? 'Administrator' : 'Guru' }}</span>
            </div>
        </div>
        
        <!-- Menu -->
        <div class="sidebar-menu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('dashboard') }}">
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
                    <a class="nav-link" href="{{ route('nilai-pkl.index') }}">
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
                <li class="nav-item mt-4">
                    <form method="POST" action="{{ route('logout') }}" class="w-100">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link w-100 text-start" style="color: rgba(255,255,255,0.7); border: none; background: none;">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="nav-text">Keluar</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Flash Messages -->
        @if(session('success') || session('error'))
        <div class="toast-notification">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
        </div>
        @endif
        
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
                            <div class="user-name">{{ Auth::user()->name ?? 'Administrator' }}</div>
                            <div class="user-role">{{ Auth::user()->is_admin ? 'Admin' : 'Guru' }}</div>
                        </div>
                        <i class="fas fa-chevron-down ms-2"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Welcome Card -->
        <div class="welcome-card fade-in" data-aos="fade-up">
            <div class="welcome-content">
                <h2>Selamat Datang, {{ Auth::user()->name ?? 'Administrator' }}! 👋</h2>
                <p>Sistem Pengelolaan Nilai Praktik Kerja Lapangan SMK Negeri 1 Kota Cirebon siap membantu Anda mengelola data siswa dan nilai PKL dengan mudah dan efisien.</p>
                <a href="{{ route('siswa.index') }}" class="btn btn-light btn-lg px-4">
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
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $stats['total_siswa'] ?? 0 }}</h3>
                    <p>Total Siswa PKL</p>
                    <div class="stat-trend trend-up">
                        <i class="fas fa-arrow-up"></i>
                        <span>12% dari bulan lalu</span>
                    </div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $stats['total_nilai'] ?? 0 }}</h3>
                    <p>Nilai PKL Tercatat</p>
                    <div class="stat-trend trend-up">
                        <i class="fas fa-arrow-up"></i>
                        <span>8% dari bulan lalu</span>
                    </div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $stats['nilai_terverifikasi'] ?? 0 }}</h3>
                    <p>Nilai Terverifikasi</p>
                    <div class="stat-trend {{ ($stats['nilai_terverifikasi'] ?? 0) > 0 ? 'trend-up' : '' }}">
                        @if(($stats['nilai_terverifikasi'] ?? 0) > 0)
                            <i class="fas fa-arrow-up"></i>
                            <span>{{ round((($stats['nilai_terverifikasi'] ?? 0) / max(($stats['total_nilai'] ?? 1), 1)) * 100) }}% dari total</span>
                        @else
                            <span>Belum ada verifikasi</span>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ number_format($stats['nilai_rata_rata_semua'] ?? 0, 1) }}</h3>
                    <p>Rata-rata Nilai</p>
                    <div class="stat-trend {{ ($stats['nilai_rata_rata_semua'] ?? 0) >= 75 ? 'trend-up' : 'trend-down' }}">
                        @if(($stats['nilai_rata_rata_semua'] ?? 0) >= 75)
                            <i class="fas fa-arrow-up"></i>
                            <span>Nilai bagus</span>
                        @else
                            <i class="fas fa-arrow-down"></i>
                            <span>Perlu perhatian</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="section-header fade-in" data-aos="fade-up" data-aos-delay="150">
            <h3><i class="fas fa-bolt me-2 text-warning"></i> Aksi Cepat</h3>
            <a href="{{ route('nilai-pkl.index') }}" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-eye me-1"></i> Lihat Semua
            </a>
        </div>
        
        <div class="quick-actions-grid fade-in" data-aos="fade-up" data-aos-delay="200">
            <a href="{{ route('siswa.create') }}" class="action-btn text-decoration-none">
                <div class="action-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h5>Tambah Siswa</h5>
                <p>Tambahkan data siswa baru untuk PKL</p>
            </a>
            
            <a href="{{ route('nilai-pkl.create') }}" class="action-btn text-decoration-none">
                <div class="action-icon">
                    <i class="fas fa-plus-circle"></i>
                </div>
                <h5>Input Nilai PKL</h5>
                <p>Input nilai praktik kerja lapangan</p>
            </a>
            
            <a href="{{ route('nilai-pkl.index') }}" class="action-btn text-decoration-none">
                <div class="action-icon">
                    <i class="fas fa-list"></i>
                </div>
                <h5>Lihat Nilai</h5>
                <p>Kelola semua nilai PKL yang ada</p>
            </a>
            
            <a href="{{ route('siswa.index') }}" class="action-btn text-decoration-none">
                <div class="action-icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <h5>Data Siswa</h5>
                <p>Lihat dan kelola data siswa</p>
            </a>
        </div>
        
        <!-- Recent Data -->
        <div class="recent-card fade-in" data-aos="fade-up" data-aos-delay="250">
            <div class="section-header">
                <h3><i class="fas fa-history me-2 text-info"></i> Nilai PKL Terbaru</h3>
                <a href="{{ route('nilai-pkl.index') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-arrow-right me-1"></i> Lihat Semua
                </a>
            </div>
            
            @if(isset($recentNilai) && $recentNilai->count() > 0)
                <div class="table-container">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Siswa</th>
                                <th>NIS</th>
                                <th>Paket Keahlian</th>
                                <th>Nilai Rata-rata</th>
                                <th>Huruf</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentNilai as $index => $nilai)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                        <div>
                                            <strong>{{ $nilai->siswa->nama ?? 'N/A' }}</strong>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge badge-info">{{ $nilai->siswa->nis ?? 'N/A' }}</span></td>
                                <td>{{ $nilai->siswa->paket_keahlian ?? 'N/A' }}</td>
                                <td>
                                    @php
                                        $colorClass = 'badge-success';
                                        if(($nilai->nilai_rata_rata ?? $nilai->rata_rata) < 70) $colorClass = 'badge-danger';
                                        elseif(($nilai->nilai_rata_rata ?? $nilai->rata_rata) < 80) $colorClass = 'badge-warning';
                                    @endphp
                                    <span class="badge {{ $colorClass }}">
                                        {{ number_format($nilai->nilai_rata_rata ?? $nilai->rata_rata, 2) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-primary">
                                        <strong>{{ $nilai->nilai_huruf ?? $nilai->huruf_rata_rata }}</strong>
                                    </span>
                                </td>
                                <td>
                                    @if($nilai->is_verified ?? false)
                                        <span class="badge badge-success">
                                            <i class="fas fa-check-circle me-1"></i> Terverifikasi
                                        </span>
                                    @else
                                        <span class="badge badge-warning">
                                            <i class="fas fa-clock me-1"></i> Belum
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $nilai->created_at->format('d M Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-inbox"></i>
                    </div>
                    <h4>Belum ada data nilai PKL</h4>
                    <p>Mulai dengan menginput nilai PKL pertama untuk siswa</p>
                    <a href="{{ route('nilai-pkl.create') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus me-2"></i> Input Nilai Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
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
        
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                if (alert.classList.contains('alert-dismissible')) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            });
        }, 5000);
        
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
        
        // Real-time clock
        function updateClock() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            const dateStr = now.toLocaleDateString('id-ID', options);
            const clockElement = document.querySelector('.page-title p');
            if (clockElement && document.querySelector('.clock-time')) {
                document.querySelector('.clock-time').textContent = dateStr;
            }
        }
        
        // Create clock element if not exists
        if (!document.querySelector('.clock-time')) {
            const pageTitle = document.querySelector('.page-title p');
            if (pageTitle) {
                pageTitle.innerHTML += '<br><small class="clock-time text-muted"></small>';
                updateClock();
                setInterval(updateClock, 1000);
            }
        }
        
        // Success message animation (if any success message in session)
        @if(session('success'))
            const successAlert = document.createElement('div');
            successAlert.className = 'alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-4';
            successAlert.style.zIndex = '9999';
            successAlert.innerHTML = `
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.body.appendChild(successAlert);
            
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(successAlert);
                bsAlert.close();
            }, 4000);
        @endif
    </script>
</body>
</html>