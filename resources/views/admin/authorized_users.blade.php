<x-admin-layout title="Authorized User Emails">
    <x-slot name="actions">
        <form method="post"
              action="{{ route('admin.authorizedUsers.store') }}">
            @csrf
            <div class="flex flex-row items-center">
                <x-label for="email" :value="__('Email')"/>
                <div class="mx-2">
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email"/>
                    @error('email')
                    <span>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <x-button class="h-full" type="submit" href="{{ route('admin.users.create') }}">
                    Add
                </x-button>
            </div>
        </form>
    </x-slot>

    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-scroll relative mt-2"
         style="height: 50vh;">
        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
            <thead>
            <tr class="text-left">
                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    email
                </th>
                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    actions
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach(\App\Models\AuthorizedUser::orderBy('email')->get() as $user)
                <tr>
                    <td class="border-dashed border-t border-gray-200 lastName">
                        <span class="text-gray-700 px-6 py-3 flex items-center">
                            {{ $user->email }}
                        </span>
                    </td>
                    <td class="border-dashed border-t border-gray-200 lastName p-3">
                        <form method="post" action="{{ route('admin.authorizedUsers.destroy', $user) }}">
                            @csrf
                            @method('DELETE')
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
