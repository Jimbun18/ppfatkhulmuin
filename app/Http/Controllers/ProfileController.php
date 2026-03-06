<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Pendaftar;

class ProfileController extends Controller
{
    // Tampilkan Halaman Profil
    public function edit()
    {
        $user = Auth::user();
        
        // Cek jika user adalah santri, ambil data pendaftarnya untuk No HP
        $pendaftar = null;
        if ($user->role == 'santri') {
            $pendaftar = Pendaftar::where('user_id', $user->id)->first();
        }

        return view('profile.edit', compact('user', 'pendaftar'));
    }

    // Update Data Diri (Nama, Email, No HP)
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'no_hp' => 'nullable|numeric', // Validasi HP
        ]);

        // 1. Update Tabel User
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // 2. Update No HP (Khusus Santri)
        if ($user->role == 'santri') {
            $pendaftar = Pendaftar::where('user_id', $user->id)->first();
            if ($pendaftar) {
                $pendaftar->no_hp_wali = $request->no_hp; // Asumsi kolom HP di tabel pendaftar
                $pendaftar->save();
            }
        }

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    // Update Password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Cek password lama
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah!']);
        }

        // Update password baru
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Kata sandi berhasil diganti!');
    }
}