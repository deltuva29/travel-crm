<div>
    <div class="flex gap-4 gap-y-2 text-sm flex-col lg:flex-row py-4">
        <div class="lg:flex-grow lg:flex lg:flex-col lg:pl-2"
             @if ($updatePassword)
                 wire:poll.3s="redirectAfterFiveSeconds"
            @endif>
            <form wire:submit.prevent="updateSettings">
                <div x-data="{
                        passwordIsShow: true,
                        toggleShowPassword: function() {
                            this.passwordIsShow = !this.passwordIsShow;
                        }
                    }" class="flex flex-wrap gap-4 gap-y-2 text-sm"
                     wire:poll.keep-alive>

                    <div class="w-full mb-4 pl-0 lg:pl-0">
                        <input wire:model.defer="current_password" :type="passwordIsShow ? 'password' : 'text'" name="current_password" id="current_password" class="h-10 border-none rounded-md px-4 w-full bg-gray-200 focus:outline-none focus:ring-0 placeholder-gray-400" value=""
                               placeholder="{{ __('Dabartinis slaptažodis') }}"/>
                    </div>

                    <div class="w-full flex flex-wrap">
                        <div class="w-full md:w-full lg:w-1/2 mb-6 px-0 lg:!pr-10">
                            <input wire:model.defer="password" :type="passwordIsShow ? 'password' : 'text'" name="password" id="password" class="h-10 border-none rounded-md px-4 w-full bg-gray-200 focus:outline-none focus:ring-0 placeholder-gray-400"
                                   placeholder="{{ __('Naujas slaptažodis') }}"
                            />
                        </div>

                        <div class="w-full md:w-full lg:w-1/2 mb-4">
                            <div class="h-10 bg-gray-50 flex border border-gray-200 rounded-md items-center box-border">
                                <input wire:model.defer="password_confirmation" :type="passwordIsShow ? 'password' : 'text'" name="password_confirmation" id="password_confirmation" class="h-10 border-none mt-1 rounded-md px-4 w-full bg-gray-200 focus:outline-none focus:ring-0 placeholder-gray-400"
                                       placeholder="{{ __('Pakartokite slaptažodį') }}"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="w-full text-center">
                        <div class="inline-flex items-center">
                            <button type="submit" class="text-white py-1.5 px-8 mr-2 rounded transition-all
                            {{ $isDisabled ? 'text-white bg-gray-400/70 hover:bg-gray-300/100' : 'bg-amber-400 hover:bg-amber-400/75' }}"
                                {{ $isDisabled ? 'disabled' : ''}}>
                            <span wire:loading.remove wire:target="updateSettings" class="text-sm">
                                    {{ __('Išsaugoti') }}
                                </span>
                                <span wire:loading wire:target="updateSettings" class="flex items-center space-x-2 text-sm">
                                    <svg aria-hidden="true" class="inline w-4 h-4 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#FDE68A"/>
                                    </svg>
                                    <span>{{ __('Išsaugoma...') }}</span>
                                </span>
                            </button>
                            <div class="bg-gray-200 hover:bg-gray-300 text-[#24455C] py-2 px-2 rounded cursor-pointer transition-all" :class="{'!bg-amber-400 !text-white':!passwordIsShow }">
                                <svg class="h-4 text-gray-400 hidden" fill="none" @click="toggleShowPassword" :class="{'hidden': !passwordIsShow, 'block':!passwordIsShow }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                    <path fill="currentColor" d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                    </path>
                                </svg>

                                <svg class="h-4 text-gray-400 block" fill="none" @click="toggleShowPassword" :class="{'block text-white': !passwordIsShow, 'hidden':passwordIsShow }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path fill="currentColor" d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
