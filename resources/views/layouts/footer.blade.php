<!--Footer-->
<footer class="bg-white ">
    <div class="container mx-auto mt-8 px-8">
        <div class="w-3/4 flex flex-col md:flex-row py-6 mx-auto justify-between">
            <div class="flex flex-row items-center font-semibold mx-auto">
                <span class="mt-2 inline-block font-light text-gray-800">
                    &copy; {{ \Carbon\Carbon::now()->year }} {{ __('Canadian Federation of Engineering Students') }}
                </span>
                <a
                    class="text-orange-600 mx-3 no-underline hover:no-underline font-bold text-2xl lg:text-4xl"
                    href="/"
                >
                    <img src="{{ URL::asset('/image/celc2021.png') }}" alt="CELC 2021 Logo" style="width: 1.5em; margin-top: 0.25em;"/>
                </a>
                <span class="mt-2 inline-block font-light text-gray-800">
                    {{ __('Designed & built by Alex Stojda') }}
                </span>
            </div>
        </div>
    </div>
</footer>
