<x-admin-layout title="Sessions">
    <x-slot name="actions">
        <x-btn-link-primary href="{{ route('admin.sessions.create') }}">
            New
        </x-btn-link-primary>
    </x-slot>

    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-scroll relative"
         style="height: 50vh;">
        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
            <thead>
            <tr class="text-left">
                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    stream
                </th>
                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    title
                </th>
                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    Time
                </th>
                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    actions
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach(\App\Models\Session::orderBy('start')->get() as $session)
                <tr>
                    <td class="border-dashed border-t border-gray-200">
                        <span class="text-gray-700 px-6 py-3 flex items-center">
                            {{ $session->stream ? $session->stream->title : "--" }}
                        </span>
                    </td>
                    <td class="border-dashed border-t border-gray-200">
                        <span class="text-gray-700 px-6 py-3 flex items-center">
                            {{ $session->title }}
                        </span>
                    </td>
                    <td class="border-dashed border-t border-gray-200">
                        <span class="text-gray-700 p-1 flex items-center whitespace-nowrap">
                            {{ $session->start }}
                        </span>
                        <span class="text-gray-700 p-1 flex items-center whitespace-nowrap">
                            {{ $session->end }}
                        </span>
                    </td>
                    <td class="border-dashed border-t border-gray-200 p-3 whitespace-nowrap px-2">
                        <form method="post" action="{{ route('admin.sessions.destroy', $session) }}">
                            @csrf
                            @method('DELETE')
                            <x-btn-link-primary href="{{ route('admin.sessions.edit', $session) }}">
                                Edit
                            </x-btn-link-primary>
                            <x-button>
                                Delete
                            </x-button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-admin-layout>
