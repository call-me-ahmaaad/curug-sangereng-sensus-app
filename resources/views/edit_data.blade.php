<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            margin: 0;
            padding: 0;
        }
        .content {
            margin-top: -100px;
            margin-left: 260px; /* Adjust to sidebar width */
            padding: 0px;
            max-width: calc(100% - 260px); /* Adjust to sidebar width */
            flex: 1;
            overflow-y: auto;
        }

        .content h1 {
            font-size: 36px;
            margin-bottom: 100px;
        }

        .year-filter {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .year-filter button {
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            background-color: #e0e0e0;
            transition: background-color 0.3s ease;
        }

        .year-filter button.active,
        .year-filter button:hover {
            background-color: #4A3F91;
            color: white;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #4CAF50;
            padding: 10px;
            text-align: left;
        }

        .data-table th {
            background-color: #4CAF50;
            color: white;
        }

        .data-table td {
            background-color: #E8F5E9;
        }

        .add-data-button {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .add-data-button button {
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            background-color: #4A3F91;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: background-color 0.3s ease;
        }

        .add-data-button button:hover {
            background-color: #3b2e75;
        }

        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pagination .page-numbers {
            display: flex;
            gap: 5px;
        }

        .pagination button {
            padding: 5px 10px;
            border: none;
            background-color: #e0e0e0;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .pagination button.active,
        .pagination button:hover {
            background-color: #4A3F91;
            color: white;
        }

        @media (max-width: 1920px) {
            .main {
                margin-top: 0;
                margin-left: 0;
            }

            .content {
                margin-left: 0;
                max-width: 100%;
                padding: 10px;
                overflow-y: auto;
            }
        }

        @media (max-width: 480px) {
            .content h1 {
                font-size: 28px;
            }

            .year-filter button {
                padding: 8px 16px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

@include('header-sidebar')

<div class="main">
    <div class="content">
        <h1>Edit Data</h1>

        <div class="year-filter">
            <button class="active">2016</button>
            <button>2017</button>
            <button>2018</button>
            <button>2019</button>
            <button>2020</button>
            <button>2021</button>
            <button>2022</button>
        </div>

        <table id="sensusTable" class="table">
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Akta Lahir</th>
                    <th>KK</th>
                    <th>Nama</th>
                    <th>Kepunyaan KTP</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>Golongan Darah</th>
                    <th>Pendidikan</th>
                    <th>Pekerjaan</th>
                    <th>Status Nikah</th>
                    <th>Status Keluarga</th>
                    <th>Kewarganegaraan</th>
                    <th>Nama Ibu</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>NIK</td>
                    <td>Akta Lahir</td>
                    <td>KK</td>
                    <td>Nama</td>
                    <td>Kepunyaan KTP</td>
                    <td>Tempat Lahir</td>
                    <td>Tanggal Lahir</td>
                    <td>Jenis Kelamin</td>
                    <td>Agama</td>
                    <td>Golongan Darah</td>
                    <td>Pendidikan</td>
                    <td>Pekerjaan</td>
                    <td>Status Nikah</td>
                    <td>Status Keluarga</td>
                    <td>Kewarganegaraan</td>
                    <td>Nama Ibu</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>Akta Lahir</td>
                    <td>KK</td>
                    <td>Nama</td>
                    <td>Kepunyaan KTP</td>
                    <td>Tempat Lahir</td>
                    <td>Tanggal Lahir</td>
                    <td>Jenis Kelamin</td>
                    <td>Agama</td>
                    <td>Golongan Darah</td>
                    <td>Pendidikan</td>
                    <td>Pekerjaan</td>
                    <td>Status Nikah</td>
                    <td>Status Keluarga</td>
                    <td>Kewarganegaraan</td>
                    <td>Nama Ibu</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>Akta Lahir</td>
                    <td>KK</td>
                    <td>Nama</td>
                    <td>Kepunyaan KTP</td>
                    <td>Tempat Lahir</td>
                    <td>Tanggal Lahir</td>
                    <td>Jenis Kelamin</td>
                    <td>Agama</td>
                    <td>Golongan Darah</td>
                    <td>Pendidikan</td>
                    <td>Pekerjaan</td>
                    <td>Status Nikah</td>
                    <td>Status Keluarga</td>
                    <td>Kewarganegaraan</td>
                    <td>Nama Ibu</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>Akta Lahir</td>
                    <td>KK</td>
                    <td>Nama</td>
                    <td>Kepunyaan KTP</td>
                    <td>Tempat Lahir</td>
                    <td>Tanggal Lahir</td>
                    <td>Jenis Kelamin</td>
                    <td>Agama</td>
                    <td>Golongan Darah</td>
                    <td>Pendidikan</td>
                    <td>Pekerjaan</td>
                    <td>Status Nikah</td>
                    <td>Status Keluarga</td>
                    <td>Kewarganegaraan</td>
                    <td>Nama Ibu</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>Akta Lahir</td>
                    <td>KK</td>
                    <td>Nama</td>
                    <td>Kepunyaan KTP</td>
                    <td>Tempat Lahir</td>
                    <td>Tanggal Lahir</td>
                    <td>Jenis Kelamin</td>
                    <td>Agama</td>
                    <td>Golongan Darah</td>
                    <td>Pendidikan</td>
                    <td>Pekerjaan</td>
                    <td>Status Nikah</td>
                    <td>Status Keluarga</td>
                    <td>Kewarganegaraan</td>
                    <td>Nama Ibu</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>Akta Lahir</td>
                    <td>KK</td>
                    <td>Nama</td>
                    <td>Kepunyaan KTP</td>
                    <td>Tempat Lahir</td>
                    <td>Tanggal Lahir</td>
                    <td>Jenis Kelamin</td>
                    <td>Agama</td>
                    <td>Golongan Darah</td>
                    <td>Pendidikan</td>
                    <td>Pekerjaan</td>
                    <td>Status Nikah</td>
                    <td>Status Keluarga</td>
                    <td>Kewarganegaraan</td>
                    <td>Nama Ibu</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>Akta Lahir</td>
                    <td>KK</td>
                    <td>Nama</td>
                    <td>Kepunyaan KTP</td>
                    <td>Tempat Lahir</td>
                    <td>Tanggal Lahir</td>
                    <td>Jenis Kelamin</td>
                    <td>Agama</td>
                    <td>Golongan Darah</td>
                    <td>Pendidikan</td>
                    <td>Pekerjaan</td>
                    <td>Status Nikah</td>
                    <td>Status Keluarga</td>
                    <td>Kewarganegaraan</td>
                    <td>Nama Ibu</td>
                </tr>
            </tbody>
        </table>
        <script>
            $(document).ready(function() {
                $('#sensusTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "pageLength": 25, // Set the number of entries per page
                    "lengthChange": false
                });
            });
        </script>

        <div class="add-data-button">
            <button onclick="location.href='tambah-data'">
                <svg width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                Tambah Data Baru
            </button>
        </div>
    </div>
</div>

</body>
</html>
