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
            @livewire('auth.home-login')
        </div>
    @livewire('sliders.slider')
@endsection


