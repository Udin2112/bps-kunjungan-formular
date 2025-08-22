@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Judul -->
    <h3 class="mb-4 fw-bold text-primary">
        🛡️ Register Admin Baru
    </h3>

    <!-- Card Form -->
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('admin.register.store') }}">
                @csrf

                <!-- Input Nama -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">👤 Nama</label>
                    <input id="name" type="text" class="form-control form-control-lg shadow-sm rounded-3" 
                           name="name" placeholder="Masukkan nama lengkap" required autofocus>
                </div>

                <!-- Input Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">📧 Email</label>
                    <input id="email" type="email" class="form-control form-control-lg shadow-sm rounded-3" 
                           name="email" placeholder="contoh@email.com" required>
                </div>

                <!-- Input Password -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">🔑 Password</label>
                    <input id="password" type="password" class="form-control form-control-lg shadow-sm rounded-3" 
                           name="password" placeholder="Minimal 8 karakter" required>
                </div>

                <!-- Input Konfirmasi Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label fw-semibold">✅ Konfirmasi Password</label>
                    <input id="password_confirmation" type="password" class="form-control form-control-lg shadow-sm rounded-3" 
                           name="password_confirmation" placeholder="Ulangi password" required>
                </div>

                <!-- Tombol Submit -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg rounded-3 shadow-sm">
                        ➕ Tambah Admin
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Sedikit Styling Custom -->
<style>
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
    .card {
        background: #ffffff;
    }
</style>
@endsection
