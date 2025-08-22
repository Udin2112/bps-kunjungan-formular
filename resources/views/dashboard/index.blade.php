@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- 🔹 Header Halaman -->
    <div class="p-4 mb-4 rounded-3 shadow-sm text-white" 
     style="background-color: #003366;">
    <h3 class="fw-bold mb-1">
        <i class="bi bi-database-fill-check me-2 text-warning"></i> Database Kunjungan
    </h3>
    <p class="mb-0">Berikut adalah data kunjungan yang telah masuk.</p>
</div>

<!-- 🔹 Statistik Ringkas -->
<div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
    <div class="col">
        <div class="card shadow-sm border-0 rounded-4 h-100" style="background: linear-gradient(135deg,#0077b6,#0096c7); color:white;">
            <div class="card-body text-center">
                <i class="bi bi-people-fill fs-2"></i>
                <h5 class="fw-bold mt-2">{{ $feedbacks->count() }}</h5>
                <small>Total Kunjungan</small>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow-sm border-0 rounded-4 h-100" style="background: linear-gradient(135deg,#6a11cb,#2575fc); color:white;">
            <div class="card-body text-center">
                <i class="bi bi-person-badge fs-2"></i>
                <h5 class="fw-bold mt-2">{{ $feedbacks->where('jenis_kelamin','Laki-laki')->count() }}</h5>
                <small>Total Laki-laki</small>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow-sm border-0 rounded-4 h-100" style="background: linear-gradient(135deg,#ff416c,#ff4b2b); color:white;">
            <div class="card-body text-center">
                <i class="bi bi-person-hearts fs-2"></i>
                <h5 class="fw-bold mt-2">{{ $feedbacks->where('jenis_kelamin','Perempuan')->count() }}</h5>
                <small>Total Perempuan</small>
            </div>
        </div>
    </div>
</div>

<!-- 🔹 Statistik Usia -->
<div class="row row-cols-1 row-cols-md-5 g-4 mb-4">
    <div class="col">
        <div class="card shadow-sm border-0 rounded-4 h-100" style="background: linear-gradient(135deg,#00c6ff,#0072ff); color:white;">
            <div class="card-body text-center">
                <i class="bi bi-emoji-smile fs-2"></i>
                <h5 class="fw-bold mt-2">{{ $feedbacks->where('usia','<',20)->count() }}</h5>
                <small>Usia < 20</small>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow-sm border-0 rounded-4 h-100" style="background: linear-gradient(135deg,#ff9a9e,#fad0c4); color:#333;">
            <div class="card-body text-center">
                <i class="bi bi-person-lines-fill fs-2"></i>
                <h5 class="fw-bold mt-2">{{ $feedbacks->whereBetween('usia',[20,30])->count() }}</h5>
                <small>Usia 20–30</small>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow-sm border-0 rounded-4 h-100" style="background: linear-gradient(135deg,#84fab0,#8fd3f4); color:#333;">
            <div class="card-body text-center">
                <i class="bi bi-person-bounding-box fs-2"></i>
                <h5 class="fw-bold mt-2">{{ $feedbacks->whereBetween('usia',[31,40])->count() }}</h5>
                <small>Usia 31–40</small>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow-sm border-0 rounded-4 h-100" style="background: linear-gradient(135deg,#fbc2eb,#a6c1ee); color:#333;">
            <div class="card-body text-center">
                <i class="bi bi-person-video2 fs-2"></i>
                <h5 class="fw-bold mt-2">{{ $feedbacks->whereBetween('usia',[41,50])->count() }}</h5>
                <small>Usia 41–50</small>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow-sm border-0 rounded-4 h-100" style="background: linear-gradient(135deg,#ff758c,#ff7eb3); color:white;">
            <div class="card-body text-center">
                <i class="bi bi-person-check-fill fs-2"></i>
                <h5 class="fw-bold mt-2">{{ $feedbacks->where('usia','>',50)->count() }}</h5>
                <small>Usia > 50</small>
            </div>
        </div>
    </div>
</div>





</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<!-- Custom Styling -->
<style>
    /* 🔹 Card Tabel */
    .card {
        border-radius: 1.2rem !important;
        overflow: hidden;
    }

    /* 🔹 Header Tabel */
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

    /* 🔹 Zebra Stripe Cerah */
    #feedbackTable tbody tr:nth-child(odd) {
        background-color: #ffffff; /* putih */
    }
    #feedbackTable tbody tr:nth-child(even) {
        background-color: #f1faff; /* biru muda */
    }

    /* 🔹 Hover Effect */
    #feedbackTable tbody tr:hover {
        background: #d0f0ff !important;
        transform: scale(1.01);
    }

    /* 🔹 Sel Tabel */
    #feedbackTable td {
        padding: 12px;
        vertical-align: middle;
    }

    /* 🔹 Kolom Warna Khusus */
    .email-cell {
        background-color: #fff3cd; /* kuning lembut */
        border-radius: 6px;
        padding: 8px;
    }
    .layanan-cell {
        background-color: #d4edda; /* hijau lembut */
        border-radius: 6px;
        padding: 8px;
    }
    .kunjungan-cell {
        background-color: #ffe5d9; /* oranye lembut */
        border-radius: 6px;
        padding: 8px;
    }

    /* 🔹 Shadow pada Table Container */
    .table-responsive {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    /* 🔹 DataTables Search dan Pagination */
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
</style>

<script>
$(document).ready(function () {
    $('#feedbackTable').DataTable({
        responsive: true,
        scrollX: true,
        autoWidth: false,
        pageLength: 10,
        language: {
            search: "🔍 Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            paginate: {
                first: "Awal",
                last: "Akhir",
                next: "›",
                previous: "‹"
            }
        }
    });

    // Tooltip bootstrap
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
});
</script>
@endsection
