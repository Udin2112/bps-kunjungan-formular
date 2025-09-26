@extends('layouts.app')

 @php
    use Illuminate\Support\Str;

    // Daftar keperluan default (silakan isi sesuai kebutuhanmu)
    $defaultKeperluan = ['bertemu subject matter', 'undangan rapat',];

    $uniqueKeperluan = $feedbacks->pluck('keperluan')->unique();
@endphp

@section('content')
<div class="container-fluid py-4">

    <!-- 🔹 Header Halaman -->
    <div class="mb-4 p-4 rounded-4 shadow-sm text-white" 
     style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
    <h3 class="fw-bold mb-1">
        <i class="bi bi-bar-chart-line-fill me-2"></i> 
        Laporan Data Feedback
    </h3>
    <p class="mb-0 text-light opacity-75">Ringkasan data kunjungan & feedback pengunjung</p>
</div>


    <!-- 🔹 Card Tabel -->
    <div class="card shadow-sm border-0 rounded-4 mb-4">
    <div class="card-header bg-light rounded-top-4">
        <h6 class="mb-0 fw-bold text-primary">
            <i class="bi bi-funnel-fill me-2"></i> Filter Data
        </h6>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <!-- 🔹 Filter Keperluan -->
            <div class="row g-3" id="filterPanel">
    <!-- 🔹 Filter Keperluan -->
    <div class="col-md-3">
        <div class="form-check mb-1">
            <input class="form-check-input" type="checkbox" id="toggleKeperluan" checked>
            <label class="form-check-label fw-semibold" for="toggleKeperluan">Filter Keperluan</label>
        </div>
        <select id="filterKeperluan" class="form-select">
            <option value="">-- Semua Keperluan --</option>
            <option value="bertemu subject matter">Bertemu Subject Matter</option>
            <option value="undangan rapat">Undangan Rapat</option>
            <option value="pst">PST</option>
            <option value="__LAINNYA__">Lainnya</option>
        </select>
    </div>

    <!-- 🔹 Filter Tanggal -->
    <div class="col-md-3">
        <div class="form-check mb-1">
            <input class="form-check-input" type="checkbox" id="toggleTanggal" checked>
            <label class="form-check-label fw-semibold" for="toggleTanggal">Filter Tanggal</label>
        </div>
        <input type="date" id="filterTanggal" class="form-control"/>
    </div>

    <!-- 🔹 Filter Bulan -->
    <div class="col-md-3">
        <div class="form-check mb-1">
            <input class="form-check-input" type="checkbox" id="toggleBulan" checked>
            <label class="form-check-label fw-semibold" for="toggleBulan">Filter Bulan</label>
        </div>
        <select id="filterBulan" class="form-select">
            <option value="">-- Semua Bulan --</option>
            @for ($m = 1; $m <= 12; $m++)
                <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}">
                    {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                </option>
            @endfor
        </select>
    </div>

    <!-- 🔹 Filter Tahun -->
    <div class="col-md-3">
        <div class="form-check mb-1">
            <input class="form-check-input" type="checkbox" id="toggleTahun" checked>
            <label class="form-check-label fw-semibold" for="toggleTahun">Filter Tahun</label>
        </div>
        <select id="filterTahun" class="form-select">
            <option value="">-- Semua Tahun --</option>
            @foreach ($feedbacks->pluck('tanggal_kunjungan')->map(fn($d) => \Carbon\Carbon::parse($d)->format('Y'))->unique() as $tahun)
                <option value="{{ $tahun }}">{{ $tahun }}</option>
            @endforeach
        </select>
    </div>
</div>


        <!-- 🔹 Tombol Export -->
        <div class="mt-3 text-end" id="exportButtons"></div>
    </div>
</div>


                   <div class="card shadow-lg border-0 rounded-4">
    <div class="card-header d-flex justify-content-between align-items-center bg-white rounded-top-4">
        <h5 class="mb-0 fw-bold text-primary">
            <i class="bi bi-table me-2"></i> Tabel Feedback
        </h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle nowrap" id="feedbackTable" style="width:100%;">
                <thead class="text-center">
    <tr>
        <th>NO</th>
        <th>Nama</th>
        <th>Email</th>
          <th>Telepon</th> <!-- 🔹 Tambahan -->
        <th>Alamat</th>
        <th>Jenis Kelamin</th>
        <th>Usia</th>
        <th>Tanggal Kunjungan</th>
        <th>Keperluan</th>
        <th>Detail</th>
        <th class="d-none">Pekerjaan</th>
        <th class="d-none">Instansi</th>
        <th class="d-none">Layanan</th>
        <th class="d-none">Kunjungan</th>
        <th class="d-none">Pesan</th>
      
        <th>Aksi</th>
    </tr>
</thead>


                <tbody>
@foreach ($feedbacks as $index => $feedback)
<tr>
    <td class="text-center">{{ $loop->iteration }}</td>
    <td>{{ $feedback->first_name }} {{ $feedback->last_name }}</td>
    <td>{{ $feedback->email }}</td>
    <td>{{ $feedback->phone }}</td>

    <td>{{ $feedback->alamat }}</td>
    <td>{{ $feedback->jenis_kelamin }}</td>
    <td class="text-center">{{ $feedback->usia }}</td>
    <td class="text-center">{{ \Carbon\Carbon::parse($feedback->tanggal_kunjungan)->format('d-m-Y') }}</td>
    <td>{{ $feedback->keperluan }}</td>

    <!-- ✅ Tombol Detail -->
    <td class="text-center">
    <button type="button" class="btn btn-info btn-sm rounded-pill btn-detail">
        🔍 Lihat
    </button>
</td>


    <!-- ✅ Kolom Hidden untuk kebutuhan Export -->
    <td class="d-none">{{ $feedback->pekerjaan }}</td>
    <td class="d-none">{{ $feedback->instansi }}</td>
    <td class="d-none">{{ $feedback->layanan }}</td>
    <td class="d-none">{{ $feedback->kunjungan }}</td>
    <td class="d-none">{{ $feedback->message }}</td>
   

    <!-- ✅ Aksi -->
    <td class="text-center">
        <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" class="d-inline delete-form">
            @csrf
            @method('DELETE')
            <button type="button" 
                    class="btn btn-sm btn-danger rounded-pill btn-delete"
                    data-id="{{ $feedback->id }}">
                🗑️ Hapus
            </button>
        </form>
    </td>
</tr>
@endforeach
</tbody>


            </table>
        </div>
    </div>
</div>
<!-- 🔹 Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4 shadow-lg border-0">
      <div class="modal-header bg-info text-white rounded-top-4">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-info-circle me-2"></i> Detail Feedback
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-striped table-hover align-middle detail-table">
            <tbody>
              <tr><th>Pekerjaan</th><td id="detailPekerjaan"></td></tr>
              <tr><th>Instansi</th><td id="detailInstansi"></td></tr>
              <tr><th>Layanan</th><td id="detailLayanan"></td></tr>
              <tr><th>Kunjungan</th><td id="detailKunjungan"></td></tr>
              <tr><th>Pesan</th><td id="detailPesan"></td></tr>
        
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
          ✖ Tutup
        </button>
      </div>
    </div>
  </div>
</div>


<!-- 🔹 Modal Konfirmasi Hapus -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow-lg">
      <div class="modal-header bg-danger text-white rounded-top-4">
        <h5 class="modal-title fw-bold">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <p class="fs-5 fw-semibold">Apakah Anda yakin ingin menghapus data ini?</p>
        <p class="text-muted small">Tindakan ini tidak bisa dibatalkan.</p>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary rounded-3 px-4" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger rounded-3 px-4" id="confirmDeleteBtn">Ya, Hapus</button>
      </div>
    </div>
  </div>
</div>
<!-- 🔹 Modal Notifikasi Sukses -->
@if(session('success'))
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow-lg">
      <div class="modal-header bg-success text-white rounded-top-4">
        <h5 class="modal-title fw-bold" id="successLabel">Berhasil!</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <p class="fs-5 fw-semibold">{{ session('success') }}</p>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-success rounded-3 px-4" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
@endif


</div>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- 🔹 DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- 🔹 Buttons -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css"/>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function() {
    var table = $('#feedbackTable').DataTable({
        scrollX: true,
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "Semua"] ],
        language: {
            search: "🔍 Cari:",
            lengthMenu: "Tampilkan _MENU_ baris",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data",
            zeroRecords: "Data tidak ditemukan",
            paginate: { first: "Awal", last: "Akhir", next: "›", previous: "‹" }
        },
        dom: 'lBfrtip',
       buttons: [
    {
        extend: 'excelHtml5',
        text: '📊 Export Excel',
        className: 'btn btn-success btn-sm rounded-pill',
        exportOptions: {
            columns: ':not(:last-child)', // semua kecuali kolom aksi
            format: {
                body: function (data, row, column, node) {
                    return $(node).text().trim();
                }
            }
        }
    },
    {
        extend: 'csvHtml5',
        text: '📥 Export CSV',
        className: 'btn btn-primary btn-sm rounded-pill',
        exportOptions: {
            columns: ':not(:last-child)',
            format: {
                body: function (data, row, column, node) {
                    return $(node).text().trim();
                }
            }
        }
    }
]

    });
    
    $('#feedbackTable').on('click', '.btn-detail', function () {
    let row = $(this).closest('tr');
    let keperluan = row.find('td:eq(7)').text().trim().toLowerCase();

    // Ambil nilai data
    let pekerjaan = row.find('td:eq(10)').text();
let instansi  = row.find('td:eq(11)').text();
let layanan   = row.find('td:eq(12)').text();
let kunjungan = row.find('td:eq(13)').text();
let pesan     = row.find('td:eq(14)').text();


    // Kosongkan semua field
    $('#detailPekerjaan').text('');
    $('#detailInstansi').text('');
    $('#detailLayanan').text('');
    $('#detailKunjungan').text('');
    $('#detailPesan').text('');

    // Sembunyikan semua baris
    $('#detailPekerjaan').closest('tr').hide();
    $('#detailInstansi').closest('tr').hide();
    $('#detailLayanan').closest('tr').hide();
    $('#detailKunjungan').closest('tr').hide();
    $('#detailPesan').closest('tr').hide();

    // 🔹 Logika sesuai keperluan
    if (keperluan === 'pst') {
        $('#detailPekerjaan').text(pekerjaan).closest('tr').show();
        $('#detailInstansi').text(instansi).closest('tr').show();
        $('#detailLayanan').text(layanan).closest('tr').show();
        $('#detailKunjungan').text(kunjungan).closest('tr').show();
        $('#detailPesan').text(pesan).closest('tr').show();
    } 
    else if (keperluan.includes('rapat') || keperluan.includes('subject matter')) {
        // ✅ Cocok untuk "undangan rapat" & "bertemu subject matter"
        $('#detailPesan').text(pesan).closest('tr').show();
    }
    else if (keperluan === 'lainnya') {
        // Tidak tampil apa-apa
    }

    $('#detailModal').modal('show');
});



    // 🔹 Tempatkan tombol export di div #exportButtons
    table.buttons().container().appendTo('#exportButtons');

    // 🔹 Filter Keperluan
