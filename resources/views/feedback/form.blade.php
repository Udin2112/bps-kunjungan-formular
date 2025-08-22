<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Form Kunjungan BPS</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

  <style>
    :root {
      /* Warna khas BPS (approx) */
      --bps-blue: #005baa;
      --bps-green: #2bb673;
      --bps-orange: #f7941d;
      --bps-navy: #003a70;
      --body-bg: #f6f8fb;
    }

    body { background: var(--body-bg); }

    /* Navbar */
    .navbar-bps {
      background: linear-gradient(90deg, var(--bps-navy), var(--bps-blue));
    }
    .navbar-brand span {
      letter-spacing: .3px;
    }
    .nav-btn-outline { border-color: rgba(255,255,255,.6); color: #fff; }
    .nav-btn-outline:hover { background: rgba(255,255,255,.1); color: #fff; }

    /* Hero */
    .hero {
      background: linear-gradient(135deg, rgba(0,91,170,.12), rgba(43,182,115,.12));
      border: 1px solid rgba(0,0,0,.06);
    }

    /* Card form */
    .card-bps {
      border: 1px solid rgba(0,0,0,.06);
      box-shadow: 0 10px 30px rgba(0,0,0,.06);
      border-radius: 1rem;
    }
    .card-bps .card-header {
      border-bottom: 0;
      padding: 1.25rem 1.25rem 0 1.25rem;
      background: transparent;
    }

    /* Badge strip */
    .badge-bps { background: var(--bps-blue); }
    .badge-bps-green { background: var(--bps-green); }
    .badge-bps-orange { background: var(--bps-orange); }

    /* Section title bar */
    .section-title {
      display: flex; align-items: center; gap: .5rem;
      font-weight: 700; color: var(--bps-navy);
    }
    .section-title .bar { width: 6px; height: 22px; border-radius: 8px; background: var(--bps-orange); }

    /* Floating labels tweaks */
    .form-floating > label { color: #6b7280; }
    .form-control:focus, .form-select:focus {
      border-color: var(--bps-blue);
      box-shadow: 0 0 0 .2rem rgba(0,91,170,.15);
    }

    /* Primary button override */
    .btn-bps {
      background: linear-gradient(90deg, var(--bps-blue), var(--bps-green));
      border: none;
    }
    .btn-bps:hover { filter: brightness(.95); }

    /* Required asterisk */
    .required::after { content: "*"; color: var(--bps-orange); margin-left: .25rem; }

    /* Small helper */
    .helper { color: #6b7280; font-size: .85rem; }

    /* Footer */
    .mini-footer { color: #6b7280; font-size: .9rem; }

    /* Tombol Login khusus */
.nav-btn-outline {
  border-color: rgba(255,255,255,.6);
  color: #fff;
  transition: all .3s ease; /* biar smooth */
}

.nav-btn-outline:hover {
  background: var(--bps-orange);   /* 🔸 Jadi oren */
  border-color: var(--bps-orange); /* border ikut oren */
  color: #fff;                     /* teks tetap putih */
}
/* 🔹 Perbesar teks di navbar */
.navbar .nav-link {
  font-size: 1.1rem;   /* default sekitar 1rem → kita besarkan */
  font-weight: 600;    /* biar lebih tegas */
}

.navbar .nav-btn-outline {
  font-size: 1.05rem;  /* tombol login */
  font-weight: 600;
  padding: 0.4rem 0.9rem; /* agak longgar */
}


  </style>
</head>
<body>
  <!-- 🔹 Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-bps">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2" href="/">
        <i class="bi bi-bar-chart-line-fill fs-4 text-warning"></i>
        <span class="fw-bold">Buku Tamu BPS kota Langsa</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain" aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navMain">
        <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2 mt-3 mt-lg-0">
          <li class="nav-item"><a class="nav-link" href="#form">Form</a></li>
          <li class="nav-item"><a class="nav-link" href="#bantuan">Bantuan</a></li>
          @auth
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle me-2"></i> <strong>{{ Auth::user()->name }}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-end shadow">
            <li>
                <a href="{{ route('register') }}" 
                   class="dropdown-item d-flex align-items-center">
                   <i class="bi bi-person-plus-fill me-2"></i> Tambah Admin
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}" class="px-3 py-1">
                    @csrf
                    <button type="submit" class="btn btn-sm w-100 btn-outline-danger">
                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </li>
@else
    <li class="nav-item">
        <a href="{{ route('login') }}" class="btn nav-btn-outline btn-sm me-2">Login</a>
    </li>
@endauth



        </ul>
      </div>
    </div>
  </nav>

  <!-- 🔹 Hero / Intro -->
  <header class="py-4 py-lg-5">
    <div class="container">
      <div class="p-4 p-lg-5 rounded-4 hero">
        <div class="d-flex align-items-start gap-3">
          <div>
            <span class="badge badge-bps me-1">BPS</span>
            <span class="badge badge-bps-green me-1">Statistik</span>
            <span class="badge badge-bps-orange">Layanan</span>
            <h1 class="h3 h-lg-2 mt-3 mb-2 fw-bold text-dark">Form Kunjungan BPS</h1>
            <p class="mb-0 helper">Mohon lengkapi data berikut untuk kebutuhan layanan statistik. Tanda <span class="text-warning">*</span> wajib diisi.</p>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- 🔹 Form Card -->
  <main id="form" class="container pb-5">
    @if(session('success'))
      <div class="alert alert-success shadow-sm"><i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}</div>
    @endif

    <div class="card card-bps overflow-hidden">
      <div class="card-header">
        <div class="section-title mb-2"><span class="bar"></span>Data Pengunjung</div>
      </div>
      <div class="card-body p-3 p-lg-4">
        <form action="{{ route('feedback.store') }}" method="POST" novalidate>
          @csrf

          <div class="row g-3">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" name="first_name" id="first_name" placeholder="Nama Depan" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required />
                <label for="first_name" class="required">Nama Depan</label>
                @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" name="last_name" id="last_name" placeholder="Nama Belakang" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required />
                <label for="last_name" class="required">Nama Belakang</label>
                @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="email" name="email" id="email" placeholder="nama@contoh.id" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required />
                <label for="email" class="required">Email</label>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="col-md-6">
  <div class="form-floating">
    <input type="tel" name="phone" id="phone" placeholder="08xxxxxxxxxx" 
           inputmode="numeric" pattern="[0-9\s+()-]*" 
           class="form-control @error('phone') is-invalid @enderror" 
           value="{{ old('phone') }}" required />
    <label for="phone" class="required">Telepon</label>
    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
  <div class="form-text">Boleh nomor hp atau nomor whatsapp</div>
</div>

          </div>

          <div class="row g-3">
    <!-- Alamat -->
    <div class="col-12">
        <div class="form-floating">
            <textarea name="alamat" id="alamat" rows="2"
                class="form-control @error('alamat') is-invalid @enderror"
                style="height: 80px"
                placeholder="Alamat lengkap">{{ old('alamat') }}</textarea>
            <label for="alamat" class="required">Alamat</label>
            @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <!-- Jenis Kelamin -->
    <div class="col-md-6">
        <div class="form-floating">
            <select name="jenis_kelamin" id="jenis_kelamin"
                class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                <option value="" selected>— Pilih —</option>
                <option value="Laki-laki" {{ old('jenis_kelamin')=='Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin')=='Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            <label for="jenis_kelamin" class="required">Jenis Kelamin</label>
            @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <!-- Usia -->
    <div class="col-md-3">
        <div class="form-floating">
            <input type="number" name="usia" id="usia"
                class="form-control @error('usia') is-invalid @enderror"
                placeholder="0"
                min="10" max="100"
                value="{{ old('usia') }}" required />
            <label for="usia" class="required">Usia</label>
            @error('usia') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <!-- Tanggal Kunjungan -->
    <div class="col-md-3">
        <div class="form-floating">
            <input type="date" name="tanggal_kunjungan" id="tanggal_kunjungan"
                class="form-control @error('tanggal_kunjungan') is-invalid @enderror"
                value="{{ old('tanggal_kunjungan', now()->toDateString()) }}" required />
            <label for="tanggal_kunjungan" class="required">Tanggal Kunjungan</label>
            @error('tanggal_kunjungan') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
</div>


          <hr class="my-4" />
          <div class="section-title mb-3"><span class="bar"></span>Detail Kebutuhan</div>

          <div class="row g-3">
            <div class="col-md-6">
              <div class="form-floating">
                <select name="pekerjaan" id="pekerjaan" class="form-select @error('pekerjaan') is-invalid @enderror" required>
                  <option value="" selected>— Pilih —</option>
                  <option value="pelajar/mahasiswa" {{ old('pekerjaan')=='pelajar/mahasiswa' ? 'selected' : '' }}>Pelajar/Mahasiswa</option>
                  <option value="peneliti/dosen" {{ old('pekerjaan')=='peneliti/dosen' ? 'selected' : '' }}>Peneliti/Dosen</option>
                  <option value="asn/tni/polri" {{ old('pekerjaan')=='asn/tni/polri' ? 'selected' : '' }}>ASN/TNI/Polri</option>
                  <option value="pegawai bumn/d" {{ old('pekerjaan')=='pegawai bumn/d' ? 'selected' : '' }}>Pegawai BUMN/D</option>
                  <option value="pegawai swasta" {{ old('pekerjaan')=='pegawai swasta' ? 'selected' : '' }}>Pegawai Swasta</option>
                  <option value="wiraswasta" {{ old('pekerjaan')=='wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                  <option value="lainnya" {{ old('pekerjaan')=='lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                <label for="pekerjaan" class="required">Pekerjaan Utama</label>
                @error('pekerjaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <select name="instansi" id="instansi" class="form-select @error('instansi') is-invalid @enderror" required>
                  <option value="" selected>— Pilih —</option>
                  <option value="lembaga negara" {{ old('instansi')=='lembaga negara' ? 'selected' : '' }}>Lembaga Negara</option>
                  <option value="kementrian/lembaga pemerintah" {{ old('instansi')=='kementrian/lembaga pemerintah' ? 'selected' : '' }}>Kementerian & Lembaga Pemerintah</option>
                  <option value="tni/polri/bin/kejaksaan" {{ old('instansi')=='tni/polri/bin/kejaksaan' ? 'selected' : '' }}>TNI/Polri/BIN/Kejaksaan</option>
                  <option value="pemerintah daerah" {{ old('instansi')=='pemerintah daerah' ? 'selected' : '' }}>Pemerintah Daerah</option>
                  <option value="lembaga internasional" {{ old('instansi')=='lembaga internasional' ? 'selected' : '' }}>Lembaga Internasional</option>
                  <option value="lembaga penelitian/pendidikan" {{ old('instansi')=='lembaga penelitian/pendidikan' ? 'selected' : '' }}>Lembaga Penelitian & Pendidikan</option>
                  <option value="bumn/d" {{ old('instansi')=='bumn/d' ? 'selected' : '' }}>BUMN/D</option>
                  <option value="swasta" {{ old('instansi')=='swasta' ? 'selected' : '' }}>Swasta</option>
                  <option value="lainnya" {{ old('instansi')=='lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                <label for="instansi" class="required">Asal Instansi</label>
                @error('instansi') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <select name="layanan" id="layanan" class="form-select @error('layanan') is-invalid @enderror" required>
                  <option value="" selected>— Pilih —</option>
                  <option value="perpustakaan" {{ old('layanan')=='perpustakaan' ? 'selected' : '' }}>Perpustakaan</option>
                  <option value="pembelian publikasi bps" {{ old('layanan')=='pembelian publikasi bps' ? 'selected' : '' }}>Pembelian Publikasi BPS</option>
                  <option value="pembelian data mikro/peta wilkerstat" {{ old('layanan')=='pembelian data mikro/peta wilkerstat' ? 'selected' : '' }}>Pembelian Data Mikro/Peta Wilkerstat</option>
                  <option value="akses produk statistik pada website" {{ old('layanan')=='akses produk statistik pada website' ? 'selected' : '' }}>Akses Produk Statistik pada Website</option>
                  <option value="konsultasi statistik" {{ old('layanan')=='konsultasi statistik' ? 'selected' : '' }}>Konsultasi Statistik</option>
                  <option value="rekomendasi kegiatan statistik" {{ old('layanan')=='rekomendasi kegiatan statistik' ? 'selected' : '' }}>Rekomendasi Kegiatan Statistik</option>
                   <option value="lainnya" {{ old('layanan')=='lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                <label for="layanan" class="required">Jenis Layanan</label>
                @error('layanan') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <select name="kunjungan" id="kunjungan" class="form-select @error('kunjungan') is-invalid @enderror" required>
                  <option value="" selected>— Pilih —</option>
                  <option value="tugas sekolah/kuliah" {{ old('kunjungan')=='tugas sekolah/kuliah' ? 'selected' : '' }}>Tugas Sekolah/Kuliah</option>
                  <option value="pemerintahan" {{ old('kunjungan')=='pemerintahan' ? 'selected' : '' }}>Pemerintahan</option>
                  <option value="komersial" {{ old('kunjungan')=='komersial' ? 'selected' : '' }}>Komersial</option>
                  <option value="penelitian" {{ old('kunjungan')=='penelitian' ? 'selected' : '' }}>Penelitian</option>
                  <option value="lainnya" {{ old('kunjungan')=='lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                <label for="kunjungan" class="required">Pemanfaatan Kunjungan</label>
                @error('kunjungan') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>

            <div class="col-12">
              <div class="form-floating">
                <textarea name="message" id="message" rows="4" class="form-control @error('message') is-invalid @enderror" style="height: 140px" placeholder="Tuliskan pesan atau detail kebutuhan Anda di sini..." required>{{ old('message') }}</textarea>
                <label for="message" class="required">Pesan</label>
                @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="form-text">Contoh: “Memerlukan data kemiskinan tingkat kabupaten 2021–2024.”</div>
            </div>
          </div>

            <!-- Survei (Skala 1 - 5) -->
        <!-- 🔹 Survei Kualitas Pelayanan -->
<!-- 🔹 Survei Kualitas Pelayanan -->
<div class="mt-4">
  <label class="form-label fw-bold d-block mb-3 fs-5 text-center">
    Bagaimana Kualitas Pelayanan BPS Kota Langsa?
  </label>

  <div class="text-center">
    <!-- Skala rating -->
    <div class="d-flex justify-content-center gap-2 flex-wrap mb-2">
      @for ($i = 1; $i <= 5; $i++)
        <input type="radio" class="btn-check" name="survei" id="survei{{ $i }}" value="{{ $i }}" required>
        <label class="btn btn-outline-primary rounded-circle d-flex align-items-center justify-content-center fw-bold"
               style="width: 42px; height: 42px; font-size: 1rem;" for="survei{{ $i }}">
          {{ $i }}
        </label>
      @endfor
    </div>

    <!-- Keterangan skala -->
    <div class="d-flex justify-content-between px-3">
      <small class="text-danger fw-semibold">1 = Sangat Buruk</small>
      <small class="text-success fw-semibold">5 = Sangat Baik</small>
    </div>
  </div>
</div>




          <div class="d-grid d-sm-flex justify-content-sm-end gap-3 mt-4">
            <a href="/" class="btn btn-outline-secondary"><i class="bi bi-arrow-left-short me-1"></i> Kembali</a>
            <button type="submit" class="btn btn-bps"><i class="bi bi-send-fill me-1"></i> Kirim</button>
          </div>
        </form>
      </div>
    </div>

    <p id="bantuan" class="mini-footer text-center mt-4">Butuh bantuan? Hubungi <a href="#" class="link-primary text-decoration-none">Layanan Statistik BPS</a>.</p>
  </main>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
