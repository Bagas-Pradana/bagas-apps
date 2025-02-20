@extends('layouts.main')

@section('title', 'Blog Page')

@section('content')
    <h2 class="text-4xl font-bold my-4">{{ $title }}</h2>

        {{-- Fitur Search --}}
        <form action="/blog" method="get">
            {{-- Kasih Logic jika di dalam request ada category --}}
            @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif

            {{-- Kasih Logic Jika di dalam request ada user --}}
            @if (request('author'))
                <input type="hidden" name="author" value="{{ request('author') }}">
            @endif

            <div class="flex flex-wrap mx-auto px-12 py-8 w-[95%] justify-center">
                <input type="text" value="{{ request('key') }}" id="first_name" name="key" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-lg block w-[40%] p-2" placeholder="Pencarian"/>
                <button type="submit" name="klik" value="1" id="klik" class="py-[0.3rem] px-3 font-bold bg-blue-600 inline-block w-fit rounded-r-lg text-white">Cari</button>
            </div>
        </form>

        {{-- @dd($post[0]->images) --}}
        {{-- New Post If postingan empty === post not found--}}
        {{-- ------------------------------------------------------Postingan Terbaru--------------------------------------------------------------- --}}
        @if ($post->count())
            <div class="mx-auto px-12 py-8 w-[95%] min-h-full flex flex-col gap-y-4">

                {{-- Kasih Logic JIka Postingan adalah Hasil Upload User --}}
                @if ($post[0]->images)
                    <img src="{{ asset('storage/' . $post[0]->images) }}" class="card-img-top self-center w-[600px]" alt="Postingan">
                @else
                    <img class="aspect-[5.5/3] object-cover object-top" src="https://fastly.picsum.photos/id/276/300/200.jpg?hmac=PqQb3_Pue9TG1kb_XmcM0QBEE88fpxbskzQbUhWZqv4" alt="{{ $post[0]->images }}">
                @endif

                <div class="flex flex-col gap-y-4 font-bold">
                    <h5 class="text-2xl"><a href="/post/{{ $post[0]->slug }}">{{ $post[0]->judul }}</a></h5>
                    <h2 class="text-xl font-semibold text-slate-900">Jenis:
                        {{-- <a href="/categories/{{ $post[0]->category->slug }}" class="text-blue-500">{{ $post[0]->category->nama_kategory }}</a> --}}
                        {{-- Redirect category to blog  --}}
                        <a href="/blog?category={{ $post[0]->category->slug }}" class="text-blue-500">{{ $post[0]->category->nama_kategory }}</a>
                        {{-- By <a href="/listuser/{{ $post[0]->author->username }}" class="text-blue-500">{{ $post[0]->author->name }}</a> --}}
                        {{-- Redirect author to blog --}}
                        By <a href="/blog?author={{ $post[0]->author->username }}" class="text-blue-500">{{ $post[0]->author->name }}</a>
                        <small class="font-normal text-lg text-gray-500">{{ $post[0]->created_at->diffForHumans() }}</small>
                    </h2>
                    <p class="text-xl font-semibold">{{ $post[0]->excerpt }}</p>
                    {{-- <a href="/post/{{ $post[0]->slug }}" class="text-xl font-semibold p-[0.3rem] bg-blue-600 inline-block w-fit rounded-lg text-white">Read More</a> --}}

                    {{-- ButtonPopUP --}}
                    <button id="popup-button" type="button" class="text-xl font-semibold p-[0.3rem] bg-blue-600 inline-block w-fit rounded-lg text-white">Read More</button>
                </div>

            </div>

            {{-- POpUP Postingan Terbaru--}}
            <section id="showPopup" class="fixed z-[999] inset-0 px-4 lg:px-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="fixed z-[9999] top-2 right-2 px-0.5 pt-[0.065rem] pb-0.5 flex justify-center items-center bg-white">
                    <button type="button" id="close-button" class="font-bold text-xl text-black px-2 pt-0.5 pb-1">×</button>
                </div>

                <div class="mx-auto w-[65%] bg-white overflow-auto h-full">
                    <div class="px-12 flex flex-col gap-y-6 py-8 ">
                        <h2 class="text-4xl font-bold text-slate-900" id="judul">{{ $post[0]->judul }}</h2>
                        <h2 class="text-xl font-semibold text-slate-900">By: <a class="text-blue-500 font-bold underline underline-offset-8 decoration-4" href="/listuser/{{ $post[0]->author->username }}">{{ $post[0]->author->name }}</a> Category
                            {{-- <a href="/categories/{{ $post[0]->category->slug }}" class="text-blue-500 font-bold underline underline-offset-8 decoration-4">{{ $post[0]->category->nama_kategory }}</a> --}}
                            {{-- Redirect To Blog --}}
                            <a href="/blog?category={{ $post[0]->category->slug }}" class="text-blue-500 font-bold underline underline-offset-8 decoration-4">{{ $post[0]->category->nama_kategory }}</a>
                        </h2>

                        {{-- Kasih Logic Jika hasil Upload Postingan User --}}
                        @if ($post[0]->images)
                            <img src="{{ asset('storage/' . $post[0]->images) }}" class="card-img-top self-center w-[600px]" alt="Postingan">
                        @else
                            <img class="aspect-[5.5/3] object-cover object-top" src="https://fastly.picsum.photos/id/276/300/200.jpg?hmac=PqQb3_Pue9TG1kb_XmcM0QBEE88fpxbskzQbUhWZqv4" alt="{{ $post[0]->images }}">
                        @endif

                        <p class="text-justify text-xl text-slate-900">{!! $post[0]->body !!}</p>
                        <p class="text-xl text-slate-900">{{ $post[0]->post }}</p>

                        {{-- Button Likes --}}
                        <button class="like-button2 text-xl font-semibold px-3 pt-0.5 pb-1 bg-blue-600 inline-flex items-center justify-center gap-2 rounded-lg text-white w-[15%]" data-id="{{ $post[0]->id }}">
                            <span class="like-count2">{{ $post[0]->likes->count() }}</span> likes
                        </button>
                    </div>
                </div>
            </section>
            {{-- End POpUP --}}
            {{-- ---------------------------------------------ENd Postingan Terbaru------------------------------------------------------------- --}}

            {{-- Postingan data --}}
            <section class="mt-4 mx-auto w-[95%]">
                <div class="flex flex-wrap gap-6 justify-center">
                    @foreach ($post->skip(1) as $hasil)
                        {{-- @dd($hasil->user) --}}
                        <div class="relative w-[30%] min-w-[250px] flex flex-col justify-start items-center gap-4 border-2 border-gray-600 rounded-lg">
                            <div class="absolute top-0 p-[0.35rem] rounded-sm bg-slate-600 font-bold text-white bg-opacity-85">
                                {{-- <a href="/categories/{{ $hasil->category->slug }}">{{ $hasil->category->nama_kategory }}</a> --}}
                                {{-- Redirect category to Blog --}}
                                <a href="/blog?category={{ $hasil->category->slug }}">{{ $hasil->category->nama_kategory }}</a>
                            </div>

                            {{-- Kasih Logic Jika User Upload Image --}}
                            @if ($hasil->images)
                                <img src="{{ asset('storage/' . $hasil->images) }}" class="aspect-[5.5/3] object-cover object-top max-h-[200px] w-full" alt="Postingan">
                            @else
                                <img class="aspect-[5.5/3] object-cover object-top w-full" src="https://fastly.picsum.photos/id/276/300/200.jpg?hmac=PqQb3_Pue9TG1kb_XmcM0QBEE88fpxbskzQbUhWZqv4" alt="{{ $hasil->author->name }}">
                            @endif

                            <h2 class="text-cyan-700 font-bold text-xl">
                                <a href="/post/{{ $hasil->slug }}">{{ $hasil->judul }}</a>
                            </h2>
                            <div class="flex flex-col justify-start items-center gap-4 px-4 w-[100%]">
                                <small class="self-start font-normal text-[16px] text-gray-500">
                                    {{-- By: <a class="text-blue-500 font-bold" href="/listuser/{{ $hasil->author->username }}">{{ $hasil->author->name }}</a> {{ $hasil->created_at->diffForHumans() }}</small> --}}
                                    {{-- Redirect author to blog --}}
                                    By: <a class="text-blue-500 font-bold" href="/blog/?author={{ $hasil->author->username }}">{{ $hasil->author->name }}</a> {{ $hasil->created_at->diffForHumans() }}</small>
                                <p class="self-start text-justify text-[16px] text-slate-900">{{ $hasil->excerpt }}</p>
                                {{-- <a href="/post/{{ $hasil->slug }}" class="font-semibold mb-4 self-start p-2 bg-blue-600 inline-block w-fit rounded-md text-white leading-none">Read More..</a> --}}

                                {{-- Button PopUP --}}
                                <button data-slug="{{ $hasil->slug }}" class="popup-button2 font-semibold mb-4 self-start p-2 bg-blue-600 inline-block w-fit rounded-md text-white leading-none">
                                    Read More
                                </button>

                                {{-- PopUp Postingan Data --}}
                                <section id="showPopup2" class="fixed z-[999] inset-0 px-4 lg:px-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                                    <div class="fixed z-[9999] top-2 right-2 px-2 py-1 flex justify-center items-center bg-white">
                                        <button id="close-button2"class="font-bold text-xl text-black">×</button>
                                    </div>

                                    <div class="mx-auto w-[65%] bg-white overflow-auto h-full">
                                        <div id="popup-content" class="px-12 flex flex-col gap-y-6 py-8">
                                            <!-- Konten akan diisi oleh JavaScript -->

                                            <h2 id="judul" class="text-4xl font-bold text-slate-900"></h2>
                                            <h2 id="sub-judul" class="text-xl font-semibold text-slate-900 hidden">By:
                                                <a id="link-author" class="text-blue-500 font-bold underline underline-offset-8 decoration-4" href=""></a> Category
                                                {{-- <a href="/categories/{{ $post[0]->category->slug }}" class="text-blue-500 font-bold underline underline-offset-8 decoration-4">{{ $post[0]->category->nama_kategory }}</a> --}}
                                                {{-- Redirect To Blog --}}
                                                <a id="link-category" href="" class="text-blue-500 font-bold underline underline-offset-8 decoration-4"></a>
                                            </h2>
                                            <img id="image-user" src="" class="card-img-top self-center w-[600px] hidden" alt="Postingan">
                                            <img id="image-default" class="aspect-[5.5/3] object-cover object-top hidden" src="https://fastly.picsum.photos/id/276/300/200.jpg?hmac=PqQb3_Pue9TG1kb_XmcM0QBEE88fpxbskzQbUhWZqv4" alt="Postingan">
                                            <div id="body-postingan" class="text-justify text-lg text-slate-900 flex flex-col gap-y-6"></div>
                                            {{-- Button Likes --}}
                                            <button id="tombol-like" class="text-xl font-semibold px-3 pt-0.5 pb-1 bg-blue-600 inline-flex items-center gap-2 rounded-lg text-white w-[15%]" data-id="">
                                                <span id="like-count"></span> likes
                                            </button>
                                        </div>
                                    </div>
                                </section>
                                {{-- End PopUP Postingan Data --}}

                                {{-- Debugging --}}
                                {{-- <img src="{{ $hasil['images'] }}" alt="{{ $hasil->nama }}"> --}}
                                {{-- <p class="text-xl text-slate-900">{{ $hasil->post }}</p> --}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Kondisi Jika Postingan Tidak Ada --}}
        @else
            <p class="font-bold text-center text-xl">No Postingan Found.</p>
        @endif

        {{-- Fitur Pagination --}}
        <div class="my-4 mx-12">
            {{ $post->links() }}
        </div>

        <div class="h-96"></div>
@endsection

{{-- Javascript Handling Like dan PopUp --}}
@push('script')
    <script src="{{ asset('js/test.js') }}"></script>
@endpush

{{-- Handling Success Login --}}
@if(session('success'))
{{-- <p>Debug: {{ session('success') }}</p> <!-- Tambahkan ini --> --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Simpan pesan success dari session ke sessionStorage jika ada
            let successMessage = {!! json_encode(session('success')) !!};

            if (successMessage) {
                sessionStorage.setItem('loginSuccess', successMessage); // Simpan di sessionStorage
            }

            // Cek sessionStorage untuk menampilkan alert
            let loginMessage = sessionStorage.getItem('loginSuccess');
            if (loginMessage) {
                Swal.fire({
                    title: "Berhasil!",
                    text: loginMessage,
                    icon: "success"
                });

                sessionStorage.removeItem('loginSuccess'); // Hapus agar tidak muncul lagi setelah refresh
                }
            });
    </script>
@endif

