<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::all();
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'icon' => 'required',
            'content' => 'nullable|string',
            'new_images.*' => 'image|mimes:jpg,jpeg,png|max:2048', // Validasi foto baru
        ]);

        // Ambil data selain gambar
        $data = $request->except(['new_images', 'existing_images']);

        $imagePaths = [];
        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $file) {
                $imagePaths[] = $file->store('programs', 'public');
            }
        }
        $data['images'] = $imagePaths; 

        Program::create($data);
        return redirect()->route('programs.index')->with('success', 'Program berhasil ditambahkan');
    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'icon' => 'required',
            'content' => 'nullable|string',
            'new_images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except(['new_images', 'existing_images']);

        // 1. KELOLA FOTO LAMA (Hapus yang di-klik 'X' oleh admin)
        $existingImages = $request->input('existing_images', []);
        $currentImages = $program->images ?? [];
        
        // Cari gambar yang ada di database, tapi tidak ada di inputan (berarti dihapus admin)
        $imagesToDelete = array_diff($currentImages, $existingImages);
        foreach ($imagesToDelete as $oldImg) {
            Storage::disk('public')->delete($oldImg); // Hapus file fisiknya
        }

        // 2. KELOLA FOTO BARU
        $finalImages = $existingImages; // Mulai dengan foto lama yang dipertahankan
        
        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $file) {
                $finalImages[] = $file->store('programs', 'public');
            }
        }

        $data['images'] = array_values($finalImages); // Reset index array

        $program->update($data);
        return redirect()->route('programs.index')->with('success', 'Program berhasil diupdate');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('programs.index')->with('success', 'Program dihapus');
    }
}