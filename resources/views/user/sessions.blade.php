<x-user-layout title="Sessions">
    <x-slot name="actions">
        <form method="get" action="{{ route('sessions') }}">
            <div class="flex flex-row items-center">
                <div class="flex flex-row items-center mx-2">
                    <x-label for="date" class="mr-2">
                        {{ __('Schedule for date:') }}
                    </x-label>
                    <a href="{{ $links['prev'] }}" class="p-2 bg-white hover:bg-gray-50 shadow-sm rounded mr-2">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    <x-input class="mr-2" id="date" name="date" type="date" value="{{ isset($data['date']) ? $data['date'] : \Carbon\Carbon::now('America/Toronto')->format('Y-m-d') }}"/>
                    <a href="{{ $links['next'] }}" class="p-2 bg-white hover:bg-gray-50 shadow-sm rounded">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
                <x-label class="flex flex-row items-center mr-2">
                        <span class="mr-2">
                            {{ __("Stream") }}:
                        </span>
                    <x-select name="stream"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value>{{ __('All') }}</option>
                        @foreach(\App\Models\SessionStream::all() as $stream)
                            <option
                                value="{{ $stream->id }}"
                                @if(isset($data['stream']) && $data['stream'] == $stream->id)
                                selected="selected"
                                @endif
                            >{{ $stream->title }}</option>
                        @endforeach
                    </x-select>
                </x-label>
                <x-button class="h-full py-3">
                    Go
                </x-button>
            </div>
        </form>
    </x-slot>
    @if($sessions->count() == 0)
        <div class="p-6 mb-6 py-20 flex flex-col items-center">
            <span class="text-lg text-gray-500">
                {{ __('No sessions match the current selection') }}
            </span>
        </div>
    @endif
    @foreach($sessions as $session)
        <div class="mb-6">
            <div class="px-10 py-6 bg-white rounded-lg shadow-md">
                <div class="flex justify-between items-center">
                            <span class="font-light text-gray-600">
                                {{ $session->start->shortRelativeDiffForHumans()}}
                            </span>
                    <a href="#"
                       class="px-2 py-1 bg-gray-600 text-gray-100 font-bold rounded hover:bg-gray-500">
                        {{ isset($session->stream) ? $session->stream->title : __('All Streams') }}
                    </a>
                </div>
                <div class="mt-2">
                    <h3 class="text-2xl text-gray-700 font-bold">
                        {{ $session->title }}
                    </h3>
                    <h4 class="text-md text-gray-500">
                        {{ $session->formattedDate() }}
                    </h4>
                    <p class="mt-2 text-gray-600">
                        {{ $session->description }}
                    </p>
                </div>
                @isset($session->zoom_meeting_id)
                    <div class="flex justify-between items-center mt-4">
                        <x-btn-link-primary
                            :href="isset($session->zoom_meeting_id) ? route('sessions.join', $session) : '#' ">
                            Join Zoom Session
                        </x-btn-link-primary>
                    </div>
                @endisset
            </div>
        </div>
    @endforeach
    <div class="w-full flex flex-row justify-around">
        <div>
            <a href="{{ $links['prev'] }}" class="p-2 bg-white hover:bg-gray-50 shadow-md rounded mr-2">
                <i class="fas fa-chevron-left"></i>
            </a>
            <span class="p-2 bg-white shadow-md rounded mr-2">
                {{ $data['date'] ?? \Carbon\Carbon::now('America/Toronto')->format('Y-m-d') }}
            </span>
            <a href="{{ $links['next'] }}" class="p-2 bg-white hover:bg-gray-50 shadow-md rounded">
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </div>

{{-- Pagination, unused
    <div class="mt-8">
        <div class="flex">
            <a href="#"
               class="mx-1 px-3 py-2 bg-white text-gray-500 font-medium rounded-md cursor-not-allowed">
                previous
            </a>

            <a href="#"
               class="mx-1 px-3 py-2 bg-white text-gray-700 font-medium hover:bg-blue-500 hover:text-white rounded-md">
                1
            </a>

            <a href="#"
               class="mx-1 px-3 py-2 bg-white text-gray-700 font-medium hover:bg-blue-500 hover:text-white rounded-md">
                2
            </a>

            <a href="#"
               class="mx-1 px-3 py-2 bg-white text-gray-700 font-medium hover:bg-blue-500 hover:text-white rounded-md">
                3
            </a>

            <a href="#"
               class="mx-1 px-3 py-2 bg-white text-gray-700 font-medium hover:bg-blue-500 hover:text-white rounded-md">
                Next
            </a>
        </div>
    </div>--}}
</x-user-layout>
