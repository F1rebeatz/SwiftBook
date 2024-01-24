<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Hotel;
use App\Models\Review;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(int $hotelId):View
    {
        $hotel = Hotel::with(['reviews'])->findOrFail($hotelId);
        $reviews = $hotel->reviews()->with('user')->latest()->paginate(10);

        return view('reviews.index', compact('hotel', 'reviews'));
    }

    public function store(ReviewRequest $request, int $hotelId): RedirectResponse
    {
        $data = $request->validated();
        Review::create([
            'comment' => $data['comment'],
            'rating' => $data['rating'],
            'user_id' => auth()->user()->id,
            'hotel_id' => $hotelId
        ]);

        return redirect()->back()->with('success', 'Comment added successful!');
    }

    public function edit(int $reviewId):View
    {
        $review = Review::findOrFail($reviewId);
        return view('reviews.edit', compact('review'));
    }

    public function update(ReviewRequest $request, $reviewId): RedirectResponse
    {
        $review = Review::findOrFail($reviewId);
        $data = $request->validated();

        $review->update($data);

        return redirect()->route('reviews.index', $review->hotel_id)->with('success', 'Comment updated successfully!');
    }

    public function remove(int $reviewId): RedirectResponse
    {
        $review = Review::findOrFail($reviewId);
        $hotelId = $review->hotel_id;
        $review->delete();
        return redirect()->route('reviews.index', $hotelId)->with('success', 'Review deleted successfully!');
    }
}
