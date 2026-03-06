<?php
namespace App\Http\Controllers;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SectionController extends Controller
{
    public function index() {
        // Ambil data sambutan dan visimisi
        $sections = Section::all();
        return view('admin.sections.index', compact('sections'));
    }

    public function update(Request $request, $id) {
        $section = Section::findOrFail($id);
        
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->only(['title', 'content']);

        if ($request->file('image')) {
            if ($section->image) Storage::delete($section->image);
            $data['image'] = $request->file('image')->store('sections', 'public');
        }

        $section->update($data);
        return redirect()->back()->with('success', 'Konten berhasil diperbarui!');
    }
}