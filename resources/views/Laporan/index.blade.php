@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- 🔹 Header Halaman -->
    <div class="mb-4 p-4 rounded-4 shadow-sm text-white" 
         style="background: linear-gradient(135deg, #003366, #005599, #00aaff);">
        <h3 class="fw-bold mb-1">
            <i class="bi bi-bar-chart-line-fill me-2"></i> 
            Laporan Data Feedback
        </h3>
        <p class="mb-0 text-light opacity-75">Ringkasan data kunjungan & feedback pengunjung</p>
    </div>

    <!-- 🔹 Card Tabel -->
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header d-flex justify-content-between align-items-center bg-white rounded-top-4">
            <h5 class="mb-0 fw-bold text-primary">
                <i class="bi bi-table me-2"></i> Tabel Feedback
            </h5>
            <div id="exportButtons"></div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle nowrap" 
                       id="feedbackTable" style="width:100%;">
                    <thead class="text-center">
    <tr>
        <th>NO</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Alamat</th>
        <th>Jenis Kelamin</th>
        <th>Usia</th>
        <th>Tanggal Kunjungan</th>
        <th>Pekerjaan</th>
        <th>Instansi</th>
        <th>Layanan</th>
        <th>Kunjungan</th>
        <th>Pesan</th>
        <th>Survei</th>
        <th>Aksi</th> <!-- ✅ Kolom baru -->
    </tr>
</thead>

                    <tbody>
                        @foreach ($feedbacks as $index => $feedback)
<tr>
    <td class="text-center">{{ $loop->iteration }}</td>
    <td>{{ $feedback->first_name }} {{ $feedback->last_name }}</td>
    <td>{{ $feedback->email }}</td>
    <td>{{ $feedback->alamat }}</td>
    <td>{{ $feedback->jenis_kelamin }}</td>
    <td class="text-center">{{ $feedback->usia }}</td>
    <td class="text-center">{{ \Carbon\Carbon::parse($feedback->tanggal_kunjungan)->format('d-m-Y') }}</td>
    <td>{{ $feedback->pekerjaan }}</td>
    <td>{{ $feedback->instansi }}</td>
    <td>{{ $feedback->layanan }}</td>
    <td>{{ $feedback->kunjungan }}</td>
    <td>{{ $feedback->message }}</td>
    <td class="text-center" data-survei="{{ $feedback->survei }}">
        @for ($i = 1; $i <= 5; $i++)
            @if($i <= $feedback->survei)
                <i class="bi bi-star-fill text-warning"></i>
            @else
                <i class="bi bi-star text-muted"></i>
            @endif
        @endfor
    </td>
    <!-- ✅ Kolom Aksi -->
    <td class="text-center">
        <!-- Tombol Edit -->
        <a href="{{ route('feedback.edit', $feedback->id) }}" 
           class="btn btn-sm btn-warning rounded-pill">
           ✏️ Edit
        </a>

        <!-- Tombol Hapus -->
        <form action="{{ route('feedback.destroy', $feedback->id) }}" 
              method="POST" class="d-inline"
              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger rounded-pill">
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
</div>

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
                extend: 'csvHtml5',
                text: '📥 Export CSV',
                className: 'btn btn-primary btn-sm rounded-pill',
                exportOptions: {
                    columns: ':visible',
                    format: {
                        body: function (data, row, column, node) {
                            if (column === 12) { // kolom Survei
                                return $(node).data('survei') || '';
                            }
                            return $(node).text();
                        }
                    }
                }
            },
            {
                extend: 'excelHtml5',
                text: '📊 Export Excel',
                className: 'btn btn-success btn-sm rounded-pill',
                exportOptions: {
                    columns: ':visible',
                    format: {
                        body: function (data, row, column, node) {
                            if (column === 12) { // kolom Survei
                                return $(node).data('survei') || '';
                            }
                            return $(node).text();
                        }
                    }
                }
            }
        ]
    });
    table.buttons().container().appendTo('#exportButtons');
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
        background: linear-gradient(135deg, #0077b6, #00b4d8) !important;
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

</style>


@endsection
