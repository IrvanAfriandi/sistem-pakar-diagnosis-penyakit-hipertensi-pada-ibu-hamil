<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HyperCare</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.svg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
        }
        
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 40px 0;
        }
        
        .form-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .form-header {
            background: var(--primary-color);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .form-body {
            padding: 40px;
        }
        
        .form-control {
            border: 2px solid #E5E7EB;
            border-radius: 10px;
            padding: 12px 16px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.15);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 10px;
        }
        
        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }
        
        .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 10px;
            font-weight: bold;
        }
        
        .step.active {
            background-color: var(--primary-color);
            color: white;
        }
        
        .step.inactive {
            background-color: #E5E7EB;
            color: var(--text-muted);
        }
        
        .step-connector {
            width: 50px;
            height: 2px;
            background-color: #E5E7EB;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <!-- Step Indicator -->
            <div class="step-indicator">
                <div class="step active">1</div>
                <div class="step-connector"></div>
                <div class="step inactive">2</div>
                <div class="step-connector"></div>
                <div class="step inactive">3</div>
            </div>
            
            <div class="form-card">
                <div class="form-header">
                    <i class="fas fa-user-md fa-3x mb-3"></i>
                    <h2 class="mb-0">Form Biodata Pasien</h2>
                    <p class="mb-0 mt-2 opacity-75">Langkah 1 dari 3</p>
                </div>
                
                <div class="form-body">
                    <div class="alert alert-info border-0" style="background-color: var(--primary-light);">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Sebelum lanjut konsultasi,</strong> tolong lengkapi biodata Anda terlebih dahulu untuk proses diagnosis yang lebih akurat.
                    </div>
                    
                    <form action="{{ route('pasien.store') }}" method="POST">
                    @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label fw-semibold">
                                <i class="fas fa-user me-2 text-primary"></i>Nama Lengkap
                            </label>
                            <input name="nama_pasien" type="text" class="form-control" id="nama" placeholder="Masukkan nama lengkap Anda" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="usia" class="form-label fw-semibold">
                                <i class="fas fa-calendar-alt me-2 text-primary"></i>Usia
                            </label>
                            <input name="usia" type="number" class="form-control" id="usia" placeholder="Masukkan usia Anda" min="1" max="100" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">
                                <i class="fas fa-envelope me-2 text-primary"></i>Email
                            </label>
                            <input name="email" type="email" class="form-control" id="email" placeholder="contoh@email.com" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="alamat" class="form-label fw-semibold">
                                <i class="fas fa-map-marker-alt me-2 text-primary"></i>Alamat
                            </label>
                            <textarea name="alamat" class="form-control" id="alamat" rows="3" placeholder="Masukkan alamat lengkap Anda" required></textarea>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-arrow-right me-2"></i>Lanjut ke Diagnosis
                            </button>
                            <a href="{{ route('pasien.index')}}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Progress Info -->
            <div class="text-center mt-4">
                <div class="row text-muted">
                    <div class="col-4">
                        <i class="fas fa-user-check text-primary"></i>
                        <div class="small mt-1">Biodata</div>
                    </div>
                    <div class="col-4">
                        <i class="fas fa-stethoscope"></i>
                        <div class="small mt-1">Diagnosis</div>
                    </div>
                    <div class="col-4">
                        <i class="fas fa-file-medical"></i>
                        <div class="small mt-1">Hasil</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>