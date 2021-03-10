@props(['title'])

<div x-data="{'showModal': false}">

    <div @click="showModal = true">
        {{ $trigger }}
    </div>

    <!--Overlay-->
    <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="showModal"
         :class="{ 'fixed inset-0 z-10 flex items-center justify-center': showModal }">
        <!--Dialog-->
        <div class="bg-white w=3/4 md:w-1/2 mx-auto rounded shadow-lg py-4 text-left px-6" x-show="showModal"
             @click.away="showModal = false" x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">

            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">{{ $title }}</p>
                <!-- "x" -->
                <div class="cursor-pointer z-50" @click="showModal = false">
                    <span class="fas fa-times fa-2x"></span>
                </div>
            </div>

            <!-- content -->
            {{ $slot }}
        </div>
        <!--/Dialog -->
    </div><!-- /Overlay -->

</div>
