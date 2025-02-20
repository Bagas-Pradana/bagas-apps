<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <!-- Head -->
    @include('partials.header')
    <!-- end Head -->
    <!-- Style CSS -->
    @stack('style')
    <!-- TRix Editor -->
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <!-- End Style CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Perbaikan: Pindahkan CSS ke dalam <style> -->
    <style>
        .trix-button[data-trix-action="attachFiles"] {
            display: none !important;
        }
    </style>
</head>

<body>
    <!-- Navigation Panel -->
    @include('dashboard.layouts.menu')
    <!-- End Navigation Panel -->
    <!-- Content -->
    @yield('dash-content')
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
