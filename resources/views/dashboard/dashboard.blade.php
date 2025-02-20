@extends('dashboard.layouts.main')

@section('title', 'dashboard')

@section('dash-content')
<!-- component -->
<section class="absolute top-0 w-[75%] right-0 z-10 pt-4">
    <div class="flex flex-col gap-y-6 w-[75%]">
        <h1 class="mx-auto font-bold text-2xl pl-4">My Dashboard</h1>

    </div>
</section>
@endsection

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

