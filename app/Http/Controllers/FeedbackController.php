<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    // 🔹 Form publik
    public function create()
    {
        return view('feedback.form');
    }

    // 🔹 Simpan data baru
    public function store(Request $request)
    {
        try {
           $rules = [
    'first_name'        => ['required', 'regex:/^[\p{L}\s]+$/u', 'max:100'],
    'email'             => 'required|email',
    'phone'             => ['required', 'regex:/^[0-9]+$/', 'min:10', 'max:15'],
    'alamat'            => 'required|string|max:255',
    'jenis_kelamin'     => 'required|in:Laki-laki,Perempuan',
    'usia'              => 'required|integer|min:1|max:120',
    'tanggal_kunjungan' => 'required|date',
    'keperluan'         => 'required|string|max:255',
];



            if ($request->keperluan === 'pst') {
                $rules = array_merge($rules, [
                    'pekerjaan' => 'required|string',
                    'instansi'  => 'required|string',
                    'layanan'   => 'required|string',
                    'kunjungan' => 'required|string',
                    'message'   => 'required|string',
                
                ]);
            } elseif (in_array($request->keperluan, ['subject matter', 'undangan rapat'])) {
                $rules['message'] = 'required|string';
            }
            // kalau keperluan = "lainnya" → message tidak wajib

            $request->validate($rules, [
    'first_name.required' => 'Nama wajib diisi.',
    'first_name.regex'    => 'Nama hanya boleh berisi huruf dan spasi.',
    'first_name.max'      => 'Nama maksimal 100 karakter.',

    'email.required' => 'Email wajib diisi.',
    'email.email'    => 'Format email tidak valid. jangan lupa pakai @ contoh yang benar : example@gmail.com ; example@stis.ac.id',

    'phone.required' => 'Nomor telepon wajib diisi.',
    'phone.regex'    => 'Nomor telepon hanya boleh berisi angka.',
    'phone.min'      => 'Nomor telepon minimal 10 digit.',
    'phone.max'      => 'Nomor telepon maksimal 15 digit.',

    'alamat.required' => 'Alamat wajib diisi.',
    'alamat.max'      => 'Alamat maksimal 255 karakter.',

    'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
    'jenis_kelamin.in'       => 'Jenis kelamin hanya boleh Laki-laki atau Perempuan.',

    'usia.required' => 'Usia wajib diisi.',
    'usia.integer'  => 'Usia harus berupa angka.',
    'usia.min'      => 'Usia minimal 1 tahun.',
    'usia.max'      => 'Usia maksimal 120 tahun.',

    'tanggal_kunjungan.required' => 'Tanggal kunjungan wajib diisi.',
    'tanggal_kunjungan.date'     => 'Tanggal kunjungan tidak valid.',

    'keperluan.required' => 'Keperluan wajib diisi.',
    'keperluan.max'      => 'Keperluan maksimal 255 karakter.',

    // Kalau keperluan = pst
    'pekerjaan.required' => 'Pekerjaan wajib diisi.',
    'instansi.required'  => 'Instansi wajib diisi.',
    'layanan.required'   => 'Layanan wajib diisi.',
    'kunjungan.required' => 'Jenis kunjungan wajib diisi.',
    'message.required'   => 'Pesan wajib diisi.',
  
]);


            $data = $request->all();

            // override kalau pilih "lainnya"
            if ($data['keperluan'] === 'lainnya' && !empty($data['keperluan_lainnya'])) {
                $data['keperluan'] = $data['keperluan_lainnya'];
            }
            if (!empty($data['pekerjaan']) && $data['pekerjaan'] === 'lainnya') {
                $data['pekerjaan'] = $data['pekerjaan_lainnya'];
            }
            if (!empty($data['instansi']) && $data['instansi'] === 'lainnya') {
                $data['instansi'] = $data['instansi_lainnya'];
            }
            if (!empty($data['layanan']) && $data['layanan'] === 'lainnya') {
                $data['layanan'] = $data['layanan_lainnya'];
            }
            if (!empty($data['kunjungan']) && $data['kunjungan'] === 'lainnya') {
                $data['kunjungan'] = $data['kunjungan_lainnya'];
            }

            unset(
                $data['keperluan_lainnya'],
                $data['pekerjaan_lainnya'],
                $data['instansi_lainnya'],
                $data['layanan_lainnya'],
                $data['kunjungan_lainnya']
            );

            Feedback::create($data);

            return redirect()->back()->with('success', 'Terima kasih, data berhasil dikirim!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menyimpan: ' . $e->getMessage()])->withInput();
        }
    }

    // 🔹 Dashboard (hanya untuk user login)
    


    // 🔹 Form edit data
    public function edit(Feedback $feedback)
    {
        return view('feedback.edit', compact('feedback'));
    }

    // 🔹 Update data
    public function update(Request $request, Feedback $feedback)
    {
        try {
           $rules = [
    'first_name'        => ['required', 'regex:/^[A-Za-z�-�\s]+$/u', 'max:100'],
    // 'last_name'      => ['required', 'regex:/^[A-Za-z�-�\s]+$/u', 'max:100'], // dihapus
    'email'             => 'required|email',
    'phone'             => ['required', 'regex:/^[0-9]+$/', 'min:10', 'max:15'],
    'alamat'            => 'required|string|max:255',
    'jenis_kelamin'     => 'required|in:Laki-laki,Perempuan',
    'usia'              => 'required|integer|min:1|max:120',
    'tanggal_kunjungan' => 'required|date',
    'keperluan'         => 'required|string|max:255',
];


            if ($request->keperluan === 'pst') {
                $rules = array_merge($rules, [
                    'pekerjaan' => 'required|string',
                    'instansi'  => 'required|string',
                    'layanan'   => 'required|string',
                    'kunjungan' => 'required|string',
                    'message'   => 'required|string',
                    'survei'    => 'required|integer|min:1|max:5',
                ]);
            } elseif (in_array($request->keperluan, ['subject matter', 'undangan rapat'])) {
                $rules['message'] = 'required|string';
            }
            // kalau keperluan = "lainnya" → message tidak wajib

            $request->validate($rules);

            $data = $request->all();

            // override kalau pilih "lainnya"
            if ($data['keperluan'] === 'lainnya' && !empty($data['keperluan_lainnya'])) {
                $data['keperluan'] = $data['keperluan_lainnya'];
            }
            if (!empty($data['pekerjaan']) && $data['pekerjaan'] === 'lainnya') {
                $data['pekerjaan'] = $data['pekerjaan_lainnya'];
            }
            if (!empty($data['instansi']) && $data['instansi'] === 'lainnya') {
                $data['instansi'] = $data['instansi_lainnya'];
            }
            if (!empty($data['layanan']) && $data['layanan'] === 'lainnya') {
                $data['layanan'] = $data['layanan_lainnya'];
            }
            if (!empty($data['kunjungan']) && $data['kunjungan'] === 'lainnya') {
                $data['kunjungan'] = $data['kunjungan_lainnya'];
            }

            unset(
                $data['keperluan_lainnya'],
                $data['pekerjaan_lainnya'],
                $data['instansi_lainnya'],
                $data['layanan_lainnya'],
                $data['kunjungan_lainnya']
            );

            $feedback->update($data);

            return redirect()->route('laporan.index')->with('success', 'Data feedback berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal update: ' . $e->getMessage()])->withInput();
        }
    }

    // 🔹 Hapus data
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return redirect()->route('laporan.index')->with('success', 'Data Laporan berhasil dihapus!');
    }
   public function dashboard(Request $request)
{
    $tahun   = $request->input('tahun', date('Y'));
    $bulan   = $request->input('bulan', '');
    $tanggal = $request->input('tanggal', '');

    // Ambil daftar tahun unik
    $tahunList = Feedback::selectRaw('YEAR(tanggal_kunjungan) as tahun')
        ->distinct()
        ->pluck('tahun')
        ->sortDesc();

    $query = Feedback::query();

    if ($tahun) {
        $query->whereYear('tanggal_kunjungan', $tahun);
    }
    if ($bulan) {
        $query->whereMonth('tanggal_kunjungan', $bulan);
    }
    if ($tanggal) {
        $query->whereDay('tanggal_kunjungan', $tanggal);
    }

    $feedbacks = $query->get();

    return view('dashboard.index', compact(
        'feedbacks',
        'tahun',
        'bulan',
        'tanggal',
        'tahunList'
    ));
}


}