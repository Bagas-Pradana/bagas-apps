@extends('layouts.main')

@section('title', 'User Access')

@section('content')
    @foreach ($post as $hasil)
    {{-- @dd($hasil->name) --}}
        <div class="px-12 flex flex-col gap-y-8 pt-8 font-bold text-2xl">
            <ul>
                <li>
                    {{-- <a class="underline decoration-4 underline-offset-8 text-blue-500" href="/listuser/{{ $hasil->username }}">{{ $hasil->name }}</a> --}}
                    {{-- Redirect to blog --}}
                    <a class="underline decoration-4 underline-offset-8 text-blue-500" href="/blog/?author={{ $hasil->username }}">{{ $hasil->name }}</a>
                </li>
            </ul>
        </div>
    @endforeach
@endsection
