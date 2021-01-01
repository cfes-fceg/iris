<x-app-layout>
    <div class="w-3/4 flex mx-auto">
        <div class="w-1/4">
            @include('admin.sidebar')
        </div>
        <div class="w-3/4">
            {{ $slot }}
        </div>
    </div>
</x-app-layout>
