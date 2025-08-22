<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    // Form publik
    public function create()
    {
        return view('feedback.form');
    }

    // Simpan data
    public function store(Request $request)
    {
        $request->validate([
            'first_name'        => ['required', 'regex:/^[A-Za-zÀ-ÿ\s]+$/u', 'max:100'],
            'last_name'         => ['required', 'regex:/^[A-Za-zÀ-ÿ\s]+$/u', 'max:100'],
            'email'             => 'required|email',
            'phone'             => ['required', 'regex:/^[0-9]+$/', 'min:10', 'max:15'],
            'alamat'            => 'required|string|max:255',
            'jenis_kelamin'     => 'required|in:Laki-laki,Perempuan',
            'usia'              => 'required|integer|min:1|max:120',
            'tanggal_kunjungan' => 'required|date',
            'pekerjaan'         => 'required|string',
            'instansi'          => 'required|string',
            'layanan'           => 'required|string',
            'kunjungan'         => 'required|string',
            'message'           => 'required|string',
            'survei'            => 'required|integer|min:1|max:5',
        ], [
            // 🔹 Custom error messages
            'first_name.required' => 'Nama Depan wajib diisi.',
            'first_name.regex'    => 'Format Nama Depan harus huruf semua, tidak boleh ada angka atau karakter lain.',
            'last_name.required'  => 'Nama Belakang wajib diisi.',
            'last_name.regex'     => 'Format Nama Belakang harus huruf semua, tidak boleh ada angka atau karakter lain.',
            'email.required'      => 'Email wajib diisi.',
            'email.email'         => 'Format email tidak valid (wajib gunakan @) contoh yang benar : ayu@gmail.com ; 222212892@stis.ac.id ; dsb.',
            'phone.required' => 'Nomor telepon wajib diisi.',
    'phone.regex'    => 'Nomor telepon hanya boleh berisi angka.',
    'phone.min'      => 'Nomor telepon minimal harus terdiri dari 10 digit.',
    'phone.max'      => 'Nomor telepon maksimal 15 digit.',
            'alamat.required'     => 'Alamat wajib diisi.',
            'alamat.string'       => 'Alamat harus berupa teks.',
            'usia.required'       => 'Usia wajib diisi.',
            'usia.integer'        => 'Usia harus berupa angka.',
            'usia.min'            => 'Usia minimal 1 tahun.',
            'usia.max'            => 'Usia maksimal 120 tahun.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'tanggal_kunjungan.required' => 'Tanggal kunjungan wajib diisi.',
            'pekerjaan.required'  => 'Pekerjaan utama wajib diisi.',
            'instansi.required'   => 'Asal instansi wajib diisi.',
            'layanan.required'    => 'Jenis layanan wajib diisi.',
            'kunjungan.required'  => 'Pemanfaatan kunjungan wajib diisi.',
            'message.required'    => 'Pesan wajib diisi.',
            'survei.required' => 'Silakan pilih nilai survei (wajib diisi).',
'survei.integer'  => 'Nilai survei harus berupa angka antara 1 sampai 5.',
'survei.min'      => 'Nilai survei minimal adalah 1.',
'survei.max'      => 'Nilai survei maksimal adalah 5.',

        ]);

        Feedback::create($request->all());

        return redirect()->back()->with('success', 'Terima kasih, data berhasil dikirim!');
    }

    // Dashboard (hanya untuk login user)
    public function dashboard()
    {
        $feedbacks = Feedback::latest()->paginate(10);
        return view('dashboard.index', compact('feedbacks'));
    }
    // Menampilkan form edit
public function edit(Feedback $feedback)
{
    return view('feedback.edit', compact('feedback'));
}

// Menyimpan perubahan
public function update(Request $request, Feedback $feedback)
{
    $request->validate([
        'first_name'        => ['required', 'regex:/^[A-Za-zÀ-ÿ\s]+$/u', 'max:100'],
        'last_name'         => ['required', 'regex:/^[A-Za-zÀ-ÿ\s]+$/u', 'max:100'],
        'email'             => 'required|email',
        'phone'             => ['required', 'regex:/^[0-9]+$/', 'min:10', 'max:15'],
        'alamat'            => 'required|string|max:255',
        'jenis_kelamin'     => 'required|in:Laki-laki,Perempuan',
        'usia'              => 'required|integer|min:1|max:120',
        'tanggal_kunjungan' => 'required|date',
        'pekerjaan'         => 'required|string',
        'instansi'          => 'required|string',
        'layanan'           => 'required|string',
        'kunjungan'         => 'required|string',
        'message'           => 'required|string',
        'survei'            => 'required|integer|min:1|max:5',
    ]);

    $feedback->update($request->all());

    return redirect()->route('laporan.index')->with('success', 'Data feedback berhasil diperbarui!');
}

// Menghapus data (sudah ada)
public function destroy(Feedback $feedback)
{
    $feedback->delete();
    return redirect()->route('laporan.index')->with('success', 'Data feedback berhasil dihapus!');
}

    
}
