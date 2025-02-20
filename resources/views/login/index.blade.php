@extends('layouts.main')

@section('title', 'Login Admin')

@section('content')
    <section class="relative w-full h-full flex items-center justify-center bg-transparent">
        <img src="https://fastly.picsum.photos/id/944/1600/900.jpg?hmac=tDV2mAY561nINYs00hWci78a69p7DYAqYWBkNUxWK5w" alt="background" class="absolute top-0 left-0 w-full h-full object-cover -z-40">
        <div class="relative flex flex-col items-center justify-center px-6 py-8 m-auto sm:max-w-md w-full">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-10 h-10 mr-2" src="https://img.icons8.com/?size=100&id=48179&format=png&color=000000" alt="logo">
                Bagas Postingan
            </a>

            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Masuk Sebagai Admin
                    </h1>

                    <form class="space-y-4 md:space-y-6" action="{{ route('authenticate') }}" method="POST">
                        @csrf
                        {{-- Email --}}
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                        </div>
                        {{-- Password --}}
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>

                        {{-- <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" required="">
                                </div>
                                <div class="ml-3 text-sm">
                                <label for="remember" class="text-gray-500 ">Remember me</label>
                                </div>
                            </div>
                            <a href="#" class="text-sm font-medium text-blue-600 hover:underline">Lupa password?</a>
                        </div> --}}
                        <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700">Masuk</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Belum Punya Akun?
                            <a href="/register" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Daftar</a>
                        </p>
                    </form>
                </div>
            </div>

            {{-- Pesan Registrasi Akun Berhasil --}}
            @if(session('success'))
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                    // Ambil pesan dari Laravel session dan simpan di sessionStorage
                    let successMessage = {!! json_encode(session('success')) !!};

                    if (successMessage) {
                        sessionStorage.setItem('successMessage', successMessage); // Simpan di sessionStorage
                    }

                    // Cek sessionStorage untuk menampilkan alert
                    let storedMessage = sessionStorage.getItem('successMessage');
                    if (storedMessage) {
                        Swal.fire({
                            title: "Berhasil!",
                            text: storedMessage,
                            icon: "success"
                        });

                            sessionStorage.removeItem('successMessage'); // Hapus agar tidak muncul lagi setelah refresh
                        }
                    });
                </script>
            @endif
            {{-- End Pesan Registrasi Akun Berhasil --}}


            {{-- Pesan Gagal Login --}}
            @if (session('loginError'))
            {{-- <div class="mt-2 text-green-600 bg-white bg-opacity-70 font-bold p-1">{{ session('loginError') }}</div> --}}

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                    // Ambil pesan dari Laravel session dan simpan di sessionStorage
                    let errorMessage = {!! json_encode(session('loginError')) !!};

                    if (errorMessage) {
                        sessionStorage.setItem('errorMessage', errorMessage); // Simpan di sessionStorage
                    }

                    // Cek sessionStorage untuk menampilkan alert
                    let storedMessage = sessionStorage.getItem('errorMessage');
                    if (storedMessage) {
                        Swal.fire({
                            title: "Anda Gagal Login!",
                            text: storedMessage,
                            icon: "error"
                        });

                            sessionStorage.removeItem('errorMessage'); // Hapus agar tidak muncul lagi setelah refresh
                        }
                    });
                </script>
            @endif
            {{-- End Pesan Gagal Login Pesan Gagal Login --}}
        </div>
    </section>
@endsection



    {{-- <script>
                document.addEventListener("DOMContentLoaded", function() {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "{{ session('success') }}",
                            icon: "success"
                        });
                    } else {
                        console.error("SweetAlert2 belum termuat.");
                    }
                });
                </script> --}}
