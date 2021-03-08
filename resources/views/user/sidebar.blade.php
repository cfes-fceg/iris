<div class="bg-white rounded overflow-hidden shadow-lg mx-4">
    <div class="text-center p-6  border-b">
        <p class="pt-2 text-lg">{{ __('Welcome to CSE 2021,') }}<br/>{{ Auth::user()->name }}</p>
    </div>
    <div class="border-b">
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
                <p class="text-xs text-gray-500">{{ __('Access the CSE 2021 discord') }}</p>
            </div>
        </a>
{{--        <a href="{{ route('links') }}" class="px-4 py-2 hover:bg-gray-100 flex">--}}
{{--            <div class="text-gray-800">--}}
{{--                <i class="fas fa-folder"></i>--}}
{{--            </div>--}}
{{--            <div class="pl-3">--}}
{{--                <p class="text-sm font-medium text-gray-800 leading-none">{{ __('Resources') }}</p>--}}
{{--                <p class="text-xs text-gray-500">{{ __('Conference Resources') }}</p>--}}
{{--            </div>--}}
{{--        </a>--}}
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

    <div class="">
        {{--        <a href="#" class="px-4 py-4 hover:bg-gray-100 flex">--}}
        {{--            <p class="text-sm font-medium text-gray-800 leading-none">{{ __('Logout') }}</p>--}}
        {{--        </a>--}}
    </div>
</div>
