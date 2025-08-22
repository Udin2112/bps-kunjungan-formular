@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Judul -->
    <h3 class="mb-4 fw-bold text-primary">
        ✏️ Edit Feedback
    </h3>

    <!-- Card -->
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h5 class="mb-0 fw-semibold">📋 Data Pengunjung</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('feedback.update', $feedback->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <!-- Nama Depan -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control shadow-sm rounded-3" id="first_name" name="first_name"
                                placeholder="Nama Depan" value="{{ old('first_name', $feedback->first_name) }}" required>
                            <label for="first_name">Nama Depan</label>
                        </div>
                    </div>

                    <!-- Nama Belakang -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control shadow-sm rounded-3" id="last_name" name="last_name"
                                placeholder="Nama Belakang" value="{{ old('last_name', $feedback->last_name) }}" required>
                            <label for="last_name">Nama Belakang</label>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="email" class="form-control shadow-sm rounded-3" id="email" name="email"
                                placeholder="nama@contoh.id" value="{{ old('email', $feedback->email) }}" required>
                            <label for="email">Email</label>
                        </div>
                    </div>

                    <!-- Telepon -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="tel" class="form-control shadow-sm rounded-3" id="phone" name="phone"
                                placeholder="08xxxxxxxxxx" value="{{ old('phone', $feedback->phone) }}" required>
                            <label for="phone">Telepon</label>
                        </div>
                        <div class="form-text">Boleh nomor HP atau WhatsApp</div>
                    </div>

                    <!-- Alamat -->
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea class="form-control shadow-sm rounded-3" id="alamat" name="alamat" style="height:100px"
                                placeholder="Alamat lengkap" required>{{ old('alamat', $feedback->alamat) }}</textarea>
                            <label for="alamat">Alamat</label>
                        </div>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select shadow-sm rounded-3" name="jenis_kelamin" id="jenis_kelamin" required>
                                <option value="">— Pilih —</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin', $feedback->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $feedback->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                        </div>
                    </div>

                    <!-- Usia -->
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="number" class="form-control shadow-sm rounded-3" name="usia" id="usia" min="10" max="100"
                                value="{{ old('usia', $feedback->usia) }}" placeholder="Usia" required>
                            <label for="usia">Usia</label>
                        </div>
                    </div>

                    <!-- Tanggal Kunjungan -->
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="date" class="form-control shadow-sm rounded-3" name="tanggal_kunjungan" id="tanggal_kunjungan"
                                value="{{ old('tanggal_kunjungan', $feedback->tanggal_kunjungan) }}" required>
                            <label for="tanggal_kunjungan">Tanggal Kunjungan</label>
                        </div>
                    </div>

                    <!-- Pekerjaan -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select shadow-sm rounded-3" name="pekerjaan" id="pekerjaan" required>
                                <option value="">— Pilih —</option>
                                @foreach(['pelajar/mahasiswa','peneliti/dosen','asn/tni/polri','pegawai bumn/d','pegawai swasta','wiraswasta','lainnya'] as $job)
                                    <option value="{{ $job }}" {{ old('pekerjaan', $feedback->pekerjaan) == $job ? 'selected' : '' }}>
                                        {{ ucfirst($job) }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="pekerjaan">Pekerjaan Utama</label>
                        </div>
                    </div>

                    <!-- Instansi -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select shadow-sm rounded-3" name="instansi" id="instansi" required>
                                <option value="">— Pilih —</option>
                                @foreach(['lembaga negara','kementrian/lembaga pemerintah','tni/polri/bin/kejaksaan','pemerintah daerah','lembaga internasional','lembaga penelitian/pendidikan','bumn/d','swasta','lainnya'] as $inst)
                                    <option value="{{ $inst }}" {{ old('instansi', $feedback->instansi) == $inst ? 'selected' : '' }}>
                                        {{ ucfirst($inst) }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="instansi">Asal Instansi</label>
                        </div>
                    </div>

                    <!-- Layanan -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select shadow-sm rounded-3" name="layanan" id="layanan" required>
                                <option value="">— Pilih —</option>
                                @foreach(['perpustakaan','pembelian publikasi bps','pembelian data mikro/peta wilkerstat','akses produk statistik pada website','konsultasi statistik','rekomendasi kegiatan statistik','lainnya'] as $service)
                                    <option value="{{ $service }}" {{ old('layanan', $feedback->layanan) == $service ? 'selected' : '' }}>
                                        {{ ucfirst($service) }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="layanan">Jenis Layanan</label>
                        </div>
                    </div>

                    <!-- Pemanfaatan Kunjungan -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select shadow-sm rounded-3" name="kunjungan" id="kunjungan" required>
                                <option value="">— Pilih —</option>
                                @foreach(['tugas sekolah/kuliah','pemerintahan','komersial','penelitian','lainnya'] as $use)
                                    <option value="{{ $use }}" {{ old('kunjungan', $feedback->kunjungan) == $use ? 'selected' : '' }}>
                                        {{ ucfirst($use) }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="kunjungan">Pemanfaatan Kunjungan</label>
                        </div>
                    </div>

                    <!-- Pesan -->
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea class="form-control shadow-sm rounded-3" name="message" id="message" style="height:120px"
                                placeholder="Tuliskan kebutuhan Anda..." required>{{ old('message', $feedback->message) }}</textarea>
                            <label for="message">Pesan / Kebutuhan</label>
                        </div>
                    </div>

                    <!-- Survei -->
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="number" class="form-control shadow-sm rounded-3" name="survei" id="survei" min="1" max="5"
                                value="{{ old('survei', $feedback->survei) }}" placeholder="Skor 1-5" required>
                            <label for="survei">Survei Kualitas Pelayanan (1-5)</label>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-4 d-flex gap-2 justify-content-end">
                    <button type="submit" class="btn btn-bps btn-lg rounded-3 shadow-sm">
                        💾 Simpan Perubahan
                    </button>
                    <a href="{{ route('laporan.index') }}" class="btn btn-outline-secondary btn-lg rounded-3 shadow-sm">
                        ❌ Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Custom Styling -->
<style>
    /* Warna khas BPS */
    .btn-bps {
        background: linear-gradient(90deg,#005baa,#2bb673);
        color: #fff;
        border: none;
        transition: all .3s ease-in-out;
    }
    .btn-bps:hover {
        filter: brightness(.9);
        transform: translateY(-1px);
    }
    .form-control:focus, .form-select:focus {
        border-color: #005baa;
        box-shadow: 0 0 0 0.2rem rgba(0,91,170,0.25);
    }
</style>
@endsection
