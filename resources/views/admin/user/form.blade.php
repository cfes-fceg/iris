<form method="post"
      action="{{ $action }}">
    @csrf
    @method($method)
    <div class="bg-white rounded overflow-hidden shadow-lg p-4">
        <div class="mb-2">
            <x-label for="name" :value="__('Name')"/>
            <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                     :value="old('name', optional($user)->name)"
            />
            @error('name')
            <span>
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="my-2">
            <x-label for="email" :value="__('Email')"/>
            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                     :value="old('email', optional($user)->email)"/>
            @error('email')
            <span>
                    {{ $message }}
                </span>
            @enderror
        </div>
        {{--<div class="my-2">
            <x-label for="password" :value="__('Password')"/>
            <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                     :value="old('password', optional($user)->password)"/>
            @error('password')
            <span>
                    {{ $message }}
                </span>
            @enderror
        </div>
        @if(!Auth::user()->is_admin)
            <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('Confirm Password')"/>

                    <x-input id="password_confirmation" class="block mt-1 w-full"
                             type="password"
                             :value="empty(old('password')) ? optional($user)->password : ''"
                             name="password_confirmation" required/>
                </div>
        @endif--}}
        <!-- Discord -->
        @if(isset($user) && Auth::user()->is_admin)
            <div class="mb-2">
                <x-label for="discord_registration_id" :value="__('Discord registration id')"/>
                <x-input id="discord_registration_id" class="block mt-1 w-full" type="text"
                         :value="optional($user)->discord_registration_id"
                         disabled/>
                @error('discord_registration_id')
                <span>
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-2">
                <x-label for="discord_user_id" :value="__('Discord user id')"/>
                <x-input id="discord_user_id" class="block mt-1 w-full" type="text" name="discord_user_id"
                         :value="optional($user)->discord_user_id"
                />
                @error('discord_user_id')
                <span>
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-2">
                <x-label for="snl_id" :value="__('SNL Group Number')"/>
                <x-input id="snl_id" class="block mt-1 w-full" type="number" name="snl_id"
                         :value="old('snl_id', optional($user)->snl_id)"
                />
                @error('snl_id')
                <span>
                    {{ $message }}
                </span>
                @enderror
            </div>
        @endif
        <div class="mb-2">
            <x-label for="language" :value="__('Language')"/>
            <x-select id="language" class="block mt-1 w-full" type="text" name="language"
            >
                <option value="en"
                        @if(old('language', optional($user)->language) == "en")
                        selected
                    @endif>
                    {{ __('English') }}
                </option>
                <option value="fr"
                        @if(old('language', optional($user)->language) == "fr")
                        selected
                    @endif>
                    {{ __('French') }}
                </option>
            </x-select>
            @error('language')
            <span>
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="mb-2">
            <x-label for="school" :value="__('School/Organization')"/>
            <x-input id="school" class="block mt-1 w-full" type="text" name="school"
                     :value="old('school', optional($user)->school)"
            />
            @error('school')
            <span>
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="mb-2">
            <x-label for="engsoc_pos" :value="__('EngSoc Position')"/>
            <x-input id="engsoc_pos" class="block mt-1 w-full" type="text" name="engsoc_pos"
                     :value="old('engsoc_pos', optional($user)->engsoc_pos)"/>
            @error('engsoc_pos')
            <span>
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="mb-2">
            <x-label for="program" :value="__('University Program')"/>
            <x-input id="program" class="block mt-1 w-full" type="text" name="program"
                     :value="old('program', optional($user)->program)"/>
            @error('program')
            <span>
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="mb-2">
            <x-label for="linkedin" :value="__('LinkedIn Username')"/>
            <x-input id="linkedin" class="block mt-1 w-full" type="text" name="linkedin"
                     :value="old('linkedin', optional($user)->linkedin)"/>
            @error('linkedin')
            <span>
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="flex flex-row justify-between mt-4">
            <div>
                @if(Auth::user()->is_admin)
                    <label for="is_admin" class="inline-flex items-center mr-8">
                        <input id="is_admin" type="checkbox"
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                               name="is_admin"
                               @if(old('is_admin') || optional($user)->is_admin)
                               checked="checked"
                            @endif
                        >
                        <span class="ml-2 text-sm text-gray-600">{{ __('Is admin?') }}</span>
                    </label>
                    <label for="is_active" class="inline-flex items-center mr-8">
                        <input id="is_active" type="checkbox"
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                               name="is_active"
                               @if(old('is_active') || optional($user)->is_active)
                               checked="checked"
                               @endif
                               @if(!isset($user))
                               checked="checked"
                            @endif
                        >
                        <span class="ml-2 text-sm text-gray-600">{{ __('Is active?') }}</span>
                    </label>
                @endif
            </div>
            <x-button type="submit">
                Save
            </x-button>
        </div>
    </div>
</form>
