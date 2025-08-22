@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="fw-bold mb-4">📊 Grafik Kunjungan Tamu</h4>

    <div class="row">
        <!-- Grafik Jenis Kelamin -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-primary text-white">
                    Distribusi Berdasarkan Jenis Kelamin
                </div>
                <div class="card-body">
                    <canvas id="genderChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik Layanan -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-success text-white">
                    Distribusi Berdasarkan Layanan
                </div>
                <div class="card-body">
                    <canvas id="layananChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data dari controller (Laravel Blade to JS)
    const genderData = @json($genderStats);
    const layananData = @json($layananStats);

    // Gender Chart
    new Chart(document.getElementById('genderChart'), {
        type: 'pie',
        data: {
            labels: Object.keys(genderData),
            datasets: [{
                data: Object.values(genderData),
                backgroundColor: ['#0077b6', '#ff6b6b']
            }]
        }
    });

    // Layanan Chart
    new Chart(document.getElementById('layananChart'), {
        type: 'bar',
        data: {
            labels: Object.keys(layananData),
            datasets: [{
                label: 'Jumlah Kunjungan',
                data: Object.values(layananData),
                backgroundColor: '#00b894'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection
