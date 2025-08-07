@extends("layouts.default")
@section("content")
<div class="col-md-9 col-lg-10">
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Dashboard Admin</h4>
                <div class="d-flex align-items-center">
                </div>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="p-4">
            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="card stat-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="text-muted mb-0">Total Pasien</h6>
                                <h3 class="mb-0">{{ $pasien }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card stat-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #43e97b, #38f9d7);">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="text-muted mb-0">Total Konsultasi</h6>
                                <h3 class="mb-0">{{ $konsultasi }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card stat-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #fa709a, #fee140);">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="text-muted mb-0">Total Data Penyakit</h6>
                                <h3 class="mb-0">{{ $penyakit }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card stat-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #a8edea, #fed6e3);">
                                <i class="fas fa-user-md"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="text-muted mb-0">Total Data Gejala</h6>
                                <h3 class="mb-0">{{ $gejala }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts and Activity -->
            <div class="row">
                <div class="col-md-8 mb-4">
                    <div class="card chart-card">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0">Grafik Konsultasi Mingguan</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="consultationChart" height="300"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card chart-card">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0">Aktivitas Terbaru</h5>
                        </div>
                        <div class="card-body recent-activity">
                            <div class="activity-item">
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">10 menit lalu</small>
                                </div>
                                <p class="mb-1">Konsultasi baru dari Sari Wulandari</p>
                                <small class="text-muted">Hasil: Preeklampsia Ringan (75%)</small>
                            </div>
                            <div class="activity-item">
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">25 menit lalu</small>
                                </div>
                                <p class="mb-1">Data gejala baru ditambahkan</p>
                                <small class="text-muted">Gejala: Nyeri ulu hati</small>
                            </div>
                            <div class="activity-item">
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">1 jam lalu</small>
                                </div>
                                <p class="mb-1">Konsultasi dari Maya Susanti</p>
                                <small class="text-muted">Hasil: Hipertensi Gestasional (60%)</small>
                            </div>
                            <div class="activity-item">
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">2 jam lalu</small>
                                </div>
                                <p class="mb-1">Petugas baru terdaftar</p>
                                <small class="text-muted">Dr. Lisa Andriani</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Consultations -->
            <div class="row">
                <div class="col-12">
                    <div class="card chart-card">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0">Konsultasi Terbaru</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama Pasien</th>
                                            <th>Usia</th>
                                            <th>Hasil Diagnosa</th>
                                            <th>Persentase</th>
                                            <th>Waktu</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Sari Wulandari</td>
                                            <td>28 tahun</td>
                                            <td>Preeklampsia Ringan</td>
                                            <td><span class="badge bg-warning">75%</span></td>
                                            <td>10 menit lalu</td>
                                            <td><span class="badge bg-success">Selesai</span></td>
                                        </tr>
                                        <tr>
                                            <td>Maya Susanti</td>
                                            <td>32 tahun</td>
                                            <td>Hipertensi Gestasional</td>
                                            <td><span class="badge bg-info">60%</span></td>
                                            <td>1 jam lalu</td>
                                            <td><span class="badge bg-success">Selesai</span></td>
                                        </tr>
                                        <tr>
                                            <td>Rina Putri</td>
                                            <td>25 tahun</td>
                                            <td>Normal</td>
                                            <td><span class="badge bg-success">90%</span></td>
                                            <td>2 jam lalu</td>
                                            <td><span class="badge bg-success">Selesai</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('consultationChart').getContext('2d');
        const consultationChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                datasets: [{
                    label: 'Konsultasi',
                    data: [12, 19, 8, 15, 25, 18, 22],
                    borderColor: '#6FB3E0',
                    backgroundColor: 'rgba(111, 179, 224, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
@endsection