@extends("layouts.default")
@section("content")
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10">
                <div class="main-content">
                    <!-- Header -->
                    <div class="header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0">Riwayat Konsultasi</h4>
                                <small class="text-muted">Semua hasil diagnosa sistem pakar</small>
                            </div>
                            <!-- Tombol Print All -->
                            <div>
                                <button class="btn btn-outline-primary btn-sm me-2" onclick="printAllConsultations()" title="Print Semua Data">
                                    <i class="fas fa-print me-2"></i>Print Laporan
                                </button>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-success btn-sm dropdown-toggle" data-bs-toggle="dropdown" title="Export Options">
                                        <i class="fas fa-download me-2"></i>Export
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#" onclick="printAllConsultations()">
                                            <i class="fas fa-print me-2"></i>Print ke PDF
                                        </a></li>
                                        <li><a class="dropdown-item" href="#" onclick="exportToExcel()">
                                            <i class="fas fa-file-excel me-2"></i>Export ke Excel
                                        </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-4">
                        <div class="card content-card">
                            <div class="card-body">
                                <!-- Search and Filter -->
                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <div class="input-group">
                                        </div>
                                    </div>
                                </div>
                                <!-- Consultation History Table -->
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pasien</th>
                                                <th>Usia</th>
                                                <th>Hasil Diagnosa</th>
                                                <th>Tingkat Keyakinan</th>
                                                <th>Tanggal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($konsultasi as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        {{ $item->pasien->nama_pasien ?? 'None' }}
                                                    </div>
                                                </td>
                                                <td>{{ $item->pasien->usia ?? 'None' }} Tahun</td>
                                                <td>
                                                    <span class="diagnosis-badge diagnosis-preeclampsia">
                                                        {{ $item->hasil_diagnosa ?? 'None' }}
                                                    </span>
                                                </td>
                                                <td><span class="confidence-badge confidence-high">{{ isset($item->tingkat_keyakinan) ? number_format($item->tingkat_keyakinan * 100, 0) . '%' : 'None' }}</span></td>
                                                <td>
                                                    <div>
                                                        <strong>{{ $item->tanggal ?? 'None' }}</strong>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <!-- Detail Button -->
                                                        <button 
                                                            class="btn btn-sm btn-outline-primary btn-detail" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#detailModal" 
                                                            title="Lihat Detail"
                                                            data-id="{{ $item->id_konsultasi }}"
                                                            data-nama="{{ $item->pasien->nama_pasien ?? 'None' }}"
                                                            data-usia="{{ $item->pasien->usia ?? 'None' }}"
                                                            data-email="{{ $item->pasien->email ?? 'None' }}"
                                                            data-alamat="{{ $item->pasien->alamat ?? 'None' }}"
                                                            data-diagnosa="{{ $item->hasil_diagnosa ?? 'None' }}"
                                                            data-kepercayaan="{{ isset($item->tingkat_keyakinan) ? number_format($item->tingkat_keyakinan * 100, 0) : 'None' }}"
                                                            data-tanggal="{{ $item->tanggal ?? 'None' }}"
                                                        >
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        
                                                        <!-- Print PDF Dropdown -->
                                                        <div class="btn-group" role="group">
                                                            <button type="button" class="btn btn-sm btn-outline-success dropdown-toggle" data-bs-toggle="dropdown" title="Print PDF Options">
                                                                <i class="fas fa-download"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a class="dropdown-item print-pdf-btn" href="#" 
                                                                       data-id="{{ $item->id_konsultasi }}"
                                                                       data-nama="{{ $item->pasien->nama_pasien ?? 'None' }}"
                                                                       data-usia="{{ $item->pasien->usia ?? 'None' }}"
                                                                       data-email="{{ $item->pasien->email ?? 'None' }}"
                                                                       data-alamat="{{ $item->pasien->alamat ?? 'None' }}"
                                                                       data-diagnosa="{{ $item->hasil_diagnosa ?? 'None' }}"
                                                                       data-kepercayaan="{{ isset($item->tingkat_keyakinan) ? number_format($item->tingkat_keyakinan * 100, 0) : 'None' }}"
                                                                       data-tanggal="{{ $item->tanggal ?? 'None' }}"
                                                                       onclick="handlePrintPDF(this, 'print')">
                                                                        <i class="fas fa-print me-2"></i>Print PDF
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item download-pdf-btn" href="#" 
                                                                       data-id="{{ $item->id_konsultasi }}"
                                                                       data-nama="{{ $item->pasien->nama_pasien ?? 'None' }}"
                                                                       data-usia="{{ $item->pasien->usia ?? 'None' }}"
                                                                       data-email="{{ $item->pasien->email ?? 'None' }}"
                                                                       data-alamat="{{ $item->pasien->alamat ?? 'None' }}"
                                                                       data-diagnosa="{{ $item->hasil_diagnosa ?? 'None' }}"
                                                                       data-kepercayaan="{{ isset($item->tingkat_keyakinan) ? number_format($item->tingkat_keyakinan * 100, 0) : 'None' }}"
                                                                       data-tanggal="{{ $item->tanggal ?? 'None' }}"
                                                                       onclick="handlePrintPDF(this, 'download')">
                                                                        <i class="fas fa-file-pdf me-2"></i>Download PDF
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
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

    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Hasil Konsultasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Data Pasien</h6>
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <td>Nama</td>
                                    <td>: <span id="modal-nama-pasien"></span></td>
                                </tr>
                                <tr>
                                    <td>Usia</td>
                                    <td>: <span id="modal-usia"></span> tahun</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>: <span id="modal-email"></span></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: <span id="modal-alamat"></span></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6>Hasil Diagnosa</h6>
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <td>Penyakit</td>
                                    <td>: <span id="modal-diagnosa"></span></td>
                                </tr>
                                <tr>
                                    <td>Tingkat Keyakinan</td>
                                    <td>: <span id="modal-kepercayaan"></span>%</td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>: <span id="modal-tanggal"></span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group me-2" role="group">
                        <button type="button" class="btn btn-outline-primary" id="btn-print-modal">
                            <i class="fas fa-print me-2"></i>Print PDF
                        </button>
                        <button type="button" class="btn btn-outline-success" id="btn-download-modal">
                            <i class="fas fa-download me-2"></i>Download PDF
                        </button>
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Modal - Will be created dynamically by JavaScript -->
    <!-- Toast container for notifications -->
    <div id="toast-container" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>
@endsection

@push('styles')
<style>
/* Print Styles */
@media print {
    .no-print, .btn, .pagination, .header .d-flex > div:last-child {
        display: none !important;
    }
    
    body {
        font-size: 12px;
        line-height: 1.4;
    }
    
    .table {
        font-size: 10px;
    }
    
    .diagnosis-badge, .confidence-badge {
        border: 1px solid #ddd !important;
        background-color: #f8f9fa !important;
        color: #333 !important;
    }
}

/* Custom Dropdown Styles */
.dropdown-menu {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    border: 1px solid #dee2e6;
}

.dropdown-item:hover {
    background-color: #f8f9fa;
    color: #495057;
}

/* Button Loading Animation */
.btn-loading {
    position: relative;
    pointer-events: none;
}

.btn-loading::after {
    content: "";
    position: absolute;
    width: 16px;
    height: 16px;
    top: 50%;
    left: 50%;
    margin: -8px 0 0 -8px;
    border: 2px solid #fff;
    border-radius: 50%;
    border-top-color: transparent;
    animation: button-loading-spinner 1s ease infinite;
}

@keyframes button-loading-spinner {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Custom Alert Styles */
.alert-pdf {
    border-left: 4px solid #007bff;
    background-color: #f8f9ff;
    border-color: #b8daff;
}

/* Responsive Table Improvements */
@media (max-width: 768px) {
    .btn-group {
        flex-direction: column;
    }
    
    .btn-group .btn {
        margin-bottom: 2px;
    }
}
</style>
@endpush

@push('scripts')
<!-- jsPDF Library - Load async for better performance -->
<script>
// Load jsPDF asynchronously for better page load performance
(function() {
    const script = document.createElement('script');
    script.src = 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js';
    script.async = true;
    script.onerror = function() {
        console.warn('jsPDF failed to load, will use print fallback');
    };
    document.head.appendChild(script);
})();
</script>

<!-- Optimized PDF Functions -->
<script>
// ===== OPTIMIZED PDF FUNCTIONS =====

/**
 * Show progress modal with steps
 */
function showProgressModal(show, step = 'Memproses...', progress = 0) {
    let modal = document.getElementById('progressModal');
    
    if (!modal) {
        const modalHtml = `
            <div class="modal fade" id="progressModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                        <div class="modal-body text-center p-4">
                            <div class="mb-3">
                                <div class="spinner-border text-primary" role="status" id="progressSpinner">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            <h6 class="mb-2" id="progressTitle">Memproses PDF</h6>
                            <div class="progress mb-2" style="height: 6px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" id="progressBar" style="width: 0%"></div>
                            </div>
                            <small class="text-muted" id="progressStep">Mohon tunggu sebentar...</small>
                        </div>
                    </div>
                </div>
            </div>
        `;
        document.body.insertAdjacentHTML('beforeend', modalHtml);
        modal = document.getElementById('progressModal');
    }
    
    if (show) {
        document.getElementById('progressStep').textContent = step;
        document.getElementById('progressBar').style.width = progress + '%';
        new bootstrap.Modal(modal).show();
    } else {
        const bsModal = bootstrap.Modal.getInstance(modal);
        if (bsModal) bsModal.hide();
    }
}

function updateProgress(step, progress) {
    const stepEl = document.getElementById('progressStep');
    const progressEl = document.getElementById('progressBar');
    if (stepEl) stepEl.textContent = step;
    if (progressEl) progressEl.style.width = progress + '%';
}

/**
 * Fast print function - optimized for speed
 */
function printConsultationDetail(consultationData) {
    showProgressModal(true, 'Menyiapkan dokumen...', 30);
    
    const printContent = `
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Hasil Konsultasi - ${consultationData.nama}</title>
            <style>
                * { margin: 0; padding: 0; box-sizing: border-box; }
                body { font-family: Arial, sans-serif; font-size: 12px; padding: 20px; color: #333; }
                .header { text-align: center; margin-bottom: 25px; border-bottom: 2px solid #007bff; padding-bottom: 15px; }
                .header h1 { color: #007bff; font-size: 18px; margin-bottom: 5px; }
                .section { margin-bottom: 20px; }
                .section-title { background: #f8f9fa; padding: 8px 12px; border-left: 3px solid #007bff; margin-bottom: 12px; font-weight: bold; }
                .info-table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
                .info-table td { padding: 8px 12px; border-bottom: 1px solid #eee; }
                .info-table td:first-child { font-weight: bold; width: 30%; background: #f8f9fa; }
                .diagnosis-box { background: #d4edda; border: 2px solid #28a745; border-radius: 6px; padding: 15px; text-align: center; margin: 15px 0; }
                .diagnosis-title { color: #155724; font-size: 16px; font-weight: bold; margin-bottom: 5px; }
                .confidence-score { color: #007bff; font-size: 14px; font-weight: bold; }
                .disclaimer { background: #fff3cd; border: 1px solid #ffeaa7; border-radius: 4px; padding: 10px; margin: 15px 0; font-size: 10px; color: #856404; }
                .footer { text-align: center; margin-top: 25px; padding-top: 15px; border-top: 1px solid #ddd; font-size: 10px; color: #666; }
                @media print { body { padding: 10px; font-size: 11px; } }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>🏥 HASIL KONSULTASI SISTEM PAKAR</h1>
                <div>Diagnosa Hipertensi pada Ibu Hamil</div>
            </div>
            <div class="section">
                <div class="section-title">📋 Data Pasien</div>
                <table class="info-table">
                    <tr><td>Nama</td><td>${consultationData.nama}</td></tr>
                    <tr><td>Usia</td><td>${consultationData.usia} tahun</td></tr>
                    <tr><td>Email</td><td>${consultationData.email}</td></tr>
                    <tr><td>Alamat</td><td>${consultationData.alamat}</td></tr>
                    <tr><td>Tanggal</td><td>${consultationData.tanggal}</td></tr>
                    <tr><td>ID</td><td>#${String(consultationData.id || '0').padStart(5, '0')}</td></tr>
                </table>
            </div>
            <div class="section">
                <div class="section-title">🔬 Hasil Diagnosa</div>
                <div class="diagnosis-box">
                    <div class="diagnosis-title">${consultationData.diagnosa}</div>
                    <div class="confidence-score">Tingkat Keyakinan: ${consultationData.kepercayaan}%</div>
                </div>
            </div>
            <div class="disclaimer">
                <strong>⚠️ DISCLAIMER:</strong> Hasil diagnosa sistem pakar ini hanya sebagai alat bantu skrining awal dan TIDAK menggantikan diagnosa medis profesional.
            </div>
            <div class="footer">
                <p><strong>Sistem Pakar Diagnosa Hipertensi</strong></p>
                <p>Dicetak: ${new Date().toLocaleString('id-ID')}</p>
            </div>
        </body>
        </html>
    `;
    
    updateProgress('Membuka print...', 70);
    
    const printWindow = window.open('', '_blank');
    printWindow.document.write(printContent);
    printWindow.document.close();
    
    printWindow.onload = function() {
        updateProgress('Selesai!', 100);
        setTimeout(() => {
            showProgressModal(false);
            printWindow.focus();
            printWindow.print();
            showToast('PDF siap dicetak!', 'success');
        }, 300);
    };
}

/**
 * Optimized PDF download
 */
function generatePDFDownload(consultationData) {
    if (typeof window.jsPDF === 'undefined') {
        showToast('Library PDF belum siap. Menggunakan print...', 'warning');
        return printConsultationDetail(consultationData);
    }
    
    showProgressModal(true, 'Membuat PDF...', 20);
    
    try {
        const { jsPDF } = window.jsPDF;
        const doc = new jsPDF('p', 'mm', 'a4');
        
        updateProgress('Menambahkan konten...', 50);
        
        // Simplified PDF generation
        let yPos = 20;
        const margin = 20;
        const pageWidth = doc.internal.pageSize.getWidth();
        
        // Header
        doc.setFillColor(0, 123, 255);
        doc.rect(0, 0, pageWidth, 20, 'F');
        doc.setTextColor(255, 255, 255);
        doc.setFontSize(16);
        doc.text('HASIL KONSULTASI SISTEM PAKAR', pageWidth / 2, 12, { align: 'center' });
        
        yPos = 35;
        doc.setTextColor(0, 0, 0);
        doc.setFontSize(10);
        
        // Patient data
        const data = [
            `Nama: ${consultationData.nama}`,
            `Usia: ${consultationData.usia} tahun`, 
            `Email: ${consultationData.email}`,
            `Alamat: ${consultationData.alamat}`,
            `Tanggal: ${consultationData.tanggal}`
        ];
        
        data.forEach(line => {
            doc.text(line, margin, yPos);
            yPos += 6;
        });
        
        yPos += 10;
        
        // Diagnosis
        doc.setFillColor(212, 237, 218);
        doc.roundedRect(margin, yPos, pageWidth - (margin * 2), 20, 2, 2, 'F');
        doc.setFontSize(14);
        doc.text(consultationData.diagnosa, pageWidth / 2, yPos + 10, { align: 'center' });
        doc.setFontSize(12);
        doc.text(`Keyakinan: ${consultationData.kepercayaan}%`, pageWidth / 2, yPos + 16, { align: 'center' });
        
        updateProgress('Menyimpan...', 90);
        
        const filename = `Konsultasi_${consultationData.nama.replace(/\W/g, '_')}_${Date.now()}.pdf`;
        
        setTimeout(() => {
            doc.save(filename);
            updateProgress('Selesai!', 100);
            setTimeout(() => {
                showProgressModal(false);
                showToast('PDF berhasil didownload!', 'success');
            }, 200);
        }, 100);
        
    } catch (error) {
        showProgressModal(false);
        showToast('Error PDF, menggunakan print...', 'warning');
        printConsultationDetail(consultationData);
    }
}

function printAllConsultations() {
    const table = document.querySelector('.table-responsive table');
    if (!table) return showToast('Tabel tidak ditemukan!', 'error');
    
    showProgressModal(true, 'Menyiapkan laporan...', 40);
    
    const tableClone = table.cloneNode(true);
    tableClone.querySelectorAll('td:last-child, th:last-child').forEach(cell => cell.remove());
    
    const printContent = `
        <!DOCTYPE html>
        <html><head><meta charset="utf-8"><title>Laporan Konsultasi</title>
        <style>
            * { margin: 0; padding: 0; }
            body { font-family: Arial, sans-serif; font-size: 11px; padding: 15px; }
            .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #007bff; padding-bottom: 15px; }
            table { width: 100%; border-collapse: collapse; font-size: 10px; }
            th, td { border: 1px solid #ddd; padding: 6px; }
            th { background: #f8f9fa; font-weight: bold; }
        </style></head>
        <body>
            <div class="header">
                <h1>LAPORAN RIWAYAT KONSULTASI</h1>
                <p>Dicetak: ${new Date().toLocaleDateString('id-ID')}</p>
            </div>
            ${tableClone.outerHTML}
        </body></html>
    `;
    
    updateProgress('Membuka print...', 80);
    
    const printWindow = window.open('', '_blank');
    printWindow.document.write(printContent);
    printWindow.document.close();
    
    printWindow.onload = function() {
        showProgressModal(false);
        printWindow.focus();
        printWindow.print();
        showToast('Laporan siap dicetak!', 'success');
    };
}

function handlePrintPDF(element, action) {
    const consultationData = {
        id: element.dataset.id || '',
        nama: element.dataset.nama || 'N/A',
        usia: element.dataset.usia || 'N/A', 
        email: element.dataset.email || 'N/A',
        alamat: element.dataset.alamat || 'N/A',
        diagnosa: element.dataset.diagnosa || 'N/A',
        kepercayaan: element.dataset.kepercayaan || '0',
        tanggal: element.dataset.tanggal || 'N/A'
    };
    
    if (action === 'print') {
        printConsultationDetail(consultationData);
    } else {
        generatePDFDownload(consultationData);
    }
}

function showToast(message, type = 'info') {
    const existing = document.querySelector('.toast-notification');
    if (existing) existing.remove();
    
    const colors = { success: '#28a745', error: '#dc3545', warning: '#ffc107', info: '#17a2b8' };
    const icons = { success: '✓', error: '✕', warning: '⚠', info: 'ℹ' };
    
    const toast = document.createElement('div');
    toast.className = 'toast-notification';
    toast.style.cssText = `
        position: fixed; top: 20px; right: 20px; z-index: 9999;
        background: white; border-left: 4px solid ${colors[type]};
        box-shadow: 0 4px 12px rgba(0,0,0,0.15); border-radius: 6px;
        padding: 12px 16px; max-width: 300px; display: flex; align-items: center;
        animation: slideIn 0.3s ease;
    `;
    
    toast.innerHTML = `
        <span style="color: ${colors[type]}; font-weight: bold; margin-right: 8px;">${icons[type]}</span>
        <span style="flex: 1; font-size: 14px;">${message}</span>
        <button onclick="this.parentElement.remove()" style="border: none; background: none; font-size: 18px; cursor: pointer; color: #999; margin-left: 8px;">&times;</button>
    `;
    
    if (!document.querySelector('#toast-styles')) {
        const style = document.createElement('style');
        style.id = 'toast-styles';
        style.textContent = '@keyframes slideIn { from { transform: translateX(100%); } }';
        document.head.appendChild(style);
    }
    
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 4000);
}

function exportToExcel() {
    showToast('Fitur Excel akan segera tersedia!', 'info');
}
</script>

<!-- Original Modal and Event Handlers Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const detailModal = document.getElementById('detailModal');
    
    detailModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const nama = button.getAttribute('data-nama');
        const usia = button.getAttribute('data-usia');
        const email = button.getAttribute('data-email');
        const alamat = button.getAttribute('data-alamat');
        const diagnosa = button.getAttribute('data-diagnosa');
        const kepercayaan = button.getAttribute('data-kepercayaan');
        const tanggal = button.getAttribute('data-tanggal');

        // Tampilkan data ke modal
        document.getElementById('modal-nama-pasien').textContent = nama;
        document.getElementById('modal-usia').textContent = usia;
        document.getElementById('modal-email').textContent = email;
        document.getElementById('modal-alamat').textContent = alamat;
        document.getElementById('modal-diagnosa').textContent = diagnosa;
        document.getElementById('modal-kepercayaan').textContent = kepercayaan;
        document.getElementById('modal-tanggal').textContent = tanggal;

    });
    
    // Modal button handlers - optimized
    document.getElementById('btn-print-modal').addEventListener('click', function() {
        const consultationData = {
            nama: document.getElementById('modal-nama-pasien').textContent,
            usia: document.getElementById('modal-usia').textContent,
            email: document.getElementById('modal-email').textContent,
            alamat: document.getElementById('modal-alamat').textContent,
            diagnosa: document.getElementById('modal-diagnosa').textContent,
            kepercayaan: document.getElementById('modal-kepercayaan').textContent.replace('%', ''),
            tanggal: document.getElementById('modal-tanggal').textContent
        };
        
        printConsultationDetail(consultationData);
    });
    
    document.getElementById('btn-download-modal').addEventListener('click', function() {
        const consultationData = {
            nama: document.getElementById('modal-nama-pasien').textContent,
            usia: document.getElementById('modal-usia').textContent,
            email: document.getElementById('modal-email').textContent,
            alamat: document.getElementById('modal-alamat').textContent,
            diagnosa: document.getElementById('modal-diagnosa').textContent,
            kepercayaan: document.getElementById('modal-kepercayaan').textContent.replace('%', ''),
            tanggal: document.getElementById('modal-tanggal').textContent
        };
        
        generatePDFDownload(consultationData);
    });
});

</script>
</script>
@endpush