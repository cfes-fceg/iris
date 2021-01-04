<x-admin-layout title="Users">
    <x-slot name="actions">
        <x-btn-link-primary href="{{ route('admin.users.create') }}">
            New
        </x-btn-link-primary>
    </x-slot>

    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-scroll relative"
         style="height: 50vh;">
        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
            <thead>
            <tr class="text-left">
                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    Activated
                </th>
                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    name
                </th>
                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    email
                </th>
                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    actions
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach(\App\Models\User::all() as $user)
                <tr>
                    <td class="border-dashed border-t border-gray-200 userId">
                        <span class="text-gray-700 px-6 py-3 flex items-center">
                            @if($user->is_active == true)
                                <i class="fas fa-check-circle text-green-500"></i>
                            @else
                                <i class="fas fa-times-circle text-yellow-400"></i>
                            @endif
                        </span>
                    </td>
                    <td class="border-dashed border-t border-gray-200 userId">
                        <span class="text-gray-700 px-6 py-3 flex items-center">
                            {{ $user->name  }}
                        </span>
                    </td>
                    <td class="border-dashed border-t border-gray-200 lastName">
                        <span class="text-gray-700 px-6 py-3 flex items-center">
                            {{ $user->email }}
                        </span>
                    </td>
                    <td class="border-dashed border-t border-gray-200 lastName p-3">
                        <form method="post" action="{{ route('admin.users.destroy', $user) }}">
                            @csrf
                            @method('DELETE')
                            <x-btn-link-primary href="{{ route('admin.users.edit', $user) }}">
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
