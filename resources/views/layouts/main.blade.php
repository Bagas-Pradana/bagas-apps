<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <!-- Head -->
    @include('partials.header')
    <!-- end Head -->
    <!-- Style CSS -->
    @stack('style')
    <!-- End Style CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <!-- Navigation Panel -->
    @include('partials.navbar')
    <!-- End Navigation Panel -->
    <!-- Content -->
    @yield('content')
    <!-- end Content -->
    <!-- JavaScript -->
    @stack('script')
    <!-- End JavaScript -->
    <script>
    //     window.Swal = Swal; // Menyimpan Swal di window agar bisa diakses di seluruh proyek

    // document.addEventListener("DOMContentLoaded", function() {
    //     Swal.fire({
    //         title: "SweetAlert2 Berhasil!",
    //         text: "SweetAlert2 sudah berjalan dengan Vite!",
    //         icon: "success"
    //     });
    // });
    </script>
</body>

</html>
