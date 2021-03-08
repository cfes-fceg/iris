<!--Nav-->
<nav id="header" class="w-full z-30 top-0 text-white py-1 lg:py-6">
    <div
        class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-2 lg:py-6"
    >
        <div class="pl-4 flex items-center">
            <a
                class="text-white no-underline hover:no-underline font-bold text-2xl lg:text-4xl"
                href="{{ route('sessions') }}"
            >
                <x-application-logo style="height: 4em;"/>
            </a>
        </div>

        <div class="block lg:hidden pr-4">
            <button
                id="nav-toggle"
                class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-800 hover:border-green-500 appearance-none focus:outline-none"
            >
                <svg
                    class="fill-current h-3 w-3"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <title>{{ __('Menu') }}</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                </svg>
            </button>
        </div>

        <div
            class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 text-black p-4 lg:p-0 z-20"
            id="nav-content"
        >
            <ul class="list-reset lg:flex justify-end flex-1 items-center">
                <li class="mr-3">
                    <a
                        class="inline-block py-2 px-4 no-underline"
                        href="{{ route('setLocale', ["locale" => App::currentLocale() == "en" ? "fr" : "en"]) }}"
                    >
                        @if(App::currentLocale() == "en")
                            {{ __('French', [], 'fr') }}
                        @else
                            English
                        @endif
                    </a>
                </li>
            </ul>

            <!-- Settings Dropdown -->
            @if(Auth::User())
                <div
                    class="mx-auto sm:flex sm:items-center sm:ml-6 gradient2 lg:mx-0 hover:underline text-white rounded mt-4 lg:mt-0 py-4 px-8 shadow">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center hover:border-gray-300 focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('sessions')">
                                {{ __('Conference Dashboard') }}
                            </x-dropdown-link>
                            @if(Auth::user()->is_admin)
                                <x-dropdown-link :href="route('admin.index')">
                                    {{ __('Administration') }}
                                </x-dropdown-link>
                            @endif
                            <hr/>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Logout') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @else
                <a href="{{ route('login') }}"
                   id="navAction"
                   class="mx-auto gradient2 lg:mx-0 hover:underline text-white rounded mt-4 lg:mt-0 py-4 px-8 shadow"
                >
                    {{ __('Login') }}
                </a>
            @endif
        </div>
    </div>
</nav>
