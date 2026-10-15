<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

require __DIR__ . '/../../vendor/autoload.php';
$app = require __DIR__ . '/../../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

User::updateOrCreate(['email' => 'admin.screenshot@example.test'], [
    'name' => 'Admin Demo', 'password' => Hash::make('demo1234'), 'role' => User::ROLE_ADMIN,
]);
User::updateOrCreate(['email' => 'petugas.screenshot@example.test'], [
    'name' => 'Petugas Demo', 'password' => Hash::make('demo1234'), 'role' => User::ROLE_PETUGAS,
]);

$patients = [
    ['nama_pasien'=>'Alya Pratama','usia'=>27,'email'=>'alya.demo@example.test','alamat'=>'Jl. Melati Fiktif No. 12'],
    ['nama_pasien'=>'Bella Maharani','usia'=>31,'email'=>'bella.demo@example.test','alamat'=>'Jl. Kenanga Fiktif No. 8'],
    ['nama_pasien'=>'Citra Lestari','usia'=>25,'email'=>'citra.demo@example.test','alamat'=>'Jl. Anggrek Fiktif No. 21'],
    ['nama_pasien'=>'Dina Permata','usia'=>29,'email'=>'dina.demo@example.test','alamat'=>'Jl. Flamboyan Fiktif No. 4'],
    ['nama_pasien'=>'Eka Wulandari','usia'=>33,'email'=>'eka.demo@example.test','alamat'=>'Jl. Mawar Fiktif No. 17'],
    ['nama_pasien'=>'Farah Nirmala','usia'=>24,'email'=>'farah.demo@example.test','alamat'=>'Jl. Dahlia Fiktif No. 6'],
    ['nama_pasien'=>'Gita Amalia','usia'=>30,'email'=>'gita.demo@example.test','alamat'=>'Jl. Teratai Fiktif No. 19'],
    ['nama_pasien'=>'Hana Safitri','usia'=>28,'email'=>'hana.demo@example.test','alamat'=>'Jl. Cempaka Fiktif No. 10'],
    ['nama_pasien'=>'Intan Sari','usia'=>26,'email'=>'intan.demo@example.test','alamat'=>'Jl. Bougenville Fiktif No. 3'],
    ['nama_pasien'=>'Jihan Larasati','usia'=>32,'email'=>'jihan.demo@example.test','alamat'=>'Jl. Kamboja Fiktif No. 15'],
    ['nama_pasien'=>'Kirana Putri','usia'=>23,'email'=>'kirana.demo@example.test','alamat'=>'Jl. Sakura Fiktif No. 9'],
    ['nama_pasien'=>'Laras Ayuningtyas','usia'=>35,'email'=>'laras.demo@example.test','alamat'=>'Jl. Tulip Fiktif No. 25'],
];
foreach ($patients as $patient) DB::table('pasien')->insertOrIgnore($patient);

$diseases = [
    ['kode_penyakit'=>'P01','nama_penyakit'=>'Hipertensi Gestasional','penjelasan'=>'Tekanan darah tinggi yang muncul selama kehamilan.','penanganan'=>'Konsultasikan hasil dengan tenaga kesehatan dan pantau tekanan darah.'],
    ['kode_penyakit'=>'P02','nama_penyakit'=>'Preeklamsia Ringan','penjelasan'=>'Kondisi kehamilan dengan tekanan darah tinggi dan tanda pendukung.','penanganan'=>'Diperlukan pemantauan rutin sesuai arahan tenaga kesehatan.'],
    ['kode_penyakit'=>'P03','nama_penyakit'=>'Preeklamsia Berat','penjelasan'=>'Kondisi serius yang memerlukan perhatian medis segera.','penanganan'=>'Segera hubungi fasilitas kesehatan untuk pemeriksaan lebih lanjut.'],
    ['kode_penyakit'=>'P04','nama_penyakit'=>'Hipotensi Kehamilan','penjelasan'=>'Tekanan darah lebih rendah dari rentang normal saat hamil.','penanganan'=>'Istirahat cukup, hidrasi, dan konsultasikan keluhan.'],
    ['kode_penyakit'=>'P05','nama_penyakit'=>'Anemia Kehamilan','penjelasan'=>'Kondisi ketika kadar hemoglobin ibu hamil rendah.','penanganan'=>'Periksakan kadar hemoglobin dan ikuti saran tenaga kesehatan.'],
    ['kode_penyakit'=>'P06','nama_penyakit'=>'Edema Kehamilan','penjelasan'=>'Pembengkakan yang dapat muncul pada kaki atau tangan selama hamil.','penanganan'=>'Pantau perubahan dan konsultasikan bila memburuk.'],
    ['kode_penyakit'=>'P07','nama_penyakit'=>'Mual Kehamilan','penjelasan'=>'Keluhan mual yang umum terjadi pada masa kehamilan.','penanganan'=>'Atur pola makan dan konsultasikan bila mengganggu aktivitas.'],
    ['kode_penyakit'=>'P08','nama_penyakit'=>'Risiko Hipertensi','penjelasan'=>'Kumpulan faktor yang perlu dipantau terkait tekanan darah.','penanganan'=>'Lakukan pemeriksaan berkala dan jaga pola hidup sehat.'],
];
foreach ($diseases as $disease) DB::table('penyakit')->insertOrIgnore($disease);

