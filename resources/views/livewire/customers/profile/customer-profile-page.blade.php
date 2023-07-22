<div>
    <div class="flex min-w-screen-xl justify-center">
        <div class="mb-32 mt-8 w-full max-w-screen-xl px-3 md:px-12 text-[#24455C]">
            @include('partials.loaders.loader-spin')

            <div class="customer-background flex-col lg:flex-row lg:space-x-10 space-y-10 lg:space-y-0 hidden">
                <x-customer-sidebar/>

                <div x-data="{
                        profileSettingsIsVisible: true,
                        toggleProfileSettings: function() {
                            this.profileSettingsIsVisible = !this.profileSettingsIsVisible;
                        }
                    }"
                     class="w-full lg:w-5/6 !mt-3">
                    <div class="rounded-md px-6 py-4 text-sm bg-white z-depth-1">
                        <div :class="(profileSettingsIsVisible ? '!justify-end' : '')" class="flex w-full justify-between">
                            <h2 x-show="!profileSettingsIsVisible" class="text-2xl md:text-3xl tracking-wide font-normal truncate">
                                {{ __('Mano paskyra') }}
                            </h2>
                            <div>
                                <button
                                    @click="toggleProfileSettings"
                                    :class="(profileSettingsIsVisible ? 'text-amber-400' : '')"
                                >
                                    <svg
                                        x-show="!profileSettingsIsVisible"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        class="h-5 w-5"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                    <svg
                                        x-show="profileSettingsIsVisible"
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
                        <div x-show="profileSettingsIsVisible" x-cloak>
                            <div class="flex flex-col lg:flex-row justify-start">
                                <div class="flex justify-center items-center mb-6">
                                    <div class="relative w-[125px] h-[140px] bg-[#d9dee8] bg-no-repeat bg-cover rounded-xl overflow-hidden bg-center" style="background-image: url('https://lh3.googleusercontent.com/a/AAcHTtd7GIlH4iKlD9SJy-z3lWmGpsVwKcjLn-Z5MPcviNIFkgM=s96-c');">
                                        <div class="absolute bottom-0 left-0 right-0">
                                            <button class="relative w-full py-[7px] px-[25px] text-white bg-amber-400 hover:bg-opacity-75 transition-all">{{ __('Įkelti') }}</button>
                                            <a class="w-13 h-13 bg-center bg-no-repeat absolute top-1/2 transform -translate-y-1/2 right-0.5 transition duration-200 p-2.5" href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6 text-white">
                                                    <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full pl-0 lg:pl-4 pr-0 lg:pr-0">
                                    <div class="flex items-center justify-between">
                                        <div class="text-2xl md:text-2xl tracking-wide font-normal truncate">
                                            {{ $customer->getIndividualFullName() }}
                                        </div>
                                        <a class="flex items-center bg-amber-400 text-white hover:bg-amber-500 rounded-md py-2 px-3 transition-all" href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 mr-0 lg:mr-1">
                                                <path d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z"/>
                                                <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z"/>
                                            </svg>
                                            <span class="lg:block hidden">{{ __('Redaguoti') }}</span>
                                        </a>
                                    </div>
                                    <div class="flex items-center text-lg md:text-lg tracking-wide font-normal truncate">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-1">
                                            <path d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z"/>
                                            <path d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z"/>
                                        </svg>
                                        {{ $customer->getEmailAddress() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
