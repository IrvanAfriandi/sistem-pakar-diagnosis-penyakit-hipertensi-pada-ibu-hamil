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
        
        .hero-articles {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1E40AF 100%);
            color: white;
            padding: 100px 0 80px;
        }
        
        .article-card {
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border-radius: 15px;
            overflow: hidden;
            height: 100%;
        }
        
        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .article-image {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }
        
        .category-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: var(--primary-color);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .read-time {
            color: var(--text-muted);
            font-size: 0.9rem;
        }
        
        .featured-article {
            background: var(--secondary-color);
            border-radius: 15px;
            overflow: hidden;
        }
        
        .search-section {
            background: var(--secondary-color);
        }
        
        .filter-btn {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            border-radius: 25px;
            padding: 8px 20px;
            margin: 5px;
            transition: all 0.3s ease;
        }
        
        .filter-btn:hover,
        .filter-btn.active {
            background: var(--primary-color);
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
                        <a class="nav-link" href="{{ route('pasien.index')}}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="blog">Artikel</a>
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
    <section class="hero-articles" style="margin-top: 76px;">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-4">Artikel Kesehatan</h1>
            <p class="lead mb-0">Informasi terpercaya seputar kesehatan ibu hamil</p>
        </div>
    </section>

    <!-- Search & Filter -->
    <section class="search-section py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" placeholder="Cari artikel..." id="searchInput">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-lg-end mt-3 mt-lg-0">
                        <button class="filter-btn active" data-category="all">Semua</button>
                        <button class="filter-btn" data-category="hipertensi">Hipertensi</button>
                        <button class="filter-btn" data-category="kehamilan">Kehamilan</button>
                        <button class="filter-btn" data-category="nutrisi">Nutrisi</button>
                        <button class="filter-btn" data-category="tips">Tips</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Article -->
    <section class="py-5">
        <div class="container">
            <h2 class="fw-bold mb-4">Artikel Pilihan</h2>
            <div class="featured-article">
                <div class="row g-0">
                    <div class="col-md-6">
                        <img src="https://images.unsplash.com/photo-1559757175-0eb30cd8c063?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Featured Article" class="img-fluid h-100" style="object-fit: cover;">
                    </div>
                    <div class="col-md-6">
                        <div class="p-5">
                            <span class="badge bg-primary mb-3">Hipertensi</span>
                            <h3 class="fw-bold mb-3">Mencegah Preeklampsia: Panduan Lengkap untuk Ibu Hamil</h3>
                            <p class="text-muted mb-4">
                                Preeklampsia adalah kondisi serius yang dapat terjadi pada ibu hamil. 
                                Pelajari cara mencegah, gejala yang harus diwaspadai, dan langkah-langkah 
                                yang dapat dilakukan untuk menjaga kesehatan ibu dan bayi.
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="read-time">
                                    <i class="fas fa-clock me-1"></i>8 menit baca
                                </span>
                                <button class="btn btn-primary">Baca Selengkapnya</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Articles Grid -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="fw-bold mb-4">Artikel Terbaru</h2>
            <div class="row g-4" id="articlesContainer">
                <!-- Articles will be loaded here -->
            </div>
            
            <!-- Load More Button -->
            <div class="text-center mt-5">
                <button class="btn btn-outline-primary btn-lg" id="loadMoreBtn">
                    <i class="fas fa-plus me-2"></i>Muat Artikel Lainnya
                </button>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-5 bg-primary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h3 class="fw-bold mb-3">Dapatkan Update Artikel Terbaru</h3>
                    <p class="mb-0">Berlangganan newsletter kami untuk mendapatkan tips kesehatan terbaru</p>
                </div>
                <div class="col-lg-6">
                    <div class="row g-2">
                        <div class="col">
                            <input type="email" class="form-control form-control-lg" placeholder="Email Anda">
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-light btn-lg">Berlangganan</button>
                        </div>
                    </div>
                </div>
            </div>
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
                        <li><a href="{{ route('pasien.index')}}" class="text-muted text-decoration-none">Beranda</a></li>
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
    <script>
        // Sample articles data
        const articles = [
            {
                id: 1,
                title: "Gejala Awal Hipertensi dalam Kehamilan yang Harus Diwaspadai",
                excerpt: "Mengenali gejala-gejala awal hipertensi sangat penting untuk mencegah komplikasi yang lebih serius...",
                category: "hipertensi",
                image: "https://images.unsplash.com/photo-1584362917165-526a968579e8?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
                readTime: "5 menit",
                date: "2024-01-15"
            },
            {
                id: 2,
                title: "Nutrisi Terbaik untuk Mencegah Hipertensi Selama Kehamilan",
                excerpt: "Pola makan yang sehat dapat membantu mencegah dan mengendalikan tekanan darah tinggi...",
                category: "nutrisi",
                image: "https://images.unsplash.com/photo-1512621776951-a57141f2eefd?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
                readTime: "7 menit",
                date: "2024-01-14"
            },
            {
                id: 3,
                title: "Olahraga Aman untuk Ibu Hamil dengan Tekanan Darah Tinggi",
                excerpt: "Aktivitas fisik yang tepat dapat membantu mengendalikan tekanan darah selama kehamilan...",
                category: "tips",
                image: "https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
                readTime: "6 menit",
                date: "2024-01-13"
            },
            {
                id: 4,
                title: "Pemantauan Tekanan Darah di Rumah: Panduan Praktis",
                excerpt: "Cara melakukan pemantauan tekanan darah mandiri yang akurat untuk ibu hamil...",
                category: "tips",
                image: "https://images.unsplash.com/photo-1559757148-5c350d0d3c56?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
                readTime: "4 menit",
                date: "2024-01-12"
            },
            {
                id: 5,
                title: "Komplikasi Hipertensi Kehamilan dan Cara Pencegahannya",
                excerpt: "Memahami risiko dan komplikasi yang dapat terjadi akibat hipertensi dalam kehamilan...",
                category: "hipertensi",
                image: "https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
                readTime: "8 menit",
                date: "2024-01-11"
            },
            {
                id: 6,
                title: "Kapan Harus Konsultasi ke Dokter: Tanda Bahaya Kehamilan",
                excerpt: "Mengetahui kapan waktu yang tepat untuk segera mencari bantuan medis...",
                category: "kehamilan",
                image: "https://images.unsplash.com/photo-1516549655169-df83a0774514?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
                readTime: "5 menit",
                date: "2024-01-10"
            }
        ];
        
        let currentCategory = 'all';
        let displayedArticles = 3;
        
        function renderArticles() {
            const container = document.getElementById('articlesContainer');
            const filteredArticles = currentCategory === 'all' 
                ? articles 
                : articles.filter(article => article.category === currentCategory);
            
            const articlesToShow = filteredArticles.slice(0, displayedArticles);
            
            container.innerHTML = articlesToShow.map(article => `
                <div class="col-md-6 col-lg-4">
                    <div class="card article-card">
                        <div class="position-relative">
                            <img src="${article.image}" class="article-image" alt="${article.title}">
                            <div class="category-badge">${getCategoryName(article.category)}</div>
                        </div>
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-3">${article.title}</h5>
                            <p class="card-text text-muted mb-3">${article.excerpt}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="read-time">
                                    <i class="fas fa-clock me-1"></i>${article.readTime}
                                </span>
                                <button class="btn btn-primary btn-sm">Baca Selengkapnya</button>
                            </div>
                            <div class="mt-2">
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    ${new Date(article.date).toLocaleDateString('id-ID')}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            `).join('');
            
            // Update load more button
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            if (displayedArticles >= filteredArticles.length) {
                loadMoreBtn.style.display = 'none';
            } else {
                loadMoreBtn.style.display = 'inline-block';
            }
        }
        
        function getCategoryName(category) {
            const categoryNames = {
                'hipertensi': 'Hipertensi',
                'kehamilan': 'Kehamilan',
                'nutrisi': 'Nutrisi',
                'tips': 'Tips'
            };
            return categoryNames[category] || category;
        }
        
        // Filter functionality
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Update active button
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                // Update current category
                currentCategory = this.dataset.category;
                displayedArticles = 3;
                
                // Re-render articles
                renderArticles();
            });
        });
        
        // Load more functionality
        document.getElementById('loadMoreBtn').addEventListener('click', function() {
            displayedArticles += 3;
            renderArticles();
        });
        
        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const articleCards = document.querySelectorAll('.article-card');
            
            articleCards.forEach(card => {
                const title = card.querySelector('.card-title').textContent.toLowerCase();
                const excerpt = card.querySelector('.card-text').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || excerpt.includes(searchTerm)) {
                    card.closest('.col-md-6').style.display = 'block';
                } else {
                    card.closest('.col-md-6').style.display = 'none';
                }
            });
        });
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            renderArticles();
        });
    </script>
</body>
</html>