<x-app-layout>
    <div class="w-5/6 flex mx-auto">
        <div class="w-1/6">
            <span class="text-lg text-semibold mb-4">
                &nbsp;
            </span>
            @include('admin.sidebar')
        </div>
        <div class="w-5/6 flex flex-col">
            <div class="flex flex-row justify-between">
                <span class="text-lg text-bold mb-4">
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
