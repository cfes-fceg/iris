<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="h-20 fill-current text-gray-500"/>
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>

        <form
            method="POST"
            action="{{ route('register.confirm') }}"
        >
        @csrf
            <input type="hidden" name="recaptcha_token" id="recaptcha_token">
            @if($errors->has('recaptcha_token'))
                <div class="p-2 text-red-600">
                    {{$errors->first('recaptcha_token')}}
                </div>
            @endif

        <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')"/>

                <x-input id="email" class="block mt-1 w-full" type="email" disabled
                         :value="Session::get('authorized_email')[0]" required/>
            </div>

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')"/>

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                         autofocus/>
            </div>


            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')"/>

                <x-input id="password" class="block mt-1 w-full"
                         type="password"
                         name="password"
                         required autocomplete="new-password"/>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')"/>

                <x-input id="password_confirmation" class="block mt-1 w-full"
                         type="password"
                         name="password_confirmation" required/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
    <x-slot name="bodyEnd">
        <script src="https://www.google.com/recaptcha/api.js?render={{ config('app.recaptcha.key') }}"></script>
        <script>
            grecaptcha.ready(function () {
                grecaptcha.execute('{{ config('app.recaptcha.key')  }}').then(function (token) {
                    document.getElementById("recaptcha_token").value = token;
                });
            });
        </script>
    </x-slot>
</x-guest-layout>
