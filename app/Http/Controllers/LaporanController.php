<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; // ✅ perbaikan: gunakan namespace lengkap

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // 🔹 Default pilihan keperluan (sesuai form)
        $defaultKeperluan = ['pst', 'undangan rapat', 'bertemu subject matter'];

        // 🔹 List dropdown filter = 3 default + 'lainnya'
        $listKeperluan = array_merge($defaultKeperluan, ['lainnya']);

        // 🔎 Ambil query filter dari request
        $keperluan = $request->input('keperluan');
        $tahun     = $request->input('tahun');
        $bulan     = $request->input('bulan');
        $tanggal   = $request->input('tanggal');

        // 🔎 Query dasar
        $query = Feedback::query();

        // 🔎 Filter keperluan
        if (!empty($keperluan)) {
            if ($keperluan === 'lainnya') {
                $query->whereNotIn('keperluan', $defaultKeperluan);
            } else {
                $query->where('keperluan', $keperluan);
            }
        }

        // 🔎 Filter tahun
        if (!empty($tahun)) {
            $query->whereYear('tanggal_kunjungan', $tahun);
        }

        // 🔎 Filter bulan
        if (!empty($bulan)) {
            $query->whereMonth('tanggal_kunjungan', $bulan);
        }

        // 🔎 Filter tanggal spesifik
        if (!empty($tanggal)) {
            $query->whereDate('tanggal_kunjungan', $tanggal);
        }

        // 🔹 Ambil data hasil filter
        $feedbacks = $query->get();

        // 🔹 List tahun unik dari tanggal_kunjungan
        $listTahun = Feedback::select(DB::raw('YEAR(tanggal_kunjungan) as tahun'))
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('laporan.index', compact(
            'feedbacks',
            'listKeperluan',
            'listTahun'
        ));
    }
}
