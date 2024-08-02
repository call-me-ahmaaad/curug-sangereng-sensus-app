<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konten Dashboard</title>
    <style>

    body {
    font-family: 'DM Sans', sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    height: 100vh;
    background-color: #ffffff;
}

.main {
    display: flex;
    margin-top: 80px;
    height: calc(100vh - 80px);
}

.content {
    margin-left: 260px;
    padding: 20px;
    flex: 1;
    height: 100%;
    overflow-y: auto;
    margin-top: 15px;
}

h1 {
    font-size: 36px;
    margin: 0;
    color: #333;
}

p {
    font-size: 18px;
    color: #555;
}

.download-container {
    display: flex;
    flex-direction: column;
    align-items: flex-start; /* Konten akan dimulai dari kiri */
    justify-content: flex-start; /* Konten akan mulai dari atas */
    height: 100%;
    margin-top: -720px; /* Memberi jarak dari header */
    margin-left: 260px; /* Memberi ruang untuk sidebar */
    padding: 0 20px; /* Memberikan padding horizontal */
}

.data-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: flex-start; /* Memastikan grid dimulai dari kiri */
    max-width: 100%; /* Mengatur lebar maksimum sesuai konten */
}

.data-item {
    background-color: #f8f8f8;
    border: 1px solid #ccc;
    border-radius: 8px;
    overflow: hidden;
    width: 200px; /* Lebar tetap untuk item */
    text-align: center;
    transition: transform 0.3s;
    margin-bottom: 20px; /* Jarak antar item secara vertikal */
}

.data-item:hover {
    transform: scale(1.05);
}

.data-link {
    color: inherit;
    text-decoration: none;
    display: block;
    padding: 10px;
}

.image-placeholder {
    height: 150px;
    background-color: #e0e0e0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.image-placeholder img {
    max-width: 100%;
    max-height: 100%;
}

h2 {
    font-size: 1.2em;
    margin: 10px 0;
}

/* Media Query for smaller devices */
@media (max-width: 1920px) {
            .main {
                margin-left: 250px; /* Tetap menjaga margin kiri karena sidebar masih dapat ditampilkan */
            }

            .content {

                padding: 10px;
            }

            .download-container {
                margin-top: -400px;
            }
        }

        @media (max-width: 480px) {
            .card-body {
                font-size: 20px;
            }
        }

    </style>

<script>
    // Function to check screen width and show a warning if on mobile
    function checkScreenWidth() {
        const screenWidth = window.innerWidth;
        const mobileWarning = document.getElementById('mobileWarning');

        // Check if the screen width is less than 768px
        if (screenWidth < 768) {
            mobileWarning.style.display = 'flex'; // Show the warning
        } else {
            mobileWarning.style.display = 'none'; // Hide the warning
        }
    }

    // Run the function on page load and when the window is resized
    window.addEventListener('load', checkScreenWidth);
    window.addEventListener('resize', checkScreenWidth);
</script>
</head>

<body>
    @include('header-sidebar')
    <div class="container download-container">
        <h1>Download Data</h1>
        <p>Silahkan Memilih Data yang ingin Di Download</p>
        <h2>Data Sensus Keluarga</h2>
        <div class="row data-grid">
            @foreach($tahunData_keluarga as $tahun_keluarga)
                <div class="col-md-4 data-item">
                    <a href="{{ route('keluarga.export', $tahun_keluarga) }}" class="data-link">
                        <div class="image-placeholder">
                            <img src="{{ URL::asset('/assets/excel.png') }}" alt="Data {{ $tahun_keluarga }}" width="80px">
                        </div>
                        <h2>Tahun {{ $tahun_keluarga }}</h2>
                        <p>Data Keluarga Tahun {{ $tahun_keluarga }} rentang Bulan Januari - Desember</p>
                    </a>
                </div>
            @endforeach
        </div>
        <h2>Data Sensus Warga</h2>
        <div class="row data-grid">
            @foreach($tahunData_warga as $tahun_warga)
                <div class="col-md-4 data-item">
                    <a href="{{ route('warga.export', $tahun_warga) }}" class="data-link">
                        <div class="image-placeholder">
                            <img src="{{ URL::asset('/assets/excel.png') }}" alt="Data {{ $tahun_warga }}" width="80px">
                        </div>
                        <h2>Tahun {{ $tahun_warga }}</h2>
                        <p>Data Penduduk Tahun {{ $tahun_warga }} rentang Bulan Januari - Desember</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Mobile Warning Overlay -->
    <div id="mobileWarning">
        Mohon buka website ini menggunakan laptop atau komputer agar lebih kompatibel.
    </div>

</body>

</html>
