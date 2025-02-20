@extends('layouts.main')

@section('title', 'About Page')
@section('content')
    <section class="px-4 pt-8">
        <h1 class="pt-8 text-orange-300 text-4xl font-bold">Test About</h1>
        <div class="w-[425px] flex flex-col gap-y-4 pt-8">
            <h2 class="text-xl font-semibold text-orange-300">By: {{ $nama }}</h2>
            <h2>
                <a href="/blog">View More...</a>
            </h2>
            <img src="{{ $images }}" alt="{{ $nama }}">
        </div>
    </section>

    <section class="div h-screen"></section>
@endsection

<script>
// document.addEventListener("DOMContentLoaded", function() {
//     if (typeof Swal !== 'undefined') {
//         Swal.fire({
//             title: "SweetAlert2 Berhasil!",

//             text: "SweetAlert2 sudah berjalan dengan Vite!",
//             icon: "success"
//         });
//     } else {
//         console.error("SweetAlert2 belum termuat.");
//     }
// });
</script>
{{-- <script src="{{ asset('js/script.js') }}"></script> --}}



