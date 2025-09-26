<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // 🔹 Daftar admin
    public function index()
    {
        $admins = User::all();
        return view('admin.index', compact('admins'));
    }

    // 🔹 Form tambah admin
    public function create()
    {
        return view('admin.register');
    }

    // 🔹 Simpan admin baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan.');
    }
    // 🔹 Hapus admin
public function destroy($id)
{
    $admin = User::findOrFail($id);
    $admin->delete();

    return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus.');
}

}