<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - HyperCare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary-color: #3B82F6;
            --primary-light: #DBEAFE;
            --secondary-color: #F8FAFC;
            --accent-color: #10B981;
            --text-dark: #1F2937;
            --text-muted: #6B7280;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--primary-light) 0%, white 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .login-container {
            max-width: 400px;
            margin: 0 auto;
        }
        
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .login-header {
            background: var(--primary-color);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        
        .login-body {
            padding: 40px 30px;
        }
        
        .form-control {
            border: 2px solid #E5E7EB;
            border-radius: 12px;
            padding: 15px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.15);
        }
        
        .input-group-text {
            background: white;
            border: 2px solid #E5E7EB;
            border-right: none;
            border-radius: 12px 0 0 12px;
            color: var(--text-muted);
        }
        
        .input-group .form-control {
            border-left: none;
            border-radius: 0 12px 12px 0;
        }
        
        .input-group:focus-within .input-group-text {
            border-color: var(--primary-color);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 15px 30px;
            font-weight: 600;
            border-radius: 12px;
            width: 100%;
            font-size: 1.1rem;
        }
        
        .btn-primary:hover {
            background-color: #2563EB;
            border-color: #2563EB;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }
        
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0;
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .back-home {
            color: var(--text-muted);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: color 0.3s ease;
        }
        
        .back-home:hover {
            color: var(--primary-color);
        }
        
        .alert {
            border-radius: 12px;
            border: none;
        }
        
        .demo-accounts {
            background-color: #F8FAFC;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
        }
        
        .demo-account {
            background: white;
            border: 1px solid #E5E7EB;
            border-radius: 8px;
            padding: 10px 15px;
            margin: 8px 0;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .demo-account:hover {
            border-color: var(--primary-color);
            background-color: var(--primary-light);
        }
    </style>
</head>
<body>
    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ $message }}',
                timer: 5000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
                timerProgressBar: true,
            });
        </script>
    @endif
    
    @if ($message = Session::get('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '{{ $message }}',
                timer: 5000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
                timerProgressBar: true,
            });
        </script>
    @endif
    <div class="container">
        <div class="login-container">
            <div class="login-card">
                <div class="login-header">
                    <i class="fas fa-heartbeat fa-3x mb-3"></i>
                    <h2 class="mb-0">HyperCare</h2>
                </div>
                
                <div class="login-body">
                    <form action="{{ route('login.post') }}" method="POST">
                       @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email atau Username</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" name="email" class="form-control" id="email" placeholder="Masukkan email atau username" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="remember-forgot">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">
                                    Ingat saya
                                </label>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt me-2"></i>Masuk
                        </button>
                    </form>
                    
                    <div class="text-center mt-4">
                        <a href="{{ route('pasien.index')}}" class="back-home">
                            <i class="fas fa-arrow-left"></i>
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- System Info -->
            <div class="text-center mt-4 text-muted">
                <small>
                    <i class="fas fa-shield-alt me-1"></i>
                    Sistem diamankan dengan enkripsi SSL
                </small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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
    </script>
</body>
</html>