<x-app-layout>

    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold mb-4">Edit Review</h2>

                <form action="{{ route('reviews.update', [$review->id, 'id' => $review->hotel_id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="comment" class="block text-sm font-medium text-gray-600">Comment</label>
                        <textarea id="comment" name="comment" rows="4" class="form-input mt-1 block w-full" required>{{ $review->comment }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="rating" class="block text-sm font-medium text-gray-600">Rating</label>
                        <input type="number" id="rating" name="rating" min="1" max="5" class="form-input mt-1 block w-full" value="{{ $review->rating }}" required>
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out">Update Review</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
