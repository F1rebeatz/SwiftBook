<?php

namespace App\Http\Controllers;

use App\Http\Filters\HotelFilter;
use App\Http\Requests\HotelRequest;
use App\Mail\BookingConfirmation;
use App\Models\Facility;
use App\Models\Hotel;
use App\Services\BookingService;
use App\Services\HotelService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class HotelController extends Controller
{
    protected HotelService $hotelService;
    public function __construct(HotelService $hotelService)
    {
        $this->hotelService = $hotelService;
        $this->middleware('auth');
    }

    /**
     * @param HotelRequest $request
     * @return View
     * @throws BindingResolutionException
     */
    public function index(HotelRequest $request):View
    {
        $selectedFacilities = $request->input('facilities', []);
        $data = $request->validated();

        $facilities = Facility::all();

        $filter = app()->make(HotelFilter::class, ['queryParams' => $data]);

        $hotels =  Hotel::with('facilities')->filter($filter)->paginate(10);

        return view('hotels.index', compact('hotels', 'facilities', 'selectedFacilities'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return View
     */
    public function show(Request $request, int $id):View
    {
        $queryParams = $request->all();
        $data = $this->hotelService->display($id, $queryParams);
        return view('hotels.show', $data);
    }

}
