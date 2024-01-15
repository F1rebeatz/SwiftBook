<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotelRequest;
use App\Models\Booking;
use App\Models\Facility;
use App\Models\Hotel;
use App\Services\BookingService;
use App\Services\HotelService;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $searchQuery = $request->input('search');
        $selectedFacilities = $request->input('facilities', []);
        $facilities = Facility::all();

        $hotels = $this->hotelService->searchAndFilter($searchQuery, $selectedFacilities);

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
        $result = $this->bookingService->book($id, $requestData);

        if (isset($result['error'])) {
            return redirect()->back()->with('error', $result['error']);
        }

        return redirect()->back()->with('success', $result['success']);
    }
}
