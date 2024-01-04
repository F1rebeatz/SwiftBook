<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $hotels = Hotel::all();
        return view('hotels.index', compact('hotels'));
    }

    public function show($id) {
        $hotel = Hotel::find($id);
        $rooms = $hotel->rooms;
        return view('hotels.show', compact('hotel', 'rooms'));
    }

    public function book(Request $request, $id) {
        $request->validate([
            'started_at' => 'required|date',
            'finished_at' => 'required|date|after:start_date',
        ]);
        $hotel = Hotel::find($id);

        if (!$hotel) {
            return redirect()->back()->with('error', 'Hotel not found.');
        }

        $booking = new Booking([
            'started_at' => $request->input('started_at'),
            'finished_at' => $request->input('finished_at'),
            'hotel_id' => $hotel->id,
            'user_id' => auth()->user()->id,
            'room_id' => $request->input('room_id'),
            'price' => $request->input('price'),
            'days' => $request->input('days'),
        ]);

        $booking->save();

        return redirect()->back()->with('success', 'Booking created successfully.');
    }


}
