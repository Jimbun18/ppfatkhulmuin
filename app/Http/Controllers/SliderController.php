<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['is_active'] = true;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('sliders', 'public');
        }

        Slider::create($data);

        return redirect()->route('sliders.index')->with('success', 'Banner berhasil ditambahkan!');
    }

    // METHOD BARU UNTUK EDIT
    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    // METHOD BARU UNTUK UPDATE
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();

        // Jika upload gambar baru, hapus yang lama
        if ($request->hasFile('image')) {
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }
            $data['image'] = $request->file('image')->store('sliders', 'public');
        }

        $slider->update($data);

        return redirect()->route('sliders.index')->with('success', 'Banner berhasil diperbarui!');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->image) {
            Storage::disk('public')->delete($slider->image);
        }
        $slider->delete();

        return redirect()->route('sliders.index')->with('success', 'Banner dihapus!');
    }
}