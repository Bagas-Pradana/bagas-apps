@extends('layouts.main')

@section('title', 'Home Page')

@section('content')
<div class="flex flex-col mt-4">
    <h1 class="text-orange-300 text-4xl font-bold">Welcome Home</h1>
    <h1 class="text-orange-300 text-4xl font-bold">Test Main Section</h1>
</div>
@endsection

@if(session('logoutMessage'))
    @push('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof Swal !== 'undefined') {
                let logoutMessage = {!! json_encode(session('logoutMessage'), JSON_HEX_TAG) !!};

                if (logoutMessage) {
                    sessionStorage.setItem('logoutMessage', logoutMessage);
                }

                let storedMessage = sessionStorage.getItem('logoutMessage');
                if (storedMessage) {
                    Swal.fire({
                        title: "Logout Berhasil!",
                        text: storedMessage,
                        icon: "info"
                    });

                    // Hapus pesan agar tidak muncul lagi setelah refresh
                    sessionStorage.removeItem('logoutMessage');
                }
            } else {
                console.error("SweetAlert2 belum termuat.");
            }
        });
    </script>
    @endpush
@endif

