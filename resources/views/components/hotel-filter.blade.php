<div>
    <form action="{{ route('hotels.index') }}" method="get" class="mb-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
                <input type="text" name="title" id="title" value="{{ request()->input('title') }}" class="mt-1 p-2 border rounded-md w-full">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                <input type="text" name="description" id="description" value="{{ request()->input('description') }}" class="mt-1 p-2 border rounded-md w-full">
            </div>

            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700">Address:</label>
                <input type="text" name="address" id="address" value="{{ request()->input('address') }}" class="mt-1 p-2 border rounded-md w-full">
            </div>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
            Filter
        </button>
    </form>
</div>
