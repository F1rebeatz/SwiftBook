<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmation;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Room;
use App\Services\BookingService;
use App\Services\HotelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    protected BookingService $bookingService;
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $bookings = Booking::with(['room'])->where('user_id', $user->id)->get();
        return view('bookings.index', compact('bookings'));
    }

    public function book(Request $request, $id)
    {
        $requestData = $request->all();

        try {
            $booking = $this->bookingService->book($id, $requestData);
//            Mail::to(auth()->user()->email)->send(new BookingConfirmation($booking));
            return redirect()->route('bookings.index')->with('success', 'Booking successful!');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function show(Booking $booking)
    {
        $room = $booking->room;
        $hotel = $booking->room->hotel;
        return view('bookings.show', compact('booking', 'room', 'hotel'));
    }

    public function remove($id)
    {
        $booking = Booking::find($id);
        $booking->delete();
        return redirect()->route('bookings.index');
    }

}
