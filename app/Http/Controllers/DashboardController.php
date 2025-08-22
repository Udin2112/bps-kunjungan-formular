<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function grafik()
    {
        // 🔹 Statistik Jenis Kelamin
        $genderStats = Feedback::selectRaw('jenis_kelamin, COUNT(*) as total')
                        ->groupBy('jenis_kelamin')
                        ->pluck('total', 'jenis_kelamin');

        // 🔹 Statistik Layanan
        $layananStats = Feedback::selectRaw('layanan, COUNT(*) as total')
                        ->groupBy('layanan')
                        ->pluck('total', 'layanan');

        // 🔹 Statistik Instansi
        $instansiStats = Feedback::selectRaw('instansi, COUNT(*) as total')
                        ->groupBy('instansi')
                        ->pluck('total', 'instansi');

        // 🔹 Statistik Pekerjaan
        $pekerjaanStats = Feedback::selectRaw('pekerjaan, COUNT(*) as total')
                        ->groupBy('pekerjaan')
                        ->pluck('total', 'pekerjaan');

        // 🔹 Statistik Usia (kelompok umur)
        $usiaStats = Feedback::selectRaw("
            CASE
                WHEN usia < 20 THEN '<20'
                WHEN usia BETWEEN 20 AND 29 THEN '20-29'
                WHEN usia BETWEEN 30 AND 39 THEN '30-39'
                WHEN usia BETWEEN 40 AND 49 THEN '40-49'
                ELSE '50+'
            END as kelompok_usia, COUNT(*) as total
        ")->groupBy('kelompok_usia')
          ->pluck('total','kelompok_usia');

        // 🔹 Statistik Kepuasan Survei (1-5 bintang)
        $surveiStats = Feedback::select('survei', DB::raw('COUNT(*) as total'))
                        ->groupBy('survei')
                        ->orderBy('survei', 'asc')
                        ->pluck('total', 'survei')
                        ->mapWithKeys(function($value, $key){
                            return [$key . ' Bintang' => $value];
                        });

        // 🔹 Tren Harian (YYYY-MM-DD)
        $dailyTrend = Feedback::selectRaw("DATE(tanggal_kunjungan) as tanggal, COUNT(*) as total")
                        ->groupBy('tanggal')
                        ->orderBy('tanggal', 'asc')
                        ->pluck('total', 'tanggal');

        // 🔹 Tren Bulanan (YYYY-MM)
        $monthlyTrend = Feedback::selectRaw("DATE_FORMAT(tanggal_kunjungan, '%Y-%m') as bulan, COUNT(*) as total")
                        ->groupBy('bulan')
                        ->orderBy('bulan', 'asc')
                        ->pluck('total', 'bulan');

        // 🔹 Tren Mingguan (YYYY-WW)
        $weeklyTrend = Feedback::selectRaw("YEARWEEK(tanggal_kunjungan, 1) as minggu, COUNT(*) as total")
                        ->groupBy('minggu')
                        ->orderBy('minggu', 'asc')
                        ->pluck('total', 'minggu')
                        ->mapWithKeys(function ($value, $key) {
                            $year  = substr($key, 0, 4);
                            $week  = substr($key, 4);
                            return [$year . '-W' . $week => $value];
                        });

        // 🔹 Kirim semua data ke view
        return view('grafik.index', compact(
            'genderStats',
            'layananStats',
            'instansiStats',
            'pekerjaanStats',
            'usiaStats',
            'surveiStats',
            'dailyTrend',
            'monthlyTrend',
            'weeklyTrend'
        ));
    }
}
