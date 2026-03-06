<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    /**
     * Menampilkan daftar semua pengajar (Halaman Admin)
     */
    public function index()
    {
        $teachers = Teacher::latest()->get();
        return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Menampilkan form tambah pengajar baru
     */
    public function create()
    {
        return view('admin.teachers.create');
    }

    /**
     * Menyimpan data pengajar baru ke database
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255', // Jabatan (Misal: Kepala Madrasah)
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Max 2MB
        ]);

        $data = $request->all();

        // 2. Proses Upload Foto (Jika ada)
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('teachers', 'public');
            $data['image'] = $path;
        }

        // 3. Simpan ke Database
        Teacher::create($data);

        return redirect()->route('teachers.index')->with('success', 'Data pengajar berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit pengajar
     */
    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    /**
     * Memperbarui data pengajar
     */
    public function update(Request $request, Teacher $teacher)
    {
        // 1. Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        // 2. Cek apakah ada upload foto baru?
        if ($request->hasFile('image')) {
            // Hapus foto lama jika ada
            if ($teacher->image) {
                Storage::delete($teacher->image);
            }
            // Upload foto baru
            $path = $request->file('image')->store('teachers', 'public');
            $data['image'] = $path;
        }

        // 3. Update Database
        $teacher->update($data);

        return redirect()->route('teachers.index')->with('success', 'Data pengajar berhasil diperbarui!');
    }

    /**
     * Menghapus data pengajar
     */
    public function destroy(Teacher $teacher)
    {
        // Hapus file foto dari penyimpanan agar tidak menumpuk
        if ($teacher->image) {
            Storage::delete($teacher->image);
        }

        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Data pengajar berhasil dihapus.');
    }
}