@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Heading Cantik -->
    <h4 class="fw-bold mb-4 heading-custom">
        📊 Grafik Kunjungan Tamu
    </h4>

    <div class="row">
        <!-- Grafik Jenis Kelamin -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header text-white d-flex justify-content-between align-items-center"
                     style="background-color: #003366;">
                    Distribusi Berdasarkan Jenis Kelamin
                    <button class="btn btn-light btn-sm" onclick="downloadChart('genderChart')">⬇️</button>
                </div>
                <div class="card-body d-flex justify-content-center">
                    <div style="width:280px;height:280px;">
                        <canvas id="genderChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- 🔄 Grafik Instansi (tukar ke atas) -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header text-white d-flex justify-content-between align-items-center" style="background:#ff9800;">
                    Distribusi Berdasarkan Instansi
                    <button class="btn btn-light btn-sm" onclick="downloadChart('instansiChart')">⬇️</button>
                </div>
                <div class="card-body d-flex justify-content-center">
                    <div style="width:280px;height:280px;">
                        <canvas id="instansiChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- 🔄 Grafik Layanan (pindah ke bawah) -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header text-dark d-flex justify-content-between align-items-center" style="background:#fbc02d;">
                    Distribusi Berdasarkan Layanan
                    <button class="btn btn-light btn-sm" onclick="downloadChart('layananChart')">⬇️</button>
                </div>
                <div class="card-body">
                    <canvas id="layananChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik Pekerjaan -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header text-white d-flex justify-content-between align-items-center"
                     style="background-color:#42a5f5;">
                    Distribusi Berdasarkan Pekerjaan
                    <button class="btn btn-light btn-sm" onclick="downloadChart('pekerjaanChart')">⬇️</button>
                </div>
                <div class="card-body">
                    <canvas id="pekerjaanChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Sisanya tetap sama -->
     <!-- ✅ Survei & Usia sekarang ada tombol download -->
    <div class="row">
        <!-- Survei -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header text-white fw-bold d-flex justify-content-between align-items-center" style="background:#e53935;">
                    Distribusi Kepuasan Survei
                    <button class="btn btn-light btn-sm" onclick="downloadChart('surveiChart')">⬇️</button>
                </div>
                <div class="card-body">
                    <canvas id="surveiChart" height="220"></canvas>
                </div>
            </div>
        </div>

        <!-- Usia -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header text-white fw-bold d-flex justify-content-between align-items-center" style="background:#6c5ce7;">
                    Distribusi Berdasarkan Usia
                    <button class="btn btn-light btn-sm" onclick="downloadChart('usiaChart')">⬇️</button>
                </div>
                <div class="card-body">
                    <canvas id="usiaChart" height="220"></canvas>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <!-- Tren Bulanan -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header text-white d-flex justify-content-between align-items-center"
                     style="background-color: #ff9800;">
                    Tren Kunjungan per Bulan
                    <button class="btn btn-light btn-sm" onclick="downloadChart('monthlyChart')">⬇️</button>
                </div>
                <div class="card-body">
                    <canvas id="monthlyChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Tren Mingguan -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header text-white d-flex justify-content-between align-items-center"
                     style="background-color: #2e7d32;">
                    Tren Kunjungan per Minggu
                    <button class="btn btn-light btn-sm" onclick="downloadChart('weeklyChart')">⬇️</button>
                </div>
                <div class="card-body">
                    <canvas id="weeklyChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Data & Script Chart -->
<script>
   const genderData    = @json($genderStats);
   
const layananData   = @json($layananStats);
const instansiData  = @json($instansiStats);
const pekerjaanData = @json($pekerjaanStats);
const monthlyTrend  = @json($monthlyTrend);
const weeklyTrend   = @json($weeklyTrend);
const usiaData      = @json($usiaStats);   // ✅ Tambah ini
const surveiData    = @json($surveiStats); // ✅ Tambah ini


    // Function download chart
    function downloadChart(canvasId, format = "png") {
        const canvas = document.getElementById(canvasId);
        const link = document.createElement('a');
        link.download = canvasId + '.' + format;
        link.href = canvas.toDataURL("image/" + format, 1.0);
        link.click();
    }

    const genderColors = {
    "Laki-laki": "#42a5f5", // biru
    "Perempuan": "#f48fb1"  // pink
};

new Chart(document.getElementById('genderChart'), {
    type: 'pie',
    data: {
        labels: Object.keys(genderData),
        datasets: [{
            data: Object.values(genderData),
            backgroundColor: Object.keys(genderData).map(label => genderColors[label] || '#ccc'),
            borderColor: "#fff",
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    font: { size: 13, weight: 'bold' },
                    usePointStyle: true,
                    pointStyle: 'circle'
                }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.label + ": " + context.raw + " orang";
                    }
                }
            }
        }
    }
});




   new Chart(document.getElementById('layananChart'), {
    type: 'bar',
    data: {
        labels: Object.keys(layananData),
        datasets: [{
            label: 'Jumlah Kunjungan',
            data: Object.values(layananData),
            backgroundColor: '#fbc02d' // 🔹 kuning modern
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true }
        }
    }
});

   // 🔹 Warna unik untuk instansi (9 instansi → 9 warna berbeda)
