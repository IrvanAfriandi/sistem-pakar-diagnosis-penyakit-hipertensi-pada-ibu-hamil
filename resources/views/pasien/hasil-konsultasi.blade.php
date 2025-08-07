<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            --success-color: #10B981;
            --warning-color: #F59E0B;
            --danger-color: #EF4444;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--primary-light) 0%, white 100%);
            min-height: 100vh;
        }
        
        .result-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 40px 0;
        }
        
        .result-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .result-header {
            background: var(--success-color);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .result-header.warning {
            background: var(--warning-color);
        }
        
        .result-header.danger {
            background: var(--danger-color);
        }
        
        .result-body {
            padding: 40px;
        }
        
        .diagnosis-card {
            border: 2px solid #E5E7EB;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .diagnosis-card.primary {
            border-color: var(--primary-color);
            background-color: var(--primary-light);
        }
        
        .confidence-badge {
            font-size: 2rem;
            font-weight: bold;
            padding: 15px 25px;
            border-radius: 50px;
            display: inline-block;
            margin: 15px 0;
        }
        
        .confidence-high {
            background-color: #DEF7EC;
            color: var(--success-color);
        }
        
        .confidence-medium {
            background-color: #FEF3CD;
            color: var(--warning-color);
        }
        
        .confidence-low {
            background-color: #FEE2E2;
            color: var(--danger-color);
        }
        
        .recommendation-card {
            background: #F8FAFC;
            border-left: 4px solid var(--primary-color);
            border-radius: 8px;
            padding: 20px;
            margin: 15px 0;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 12px 25px;
            font-weight: 600;
            border-radius: 10px;
        }
        
        .btn-success {
            background-color: var(--success-color);
            border-color: var(--success-color);
            padding: 12px 25px;
            font-weight: 600;
            border-radius: 10px;
        }
        
        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }
        
        .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 10px;
            font-weight: bold;
        }
        
        .step.completed {
            background-color: var(--success-color);
            color: white;
        }
        
        .step-connector {
            width: 50px;
            height: 2px;
            background-color: var(--success-color);
            margin-top: 20px;
        }
        
        .patient-info {
            background: #F8FAFC;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .loading-spinner {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 200px;
        }

        .debug-info {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            font-size: 12px;
        }

        .symptom-item {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }

        .symptom-item:hover {
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .cf-badge {
            font-size: 0.9rem;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 20px;
            min-width: 60px;
            text-align: center;
        }

        .cf-very-high {
            background-color: #d1f2eb;
            color: #0d7559;
        }

        .cf-high {
            background-color: #def7ec;
            color: #10b981;
        }

        .cf-medium {
            background-color: #fef3cd;
            color: #f59e0b;
        }

        .cf-low {
            background-color: #fee2e2;
            color: #ef4444;
        }

        .symptom-summary {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 15px;
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            max-width: 350px;
            min-width: 300px;
        }
        
        @media print {
            body {
                background: white;
            }
            .btn, .step-indicator, .debug-info, .notification {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .result-container {
                padding: 20px;
            }
            .result-body {
                padding: 20px;
            }
            .step-indicator {
                margin-bottom: 20px;
            }
            .step {
                width: 30px;
                height: 30px;
                margin: 0 5px;
            }
            .step-connector {
                width: 30px;
            }
        }
    </style>
</head>
<body>
    <script>
        try {
            window.LaravelData = {
                konsultasi: @json($konsultasi ?? null),
                diseases: @json($penyakit ?? []),
                symptoms: @json($gejala ?? []),
                knowledgeBase: @json($basisPengetahuan ?? [])
            };
            console.log('Laravel data loaded successfully');
        } catch (e) {
            console.error('Error loading Laravel data:', e);
            window.LaravelData = {
                konsultasi: null,
                diseases: [],
                symptoms: [],
                knowledgeBase: []
            };
        }
        window.routes = {
            diagnosisIndex: "{{ route('diagnosis.index') }}",
            pasienIndex: "{{ route('pasien.index') }}",
            saveDiagnosis: "{{ route('diagnosis.save-result') }}",
            currentKonsultasiId: {{ $konsultasi->id_konsultasi ?? 'null' }}
        };
    </script>
    <div class="container">
        <div class="result-container">
            <div class="step-indicator">
                <div class="step completed">
                    <i class="fas fa-check"></i>
                </div>
                <div class="step-connector"></div>
                <div class="step completed">
                    <i class="fas fa-check"></i>
                </div>
                <div class="step-connector"></div>
                <div class="step completed">
                    <i class="fas fa-check"></i>
                </div>
            </div>
            <div class="result-card">
                <div class="result-header" id="resultHeader">
                    <i class="fas fa-file-medical-alt fa-3x mb-3"></i>
                    <h2 class="mb-0">Hasil Diagnosis</h2>
                    <p class="mb-0 mt-2 opacity-75">Certainty Factor Analysis</p>
                </div>
                <div class="result-body">
                    <div id="loadingState" class="loading-spinner">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <span class="ms-3">Memproses diagnosis...</span>
                    </div>
                    <div id="mainContent" style="display: none;">
                        <div class="patient-info">
                            <h5 class="fw-bold mb-3"><i class="fas fa-user me-2"></i>Informasi Pasien</h5>
                            <div class="row" id="patientInfo">
                                <div class="col-md-6 mb-2">
                                    <strong>Nama:</strong> <span id="patientName">Loading...</span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <strong>Usia:</strong> <span id="patientAge">Loading...</span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <strong>Email:</strong> <span id="patientEmail">Loading...</span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <strong>Tanggal Konsultasi:</strong> <span id="consultationDate">Loading...</span>
                                </div>
                            </div>
                        </div>
                        <div class="diagnosis-card primary">
                            <h4 class="fw-bold mb-3">Hasil Diagnosis Utama</h4>
                            <h3 class="text-primary mb-3" id="diagnosisResult">Memuat...</h3>
                            <div class="confidence-badge confidence-medium" id="confidenceBadge">0%</div>
                            <p class="text-muted mt-3">Tingkat kepercayaan diagnosis</p>
                        </div>
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3"><i class="fas fa-stethoscope me-2"></i>Gejala yang Dipilih</h5>
                            <div class="card">
                                <div class="card-body">
                                    <div id="selectedSymptoms">
                                        <div class="alert alert-info">
                                            <i class="fas fa-spinner fa-spin me-2"></i>
                                            Memuat gejala yang dipilih...
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3">Kemungkinan Diagnosis Lainnya</h5>
                            <div id="alternativeDiagnoses">
                                <p class="text-muted">Memuat diagnosis alternatif...</p>
                            </div>
                        </div>
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3"><i class="fas fa-clipboard-list me-2"></i>Rekomendasi Medis</h5>
                            <div id="recommendations">
                                <p class="text-muted">Memuat rekomendasi...</p>
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <button class="btn btn-success btn-lg" onclick="downloadResult()">
                                <i class="fas fa-download me-2"></i>Unduh Hasil
                            </button>
                            <a href="{{ route('diagnosis.index') }}@if(isset($konsultasi)){{ '?id_konsultasi=' . $konsultasi->id_konsultasi }}@endif" 
                               id="consultationButton" class="btn btn-primary btn-lg">
                                <i class="fas fa-redo me-2"></i>Konsultasi Ulang
                            </a>
                            <a href="{{ route('pasien.index') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-home me-2"></i>Kembali ke Beranda
                            </a>
                        </div>
                        <div class="alert alert-warning mt-4" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Penting:</strong> Hasil diagnosis ini hanya sebagai referensi awal. 
                            Untuk diagnosis yang akurat dan penanganan yang tepat, silakan konsultasikan dengan dokter atau tenaga medis profesional.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="notificationContainer"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        let systemData = {
            konsultasi: null,
            diseases: [],
            symptoms: [],
            knowledgeBase: []
        };

        // Initialize data with safe fallbacks
        function initializeData() {
            try {
                if (window.LaravelData) {
                    systemData.konsultasi = window.LaravelData.konsultasi;
                    systemData.diseases = window.LaravelData.diseases || [];
                    systemData.symptoms = window.LaravelData.symptoms || [];
                    systemData.knowledgeBase = window.LaravelData.knowledgeBase || [];
                }
                
                console.log('📊 System Data Initialized:', {
                    konsultasi: systemData.konsultasi ? 'LOADED' : 'NULL',
                    diseases: systemData.diseases.length + ' items',
                    symptoms: systemData.symptoms.length + ' items',
                    knowledgeBase: systemData.knowledgeBase.length + ' items'
                });
                
                return true;
            } catch (error) {
                console.error('Data initialization failed:', error);
                return false;
            }
        }

        // Safe element updates
        function safeUpdateElement(id, content) {
            try {
                const element = document.getElementById(id);
                if (element) {
                    if (typeof content === 'string') {
                        element.innerHTML = content;
                    } else {
                        element.textContent = content;
                    }
                    return true;
                }
                return false;
            } catch (error) {
                console.error(`Error updating element ${id}:`, error);
                return false;
            }
        }

        // Show notification
        function showNotification(message, type = 'info', duration = 5000) {
            const container = document.getElementById('notificationContainer');
            if (!container) return;

            const notification = document.createElement('div');
            notification.className = `alert alert-${type} alert-dismissible fade show notification`;
            
            const iconMap = {
                success: 'fa-check-circle',
                warning: 'fa-exclamation-triangle',
                danger: 'fa-exclamation-circle',
                info: 'fa-info-circle'
            };
            
            const icon = iconMap[type] || iconMap.info;
            
            notification.innerHTML = `
                <i class="fas ${icon} me-2"></i>
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;
            
            container.appendChild(notification);
            
            // Auto remove
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, duration);
        }

        // Display patient information
        function displayPatientInfo() {
            try {
                let name = 'Tidak Diketahui';
                let age = 'N/A';
                let email = 'N/A';
                let date = new Date().toLocaleDateString('id-ID');

                if (systemData.konsultasi && systemData.konsultasi.pasien) {
                    const patient = systemData.konsultasi.pasien;
                    name = patient.nama_pasien || patient.nama || 'Tidak Diketahui';
                    age = patient.usia ? patient.usia + ' tahun' : 'N/A';
                    email = patient.email || 'N/A';
                }

                if (systemData.konsultasi && systemData.konsultasi.created_at) {
                    try {
                        date = new Date(systemData.konsultasi.created_at).toLocaleDateString('id-ID');
                    } catch (e) {
                        date = new Date().toLocaleDateString('id-ID');
                    }
                }

                safeUpdateElement('patientName', name);
                safeUpdateElement('patientAge', age);
                safeUpdateElement('patientEmail', email);
                safeUpdateElement('consultationDate', date);

                console.log('Patient info displayed');
            } catch (error) {
                console.error('Error displaying patient info:', error);
            }
        }

        // Display selected symptoms
        function displaySelectedSymptoms() {
            try {
                const container = document.getElementById('selectedSymptoms');
                if (!container) return;

                if (!systemData.konsultasi || !systemData.konsultasi.detail_konsultasi) {
                    container.innerHTML = `
                        <div class="alert alert-warning">
                            <i class="fas fa-info-circle me-2"></i>
                            Tidak ada data gejala yang tersedia.
                        </div>
                    `;
                    return;
                }

                const details = systemData.konsultasi.detail_konsultasi;
                if (details.length === 0) {
                    container.innerHTML = `
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Tidak ada gejala yang dipilih untuk konsultasi ini.
                        </div>
                    `;
                    return;
                }

                // Sort by confidence
                const sortedDetails = [...details].sort((a, b) => parseFloat(b.cf_pasien) - parseFloat(a.cf_pasien));
                
                let html = `
                    <div class="symptom-summary d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Menampilkan ${details.length} gejala yang dipilih
                        </small>
                        <small class="text-muted">
                            <i class="fas fa-database me-1"></i>
                            Konsultasi ID: ${systemData.konsultasi.id_konsultasi}
                        </small>
                    </div>
                `;

                sortedDetails.forEach(detail => {
                    try {
                        const symptomId = parseInt(detail.id_gejala);
                        const cfPasien = parseFloat(detail.cf_pasien);

                        if (isNaN(symptomId) || isNaN(cfPasien)) return;

                        // Find symptom name
                        const symptom = systemData.symptoms.find(s => parseInt(s.id_gejala) === symptomId);
                        const namaGejala = symptom ? symptom.nama_gejala : `Gejala ID: ${symptomId}`;
                        const kodeGejala = symptom ? symptom.kode_gejala : `G${symptomId.toString().padStart(3, '0')}`;

                        // Determine CF class
                        let cfClass = 'cf-low';
                        let cfLabel = 'Kurang Yakin';
                        
                        if (cfPasien >= 0.8) {
                            cfClass = 'cf-very-high';
                            cfLabel = 'Sangat Yakin';
                        } else if (cfPasien >= 0.6) {
                            cfClass = 'cf-high';
                            cfLabel = 'Yakin';
                        } else if (cfPasien >= 0.4) {
                            cfClass = 'cf-medium';
                            cfLabel = 'Cukup';
                        }

                        const cfPercentage = Math.round(cfPasien * 100);

                        html += `
                            <div class="symptom-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold text-dark">${namaGejala}</div>
                                        <small class="text-muted">
                                            <i class="fas fa-hashtag me-1"></i>${kodeGejala} 
                                            <span class="mx-2">•</span>
                                            <i class="fas fa-user me-1"></i>Tingkat: ${cfLabel}
                                        </small>
                                    </div>
                                    <div class="ms-3">
                                        <span class="cf-badge ${cfClass}">
                                            ${cfPercentage}%
                                        </span>
                                    </div>
                                </div>
                            </div>
                        `;
                    } catch (err) {
                        console.error('Error processing symptom detail:', err, detail);
                    }
                });

                container.innerHTML = html;
                console.log('Selected symptoms displayed');
            } catch (error) {
                console.error('Error displaying symptoms:', error);
                safeUpdateElement('selectedSymptoms', `
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Error memuat gejala: ${error.message}
                    </div>
                `);
            }
        }

        // Calculate CF for a specific disease
        function calculateCF(userSymptoms, diseaseCode) {
            try {
                if (!userSymptoms || !diseaseCode || !systemData.knowledgeBase) return 0;

                const diseaseRules = systemData.knowledgeBase.filter(rule => rule.kode_penyakit === diseaseCode);
                if (diseaseRules.length === 0) return 0;

                let cfCombined = 0;
                let hasMatches = false;

                diseaseRules.forEach(rule => {
                    try {
                        const symptomId = parseInt(rule.id_gejala);
                        const cfExpert = parseFloat(rule.cf_pakar);

                        if (isNaN(symptomId) || isNaN(cfExpert)) return;

                        const userSymptom = userSymptoms.find(detail => parseInt(detail.id_gejala) === symptomId);
                        
                        if (userSymptom && userSymptom.cf_pasien !== undefined) {
                            const cfUser = parseFloat(userSymptom.cf_pasien);
                            if (isNaN(cfUser)) return;

                            hasMatches = true;
                            const cfEvidence = cfUser * cfExpert;

                            if (cfCombined === 0) {
                                cfCombined = cfEvidence;
                            } else {
                                cfCombined = cfCombined + cfEvidence - (cfCombined * cfEvidence);
                            }
                        }
                    } catch (error) {
                        console.error('Error processing rule:', error);
                    }
                });

                return hasMatches ? Math.max(cfCombined * 100, 0) : 0;
            } catch (error) {
                console.error('Error calculating CF:', error);
                return 0;
            }
        }
        async function saveDiagnosisResult(diagnosisName, confidenceLevel, konsultasiId) {
            try {
                console.log('Saving diagnosis result to database...', {
                    diagnosis: diagnosisName,
                    confidence: confidenceLevel,
                    konsultasiId: konsultasiId
                });

                // Get CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                if (!csrfToken) {
                    throw new Error('CSRF token tidak ditemukan');
                }

                // Prepare the data
                const requestData = {
                    id_konsultasi: konsultasiId,
                    hasil_diagnosa: diagnosisName,
                    tingkat_keyakinan: confidenceLevel
                };

                console.log('Sending request data:', requestData);

                // Try multiple possible endpoints
                const possibleEndpoints = [
                    '/diagnosis/save-result',
                    '/api/save-diagnosis-result', 
                    '/save-diagnosis-result',
                    window.routes?.saveDiagnosis
                ].filter(url => url); // Remove nulls

                let lastError = null;
                
                for (const endpoint of possibleEndpoints) {
                    try {
                        console.log(`Trying endpoint: ${endpoint}`);
                        
                        const response = await fetch(endpoint, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify(requestData)
                        });

                        console.log(`Response status: ${response.status}`);
                        
                        if (response.ok) {
                            const result = await response.json();
                            console.log('Diagnosis result saved successfully:', result);
                            return { success: true, data: result, endpoint: endpoint };
                        } else {
                            const errorText = await response.text();
                            console.error(`Error from ${endpoint} (${response.status}):`, errorText);
                            
                            // Try to parse as JSON for better error info
                            try {
                                const errorData = JSON.parse(errorText);
                                lastError = errorData;
                            } catch (e) {
                                lastError = { message: errorText || `HTTP ${response.status}` };
                            }
                        }
                    } catch (fetchError) {
                        console.error(`Network error for ${endpoint}:`, fetchError);
                        lastError = { message: fetchError.message };
                    }
                }

                // If all endpoints failed
                return { 
                    success: false, 
                    error: lastError?.message || 'Semua endpoint gagal',
                    details: lastError
                };

            } catch (error) {
                console.error('Critical error in saveDiagnosisResult:', error);
                return { success: false, error: error.message };
            }
        }

        // Perform actual diagnosis with CF calculation
        function displayDiagnosis() {
            try {
                if (!systemData.konsultasi || !systemData.konsultasi.detail_konsultasi || 
                    systemData.diseases.length === 0 || systemData.knowledgeBase.length === 0) {
                    
                    safeUpdateElement('diagnosisResult', 'Data Tidak Lengkap');
                    safeUpdateElement('confidenceBadge', 'N/A');
                    safeUpdateElement('alternativeDiagnoses', `
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Data tidak lengkap untuk melakukan diagnosis.
                        </div>
                    `);
                    safeUpdateElement('recommendations', `
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Silakan lakukan konsultasi lengkap untuk mendapatkan diagnosis dan rekomendasi.
                        </div>
                    `);
                    return;
                }

                // Calculate CF for each disease
                const results = [];
                const userSymptoms = systemData.konsultasi.detail_konsultasi;

                systemData.diseases.forEach(disease => {
                    try {
                        if (!disease.kode_penyakit) return;

                        const cf = calculateCF(userSymptoms, disease.kode_penyakit);
                        
                        if (cf > 0) {
                            let recommendations = [];
                            if (disease.penanganan) {
                                recommendations = disease.penanganan.split(/\n|;|\|/).map(rec => rec.trim()).filter(rec => rec);
                            }
                            
                            if (recommendations.length === 0) {
                                recommendations = ['Konsultasikan dengan dokter untuk penanganan lebih lanjut'];
                            }

                            results.push({
                                name: disease.nama_penyakit || 'Unknown Disease',
                                confidence: cf,
                                recommendations: recommendations,
                                key: disease.kode_penyakit,
                                description: disease.penjelasan || ''
                            });
                        }
                    } catch (error) {
                        console.error('Error processing disease:', disease, error);
                    }
                });

                // Sort by confidence
                results.sort((a, b) => b.confidence - a.confidence);

                // Add normal condition if no significant results
                if (results.length === 0 || (results.length > 0 && results[0].confidence < 30)) {
                    results.unshift({
                        name: 'Kondisi Normal',
                        confidence: 85,
                        recommendations: [
                            'Pertahankan pola hidup sehat',
                            'Kontrol kehamilan rutin sesuai jadwal',
                            'Konsumsi makanan bergizi seimbang',
                            'Istirahat yang cukup dan kelola stress'
                        ],
                        key: 'normal',
                        description: 'Berdasarkan gejala yang dianalisis, kondisi Anda tergolong normal.'
                    });
                }

                // Display primary diagnosis
                if (results.length > 0) {
                    const primaryResult = results[0];
                    const roundedConfidence = Math.round(primaryResult.confidence);
                    
                    safeUpdateElement('diagnosisResult', primaryResult.name);
                    safeUpdateElement('confidenceBadge', `${roundedConfidence}%`);
                    
                    // Set confidence badge style
                    const badgeEl = document.getElementById('confidenceBadge');
                    if (badgeEl) {
                        badgeEl.className = 'confidence-badge ';
                        if (primaryResult.confidence >= 70) {
                            badgeEl.className += 'confidence-high';
                        } else if (primaryResult.confidence >= 50) {
                            badgeEl.className += 'confidence-medium';
                        } else {
                            badgeEl.className += 'confidence-low';
                        }
                    }

                    // Set header color based on diagnosis
                    const headerEl = document.getElementById('resultHeader');
                    if (headerEl) {
                        if (primaryResult.name.toLowerCase().includes('eklampsia')) {
                            headerEl.className = 'result-header danger';
                        } else if (primaryResult.name.toLowerCase().includes('preeklampsia berat')) {
                            headerEl.className = 'result-header danger';
                        } else if (primaryResult.name.toLowerCase().includes('preeklampsia')) {
                            headerEl.className = 'result-header warning';
                        } else {
                            headerEl.className = 'result-header';
                        }
                    }

                    // Display alternative diagnoses
                    const alternatives = results.slice(1, 4).filter(alt => alt.confidence > 20);
                    let altHtml = '';
                    
                    if (alternatives.length > 0) {
                        alternatives.forEach(alt => {
                            altHtml += `
                                <div class="d-flex justify-content-between align-items-center border rounded p-3 mb-2">
                                    <div>
                                        <span class="fw-semibold">${alt.name}</span>
                                        ${alt.description ? `<small class="text-muted d-block">${alt.description.substring(0, 100)}${alt.description.length > 100 ? '...' : ''}</small>` : ''}
                                    </div>
                                    <span class="badge bg-secondary">${Math.round(alt.confidence)}%</span>
                                </div>
                            `;
                        });
                    } else {
                        altHtml = '<p class="text-muted">Tidak ada diagnosis alternatif dengan tingkat kepercayaan yang signifikan.</p>';
                    }
                    
                    safeUpdateElement('alternativeDiagnoses', altHtml);

                    // Display recommendations
                    let recHtml = '';
                    if (primaryResult.recommendations && primaryResult.recommendations.length > 0) {
                        primaryResult.recommendations.forEach((rec, index) => {
                            if (rec && rec.trim()) {
                                recHtml += `
                                    <div class="recommendation-card">
                                        <div class="d-flex align-items-start">
                                            <div class="badge bg-primary rounded-circle me-3" style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">
                                                ${index + 1}
                                            </div>
                                            <div>${rec.trim()}</div>
                                        </div>
                                    </div>
                                `;
                            }
                        });
                    }
                    
                    if (!recHtml) {
                        recHtml = '<p class="text-muted">Tidak ada rekomendasi khusus untuk kondisi ini.</p>';
                    }
                    
                    safeUpdateElement('recommendations', recHtml);

                    console.log('Diagnosis completed:', primaryResult.name, `${roundedConfidence}%`);
                    
                    // SAVE DIAGNOSIS RESULT TO DATABASE
                    if (systemData.konsultasi && systemData.konsultasi.id_konsultasi) {
                        const konsultasiId = systemData.konsultasi.id_konsultasi;
                        
                        // Convert confidence from percentage (0-100) to decimal (0-1) for database storage
                        const confidenceDecimal = primaryResult.confidence / 100;
                        
                        saveDiagnosisResult(primaryResult.name, confidenceDecimal, konsultasiId)
                            .then(saveResult => {
                                if (saveResult.success) {
                                    console.log('Diagnosis saved to database successfully');
                                } else {
                                    console.error('Failed to save diagnosis to database:', saveResult.error);
                                    showNotification('Peringatan: Gagal menyimpan hasil diagnosis.', 'warning');
                                }
                            })
                            .catch(error => {
                                console.error('Error saving diagnosis:', error);
                                showNotification('Error: Tidak dapat menyimpan hasil diagnosis.', 'danger');
                            });
                    } else {
                        console.warn('Cannot save diagnosis: konsultasi ID not found');
                    }
                    
                } else {
                    safeUpdateElement('diagnosisResult', 'Tidak Dapat Mendiagnosis');
                    safeUpdateElement('confidenceBadge', '0%');
                    safeUpdateElement('alternativeDiagnoses', '<p class="text-muted">Tidak ada hasil diagnosis.</p>');
                    safeUpdateElement('recommendations', '<p class="text-muted">Tidak ada rekomendasi tersedia.</p>');
                }

            } catch (error) {
                console.error('Error in diagnosis:', error);
                safeUpdateElement('diagnosisResult', 'Error Diagnosis');
                safeUpdateElement('confidenceBadge', 'N/A');
                showNotification('Terjadi kesalahan saat memproses diagnosis.', 'danger');
            }
        }

        // Show debug information (hanya untuk development)
        function showDebugInfo() {
            @if(config('app.debug'))
            try {
                const debugEl = document.getElementById('debugInfo');
                const contentEl = document.getElementById('debugContent');
                
                if (!debugEl || !contentEl) return;

                const debugData = {
                    'Konsultasi': systemData.konsultasi ? `ID: ${systemData.konsultasi.id_konsultasi}` : 'NULL',
                    'Detail Konsultasi': systemData.konsultasi && systemData.konsultasi.detail_konsultasi ? 
                        `${systemData.konsultasi.detail_konsultasi.length} items` : '0 items',
                    'Penyakit': `${systemData.diseases.length} items`,
                    'Gejala': `${systemData.symptoms.length} items`,
                    'Basis Pengetahuan': `${systemData.knowledgeBase.length} items`,
                    'Routes': window.routes
                };
                
                let html = '<table class="table table-sm"><tbody>';
                Object.entries(debugData).forEach(([key, value]) => {
                    const displayValue = typeof value === 'object' ? JSON.stringify(value) : value;
                    html += `<tr><td><strong>${key}:</strong></td><td style="word-break: break-all;">${displayValue}</td></tr>`;
                });
                html += '</tbody></table>';
                
                contentEl.innerHTML = html;
                debugEl.style.display = 'block';
                
                console.log('Debug info displayed');
            } catch (error) {
                console.error('Error showing debug info:', error);
            }
            @endif
        }

        // Toggle debug info
        function toggleDebugInfo() {
            @if(config('app.debug'))
            const debugEl = document.getElementById('debugInfo');
            if (debugEl) {
                debugEl.style.display = debugEl.style.display === 'none' ? 'block' : 'none';
            }
            @endif
        }

        // Download result function (Enhanced with PDF)
        async function downloadResult() {
            try {
                // Check if jsPDF is available
                if (typeof window.jspdf === 'undefined') {
                    // Fallback to text download
                    downloadTextResult();
                    return;
                }

                const { jsPDF } = window.jspdf;
                const result = document.getElementById('diagnosisResult').textContent || 'Tidak diketahui';
                const confidence = document.getElementById('confidenceBadge').textContent || '0%';
                const patientName = document.getElementById('patientName').textContent || 'Pasien';
                const currentDate = new Date().toLocaleDateString('id-ID');

                const doc = new jsPDF();

                // Header
                doc.setFontSize(18);
                doc.setTextColor(40, 40, 40);
                doc.setFont('helvetica', 'bold');
                doc.text("Hasil Diagnosis HyperCare", 105, 20, null, null, 'center');

                // Line
                doc.setDrawColor(100, 100, 100);
                doc.line(20, 25, 190, 25);

                // Patient Info
                doc.setFontSize(12);
                doc.setFont('helvetica', 'normal');
                doc.setTextColor(60, 60, 60);
                doc.text(`Tanggal: ${currentDate}`, 20, 35);
                doc.text(`Nama Pasien: ${patientName}`, 20, 43);

                // Diagnosis
                doc.setFontSize(14);
                doc.setFont('helvetica', 'bold');
                doc.setTextColor(0, 0, 128);
                doc.text("Diagnosis Utama", 20, 60);

                doc.setFontSize(12);
                doc.setFont('helvetica', 'normal');
                doc.setTextColor(50, 50, 50);
                doc.text(result, 20, 68);

                doc.setTextColor(0, 100, 0);
                doc.text(`Tingkat Kepercayaan: ${confidence}`, 20, 76);

                // Line
                doc.setDrawColor(200, 200, 200);
                doc.line(20, 85, 190, 85);

                // Disclaimer
                doc.setFontSize(11);
                doc.setTextColor(100, 0, 0);
                doc.setFont('helvetica', 'bold');
                doc.text("DISCLAIMER:", 20, 95);

                doc.setFont('helvetica', 'normal');
                doc.setTextColor(80, 80, 80);
                const disclaimer = [
                    "Hasil diagnosis ini hanya sebagai referensi awal.",
                    "Untuk diagnosis yang akurat dan penanganan yang tepat,",
                    "silakan konsultasikan dengan dokter atau tenaga medis profesional."
                ];
                doc.text(disclaimer, 20, 103);

                // Footer
                doc.setFontSize(10);
                doc.setTextColor(150, 150, 150);
                doc.text("Generated by HyperCare", 105, 280, null, null, 'center');

                // Save PDF
                const filename = `Hasil_Diagnosis_${patientName.replace(/\s+/g, '_')}_${currentDate.replace(/\//g, '-')}.pdf`;
                doc.save(filename);

                console.log('PDF Download completed');
                showNotification('Hasil diagnosis berhasil diunduh!', 'success');

            } catch (error) {
                console.error('Error generating PDF:', error);
                downloadTextResult(); // Fallback
            }
        }

        // Fallback text download
        function downloadTextResult() {
            try {
                const result = document.getElementById('diagnosisResult').textContent || 'Tidak diketahui';
                const confidence = document.getElementById('confidenceBadge').textContent || '0%';
                const patientName = document.getElementById('patientName').textContent || 'Pasien';
                const currentDate = new Date().toLocaleDateString('id-ID');
                
                const content = `
                === HASIL DIAGNOSIS HYPERCARE ===

                Tanggal: ${currentDate}
                Pasien: ${patientName}

                DIAGNOSIS UTAMA:
                ${result}
                Tingkat Kepercayaan: ${confidence}

                DISCLAIMER:
                Hasil diagnosis ini hanya sebagai referensi awal.
                Untuk diagnosis yang akurat dan penanganan yang tepat,
                silakan konsultasikan dengan dokter atau tenaga medis profesional.

                Generated by HyperCare System
                `.trim();
                
                const blob = new Blob([content], { type: 'text/plain' });
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `Hasil_Diagnosis_${patientName.replace(/\s+/g, '_')}_${currentDate.replace(/\//g, '-')}.txt`;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
                
                console.log('Text download completed');
                showNotification('Hasil diagnosis berhasil diunduh!', 'success');
                
            } catch (error) {
                console.error('Error downloading text result:', error);
                showNotification('Terjadi kesalahan saat mengunduh hasil.', 'danger');
            }
        }

        // Main initialization
        function initializeSystem() {
            console.log('HyperCare Diagnosis System Starting...');
            
            try {
                // Initialize data
                const dataLoaded = initializeData();
                if (!dataLoaded) {
                    throw new Error('Failed to initialize data');
                }

                // Display components
                displayPatientInfo();
                displaySelectedSymptoms();
                displayDiagnosis();
                showDebugInfo();

                // Show content
                const loadingEl = document.getElementById('loadingState');
                const contentEl = document.getElementById('mainContent');
                
                if (loadingEl) loadingEl.style.display = 'none';
                if (contentEl) contentEl.style.display = 'block';

                console.log('System initialized successfully');
                
            } catch (error) {
                console.error('System initialization failed:', error);
                
                // Show error state
                const loadingEl = document.getElementById('loadingState');
                if (loadingEl) {
                    loadingEl.innerHTML = `
                        <div class="alert alert-danger w-100">
                            <div class="text-center">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Error:</strong> ${error.message}
                                <br><small>Silakan refresh halaman atau hubungi administrator.</small>
                                <hr>
                                <button class="btn btn-primary" onclick="location.reload()">
                                    <i class="fas fa-redo me-2"></i>Refresh Halaman
                                </button>
                            </div>
                        </div>
                    `;
                }
                
                showNotification('Terjadi kesalahan saat memuat sistem.', 'danger');
            }
        }

        // Start system when page loads
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(initializeSystem, 100);
        });

        // Emergency fallback
        setTimeout(() => {
            const loadingEl = document.getElementById('loadingState');
            if (loadingEl && loadingEl.style.display !== 'none') {
                console.warn('Emergency fallback activated');
                initializeSystem();
            }
        }, 3000);
    </script>
</body>
</html>