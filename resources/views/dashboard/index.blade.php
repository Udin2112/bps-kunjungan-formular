@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- 🔹 Header Halaman -->
    <div class="p-4 mb-4 rounded-3 shadow text-white header-modern">
        <h3 class="fw-bold mb-1">
            <i class="bi bi-database-fill-check me-2 text-warning"></i> Database Kunjungan Total Tamu
        </h3>
        <p class="mb-0">Berikut adalah data kunjungan Tamu yang telah masuk.</p>
    </div>
@php
    use App\Models\Feedback;
    use Carbon\Carbon;

    $today = Carbon::today()->locale('id'); // pastikan pakai locale Indonesia

    $dayName = $today->translatedFormat('l'); // Nama hari (Senin, Selasa, dst)
    $monthName = $today->translatedFormat('F'); // Nama bulan
    $yearNumber = $today->year;
    $dayDate = $today->day;

    // Hitungan otomatis
    $totalHariIni = Feedback::whereDate('tanggal_kunjungan', $today)->count();
    $totalBulanIni = Feedback::whereYear('tanggal_kunjungan', $yearNumber)
                            ->whereMonth('tanggal_kunjungan', $today->month)
                            ->count();
    $totalTahunIni = Feedback::whereYear('tanggal_kunjungan', $yearNumber)->count();
@endphp


<!-- 🔹 Statistik Kunjungan Waktu -->
<!-- 🔹 Statistik Kunjungan Waktu -->
<div class="card shadow-sm border-0 rounded-4 mb-4">
    <div class="card-header text-white fw-bold"
         style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
        <i class="bi bi-calendar-check me-2"></i> Statistik Kunjungan Waktu
    </div>


    <div class="card-body">
        <div class="row g-4">
            <!-- Hari Ini -->
            <div class="col-md-4">
                <div class="card shadow border-0 rounded-4 h-100 stat-card today">
                    <div class="card-body text-center">
                        <div class="icon-box bg-light bg-opacity-25 mx-auto mb-3">
                            <i class="bi bi-calendar-day fs-2"></i>
                        </div>
                        <h5 class="fw-bold">{{ $totalHariIni }}</h5>
                       <small>{{ $dayName }}, {{ $dayDate }} {{ $monthName }} {{ $yearNumber }}</small>

                    </div>
                </div>
            </div>
            <!-- Bulan Ini -->
            <div class="col-md-4">
                <div class="card shadow border-0 rounded-4 h-100 stat-card month">
                    <div class="card-body text-center">
                        <div class="icon-box bg-light bg-opacity-25 mx-auto mb-3">
                            <i class="bi bi-calendar-month fs-2"></i>
                        </div>
                        <h5 class="fw-bold">{{ $totalBulanIni }}</h5>
                        <small>Bulan {{ $monthName }}</small>
                    </div>
                </div>
            </div>
            <!-- Tahun Ini -->
            <div class="col-md-4">
                <div class="card shadow border-0 rounded-4 h-100 stat-card year">
                    <div class="card-body text-center">
                       <div class="icon-box bg-light bg-opacity-25 mx-auto mb-3">
    <i class="bi bi-calendar-event fs-2"></i>
