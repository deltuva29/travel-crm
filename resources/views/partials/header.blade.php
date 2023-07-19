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
                        class="px-4 py-2 mx-4 block text-sm bg-gray-300 hover:bg-gray-200 text-gray-700 rounded-md transition-all"
                        href="#"
                    >{{ __('Mano paskyra') }}</a
                    >
                </li>
            </ul>

            <button id="dropdownMenuIconHorizontalButton" data-dropdown-toggle="dropdownDotsHorizontal" class="inline-flex items-center px-4 py-1 text-sm font-medium text-center text-gray-900 bg-gray-300 hover:bg-gray-200 rounded-md focus:shadow-none focus:outline-none transition-all" type="button">
                <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                    <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                </svg>
            </button>

            <div id="dropdownDotsHorizontal" class="z-10 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow-md w-44">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconHorizontalButton">
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                    </li>
                </ul>
                <div class="py-2">
                    @auth('customer')
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
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