$symptoms = [
    ['kode_gejala'=>'G01','nama_gejala'=>'Sakit kepala berulang'], ['kode_gejala'=>'G02','nama_gejala'=>'Pandangan terasa kabur'],
    ['kode_gejala'=>'G03','nama_gejala'=>'Mual dan muntah'], ['kode_gejala'=>'G04','nama_gejala'=>'Pembengkakan pada kaki'],
    ['kode_gejala'=>'G05','nama_gejala'=>'Nyeri ulu hati'], ['kode_gejala'=>'G06','nama_gejala'=>'Mudah merasa lelah'],
    ['kode_gejala'=>'G07','nama_gejala'=>'Pusing saat berdiri'], ['kode_gejala'=>'G08','nama_gejala'=>'Tekanan darah meningkat'],
    ['kode_gejala'=>'G09','nama_gejala'=>'Nafsu makan menurun'], ['kode_gejala'=>'G10','nama_gejala'=>'Wajah dan tangan membengkak'],
    ['kode_gejala'=>'G11','nama_gejala'=>'Jantung berdebar'], ['kode_gejala'=>'G12','nama_gejala'=>'Sulit beristirahat'],
];
foreach ($symptoms as $symptom) DB::table('gejala')->insertOrIgnore($symptom);

$diseaseIds = DB::table('penyakit')->pluck('id_penyakit', 'kode_penyakit');
$symptomIds = DB::table('gejala')->pluck('id_gejala', 'kode_gejala');
$rules = [];
foreach (array_keys($diseaseIds->toArray()) as $dIndex => $dCode) {
    foreach (array_keys($symptomIds->toArray()) as $sIndex => $sCode) {
        if (($dIndex + $sIndex) % 3 === 0) $rules[] = ['id_penyakit'=>$diseaseIds[$dCode], 'id_gejala'=>$symptomIds[$sCode], 'cf_pakar'=>round(0.55 + (($dIndex + $sIndex) % 5) * 0.09, 2)];
    }
}
DB::table('basis_pengetahuan')->insertOrIgnore($rules);

$patientIds = DB::table('pasien')->pluck('id_pasien')->values();
$ruleRows = DB::table('basis_pengetahuan')->get(['id_penyakit','id_gejala','cf_pakar']);
foreach ($patientIds->take(8) as $index => $patientId) {
    $consultId = DB::table('konsultasi')->insertGetId(['id_pasien'=>$patientId, 'tanggal'=>now()->subDays(8 - $index)->toDateString(), 'hasil_diagnosa'=>'Hipertensi Gestasional', 'tingkat_keyakinan'=>round(0.72 + ($index % 4) * 0.05, 2)]);
    foreach ($ruleRows->where('id_penyakit', $diseaseIds['P01'])->take(4) as $rule) {
        DB::table('detail_konsultasi')->insert(['id_konsultasi'=>$consultId, 'id_gejala'=>$rule->id_gejala, 'cf_pasien'=>round(0.65 + ($index % 3) * 0.1, 2)]);
    }
}

echo "Dummy data ready\n";
