<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class TotalController extends Controller
{
    public function index(Request $request)
    {
        $tahun    = $request->input('tahun', date('Y'));
        $bulan    = $request->input('bulan', '');
        $tanggal  = $request->input('tanggal', '');
        $triwulan = $request->input('triwulan', '');
        $semester = $request->input('semester', '');

        // 🔹 ambil daftar tahun untuk dropdown
        $tahunList = Feedback::selectRaw('YEAR(tanggal_kunjungan) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        // 🔹 query awal
        $query = Feedback::query();

        if ($tahun) {
            $query->whereYear('tanggal_kunjungan', $tahun);
        }

        // 🔹 Prioritas filter
        // Jika Triwulan dipilih → abaikan Bulan & Tanggal
        if (!empty($triwulan)) {
            if ($triwulan == 1) {
                $query->whereBetween('tanggal_kunjungan', ["$tahun-01-01", "$tahun-03-31"]);
            } elseif ($triwulan == 2) {
                $query->whereBetween('tanggal_kunjungan', ["$tahun-04-01", "$tahun-06-30"]);
            } elseif ($triwulan == 3) {
                $query->whereBetween('tanggal_kunjungan', ["$tahun-07-01", "$tahun-09-30"]);
            } elseif ($triwulan == 4) {
                $query->whereBetween('tanggal_kunjungan', ["$tahun-10-01", "$tahun-12-31"]);
            }
        }
        // Jika Semester dipilih → abaikan Bulan & Tanggal
        elseif (!empty($semester)) {
            if ($semester == 1) {
                $query->whereBetween('tanggal_kunjungan', ["$tahun-01-01", "$tahun-06-30"]);
            } elseif ($semester == 2) {
                $query->whereBetween('tanggal_kunjungan', ["$tahun-07-01", "$tahun-12-31"]);
            }
        }
        // Jika hanya Bulan/Tanggal dipilih
        else {
            if (!empty($bulan)) {
                $query->whereMonth('tanggal_kunjungan', $bulan);
            }
            if (!empty($tanggal)) {
                $query->whereDay('tanggal_kunjungan', $tanggal);
            }
        }

        $feedbacks = $query->get();

        return view('dashboard.index', compact(
            'feedbacks',
            'tahunList',
            'tahun',
            'bulan',
            'tanggal',
            'triwulan',
            'semester'
        ));
    }
}
