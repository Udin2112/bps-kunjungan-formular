<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function grafik(Request $request)
    {
        // default tahun = sekarang
        $tahun     = $request->get('tahun', date('Y'));
        $bulan     = $request->get('bulan', null);
        $triwulan  = $request->get('triwulan', null);
        $semester  = $request->get('semester', null);

        // helper closure untuk filter tahun & periode
        $applyFilters = function ($query) use ($tahun, $bulan, $triwulan, $semester) {
            $query->where('keperluan', 'pst')
                  ->whereYear('tanggal_kunjungan', $tahun);

            // 🔹 Prioritas: bulan > triwulan > semester
            if (!empty($bulan)) {
                $query->whereMonth('tanggal_kunjungan', $bulan);
            } elseif (!empty($triwulan)) {
                $bulanRange = match ($triwulan) {
                    1 => [1, 3],   // Jan–Mar
                    2 => [4, 6],   // Apr–Jun
                    3 => [7, 9],   // Jul–Sep
                    4 => [10, 12], // Okt–Des
                };
                $query->whereBetween(DB::raw('MONTH(tanggal_kunjungan)'), $bulanRange);
            } elseif (!empty($semester)) {
                $bulanRange = $semester == 1 ? [1, 6] : [7, 12];
                $query->whereBetween(DB::raw('MONTH(tanggal_kunjungan)'), $bulanRange);
            }

            return $query;
        };

        // === Data utama untuk ringkasan ===
        $feedbacks = $applyFilters(DB::table('feedback'))->get();

        $totalKunjungan = $feedbacks->count();
        $totalLaki      = $feedbacks->where('jenis_kelamin', 'Laki-laki')->count();
        $totalPerempuan = $feedbacks->where('jenis_kelamin', 'Perempuan')->count();

        // === Instansi ===
        $instansiByYear = $applyFilters(DB::table('feedback'))
            ->selectRaw("
                CASE 
                    WHEN LOWER(TRIM(instansi)) IN (
                        'lembaga negara',
                        'kementrian/lembaga pemerintah',
                        'tni/polri/bin/kejaksaan',
                        'pemerintah daerah',
                        'lembaga internasional',
                        'lembaga penelitian/pendidikan',
                        'bumn/d',
                        'swasta'
                    )
                        THEN LOWER(TRIM(instansi))
                    ELSE 'lainnya'
                END as instansi_group, COUNT(*) as total
            ")
            ->groupBy('instansi_group')
            ->get();

        $instansiByYear = $instansiByYear->map(function ($item) {
            $item->instansi_group = $item->instansi_group === 'lainnya'
                ? 'Lainnya'
                : ucfirst($item->instansi_group);
            return $item;
        });

        // === Kunjungan ===
        $kunjunganByYear = $applyFilters(DB::table('feedback'))
            ->selectRaw("
                CASE 
                    WHEN LOWER(TRIM(kunjungan)) IN (
                        'tugas sekolah/kuliah',
                        'pemerintahan',
                        'komersial',
                        'penelitian'
                    )
                        THEN LOWER(TRIM(kunjungan))
                    ELSE 'lainnya'
                END as kunjungan_group, COUNT(*) as total
            ")
            ->groupBy('kunjungan_group')
            ->get();

        // === Layanan ===
        $layananByYear = $applyFilters(DB::table('feedback'))
            ->selectRaw("
                CASE 
                    WHEN LOWER(TRIM(layanan)) IN (
                        'perpustakaan',
                        'pembelian publikasi bps',
                        'pembelian data mikro/peta wilkerstat',
                        'akses produk statistik pada website',
                        'konsultasi statistik',
                        'rekomendasi kegiatan statistik'
                    )
                        THEN LOWER(TRIM(layanan))
                    ELSE 'lainnya'
                END as layanan_group, COUNT(*) as total
            ")
            ->groupBy('layanan_group')
            ->get();

        // === Pekerjaan ===
        $pekerjaanByYear = $applyFilters(DB::table('feedback'))
            ->selectRaw("
                CASE 
                    WHEN LOWER(TRIM(pekerjaan)) IN (
                        'pelajar/mahasiswa',
                        'peneliti/dosen',
                        'asn/tni/polri',
                        'pegawai bumn/d',
                        'pegawai swasta',
                        'wiraswasta'
                    )
                        THEN LOWER(TRIM(pekerjaan))
                    ELSE 'lainnya'
                END as pekerjaan_group, COUNT(*) as total
            ")
            ->groupBy('pekerjaan_group')
            ->get();

        // === Usia ===
        $usiaByYear = $applyFilters(DB::table('feedback'))
            ->selectRaw("
                CASE
                    WHEN usia < 20 THEN '<20'
                    WHEN usia BETWEEN 20 AND 29 THEN '20-29'
                    WHEN usia BETWEEN 30 AND 39 THEN '30-39'
                    WHEN usia BETWEEN 40 AND 49 THEN '40-49'
                    ELSE '50+'
                END as kelompok_usia, COUNT(*) as total
            ")
            ->groupBy('kelompok_usia')
            ->get();

        // === Data per bulan (1-12) ===
        $instansiByMonth = $this->fillMonths(
            $applyFilters(DB::table('feedback'))
                ->selectRaw('MONTH(tanggal_kunjungan) as bulan, COUNT(*) as total')
                ->groupBy('bulan')
                ->pluck('total', 'bulan')
                ->toArray()
        );

        $layananByMonth = $this->fillMonths(
            $applyFilters(DB::table('feedback'))
                ->selectRaw('MONTH(tanggal_kunjungan) as bulan, COUNT(*) as total')
                ->groupBy('bulan')
                ->pluck('total', 'bulan')
                ->toArray()
        );

        $pekerjaanByMonth = $this->fillMonths(
            $applyFilters(DB::table('feedback'))
                ->selectRaw('MONTH(tanggal_kunjungan) as bulan, COUNT(*) as total')
                ->groupBy('bulan')
                ->pluck('total', 'bulan')
                ->toArray()
        );

        $usiaByMonth = $this->fillMonths(
            $applyFilters(DB::table('feedback'))
                ->selectRaw('MONTH(tanggal_kunjungan) as bulan, COUNT(*) as total')
                ->groupBy('bulan')
                ->pluck('total', 'bulan')
                ->toArray()
        );

        // === Daftar Tahun ===
        $tahunList = DB::table('feedback')
            ->selectRaw('DISTINCT YEAR(tanggal_kunjungan) as tahun')
            ->orderBy('tahun', 'asc')
            ->pluck('tahun');

        return view('grafik.index', compact(
            'instansiByYear',
            'kunjunganByYear',
            'layananByYear',
            'pekerjaanByYear',
            'usiaByYear',
            'instansiByMonth',
            'layananByMonth',
            'pekerjaanByMonth',
            'usiaByMonth',
            'tahunList',
            'tahun',
            'bulan',
            'triwulan',
            'semester',
            'totalKunjungan',
            'totalLaki',
            'totalPerempuan'
        ));
    }

    /**
     * Helper untuk isi data bulan 1-12 (isi 0 jika kosong)
     */
    private function fillMonths($data)
    {
        $result = [];
        for ($i = 1; $i <= 12; $i++) {
            $result[] = $data[$i] ?? 0;
        }
        return $result;
    }
}
