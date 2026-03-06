<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\User;

class AdminController extends Controller
{
    // Halaman Dashboard Utama
    public function index()
    {
        $totalPendaftar = Registration::count();
        $belumVerifikasi = Registration::where('status', 'menunggu')->count();
        $diterima = Registration::where('status', 'diterima')->count();

        return view('admin.dashboard', compact('totalPendaftar', 'belumVerifikasi', 'diterima'));
    }

    // Halaman List Pendaftar
    public function pendaftar()
    {
        $pendaftar = Registration::latest()->get();
        return view('admin.pendaftar.index', compact('pendaftar'));
    }

    // Halaman Detail & Verifikasi
    public function show($id)
    {
        $data = Registration::findOrFail($id);
        return view('admin.pendaftar.show', compact('data'));
    }

    // Proses Verifikasi (Terima/Tolak)
    public function verifikasi(Request $request, $id)
    {
        $data = Registration::findOrFail($id);

        $data->status = $request->status;
        // Jika ditolak, simpan alasannya (opsional)
        if($request->status == 'ditolak'){
            $data->catatan_admin = $request->catatan;
        }
        $data->save();

        return redirect()->back()->with('success', 'Status pendaftar berhasil diperbarui!');
    }
}