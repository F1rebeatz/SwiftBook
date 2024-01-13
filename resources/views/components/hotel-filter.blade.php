@props(['facilities', 'selectedFacilities'])

<div>
    <form action="{{ route('hotels.index') }}" method="get" class="mb-4">
        <div class="mb-4">
            <label for="search" class="block text-sm font-medium text-gray-700">{{ __('Search for a hotel by name, description, address:') }}</label>
            <div class="flex items-center">
                <input type="text" name="search" id="search" value="{{ request('search') }}" class="mt-1 p-2 border rounded-md w-full">
                <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    Search
                </button>
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">{{ __('Facilities:') }}</label>
            <div class="mt-2 space-y-2">
                @if(isset($facilities) && $facilities->isNotEmpty())
                    @foreach($facilities as $facility)
                        <div class="flex items-center">
                            <input type="checkbox" name="facilities[]" value="{{ $facility->id }}" {{ in_array($facility->id, $selectedFacilities) ? 'checked' : '' }} class="mr-2">
                            <span class="text-sm">{{ $facility->title }}</span>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </form>
</div>