$('#filterKeperluan, #toggleKeperluan').on('change', function() {
    if ($('#toggleKeperluan').is(':checked')) {
        let val = $('#filterKeperluan').val();
        let defaultOptions = ["bertemu subject matter", "undangan rapat", "pst"];
        if (val === "__LAINNYA__") {
            let regex = "^(?!" + defaultOptions.join("|") + ").*";
            table.column(7).search(regex, true, false).draw();
        } else if (val === "") {
            table.column(7).search("").draw();
        } else {
            table.column(7).search("^" + val + "$", true, false).draw();
        }
    } else {
        // kalau toggle off → kosongkan filter
        table.column(7).search("").draw();
    }
});

// 🔹 Filter Tanggal
$('#filterTanggal, #toggleTanggal').on('change', function() {
    if ($('#toggleTanggal').is(':checked')) {
        let val = $('#filterTanggal').val();
        if (val) {
            let date = moment(val, "YYYY-MM-DD").format("DD-MM-YYYY");
            table.column(6).search(date).draw();
        } else {
            table.column(6).search("").draw();
        }
    } else {
        table.column(6).search("").draw();
    }
});

// 🔹 Filter Bulan
$('#filterBulan, #toggleBulan').on('change', function() {
    if ($('#toggleBulan').is(':checked')) {
        let bulan = $('#filterBulan').val();
        if (bulan) {
            let regex = "\\-" + bulan + "\\-";
            table.column(6).search(regex, true, false).draw();
        } else {
            table.column(6).search("").draw();
        }
    } else {
        table.column(6).search("").draw();
    }
});

