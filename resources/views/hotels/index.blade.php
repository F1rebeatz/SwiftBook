<x-app-layout>
    <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto flex">
        <div class="w-1/4 pr-6">
            <x-hotel-filter :facilities="$facilities" :selectedFacilities="$selectedFacilities"></x-hotel-filter>
        </div>
        <div class="w-3/4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($hotels as $hotel)
                    <x-hotels.hotel-card :hotel="$hotel"></x-hotels.hotel-card>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $hotels->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

