<x-admin-layout title="New Stream">
    <form method="post" action="{{ route('admin.streams.store') }}">
        @csrf
        @method('POST')
        <div class="bg-white rounded overflow-hidden shadow-lg p-4">
            <div class="mb-2">
                <x-label for="title" :value="__('Title')"/>
                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required
                         autofocus/>
                @error('title')
                <span>
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="my-2">
                <x-label for="zoom_meeting_id" :value="__('Zoom Meeting ID')"/>
                <x-input id="zoom_meeting_id" class="block mt-1 w-full" type="number" name="zoom_meeting_id"
                         :value="old('zoom_meeting_id')" required autofocus/>
                @error('zoom_meeting_id')
                <span>
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="my-2">
                <x-label for="description" :value="__('Description')"/>
                <x-textarea id="description" class="block mt-1 w-full" name="description" :value="old('description')"
                            required autofocus/>
                @error('description')
                <span>
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="flex flex-row-reverse mt-4">
                <x-button type="submit">
                    Save
                </x-button>
            </div>
        </div>
    </form>
</x-admin-layout>
