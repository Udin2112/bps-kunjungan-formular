=@extends('layouts.app')

@section('content')
<div class="container">
    {{-- 🔹 Header Utama --}}
    <div class="p-4 mb-4 rounded-3 shadow-sm text-white" 
     style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
    <h3 class="fw-bold mb-1">
        <i class="bi bi-database-fill-check me-2 text-warning"></i> Database Kunjungan
    </h3>
    <p class="mb-0">Berikut adalah data kunjungan Tamu PST yang telah masuk.</p>
</div>


    {{-- 🔹 Filter Tahun & Bulan --}}
    {{-- 🔹 Filter Tahun & Bulan --}}
{{-- 🔹 Filter Tahun & Bulan --}}
{{-- 🔹 Filter + Card Statistik Ringkas --}}
<div class="row mb-4 align-items-stretch">
   <!-- Filter Tahun & Bulan -->
<div class="col-lg-4 mb-3">
   <form action="{{ route('grafik.index') }}" method="GET" id="filterForm"
      class="d-flex flex-column justify-content-center align-items-center gap-3 p-3 rounded-3 shadow-sm text-dark text-center h-100"
      style="background: linear-gradient(135deg, #f7971e, #ffd200);"> <!-- Orange modern -->



            {{-- Tahun --}}
            <div class="w-100">
                <label for="tahun" class="fw-bold mb-2 fs-6 text-white">
    <i class="bi bi-calendar-event me-1 text-white"></i> Tahun
</label>
                <select name="tahun" id="tahun"
                        class="form-select shadow-sm border-0 rounded-2 px-3 py-2 fs-6 fw-semibold text-center bg-light"
                        onchange="document.getElementById('filterForm').submit()">
                    @foreach($tahunList as $t)
                        <option value="{{ $t }}" {{ $t == $tahun ? 'selected' : '' }}>
                            {{ $t }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Bulan --}}
            <div class="w-100">
                <label for="bulan" class="fw-bold mb-2 fs-6 text-white">
    <i class="bi bi-calendar-month me-1 text-white"></i> Bulan
