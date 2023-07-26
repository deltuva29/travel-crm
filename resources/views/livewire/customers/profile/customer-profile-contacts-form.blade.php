@php use App\Enums\CustomerType; @endphp
<div>
    <div class="flex gap-4 gap-y-2 text-sm flex-col lg:flex-row py-4">
        <div class="lg:flex-grow lg:flex lg:flex-col lg:pl-2">
            <x-tailwind-form wire:submit.prevent="editContacts">
                @bind($customer)
                <div class="flex flex-wrap gap-4 gap-y-2 text-md"
                     wire:poll.keep-alive>

                    @switch($customer->getType())
                        @case(CustomerType::PARTICIPANT)
                            <div class="w-full flex flex-wrap">
                                <div class="w-full flex flex-col md:w-full lg:w-1/2 px-0 lg:!pr-10">
                                    <x-tailwind-form-input
                                        class="h-10 border-none rounded-md px-4 w-full bg-gray-200 focus:outline-none focus:ring-0 placeholder-gray-400"
                                        wire:model="form.participant.first_name"
                                        name="first_name"
                                        placeholder="{{ __('Tavo vardas') }}"/>

                                    <x-tailwind-form-errors
                                        class="text-red-400 text-xs not-italic"
                                        name="form.participant.first_name"/>
                                </div>

                                <div class="w-full md:w-full lg:w-1/2">
                                    <div class="h-10 border-none flex flex-col border border-gray-200 rounded-md">
                                        <x-tailwind-form-input
                                            class="h-10 border-none rounded-md px-4 w-full bg-gray-200 focus:outline-none focus:ring-0 placeholder-gray-400"
                                            wire:model="form.participant.last_name"
                                            name="last_name"
                                            placeholder="{{ __('Tavo pavardė') }}"/>

                                        <x-tailwind-form-errors
                                            class="text-red-400 text-xs not-italic"
                                            name="form.participant.last_name"/>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full flex flex-wrap">
                                <div class="w-full md:w-full lg:w-1/2 px-0 lg:!pr-10">
                                    <x-tailwind-form-input
                                        class="h-10 border-none rounded-md px-4 w-full bg-gray-200 focus:outline-none focus:ring-0 placeholder-gray-400"
                                        name="email"
                                        placeholder="{{ __('Tavo el.paštas') }}" disabled/>

                                    <x-tailwind-form-errors
                                        class="text-red-400 text-xs not-italic"
                                        name="form.participant.email"/>
                                </div>

                                <div class="w-full md:w-full lg:w-1/2">
                                    <div class="h-10 border-none flex flex-col border border-gray-200 rounded-md">
                                        <x-tailwind-form-input
                                            class="h-10 border-none rounded-md px-4 w-full bg-gray-200 focus:outline-none focus:ring-0 placeholder-gray-400"
                                            wire:model="form.participant.phone_number"
                                            name="phone_number"
                                            placeholder="{{ __('Tavo tel. Numeris') }}"/>

                                        <x-tailwind-form-errors
                                            class="text-red-400 text-xs not-italic"
                                            name="form.participant.phone_number"/>
                                    </div>
                                </div>
                            </div>
                            @break
                        @case(CustomerType::RENTER)
                            <div class="w-full flex flex-wrap">
                                <div class="w-full flex flex-col md:w-full lg:w-1/2 px-0 lg:!pr-10">
                                    <x-tailwind-form-input
                                        class="h-10 border-none rounded-md px-4 w-full bg-gray-200 focus:outline-none focus:ring-0 placeholder-gray-400"
                                        wire:model="form.renter.first_name"
                                        name="first_name"
                                        placeholder="{{ __('Tavo vardas') }}"/>

                                    <x-tailwind-form-errors
                                        class="text-red-400 text-xs not-italic"
                                        name="form.renter.first_name"/>
                                </div>

                                <div class="w-full md:w-full lg:w-1/2">
                                    <div class="h-10 border-none flex flex-col border border-gray-200 rounded-md">
                                        <x-tailwind-form-input
                                            class="h-10 border-none rounded-md px-4 w-full bg-gray-200 focus:outline-none focus:ring-0 placeholder-gray-400"
                                            wire:model="form.renter.last_name"
                                            name="last_name"
                                            placeholder="{{ __('Tavo pavardė') }}"/>

                                        <x-tailwind-form-errors
                                            class="text-red-400 text-xs not-italic"
                                            name="form.renter.last_name"/>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full flex flex-wrap">
                                <div class="w-full md:w-full lg:w-1/2 px-0 lg:!pr-10">
                                    <x-tailwind-form-input
                                        class="h-10 border-none rounded-md px-4 w-full bg-gray-200 focus:outline-none focus:ring-0 placeholder-gray-400"
                                        name="email"
                                        placeholder="{{ __('Tavo el.paštas') }}" disabled/>

                                    <x-tailwind-form-errors
                                        class="text-red-400 text-xs not-italic"
                                        name="form.renter.email"/>
                                </div>

                                <div class="w-full md:w-full lg:w-1/2">
                                    <div class="h-10 border-none flex flex-col border border-gray-200 rounded-md">
                                        <x-tailwind-form-input
                                            class="h-10 border-none rounded-md px-4 w-full bg-gray-200 focus:outline-none focus:ring-0 placeholder-gray-400"
                                            wire:model="form.renter.phone_number"
                                            name="phone_number"
                                            placeholder="{{ __('Tavo tel. Numeris') }}"/>

                                        <x-tailwind-form-errors
                                            class="text-red-400 text-xs not-italic"
                                            name="form.renter.phone_number"/>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full flex flex-wrap">
                                <div class="w-full">
                                    <x-tailwind-form-input
                                        class="h-10 border-none rounded-md px-4 w-full bg-gray-200 focus:outline-none focus:ring-0 placeholder-gray-400"
                                        wire:model="form.renter.address"
                                        name="address"
                                        placeholder="{{ __('Tavo adresas') }}"/>

                                    <x-tailwind-form-errors
                                        class="text-red-400 text-xs not-italic"
                                        name="form.renter.address"/>
                                </div>
                            </div>
                            @break
                        @case(CustomerType::COMPANY)
                            <div class="w-full flex flex-wrap">
                                <div class="w-full flex flex-col md:w-full lg:w-1/2 px-0 lg:!pr-10">
                                    <x-tailwind-form-input
                                        class="h-10 border-none rounded-md px-4 w-full bg-gray-200 focus:outline-none focus:ring-0 placeholder-gray-400"
                                        wire:model="form.company.company_name"
                                        name="company_name"
                                        placeholder="{{ __('Įmonės pavadinimas') }}"/>

                                    <x-tailwind-form-errors
                                        class="text-red-400 text-xs not-italic"
                                        name="form.company.company_name"/>
                                </div>

                                <div class="w-full md:w-full lg:w-1/2">
                                    <div class="h-10 border-none flex flex-col border border-gray-200 rounded-md">
                                        <x-tailwind-form-input
                                            class="h-10 border-none rounded-md px-4 w-full bg-gray-200 focus:outline-none focus:ring-0 placeholder-gray-400"
                                            wire:model="form.company.company_prefix"
                                            name="company_prefix"
                                            placeholder="{{ __('...') }}"/>

                                        <x-tailwind-form-errors
                                            class="text-red-400 text-xs not-italic"
                                            name="form.company.company_prefix"/>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full flex flex-wrap">
                                <div class="w-full flex flex-col md:w-full lg:w-1/2 px-0 lg:!pr-10">
                                    <x-tailwind-form-input
                                        class="h-10 border-none rounded-md px-4 w-full bg-gray-200 focus:outline-none focus:ring-0 placeholder-gray-400"
                                        wire:model="form.company.company_first_name"
                                        name="first_name"
                                        placeholder="{{ __('Įmonės vadovo vardas') }}"/>

                                    <x-tailwind-form-errors
                                        class="text-red-400 text-xs not-italic"
                                        name="form.company.company_first_name"/>
                                </div>

                                <div class="w-full md:w-full lg:w-1/2">
                                    <div class="h-10 border-none flex flex-col border border-gray-200 rounded-md">
                                        <x-tailwind-form-input
                                            class="h-10 border-none rounded-md px-4 w-full bg-gray-200 focus:outline-none focus:ring-0 placeholder-gray-400"
                                            wire:model="form.company.company_last_name"
                                            name="last_name"
                                            placeholder="{{ __('Įmonės vadovo pavardė') }}"/>

                                        <x-tailwind-form-errors
                                            class="text-red-400 text-xs not-italic"
                                            name="form.company.company_last_name"/>
                                    </div>
                                </div>
                            </div>
                            @break
                        @default
                    @endswitch

                    <div class="w-full text-center">
                        <div class="flex justify-center items-center">
                            <x-tailwind-form-submit
                                :class="implode(' ', [
                                    'text-white py-1.5 px-4 mr-2 rounded transition-all',
                                    $isDisabled ? '!text-white !bg-gray-400/70 !hover:bg-gray-300/100' : '!bg-amber-400 hover:!bg-amber-500',
                                ])"
                                :disabled="$isDisabled">
                                <span wire:loading.remove wire:target="editContacts" class="text-lg uppercase">
                                    {{ __('Išsaugoti') }}
                                </span>
                                <span wire:loading wire:target="editContacts" class="flex items-center text-sm">
                                    <svg aria-hidden="true" class="inline w-4 h-4 mb-1 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#FDE68A"/>
                                    </svg>
                                    <span class="text-lg uppercase">{{ __('Išsaugoma...') }}</span>
                                </span>
                            </x-tailwind-form-submit>
                        </div>
                    </div>
                </div>
                @endbind
            </x-tailwind-form>
        </div>
    </div>
</div>
