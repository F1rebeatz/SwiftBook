<x-app-layout>
    <div class="max-w-2xl mx-auto mt-8 p-4">
        <h1 class="text-3xl font-semibold mb-4">Reviews for {{ $hotel->title }}</h1>

        @foreach($reviews as $review)
            <div class="bg-white p-4 rounded shadow mb-4">
                <p class="font-bold">User: {{ $review->user->name }}</p>
                <p class="text-gray-600">Rating: {{ $review->rating }}</p>
                <p class="text-gray-600">Created at: {{ $review->created_at->format('Y-m-d H:i:s') }}</p>
                <p class="mt-2 font-bold">{{ $review->comment }}</p>

                @auth
                    @if(auth()->user()->id === $review->user->id)
                        <a href="{{ route('reviews.edit', $review->id) }}" class="text-blue-500 hover:underline">Edit</a>
                        <form action="{{ route('reviews.destroy', $review->id) }}" method="post" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline ml-2">Delete</button>
                        </form>
                    @endif
                @endauth
            </div>
        @endforeach
        {{ $reviews->links() }}

        @auth
            @if($message = Session::get('success'))
                <x-success-alert :message="$message" />
            @elseif($message = Session::get('error'))
                <x-error-alert :message="$message" />
            @endif
            <div class="mt-8">
                <h2 class="text-xl font-semibold mb-4">Leave a Review</h2>
                <form action="{{ route('reviews.store', $hotel->id) }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="rating" class="block text-sm font-medium text-gray-600">Rating:</label>
                        <input type="number" name="rating" id="rating" class="mt-1 p-2 border rounded w-full" min="1" max="5" required>
                    </div>
                    <div class="mb-4">
                        <label for="comment" class="block text-sm font-medium text-gray-600">Comment:</label>
                        <textarea name="comment" id="comment" rows="4" class="mt-1 p-2 border rounded w-full"></textarea>
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit Review</button>
                    </div>
                </form>
            </div>
        @endauth
    </div>
</x-app-layout>

