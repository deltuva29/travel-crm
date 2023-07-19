<header>
    <nav
        class="
          flex flex-wrap
          items-center
          justify-between
          w-full
          py-4
          md:py-4
          px-7
          text-lg text-gray-700
          bg-transparent
          shadow-lg
        "
    >
        <div>
            <a class="flex items-center text-2xl text-gray-700 tracking-wide ml-2 font-semibold" href="{{ route('home') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <svg
            xmlns="http://www.w3.org/2000/svg"
            id="menu-button"
            class="h-6 w-6 cursor-pointer md:hidden block"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
            />
        </svg>

        <div class="hidden w-full md:flex md:items-center md:w-auto" id="menu">
            <ul
                class="
              pt-4
              text-base text-gray-700
              md:flex
              md:justify-between
              md:pt-0"
            >
                <li>
                    <a
                        class="px-4 py-1 mx-2 block text-sm bg-gray-300 hover:bg-gray-200 text-gray-700 rounded-md transition-all"
                        href="#"
                    >{{ __('Mano paskyra') }}</a
                    >
                </li>
            </ul>

            <div x-data="{ dropdownOpen: false }" class="relative">
                <button @click="dropdownOpen = !dropdownOpen" class="relative z-10 block rounded-md bg-white p-2 focus:outline-none">
                    <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                        <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                    </svg>
                </button>

                <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

                <div
                    x-show="dropdownOpen"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-95"
                    class="absolute right-0 mt-2 pt-2 w-44 bg-white rounded-md text-center shadow-xl z-20" style="box-shadow: 0 3px 6px 0 rgba(0,0,0,.2);"
                >
                    <a href="#" class="block px-4 py-2 mx-1 text-xs rounded-md text-gray-700 bg-gray-300 hover:bg-gray-200 transition-all">
                        {{ __('Paskyros nustatymai') }}
                    </a>
                    @auth('customer')
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:text-gray-500 transition-all">
                            {{ __('Atsijungti') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>
