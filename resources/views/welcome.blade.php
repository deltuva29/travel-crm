@extends('layouts.app')

@section('content')
    <div class="lg:flex bg-white">
        <div class="lg:w-1/2 xl:max-w-screen-sm bg-white">
            <div class="py-12 bg-yellow-400 lg:bg-white flex justify-center lg:justify-start lg:px-12">
                <div class="cursor-pointer flex items-center">
                    <div class="text-2xl text-white lg:text-gray-700 tracking-wide ml-2 font-semibold">
                        {{ config('app.name', 'Laravel') }}
                    </div>
                </div>
            </div>
            <div class="mt-10 px-12 bg-white sm:px-24 md:px-48 lg:px-12 lg:mt-16 xl:px-24 xl:max-w-2xl">
                <h2 class="text-center text-4xl text-gray-700 font-display font-extrabold lg:text-left xl:text-5xl
                    xl:text-bold">{{ __('Prisijungti') }}</h2>
                <div class="mt-12">
                    <form>
                        <div>
                            <div class="text-sm font-bold text-gray-700 tracking-wide">{{ __('El.paštas') }}</div>
                            <label>
                                <input class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-yellow-400" type="" placeholder="">
                            </label>
                        </div>
                        <div class="mt-8">
                            <div class="flex justify-between items-center">
                                <div class="text-sm font-bold text-gray-700 tracking-wide">
                                    {{ __('Slaptažodis') }}
                                </div>
                                <div>
                                    <a class="text-xs font-display font-semibold text-yellow-400 hover:text-yellow-500
                                        cursor-pointer">
                                        {{ __('Pamiršote duomenys?') }}
                                    </a>
                                </div>
                            </div>
                            <label>
                                <input class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-yellow-400" type="" placeholder="">
                            </label>
                        </div>
                        <div class="mt-10">
                            <button class="bg-yellow-400 text-white p-4 w-full rounded-lg tracking-wide
                                font-semibold font-display focus:outline-none focus:shadow-outline hover:bg-yellow-500
                                shadow-lg">
                                {{ __('Jungtis') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @include('sliders.slider')
@endsection


