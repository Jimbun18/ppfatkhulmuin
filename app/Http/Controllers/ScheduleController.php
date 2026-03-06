<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();
        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        return view('admin.schedules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'time' => 'required',     // Contoh: 07.00 - 08.00
            'activity' => 'required', // Contoh: Mengaji Kitab
        ]);

        Schedule::create($request->all());
        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function edit(Schedule $schedule)
    {
        return view('admin.schedules.edit', compact('schedule'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $schedule->update($request->all());
        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil diupdate');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'Jadwal dihapus');
    }
}