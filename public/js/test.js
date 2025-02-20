// alert("yuhuu");
document.addEventListener('DOMContentLoaded', function () {
    // Popup utama
    const popupButton = document.getElementById('popup-button');
    const showPopup = document.getElementById('showPopup');
    const closeButton = document.getElementById('close-button');

    function showPost() {
        showPopup.classList.remove('hidden');
    }
    function hidePost() {
        showPopup.classList.add('hidden');
    }
    popupButton.addEventListener('click', showPost);
    closeButton.addEventListener('click', hidePost);

    // Popup Dinamis
    const popupButtons = document.querySelectorAll('.popup-button2');
    const showPopup2 = document.getElementById('showPopup2');
    const popupContent = document.getElementById('popup-content');
    const closeButton2 = document.getElementById('close-button2');

    popupButtons.forEach(button => {
        button.addEventListener('click', function () {
            const slug = this.getAttribute('data-slug');

            fetch(`/post/${slug}`)
                .then(response => response.json())
                .then(data => {
                    // Update isi popup
                    popupContent.querySelector('#judul').innerHTML = data.judul;
                    document.getElementById('sub-judul').classList.remove('hidden');
                    document.getElementById('link-author').setAttribute('href', `/listuser/${data.author.username}`);
                    document.getElementById('link-author').innerHTML = data.author.name;
                    document.getElementById('link-category').setAttribute('href', `/listuser/${data.category.slug}`);
                    document.getElementById('link-category').innerHTML = data.category.nama_kategory;

                    // Periksa gambar
                    if (data.images) {
                        document.getElementById('image-user').setAttribute('src', `/storage/${data.images}`);
                        document.getElementById('image-user').classList.remove('hidden');
                        document.getElementById('image-default').classList.add('hidden');
                    } else {
                        document.getElementById('image-default').setAttribute('src', `https://fastly.picsum.photos/id/276/300/200.jpg?hmac=PqQb3_Pue9TG1kb_XmcM0QBEE88fpxbskzQbUhWZqv4`);
                        document.getElementById('image-default').classList.remove('hidden');
                        document.getElementById('image-user').classList.add('hidden');
                    }

                    document.getElementById('body-postingan').innerHTML = data.body;

                    // Ambil tombol like dan set atribut ID postingan
                    const tombolLike = document.getElementById('tombol-like');
                    tombolLike.setAttribute('data-id', data.id);
                    tombolLike.classList.remove('hidden'); // Tampilkan tombol jika sebelumnya disembunyikan

                    // Ambil elemen like-count di dalam tombol like
                    const likeCountElement = tombolLike.querySelector('#like-count');
                    console.log('🧐 Elemen like-count:', likeCountElement);

                    if (!likeCountElement) {
                        console.error('❌ Error: Elemen #like-count tidak ditemukan dalam tombol like.');
                        return;
                    }

                    // Ambil jumlah like dari server
                    fetch(`/get-likes/${data.id}`, {
                        headers: {
                            'Accept': 'application/json' // Pastikan server mengembalikan JSON, bukan HTML
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! Status: ${response.status}`);
                        }
                        return response.json(); // Pastikan hanya memproses JSON
                    })
                    .then(likeData => {
                        console.log('✅ Data Like:', likeData);
                        likeCountElement.textContent = likeData.likes ?? 0;
                    })
                    .catch(error => console.error('❌ Error mengambil jumlah like:', error));

                    // Tampilkan popup
                    showPopup2.classList.remove('hidden');
                })
                .catch(error => console.error('❌ Error:', error));
        });
    });

    // Tutup popup
    closeButton2.addEventListener('click', function () {
        showPopup2.classList.add('hidden');
    });

    // Event delegation untuk tombol like (baik di halaman utama maupun dalam popup)
    document.addEventListener('click', function (event) {
        let button = event.target.closest('#tombol-like, .like-button2');
        if (!button) return;

        let postId = button.getAttribute('data-id');
        let likeCountElement = button.querySelector('#like-count, .like-count2');

        if (!likeCountElement) {
            console.error('❌ Error: Elemen #like-count tidak ditemukan di dalam tombol like.');
            return;
        }

        // Cek apakah user sudah login
        let isAuthenticated = document.querySelector('meta[name="is-authenticated"]').getAttribute('content');

        if (isAuthenticated === "false") {
            Swal.fire({
                title: "Akses Ditolak!",
                text: "Anda harus login terlebih dahulu.",
                icon: "error",
                confirmButtonText: "OK",
                customClass: {
                    popup: 'custom-swal-popup'
                }
            }).then(() => {
                window.location.href = '/login'; // Redirect setelah OK ditekan
            });
            return; // Hentikan eksekusi jika belum login
        }

        fetch(`/like/${postId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log('✅ Response dari server:', data);

            if (data.message === 'Berhasil like' || data.message === 'Unlike berhasil') {
                likeCountElement.textContent = data.likes ?? 0;
            }
        })
        .catch(error => console.error('❌ Error:', error));
    });
});
