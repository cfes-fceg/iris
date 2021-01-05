<x-admin-layout :title="(isset($stream) ? 'Edit' : 'New' ). ' Stream'">
    <form method="post"
          action="{{ isset($stream) ? route('admin.streams.update', $stream) : route('admin.streams.store') }}">
        @csrf
        @method(isset($stream) ? 'PUT' : 'POST')
        <div class="bg-white rounded overflow-hidden shadow-lg p-4">
            <div class="mb-2">
                <x-label for="title" :value="__('Title')"/>
                <x-input id="title" class="block mt-1 w-full" type="text" name="title"
                         :value="old('title', optional($stream)->title)" required
                         autofocus/>
                @error('title')
                <span>
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="my-2">
                <x-label for="description" :value="__('Description')"/>
                <x-textarea id="description" class="block mt-1 w-full" name="description"
                            required autofocus>
                    {{ old('description', optional($stream)->description) }}
                </x-textarea>
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
