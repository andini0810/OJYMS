<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;
use App\Models\User;

class EventsController extends Controller
{
    // Menampilkan semua event
    public function showEvents()
    {
        $events = Event::orderBy('start_datetime', 'asc')->get(); // Mendapatkan semua data event
        return view('events', compact('events')); // Mengirim data event ke view
    }

    // Menampilkan form untuk membuat event baru
    public function createEvent()
    {
        return view('eventcreate'); // Mengarahkan ke form pembuatan event
    }

    // Menyimpan event baru
    public function storeEvent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_datetime' => 'required',
            'end_datetime' => 'required|date|after:start_datetime',
            'location' => 'required|string|max:255',
        ]);

        $start_datetime = Carbon::parse($request->start_datetime);
        $end_datetime = Carbon::parse($request->end_datetime);

        $user = Event::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_datetime' => $start_datetime,
            'end_datetime' => $end_datetime,
            'location' => $request->location,
        ]);

        return redirect()->route('events')->with('success', 'Event created successfully!');
    }
}
