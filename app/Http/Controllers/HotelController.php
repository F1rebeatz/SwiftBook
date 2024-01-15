<?php

namespace App\Http\Controllers;

use App\Http\Filters\HotelFilter;
use App\Http\Requests\HotelRequest;
use App\Mail\BookingConfirmation;
use App\Models\Facility;
use App\Models\Hotel;
use App\Services\BookingService;
use App\Services\HotelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HotelController extends Controller
{
    protected HotelService $hotelService;
    protected BookingService $bookingService;
    public function __construct(HotelService $hotelService, BookingService $bookingService)
    {
        $this->hotelService = $hotelService;
        $this->bookingService = $bookingService;
        $this->middleware('auth');
    }

    public function index(HotelRequest $request)
    {
        $selectedFacilities = $request->input('facilities', []);
        $data = $request->validated();

        $facilities = Facility::all();

        $filter = app()->make(HotelFilter::class, ['queryParams' => $data]);

        $hotels =  Hotel::with('facilities')->filter($filter)->paginate(10);

        return view('hotels.index', compact('hotels', 'facilities', 'selectedFacilities'));
    }

    public function show(Request $request, $id)
    {
        $queryParams = $request->all();
        $data = $this->hotelService->display($id, $queryParams);
        return view('hotels.show', $data);
    }

    public function book(Request $request, $id)
    {
        $requestData = $request->all();
        $booking = $this->bookingService->book($id, $requestData);

        if (isset($booking['error'])) {
            return redirect()->back()->with('error', $booking['error']);
        }

        Mail::to(auth()->user()->email)->send(new BookingConfirmation($booking));

        return redirect()->back();
    }
}
