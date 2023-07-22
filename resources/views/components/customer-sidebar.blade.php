<aside
    x-data="{
         sidebarIsVisible: true,
         toggleSidebar: function() {
            this.sidebarIsVisible = !this.sidebarIsVisible;
         }
    }" class="w-full h-fit lg:w-1/4 !mt-3 space-y-2 px-6 py-4 rounded-md z-depth-1 lg:block hidden">
    <div class="flex w-full justify-between">
        <h2 class="text-2xl md:text-3xl tracking-widest font-normal truncate">{{ __('Meniu') }}</h2>
        <div>
            <button
                @click="toggleSidebar"
                :class="(sidebarIsVisible ? 'text-amber-400' : '')"
            >
                <svg
                    x-show="!sidebarIsVisible"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    class="h-5 w-5"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
                <svg
                    x-show="sidebarIsVisible"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    class="h-5 w-5"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                </svg>
            </button>
        </div>
    </div>
    <nav x-show="sidebarIsVisible" class="space-y-1" x-cloak>
        <a class="sidebar-tab-item" href="{{ route('customer.profile') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-4 h-4 w-4 text-[#24455C]">
                <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z"></path>
            </svg> {{ __('Mano paskyra') }}</a>
        <a class="sidebar-tab-item" href="{{ route('customer.profile.settings') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-4 w-4 h-4 text-[#24455C]">
                <path fill-rule="evenodd" d="M8.34 1.804A1 1 0 019.32 1h1.36a1 1 0 01.98.804l.295 1.473c.497.144.971.342 1.416.587l1.25-.834a1 1 0 011.262.125l.962.962a1 1 0 01.125 1.262l-.834 1.25c.245.445.443.919.587 1.416l1.473.294a1 1 0 01.804.98v1.361a1 1 0 01-.804.98l-1.473.295a6.95 6.95 0 01-.587 1.416l.834 1.25a1 1 0 01-.125 1.262l-.962.962a1 1 0 01-1.262.125l-1.25-.834a6.953 6.953 0 01-1.416.587l-.294 1.473a1 1 0 01-.98.804H9.32a1 1 0 01-.98-.804l-.295-1.473a6.957 6.957 0 01-1.416-.587l-1.25.834a1 1 0 01-1.262-.125l-.962-.962a1 1 0 01-.125-1.262l.834-1.25a6.957 6.957 0 01-.587-1.416l-1.473-.294A1 1 0 011 10.68V9.32a1 1 0 01.804-.98l1.473-.295c.144-.497.342-.971.587-1.416l-.834-1.25a1 1 0 01.125-1.262l.962-.962A1 1 0 015.38 3.03l1.25.834a6.957 6.957 0 011.416-.587l.294-1.473zM13 10a3 3 0 11-6 0 3 3 0 016 0z" clip-rule="evenodd"></path>
            </svg> {{ __('Paskyros nustatymai') }}
        </a>
    </nav>
</aside>
