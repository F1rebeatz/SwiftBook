<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $bookings = Booking::with(['room'])->where('user_id', $user->id)->get();
        return view('bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $room = $booking->room;
        $hotel = $booking->room->hotel;
        return view('bookings.show', compact('booking', 'room', 'hotel'));
    }


}
