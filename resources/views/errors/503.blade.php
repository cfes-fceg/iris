<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
        <p>{{ config('app.maintenance_msg') }}</p>
    </x-auth-card>
</x-guest-layout>
