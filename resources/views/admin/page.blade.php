<x-app-layout>
    <div class="w-3/4 flex mx-auto">
        <div class="w-1/4">
            <span class="text-lg text-semibold mb-4">
                &nbsp;
            </span>
            @include('admin.sidebar')
        </div>
        <div class="w-3/4 flex flex-col">
            <div class="flex flex-row justify-between">
                <span class="text-lg text-semibold mb-4">
                    {{ $title }}
                </span>
                <div>
                    {{ $actions ?? '' }}
                </div>
            </div>
            {{ $slot }}
        </div>
    </div>
</x-app-layout>
