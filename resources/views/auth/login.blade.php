<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Guru - Sistem PKL SMK Negeri 1 Kota Cirebon</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ffffff 0%, #f5f1fa 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-container {
            width: 100%;
            max-width: 450px;
        }
        
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        
        .login-card:hover {
            transform: translateY(-5px);
        }
        
        .login-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 20px 20px;
            opacity: 0.1;
        }
        
        .school-logo {
            font-size: 3.5rem;
            color: white;
            margin-bottom: 15px;
        }
        
        .school-name {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 5px;
            letter-spacing: 0.5px;
        }
        
        .school-subtitle {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-bottom: 20px;
        }
        
        .system-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-top: 10px;
            letter-spacing: 1px;
        }
        
        .login-body {
            padding: 40px 30px;
        }
        
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            color: var(--dark-color);
            font-weight: 500;
            font-size: 0.95rem;
        }
        
        .input-group {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary-color);
            z-index: 2;
        }
        
        .form-control {
            width: 100%;
            padding: 15px 15px 15px 50px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #f8f9fa;
        }
        
        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
            background-color: white;
        }
        
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #7f8c8d;
            cursor: pointer;
            z-index: 3;
        }
        
        .password-toggle:hover {
            color: var(--secondary-color);
        }
        
        .password-info {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 8px;
            padding: 12px 15px;
            margin-top: 15px;
            border-left: 4px solid var(--secondary-color);
            font-size: 0.85rem;
            color: #666;
        }
        
        .password-info i {
            color: var(--secondary-color);
            margin-right: 8px;
        }
        
        .btn-login {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            padding: 16px;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 0.9rem;
        }
        
        .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .form-check-input {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }
        
        .form-check-label {
            color: #666;
            cursor: pointer;
        }
        
        .forgot-password {
            color: var(--secondary-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .forgot-password:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }
        
        .login-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #7f8c8d;
            font-size: 0.85rem;
        }
        
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 10px;
        }
        
        .footer-links a {
            color: #7f8c8d;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-links a:hover {
            color: var(--secondary-color);
        }
        
        .alert {
            border-radius: 10px;
            border: none;
            padding: 15px;
            margin-bottom: 20px;
            animation: slideIn 0.5s ease;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .copyright {
            margin-top: 15px;
            font-size: 0.8rem;
            color: #95a5a6;
        }
        
        /* Responsive */
        @media (max-width: 576px) {
            .login-container {
                padding: 10px;
            }
            
            .login-header {
                padding: 30px 20px;
            }
            
            .school-name {
                font-size: 1.5rem;
            }
            
            .login-body {
                padding: 30px 20px;
            }
            
            .remember-forgot {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }
        }
        
        /* Animasi */
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }
        
        .school-logo {
            animation: float 3s ease-in-out infinite;
        }
        
        /* Loading effect */
        .btn-loading {
            position: relative;
            pointer-events: none;
        }
        
        .btn-loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Header -->
            <div class="login-header">
                <div class="school-logo">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h1 class="school-name">SMK NEGERI 1 KOTA CIREBON</h1>
                <p class="school-subtitle">Sekolah Menengah Kejuruan Terbaik di Jawa Barat</p>
                <h2 class="system-title">SISTEM PENGELOLAAN NILAI PKL</h2>
            </div>
            
            <!-- Body -->
            <div class="login-body">
                <!-- Alert Messages -->
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf
                    
                    <!-- Email Input -->
                    <div class="form-group">
                        <label class="form-label" for="email">
                            <i class="fas fa-envelope me-1"></i> Email Guru
                        </label>
                        <div class="input-group">
                            <span class="input-icon">
                                <i class="fas fa-user-circle"></i>
                            </span>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   class="form-control" 
                                   placeholder="masukkan email anda"
                                   value="{{ old('email') }}"
                                   required 
                                   autofocus>
                        </div>
                    </div>
                    
                    <!-- Password Input -->
                    <div class="form-group">
                        <label class="form-label" for="password">
                            <i class="fas fa-lock me-1"></i> Password
                        </label>
                        <div class="input-group">
                            <span class="input-icon">
                                <i class="fas fa-key"></i>
                            </span>
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   class="form-control" 
                                   placeholder="masukkan password"
                                   required>
                            <button type="button" class="password-toggle" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        
                        <!-- Password Information -->
                        <div class="password-info">
                            <i class="fas fa-info-circle"></i>
                            <strong>Password Default:</strong> <code>password123</code> (sama untuk semua guru)
                        </div>
                    </div>
                    
                    <!-- Remember Me & Forgot Password -->
                    <div class="remember-forgot">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">
                                Ingat Saya
                            </label>
                        </div>
                        <a href="#" class="forgot-password" id="forgotPassword">
                            <i class="fas fa-question-circle me-1"></i> Lupa Password?
                        </a>
                    </div>
                    
                    <!-- Login Button -->
                    <button type="submit" class="btn-login" id="loginButton">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>MASUK KE SISTEM</span>
                    </button>
                </form>
                
                <!-- Footer -->
                <div class="login-footer">
                    <div class="footer-links">
                        <a href="#"><i class="fas fa-info-circle me-1"></i> Panduan</a>
                        <a href="#"><i class="fas fa-question-circle me-1"></i> Bantuan</a>
                        <a href="#"><i class="fas fa-phone me-1"></i> Kontak</a>
                    </div>
                    
                    <div class="copyright">
                        <p>&copy; {{ date('Y') }} SMK Negeri 1 Kota Cirebon. Hak Cipta Dilindungi.</p>
                        <p class="mt-1">Versi 2.0 | Sistem Pengelolaan Nilai Praktik Kerja Lapangan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle Password Visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
        
        // Form Submission Animation
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const loginButton = document.getElementById('loginButton');
            const buttonText = loginButton.querySelector('span');
            
            // Show loading state
            buttonText.textContent = 'SEDANG MASUK...';
            loginButton.classList.add('btn-loading');
            loginButton.disabled = true;
            
            // Simulate loading for better UX
            setTimeout(() => {
                loginButton.classList.remove('btn-loading');
                buttonText.textContent = 'MASUK KE SISTEM';
                loginButton.disabled = false;
            }, 2000);
        });
        
        // Forgot Password Alert
        document.getElementById('forgotPassword').addEventListener('click', function(e) {
            e.preventDefault();
            alert('Jika lupa password, hubungi Administrator Sistem di:\nEmail: admin@smk1cirebon.sch.id\nTelp: (0231) 123456');
        });
        
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
        
        // Add animation to form inputs on focus
        const formInputs = document.querySelectorAll('.form-control');
        formInputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentElement.classList.remove('focused');
                }
            });
        });
        
        // Demo credentials auto-fill (for development only)
        document.addEventListener('keydown', function(e) {
            // Press Ctrl+D for demo credentials
            if (e.ctrlKey && e.key === 'd') {
                e.preventDefault();
                document.getElementById('email').value = 'admin@pkl.smk1cirebon.sch.id';
                document.getElementById('password').value = 'password123';
                
                // Show notification
                const demoAlert = document.createElement('div');
                demoAlert.className = 'alert alert-info alert-dismissible fade show mt-3';
                demoAlert.innerHTML = `
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Demo credentials loaded!</strong> You can now click login.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                document.querySelector('.login-body').insertBefore(demoAlert, document.querySelector('form'));
                
                // Auto remove after 3 seconds
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(demoAlert);
                    bsAlert.close();
                }, 3000);
            }
        });
        
        // Add floating label effect
        formInputs.forEach(input => {
            const label = input.previousElementSibling;
            if (label && label.classList.contains('form-label')) {
                input.addEventListener('focus', () => {
                    label.style.transform = 'translateY(-5px) scale(0.9)';
                    label.style.color = 'var(--secondary-color)';
                });
                
                input.addEventListener('blur', () => {
                    if (!input.value) {
                        label.style.transform = 'translateY(0) scale(1)';
                        label.style.color = 'var(--dark-color)';
                    }
                });
                
                // Check on page load if input has value
                if (input.value) {
                    label.style.transform = 'translateY(-5px) scale(0.9)';
                    label.style.color = 'var(--secondary-color)';
                }
            }
        });
    </script>
</body>
</html>