<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;
use App\Models\User;

class EventsController extends Controller
{
    // Menampilkan semua event
    public function showEvents(Request $request)
    {
        // Ambil query pencarian dari parameter URL
        $search = $request->input('search');

        // Query untuk mendapatkan semua data event dengan filter pencarian
        $events = Event::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%");
        })
            ->orderBy('start_datetime', 'asc')
            ->get();

        // Mengirim data event ke view
        return view('events', compact('events'));
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
