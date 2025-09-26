@extends('layouts.app')

@section('content')
<div class="container">
    {{-- 🔹 Header Utama --}}
    <div class="p-4 mb-4 rounded-3 shadow-sm text-white" 
         style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
        <h3 class="fw-bold mb-1">
            <i class="bi bi-shield-lock-fill me-2 text-warning"></i> Register Admin Baru
        </h3>
        <p class="mb-0">Silakan isi form berikut untuk menambahkan admin baru ke sistem.</p>
    </div>

    <!-- Card Form -->
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('admin.register.store') }}">
                @csrf

                <!-- Input Nama -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">
                        <i class="bi bi-person-fill me-2 text-primary"></i> Nama
                    </label>
                    <input id="name" type="text" class="form-control form-control-lg shadow-sm rounded-3" 
                           name="name" placeholder="Masukkan nama lengkap" required autofocus>
                </div>

                <!-- Input Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">
                        <i class="bi bi-envelope-fill me-2 text-success"></i> Email
                    </label>
                    <input id="email" type="email" class="form-control form-control-lg shadow-sm rounded-3" 
                           name="email" placeholder="contoh@email.com" required>
                </div>

                <!-- Input Password -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">
                        <i class="bi bi-lock-fill me-2 text-danger"></i> Password
                    </label>
                    <input id="password" type="password" class="form-control form-control-lg shadow-sm rounded-3" 
                           name="password" placeholder="Minimal 8 karakter" required>
                </div>

                <!-- Input Konfirmasi Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label fw-semibold">
                        <i class="bi bi-check-circle-fill me-2 text-success"></i> Konfirmasi Password
                    </label>
                    <input id="password_confirmation" type="password" class="form-control form-control-lg shadow-sm rounded-3" 
                           name="password_confirmation" placeholder="Ulangi password" required>
                </div>

                <!-- Tombol Submit -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-gradient btn-lg rounded-3 shadow-sm">
                        ➕ Tambah Admin
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- 🔹 Styling Konsisten -->
<style>
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
    .card {
        background: #ffffff;
    }

    /* 🔹 Tombol gradasi konsisten */
    .btn-gradient {
        background: linear-gradient(135deg, #6a11cb, #2575fc) !important;
        border: none !important;
        color: #fff !important;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease-in-out;
    }

    .btn-gradient:hover {
        background: linear-gradient(135deg, #5a0fb5, #1e63d4) !important; /* lebih gelap saat hover */
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.2);
    }
</style>
@endsection