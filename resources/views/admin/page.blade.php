<x-app-layout>
    <div class="w-3/4 flex mx-auto">
        <div class="w-1/4">
            <span class="text-lg text-semibold mb-4">
                &nbsp;
            </span>
            @include('admin.sidebar')
        </div>
        <div class="w-3/4 flex flex-col">
            <span class="text-lg text-semibold mb-4">
                {{ $title }}
            </span>
            {{ $slot }}
        </div>
    </div>
</x-app-layout>
