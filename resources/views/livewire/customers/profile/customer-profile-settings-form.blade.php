<div>
    <div class="flex gap-4 gap-y-2 text-sm flex-col lg:flex-row py-4">
        <div class="lg:flex-grow lg:flex lg:flex-col">
            <div x-data="{
                        passwordIsShow: true,
                        toggleShowPassword: function() {
                            this.passwordIsShow = !this.passwordIsShow;
                        }
                    }" class="flex flex-wrap gap-4 gap-y-2 text-sm">

                <div class="w-full mb-4 pl-0 lg:pl-4">
                    <input :type="passwordIsShow ? 'password' : 'text'" name="full_name" id="full_name" class="h-10 border-none rounded-md px-4 w-full bg-gray-200 focus:outline-none focus:ring-0 placeholder-gray-400" value=""
                           placeholder="{{ __('Dabartinis slaptažodis') }}"/>
                </div>

                <div class="w-full flex flex-wrap">
                    <div class="w-full md:w-full lg:w-1/2 mb-6 px-0 lg:px-4">
                        <input :type="passwordIsShow ? 'password' : 'text'" name="city" id="city" class="h-10 border-none rounded-md px-4 w-full bg-gray-200 focus:outline-none focus:ring-0 placeholder-gray-400"
                               placeholder="{{ __('Naujas slaptažodis') }}"
                        />
                    </div>

                    <div class="w-full md:w-full lg:w-1/2 mb-4">
                        <div class="h-10 bg-gray-50 flex border border-gray-200 rounded-md items-center box-border">
                            <input :type="passwordIsShow ? 'password' : 'text'" name="city" id="city" class="h-10 border-none mt-1 rounded-md px-4 w-full bg-gray-200 focus:outline-none focus:ring-0 placeholder-gray-400"
                                   placeholder="{{ __('Pakartokite slaptažodį') }}"
                            />
                        </div>
                    </div>
                </div>

                <div class="w-full text-center">
                    <div class="inline-flex items-center">
                        <button class="bg-amber-200 hover:bg-amber-300 text-[#24455C] py-1.5 px-8 mr-2 rounded transition-all">
                            {{ __('Išsaugoti') }}
                        </button>
                        <button class="bg-gray-300 hover:bg-gray-200 text-[#24455C] py-2 px-2 rounded transition-all" :class="{'!bg-amber-200':!passwordIsShow }">
                            <svg class="h-4 text-gray-400 hidden" fill="none" @click="toggleShowPassword" :class="{'hidden': !passwordIsShow, 'block':!passwordIsShow }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                <path fill="currentColor" d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                </path>
                            </svg>

                            <svg class="h-4 text-gray-400 block" fill="none" @click="toggleShowPassword" :class="{'block': !passwordIsShow, 'hidden':passwordIsShow }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path fill="currentColor" d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
