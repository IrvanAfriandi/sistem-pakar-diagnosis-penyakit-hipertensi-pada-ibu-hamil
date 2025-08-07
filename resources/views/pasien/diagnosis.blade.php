<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HyperCare</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.svg') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            --danger-color: #EF4444;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--primary-light) 0%, white 100%);
            min-height: 100vh;
        }
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 0;
        }
        .form-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .form-header {
            background: var(--primary-color);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .form-body {
            padding: 40px;
        }
        .symptom-card {
            border: 2px solid #E5E7EB;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }
        .symptom-card:hover {
            border-color: var(--primary-color);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
        }
        .symptom-card.has-value {
            border-color: var(--success-color);
            background-color: #F0FDF4;
        }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 15px 40px;
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
        .step.active {
            background-color: var(--primary-color);
            color: white;
        }
        .step.inactive {
            background-color: #E5E7EB;
            color: var(--text-muted);
        }
        .step-connector {
            width: 50px;
            height: 2px;
            background-color: #E5E7EB;
            margin-top: 20px;
        }
        .step-connector.completed {
            background-color: var(--success-color);
        }
        .progress-bar {
            height: 8px;
            border-radius: 10px;
        }
        .slider-container {
            position: relative;
            margin: 20px 0;
            padding: 0 5px;
        }
        .slider {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            width: 100%;
            height: 10px;
            border-radius: 10px;
            background: transparent;
            outline: none;
            position: relative;
            z-index: 2;
        }
        .slider-track {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 10px;
            background: #E5E7EB;
            border-radius: 10px;
            transform: translateY(-50%);
            z-index: 0;
        }
        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: var(--primary-color);
            cursor: pointer;
            border: 3px solid white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(0, 0, 0, 0.05);
            transition: all 0.15s ease-out;
            transform: translateY(1px);
        }
        .slider::-webkit-slider-thumb:hover {
            background: #2563EB;
            transform: translateY(1px) scale(1.1);
            box-shadow: 0 4px 16px rgba(37, 99, 235, 0.3), 0 0 0 1px rgba(0, 0, 0, 0.05);
        }
        .slider::-webkit-slider-thumb:active {
            transform: translateY(1px) scale(1.05);
            background: #1D4ED8;
        }
        .slider::-moz-range-thumb {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: var(--primary-color);
            cursor: pointer;
            border: 3px solid white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            transition: all 0.15s ease-out;
        }
        .slider::-moz-range-thumb:hover {
            background: #2563EB;
            transform: scale(1.1);
            box-shadow: 0 4px 16px rgba(37, 99, 235, 0.3);
        }
        .slider::-moz-range-track {
            height: 10px;
            background: transparent;
            border-radius: 10px;
        }
        .slider-value {
            text-align: center;
            margin-top: 12px;
            font-weight: 600;
            color: var(--primary-color);
            min-height: 24px;
            font-size: 14px;
            transition: all 0.2s ease-out;
        }
        .slider-track-fill {
            position: absolute;
            top: 50%;
            left: 0;
            height: 10px;
            background: linear-gradient(90deg, 
                rgba(59, 130, 246, 0.3) 0%, 
                rgba(59, 130, 246, 0.6) 50%, 
                var(--success-color) 100%);
            border-radius: 10px;
            transform: translateY(-50%);
            transition: width 0.2s ease-out;
            z-index: 1;
            box-shadow: 0 0 10px rgba(59, 130, 246, 0.2);
        }
        .slider-container:hover .slider-track-fill {
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.3);
        }
        .symptom-card {
            transition: all 0.3s ease-out;
        }
        .symptom-card.has-value {
            border-color: var(--success-color);
            background-color: #F0FDF4;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.15);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="step-indicator">
                <div class="step completed">
                    <i class="fas fa-check"></i>
                </div>
                <div class="step-connector completed"></div>
                <div class="step active">2</div>
                <div class="step-connector"></div>
                <div class="step inactive">3</div>
            </div>
            <div class="form-card">
                <div class="form-header">
                    <i class="fas fa-stethoscope fa-3x mb-3"></i>
                    <h2 class="mb-0">Diagnosis Gejala</h2>
                    <p class="mb-0 mt-2 opacity-75">Langkah 2 dari 3</p>
                </div>
                <div class="form-body">
                    <div class="alert alert-warning border-0" style="background-color: #FEF3CD;">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Geser slider</strong> sesuai dengan tingkat gejala yang Anda rasakan. Semakin ke kanan semakin tinggi tingkat gejalanya.
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <small class="text-muted">Progress Diagnosis</small>
                            <small class="text-muted"><span id="progressText">0/<span id="totalSymptomsCount">{{ isset($gejala) ? count($gejala) : 0 }}</span></span> gejala</small>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 0%" id="progressBar"></div>
                        </div>
                    </div>
                    <form id="diagnosisForm">
                        @csrf
                        <input type="hidden" name="id_konsultasi" value="{{ request('id_konsultasi') }}">
                        <div id="symptomsContainer">
                            @if(isset($gejala) && count($gejala) > 0)
                                @foreach($gejala as $index => $symptom)
                                <div class="symptom-card" id="symptom-{{ $symptom->id_gejala }}">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <p class="mb-0 text-muted">{{ $symptom->kode_gejala ?? 'G' . str_pad($loop->iteration, 3, '0', STR_PAD_LEFT) }}</p>
                                            <h6 class="mb-1 fw-semibold">{{ $symptom->nama_gejala ?? 'Nama Gejala Tidak Tersedia' }}</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="slider-container">
                                                <div class="slider-track"></div>
                                                <div class="slider-track-fill" id="track-fill-{{ $symptom->id_gejala }}"></div>
                                                <input type="range" 
                                                       min="0" 
                                                       max="1" 
                                                       value="0" 
                                                       step="0.01" 
                                                       class="slider symptom-slider" 
                                                       id="slider-{{ $symptom->id_gejala }}"
                                                       data-symptom-id="{{ $symptom->id_gejala }}">
                                                <div class="slider-value" id="value-{{ $symptom->id_gejala }}">Tidak Ada Gejala</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Tidak ada data gejala yang tersedia. Pastikan data gejala sudah ada di database.
                                </div>
                            @endif
                        </div>
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg" id="diagnoseBtn">
                                <i class="fas fa-search me-2"></i>Diagnosa Sekarang
                            </button>
                            <a href="{{ route('pasien.create') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Biodata
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center mt-4">
                <div class="row text-muted">
                    <div class="col-4">
                        <i class="fas fa-user-check text-success"></i>
                        <div class="small mt-1">Biodata</div>
                    </div>
                    <div class="col-4">
                        <i class="fas fa-stethoscope text-primary"></i>
                        <div class="small mt-1">Diagnosis</div>
                    </div>
                    <div class="col-4">
                        <i class="fas fa-file-medical"></i>
                        <div class="small mt-1">Hasil</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sliderLabels = [
            'Tidak Ada',
            'Sedikit',
            'Mungkin Iya',
            'Cukup Iya',
            'Sangat Iya'
        ];
        let selectedSymptoms = {};
        let totalSymptoms = 0;
        document.addEventListener('DOMContentLoaded', function() {
            const totalSymptomsElement = document.getElementById('totalSymptomsCount');
            if (totalSymptomsElement) {
                totalSymptoms = parseInt(totalSymptomsElement.textContent) || 0;
            }
            const sliders = document.querySelectorAll('.symptom-slider');
            sliders.forEach(function(slider) {
                const symptomId = slider.dataset.symptomId;
                slider.addEventListener('input', function() {
                    updateSlider(symptomId, this.value);
                    updateProgress();
                });
                slider.addEventListener('mouseenter', function() {
                    const container = this.parentElement;
                    container.style.transform = 'translateY(-2px)';
                });
                slider.addEventListener('mouseleave', function() {
                    const container = this.parentElement;
                    container.style.transform = 'translateY(0)';
                });
                updateSlider(symptomId, 0);
            });
            const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            if (csrfTokenMeta) {
                window.csrfToken = csrfTokenMeta.getAttribute('content');
            }
        });
        function updateSlider(symptomId, value) {
            const floatValue = parseFloat(value);
            const valueElement = document.getElementById('value-' + symptomId);
            const trackFill = document.getElementById('track-fill-' + symptomId);
            const card = document.getElementById('symptom-' + symptomId);
            if (!valueElement || !trackFill || !card) return;
            const percentage = floatValue * 100;
            trackFill.style.width = percentage + '%';
            let labelText;
            if (floatValue === 0) {
                labelText = 'Tidak Ada';
            } else if (floatValue <= 0.25) {
                labelText = 'Sedikit';
            } else if (floatValue <= 0.5) {
                labelText = 'Mungkin Iya';
            } else if (floatValue <= 0.75) {
                labelText = 'Cukup Iya';
            } else {
                labelText = 'Sangat Iya';
            }
            valueElement.textContent = labelText;
            if (floatValue > 0) {
                card.classList.add('has-value');
                selectedSymptoms[symptomId] = floatValue;
            } else {
                card.classList.remove('has-value');
                delete selectedSymptoms[symptomId];
            }
        }
        function updateProgress() {
            const completedSymptoms = Object.keys(selectedSymptoms).length;
            const percentage = totalSymptoms > 0 ? (completedSymptoms / totalSymptoms) * 100 : 0;
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');
            if (progressBar) {
                progressBar.style.width = percentage + '%';
            }
            if (progressText) {
                progressText.textContent = completedSymptoms + '/' + totalSymptoms;
            }
        }
        document.getElementById('diagnosisForm').addEventListener('submit', function(e) {
            e.preventDefault();
            if (Object.keys(selectedSymptoms).length === 0) {
                alert('Mohon pilih minimal satu gejala sebelum melanjutkan diagnosis.');
                return;
            }
            const btn = document.getElementById('diagnoseBtn');
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sedang memproses...';
            const formData = new FormData();
            if (window.csrfToken) {
                formData.append('_token', window.csrfToken);
            }
            formData.append('id_konsultasi', '{{ request("id_konsultasi") }}');
            for (const symptomId in selectedSymptoms) {
                if (selectedSymptoms.hasOwnProperty(symptomId)) {
                    const cfValue = selectedSymptoms[symptomId];
                    formData.append('gejala[]', JSON.stringify({
                        id_gejala: symptomId,
                        cf_pasien: cfValue
                    }));
                }
            }

            const submitUrl = '{{ route("diagnosis.store") }}';
            fetch(submitUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': window.csrfToken || ''
                }
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                    if (data.success) {
                        // Ganti dengan ID konsultasi dari Blade (misalnya dari request atau variabel)
                        window.location.href = "{{ route('diagnosis.show', request('id_konsultasi')) }}";
                    } else {
                        throw new Error(data.message || 'Terjadi kesalahan');
                    }
                })
            .catch(function(error) {
                alert('Terjadi kesalahan: ' + error.message);
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-search me-2"></i>Diagnosa Sekarang';
            });
        });
    </script>
</body>
</html>