</div>

                        <h5 class="fw-bold">{{ $totalTahunIni }}</h5>
                        <small>Tahun {{ $yearNumber }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 🔹 Statistik Kunjungan Keseluruhan -->
<!-- 🔹 Statistik Kunjungan Keseluruhan -->
<div class="card shadow-sm border-0 rounded-4 mb-4">
    <div class="card-header text-white fw-bold"
         style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
        <i class="bi bi-people me-2"></i> Statistik Kunjungan Keseluruhan
    </div>


    <div class="card-body">
        <div class="row g-4 d-flex align-items-stretch">
            <!-- Filter -->
            <div class="col-md-3 d-flex">
                <form action="{{ route('total.index') }}" method="GET" id="filterForm"
                      class="p-3 rounded-3 shadow-sm text-dark w-100 d-flex flex-column justify-content-between"
                      style="background: linear-gradient(135deg, #f7971e, #ffd200);">

                    <div>
                        {{-- Tahun --}}
                        <div class="mb-2">
                            <label for="tahun" class="fw-bold text-white">
                                <i class="bi bi-calendar-event me-1"></i> Tahun
                            </label>
                            <select name="tahun" id="tahun" class="form-select text-center fw-semibold"
                                    onchange="document.getElementById('filterForm').submit()">
                                @foreach($tahunList as $t)
                                    <option value="{{ $t }}" {{ $t == $tahun ? 'selected' : '' }}>{{ $t }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Bulan --}}
                        <div class="mb-2">
                            <label for="bulan" class="fw-bold text-white">
                                <i class="bi bi-calendar-month me-1"></i> Bulan
                            </label>
                            <select name="bulan" id="bulan" class="form-select text-center fw-semibold"
                                    onchange="document.getElementById('filterForm').submit()">
                                <option value="">Semua Bulan</option>
                                @foreach([
                                    '01' => 'Januari','02' => 'Februari','03' => 'Maret',
                                    '04' => 'April','05' => 'Mei','06' => 'Juni',
                                    '07' => 'Juli','08' => 'Agustus','09' => 'September',
                                    '10' => 'Oktober','11' => 'November','12' => 'Desember'
                                ] as $num => $nama)
                                    <option value="{{ $num }}" {{ $num == $bulan ? 'selected' : '' }}>{{ $nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Triwulan --}}
<div class="mb-2">
    <label for="triwulan" class="fw-bold text-white">
        <i class="bi bi-calendar3 me-1"></i> Triwulan
    </label>
    <select name="triwulan" id="triwulan" class="form-select text-center fw-semibold"
            onchange="document.getElementById('filterForm').submit()">
        <option value="">Semua</option>
        <option value="1" {{ request('triwulan') == '1' ? 'selected' : '' }}>Triwulan 1 (Jan–Mar)</option>
        <option value="2" {{ request('triwulan') == '2' ? 'selected' : '' }}>Triwulan 2 (Apr–Jun)</option>
        <option value="3" {{ request('triwulan') == '3' ? 'selected' : '' }}>Triwulan 3 (Jul–Sep)</option>
        <option value="4" {{ request('triwulan') == '4' ? 'selected' : '' }}>Triwulan 4 (Okt–Des)</option>
    </select>
</div>

{{-- Semester --}}
<div class="mb-2">
    <label for="semester" class="fw-bold text-white">
        <i class="bi bi-calendar-range me-1"></i> Semester
    </label>
    <select name="semester" id="semester" class="form-select text-center fw-semibold"
            onchange="document.getElementById('filterForm').submit()">
        <option value="">Semua</option>
        <option value="1" {{ request('semester') == '1' ? 'selected' : '' }}>Semester 1 (Jan–Jun)</option>
        <option value="2" {{ request('semester') == '2' ? 'selected' : '' }}>Semester 2 (Jul–Des)</option>
    </select>
