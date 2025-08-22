@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Judul -->
    <h3 class="fw-bold mb-4 text-primary">
        👨‍💻 Daftar Admin
    </h3>

    <!-- Card -->
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="adminTable" class="table align-middle table-bordered nowrap" style="width:100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $admin)
                        <tr>
                            <td class="fw-semibold text-center">{{ $loop->iteration }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- jQuery & DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" 
      href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"/>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#adminTable').DataTable({
        dom: '<"d-flex justify-content-between align-items-center mb-3"lf>rtip',
        language: {
            search: "🔍 Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            paginate: {
                first: "Awal",
                last: "Akhir",
                next: "➡️",
                previous: "⬅️"
            },
            zeroRecords: "Tidak ada data ditemukan",
        },
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50, 100],
        initComplete: function () {
            $('div.dataTables_length select').addClass('form-select form-select-sm');
        }
    });
});
</script>

<!-- 🔹 Styling konsisten -->
<style>
/* 🔹 Header tabel dengan gradasi */
#adminTable thead th {
    background: linear-gradient(135deg, #0077b6, #00b4d8) !important;
    color: #fff !important;
    text-transform: uppercase;
    text-align: center !important;
    vertical-align: middle !important;
    font-weight: 600;
    font-size: 13px;
    padding: 12px;
    border: 1px solid #dee2e6 !important;
    position: relative; /* supaya panah sorting bisa muncul */
}

/* 🔹 Zebra strip (selang-seling warna) */
#adminTable tbody tr:nth-child(odd) {
    background-color: #f9fcff !important; /* biru muda */
}
#adminTable tbody tr:nth-child(even) {
    background-color: #ffffff !important; /* putih */
}

/* 🔹 Hover efek */
#adminTable tbody tr:hover {
    background-color: #e3f2fd !important;
    transition: 0.3s;
    cursor: pointer;
}

/* 🔹 Sel tabel isi */
#adminTable tbody td {
    text-align: center !important;
    vertical-align: middle !important;
    font-size: 14px;
    padding: 10px;
    border: 1px solid #dee2e6 !important;
}

/* 🔹 Styling dropdown jumlah data */
div.dataTables_length select.form-select {
    width: auto !important;
    border-radius: 12px !important;
    background: linear-gradient(135deg, #ffffff, #f8f9fa) !important;
    padding: 6px 32px 6px 12px !important;
    font-size: 14px !important;
    font-weight: 500;
    color: #333;
    border: 1px solid #ced4da !important;
    box-shadow: 0 1px 4px rgba(0,0,0,0.08);
    transition: all 0.2s ease-in-out;
    appearance: none; /* hilangkan panah default */
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%230077b6' viewBox='0 0 16 16'%3E%3Cpath d='M1.5 5l6.5 6 6.5-6h-13z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 14px;
}
div.dataTables_length select.form-select:hover {
    border-color: #0096c7 !important;
}
div.dataTables_length select.form-select:focus {
    border-color: #0096c7 !important;
    box-shadow: 0 0 5px rgba(0,150,199,0.5);
}

/* 🔹 Panah sorting */
table.dataTable thead .sorting:after,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_desc:after {
    position: absolute;
    right: 8px;
    top: 50%;
    transform: translateY(-50%);
    opacity: 0.8;
    font-size: 12px;
}

/* Default */
table.dataTable thead .sorting:after {
    content: "⇅";
    opacity: 0.5;
    margin-left: 6px;
}

/* Urut naik */
table.dataTable thead .sorting_asc:after {
    content: "⬆️";
    opacity: 0.8;
    margin-left: 6px;
}

/* Urut turun */
table.dataTable thead .sorting_desc:after {
    content: "⬇️";
    opacity: 0.8;
    margin-left: 6px;
}
</style>

@endsection