const instansiColors = [
    "#1abc9c", "#3498db", "#9b59b6", "#f39c12", "#e74c3c",
    "#2ecc71", "#e67e22", "#34495e", "#ff6f61"
];

// 🔹 Grafik Instansi
new Chart(document.getElementById('instansiChart'), {
    type: 'pie',
    data: {
        labels: Object.keys(instansiData),
        datasets: [{
            data: Object.values(instansiData),
            backgroundColor: Object.keys(instansiData).map((_, i) => instansiColors[i % instansiColors.length]),
            borderWidth: 2,
            borderColor: "#fff"
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    font: { size: 12, weight: 'bold' },
                    usePointStyle: true,
                    pointStyle: 'circle'
                }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.label + ": " + context.raw + " tamu";
                    }
                }
            }
        }
    }
});


   new Chart(document.getElementById('pekerjaanChart'), {
    type: 'bar',
    data: {
        labels: Object.keys(pekerjaanData),
        datasets: [{
            label: 'Jumlah Tamu',
            data: Object.values(pekerjaanData),
            backgroundColor: '#42a5f5' // biru cerah modern
        }]
    },
    options: {
        responsive: true,
        scales: { y: { beginAtZero: true } }
    }
});


    new Chart(document.getElementById('monthlyChart'), {
        type: 'line',
        data: {
            labels: Object.keys(monthlyTrend),
            datasets: [{
                label: 'Jumlah Kunjungan',
                data: Object.values(monthlyTrend),
                borderColor: '#ff9800',
                backgroundColor: 'rgba(255,152,0,0.2)',
                fill: true,
                tension: 0.3
            }]
        }
    });

    new Chart(document.getElementById('weeklyChart'), {
    type: 'line',
    data: {
        labels: Object.keys(weeklyTrend),
        datasets: [{
            label: 'Jumlah Kunjungan',
            data: Object.values(weeklyTrend),
            borderColor: '#2e7d32', // hijau modern
            backgroundColor: 'rgba(46,125,50,0.2)', // hijau transparan
            fill: true,
            tension: 0.3,
            pointBackgroundColor: '#2e7d32',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: '#2e7d32'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                labels: {
                    color: '#2e7d32',
                    font: { weight: 'bold' }
                }
            }
        },
        scales: {
            x: { ticks: { color: '#333' } },
            y: { ticks: { color: '#333' } }
        }
    }
});


// 🔹 Grafik Usia
new Chart(document.getElementById('usiaChart'), {
    type: 'bar',
    data: {
        labels: Object.keys(usiaData), // contoh: ["<20", "20-29", "30-39", "40-49", "50+"]
        datasets: [{
            label: 'Jumlah Tamu',
            data: Object.values(usiaData),
            backgroundColor: '#6c5ce7',
            borderRadius: 6 // sudut bar agak melengkung biar lebih modern
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false, // ✅ biar tinggi canvas bisa diatur manual
        scales: {
            y: {
                beginAtZero: true,
                ticks: { stepSize: 1 } // naik per 1 biar jelas
            },
            x: {
                ticks: { font: { size: 12 } }
            }
        },
        plugins: {
            legend: { display: false }, // label di atas bar aja, legend gak perlu
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.raw + " tamu";
                    }
                }
            }
        }
    }
});

// 🔹 Grafik Kepuasan Survei
new Chart(document.getElementById('surveiChart'), {
    type: 'doughnut',
    data: {
        labels: Object.keys(surveiData), // contoh: ["1 Bintang", "2 Bintang", "3 Bintang", "4 Bintang", "5 Bintang"]
        datasets: [{
            data: Object.values(surveiData),
            backgroundColor: ['#d32f2f','#f57c00','#fbc02d','#388e3c','#1976d2'],
            borderWidth: 2,
            borderColor: "#fff"
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false, // ✅ biar donat tidak terlalu gede
        plugins: {
            legend: { 
                position: 'bottom',
                labels: { font: { size: 12 } } // kecilin legend biar rapi
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.label + ": " + context.raw + " responden";
                    }
                }
            }
        },
        cutout: '65%' // ✅ bikin donat agak tipis (lebih elegan)
    }
});

</script>

<!-- Styling Heading -->
<!-- Styling Heading -->
<style>
.heading-custom {
    font-size: 1.6rem;
    font-weight: 900;
    color: #2e7d32 !important; /* 🔹 Warna hijau */
    display: inline-block;
    padding: 0.3rem 0.6rem;
    border-radius: 8px;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.2); /* 🔹 bayangan biar lebih hidup */
    transition: transform 0.2s ease;
}
.heading-custom:hover {
    transform: scale(1.05);
    cursor: pointer;
    color: #1b5e20 !important; /* 🔹 Hijau lebih tua saat hover */
}
.card-header {
    color: #fff !important;
    font-weight: 700 !important;
}
</style>
@endsection
