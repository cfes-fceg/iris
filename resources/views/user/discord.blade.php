<x-user-layout>
    <style>
        .circle {
            border-radius: 50%;
        }
    </style>
    <div class="flex flex-row items-center justify-around">
        <div class="flex flex-col items-center bg-white rounded-md p-5 text-xl shadow-lg w-1/2">
            @isset(Auth::user()->discord_user_id)
                <div class="flex flex-row items-center justify-between w-full">
                    <div class="flex flex-col items-center w-full">
                        <span class="block mt-2">{{ __('Discord account linked!') }}</span>
                    </div>
                </div>
            @else
                <h3 class="font-extrabold text-blue-900">
                    {{__('How to access the CELC 2021 Discord channels:')}}
                </h3>
                <div class="flex flex-row items-center justify-between w-full">
                    <span class="circle w-9 p-0.5 font-bold h-8 text-white gradient2 text-center">
                        1
                    </span>
                    <span class="m-2 w-full flex flex-col items-center">
                        <span class="m-2">
                            {!!  __('Join the server, if you have not already done so:') !!}
                        </span>
                        <x-btn-link-primary href="{{ route('discord.invite') }}">
                            {{__('Join the CFES Discord Server')}}
                        </x-btn-link-primary>
                    </span>
                </div>
                <div class="flex flex-row items-center justify-between w-full">
                    <span class="circle w-9 p-0.5 font-bold h-8 text-white gradient2 text-center">
                        2
                    </span>
                    <div class="flex flex-col items-center">
                        <span class="m-2">
                            {!!  __('Enter the following command into the chat bar of the <strong>#bot-spam</strong> channel:') !!}
                        </span>
                        <div class="w-3/4 rounded bg-gray-600 p-2 flex flex-row items-center text-gray-300">
                            <pre
                                class="text-sm w-full text-center font-bold px-2">/celc register {{ Auth::user()->discord_registration_id }}</pre>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
    </div>
</x-user-layout>
