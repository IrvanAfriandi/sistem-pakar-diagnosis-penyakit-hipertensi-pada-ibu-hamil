@extends("layouts.default")
@section("content")
        <!-- Main Content -->
        <div class="col-md-9 col-lg-10">
            <div class="main-content">
                <!-- Header -->
                <div class="header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Data Pasien</h4>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPatientModal">
                            <i class="fas fa-plus me-2"></i>Tambah Pasien
                        </button>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-4">
                    <div class="card content-card">
                        <div class="card-body">
                            
                            <!-- Search and Filter -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fas fa-search text-muted"></i>
                                        </span>
                                        <input type="text" class="form-control border-start-0 search-box" id="searchPatient" placeholder="Cari nama pasien atau email...">
                                    </div>
                                </div>
                                <div class="col-md-6 text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <button class="btn btn-outline-secondary" id="resetSearch">
                                            <i class="fas fa-refresh me-2"></i>Reset
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Patient Table -->
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Lengkap</th>
                                            <th>Usia</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($pasien as $pasien)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <strong>{{ $pasien->nama_pasien }}</strong>
                                                </div>
                                            </td>
                                            <td>{{ $pasien->usia }} tahun</td>
                                            <td>{{ $pasien->email }}</td>
                                            <td>{{ $pasien->alamat }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary me-2 edit-btn"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editPatientModal"
                                                    data-id="{{ $pasien->id_pasien }}"
                                                    data-nama="{{ $pasien->nama_pasien }}"
                                                    data-usia="{{ $pasien->usia }}"
                                                    data-email="{{ $pasien->email }}"
                                                    data-alamat="{{ $pasien->alamat }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form action="{{ route('data-pasien.destroy', $pasien->id_pasien) }}" method="POST" style="display:inline;" id="deleteForm-{{ $pasien->id_pasien }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('{{ $pasien->id_pasien }}', '{{ $pasien->nama_pasien }}')"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
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

<!-- Modal Tambah Pasien -->
<div class="modal fade" id="addPatientModal" tabindex="-1" aria-labelledby="addPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('data-pasien.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addPatientModalLabel">Tambah Pasien Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_pasien" class="form-control" id="nama" value="{{ old('nama') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="usia" class="form-label">Usia</label>
                        <input type="number" name="usia" class="form-control" id="usia" value="{{ old('usia') }}" min="0" max="150" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Pasien -->
<div class="modal fade" id="editPatientModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Pasien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editNama" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_pasien" class="form-control" id="editNama" required>
                    </div>
                    <div class="mb-3">
                        <label for="editUsia" class="form-label">Usia</label>
                        <input type="number" name="usia" class="form-control" id="editUsia" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="editEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="editAlamat" class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" id="editAlamat" rows="3" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<!-- JS untuk tambah data -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#addPatientModal form');
    const submitBtn = form.querySelector('button[type="submit"]');
    const spinner = submitBtn.querySelector('.spinner-border');
    
    form.addEventListener('submit', function(e) {
        submitBtn.disabled = true;
        spinner.classList.remove('d-none');
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status"></span> Menyimpan...';
    });
    
    const modal = document.getElementById('addPatientModal');
    modal.addEventListener('hidden.bs.modal', function() {
        form.reset();
        submitBtn.disabled = false;
        spinner.classList.add('d-none');
        submitBtn.innerHTML = 'Simpan';

        const errorMessages = form.querySelectorAll('.text-danger');
        errorMessages.forEach(error => error.remove());
        
        const inputs = form.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.classList.remove('is-invalid', 'is-valid');
        });
    });
});
</script>

<!-- JS untuk edit data -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-btn');
        const form = document.getElementById('editForm');

        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const nama = button.getAttribute('data-nama');
                const usia = button.getAttribute('data-usia');
                const email = button.getAttribute('data-email');
                const alamat = button.getAttribute('data-alamat');

                document.getElementById('editNama').value = nama;
                document.getElementById('editUsia').value = usia;
                document.getElementById('editEmail').value = email;
                document.getElementById('editAlamat').value = alamat;
                form.action = `/data-pasien/${id}`;
            });
        });
    });
</script>

<!-- JS untuk search -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchBox = document.getElementById('searchPatient');
    const resetBtn = document.getElementById('resetSearch');
    const tableRows = document.querySelectorAll('tbody tr');
    const totalDataSpan = document.getElementById('totalData');
    const totalVisibleSpan = document.getElementById('totalVisible');
    const totalData = tableRows.length;
    totalDataSpan.textContent = totalData;
    totalVisibleSpan.textContent = totalData;
    function performSearch() {
        const searchTerm = searchBox.value.toLowerCase().trim();
        let visibleCount = 0;
        tableRows.forEach(row => {
            if (row.cells.length === 0) return;
            const nama = row.cells[1] ? row.cells[1].textContent.toLowerCase() : '';
            const email = row.cells[2] ? row.cells[2].textContent.toLowerCase() : '';
            const telepon = row.cells[3] ? row.cells[3].textContent.toLowerCase() : '';
            const alamat = row.cells[4] ? row.cells[4].textContent.toLowerCase() : '';
            const matchesSearch = nama.includes(searchTerm) || 
                                email.includes(searchTerm) || 
                                telepon.includes(searchTerm) || 
                                alamat.includes(searchTerm);
            
            if (matchesSearch || searchTerm === '') {
                row.style.display = '';
                visibleCount++;
                if (searchTerm !== '') {
                    row.style.backgroundColor = '#fff3cd';
                    setTimeout(() => {
                        row.style.backgroundColor = '';
                    }, 2000);
                }
            } else {
                row.style.display = 'none';
            }
        });
        totalVisibleSpan.textContent = visibleCount;
        showNoResultsMessage(visibleCount === 0 && searchTerm !== '');
    }
    function showNoResultsMessage(show) {
        let noResultsRow = document.getElementById('noResultsRow');
        if (show) {
            if (!noResultsRow) {
                const tbody = document.querySelector('tbody');
                const colSpan = document.querySelector('thead tr').cells.length;
                
                noResultsRow = document.createElement('tr');
                noResultsRow.id = 'noResultsRow';
                noResultsRow.innerHTML = `
                    <td colspan="${colSpan}" class="text-center py-4 text-muted">
                        <i class="fas fa-search fa-2x mb-2"></i>
                        <br>
                        Tidak ada data pasien yang sesuai dengan pencarian "${searchBox.value}"
                        <br>
                        <small>Coba gunakan kata kunci yang berbeda</small>
                    </td>
                `;
                tbody.appendChild(noResultsRow);
            }
        } else {
            if (noResultsRow) {
                noResultsRow.remove();
            }
        }
    }
    function resetSearch() {
        searchBox.value = '';
        performSearch();
        tableRows.forEach(row => {
            row.style.backgroundColor = '';
        });
        searchBox.focus();
    }
    searchBox.addEventListener('input', function() {
        clearTimeout(this.searchTimeout);
        this.searchTimeout = setTimeout(performSearch, 300);
    });
    searchBox.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            clearTimeout(this.searchTimeout);
            performSearch();
        }
    });
    resetBtn.addEventListener('click', resetSearch);
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
            e.preventDefault();
            searchBox.focus();
        }
        if (e.key === 'Escape' && searchBox.value !== '') {
            resetSearch();
        }
    });
    performSearch();
});
</script>
@endpush