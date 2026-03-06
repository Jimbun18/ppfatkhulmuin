<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Menampilkan daftar berita
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.posts.index', compact('posts'));
    }

    // Form Tambah Berita
    public function create()
    {
        return view('admin.posts.create');
    }

    // Simpan Berita Baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title); // Bikin slug otomatis
        $data['is_published'] = true; // Langsung terbit

        // Proses Upload Gambar
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        Post::create($data);

        return redirect()->route('posts.index')->with('success', 'Berita berhasil diterbitkan!');
    }

    // Form Edit Berita
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    // Update Berita
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        // Cek jika ganti gambar
        if ($request->hasFile('image')) {
            // Hapus gambar lama biar hemat storage
            if ($post->image) {
                Storage::delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'Berita berhasil diperbarui!');
    }

    // Hapus Berita
    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::delete($post->image);
        }
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Berita dihapus.');
    }
}