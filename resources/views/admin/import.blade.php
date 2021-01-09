<x-admin-layout title="Data import">
    <div class="bg-white rounded overflow-hidden shadow-lg p-4">
        @if(defined('success'))
            <div class="bg-green-500 text-white rounded p-3 w-full mb-2">
            <span class="text-md">
                Success!
            </span>
            </div>
        @endif
        <form method="post"
              action="{{ route('admin.import') }}"
              enctype="multipart/form-data"
        >
            @csrf
            @method('POST')
            <div class="flex flex-row w-full items-center">

                <x-label class="mx-2" for="users" :value="__('Import users (.csv)').':'"/>
                <div class="mx-2">
                    <x-input id="users" class="block mt-1 w-full"
                             type="file" name="users"/>
                    @error('users')
                    <span>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="flex flex-row-reverse mx-2">
                    <x-button type="submit" name='submit'>
                        import
                    </x-button>
                </div>
            </div>
        </form>
        <form class="mt-2" method="post"
              action="{{ route('admin.import') }}"
              enctype="multipart/form-data"
        >
            @csrf
            @method('POST')
            <div class="flex flex-row w-full items-center">

                <x-label class="mx-2" for="sessions" :value="__('Import sessions (.csv)').':'"/>
                <div class="mx-2">
                    <x-input id="sessions" class="block mt-1 w-full"
                             type="file" name="sessions"/>
                    @error('sessions')
                    <span>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="flex flex-row-reverse mx-2">
                    <x-button type="submit" name="submit">
                        import
                    </x-button>
                </div>
            </div>
        </form>
        <form class="mt-2" method="post"
              action="{{ route('admin.import') }}"
              enctype="multipart/form-data"
        >
            @csrf
            @method('POST')
            <div class="flex flex-row w-full items-center">

                <x-label class="mx-2" for="snl" :value="__('Import SNL Groups (.csv)').':'"/>
                <div class="mx-2">
                    <x-input id="snl" class="block mt-1 w-full"
                             type="file" name="snl"/>
                    @error('snl')
                    <span>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="flex flex-row-reverse mx-2">
                    <x-button type="submit" name="submit">
                        import
                    </x-button>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>
