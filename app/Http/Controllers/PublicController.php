<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Post;
use App\Models\Section;
use App\Models\Program;
use App\Models\Teacher;
use App\Models\Schedule;

class PublicController extends Controller
{
    // =========================================================
    // 1. FUNGSI HALAMAN DEPAN (BERANDA)
    // =========================================================
    public function index()
    {
        // Data Slider & Berita
        $sliders = Slider::where('is_active', true)->take(3)->get();
        $news = Post::latest()->take(3)->get();
        
        // Data CMS Profile
        $identitas = Section::where('key', 'identitas')->first();
        $hero = Section::where('key', 'hero')->first();
        $about = Section::where('key', 'about')->first();
        
        
        // Data Visi & Misi Terpisah
        $visi = Section::where('key', 'visi')->first();
        $misi = Section::where('key', 'misi')->first();

        // ---> INI DATA REKENING DONASI BARU <---
        $rekening_1 = Section::where('key', 'rekening_1')->first();
        $rekening_2 = Section::where('key', 'rekening_2')->first();

        // Data Penunjang Lain
        $programs = Program::all();
        $schedules = Schedule::all();
        $pengurus_putra = Section::where('key', 'kepengurusan_putra')->first();
        $pengurus_putri = Section::where('key', 'kepengurusan_putri')->first();
        // Kirim semua data ke View 'welcome.blade.php'
        return view('welcome', compact(
            'sliders', 'news', 'identitas', 'hero', 'about', 
            'visi', 'misi', 'rekening_1', 'rekening_2', 'programs', 'schedules', 'pengurus_putra', 'pengurus_putri'
        ));
    }

    // =========================================================
    // 2. FUNGSI HALAMAN BACA SEJARAH LENGKAP
    // =========================================================
    public function sejarah()
    {
        $sejarah = Section::where('key', 'about')->firstOrFail();
        $identitas = Section::where('key', 'identitas')->first();

        return view('pages.sejarah', compact('sejarah', 'identitas'));
    }

    // =========================================================
    // 3. FUNGSI HALAMAN DETAIL PROGRAM PENDIDIKAN
    // =========================================================
    public function showProgram($id)
    {
        $program = Program::findOrFail($id);
        $identitas = Section::where('key', 'identitas')->first();
        
        return view('pages.program', compact('program', 'identitas'));
    }

    // =========================================================
    // 4. FUNGSI HALAMAN DONASI (JIKA DIBUAT HALAMAN TERPISAH)
    // =========================================================
    public function donasi()
    {
        // Ambil data identitas (untuk logo/nama web)
        $identitas = \App\Models\Section::where('key', 'identitas')->first();
        
        // AMBIL DATA REKENING DARI DATABASE
        $rekening_1 = \App\Models\Section::where('key', 'rekening_1')->first();
        $rekening_2 = \App\Models\Section::where('key', 'rekening_2')->first();

        // Kirimkan datanya ke halaman 'pages.donasi'
        return view('pages.donasi', compact('identitas', 'rekening_1', 'rekening_2'));
    }
    // FUNGSI UNTUK BACA DETAIL BERITA
public function showBerita($id)
{
    $post = \App\Models\Post::findOrFail($id);
    $identitas = \App\Models\Section::where('key', 'identitas')->first();

    return view('pages.berita', compact('post', 'identitas'));
}
}