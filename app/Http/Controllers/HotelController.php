<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
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

    public function book($id) {

    }
}
