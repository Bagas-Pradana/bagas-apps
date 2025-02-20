@extends('dashboard.layouts.main')

@section('title', 'Create Form')

@section('dash-content')
    {{-- @dd($postingan); --}}
    {{-- $postingan->where('user_id', auth()->user()->id)->get() --}}
    <section class="absolute top-0 w-[75%] right-0 z-10 pt-4">
        <div class="flex flex-col gap-y-6 w-[75%] ps-4 ">
            <h1 class="mx-auto font-bold text-2xl pl-4">Postingan Editor</h1>
            {{-- <form action="" class=" max-w-full">
                <div class="flex flex-wrap py-8 w-[95%] justify-start">
                    <input type="text" value="{{ request('key') }}" id="first_name" name="key" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-lg block w-[40%] p-2" placeholder="Pencarian"/>
                    <button type="submit" name="klik" value="1" id="klik" class="py-[0.3rem] px-3 font-bold bg-blue-600 inline-block w-fit rounded-r-lg text-white">Cari</button>
                </div>
            </form>
            <a href="/dashboard/blog/create" class="self-start text-xl font-semibold px-3 pt-0.5 pb-1 bg-blue-600 inline-flex items-center gap-2 rounded-lg text-white">Create New Post</a> --}}
        </div>
        {{-- Create --}}
        <form action="/dashboard/blog/{{ $postingan->slug }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="flex flex-col gap-y-4 justify-center mt-4 px-2">
                <div>
                    <label for="judul" class="block mb-2 text-sm font-medium text-gray-900">Judul Postingan</label>
                    <input type="text" id="judul" name="judul" class="bg-white border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2" autocomplete="on" value="{{ old('judul', $postingan->judul) }}" required>
                    @error('judul')
                        <div class="text-red-600 font-semibold text-shadow-red text-sm pt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="slug" class="block mb-2 text-sm font-medium text-gray-900">URL Postingan</label>
                    <input type="text" id="slug" name="slug" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed placeholder-gray-400" value="{{ old('slug', $postingan->slug) }}" readonly required>
                    @error('slug')
                        <div class="text-red-600 font-semibold text-shadow-red text-sm pt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                    <select id="category" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        <option selected>Choose a country</option>
                        @foreach ($categories as $item)
                            @if(old('category_id', $postingan->category_id) == $item->id)
                                <option value="{{ $item->id }}" selected>{{ $item->nama_kategory }}</option>
                            @else
                                <option value="{{ $item->id }}">{{ $item->nama_kategory }}</option>
                            @endif
                        @endforeach
                    </select>
                        @error('category')
                            <div class="text-red-600 font-semibold text-shadow-red text-sm pt-1">{{ $message }}</div>
                        @enderror
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="images">Upload file</label>
                    <!-- Menyimpan Image Lama Untuk dihapus -->
                    <input type="hidden" name="oldImage" value="{{ $postingan->images }}">
                    <!-- Gunakan satu elemen gambar -->
                    <img id="imagepreview"
                            src="{{ $postingan->images ? asset('storage/' . $postingan->images) : '' }}"
                            alt="{{ $postingan->images ? $postingan->author->name : 'Preview' }}"
                            class="w-fit max-w-[400px] max-h-[200px] {{ $postingan->images ? '' : 'hidden' }}">

                    <!-- Input file disembunyikan -->
                    <input type="file" id="images" name="images" class="hidden" onchange="updateFileName(this); previewImage(this);">

                    <!-- Tombol Pilih File -->
                    <label for="images" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 p-2 text-center hover:bg-gray-200">
                        Pilih File
                    </label>

                    <!-- Menampilkan Nama File yang Dipilih -->
                    <p id="file_name" class="mt-2 text-sm text-gray-500"></p>

                    <p class="mt-1 text-sm text-gray-500">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>

                    @error('images')
                        <div class="text-red-600 font-semibold text-shadow-red text-sm pt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="body" class="block mb-2 text-sm font-medium text-gray-900">Body</label>
                    @error('body')
                        <p class="text-red-600 font-semibold text-shadow-red text-sm pb-1">{{ $message }}</p>
                    @enderror
                    <input id="body" name="body" type="hidden" value="{{ old('body', $postingan->body) }}">
                    <trix-editor input="body"></trix-editor>
                </div>
                <button type="submit" class="self-start text-xl font-semibold px-3 pt-0.5 pb-1 bg-blue-600 inline-flex items-center gap-2 rounded-lg text-white">Update</button>
            </div>
        </form>
    </section>
@endsection


<script>
    document.addEventListener("DOMContentLoaded", function() {
    const judul = document.querySelector('#judul');
    const slug = document.querySelector('#slug');

    judul.addEventListener('change', function(){
        fetch('/dashboard/blog/checkSlug?judul=' + judul.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });
    //     async function getData() {
    // const url = "https://example.org/products.json";
    // try {
    //     const response = await fetch(url);
    //     if (!response.ok) {
    //     throw new Error(`Response status: ${response.status}`);
    //     }

    //     const json = await response.json();
    //     console.log(json);
    // } catch (error) {
    //     console.error(error.message);
    // }
    // }

    // Trix
    let attachButton = document.querySelector('.trix-button[data-trix-action="attachFiles"]');
    if (attachButton) {
        attachButton.style.display = "none";
    }

    // Image
    function updateFileName(input) {
        const fileName = input.files.length > 0 ? input.files[0].name : "Tidak ada file yang dipilih";
        document.getElementById("file_name").textContent = fileName;
    }


   // Fungsi untuk menampilkan preview gambar
    function previewImage(input) {
    const previewImage = document.getElementById('imagepreview');

    if (input.files.length > 0) {
        const file = input.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewImage.classList.remove('hidden'); // Tampilkan gambar baru
        };

            reader.readAsDataURL(file);
            }
        }
    });
</script>

