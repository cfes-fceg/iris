<x-admin-layout title="Session Streams">
    <!-- Search -->
    <div class="mb-4 flex justify-between items-center">
        <div class="flex-1 pr-4">
            <div class="relative md:w-1/3">
                <input type="search"
                       class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                       placeholder="Search...">
                <div class="absolute top-0 left-0 inline-flex items-center p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round">
                        <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                        <circle cx="10" cy="10" r="7"/>
                        <line x1="21" y1="21" x2="15" y2="15"/>
                    </svg>
                </div>
            </div>
        </div>
        <div>
            <x-btn-link-primary href="{{ route('admin.streams.create') }}">
                New
            </x-btn-link-primary>
        </div>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-scroll relative"
         style="height: 50vh;">
        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
            <thead>
            <tr class="text-left">
                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    title
                </th>
                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    zoom id
                </th>
                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    actions
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach(\App\Models\SessionStream::all() as $stream)
                <tr>
                    <td class="border-dashed border-t border-gray-200 userId">
                        <span class="text-gray-700 px-6 py-3 flex items-center">
                            {{ $stream->title  }}
                        </span>
                    </td>
                    <td class="border-dashed border-t border-gray-200 lastName">
                        <span class="text-gray-700 px-6 py-3 flex items-center">
                            {{ $stream->zoom_meeting_id }}
                        </span>
                    </td>
                    <td class="border-dashed border-t border-gray-200 lastName p-3">
                        <x-button>
                            Do a thing
                        </x-button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-admin-layout>
