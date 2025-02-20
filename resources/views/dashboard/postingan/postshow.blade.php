@extends('layouts.dashboard-main')

@section('title', 'Detail Post')

@section('dash-content')
<!-- component -->
<section class="absolute top-0 w-[75%] right-0 z-10 pt-4">
    <div class="w-[65%]">
        <div class="px-12 flex flex-col gap-y-6 pt-8 justify-center">
            <h2 class="text-4xl font-bold text-slate-900">{{ $postingan->judul }}</h2>
            <div class="flex flex-wrap justify-start items-center gap-x-2">
                <a href="/dashboard/blog" class="text-xl font-semibold px-3 pt-0.5 pb-1 bg-blue-600 inline-flex items-center gap-2 rounded-lg text-white self-center">
                    <svg class="w-3.5 h-3.5 ms-2 rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg> My Postingan
                </a>
                <a class="text-xl font-semibold px-3 pt-0.5 pb-1 bg-blue-600 inline-flex items-center gap-2 rounded-lg text-white" href="/dashboard/blog/{{ $postingan->slug }}/edit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                {{-- <a href="/categories/{{ $postingan->category->slug }}" class="text-blue-500 font-bold underline underline-offset-8 decoration-4">{{ $postingan->category->nama_kategory }}</a> --}}
                {{-- Redirect To Blog --}}
                <form action="/dashboard/blog/{{ $postingan->slug }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="text-xl font-semibold px-3 pt-0.5 pb-1 bg-blue-600 inline-flex items-center gap-2 rounded-lg text-white" onclick="return confirm('Yakin?')">
                        <svg class="text-gray-400 dark:text-gray-500 w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg> Delete
                    </button>
                </form>
            </div>
            {{-- @dd($postingan) --}}
            @if ($postingan->images)
                <img class="aspect-[5.5/3] object-cover object-top" src="{{ asset('storage/' . $postingan->images) }}" alt="{{ $postingan->nama }}">
            @else
                <img class="aspect-[5.5/3] object-cover object-top" src="https://fastly.picsum.photos/id/276/300/200.jpg?hmac=PqQb3_Pue9TG1kb_XmcM0QBEE88fpxbskzQbUhWZqv4" alt="{{ $postingan->nama }}">
                {{ 'Null' }}
            @endif

            <p class="text-justify text-xl text-slate-900">{!! $postingan->body !!}</p>
            <p class="text-xl text-slate-900">{{ $postingan->post }}</p>
        </div>
    </div>
    <div class="h-screen"></div>
</section>


@endsection
