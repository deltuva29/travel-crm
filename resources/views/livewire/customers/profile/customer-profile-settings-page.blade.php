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
                        <div class="flex w-full justify-between">
                            <h2 class="text-2xl md:text-3xl tracking-wide font-normal truncate">
                                {{ $headingTitle }}
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
                            @livewire('customers.profile.customer-profile-settings-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