</label>
                <select name="bulan" id="bulan"
                        class="form-select shadow-sm border-0 rounded-2 px-3 py-2 fs-6 fw-semibold text-center bg-light"
                        onchange="document.getElementById('filterForm').submit()">
                    <option value="">Semua Bulan</option>
                    @foreach([
                        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
                        '04' => 'April',   '05' => 'Mei',      '06' => 'Juni',
                        '07' => 'Juli',    '08' => 'Agustus',  '09' => 'September',
                        '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                    ] as $num => $nama)
                        <option value="{{ $num }}" {{ $num == $bulan ? 'selected' : '' }}>
                            {{ $nama }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>

    <!-- 🔹 Card Statistik -->
<div class="col-lg-8 col-12">
  <div class="row">
    
    <!-- Card Total Kunjungan -->
    <div class="col-lg-4 col-md-6 col-12 mb-3">
      <div class="stat-card shadow-lg rounded-3xl overflow-hidden">
        <div class="stat-header d-flex align-items-center justify-content-center py-3"
             style="background: linear-gradient(135deg, #36d1dc, #5b86e5);">
          <i class="bi bi-people-fill fs-2 text-white"></i>
        </div>
        <div class="stat-body text-center p-3 bg-white">
          <h4 class="fw-bold mb-1 text-gray-800">{{ $totalKunjungan }}</h4>
          <small class="text-muted">Total Kunjungan</small>
        </div>
      </div>
    </div>

    <!-- Card Total Laki-laki -->
    <div class="col-lg-4 col-md-6 col-12 mb-3">
      <div class="stat-card shadow-lg rounded-3xl overflow-hidden">
        <div class="stat-header d-flex align-items-center justify-content-center py-3"
             style="background: linear-gradient(135deg, #11998e, #38ef7d);">
          <i class="bi bi-person-badge fs-2 text-white"></i>
        </div>
        <div class="stat-body text-center p-3 bg-white">
          <h4 class="fw-bold mb-1 text-gray-800">{{ $totalLaki }}</h4>
          <small class="text-muted">Total Laki-laki</small>
        </div>
      </div>
    </div>

    <!-- Card Total Perempuan -->
    <div class="col-lg-4 col-md-6 col-12 mb-3">
      <div class="stat-card shadow-lg rounded-3xl overflow-hidden">
        <div class="stat-header d-flex align-items-center justify-content-center py-3"
             style="background: linear-gradient(135deg, #ff758c, #ff7eb3);">
          <i class="bi bi-person-hearts fs-2 text-white"></i>
        </div>
        <div class="stat-body text-center p-3 bg-white">
          <h4 class="fw-bold mb-1 text-gray-800">{{ $totalPerempuan }}</h4>
          <small class="text-muted">Total Perempuan</small>
        </div>
      </div>
    </div>

  </div>
</div>

</div>





    {{-- 🔹 Chart Section --}}
    <div class="row">
        @php
   $charts = [
    'kunjunganChart' => ['title' => 'Grafik Pemanfaatan Kunjungan', 'gradient' => 'linear-gradient(135deg,#ff416c,#ff4b2b)'],
    'genderChart'    => ['title' => 'Distribusi Berdasarkan Jenis Kelamin', 'gradient' => 'linear-gradient(135deg,#6a11cb,#2575fc)'],
    'pekerjaanChart' => ['title' => 'Distribusi Berdasarkan Pekerjaan', 'gradient' => 'linear-gradient(135deg,#f7971e,#ffd200)'],
    'usiaChart'      => ['title' => 'Distribusi Berdasarkan Usia', 'gradient' => 'linear-gradient(135deg,#cb2d3e,#ef473a)'],
    'instansiChart'  => ['title' => 'Distribusi Berdasarkan Instansi', 'gradient' => 'linear-gradient(135deg,#1e3c72,#2a5298)'],
    'layananChart'   => ['title' => 'Distribusi Berdasarkan Layanan', 'gradient' => 'linear-gradient(135deg,#11998e,#38ef7d)'],
];

@endphp

@foreach($charts as $id => $chart)
<div class="col-md-6 mb-4">
    <div class="chart-card rounded-2xl shadow-lg overflow-hidden">
        <div class="chart-header px-4 py-2 fw-semibold text-white" style="background: {{ $chart['gradient'] }}">
            {{ $chart['title'] }}
        </div>
        <div class="chart-body p-4">
            <canvas id="{{ $id }}"></canvas>
        </div>
    </div>
</div>
@endforeach


    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const shadowPlugin = {
    id: "shadow",
    beforeDraw: (chart) => {
        const ctx = chart.ctx;
        ctx.save();
        ctx.shadowColor = "rgba(0,0,0,0.15)";
        ctx.shadowBlur = 8;
        ctx.shadowOffsetX = 4;
        ctx.shadowOffsetY = 4;
    },
    afterDraw: (chart) => {
        chart.ctx.restore();
    }
};

// Default font global
Chart.defaults.font.family = "'Poppins','Segoe UI', sans-serif";
Chart.defaults.font.size = 13;

const chartData = {
    instansiChart: @json($instansiByYear),
    kunjunganChart: @json($kunjunganByYear),
    layananChart: @json($layananByYear),
    pekerjaanChart: @json($pekerjaanByYear),
    usiaChart: @json($usiaByYear),
    genderChart: [
        { label: "Laki-laki", total: {{ $totalLaki }} },
        { label: "Perempuan", total: {{ $totalPerempuan }} }
    ]
};


// Palet warna
const palette = {
    instansi: "#4e79a7",
    layanan: "#59a14f",
    pekerjaan: "#f28e2b",
    usia: "#e15759",
    kunjungan: ["#4e79a7", "#f28e2b", "#e15759", "#76b7b2", "#59a14f", "#edc949", "#af7aa1", "#ff9da7"],
    gender: ["#36a2eb", "#ff6384"] // biru utk laki-laki, pink utk perempuan
};


Object.keys(chartData).forEach(id => {
    const ctx = document.getElementById(id);
    const labels = chartData[id].map(item => Object.values(item)[0]);
    const values = chartData[id].map(item => Number(item.total));

    // Gradient warna default
    const ctx2d = ctx.getContext("2d");
    const gradient = ctx2d.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, "rgba(91, 134, 229, 0.9)");
    gradient.addColorStop(1, "rgba(54, 209, 220, 0.2)");

    let type = 'bar';
    let extraOptions = {};
    let datasetOptions = {
        label: 'Jumlah',
        data: values,
        backgroundColor: gradient,
        borderRadius: 12,
        borderWidth: 2,
        borderColor: "rgba(255,255,255,0.8)",
        barThickness: 35
    };

    // Aturan khusus per chart
if (id === 'instansiChart') {
    type = 'bar';
    extraOptions = { indexAxis: 'y' };
    datasetOptions.backgroundColor = palette.instansi;
} else if (id === 'layananChart') {
    type = 'bar';
    extraOptions = { indexAxis: 'y' };
    datasetOptions.backgroundColor = palette.layanan;
} else if (id === 'pekerjaanChart') {
    type = 'bar';
    datasetOptions.backgroundColor = palette.pekerjaan;
} else if (id === 'kunjunganChart') {
    type = 'pie';
    datasetOptions.backgroundColor = palette.kunjungan;
} else if (id === 'usiaChart') {
    type = 'bar';
    datasetOptions.backgroundColor = palette.usia;
} else if (id === 'genderChart') {
    type = 'pie';
    datasetOptions.backgroundColor = palette.gender;
}



    new Chart(ctx, {
        type: type,
        data: {
            labels: labels,
            datasets: [datasetOptions]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 1200,
                easing: "easeOutQuart"
            },
            ...extraOptions,
            plugins: {
                legend: {
                    display: type !== "bar",
                    labels: {
                        font: {
                            family: "Poppins, Segoe UI, sans-serif",
                            size: 13,
                            weight: "600"
                        },
                        color: "#374151",
                        padding: 16,
                        usePointStyle: true,
                        pointStyle: "circle"
                    }
                },
                tooltip: {
                    backgroundColor: "rgba(30,41,59,0.9)",
                    titleFont: { family: "Poppins", size: 14, weight: "700" },
                    bodyFont: { family: "Poppins", size: 13 },
                    titleColor: "#fff",
                    bodyColor: "#f3f4f6",
                    padding: 12,
                    cornerRadius: 8,
                    usePointStyle: true,
                    callbacks: {
                        label: function(context) {
                            const dataset = context.dataset;
                            const total = dataset.data.reduce((a, b) => a + b, 0);
                            const value = context.raw;
                            const percentage = ((value / total) * 100).toFixed(1);
                            return `${dataset.label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            },
            scales: (type === "bar") ? {
                x: {
                    ticks: {
                        font: { family: "Poppins", size: 12, weight: "500" },
                        color: "#374151"
                    },
                    grid: { color: "#e5e7eb" }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: { family: "Poppins", size: 12, weight: "500" },
                        color: "#374151"
                    },
                    grid: { color: "#f1f5f9" }
                }
            } : {}
        },
        plugins: [shadowPlugin]
    });
});
</script>





<style>
    /* Biar chart proporsional */
    canvas {
        max-width: 100% !important;
        height: 260px !important;
        margin: 0 auto;
    }
    
    /* Card chart */
.chart-card {
    background: linear-gradient(145deg, #ffffff, #f8fafc);
    border: 1px solid #e5e7eb;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.chart-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
}

/* Header tiap chart */
.chart-header {
    font-size: 15px;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.25);
}

/* Body chart */
.chart-body {
    background: #f9fafb;
    border-radius: 0 0 1rem 1rem;
}

/* Styling canvas */
canvas {
    max-width: 100% !important;
    height: 260px !important;
    margin: 0 auto;
}

/* Label Chart.js */
.chartjs-render-monitor {
    font-family: 'Poppins','Segoe UI', sans-serif !important;
    font-weight: 500;
    color: #374151;
}
/* Biar ikon filter jelas */
#filterForm label i {
    color: #fff !important;        /* putih */
    text-shadow: 0 0 6px rgba(0,0,0,0.4);  /* efek glow */
    font-size: 1.2rem;             /* agak besar */
}
#filterForm label {
    color: #fff !important;        /* teks label ikut putih */
}

/* Efek goyang pada card statistik */
.card:hover {
    animation: wiggle 0.4s ease-in-out;
}

/* Keyframes untuk goyang */
@keyframes wiggle {
    0% { transform: rotate(0deg); }
    25% { transform: rotate(2deg); }
    50% { transform: rotate(-2deg); }
    75% { transform: rotate(2deg); }
    100% { transform: rotate(0deg); }
}
/* Card Statistik Modern */
.stat-card {
    border-radius: 1.5rem;
    background: #fff;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}
.stat-card:hover {
    transform: translateY(-6px) scale(1.02);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
}

/* Header (ikon + background gradient) */
.stat-header {
    border-bottom: 1px solid rgba(255,255,255,0.15);
}

/* Body konten */
.stat-body h4 {
    font-size: 1.6rem;
    color: #1f2937;
}
.stat-body small {
    font-size: 0.9rem;
    color: #6b7280;
}


</style>


@endsection