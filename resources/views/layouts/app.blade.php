@extends('layouts.base')

@section('body')
    @auth('customer')
        @include('partials.header')
    @endauth

    @yield('content')

    @isset($slot)
        {{ $slot }}
    @endisset
@endsection
