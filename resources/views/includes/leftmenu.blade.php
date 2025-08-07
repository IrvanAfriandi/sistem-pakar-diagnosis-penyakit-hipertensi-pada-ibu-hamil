<div class="col-md-3 col-lg-2 px-0">
    <div class="sidebar">
        <div class="p-3 text-white">
            <h5 class="mb-0"><i class="fas fa-heartbeat me-2"></i>Sistem Pakar</h5>
            <small class="opacity-75">Hipertensi Ibu Hamil</small>
        </div>
        <nav class="nav flex-column px-3">
            <a class="nav-link {{ Route::currentRouteName() == 'admin_dashboard' ? 'active' : '' }}" href="{{ route('admin_dashboard') }}">
                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
            </a>

            @if(auth()->user()->role == 'admin')
                <a class="nav-link {{ Route::currentRouteName() == 'data-pasien.index' ? 'active' : '' }}" href="{{ route('data-pasien.index') }}">
                    <i class="fas fa-users me-2"></i>Data Pasien
                </a>
                <a class="nav-link {{ Route::currentRouteName() == 'admin.index' ? 'active' : '' }}" href="{{ route('admin.index') }}">
                    <i class="fas fa-user-shield me-2"></i>Data Admin
                </a>
            @endif

            <a class="nav-link {{ Route::currentRouteName() == 'penyakit.index' ? 'active' : '' }}" href="{{ route('penyakit.index') }}">
                <i class="fas fa-disease me-2"></i>Data Penyakit
            </a>
            <a class="nav-link {{ Route::currentRouteName() == 'gejala.index' ? 'active' : '' }}" href="{{ route('gejala.index') }}">
                <i class="fas fa-stethoscope me-2"></i>Data Gejala
            </a>
            <a class="nav-link {{ Route::currentRouteName() == 'basis-pengetahuan.index' ? 'active' : '' }}" href="{{ route('basis-pengetahuan.index') }}">
                <i class="fas fa-brain me-2"></i>Basis Pengetahuan
            </a>

            @if(auth()->user()->role == 'admin')
                <a class="nav-link {{ Route::currentRouteName() == 'riwayat-konsultasi.index' ? 'active' : '' }}" href="{{ route('riwayat-konsultasi.index') }}">
                    <i class="fas fa-history me-2"></i>Riwayat Konsultasi
                </a>
            @endif

            <hr class="text-white-50">

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt me-2"></i>Logout
            </a>
        </nav>

    </div>
</div>