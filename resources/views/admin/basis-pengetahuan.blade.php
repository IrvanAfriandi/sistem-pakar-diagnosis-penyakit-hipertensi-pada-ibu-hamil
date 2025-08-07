@extends("layouts.default")
@section("content")
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10">
                <div class="main-content">
                    <!-- Header -->
                    <div class="header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0">Basis Pengetahuan</h4>
                                <small class="text-muted">Aturan Certainty Factor untuk diagnosis penyakit</small>
                            </div>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKnowledgeModal">
                                <i class="fas fa-plus me-2"></i>Tambah Aturan
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
                                            <input type="text" class="form-control border-start-0 search-box" placeholder="Cari penyakit atau gejala...">
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <select class="form-select d-inline-block w-auto me-2" id="filterPenyakit">
                                            <option value="">Semua Penyakit</option>
                                            @foreach($penyakit as $p)
                                                <option value="{{ $p->kode_penyakit }}">{{ $p->nama_penyakit }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Knowledge Base Table -->
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Penyakit</th>
                                                <th>Gejala</th>
                                                <th>CF Pakar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($knowledge as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div>
                                                        <strong>{{ $item->penyakit->nama_penyakit ?? 'None' }}</strong>
                                                        <br><small class="text-muted">{{ $item->penyakit->kode_penyakit ?? 'None' }}</small>
                                                    </div>

                                                </td>
                                                <td>
                                                    <div>
                                                        <strong>{{ $item->gejala->nama_gejala ?? 'None' }}</strong>
                                                        <br><small class="text-muted">{{ $item->gejala->kode_gejala ?? 'None' }}</small>
                                                    </div>
                                                </td>
                                                <td><span class="cf-badge cf-expert">{{ $item->cf_pakar }}</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary me-2 edit-btn" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#editKnowledgeModal"
                                                        data-id="{{ $item->id_pengetahuan }}"
                                                        data-penyakit="{{ $item->id_penyakit }}"
                                                        data-gejala="{{ $item->id_gejala }}"
                                                        data-cf-pakar="{{ $item->cf_pakar }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <form action="{{ route('basis-pengetahuan.destroy', $item->id_pengetahuan) }}" method="POST" style="display:inline;" id="deleteForm-{{ $item->id_pengetahuan }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('{{ $item->id_pengetahuan }}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Info Box -->
                                <div class="alert alert-info mt-4">
                                    <h6><i class="fas fa-info-circle me-2"></i>Informasi Certainty Factor:</h6>
                                    <ul class="mb-0">
                                        <li><strong>CF Pakar (MB):</strong> Tingkat keyakinan pakar terhadap hubungan antara gejala dan penyakit (0.0 - 1.0)</li>
                                        <li><strong>CF Pasien:</strong> Tingkat keyakinan pasien terhadap gejala yang dirasakan (0.0 - 1.0)</li>
                                        <li><strong>CF Rule:</strong> Dihitung dari <code>(MB - (1 - MB)) × CF Pasien</code>, atau sederhananya <code>(2 × MB - 1) × CF Pasien</code></li>
                                        <li><strong>Nilai Diagnosis:</strong> Menggabungkan semua CF Rule dari gejala-gejala yang dipilih untuk menentukan tingkat keyakinan terhadap penyakit tertentu.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Knowledge Modal -->
    <div class="modal fade" id="addKnowledgeModal" tabindex="-1" aria-labelledby="addKnowledgeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Aturan Basis Pengetahuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('basis-pengetahuan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="penyakit" class="form-label">Penyakit</label>
                            <select class="form-select" name="id_penyakit" id="penyakit" required>
                                <option value="">Pilih Penyakit</option>
                                @foreach($penyakit as $p)
                                    <option value="{{ $p->id_penyakit }}">{{ $p->kode_penyakit }} - {{ $p->nama_penyakit }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="gejala" class="form-label">Gejala</label>
                            <select class="form-select" name="id_gejala" id="gejala" required>
                                <option value="">Pilih Gejala</option>
                                @foreach($gejala as $g)
                                    <option value="{{ $g->id_gejala }}">{{ $g->kode_gejala }} - {{ $g->nama_gejala }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="cfPakar" class="form-label">CF Pakar (0.0 - 1.0)</label>
                            <input type="number" class="form-control" name="cf_pakar" id="cfPakar" min="0" max="1" step="0.01" required>
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

    <!-- Edit Knowledge Modal -->
    <div class="modal fade" id="editKnowledgeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Aturan Basis Pengetahuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="editPenyakit" class="form-label">Penyakit</label>
                            <select class="form-select" name="id_penyakit" id="editPenyakit" required>
                                <option value="">Pilih Penyakit</option>
                                @foreach($penyakit as $p)
                                    <option value="{{ $p->id_penyakit }}">{{ $p->kode_penyakit }} - {{ $p->nama_penyakit }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editGejala" class="form-label">Gejala</label>
                            <select class="form-select" name="id_gejala" id="editGejala" required>
                                <option value="">Pilih Gejala</option>
                                @foreach($gejala as $g)
                                    <option value="{{ $g->id_gejala }}">{{ $g->kode_gejala }} - {{ $g->nama_gejala }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editCfPakar" class="form-label">CF Pakar (0.0 - 1.0)</label>
                            <input type="number" class="form-control" name="cf_pakar" id="editCfPakar" min="0" max="1" step="0.01" required>
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
    const form = document.querySelector('#addKnowledgeModal form');
    const submitBtn = form.querySelector('button[type="submit"]');
    const spinner = submitBtn.querySelector('.spinner-border');
    
    form.addEventListener('submit', function(e) {
        submitBtn.disabled = true;
        spinner.classList.remove('d-none');
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status"></span> Menyimpan...';
    });
    
    const modal = document.getElementById('addKnowledgeModal');
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
            const penyakit = button.getAttribute('data-penyakit');
            const gejala = button.getAttribute('data-gejala');
            const cfPakar = button.getAttribute('data-cf-pakar');

            document.getElementById('editPenyakit').value = penyakit;
            document.getElementById('editGejala').value = gejala;
            document.getElementById('editCfPakar').value = cfPakar;
            form.action = `/basis-pengetahuan/${id}`;
        });
    });
});
</script>

<!-- JS untuk search -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchBox = document.querySelector('.search-box');
    const filterPenyakit = document.getElementById('filterPenyakit');
    const tableRows = document.querySelectorAll('tbody tr');

    function filterTable() {
        const searchTerm = searchBox.value.toLowerCase();
        const selectedPenyakit = filterPenyakit.value;

        tableRows.forEach(row => {
            const penyakitText = row.cells[1].textContent.toLowerCase();
            const gejalaText = row.cells[2].textContent.toLowerCase();
            const kodePenyakit = row.cells[1].querySelector('small').textContent;

            const matchesSearch = penyakitText.includes(searchTerm) || gejalaText.includes(searchTerm);
            const matchesFilter = !selectedPenyakit || kodePenyakit.includes(selectedPenyakit);

            if (matchesSearch && matchesFilter) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    searchBox.addEventListener('input', filterTable);
    filterPenyakit.addEventListener('change', filterTable);
});
</script>
@endpush