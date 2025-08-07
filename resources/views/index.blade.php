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
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 12px 24px;
            font-weight: 600;
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 8px 20px;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-light) 0%, white 100%);
            padding: 80px 0;
        }
        
        .feature-card {
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
        }
        
        .testimonial-card {
            background: var(--secondary-color);
            border-left: 4px solid var(--primary-color);
        }
        
        .footer {
            background-color: var(--text-dark);
            color: white;
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
                        <a class="nav-link active" href="{{ route('pasien.index')}}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="blog">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pasien.create')}}">Konsultasi</a>
                    </li>
                </ul>
                <a href="{{ route('login')}}" class="btn btn-outline-primary">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="beranda" style="margin-top: 76px;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">
                        Deteksi Dini Hipertensi <span class="text-primary">Ibu Hamil</span>
                    </h1>
                    <p class="lead mb-4 text-muted">
                        Sistem pakar berbasis web untuk diagnosis hipertensi pada ibu hamil dengan teknologi Certainty Factor. Konsultasi mudah, cepat, dan akurat.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('pasien.create')}}" class="btn btn-primary btn-lg">
                            <i class="fas fa-stethoscope me-2"></i>
                            Mulai Konsultasi Sekarang
                        </a>
                        <a href="tentang" class="btn btn-outline-primary btn-lg">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('hero-consultation.jpg')}}" 
                         alt="Konsultasi Ibu Hamil" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Informasi Penting -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-4">Mengapa Penting Mendeteksi Hipertensi Sejak Dini?</h2>
                    <p class="lead text-muted mb-5">
                        Hipertensi pada ibu hamil dapat menyebabkan komplikasi serius seperti preeklampsia dan eklampsia. 
                        Deteksi dini membantu penanganan yang tepat untuk keselamatan ibu dan bayi.
                    </p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card feature-card h-100 text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-search fa-3x text-primary"></i>
                        </div>
                        <h5 class="fw-bold">Diagnosis Akurat</h5>
                        <p class="text-muted">Menggunakan metode Certainty Factor untuk hasil diagnosis yang akurat dan terpercaya</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card h-100 text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-clock fa-3x text-primary"></i>
                        </div>
                        <h5 class="fw-bold">Konsultasi Cepat</h5>
                        <p class="text-muted">Proses konsultasi online yang mudah dan dapat diakses kapan saja, dimana saja</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card h-100 text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-shield-alt fa-3x text-primary"></i>
                        </div>
                        <h5 class="fw-bold">Data Aman</h5>
                        <p class="text-muted">Keamanan dan privasi data kesehatan Anda terjamin dengan standar keamanan tinggi</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-4">Testimoni Pasien</h2>
                    <p class="lead text-muted">Apa kata ibu-ibu yang sudah menggunakan layanan kami</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card testimonial-card p-4">
                        <div class="mb-3">
                            <div class="d-flex text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <p class="mb-3">"Sistem ini sangat membantu saya mengetahui kondisi kesehatan selama kehamilan. Diagnosis yang diberikan akurat dan mudah dipahami."</p>
                        <div class="d-flex align-items-center">
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" 
                                 alt="Sari" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                            <div>
                                <h6 class="mb-0">Sari Wulandari</h6>
                                <small class="text-muted">Ibu Hamil 28 tahun</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card testimonial-card p-4">
                        <div class="mb-3">
                            <div class="d-flex text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <p class="mb-3">"Sebagai bidan, sistem ini membantu saya dalam memberikan konsultasi awal kepada pasien. Interface-nya mudah digunakan."</p>
                        <div class="d-flex align-items-center">
                            <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" 
                                 alt="Anna" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                            <div>
                                <h6 class="mb-0">Bidan Anna</h6>
                                <small class="text-muted">Tenaga Medis</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card testimonial-card p-4">
                        <div class="mb-3">
                            <div class="d-flex text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <p class="mb-3">"Alhamdulillah dengan sistem ini saya bisa mengetahui kondisi hipertensi saya lebih dini. Terima kasih tim pengembang!"</p>
                        <div class="d-flex align-items-center">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" 
                                 alt="Maya" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                            <div>
                                <h6 class="mb-0">Maya Susanti</h6>
                                <small class="text-muted">Ibu Hamil 32 tahun</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Siap Memulai Konsultasi?</h2>
            <p class="lead mb-4">Dapatkan diagnosis hipertensi yang akurat dalam hitungan menit</p>
            <a href="{{ route('pasien.create')}}" class="btn btn-light btn-lg">
                <i class="fas fa-stethoscope me-2"></i>
                Mulai Konsultasi Sekarang
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-heartbeat me-2"></i>
                        HyperCare
                    </h5>
                    <p class="text-muted">Sistem pakar diagnosis hipertensi ibu hamil berbasis web untuk deteksi dini dan penanganan yang tepat.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter fa-lg"></i></a>
                    </div>
                </div>
                <div class="col-lg-2">
                    <h6 class="fw-bold mb-3">Menu</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-muted text-decoration-none">Beranda</a></li>
                        <li><a href="about.html" class="text-muted text-decoration-none">Tentang</a></li>
                        <li><a href="articles.html" class="text-muted text-decoration-none">Artikel</a></li>
                        <li><a href="biodata-form.html" class="text-muted text-decoration-none">Konsultasi</a></li>
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