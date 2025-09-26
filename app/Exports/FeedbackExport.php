<?php

namespace App\Exports;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class FeedbackExport implements FromCollection
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $defaultKeperluan = ['pst', 'undangan rapat', 'bertemu subject matter'];

        $query = Feedback::query();

        // Terapkan filter sama seperti controller
        if ($this->request->filled('keperluan')) {
            if ($this->request->keperluan === 'lainnya') {
                $query->whereNotIn('keperluan', $defaultKeperluan);
            } else {
                $query->where('keperluan', $this->request->keperluan);
            }
        }
        if ($this->request->filled('tahun')) {
            $query->whereYear('tanggal_kunjungan', $this->request->tahun);
        }
        if ($this->request->filled('bulan')) {
            $query->whereMonth('tanggal_kunjungan', $this->request->bulan);
        }
        if ($this->request->filled('tanggal')) {
            $query->whereDate('tanggal_kunjungan', $this->request->tanggal);
        }
        if ($this->request->filled('search')) {
            $search = $this->request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        return $query->get();
    }
}