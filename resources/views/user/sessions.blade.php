<x-user-layout title="Sessions">
    <x-slot name="actions">
        <form method="get" action="{{ route('sessions') }}">
            <div class="flex flex-col md:flex-row items-center">
                <x-label for="date" class="mr-2">
                    <span class="text-lg font-extrabold">
                        {{ __('Date:') }}
                    </span>
                </x-label>
                <div class="flex flex-row items-center mb-4 md:mb-0 mx-2">
                    <a href="{{ $links['prev'] }}" class="p-2 bg-white hover:bg-gray-50 shadow-sm rounded mr-2">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    <x-input class="mr-2" id="date" name="date" type="date"
                             value="{{ isset($data['date']) ? $data['date'] : \Carbon\Carbon::now()->format('Y-m-d') }}"/>
                    <a href="{{ $links['next'] }}" class="p-2 bg-white hover:bg-gray-50 shadow-sm rounded">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
                <x-label class="flex flex-row items-center mr-2">
                    <span class="text-lg font-extrabold mr-2">
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
                    <x-button class="h-full py-3 mx-2">
                        Go
                    </x-button>
                </x-label>
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

    <div class="flex flex-row justify-evenly">
        @foreach($sessions->groupBy(['session_stream_id']) as $group)
            <div class="flex-1 flex-col px-2">
                <h2 class="mb-2 font-bold text-xl">
                    @isset($group->first()->stream)
                        {{ $group->first()->stream->title }}
                    @else
                        {{ __('Other sessions') }}
                    @endisset
                </h2>
                @foreach($group as $session)
                    <div class="my-4">
                        <div class="px-10 py-6 bg-white rounded-lg shadow-md">
                            <div class="flex justify-between items-center">
                                <span class="font-light text-gray-600">
                                    {{ $session->start->shortRelativeDiffForHumans()}}
                                </span>
                            </div>
                            <div class="mt-2">
                                <h3 class="text-lg text-gray-700 font-bold">
                                    {{ $session->title }}
                                </h3>
                                <h4 class="text-md text-gray-500">
                                    [{{$session->start->format('H:i')}} - {{$session->end->format('H:i')}}] {{$session->start->tz()}}
                                </h4>
                            </div>

                            <div class="flex flex-row justify-between mt-2">
                                <x-modal :title="$session->title">
                                    <x-slot name="trigger">
                                        <x-button>
                                            {{ __('More info') }}
                                        </x-button>
                                    </x-slot>

                                    <p class="mt-2 text-gray-600">
                                        {{ $session->description }}
                                    </p>
                                    @if( isset($session->zoom_meeting_id) && $session->showJoinButton() )
                                        <div class="flex justify-between items-center mt-4">
                                            <x-btn-link-primary
                                                target="_blank"
                                                :href="route('sessions.join', $session)">
                                                Join Zoom Session
                                            </x-btn-link-primary>
                                        </div>
                                    @endif
                                </x-modal>
                                @if(isset($session->zoom_meeting_id) && $session->showJoinButton())
                                    <x-btn-link-primary
                                        target="_blank"
                                        :href="route('sessions.join', $session)">
                                        Join Zoom Session
                                    </x-btn-link-primary>
                                @endif
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    {{-- Footer date nav    --}}
    <div class="w-full flex flex-row justify-around">
        <div>
            <a href="{{ $links['prev'] }}" class="p-2 bg-white hover:bg-gray-50 shadow-md rounded mr-2">
                <i class="fas fa-chevron-left"></i>
            </a>
            <span class="p-2 bg-white shadow-md rounded mr-2">
                {{ $data['date'] ?? \Carbon\Carbon::now()->format('Y-m-d') }}
            </span>
            <a href="{{ $links['next'] }}" class="p-2 bg-white hover:bg-gray-50 shadow-md rounded">
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </div>
</x-user-layout>
