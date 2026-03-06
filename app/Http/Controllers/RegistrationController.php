<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RegistrationController extends Controller
{
    // Menampilkan Form Pendaftaran
    public function create()
    {
        // Cek apakah user sudah pernah daftar?
        $existing = Registration::where('user_id', Auth::id())->first();
        
        // Jika sudah daftar, lempar ke halaman dashboard (jangan isi form lagi)
        if ($existing) {
            return redirect()->route('home');
        }

        return view('pendaftaran.create');
    }

    // Memproses Data yang Dikirim (Simpan & Upload)
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nik' => 'required|numeric|digits:16',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'asal_sekolah' => 'required',
            'nama_wali' => 'required',
            'no_hp_wali' => 'required|numeric',
            'file_kk' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Max 2MB
            'file_foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 2. Proses Upload File
        // File akan disimpan di folder: storage/app/public/berkas_santri
        $pathKK = $request->file('file_kk')->store('berkas_santri', 'public');
        $pathFoto = $request->file('file_foto')->store('berkas_santri', 'public');

        // 3. Simpan ke Database
        Registration::create([
            'user_id' => Auth::id(),
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'asal_sekolah' => $request->asal_sekolah,
            'nama_wali' => $request->nama_wali,
            'no_hp_wali' => $request->no_hp_wali,
            'file_kk' => $pathKK,
            'file_foto' => $pathFoto,
            'status' => 'menunggu',
        ]);

        // 4. Redirect ke Dashboard dengan pesan sukses
        return redirect()->route('home')->with('success', 'Alhamdulillah, data pendaftaran berhasil dikirim. Mohon tunggu verifikasi admin.');
    }
}