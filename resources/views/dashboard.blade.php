<x-app-layout>
    <!-- component -->
    <div class="flex justify-between w-2/3 mx-auto">
        <div class="-mx-4 w-1/4 hidden lg:block">
            @include('user-sidebar')
        </div>

        <div class="w-full lg:w-3/4">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-bold text-gray-700 md:text-2xl">Sessions</h1>
                <form method="get" action="{{ route('dashboard') }}">
                    <div class="flex flex-row">
                        <label class="flex flex-row items-center">
                        <span class="mr-2">
                            {{ __("Stream") }}:
                        </span>
                            <select name="stream"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value>All streams</option>
                                @foreach(\App\Models\SessionStream::all() as $stream)
                                    <option
                                        value="{{ $stream->id }}"
                                        @if(isset($data['stream']) && $data['stream'] == $stream->id)
                                        selected="selected"
                                        @endif
                                    >{{ $stream->title }}</option>
                                @endforeach
                            </select>
                        </label>
                        <x-button>
                            Go
                        </x-button>
                    </div>
                </form>
            </div>
            @foreach($sessions as $session)
                <div class="mt-6">
                    <div class="max-w-4xl px-10 py-6 bg-white rounded-lg shadow-md">
                        <div class="flex justify-between items-center">
                            <span class="font-light text-gray-600">
                                Jun 1, 2020
                            </span>
                            <a href="#"
                               class="px-2 py-1 bg-gray-600 text-gray-100 font-bold rounded hover:bg-gray-500">
                                {{ isset($session->stream) ? $session->stream->title : "All Streams" }}
                            </a>
                        </div>
                        <div class="mt-2">
                            <span class="text-2xl text-gray-700 font-bold">
                                {{ $session->title }}
                            </span>
                            <p class="mt-2 text-gray-600">
                                {{ $session->description }}
                            </p>
                        </div>
                        <div class="flex justify-between items-center mt-4">
                            <x-btn-link-primary
                                :href="isset($session->stream) ? route('streams.join', $session->stream) : '#' ">
                                Join Zoom Session
                            </x-btn-link-primary>
                        </div>
                    </div>
                </div>
            @endforeach

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
            </div>
        </div>
    </div>
</x-app-layout>
