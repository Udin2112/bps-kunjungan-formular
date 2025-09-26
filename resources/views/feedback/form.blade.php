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
.section-title, 
.section-title + .row {
  padding-left: 1.5rem;
  padding-right: 1.5rem;
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
            <a href="{{ route('admin.register') }}" class="dropdown-item d-flex align-items-center">
    <i class="bi bi-person-plus-fill me-2"></i> Tambah Admin
</a>

            <li>
                <form method="POST" action="{{ route('feedback.store') }}" 
      class="needs-validation" novalidate>

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

    {{-- 🔹 Pesan error --}}
    @if ($errors->any())
      <div class="alert alert-danger shadow-sm">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <strong>Periksa kembali input Anda:</strong>
        <ul class="mb-0 mt-2">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="card card-bps overflow-hidden">
      <div class="card-header">
        <div class="section-title mb-2"><span class="bar"></span>Data Pengunjung</div>
      </div>
      <div class="card-body p-3 p-lg-4">
        <form action="{{ route('feedback.store') }}" method="POST" novalidate>
          @csrf

         
  <div class="row g-3">
  <!-- Nama -->
  <div class="col-md-6">
    <div class="form-floating">
      <input type="text" name="first_name" id="first_name" placeholder="Nama Depan"
             class="form-control @error('first_name') is-invalid @enderror"
             value="{{ old('first_name') }}" 
             required pattern="^[\p{L}\s]+$" maxlength="100" />
      <label for="first_name" class="required">Nama</label>

      <div class="invalid-feedback">
        Nama hanya boleh berisi huruf dan spasi.
      </div>
      <div class="valid-feedback">
        ✅ Nama valid.
      </div>

      @error('first_name') 
        <div class="invalid-feedback">{{ $message }}</div> 
      @enderror
    </div>
    <div class="form-text">Isi nama lengkap sesuai identitas (hanya huruf dan spasi).</div>
  </div>

  <!-- Email -->
  <div class="col-md-6">
    <div class="form-floating">
      <input type="email" name="email" id="email" placeholder="nama@contoh.id"
             class="form-control @error('email') is-invalid @enderror"
             value="{{ old('email') }}" required />
      <label for="email" class="required">Email</label>

      <div class="invalid-feedback">
        Masukkan alamat email yang valid (contoh: anonim@gmail.com).
      </div>
      <div class="valid-feedback">
        ✅ Email valid.
      </div>

      @error('email') 
        <div class="invalid-feedback">{{ $message }}</div> 
      @enderror
    </div>
    <div class="form-text">Contoh: anonim@gmail.com</div>
  </div>
</div>

<div class="row g-3">
  <!-- Telepon -->
  <div class="col-md-6">
    <div class="form-floating">
      <input type="tel" name="phone" id="phone" placeholder="08xxxxxxxxxx"
             inputmode="numeric" 
             pattern="^[0-9]{10,15}$"
             class="form-control @error('phone') is-invalid @enderror"
             value="{{ old('phone') }}" required />
      <label for="phone" class="required">Telepon</label>

      <div class="invalid-feedback">
        Nomor telepon harus berupa 10–15 digit angka.
      </div>
      <div class="valid-feedback">
        ✅ Nomor telepon valid.
      </div>

      @error('phone') 
        <div class="invalid-feedback">{{ $message }}</div> 
      @enderror
    </div>
    <div class="form-text">Masukkan nomor HP/WhatsApp aktif (10–15 digit angka, contoh: 08123456789)</div>
  </div>

  <!-- Usia -->
  <div class="col-md-6">
    <div class="form-floating">
      <input type="number" name="usia" id="usia"
             class="form-control @error('usia') is-invalid @enderror"
             placeholder="0"
             min="10" max="100"
             value="{{ old('usia') }}" required />
      <label for="usia" class="required">Usia</label>

      <div class="invalid-feedback">
        Usia harus berupa angka antara 10–100 tahun.
      </div>
      <div class="valid-feedback">
        ✅ Usia valid.
      </div>

      @error('usia') 
        <div class="invalid-feedback">{{ $message }}</div> 
      @enderror
    </div>
    <div class="form-text">Cukup isi angka saja (tahun). Contoh: 25</div>
  </div>
</div>


<div class="row g-3">
  <!-- Alamat -->
  <div class="col-12">
    <div class="form-floating">
      <textarea name="alamat" id="alamat" rows="2"
        class="form-control @error('alamat') is-invalid @enderror"
        style="height: 80px"
        placeholder="Alamat lengkap"
        required minlength="10" maxlength="255">{{ old('alamat') }}</textarea>
      <label for="alamat" class="required">Alamat</label>

      <!-- 🔎 Validasi sisi client (Bootstrap) -->
      <div class="invalid-feedback">
        Alamat wajib diisi (minimal 10 karakter, maksimal 255).
      </div>
      <div class="valid-feedback">
        ✅ Alamat valid.
      </div>

      <!-- 🔎 Validasi sisi server (Laravel) -->
      @error('alamat') 
        <div class="invalid-feedback">{{ $message }}</div> 
      @enderror
    </div>
    <div class="form-text">
      Contoh: Jl. Merdeka No.12, Kec. Sukmajaya, Kota Bogor
    </div>
  </div>
</div>


<!-- Jenis Kelamin & Tanggal Kunjungan -->
<div class="row g-3">
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

  <!-- Tanggal Kunjungan -->
  <div class="col-md-6">
    <div class="form-floating">
      <input type="date" name="tanggal_kunjungan" id="tanggal_kunjungan"
          class="form-control @error('tanggal_kunjungan') is-invalid @enderror"
          value="{{ old('tanggal_kunjungan', now()->toDateString()) }}" required />
      <label for="tanggal_kunjungan" class="required">Tanggal Kunjungan</label>
      @error('tanggal_kunjungan') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
  </div>
</div>

</div>


          <hr class="my-4" />
          <div class="section-title mb-3"><span class="bar"></span>Detail Kebutuhan</div>

          <div class="row g-3">
            <div class="col-12">
  <div class="form-floating">
    <select name="keperluan" id="keperluan"
      class="form-select @error('keperluan') is-invalid @enderror" required>
      <option value="" selected>— Pilih —</option>
       <option value="pst" {{ old('keperluan')=='pst' ? 'selected' : '' }}>
        PST (Pelayanan Statistik Terpadu)
      </option>
      <option value="bertemu subject matter" {{ old('keperluan')=='bertemu subject matter' ? 'selected' : '' }}>
        Bertemu dengan Subject Matter Kegiatan (bertemu pegawai)
      </option>
     
      <option value="undangan rapat" {{ old('keperluan')=='undangan rapat' ? 'selected' : '' }}>
        Menghadiri Undangan (Rapat)
      </option>
      <option value="lainnya" {{ old('keperluan')=='lainnya' ? 'selected' : '' }}>
        Lainnya
      </option>
    </select>
    <label for="keperluan" class="required">Keperluan</label>
    @error('keperluan')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-text">
    Silakan pilih sesuai tujuan utama kunjungan Anda.  
    Jika tidak ada dalam daftar, pilih <b>Lainnya</b> dan isi manual.
  </div>
</div>

<!-- Input manual jika pilih "Lainnya" -->
<div class="col-md-6 d-none" id="keperluan_lainnya_wrap">
  <div class="form-floating">
    <input type="text" name="keperluan_lainnya" id="keperluan_lainnya"
      class="form-control"
      placeholder="Isi keperluan lainnya"
      value="{{ old('keperluan_lainnya') }}" />
    <label for="keperluan_lainnya">Keperluan (Lainnya)</label>
  </div>
</div>



          <!-- PEKERJAAN -->
<div class="col-12">
  <div class="form-floating">
    <select name="pekerjaan" id="pekerjaan" class="form-select @error('pekerjaan') is-invalid @enderror" required>
      <option value="" selected>— Pilih —</option>
      <option value="pelajar/mahasiswa" {{ old('pekerjaan')=='pelajar/mahasiswa' ? 'selected' : '' }}>
        Pelajar/Mahasiswa (sedang menempuh pendidikan)
      </option>
      <option value="peneliti/dosen" {{ old('pekerjaan')=='peneliti/dosen' ? 'selected' : '' }}>
        Peneliti/Dosen (akademisi, pengajar, peneliti)
      </option>
      <option value="asn/tni/polri" {{ old('pekerjaan')=='asn/tni/polri' ? 'selected' : '' }}>
        ASN/TNI/Polri (pegawai negeri, aparat keamanan)
      </option>
      <option value="pegawai bumn/d" {{ old('pekerjaan')=='pegawai bumn/d' ? 'selected' : '' }}>
        Pegawai BUMN/D (TVRI, RRI, LKBN Antara, dsb.)
      </option>
      <option value="pegawai swasta" {{ old('pekerjaan')=='pegawai swasta' ? 'selected' : '' }}>
        Pegawai Swasta (karyawan perusahaan, wartawan media swasta)
      </option>
      <option value="wiraswasta" {{ old('pekerjaan')=='wiraswasta' ? 'selected' : '' }}>
        Wiraswasta (usaha sendiri, entrepreneur, freelancer)
      </option>
      <option value="lainnya" {{ old('pekerjaan')=='lainnya' ? 'selected' : '' }}>
        Lainnya
      </option>
    </select>
    <label for="pekerjaan" class="required">Pekerjaan Utama</label>
    @error('pekerjaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
  <div class="form-text">Jika pekerjaan Anda tidak ada dalam daftar, silakan pilih <b>Lainnya</b> lalu ketikkan manual.</div>
</div>
<div class="col-md-6 {{ old('pekerjaan')=='lainnya' ? '' : 'd-none' }}" id="pekerjaan_lainnya_wrap">
  <div class="form-floating">
    <input type="text" class="form-control" id="pekerjaan_lainnya" name="pekerjaan_lainnya"
      value="{{ old('pekerjaan_lainnya') }}" placeholder="Masukkan pekerjaan lainnya">
    <label for="pekerjaan_lainnya">Pekerjaan Lainnya</label>
  </div>
</div>

<!-- INSTANSI -->
<div class="col-12">
  <div class="form-floating">
    <select name="instansi" id="instansi" class="form-select @error('instansi') is-invalid @enderror" required>
      <option value="" selected>— Pilih —</option>
      <option value="lembaga negara" {{ old('instansi')=='lembaga negara' ? 'selected' : '' }}>
        Lembaga Negara (DPR, MPR, BPK, dll.)
      </option>
      <option value="kementrian/lembaga pemerintah" {{ old('instansi')=='kementrian/lembaga pemerintah' ? 'selected' : '' }}>
        Kementerian & Lembaga Pemerintah (Kemenkeu, BPS, dll.)
      </option>
      <option value="tni/polri/bin/kejaksaan" {{ old('instansi')=='tni/polri/bin/kejaksaan' ? 'selected' : '' }}>
        TNI/Polri/BIN/Kejaksaan (instansi pertahanan & keamanan)
      </option>
      <option value="pemerintah daerah" {{ old('instansi')=='pemerintah daerah' ? 'selected' : '' }}>
        Pemerintah Daerah (provinsi, kabupaten/kota)
      </option>
      <option value="lembaga internasional" {{ old('instansi')=='lembaga internasional' ? 'selected' : '' }}>
        Lembaga Internasional (UN, World Bank, dll.)
      </option>
      <option value="lembaga penelitian/pendidikan" {{ old('instansi')=='lembaga penelitian/pendidikan' ? 'selected' : '' }}>
        Lembaga Penelitian & Pendidikan (kampus, BRIN, lembaga riset)
      </option>
      <option value="bumn/d" {{ old('instansi')=='bumn/d' ? 'selected' : '' }}>
        BUMN/D (TVRI, RRI, Antara, PLN, Pertamina, dll.)
      </option>
      <option value="swasta" {{ old('instansi')=='swasta' ? 'selected' : '' }}>
        Swasta (perusahaan, media massa swasta, LSM)
      </option>
      <option value="lainnya" {{ old('instansi')=='lainnya' ? 'selected' : '' }}>
        Lainnya
      </option>
    </select>
    <label for="instansi" class="required">Asal Instansi</label>
    @error('instansi') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
  <div class="form-text">Jika instansi Anda tidak tersedia di daftar, pilih <b>Lainnya</b> dan tulis manual.</div>
</div>
<div class="col-md-6 {{ old('instansi')=='lainnya' ? '' : 'd-none' }}" id="instansi_lainnya_wrap">
  <div class="form-floating">
    <input type="text" class="form-control" id="instansi_lainnya" name="instansi_lainnya"
      value="{{ old('instansi_lainnya') }}" placeholder="Masukkan instansi lainnya">
    <label for="instansi_lainnya">Instansi Lainnya</label>
  </div>
</div>

<!-- LAYANAN -->
<div class="col-12">
  <div class="form-floating">
    <select name="layanan" id="layanan" class="form-select @error('layanan') is-invalid @enderror" required>
      <option value="" selected>— Pilih —</option>
      <option value="perpustakaan" {{ old('layanan')=='perpustakaan' ? 'selected' : '' }}>
        Perpustakaan (membaca publikasi/statistik di ruang baca)
      </option>
      <option value="pembelian publikasi bps" {{ old('layanan')=='pembelian publikasi bps' ? 'selected' : '' }}>
        Pembelian Publikasi BPS (buku, laporan, dll.)
      </option>
      <option value="pembelian data mikro/peta wilkerstat" {{ old('layanan')=='pembelian data mikro/peta wilkerstat' ? 'selected' : '' }}>
        Pembelian Data Mikro/Peta Wilkerstat (raw data, peta statistik)
      </option>
      <option value="akses produk statistik pada website" {{ old('layanan')=='akses produk statistik pada website' ? 'selected' : '' }}>
        Akses Produk Statistik pada Website (BRS, tabel dinamis, dll.)
      </option>
      <option value="konsultasi statistik" {{ old('layanan')=='konsultasi statistik' ? 'selected' : '' }}>
        Konsultasi Statistik (diskusi metode, data, indikator)
      </option>
      <option value="rekomendasi kegiatan statistik" {{ old('layanan')=='rekomendasi kegiatan statistik' ? 'selected' : '' }}>
        Rekomendasi Kegiatan Statistik (survei, penelitian, izin kegiatan)
      </option>
      <option value="lainnya" {{ old('layanan')=='lainnya' ? 'selected' : '' }}>
        Lainnya 
      </option>
    </select>
    <label for="layanan" class="required">Jenis Layanan</label>
    @error('layanan') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
  <div class="form-text">Jika jenis layanan tidak sesuai, pilih <b>Lainnya</b> dan isi sesuai kebutuhan.</div>
</div>
<div class="col-md-6 {{ old('layanan')=='lainnya' ? '' : 'd-none' }}" id="layanan_lainnya_wrap">
  <div class="form-floating">
    <input type="text" class="form-control" id="layanan_lainnya" name="layanan_lainnya"
      value="{{ old('layanan_lainnya') }}" placeholder="Masukkan layanan lainnya">
    <label for="layanan_lainnya">Layanan Lainnya</label>
  </div>
</div>

<!-- KUNJUNGAN -->
<div class="col-12">
  <div class="form-floating">
    <select name="kunjungan" id="kunjungan" class="form-select @error('kunjungan') is-invalid @enderror" required>
      <option value="" selected>— Pilih —</option>
      <option value="tugas sekolah/kuliah" {{ old('kunjungan')=='tugas sekolah/kuliah' ? 'selected' : '' }}>
        Tugas Sekolah/Kuliah (pengumpulan data untuk laporan/tugas)
      </option>
      <option value="pemerintahan" {{ old('kunjungan')=='pemerintahan' ? 'selected' : '' }}>
        Pemerintahan (kegiatan dinas, koordinasi instansi)
      </option>
      <option value="komersial" {{ old('kunjungan')=='komersial' ? 'selected' : '' }}>
        Komersial (penggunaan data untuk bisnis/usaha)
      </option>
      <option value="penelitian" {{ old('kunjungan')=='penelitian' ? 'selected' : '' }}>
        Penelitian (skripsi, tesis, riset ilmiah)
      </option>
      <option value="lainnya" {{ old('kunjungan')=='lainnya' ? 'selected' : '' }}>
        Lainnya 
      </option>
    </select>
    <label for="kunjungan" class="required">Pemanfaatan Kunjungan</label>
    @error('kunjungan') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
  <div class="form-text">Jika tujuan kunjungan tidak tersedia, pilih <b>Lainnya</b> dan isi manual.</div>
</div>
<div class="col-md-6 {{ old('kunjungan')=='lainnya' ? '' : 'd-none' }}" id="kunjungan_lainnya_wrap">
  <div class="form-floating">
    <input type="text" class="form-control" id="kunjungan_lainnya" name="kunjungan_lainnya"
      value="{{ old('kunjungan_lainnya') }}" placeholder="Masukkan kunjungan lainnya">
    <label for="kunjungan_lainnya">Kunjungan Lainnya</label>
  </div>
</div>




            <div class="col-12" id="message_wrap">
  <div class="form-floating">
    <textarea name="message" id="message" rows="4"
      class="form-control @error('message') is-invalid @enderror"
      style="height: 140px"
      placeholder="Tuliskan pesan atau detail kebutuhan Anda di sini..."
      required>{{ old('message') }}</textarea>
    <label for="message" class="required">Pesan</label>
    @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
  <div class="form-text">
    Contoh:  
    • Memerlukan data kemiskinan tingkat kabupaten 2021–2024  
    • Ingin bertemu Subject Matter terkait publikasi IPM  
    • Menghadiri undangan sosialisasi survei  
    • Permohonan konsultasi penggunaan SILaBuS
  </div>
</div>
          <div class="d-grid d-sm-flex justify-content-sm-end gap-3 mt-4" id="button_wrap">
  <a href="/" class="btn btn-outline-secondary">
    <i class="bi bi-arrow-left-short me-1"></i> Kembali
  </a>
  <button type="submit" class="btn btn-bps">
    <i class="bi bi-send-fill me-1"></i> Kirim
  </button>
</div>

        </form>
      </div>
    </div>

    <p id="bantuan" class="mini-footer text-center mt-4">Butuh bantuan? Hubungi <a href="#" class="link-primary text-decoration-none">Layanan Statistik BPS</a>.</p>
  </main>

  <!-- Script Universal -->
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // 🔹 Handler untuk dropdown yang punya opsi "Lainnya"
  function handleLainnya(selectId, wrapId, inputId) {
    const select = document.getElementById(selectId);
    const wrap   = document.getElementById(wrapId);
    const input  = document.getElementById(inputId);

    if (!select) return;

    function toggle() {
      if (select.value === 'lainnya') {
        wrap?.classList.remove('d-none');
        if (input) input.setAttribute("required", "required");
      } else {
        wrap?.classList.add('d-none');
        if (input) {
          input.value = '';
          input.removeAttribute("required");
        }
      }
    }

    select.addEventListener('change', toggle);
    toggle(); // jalankan saat pertama kali load
  }

  document.addEventListener("DOMContentLoaded", function () {
    // 🔹 Aktifkan handler "lainnya"
    handleLainnya('keperluan', 'keperluan_lainnya_wrap', 'keperluan_lainnya');
    handleLainnya('pekerjaan', 'pekerjaan_lainnya_wrap', 'pekerjaan_lainnya');
    handleLainnya('instansi', 'instansi_lainnya_wrap', 'instansi_lainnya');
    handleLainnya('layanan', 'layanan_lainnya_wrap', 'layanan_lainnya');
    handleLainnya('kunjungan', 'kunjungan_lainnya_wrap', 'kunjungan_lainnya');

    // 🔹 Atur field berdasarkan pilihan keperluan
    const keperluanSelect = document.getElementById('keperluan');
    if (!keperluanSelect) return;

    const pekerjaan    = document.getElementById('pekerjaan');
    const instansi     = document.getElementById('instansi');
    const layanan      = document.getElementById('layanan');
    const kunjungan    = document.getElementById('kunjungan');
    const messageInput = document.getElementById('message');

    // wrapper elemen
    const pekerjaanWrap = pekerjaan?.closest('.col-12') || pekerjaan?.closest('.col-md-6');
    const instansiWrap  = instansi?.closest('.col-12') || instansi?.closest('.col-md-6');
    const layananWrap   = layanan?.closest('.col-12') || layanan?.closest('.col-md-6');
    const kunjunganWrap = kunjungan?.closest('.col-12') || kunjungan?.closest('.col-md-6');
    const surveiWrap    = document.querySelector('.mt-4'); // survei rating
    const messageWrap   = document.getElementById('message_wrap');

    function toggleFieldsByKeperluan() {
      const val = keperluanSelect.value;

      if (val === 'pst') {
        // tampilkan semua field + pesan
        [pekerjaanWrap, instansiWrap, layananWrap, kunjunganWrap, surveiWrap, messageWrap]
          .forEach(el => el?.classList.remove('d-none'));

        [pekerjaan, instansi, layanan, kunjungan, messageInput]
          .forEach(el => el?.setAttribute("required", "required"));

      } else if (val === 'bertemu subject matter' || val === 'undangan rapat') {
        // hanya pesan yang tampil & wajib
        [pekerjaanWrap, instansiWrap, layananWrap, kunjunganWrap, surveiWrap]
          .forEach(el => el?.classList.add('d-none'));

        [pekerjaan, instansi, layanan, kunjungan]
          .forEach(el => el?.removeAttribute("required"));

        messageWrap?.classList.remove('d-none');
        messageInput?.setAttribute("required", "required");

      } else if (val === 'lainnya') {
        // semua disembunyikan, kecuali field tambahan "keperluan lainnya"
        [pekerjaanWrap, instansiWrap, layananWrap, kunjunganWrap, surveiWrap, messageWrap]
          .forEach(el => el?.classList.add('d-none'));

        [pekerjaan, instansi, layanan, kunjungan, messageInput]
          .forEach(el => el?.removeAttribute("required"));

        if (messageInput) messageInput.value = '';

        // input tambahan (sudah di-handle di handleLainnya)
        document.getElementById('keperluan_lainnya_wrap')?.classList.remove('d-none');

      } else {
        // default (semua disembunyikan)
        [pekerjaanWrap, instansiWrap, layananWrap, kunjunganWrap, surveiWrap, messageWrap]
          .forEach(el => el?.classList.add('d-none'));

        [pekerjaan, instansi, layanan, kunjungan, messageInput]
          .forEach(el => el?.removeAttribute("required"));

        if (messageInput) messageInput.value = '';
      }
    }

    // jalankan saat load pertama kali
    toggleFieldsByKeperluan();

    // jalankan setiap kali user ubah pilihan
    keperluanSelect.addEventListener('change', toggleFieldsByKeperluan);
  });
</script>





  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Tambahkan di akhir sebelum </body> -->
<script>
document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("form");

  // 🔹 Validasi realtime setiap input
  form.querySelectorAll("input, textarea, select").forEach((el) => {
    el.addEventListener("input", () => validateField(el));
    el.addEventListener("blur", () => validateField(el));
    el.addEventListener("change", () => validateField(el));
  });

  function validateField(el) {
    if (el.checkValidity()) {
      el.classList.remove("is-invalid");
      el.classList.add("is-valid");
    } else {
      el.classList.remove("is-valid");
      el.classList.add("is-invalid");
    }
  }

  // 🔹 Field "Lainnya" otomatis tampil jika dipilih
  const dynamicSelects = [
    { id: "keperluan", wrap: "keperluan_lainnya_wrap" },
    { id: "pekerjaan", wrap: "pekerjaan_lainnya_wrap" },
    { id: "instansi", wrap: "instansi_lainnya_wrap" },
    { id: "layanan", wrap: "layanan_lainnya_wrap" },
    { id: "kunjungan", wrap: "kunjungan_lainnya_wrap" }
  ];

  dynamicSelects.forEach(({ id, wrap }) => {
    const select = document.getElementById(id);
    const wrapper = document.getElementById(wrap);

    if (select && wrapper) {
      select.addEventListener("change", () => {
        if (select.value === "lainnya") {
          wrapper.classList.remove("d-none");
          wrapper.querySelector("input").setAttribute("required", "true");
        } else {
          wrapper.classList.add("d-none");
          wrapper.querySelector("input").removeAttribute("required");
          wrapper.querySelector("input").value = "";
        }
      });
    }
  });

  // 🔹 Cegah submit kalau masih ada error
  form.addEventListener("submit", (e) => {
    let valid = true;
    form.querySelectorAll("input, textarea, select").forEach((el) => {
      if (!el.checkValidity()) {
        validateField(el);
        valid = false;
      }
    });
    if (!valid) {
      e.preventDefault();
      e.stopPropagation();
    }
  });
});
</script>
<script>
(() => {
  'use strict'
  const forms = document.querySelectorAll('.needs-validation')
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }
      form.classList.add('was-validated')
    }, false)
  })
})()
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const keperluan = document.getElementById("keperluan");
  const buttonWrap = document.getElementById("button_wrap");

  function toggleKeperluan() {
    if (keperluan.value === "pst") {
      buttonWrap.classList.remove("d-none"); // tombol tetap tampil
      // tampilkan field tambahan khusus pst kalau ada
    } else if (keperluan.value) {
      buttonWrap.classList.remove("d-none"); // tombol juga tampil
      // sembunyikan field tambahan khusus pst
    } else {
      buttonWrap.classList.add("d-none"); // default kalau belum pilih
    }
  }

  keperluan.addEventListener("change", toggleKeperluan);
  toggleKeperluan(); // cek awal saat halaman load
});
</script>


</body>
</html>