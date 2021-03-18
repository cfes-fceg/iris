<div class="bg-white rounded overflow-hidden shadow-lg mx-4">
    <div class="text-center pt-4 pb-2 px-6">
        <p class="pt-2 text-lg">{{ __('Welcome to').' '.config('app.name').',' }}<br/>{{ Auth::user()->name }}</p>
    </div>
    @if(Auth::user()->discord_user_id == null)
        <a href="{{ route('discord') }}" class="block m-3 bg-blue-100 rounded-md">
            <p class="p-2 font-semibold">
                {{ __('Link your Discord account to get important updates and information regarding the conference!') }}
            </p>
        </a>
    @endif
    <div class="border-b border-t">
        <a href="{{ route('sessions') }}" class="px-4 py-2 hover:bg-gray-100 flex">
            <div class="text-gray-800">
                <i class="fas fa-calendar-day"></i>
            </div>
            <div class="pl-3">
                <p class="text-sm font-medium text-gray-800 leading-none">{{ __('Schedule') }}</p>
                <p class="text-xs text-gray-500">{{ __('View upcoming sessions') }}</p>
            </div>
        </a>
        <a href="{{ route('discord') }}" class="px-4 py-2 hover:bg-gray-100 flex">
            <div class="text-gray-800">
                <i class="fab fa-discord"></i>
            </div>
            <div class="pl-3">
                <p class="text-sm font-medium text-gray-800 leading-none">{{ __('Discord') }}</p>
                <p class="text-xs text-gray-500">{{ __('Access the discord for').' '.config('app.name') }}</p>
            </div>
        </a>
        <a href="{{ route('account') }}" class="px-4 py-2 hover:bg-gray-100 flex">
            <div class="text-gray-800">
                <i class="fas fa-user"></i>
            </div>
            <div class="pl-3">
                <p class="text-sm font-medium text-gray-800 leading-none">{{ __('My Profile') }}</p>
                <p class="text-xs text-gray-500">{{ __('Modify my account') }}</p>
            </div>
        </a>
    </div>
</div>
