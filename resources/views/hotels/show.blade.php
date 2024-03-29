@php
    $startDate = request()->get('start_date', now()->format('Y-m-d'));
    $endDate = request()->get('end_date', now()->addDay()->format('Y-m-d'));

@endphp

<x-app-layout>
    @if($message = Session::get('success'))
        <x-success-alert :message="$message"/>
    @elseif($message = Session::get('error'))
        <x-error-alert :message="$message"/>
    @endif
    <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
        <div class="flex flex-wrap mb-12">
            <div class="w-full flex justify-start md:w-1/3 mb-8 md:mb-0">
                <img class="h-full rounded-l-sm" src="{{ $hotel->poster_url }}" alt="Room Image">
            </div>
            <div class="w-full md:w-2/3 px-4">
                <div class="text-2xl font-bold">{{ $hotel->title }}</div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-1 text-blue-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 21s-8-4.5-8-11a8 8 0 1 1 16 0c0 6.5-8 11-8 11zm0 0V10m0 0s0 0 0 0V3h0h0"></path>
                    </svg>
                    {{ $hotel->address }}
                </div>
                <div class="mb-3">{{ $hotel->description }}</div>
                <div>
                    <a href="{{ route('reviews.index', $hotel->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out">
                        View Reviews
                    </a>
                </div>
            </div>
        </div>

        <div class="flex flex-col">
            <div class="text-2xl text-center md:text-start font-bold">Забронировать комнату</div>

            <form method="get" action="{{ route('hotels.show', ['id' => $hotel->id]) }}" class="my-6">
                <div class="flex items-center space-x-5">
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <input name="start_date" min="{{ date('Y-m-d') }}" value="{{ $startDate }}"
                                   placeholder="Дата заезда" type="date"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
                        </div>
                        <span class="text-gray-500">по</span>
                        <div class="relative">
                            <input name="end_date" type="date" min="{{ date('Y-m-d') }}" value="{{ $endDate }}"
                                   placeholder="Дата выезда"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <span class="mr-2">Сортировать по:</span>
                        <select name="sort_by" class="border border-gray-300 rounded-lg p-2">
                            <option value="price_asc" {{ $sortBy === "price_asc" ? 'selected' : '' }}>Цена по
                                возрастанию
                            </option>
                            <option value="price_desc" {{ $sortBy === "price_desc" ? 'selected' : '' }}>Цена по
                                убыванию
                            </option>
                        </select>
                    </div>

                    <div>
                        <x-the-button type="submit" class="h-full w-full">Загрузить номера</x-the-button>
                    </div>
                </div>
            </form>
            @if($startDate && $endDate)
                <div class="flex flex-col w-full lg:w-4/5">
                    @foreach($rooms as $room)
                        <x-rooms.room-list-item :room="$room" class="mb-4"/>
                    @endforeach
                </div>
            @else
                <div></div>
            @endif
        </div>
    </div>
</x-app-layout>
