<?php

namespace App\Http\Controllers;

use App\Http\Filters\HotelFilter;
use App\Http\Requests\HotelRequest;
use App\Models\Booking;
use App\Models\Hotel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HotelController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(HotelRequest $request)
    {
        $data = $request->validated();

        $filter = app()->make(HotelFilter::class, ['queryParams' => array_filter($data)]);
        $hotels = Hotel::filter($filter)->paginate(10);
        return view('hotels.index', compact('hotels'));
    }


    public function show(Request $request, $id)
    {
        $hotel = Hotel::find($id);
        $rooms = $hotel->rooms;

        $startDate = $request->input('start_date', now()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->addDay()->format('Y-m-d'));

        foreach ($rooms as $room) {
            $room->total_price = $room->price * $room->calculateDays($startDate, $endDate);
            $room->total_days = $room->calculateDays($startDate, $endDate);
        }

        return view('hotels.show', compact('hotel', 'rooms', 'startDate', 'endDate'));
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
            'started_at' => Carbon::createFromFormat('Y-m-d', $request->input('started_at')),
            'finished_at' => Carbon::createFromFormat('Y-m-d', $request->input('finished_at')),
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
