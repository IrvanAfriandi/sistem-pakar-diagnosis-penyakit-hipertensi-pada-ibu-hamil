@extends("layouts.default")
@section("content")
<div class="col-md-9 col-lg-10">
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Data Gejala</h4>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGejalaModal">
                    <i class="fas fa-plus me-2"></i>Tambah Gejala
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
                                <input type="text" class="form-control border-start-0 search-box" placeholder="Cari kode atau nama gejala...">
                            </div>
                        </div>
                    </div>

                    <!-- Gejala Table -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Gejala</th>
                                    <th>Nama Gejala</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gejala as $g)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><span class="badge bg-primary">{{ $g->kode_gejala }}</span></td>
                                    <td>{{ $g->nama_gejala }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary me-2 edit-btn"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editGejalaModal"
                                            data-id="{{ $g->id_gejala }}"
                                            data-kode="{{ $g->kode_gejala }}"
                                            data-nama="{{ $g->nama_gejala }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('gejala.destroy', $g->id_gejala) }}" method="POST" style="display:inline;" id="deleteForm-{{ $g->id_gejala }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('{{ $g->id_gejala }}', '{{ $g->nama_gejala }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
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

<!-- Add Gejala Modal -->
<div class="modal fade" id="addGejalaModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('gejala.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah Gejala Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="kodeGejala" class="form-label">Kode Gejala</label>
                    <input type="text" name="kode_gejala" class="form-control" id="kodeGejala" required>
                </div>
                <div class="mb-3">
                    <label for="namaGejala" class="form-label">Nama Gejala</label>
                    <textarea name="nama_gejala" class="form-control" id="namaGejala" rows="3" required></textarea>
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

<!-- Edit Gejala Modal -->
<div class="modal fade" id="editGejalaModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="editForm" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Gejala</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="editKodeGejala" class="form-label">Kode Gejala</label>
                    <input type="text" name="kode_gejala" class="form-control" id="editKodeGejala" required>
                </div>
                <div class="mb-3">
                    <label for="editNamaGejala" class="form-label">Nama Gejala</label>
                    <textarea name="nama_gejala" class="form-control" id="editNamaGejala" rows="3" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#addGejalaModal form');
    const submitBtn = form.querySelector('button[type="submit"]');
    const spinner = submitBtn.querySelector('.spinner-border');

    form.addEventListener('submit', function(e) {
        submitBtn.disabled = true;
        spinner.classList.remove('d-none');
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status"></span> Menyimpan...';
    });

    const modal = document.getElementById('addGejalaModal');
    modal.addEventListener('hidden.bs.modal', function() {
        form.reset();
        submitBtn.disabled = false;
        spinner.classList.add('d-none');
        submitBtn.innerHTML = 'Simpan';

        const errorMessages = form.querySelectorAll('.text-danger');
        errorMessages.forEach(error => error.remove());

        const inputs = form.querySelectorAll('.form-control');
        inputs.forEach(input => input.classList.remove('is-invalid', 'is-valid'));
    });
});

// JS Edit Modal
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-btn');
    const form = document.getElementById('editForm');

    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            const kode = button.getAttribute('data-kode');
            const nama = button.getAttribute('data-nama');

            document.getElementById('editKodeGejala').value = kode;
            document.getElementById('editNamaGejala').value = nama;

            form.action = `/gejala/${id}`;
        });
    });
});
</script>
@endpush
