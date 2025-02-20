@extends('layouts.main')

@section('title' , 'Author Post')

@section('content')
<h1 class="font-bold text-blue-500 text-2xl pt-8 px-12">Postingan Author: {{ $user }}</h1>
    {{-- @foreach ($post as $hasil)
    <div class="px-12 flex flex-col gap-y-4 pt-8 text-2xl">
        <h2><a class="underline decoration-4 underline-offset-8 text-blue-500 font-bold" href="/post/{{ $hasil->slug }}">{{ $hasil->judul }}</a></h2>
        <p class="text-xl">{{ $hasil->excerpt }}</p>
    </div>

    @endforeach --}}

      {{-- Fitur Search --}}
      <form action="/blog" method="get">
        <div class="flex flex-wrap mx-auto px-12 py-8 w-[95%] justify-center">
            <input type="text" value="{{ request('key') }}" id="first_name" name="key" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-lg block w-[40%] p-2" placeholder="Pencarian"/>
            <button type="submit" name="klik" value="1" id="klik" class="py-[0.3rem] px-3 font-bold bg-blue-600 inline-block w-fit rounded-r-lg text-white">Cari</button>
        </div>
    </form>

    {{-- New Post If postingan empty === post not found--}}
    @if ($post->count())
    <div class="mx-auto px-12 py-8 w-[95%] min-h-full flex flex-col gap-y-4">
        <img src="{{ $post[0]->images }}" class="card-img-top self-center w-[600px]" alt="Postingan">
        <div class="flex flex-col gap-y-4 font-bold">
            <h5 class="text-2xl"><a href="/post/{{ $post[0]->slug }}">{{ $post[0]->judul }}</a></h5>
            <h2 class="text-xl font-semibold text-slate-900">Jenis:
                {{-- <a href="/categories/{{ $post[0]->category->slug }}" class="text-blue-500">{{ $post[0]->category->nama_kategory }}</a> --}}
                {{-- Redirect category to blog --}}
                <a href="/blog?category={{ $post[0]->category->slug }}" class="text-blue-500">{{ $post[0]->category->nama_kategory }}</a>
                {{-- By <a href="/listuser/{{ $post[0]->author->username }}" class="text-blue-500">{{ $post[0]->author->name }}</a> --}}
                {{-- Redirect author to blog --}}
                By <a href="/blog?author={{ $post[0]->author->username }}" class="text-blue-500">{{ $post[0]->author->name }}</a>
                <small class="font-normal text-lg text-gray-500">{{ $post[0]->created_at->diffForHumans() }}</small>
            </h2>
            <p class="text-xl font-semibold">{{ $post[0]->excerpt }}</p>
            <a href="/post/{{ $post[0]->slug }}" class="text-xl font-semibold p-[0.3rem] bg-blue-600 inline-block w-fit rounded-lg text-white">Read More</a>
        </div>
    </div>
    @else
        <p class="font-bold text-center text-xl">No Postingan Found.</p>
    @endif

    <div class="mt-4 mx-auto w-[95%]">
        <div class="flex flex-wrap gap-6 justify-center">
            @foreach ($post->skip(1) as $hasil)
            {{-- @dd($hasil->user) --}}
            <div class="relative w-[30%] min-w-[250px] flex flex-col justify-start items-center gap-4 border-2 border-gray-600 rounded-lg">
                <div class="absolute top-0 p-[0.35rem] rounded-sm bg-slate-600 font-bold text-white bg-opacity-85"><a href="/categories/{{ $hasil->category->slug }}">{{ $hasil->category->nama_kategory }}</a></div>
                <img src="{{ $post[0]->images }}" class="card-img-top self-center w-full max-h-[300px]" alt="Postingan">
                <h2 class="text-cyan-700 font-bold text-xl">
                    <a href="/post/{{ $hasil->slug }}">{{ $hasil->judul }}</a>
                </h2>
                <div class="flex flex-col justify-start items-center gap-4 px-4">
                    <small class="self-start font-normal text-[16px] text-gray-500">By: <a class="text-blue-500 font-bold" href="/listuser/{{ $hasil->author->username }}">{{ $hasil->author->name }}</a> {{ $hasil->created_at->diffForHumans() }}</small>
                    <p class="text-justify text-[16px] text-slate-900">{{ $hasil->excerpt }}</p>
                    <a href="/post/{{ $hasil->slug }}" class="font-semibold mb-4 self-start p-2 bg-blue-600 inline-block w-fit rounded-md text-white leading-none">Read More..</a>
                    {{-- <img src="{{ $hasil['images'] }}" alt="{{ $hasil->nama }}"> --}}
                    {{-- <p class="text-xl text-slate-900">{{ $hasil->post }}</p> --}}
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
