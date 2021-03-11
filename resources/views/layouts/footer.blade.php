<!--Footer-->
<footer class="w-full flex flex-col md:flex-row py-6 mx-auto justify-around bg-white">

{{-- Principaux --}}

    

{{-- App Block    --}}
    <div class="flex flex-row items-center font-semibold">
        <span class="mt-2 inline-block font-light text-gray-800">
            &copy; {{ \Carbon\Carbon::now()->year }} {{ __('Canadian Federation of Engineering Students') }}
        </span>
        <a class="text-orange-600 mx-3 no-underline hover:no-underline font-bold text-2xl lg:text-4xl"
           href="/">
            <x-application-logo style="height: 2em;"/>
        </a>
        <span class="mt-2 inline-block font-light text-gray-800">
            {{ __('Designed & built by Alex Stojda') }}
        </span>
    </div>

</footer>
