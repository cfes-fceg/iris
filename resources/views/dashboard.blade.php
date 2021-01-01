<x-app-layout>
    <!-- component -->
    <div class="flex justify-between w-2/3 mx-auto">
        <div class="w-full lg:w-8/12">
            <h1 class="text-xl font-bold text-gray-700 md:text-2xl">Sessions</h1>
            {{--<div class="flex items-center justify-between">
                <div>
                    <select
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option>Latest</option>
                        <option>Last Week</option>
                    </select>
                </div>
            </div>--}}
            @foreach(\App\Models\Session::all() as $session)
                <div class="mt-6">
                    <div class="max-w-4xl px-10 py-6 bg-white rounded-lg shadow-md">
                        <div class="flex justify-between items-center">
                            <span class="font-light text-gray-600">
                                Jun 1, 2020
                            </span>
                            <a href="#"
                               class="px-2 py-1 bg-gray-600 text-gray-100 font-bold rounded hover:bg-gray-500">
                                {{ $session->stream->title }}
                            </a>
                        </div>
                        <div class="mt-2">
                            <a href="#" class="text-2xl text-gray-700 font-bold hover:underline">
                                {{ $session->title }}
                            </a>
                            <p class="mt-2 text-gray-600">
                                {{ $session->description }}
                            </p>
                        </div>
                        <div class="flex justify-between items-center mt-4">
                            <x-button>
                                Join Zoom Session
                            </x-button>
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
        <div class="-mx-8 w-4/12 hidden lg:block">
            @include('user-sidebar')
        </div>
    </div>
</x-app-layout>
