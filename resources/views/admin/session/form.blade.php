<x-admin-layout :title="(isset($session) ? 'Edit' : 'New' ). ' Session'">
    <form method="post"
          action="{{ isset($session) ? route('admin.sessions.update', $session) : route('admin.sessions.store') }}">
        @csrf
        @method(isset($session) ? 'PUT' : 'POST')
        <div class="bg-white rounded shadow-lg p-4">

            <div class="mb-2">
                <x-label for="title" :value="__('Title')"/>
                <x-input id="title" class="block mt-1 w-full" type="text" name="title"
                         :value="old('title', optional($session)->title)" required
                         autofocus/>
                @error('title')
                <span class="text-red-600">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="my-2">
                <x-label for="stream" :value="__('Session Stream')"/>
                @if(isset($session) && $session->zoom_meeting_id != null)
                    <p class="p-1 bg-yellow-50 rounded-md"><strong>Note:</strong> Changing this setting will not change the zoom host for the meeting</p>
                @endif
                <x-select id="stream" class="block mt-1 w-full" type="datetime-local" name="session_stream_id">
                    <option value="">Select a stream...</option>
                    @foreach(\App\Models\SessionStream::all() as $stream)
                        <option
                            {!! old('session_stream_id', optional($session)->session_stream_id) == $stream->id ? 'selected' : "" !!}
                            value="{{ $stream->id }}"
                        >{{ $stream->title }}</option>
                    @endforeach
                </x-select>
                @error('session_stream_id')
                <span class="text-red-600">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="my-2">
                <x-label for="description" :value="__('Description')"/>
                <x-textarea id="description" class="block mt-1 w-full" name="description"
                            required autofocus>
                    {{ old('description', optional($session)->description) }}
                </x-textarea>
                @error('description')
                <span class="text-red-600">
                    {{ $message }}
                </span>
                @enderror
            </div>
            @isset($session)
                <div class="my-2">
                    <x-label for="zoom_meeting_id" :value="__('Zoom Meeting ID')"/>
                    <x-input id="zoom_meeting_id" class="block mt-1 w-full" min="0" type="number" name="zoom_meeting_id"
                             :value="old('zoom_meeting_id', optional($session)->zoom_meeting_id)" autofocus/>
                    @error('zoom_meeting_id')
                    <span>
                    {{ $message }}
                </span>
                    @enderror
                </div>
            @endisset
            <div class="my-2">
                <x-label for="start" :value="__('Start time')"/>
                <x-input id="start" class="block mt-1 w-full" type="datetime-local"
                         value="{{ old('start', optional(optional($session)->start)->format('Y-m-d\TH:i')) }}"
                         name="start"/>
                @error('start')
                <span class="text-red-600">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="my-2">
                <x-label for="end" :value="__('End time')"/>
                <x-input id="end" class="block mt-1 w-full" type="datetime-local"
                         value="{{ old('end', optional(optional($session)->end)->format('Y-m-d\TH:i')) }}" name="end"/>
                @error('end')
                <span class="text-red-600">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="flex flex-row justify-between mt-4">
                <div class="block mt-4">
                    <label for="is_published" class="inline-flex items-center">
                        <input id="is_published" type="checkbox"
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                               name="is_published"
                               @if(old('is_published') || optional($session)->is_published)
                               checked="checked"
                            @endif
                        >
                        <span class="ml-2 text-sm text-gray-600">{{ __('Published') }}</span>
                    </label>

                    @error('is_published')
                    <span class="text-red-600">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                @if(!isset($session))
                    <div class="block mt-4">
                        <label for="create_meeting" class="inline-flex items-center">
                            <input id="create_meeting" type="checkbox"
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                   name="create_meeting"
                                   @if(old('create_meeting'))
                                   checked="checked"
                                @endif
                            >
                            <span class="ml-2 text-sm text-gray-600">{{ __('Create a zoom meeting?') }}</span>
                        </label>

                        @error('create_meeting')
                        <span class="text-red-600">
                        {{ $message }}
                    </span>
                        @enderror
                    </div>
                @endif
                <x-button type="submit">
                    Save
                </x-button>
            </div>
        </div>
    </form>
</x-admin-layout>
