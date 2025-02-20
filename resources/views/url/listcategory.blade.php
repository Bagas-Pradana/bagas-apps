
@extends('layouts.main')

@section('title', 'Categories Page')

@section('content')


    <div class="flex flex-wrap gap-x-4 px-12 w-[95%] pt-8">
        @foreach ($post as $hasil)
        {{-- @dd($hasil->postingan) --}}
        <ul>
            <li class="relative">
                <a href="/categories/{{ $hasil->slug}}">
                    <img src="https://fastly.picsum.photos/id/566/300/200.jpg?hmac=NAQ0nbCC3Trz6PI6fC-Z_z0baf0eBG-X5dqLZjvtPEE" alt="Content">
                    {{-- <a href="/categories/{{ $hasil->slug}}" class="absolute top-1/2 -translate-y-1/2 p-2 text-2xl bg-slate-600 font-bold text-white bg-opacity-85 w-full text-center">{{ $hasil->nama_kategory }}</a> --}}
                    {{-- Redirect to Blog --}}
                    <a href="/blog?category={{ $hasil->slug}}" class="absolute top-1/2 -translate-y-1/2 p-2 text-2xl bg-slate-600 font-bold text-white bg-opacity-85 w-full text-center">{{ $hasil->nama_kategory }}</a>
                </a>
            </li>
        </ul>
        @endforeach
    </div>

<div class="h-screen"></div>

@endsection
