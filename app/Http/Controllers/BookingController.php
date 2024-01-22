<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookingController extends Controller
{
    protected BookingService $bookingService;
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
        $this->middleware('auth');
    }

    public function index():View
    {
        $user = Auth::user();
        $bookings = Booking::with(['room'])->where('user_id', $user->id)->get();
        return view('bookings.index', compact('bookings'));
    }

    public function book(BookingRequest $request, int $id):RedirectResponse
    {
        $requestData = $request->validated();
        try {
            $this->bookingService->book($id, $requestData);
            return redirect()->back()->with('success', 'Booking successful!');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function show(Booking $booking):View
    {
        $room = $booking->room;
        $hotel = $booking->room->hotel;
        return view('bookings.show', compact('booking', 'room', 'hotel'));
    }

    public function remove(int $id):RedirectResponse
    {
        $booking = Booking::find($id);
        $booking->delete();
        return redirect()->route('bookings.index');
    }
}
