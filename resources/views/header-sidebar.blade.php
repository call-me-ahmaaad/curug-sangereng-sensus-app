<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Menambahkan Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
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
        .header {
            width: 100%;
            background-color: #3C2D67;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0;
            box-sizing: border-box;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            height: 80px;
        }
        .header .logo-container {
            display: flex;
            align-items: center;
            position: relative;
            height: 100%;
            padding-left: 15px;
        }
        .header .rectangles {
            display: flex;
            align-items: center;
            position: relative;
            height: 100%;
        }
        .header .rectangles .rect {
            height: 100%;
            margin-left: -20px; /* Untuk tumpang tindih */
            border-radius: 0 25px 25px 0;
        }
        .header .rectangles .rect1 {
            background-color: #bcb3d7;
            width: 250px;
            z-index: 3;
        }
        .header .rectangles .rect2 {
            background-color: #8673ad;
            width: 200px;
            z-index: 2;
        }
        .header .rectangles .rect3 {
            background-color: #492780;
            width: 150px;
            z-index: 1;
        }
        .header img {
            height: 60px;
            margin-left: 20px; /* Tambahkan margin agar logo kiri tidak tumpang tindih */
        }
        .header .logo-left {
            height: 50px;
            margin-left: 100px;
            object-fit: cover;
            object-position: center;
            width: auto;
        }
        .header .logo-right {
            height: 50px;
            margin-right: 20px;
            object-fit: cover;
            object-position: center;
            width: auto;
        }

        .main {
            display: flex;
            margin-top: 80px;
            margin-left: 250px; /* Ensure main content starts after sidebar */
            height: calc(100vh - 80px);
            width: calc(100% - 250px); /* Adjust main content width */
            padding: 20px; /* Add padding to the main content */
        }

        .rect1 { position: relative; }
        .rect1-img {
            position: absolute;
            top: 50%;
            left: 35%;
            transform: translate(-50%, -50%);
            width: 185px
        }

        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, #492780, #4B778F);
            color: white;
            height: calc(100vh - 80px); /* Tinggi penuh dari .main dikurangi tinggi header */
            position: fixed;
            top: 80px; /* Sama dengan tinggi header */
            left: 0;
            box-sizing: border-box;
            border-top-right-radius: 50px; /* Sudut bundar atas kanan */
            border-bottom-right-radius: 50px; /* Sudut bundar bawah kanan */
            overflow-y: auto;
            box-shadow: 0 0 0 5px #2b1f53; /* Outline mengikuti bentuk sidebar */
            display: flex;
            flex-direction: column;
        }
        .profile {
            background-color: #3C2D67;
            padding: 20px;
            text-align: center;
            border-top-right-radius: 50px; /* Sudut bundar atas kanan */
        }
        .profile img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
        }
        .profile p {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: white;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            font-size: 16px;
            position: relative;
            border-left: 5px solid transparent;
            transition: all 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #b899db;
            border-left: 5px solid #fff;
        }
        .sidebar .active {
            background-color: #231a41;
            border-left: 5px solid #fff;
        }
        .sidebar .icon-circle {
            display: inline-block;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #231a41;
            margin-right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .sidebar .icon-circle i {
            color: white;
            font-size: 14px; /* Sesuaikan ukuran ikon */
        }
        .back-link {
            color: white;
            text-decoration: underline;
            margin: 10px;
            margin-top: auto;
            padding: 10px 15px;
        }
        .back-link:hover {
            background-color: transparent; /* Menghapus latar belakang hover */
            color: white; /* Menjaga warna tetap putih */
            text-decoration: underline; /* Garis bawah tetap ada */
        }
        .sidebar a.back-link:hover {
            background-color: transparent;
            color: white;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo-container">
            <div class="rectangles">
                <div class="rect rect1">
                    <img src="{{ asset('assets/logocurug2.png') }}" alt="Logo Left" class="rect1-img">

                </div>
                <div class="rect rect2"></div>
                <div class="rect rect3"></div>
            </div>

        </div>
        <img src="{{ asset('assets/logo pradit putih.png') }}" alt="Logo Right" class="logo-right">
    </div>

    <div class="main">
        <div class="sidebar">
            <div class="profile">
                <img src="{{ $profile_picture ?? 'https://via.placeholder.com/80x80/cccccc/000000?text=No+Image' }}" alt="{{ $profile_alt ?? 'foto profil' }}">
                <p>{{ $user['name'] ?? 'Admin Name' }}</p>
            </div>
            <a href="{{ route('warga.beranda') }}" class="{{ request()->routeIs('beranda') ? 'active' : '' }}">
                <span class="icon-circle"><i class="fas fa-home"></i></span>
                Beranda
            </a>
            <a href="{{ route('warga.unduh-data') }}" class="{{ request()->routeIs('unduh_data') ? 'active' : '' }}">
                <span class="icon-circle"><i class="fas fa-download"></i></span>
                Unduh Data
            </a>
            <a href="{{ route('warga.edit-index') }}" class="{{ request()->routeIs('edit_data') ? 'active' : '' }}">
                <span class="icon-circle"><i class="fas fa-edit"></i></span>
                Edit Data
            </a>
            <a href="{{ route('admin.profile') }}" class="{{ request()->routeIs('pengaturan') ? 'active' : '' }}">
                <span class="icon-circle"><i class="fas fa-cog"></i></span>
                Pengaturan
            </a>

            <a href="{{ url('/') }}" class="back-link">
                <span class="icon-circle"><i class="fas fa-sign-out-alt"></i></span>
                Kembali ke Web Utama
            </a>

        </div>

    </div>
</body>
</html>
