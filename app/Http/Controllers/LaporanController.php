<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class LaporanController extends Controller
{
    /**
     * Menampilkan halaman laporan feedback
     */
    public function index()
    {
        // Ambil semua data feedback
        $feedbacks = Feedback::all();

        // Kirim data ke view laporan.index
        return view('laporan.index', compact('feedbacks'));
    }
}
