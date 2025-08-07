@extends("layouts.default")
@section("content")
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10">
                <div class="main-content">
                    <!-- Header -->
                    <div class="header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Data Administrator</h4>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAdminModal">
                                <i class="fas fa-plus me-2"></i>Tambah Admin
                            </button>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-4">
                        <div class="card content-card">
                            <div class="card-body">
                                <!-- Search -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0">
                                                <i class="fas fa-search text-muted"></i>
                                            </span>
                                            <input type="text" 
                                                   class="form-control border-start-0 search-box" 
                                                   id="searchInput"
                                                   placeholder="Cari email atau nama admin..."
                                                   autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <button class="btn btn-outline-secondary" id="clearSearch">
                                                <i class="fas fa-refresh me-2"></i>Reset
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Search Results Info -->
                                <div id="searchInfo" class="mb-3" style="display: none;">
                                    <small class="text-muted">
                                        Menampilkan <span id="resultCount">0</span> dari {{ count($admin) }} data
                                    </small>
                                </div>

                                <!-- No Results Message -->
                                <div id="noResults" class="text-center py-4" style="display: none;">
                                    <i class="fas fa-search text-muted mb-2" style="font-size: 3rem;"></i>
                                    <h6 class="text-muted">Tidak ada data yang ditemukan</h6>
                                    <p class="text-muted">Coba ubah kata kunci pencarian Anda</p>
                                </div>

                                <!-- Admin Table -->
                                <div class="table-responsive">
                                    <table class="table table-hover" id="adminTable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th>Role</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="adminTableBody">
                                            @foreach ($admin as $admins)
                                            <tr class="admin-row" 
                                                data-name="{{ strtolower($admins->name) }}" 
                                                data-email="{{ strtolower($admins->email) }}"
                                                data-role="{{ strtolower($admins->role) }}">
                                                <td class="row-number">{{ $loop->iteration }}</td>
                                                <td>
                                                    <div>
                                                        <strong class="admin-name">{{ $admins->name }}</strong>
                                                        <br><small class="text-muted admin-email">{{ $admins->email }}</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary">******</span>
                                                </td>
                                                <td class="admin-role">{{ $admins->role }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary me-2 edit-btn" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#editAdminModal"
                                                        data-id="{{ $admins->id }}"
                                                        data-name="{{ $admins->name }}"
                                                        data-email="{{ $admins->email }}"
                                                        data-password="{{ $admins->password }}"
                                                        data-role="{{ $admins->role }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <form action="{{ route('admin.destroy', $admins->id) }}" method="POST" style="display:inline;" id="deleteForm-{{ $admins->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('{{ $admins->id }}', '{{ $admins->name }}')"><i class="fas fa-trash"></i></button>
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

    <!-- Add Admin Modal -->
    <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Admin Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input name="name" type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input name="email" type="text" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input name="password" type="password" class="form-control" id="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" class="form-select" id="role" required>
                                <option value="" disabled selected>Pilih Role</option>
                                <option value="admin">Admin</option>
                                <option value="petugas">Petugas</option>
                            </select>
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
    </div>

    <!-- Edit Admin Modal -->
    <div class="modal fade" id="editAdminModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="mb-3">
                            <label for="editName" class="form-label">Nama Lengkap</label>
                            <input name="name" type="text" class="form-control" id="editName" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input name="email" type="text" class="form-control" id="editEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="editPassword" class="form-label">Password Baru (kosongkan jika tidak diubah)</label>
                            <input name="password" type="password" class="form-control" id="editPassword">
                        </div>
                        <div class="mb-3">
                            <label for="editRole" class="form-label">Role</label>
                            <select name="role" class="form-select" id="editRole" required>
                                <option value="admin">Admin</option>
                                <option value="petugas">Petugas</option>
                            </select>
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
<!-- JS untuk search  -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const clearButton = document.getElementById('clearSearch');
    const searchInfo = document.getElementById('searchInfo');
    const resultCount = document.getElementById('resultCount');
    const noResults = document.getElementById('noResults');
    const adminTable = document.getElementById('adminTable');
    const adminRows = document.querySelectorAll('.admin-row');
    let searchTimeout;
    function performSearch() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;
        
        adminRows.forEach(function(row, index) {
            const name = row.dataset.name;
            const email = row.dataset.email;
            const role = row.dataset.role;
            
            const isVisible = name.includes(searchTerm) || 
                            email.includes(searchTerm) || 
                            role.includes(searchTerm);
            
            if (isVisible) {
                row.style.display = '';
                visibleCount++;
                row.querySelector('.row-number').textContent = visibleCount;
            } else {
                row.style.display = 'none';
            }
        });
        if (searchTerm) {
            searchInfo.style.display = 'block';
            resultCount.textContent = visibleCount;
        } else {
            searchInfo.style.display = 'none';
            adminRows.forEach(function(row, index) {
                row.querySelector('.row-number').textContent = index + 1;
            });
        }
        if (visibleCount === 0 && searchTerm) {
            noResults.style.display = 'block';
            adminTable.style.display = 'none';
        } else {
            noResults.style.display = 'none';
            adminTable.style.display = 'table';
        }
    }
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(performSearch, 300);
    });
    clearButton.addEventListener('click', function() {
        searchInput.value = '';
        searchInput.focus();
        performSearch();
    });
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            performSearch();
        }
    });
});
</script>

<!-- JS untuk tambah data -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#addAdminModal form');
    const submitBtn = form.querySelector('button[type="submit"]');
    const spinner = submitBtn.querySelector('.spinner-border');
    
    form.addEventListener('submit', function(e) {
        submitBtn.disabled = true;
        spinner.classList.remove('d-none');
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status"></span> Menyimpan...';
    });
    
    const modal = document.getElementById('addAdminModal');
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
                const name = button.getAttribute('data-name');
                const email = button.getAttribute('data-email');
                const password = button.getAttribute('data-password');
                const role = button.getAttribute('data-role');

                document.getElementById('editName').value = name;
                document.getElementById('editEmail').value = email;
                document.getElementById('editPassword').value = '';
                document.getElementById('editRole').value = role;

                form.action = `/admin/${id}`;
            });
        });
    });
</script>

<style>
.search-highlight {
    background-color: yellow;
    font-weight: bold;
}

.admin-row {
    transition: opacity 0.3s ease;
}

#searchInput:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.input-group .form-control:focus {
    z-index: 3;
}

.table-responsive {
    transition: all 0.3s ease;
}
</style>
@endpush