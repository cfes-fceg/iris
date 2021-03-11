<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="h-20 fill-current text-gray-500"/>
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')"/>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="hidden" name="recaptcha_token" id="recaptcha_token">
            @if($errors->has('recaptcha_token'))
                <div class="p-2 text-red-600">
                    {{$errors->first('recaptcha_token')}}
                </div>
            @endif
            <div class="mb-2">
                <p>
                    {{ __('Enter the email you provided when registering for the conference.') }}
                </p>
            </div>

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')"/>

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                         autofocus/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    {{ __('Validate') }}
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
