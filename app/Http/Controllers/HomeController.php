<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Cek apakah user ini admin?
    if (Auth::user()->role == 'admin') {
        // Nanti kita arahkan ke dashboard admin
        return redirect()->route('admin.dashboard'); 
    }

    // Ambil data pendaftaran milik user yang sedang login
    $pendaftaran = Registration::where('user_id', Auth::id())->first();

    return view('home', compact('pendaftaran'));
    }
}
