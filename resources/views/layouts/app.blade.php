<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem PKL') - SMKN 1 Kota Cirebon</title>
    
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
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fb;
            color: #333;
            overflow-x: hidden;
        }
        
        /* Sidebar Modern - SAMA PERSIS DENGAN DASHBOARD */
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
        
        .badge {
            padding: 8px 15px;
            border-radius: 10px;
            font-weight: 500;
            font-size: 0.85rem;
        }
        
        .badge-primary { background: rgba(67, 97, 238, 0.2); color: #fff; border: 1px solid rgba(255,255,255,0.2); }
        
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
        
        /* Stats Card */
        .stats-card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            height: 100%;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.12);
        }
        
        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: white;
        }
        
        .stats-icon.primary { background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%); }
        .stats-icon.success { background: linear-gradient(135deg, #4cc9f0 0%, #4895ef 100%); }
        .stats-icon.warning { background: linear-gradient(135deg, #f72585 0%, #b5179e 100%); }
        .stats-icon.info { background: linear-gradient(135deg, #7209b7 0%, #560bad 100%); }
        
        .stats-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 5px;
        }
        
        .stats-label {
            color: #6c757d;
            font-size: 0.9rem;
            margin: 0;
        }
        
        /* TOMBOL LOGOUT DI SIDEBAR */
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
        
        /* Table */
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
        
        .custom-table tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.03);
        }
        
        /* Card */
        .card-modern {
            background: white;
            border-radius: 20px;
            border: none;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
        }
        
        .card-modern:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.12);
        }
        
        .card-header-modern {
            background: linear-gradient(90deg, #f8f9fa 0%, #e9ecef 100%);
            border-bottom: 2px solid #dee2e6;
            padding: 20px 25px;
            border-radius: 20px 20px 0 0 !important;
            font-weight: 600;
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
        
        /* Responsive */
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
            
            .topbar {
                flex-direction: column;
                gap: 20px;
                align-items: flex-start;
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
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Menu Toggle for Mobile -->
    <button class="menu-toggle" id="menuToggle">
        <i class="fas fa-bars"></i>
    </button>
    
    <!-- Sidebar - SAMA PERSIS DENGAN DASHBOARD -->
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
        
        <!-- Navigation Menu -->
        <div class="sidebar-menu">
            <div class="menu-items">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('prakerin.index') ? 'active' : '' }}" href="{{ route('prakerin.index') }}">
                            <i class="fas fa-file-alt"></i>
                            <span class="nav-text">Data PKL</span>
                        </a>
                    </li>
                    
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
                </ul>
            </div>
            
            <!-- Logout Button -->
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
                <h1>@yield('page-title', 'Dashboard')</h1>
                <p>@yield('page-description', 'Sistem Pengelolaan Nilai PKL SMK Negeri 1 Kota Cirebon')</p>
            </div>
            
            <div class="d-flex align-items-center gap-3">
                <div class="user-menu">
                    <button class="user-btn">
                        <div class="user-avatar-sm">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="user-info-sm">
                            <div class="user-name">{{ Auth::guard('guru')->user()->nama ?? 'Administrator' }}</div>
                            <div class="user-role">{{ Auth::guard('guru')->user()->is_admin ? 'Administrator' : 'Guru Pembimbing' }}</div>
                        </div>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show bg-success text-white border-0 shadow-lg" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-3 fa-2x"></i>
                    <div>
                        <strong class="fs-6">Berhasil!</strong>
                        <p class="mb-0">{{ session('success') }}</p>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show bg-danger text-white border-0 shadow-lg" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-circle me-3 fa-2x"></i>
                    <div>
                        <strong class="fs-6">Error!</strong>
                        <p class="mb-0">{{ session('error') }}</p>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if(session('warning'))
            <div class="alert alert-warning alert-dismissible fade show bg-warning text-dark border-0 shadow-lg" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle me-3 fa-2x"></i>
                    <div>
                        <strong class="fs-6">Perhatian!</strong>
                        <p class="mb-0">{{ session('warning') }}</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <!-- Content -->
        @yield('content')
        
        <!-- Footer -->
        <footer class="mt-5 pt-4 border-top text-center text-muted">
            <div class="row">
                <div class="col-md-6 text-md-start">
                    <p class="mb-0">&copy; {{ date('Y') }} SMK Negeri 1 Kota Cirebon. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">Sistem Pengelolaan Nilai PKL v1.0</p>
                </div>
            </div>
        </footer>
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
    document.getElementById('menuToggle')?.addEventListener('click', function() {
        document.getElementById('sidebar')?.classList.toggle('active');
    });
    
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        const sidebar = document.getElementById('sidebar');
        const menuToggle = document.getElementById('menuToggle');
        
        if (window.innerWidth <= 992 && sidebar && menuToggle) {
            if (!sidebar.contains(event.target) && !menuToggle.contains(event.target) && sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        }
    });
    
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
    
    // ========== LOGOUT CONFIRMATION ========== //
    document.getElementById('logoutBtn')?.addEventListener('click', function() {
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
            width: 450,
            padding: '30px',
            borderRadius: '20px',
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-secondary'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading
                Swal.fire({
                    title: 'Sedang memproses...',
                    html: '<div class="spinner-border text-primary" style="width: 3rem; height: 3rem;"></div><p class="mt-3">Tunggu sebentar...</p>',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
                
                // Submit logout form
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
    
    // Confirm delete function
    function confirmDelete(event, nama = 'data ini') {
        event.preventDefault();
        const form = event.target.closest('form');
        
        Swal.fire({
            title: 'Konfirmasi Hapus',
            html: `<p class="text-lg">Apakah Anda yakin ingin menghapus <strong>${nama}</strong>?</p><p class="text-sm text-danger">Data yang dihapus tidak dapat dikembalikan!</p>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-trash me-2"></i>Ya, Hapus',
            cancelButtonText: '<i class="fas fa-times me-2"></i>Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
    </script>
    
    @stack('scripts')
</body>
</html>