<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun</title>
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #ffffff;
        }
        .content {
            margin-top:10%;
            width: 80%;
            background-color: #F4F4F9;
            padding: 40px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-left:260px;
        }
        .content h1 {
            margin-bottom: 20px;
        }
        .user-settings {
            text-align: center;
            margin-bottom: 20px;
        }
        .user-settings img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            background-color: #ccc; /* Placeholder for empty image */
            display: block;
            margin: 0 auto;
        }
        .user-settings p {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }
        .user-settings button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .info {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            border: none;
            width: 95%;
        }
        .info-item {
            margin-bottom: 15px;
        }
        .info-item label {
            display: block;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }
        .info-item span {
            display: block;
            font-size: 16px;
            color: #555;
        }
        .button-container {
            display: flex;
            justify-content: flex-end;
        }
        .edit-btn {
            background-color: #fff;
            color: #333;
            padding: 10px 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
        }
        .edit-btn:hover {
            background-color: #4CAF50;
            color: white;
        }

        /* Media Query for smaller devices */
        @media (max-width: 1366px) {
            .content {
                width: 80%;
            margin-top: 25%;
            background-color: #F4F4F9;
            padding: 40px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-left:260px;
            }
        }

        @media (max-width: 480px) {
            .content h1 {
                font-size: 28px; /* Ukuran font lebih kecil untuk perangkat kecil */
            }

            .card-body {
                font-size: 16px; /* Ukuran font lebih kecil untuk perangkat kecil */
            }

            .year-filter button {
                padding: 8px 16px; /* Ukuran tombol lebih kecil untuk perangkat kecil */
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    @include('header-sidebar')

    <div class="content">
        <h1>Pengaturan Akun</h1>
        <div class="user-settings">
            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='50' stroke='%23ccc' stroke-width='2' fill='none' /%3E%3C/svg%3E" alt="User Avatar">
            <p>{{ Auth::user()->email }}</p>

            {{-- * LOG OUT BUTTON --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-btn">Log Out</button>
            </form>

        </div>
        <div class="info">
            <div class="info-item">
                <label for="username">Nama:</label>
                <span id="username">{{ Auth::user()->name }}</span>
            </div>
            <div class="info-item">
                <label for="nama_desa">Nama Desa:</label>
                <span id="nama_desa">Desa Curug Sangereng</span>
            </div>
            <div class="info-item">
                <label for="alamat_desa">Alamat Desa:</label>
                <span id="alamat_desa">Kecamatan Kelapa Dua, Kabupaten Tangerang, Banten, 15333.</span>
            </div>
            <div class="info-item">
                <label for="kontak_desa">Informasi Kontak Desa:</label>
                <span id="kontak_desa">081290943893</span>
            </div>
            <div class="button-container">
                <button type="button" class="edit-btn" onclick="window.location.href='/edit-pengaturan'">Edit</button>
            </div>
        </div>
    </div>
</body>
</html>