// 🔹 Filter Tahun
$('#filterTahun, #toggleTahun').on('change', function() {
    if ($('#toggleTahun').is(':checked')) {
        let tahun = $('#filterTahun').val();
        if (tahun) {
            table.column(6).search(tahun, true, false).draw();
        } else {
            table.column(6).search("").draw();
        }
    } else {
        table.column(6).search("").draw();
    }
});


});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let formToSubmit = null;

    // klik tombol hapus → buka modal
    document.querySelectorAll(".btn-delete").forEach(btn => {
        btn.addEventListener("click", function () {
            formToSubmit = this.closest("form");
            const modal = new bootstrap.Modal(document.getElementById("confirmDeleteModal"));
            modal.show();
        });
    });

    // klik tombol "Ya, Hapus" → submit form
    document.getElementById("confirmDeleteBtn").addEventListener("click", function () {
        if (formToSubmit) {
            formToSubmit.submit();
        }
    });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const successModal = document.getElementById('successModal');
    if (successModal) {
        const modal = new bootstrap.Modal(successModal);
        modal.show();

        // Optional: auto close setelah 3 detik
        setTimeout(() => {
            modal.hide();
        }, 3000);
    }
});
</script>



<style>
    /* 🔹 Matikan default stripe bawaan DataTables */
    table.dataTable.stripe tbody tr.odd,
    table.dataTable.display tbody tr.odd {
        background-color: transparent !important;
    }
    table.dataTable.stripe tbody tr.even,
    table.dataTable.display tbody tr.even {
        background-color: transparent !important;
    }

    /* 🔹 Rapikan garis tabel */
    table.dataTable {
        border-collapse: collapse !important;
        width: 100%;
        border: 1px solid #dee2e6;
    }

    /* 🔹 Header tabel dengan gradasi & rata tengah */
    table.dataTable thead th {
    background: linear-gradient(135deg, #6a11cb, #2575fc) !important;
    color: #fff !important;
    text-transform: uppercase;
    text-align: center !important;
    vertical-align: middle !important;
    font-weight: 600;
    font-size: 13px;
    padding: 12px;
    border: 1px solid #dee2e6 !important;
}


    /* 🔹 Zebra strip (warna baris selang-seling custom) */
    table.dataTable tbody tr:nth-child(odd) {
        background-color: #f9fcff !important; /* biru muda */
    }
    table.dataTable tbody tr:nth-child(even) {
        background-color: #ffffff !important; /* putih */
    }

    /* 🔹 Hover efek */
    table.dataTable tbody tr:hover {
        background-color: #e3f2fd !important;
        transition: 0.3s;
        cursor: pointer;
    }

    /* 🔹 Sel tabel */
    table.dataTable tbody td {
        vertical-align: middle;
        font-size: 14px;
        padding: 10px;
        border: 1px solid #dee2e6 !important;
    }
    /* Tombol aksi kecil */
table.dataTable tbody td .btn {
    margin: 2px;
}
/* Panel filter */
#filterPanel .form-label {
    font-size: 13px;
    color: #444;
}
#filterPanel .form-select,
#filterPanel .form-control {
    border-radius: 10px;
    font-size: 14px;
}
#detailSurvei i {
    margin-right: 2px;
}
/* 🔹 Styling tabel detail di modal */
.detail-table th {
    width: 25%;
    background: #f1f9ff;
    color: #0077b6;
    font-weight: 600;
    font-size: 14px;
    padding: 10px 12px;
    border: 1px solid #dee2e6 !important;
}

.detail-table td {
    background: #fff;
    font-size: 14px;
    padding: 10px 12px;
    border: 1px solid #dee2e6 !important;
}

/* Hover row di modal */
.detail-table tr:hover td {
    background: #f9fcff;
}

/* Animasi muncul modal */
.modal-content {
    animation: fadeInUp 0.4s ease;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}


</style>


@endsection