</div>


                        {{-- Tanggal --}}
                        <div>
                            <label for="tanggal" class="fw-bold text-white">
                                <i class="bi bi-calendar-day me-1"></i> Tanggal
                            </label>
                            <select name="tanggal" id="tanggal" class="form-select text-center fw-semibold"
                                    onchange="document.getElementById('filterForm').submit()">
                                <option value="">Semua Tanggal</option>
                                @for ($d = 1; $d <= 31; $d++)
                                    <option value="{{ $d }}" {{ $d == $tanggal ? 'selected' : '' }}>{{ $d }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <!-- Panah ke kanan -->
                    <div class="text-end mt-2">
                        <i class="bi bi-arrow-right-circle-fill fs-4 text-white"></i>
                    </div>
                </form>
            </div>

            <!-- Statistik Total -->
            <div class="col-md-9 d-flex">
                <div class="row g-4 w-100 d-flex align-items-stretch">
                    <div class="col-md-4 d-flex">
                        <div class="card shadow border-0 rounded-4 w-100 h-100 stat-card total">
                            <div class="card-body text-center d-flex flex-column justify-content-center">
                                <div class="icon-box bg-light bg-opacity-25 mx-auto mb-3">
                                    <i class="bi bi-people-fill fs-2"></i>
                                </div>
                                <h5 class="fw-bold">{{ $feedbacks->count() }}</h5>
                                <small>Total Kunjungan</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 d-flex">
                        <div class="card shadow border-0 rounded-4 w-100 h-100 stat-card male">
                            <div class="card-body text-center d-flex flex-column justify-content-center">
                                <div class="icon-box bg-light bg-opacity-25 mx-auto mb-3">
                                    <i class="bi bi-person-badge fs-2"></i>
                                </div>
                                <h5 class="fw-bold">{{ $feedbacks->where('jenis_kelamin','Laki-laki')->count() }}</h5>
                                <small>Total Laki-laki</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 d-flex">
                        <div class="card shadow border-0 rounded-4 w-100 h-100 stat-card female">
                            <div class="card-body text-center d-flex flex-column justify-content-center">
                                <div class="icon-box bg-light bg-opacity-25 mx-auto mb-3">
                                    <i class="bi bi-person-hearts fs-2"></i>
                                </div>
                                <h5 class="fw-bold">{{ $feedbacks->where('jenis_kelamin','Perempuan')->count() }}</h5>
                                <small>Total Perempuan</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



    <!-- 🔹 Grafik Usia & Keperluan -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-header d-flex justify-content-between align-items-center text-white fw-bold"
     style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
    <span><i class="bi bi-pie-chart-fill me-2"></i> Statistik Usia</span>
</div>

                <div class="card-body">
                    <canvas id="usiaChart" style="max-height: 350px;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-header d-flex justify-content-between align-items-center text-white fw-bold"
                     style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
                    <span><i class="bi bi-diagram-3-fill me-2"></i> Statistik Keperluan</span>
                </div>
                <div class="card-body">
                    <canvas id="keperluanChart" style="max-height: 350px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- 🔹 Grafik Tren -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-header d-flex justify-content-between align-items-center text-white fw-bold"
                     style="background: linear-gradient(135deg, #36d1dc, #5b86e5);">
                    <span><i class="bi bi-graph-up me-2"></i> Tren Bulanan</span>
                </div>
                <div class="card-body">
                    <canvas id="trenBulananChart" style="max-height: 350px;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-header d-flex justify-content-between align-items-center text-white fw-bold"
                     style="background: linear-gradient(135deg, #ff6a00, #ee0979);">
                    <span><i class="bi bi-graph-up-arrow me-2"></i> Tren Mingguan</span>
                </div>
                <div class="card-body">
                    <canvas id="trenMingguanChart" style="max-height: 350px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- 🔹 Timeline Kunjungan Terbaru -->
    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-header text-white fw-bold"
             style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
            <i class="bi bi-clock-history me-2"></i> Kunjungan Terbaru
        </div>
        <div class="card-body">
            <div class="timeline">
                @foreach($feedbacks->sortByDesc('created_at')->take(5) as $f)
                    <div class="timeline-item">
                        <div class="timeline-icon
                            @if($f->jenis_kelamin == 'Laki-laki') male
                            @elseif($f->jenis_kelamin == 'Perempuan') female
                            @else other @endif">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div class="timeline-content">
                            <h6 class="mb-1 fw-bold">
                                {{ $f->first_name }}
                                <span class="badge
                                    @if($f->jenis_kelamin == 'Laki-laki') bg-primary
                                    @elseif($f->jenis_kelamin == 'Perempuan') bg-pink
                                    @else bg-secondary @endif">
                                    {{ $f->jenis_kelamin ?? 'Tidak diketahui' }}
                                </span>
                            </h6>
                            <p class="mb-1 text-muted small">
                                <i class="bi bi-briefcase-fill me-1"></i>
                                {{ $f->keperluan ?? 'Tidak ada keperluan' }}
                            </p>
                            <small class="text-muted">
                                <i class="bi bi-clock me-1"></i>
                                {{ $f->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>





</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<!-- Custom Styling -->
<style>
    /* ðŸ”¹ Card Tabel */
    .card {
        border-radius: 1.2rem !important;
        overflow: hidden;
    }

    /* ðŸ”¹ Header Tabel */
    #feedbackTable thead {
        background: linear-gradient(90deg, #0077b6, #0096c7);
    }
    #feedbackTable thead th {
        color: #fff;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 14px;
    }

    /* ðŸ”¹ Zebra Stripe Cerah */
    #feedbackTable tbody tr:nth-child(odd) {
        background-color: #ffffff;
    }
    #feedbackTable tbody tr:nth-child(even) {
        background-color: #f1faff;
    }

    /* ðŸ”¹ Hover Effect */
    #feedbackTable tbody tr:hover {
        background: #d0f0ff !important;
        transform: scale(1.01);
    }

    /* ðŸ”¹ Sel Tabel */
    #feedbackTable td {
        padding: 12px;
        vertical-align: middle;
    }

    /* ðŸ”¹ Kolom Warna Khusus */
    .email-cell {
        background-color: #fff3cd;
        border-radius: 6px;
        padding: 8px;
    }
    .layanan-cell {
        background-color: #d4edda;
        border-radius: 6px;
        padding: 8px;
    }
    .kunjungan-cell {
        background-color: #ffe5d9;
        border-radius: 6px;
        padding: 8px;
    }

    /* ðŸ”¹ Shadow pada Table Container */
    .table-responsive {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    /* ðŸ”¹ DataTables Search dan Pagination */
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 8px;
        border: 1px solid #ccc;
        padding: 6px 10px;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 8px !important;
        padding: 6px 12px !important;
        margin: 2px;
        border: none !important;
        background: #f0f0f0 !important;
        color: #333 !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #0077b6 !important;
        color: white !important;
        font-weight: bold;
    }
    .timeline {
    position: relative;
    padding: 0;
    margin: 0;
}
.timeline::before {
    content: "";
    position: absolute;
    top: 0;
    left: 25px;
    width: 3px;
    height: 100%;
    background: linear-gradient(180deg, #6a11cb, #2575fc);
    border-radius: 4px;
}

/* ðŸ”¹ Timeline Item */
.timeline-item {
    position: relative;
    margin-bottom: 25px;
    padding-left: 60px;
}
.timeline-item:last-child {
    margin-bottom: 0;
}

/* ðŸ”¹ Icon Bulat */
.timeline-icon {
    position: absolute;
    left: 15px;
    top: 0;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 12px;
    box-shadow: 0 0 8px rgba(0,0,0,0.15);
}

/* Warna dinamis */
.timeline-icon.male { background: #0d6efd; }
.timeline-icon.female { background: #e83e8c; }
.timeline-icon.other { background: #6c757d; }

/* Badge custom */
.bg-pink { background-color: #e83e8c !important; }

/* ðŸ”¹ Konten Timeline */
.timeline-content {
    background: #ffffff;
    border-radius: 10px;
    padding: 14px 16px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.25s ease-in-out;
}
.timeline-content:hover {
    background: #f0f8ff;
    transform: translateX(5px);
}
/* Style Card Statistik */
.stat-card {
    color: #fff;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}
.stat-card .icon-box {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}



/* Hover efek modern */
.stat-card:hover {
    transform: translateY(-6px) scale(1.02);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

/* Header Modern */
.header-modern {
    background: linear-gradient(135deg, #6a11cb, #2575fc); /* ungu ke biru vibrant */
    border: none;
    position: relative;
    overflow: hidden;
}

/* Tambahan efek glowing garis tipis */
.header-modern::after {
    content: "";
    position: absolute;
    top: 0;
    left: -50%;
    width: 200%;
    height: 100%;
    background: rgba(255,255,255,0.1);
    transform: skewX(-30deg);
}
/* Efek hover untuk card grafik */
.card.shadow-sm {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card.shadow-sm:hover {
    transform: translateY(-6px) scale(1.02);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

/* Kalau mau efek goyang (wiggle) */
.card.shadow-sm:hover {
    animation: wiggle 0.4s ease-in-out;
}

@keyframes wiggle {
    0% { transform: rotate(0deg); }
    25% { transform: rotate(1deg); }
    50% { transform: rotate(-1deg); }
    75% { transform: rotate(1deg); }
    100% { transform: rotate(0deg); }
}

/* Pastikan select dropdown selalu muncul ke bawah */
select {
    direction: ltr;
}

select option {
    position: relative;
}


.stat-card, #filterForm {
    min-height: 180px;
}

/* Animasi panah kanan */
#filterForm i, .card i.bi-arrow-right-circle-fill {
    transition: transform 0.3s ease;
}
#filterForm:hover i, .card:hover i.bi-arrow-right-circle-fill {
    transform: translateX(6px);
}

.stat-card .icon-box {
    width: 55px;
    height: 55px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* 🎨 Warna gradasi unik tiap card (revisi, tanpa ungu & oranye) */
.stat-card.total {
    background: linear-gradient(135deg, #11998e, #38ef7d); /* hijau emerald segar */
    color: #fff;
}

.stat-card.male {
    background: linear-gradient(135deg, #06beb6, #48b1bf); /* biru turquoise modern */
    color: #fff;
}

.stat-card.female {
    background: linear-gradient(135deg, #ff6a88, #ff99ac); /* pink coral */
    color: #fff;
}

.stat-card.today {
     background: linear-gradient(135deg, #cb356b, #bd3f32); /* merah marun elegan */
    color: #fff;
}

.stat-card.month {
    background: linear-gradient(135deg, #1e3c72, #2a5298); /* biru navy */
    color: #fff;
}

.stat-card.year {
    background: linear-gradient(135deg, #bdc3c7, #2c3e50); /* abu modern elegan */
    color: #fff;
}




/* Hover efek modern */
.stat-card:hover {
    transform: translateY(-6px) scale(1.02);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

/* 🔹 Perkecil filter */
#filterForm {
    display: flex;
    flex-direction: column;
    justify-content: center; /* biar isi ketengah vertikal */
    height: 100%; /* pastikan penuh setinggi card */
}

}
#filterForm label {
    font-size: 0.85rem;
}
#filterForm .form-select {
    font-size: 0.85rem;
    padding: 4px 6px;
    border-radius: 6px;
}

</style>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // =====================================================
    // ðŸ”¹ Raw Data dari Laravel
    const rawData = @json($feedbacks->map(fn($f) => [
        'tanggal' => Carbon::parse($f->tanggal_kunjungan)->format('Y-m-d'),

        'usia' => $f->usia,
        'keperluan' => strtolower($f->keperluan)
    ]));

    // =====================================================
    // ðŸ”¹ Helper Gradien Dinamis
    function createGradient(ctx, color1, color2) {
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, color1);
        gradient.addColorStop(1, color2);
        return gradient;
    }

    // =====================================================
    // ðŸ”¹ Grafik Usia (Pie Chart)
    function getUsiaCounts(data) {
    return [
        data.filter(d => d.usia < 20).length,
        data.filter(d => d.usia >= 20 && d.usia <= 30).length,
        data.filter(d => d.usia >= 31 && d.usia <= 40).length,
        data.filter(d => d.usia >= 41 && d.usia <= 50).length,
        data.filter(d => d.usia > 50).length
    ];
}




    if (document.getElementById('usiaChart')) {
        let ctxUsia = document.getElementById('usiaChart').getContext('2d');
        let usiaData = getUsiaCounts(rawData);
        new Chart(ctxUsia, {
            type: 'pie',
            data: {
                labels: ['< 20', '20-30', '31-40', '41-50', '> 50'],

                datasets: [{
                    data: usiaData,
                    backgroundColor: [
                        createGradient(ctxUsia, '#00c6ff', '#0072ff'),
                        createGradient(ctxUsia, '#ff9a9e', '#fad0c4'),
                        createGradient(ctxUsia, '#84fab0', '#8fd3f4'),
                        createGradient(ctxUsia, '#fbc2eb', '#a6c1ee'),
                        createGradient(ctxUsia, '#ff758c', '#ff7eb3')
                    ],
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                let value = context.raw;
                                let percentage = ((value / total) * 100).toFixed(1);
                                return `${context.label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true,
                    duration: 1500,
                    easing: 'easeOutBounce'
                }
            }
        });
    }

    // =====================================================
    // ðŸ”¹ Grafik Keperluan (Doughnut Chart)
    function getKeperluanCounts(data) {
        return [
            data.filter(d => d.keperluan === 'bertemu subject matter').length,
            data.filter(d => d.keperluan === 'undangan rapat').length,
            data.filter(d => d.keperluan === 'pst').length,
            data.filter(d => !['bertemu subject matter','undangan rapat','pst'].includes(d.keperluan)).length
        ];
    }

    if (document.getElementById('keperluanChart')) {
        let ctxKep = document.getElementById('keperluanChart').getContext('2d');
        let kepData = getKeperluanCounts(rawData);
        new Chart(ctxKep, {
            type: 'doughnut',
            data: {
                labels: ['Bertemu Subject Matter','Undangan Rapat','PST','Lainnya'],
                datasets: [{
                    data: kepData,
                    backgroundColor: [
                        createGradient(ctxKep, '#ff9800','#ffc107'),
                        createGradient(ctxKep, '#4caf50','#81c784'),
                        createGradient(ctxKep, '#2196f3','#64b5f6'),
                        createGradient(ctxKep, '#9c27b0','#ba68c8')
                    ],
                    borderColor: '#fff',
                    borderWidth: 2,
                    hoverOffset: 20
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                let value = context.raw;
                                let percentage = ((value / total) * 100).toFixed(1);
                                return `${context.label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                },
                animation: { duration: 1200, easing: 'easeInOutQuart' }
            }
        });
    }

    // =====================================================
    // ðŸ”¹ Grafik Bulanan (Line Chart)
    function groupByMonth(data) {
        let counts = Array(12).fill(0);
        data.forEach(d => {
            let date = new Date(d.tanggal);
            counts[date.getMonth()]++;
        });
        return counts;
    }

    if (document.getElementById('trenBulananChart')) {
        let ctxBulanan = document.getElementById('trenBulananChart').getContext('2d');
        new Chart(ctxBulanan, {
            type: 'line',
            data: {
                labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
                datasets: [{
                    label: 'Jumlah Feedback',
                    data: groupByMonth(rawData),
                    borderColor: '#36d1dc',
                    backgroundColor: createGradient(ctxBulanan, 'rgba(54, 209, 220, 0.4)', 'rgba(91, 134, 229, 0.1)'),
                    fill: true,
                    tension: 0.4,
                    pointRadius: 6,
                    pointHoverRadius: 10,
                    pointBackgroundColor: '#36d1dc'
                }]
            },
            options: {
                responsive: true,
                animation: { duration: 1500, easing: 'easeOutQuart' },
                plugins: { tooltip: { mode: 'index', intersect: false } },
                interaction: { mode: 'nearest', axis: 'x', intersect: false }
            }
        });
    }

    // =====================================================
    // ðŸ”¹ Grafik Mingguan (Line Chart)
    function getWeekNumber(d) {
        d = new Date(Date.UTC(d.getFullYear(), d.getMonth(), d.getDate()));
        let dayNum = d.getUTCDay() || 7;
        d.setUTCDate(d.getUTCDate() + 4 - dayNum);
        let yearStart = new Date(Date.UTC(d.getUTCFullYear(),0,1));
        return Math.ceil((((d - yearStart) / 86400000) + 1)/7);
    }

    function groupByWeek(data) {
        let weeks = {};
        data.forEach(d => {
            let date = new Date(d.tanggal);
            let week = getWeekNumber(date);
            weeks[week] = (weeks[week] || 0) + 1;
        });
        return weeks;
    }

    if (document.getElementById('trenMingguanChart')) {
        let weeklyData = groupByWeek(rawData);
        let ctxMingguan = document.getElementById('trenMingguanChart').getContext('2d');
        new Chart(ctxMingguan, {
            type: 'line',
            data: {
                labels: Object.keys(weeklyData).map(w => 'Minggu ' + w),
                datasets: [{
                    label: 'Jumlah Feedback',
                    data: Object.values(weeklyData),
                    borderColor: '#ff6a00',
                    backgroundColor: createGradient(ctxMingguan, 'rgba(255, 106, 0, 0.4)', 'rgba(238, 9, 121, 0.1)'),
                    fill: true,
                    tension: 0.35,
                    pointRadius: 5,
                    pointHoverRadius: 9,
                    pointBackgroundColor: '#ff6a00'
                }]
            },
            options: {
                responsive: true,
                animation: { duration: 2000, easing: 'easeInOutElastic' },
                plugins: { tooltip: { mode: 'index', intersect: false } },
                interaction: { mode: 'nearest', axis: 'x', intersect: false }
            }
        });
    }
});
</script>


@endsection