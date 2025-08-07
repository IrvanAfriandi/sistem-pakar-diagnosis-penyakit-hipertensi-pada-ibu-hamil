<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HyperCare</title>
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
            color: var(--text-dark);
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important;
        }
        
        .hero-about {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1E40AF 100%);
            color: white;
            padding: 100px 0 80px;
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            background: var(--primary-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        
        .team-card {
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            border-radius: 15px;
            overflow: hidden;
        }
        
        .team-card:hover {
            transform: translateY(-5px);
        }
        
        .stats-section {
            background: var(--secondary-color);
        }
        
        .stat-card {
            text-align: center;
            padding: 30px;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: bold;
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('pasien.index')}}">
                <i class="fas fa-heartbeat me-2"></i>
                HyperCare
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pasien.index')}}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="blog">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pasien.create')}}">Konsultasi</a>
                    </li>
                </ul>
                <a href="login.html" class="btn btn-outline-primary">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-about" style="margin-top: 76px;">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-4">Tentang HyperCare</h1>
            <p class="lead mb-0">Sistem Pakar Diagnosis Hipertensi pada Ibu Hamil</p>
        </div>
    </section>

    <!-- About Content -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4">Apa itu HyperCare?</h2>
                    <p class="lead text-muted mb-4">
                        HyperCare adalah sistem pakar berbasis web yang dikembangkan khusus untuk membantu 
                        diagnosis dini hipertensi pada ibu hamil menggunakan metode Certainty Factor.
                    </p>
                    <p class="mb-4">
                        Sistem ini dirancang untuk memberikan kemudahan akses konsultasi kesehatan bagi ibu hamil, 
                        terutama di daerah dengan keterbatasan tenaga medis spesialis. Melalui serangkaian pertanyaan 
                        tentang gejala-gejala yang dialami, sistem dapat memberikan indikasi awal kondisi hipertensi 
                        dengan tingkat akurasi yang dapat diandalkan.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('pasien.create')}}" class="btn btn-primary">
                            <i class="fas fa-stethoscope me-2"></i>Coba Sekarang
                        </a>
                        <a href="blog" class="btn btn-outline-primary">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1559757148-5c350d0d3c56?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                         alt="Medical Technology" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-4">Mengapa Memilih HyperCare?</h2>
                <p class="lead text-muted">Keunggulan sistem pakar kami</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="feature-icon">
                            <i class="fas fa-brain fa-2x text-primary"></i>
                        </div>
                        <h5 class="fw-bold">Teknologi AI</h5>
                        <p class="text-muted">Menggunakan metode Certainty Factor untuk diagnosis yang akurat berdasarkan pengetahuan medis terkini</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="feature-icon">
                            <i class="fas fa-clock fa-2x text-primary"></i>
                        </div>
                        <h5 class="fw-bold">Diagnosis Cepat</h5>
                        <p class="text-muted">Hasil diagnosis dalam hitungan menit tanpa perlu menunggu antrian di fasilitas kesehatan</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt fa-2x text-primary"></i>
                        </div>
                        <h5 class="fw-bold">Akses Mudah</h5>
                        <p class="text-muted">Dapat diakses kapan saja dan dimana saja melalui perangkat mobile atau desktop</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics -->
    <section class="stats-section py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">94%</div>
                        <h6 class="fw-semibold">Akurasi Diagnosis</h6>
                        <p class="text-muted mb-0">Tingkat akurasi berdasarkan validasi medis</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">1000+</div>
                        <h6 class="fw-semibold">Pasien Terlayani</h6>
                        <p class="text-muted mb-0">Ibu hamil yang telah menggunakan sistem</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">24/7</div>
                        <h6 class="fw-semibold">Layanan Online</h6>
                        <p class="text-muted mb-0">Akses konsultasi tanpa batas waktu</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">5</div>
                        <h6 class="fw-semibold">Jenis Diagnosis</h6>
                        <p class="text-muted mb-0">Kategori hipertensi yang dapat dideteksi</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-4">Tim Pengembang</h2>
                <p class="lead text-muted">Profesional berpengalaman di bidang kesehatan dan teknologi</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card team-card">
                        <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                             class="card-img-top" alt="Dr. Sari Wulandari" style="height: 300px; object-fit: cover;">
                        <div class="card-body text-center p-4">
                            <h5 class="fw-bold">Dr. Sari Wulandari</h5>
                            <p class="text-primary mb-2">Ahli Kandungan</p>
                            <p class="text-muted small">Spesialis kandungan dengan pengalaman 15 tahun dalam menangani hipertensi kehamilan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card team-card">
                        <img src="https://images.unsplash.com/photo-1582750433449-648ed127bb54?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                             class="card-img-top" alt="Ahmad Susanto" style="height: 300px; object-fit: cover;">
                        <div class="card-body text-center p-4">
                            <h5 class="fw-bold">Ahmad Susanto, S.Kom</h5>
                            <p class="text-primary mb-2">Software Engineer</p>
                            <p class="text-muted small">Pengembang sistem dengan spesialisasi artificial intelligence dan machine learning</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card team-card">
                        <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                             class="card-img-top" alt="Bidan Anna" style="height: 300px; object-fit: cover;">
                        <div class="card-body text-center p-4">
                            <h5 class="fw-bold">Anna Wijaya, S.ST</h5>
                            <p class="text-primary mb-2">Bidan Senior</p>
                            <p class="text-muted small">Bidan berpengalaman yang membantu validasi gejala dan protokol diagnosis</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Puskesmas Info -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1516549655169-df83a0774514?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                         alt="Puskesmas Pangkalan" class="img-fluid rounded shadow">
                </div>
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4">Puskesmas Pangkalan</h2>
                    <p class="lead text-muted mb-4">
                        Studi Kasus Implementasi Sistem Pakar
                    </p>
                    <p class="mb-4">
                        HyperCare dikembangkan berdasarkan studi kasus di Puskesmas Pangkalan, dimana terdapat 
                        kebutuhan untuk meningkatkan deteksi dini hipertensi pada ibu hamil. Sistem ini membantu 
                        tenaga medis dalam memberikan pelayanan yang lebih efektif dan efisien.
                    </p>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-map-marker-alt text-primary me-3"></i>
                                <div>
                                    <strong>Lokasi</strong><br>
                                    <small class="text-muted">Kecamatan Plered, Kabupaten Cirebon, Indonesia</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-users text-primary me-3"></i>
                                <div>
                                    <strong>Pasien</strong><br>
                                    <small class="text-muted">500+ ibu hamil per tahun</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="fw-bold mb-4">Misi Kami</h2>
                    <p class="lead text-muted mb-4">
                        Meningkatkan kualitas pelayanan kesehatan ibu hamil melalui teknologi sistem pakar 
                        yang dapat diakses oleh semua kalangan, sehingga deteksi dini hipertensi kehamilan 
                        dapat dilakukan secara optimal dan mengurangi risiko komplikasi.
                    </p>
                    <div class="row g-4 mt-4">
                        <div class="col-md-4">
                            <i class="fas fa-target fa-3x text-primary mb-3"></i>
                            <h6 class="fw-semibold">Akurat</h6>
                            <p class="text-muted small">Diagnosis yang dapat diandalkan</p>
                        </div>
                        <div class="col-md-4">
                            <i class="fas fa-heart fa-3x text-primary mb-3"></i>
                            <h6 class="fw-semibold">Peduli</h6>
                            <p class="text-muted small">Mengutamakan keselamatan ibu dan bayi</p>
                        </div>
                        <div class="col-md-4">
                            <i class="fas fa-hands-helping fa-3x text-primary mb-3"></i>
                            <h6 class="fw-semibold">Terjangkau</h6>
                            <p class="text-muted small">Layanan gratis untuk semua</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Mulai Konsultasi Sekarang</h2>
            <p class="lead mb-4">Deteksi dini hipertensi untuk kehamilan yang lebih sehat</p>
            <a href="{{ route('pasien.create')}}" class="btn btn-light btn-lg">
                <i class="fas fa-stethoscope me-2"></i>
                Mulai Konsultasi
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-heartbeat me-2"></i>
                        HyperCare
                    </h5>
                    <p class="text-muted">Sistem pakar diagnosis hipertensi ibu hamil berbasis web untuk deteksi dini dan penanganan yang tepat.</p>
                </div>
                <div class="col-lg-2">
                    <h6 class="fw-bold mb-3">Menu</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('pasien.index')}}.html" class="text-muted text-decoration-none">Beranda</a></li>
                        <li><a href="tentang" class="text-muted text-decoration-none">Tentang</a></li>
                        <li><a href="blog" class="text-muted text-decoration-none">Artikel</a></li>
                        <li><a href="{{ route('pasien.create')}}" class="text-muted text-decoration-none">Konsultasi</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h6 class="fw-bold mb-3">Kontak</h6>
                    <ul class="list-unstyled text-muted">
                        <li><i class="fas fa-map-marker-alt me-2"></i>Puskesmas Pangkalan</li>
                        <li><i class="fas fa-phone me-2"></i>+62 123 456 789</li>
                        <li><i class="fas fa-envelope me-2"></i>info@hypercare.id</li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h6 class="fw-bold mb-3">Jam Operasional</h6>
                    <ul class="list-unstyled text-muted">
                        <li>Senin - Jumat: 08:00 - 16:00</li>
                        <li>Sabtu: 08:00 - 12:00</li>
                        <li>Minggu: Tutup</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center text-muted">
                <p>&copy; 2024 HyperCare. Dikembangkan untuk Puskesmas Pangkalan.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>