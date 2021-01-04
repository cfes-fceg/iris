<x-app-layout>
    <div class="w-5/6 flex mx-auto">
        <div class="w-1/4 flex flex-col">
            <span class="block text-lg text-semibold mb-7">
                &nbsp;
            </span>
            @include('user.sidebar')
        </div>
        <div class="w-3/4 flex flex-col">
            <div class="flex flex-row justify-between mb-4">
                <span class="text-lg text-semibold">
                    @isset($title)
                        {{ $title }}
                    @else
                        &nbsp;
                    @endif
                </span>
                <div>
                    {{ $actions ?? '' }}
                </div>
            </div>
            {{ $slot }}
        </div>
    </div>
</x-app-layout>
