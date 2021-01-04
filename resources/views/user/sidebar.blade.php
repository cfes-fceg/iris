<div class="bg-white rounded overflow-hidden shadow-lg mx-4">
    <div class="text-center p-6  border-b">
        <p class="pt-2 text-lg font-semibold">Randy Robertson</p>
        <p class="text-sm text-gray-600">randy.robertson@example.com</p>
        <div class="mt-5">
            <a
                href="#"
                class="border rounded-full py-2 px-4 text-xs font-semibold text-gray-700"
            >
                Manage your Account
            </a>
        </div>
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
                <p class="text-xs text-gray-500">{{ __('Access the CELC 2021 discord') }}</p>
            </div>
        </a>
    </div>

    <div class="">
{{--        <a href="#" class="px-4 py-4 hover:bg-gray-100 flex">--}}
{{--            <p class="text-sm font-medium text-gray-800 leading-none">{{ __('Logout') }}</p>--}}
{{--        </a>--}}
    </div>
</div>
