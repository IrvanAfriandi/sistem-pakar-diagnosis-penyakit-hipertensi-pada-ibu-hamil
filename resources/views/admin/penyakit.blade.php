@extends("layouts.default")
@section("content")
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10">
                <div class="main-content">
                    <!-- Header -->
                    <div class="header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Data Penyakit</h4>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPenyakitModal">
                                <i class="fas fa-plus me-2"></i>Tambah Penyakit
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
                                            <input type="text" class="form-control border-start-0 search-box" placeholder="Cari kode atau nama penyakit...">
                                        </div>
                                    </div>
                                </div>

                                <!-- Disease Table -->
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Penyakit</th>
                                                <th>Nama Penyakit</th>
                                                <th>Cara Penanganan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($penyakit as $penyakits)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><span class="disease-code">{{ $penyakits->kode_penyakit }}</span></td>
                                                <td>
                                                    <div>
                                                        <strong>{{ $penyakits->nama_penyakit }}</strong>
                                                        <br><small class="text-muted">{{ $penyakits->penjelasan }}</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <small>{{ $penyakits->penanganan }}</small>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary me-2 edit-btn" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#editPenyakitModal"
                                                        data-id="{{ $penyakits->id_penyakit }}"
                                                        data-kode="{{ $penyakits->kode_penyakit }}"
                                                        data-nama="{{ $penyakits->nama_penyakit }}"
                                                        data-penjelasan="{{ $penyakits->penjelasan }}"
                                                        data-penanganan="{{ $penyakits->penanganan }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <form action="{{ route('penyakit.destroy', $penyakits->id_penyakit) }}" method="POST" style="display:inline;" id="deleteForm-{{ $penyakits->id_penyakit }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('{{ $penyakits->id_penyakit }}', '{{ $penyakits->nama_penyakit }}')"><i class="fas fa-trash"></i></button>
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

    <!-- Add Disease Modal -->
    <div class="modal fade" id="addPenyakitModal" tabindex="-1" aria-labelledby="addPenyakitModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Penyakit Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('penyakit.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="mb-3">
                            <label for="kodePenyakit" class="form-label">Kode Penyakit</label>
                            <input type="text" name="kode_penyakit" class="form-control" id="kodePenyakit" required>
                        </div>
                        <div class="mb-3">
                            <label for="namaPenyakit" class="form-label">Nama Penyakit</label>
                            <input type="text" name="nama_penyakit" class="form-control" id="namaPenyakit" required>
                        </div>
                        <div class="mb-3">
                            <label for="Penjelasan" class="form-label">Penjelasan</label>
                            <textarea name="penjelasan" class="form-control" id="Penjelasan" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="Penanganan" class="form-label">Cara Penanganan</label>
                            <textarea name="penanganan" class="form-control" id="Penanganan" rows="4" required></textarea>
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

    <!-- Edit Disease Modal -->
    <div class="modal fade" id="editPenyakitModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Penyakit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="mb-3">
                            <label for="editKode" class="form-label">Kode Penyakit</label>
                            <input type="text" name="kode_penyakit" class="form-control" id="editKode" required>
                        </div>
                        <div class="mb-3">
                            <label for="editNama" class="form-label">Nama Penyakit</label>
                            <input type="text" name="nama_penyakit" class="form-control" id="editNama" required>
                        </div>
                        <div class="mb-3">
                            <label for="editPenjelasan" class="form-label">Penjelasan</label>
                            <textarea name="penjelasan" class="form-control" id="editPenjelasan" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editPenanganan" class="form-label">Cara Penanganan</label>
                            <textarea name="penanganan" class="form-control" id="editPenanganan" rows="4" required></textarea>
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
    const form = document.querySelector('#addPenyakitModal form');
    const submitBtn = form.querySelector('button[type="submit"]');
    const spinner = submitBtn.querySelector('.spinner-border');
    
    form.addEventListener('submit', function(e) {
        submitBtn.disabled = true;
        spinner.classList.remove('d-none');
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status"></span> Menyimpan...';
    });
    
    const modal = document.getElementById('addPenyakitModal');
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
                const kode = button.getAttribute('data-kode');
                const nama = button.getAttribute('data-nama');
                const penjelasan = button.getAttribute('data-penjelasan');
                const penanganan = button.getAttribute('data-penanganan');

                document.getElementById('editKode').value = kode;
                document.getElementById('editNama').value = nama;
                document.getElementById('editPenjelasan').value = penjelasan;
                document.getElementById('editPenanganan').value = penanganan;
                form.action = `/penyakit/${id}`;
            });
        });
    });
</script>
@endpush