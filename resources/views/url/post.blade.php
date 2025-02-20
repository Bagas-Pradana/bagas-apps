{{-- @dd($post) --}}
@extends('layouts.main')

@section('title', $post->judul . 'Page')

@section('content')
    <div class="mx-auto w-[65%]">
        <div class="px-12 flex flex-col gap-y-6 pt-8">
            <h2 class="text-4xl font-bold text-slate-900">{{ $post->judul }}</h2>
            <h2 class="text-xl font-semibold text-slate-900">By: <a class="text-blue-500 font-bold underline underline-offset-8 decoration-4" href="/listuser/{{ $post->author->username }}">{{ $post->author->name }}</a> Category
                {{-- <a href="/categories/{{ $post->category->slug }}" class="text-blue-500 font-bold underline underline-offset-8 decoration-4">{{ $post->category->nama_kategory }}</a> --}}
                {{-- Redirect To Blog --}}
                <a href="/blog?category={{ $post->category->slug }}" class="text-blue-500 font-bold underline underline-offset-8 decoration-4">{{ $post->category->nama_kategory }}</a>

            </h2>
            <img class="aspect-[5.5/3] object-cover object-top" src="{{ $post->images }}" alt="{{ $post->nama }}">
            <p class="text-justify text-xl text-slate-900">{!! $post->body !!}</p>
            <p class="text-xl text-slate-900">{{ $post->post }}</p>
            <a href="/blog" class="text-blue-400 font-semibold text-lg underline decoration-4 underline-offset-8 ">Back to Blog</a>
        </div>
    </div>
    <div class="h-screen"></div>

@endsection
