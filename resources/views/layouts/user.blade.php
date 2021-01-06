<x-app-layout>
    <div class="w-5/6 flex mx-auto flex-col md:flex-row">
        <div class=" md:w-1/4 flex flex-col">
            <span class="block text-lg text-semibold mb-7">
                &nbsp;
            </span>
            @include('user.sidebar')
        </div>
        <div class="w-11/12 md:w-3/4 flex flex-col my-8 md:my-0">
            <div class="flex flex-col md:flex-row justify-between mb-4">
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
