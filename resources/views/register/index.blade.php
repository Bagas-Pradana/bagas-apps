@extends('layouts.main')

@section('title', 'Register Admin')

@section('content')
    <section class="relative w-full h-full flex items-center justify-center bg-transparent">
        <img src="https://fastly.picsum.photos/id/944/1600/900.jpg?hmac=tDV2mAY561nINYs00hWci78a69p7DYAqYWBkNUxWK5w" alt="background" class="absolute top-0 left-0 w-full h-full object-cover -z-40">
        <div id="cover" class="relative flex flex-col items-center justify-center px-6 py-8 m-auto sm:max-w-md w-full">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-10 h-10 mr-2" src="https://img.icons8.com/?size=100&id=48179&format=png&color=000000" alt="logo">
                Bagas Postingan
            </a>

            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Daftar Sebagai Admin
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="/register" method="POST">
                        {{-- Cross site request forgery --}}
                        @csrf
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Margaretha Vulriplet"  onfocus="this.placeholder=''"
                            onblur="this.placeholder='Margaretha Vulriplet'" required="" value="{{ old('name') }}">
                            @error('name')
                                <div class="text-red-600 font-semibold text-shadow-red text-sm pt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                            <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Maretha12"  onfocus="this.placeholder=''"
                            onblur="this.placeholder='Maretha12'" required="" value="{{ old('username') }}">
                            @error('username')
                                <div class="text-red-600 font-semibold text-shadow-red text-sm pt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="" value="{{ old('email') }}">
                            @error('email')
                                <div class="text-red-600 font-semibold text-shadow-red text-sm pt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="Password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                            @error('password')
                                <div class="text-red-600 font-semibold text-shadow-red text-sm pt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konfirmasi password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                            <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" required="">
                            </div>
                            <div class="ml-3 text-sm">
                            <label for="terms" class="font-light text-gray-500 dark:text-gray-300">Saya Menyetujui <a class="font-medium text-blue-600 hover:underline dark:text-blue-500" href="#">Syarat dan Ketentuan</a></label>
                            </div>
                        </div>
                        <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Daftar</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Sudah Punya Akun? <a href="/login" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Masuk Disini</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

        {{-- Gagal Registrasi --}}
        @if(session('failed'))
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                if (typeof Swal !== 'undefined') {
                    let errorMessages = {!! session('validationErrors') !!}; // Ambil error dari session
                    // let errorMessage = @json(session('failed'));
                    let formattedErrors = "";

                    if (errorMessages) {
                        for (const field in errorMessages) {
                            formattedErrors += errorMessages[field] + "<br>";
                        }
                    }

                    Swal.fire({
                        title: "Registrasi Gagal!",
                        html: formattedErrors,
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                } else {
                    console.error("SweetAlert2 belum termuat.");
                    }
                });
            </script>
        @endif
        {{-- End Gagal Registrasi --}}






