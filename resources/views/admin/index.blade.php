<x-admin-layout title="Home">
    <div class="flex flex-col md:flex-row">
        <div class="bg-white rounded overflow-hidden shadow-lg p-4 m-2">
            <div class="text-2xl">
                {{ \App\Models\User::where('is_active', '=', true)->count() }} /
                {{ \App\Models\User::count() }}
            </div>
            <div class="text-md">
                Activated Users
            </div>
        </div>
        <div class="bg-white rounded overflow-hidden shadow-lg p-4 m-2">
            <div class="text-2xl">
                {{ \App\Models\User::whereNotNull('discord_user_id')->count() }} /
                {{ \App\Models\User::count() }}
            </div>
            <div class="text-md">
                Users linked to discord
            </div>
        </div>
    </div>
</x-admin-layout>
