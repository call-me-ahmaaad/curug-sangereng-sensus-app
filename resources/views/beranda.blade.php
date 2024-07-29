<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konten Dashboard</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .sidebar {
            position: fixed;
            z-index: 10;
            width: 250px;
            top: 80px;
            bottom: 0;
        }

        .main {
            margin-left: 250px;
            flex: 1;
            display: flex;
            flex-direction: column;
            height: calc(100vh - 80px);
            margin-top: 0; /* Adjusted margin-top */
        }

        .content {
            padding: 10px;
            flex: 1;
        }

        .content h1 {
            margin-top: 0; /* Ensure no top margin */
            padding-top: 0; /* Ensure no top padding */
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            width: 100%;
            margin-top: 20px;
        }

        .card {
            background-color: #B196D0;
            border-radius: 5px;
            box-shadow: 0 2px 4px #481A7D;
            flex: 1 1 calc(33% - 20px);
            margin: 10px;
            text-align: center;
            min-width: 250px;
        }

        .card-header {
            padding: 10px;
            font-weight: bold;
        }

        .card-body {
            padding: 15px 0;
            font-size: 24px;
        }

        .card-body-number {
            color: #333;
        }

        .content-wrapper {
            display: flex;
            flex-direction: column;
            margin-top: 20px;
        }

        #container {
            width: 100%;
            height: 650px;
            margin: 0 auto;
        }

        /* Media Query for smaller devices */
        @media (max-width: 1920px) {
            .main {
                margin-left: 250px; /* Tetap menjaga margin kiri karena sidebar masih dapat ditampilkan */
            }

            .content {
                margin-top: -100px;
                padding: 10px;
            }

            .card {
                flex: 1 1 calc(33.333% - 20px); /* Membuat kartu tetap sejajar dalam satu baris */
            }
        }

        @media (max-width: 480px) {
            .card-body {
                font-size: 20px;
            }
        }

        /* Styling for the mobile warning overlay */
        #mobileWarning {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            z-index: 1000;
            padding: 20px;
            box-sizing: border-box;
            text-align: center;
        }
    </style>
    <script src="https://code.highcharts.com/highcharts.js"></script>
</head>

<body>



    @include('header-sidebar')

    <div class="main">
        <div class="content">
            <h1>Dashboard</h1>

            <div class="card-container">
                <div class="card">
                    <div class="card-header">
                        <p>Jumlah Warga Terdaftar</p>
                    </div>
                    <div class="card-body">
                        <span class="card-body-number">{{ $jumlah_warga ?? '000' }}</span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <p>Jumlah Laki-laki</p>
                    </div>
                    <div class="card-body">
                        <span class="card-body-number">{{ $pengunjung_bulan_ini ?? '000' }}</span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <p>Jumlah perempuan</p>
                    </div>
                    <div class="card-body">
                        <span class="card-body-number">{{ $pengunjung_hari_ini ?? '000' }}</span>
                    </div>
                </div>
            </div>

            <div class="content-wrapper">
                <div id="container"></div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Highcharts.chart('container', {
                        chart: {
                            type: 'bar'
                        },
                        title: {
                            text: 'Ferry passengers by vehicle type 2024'
                        },
                        xAxis: {
                            categories: [
                                'January', 'February', 'March', 'April', 'May'
                            ]
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: ''
                            }
                        },
                        legend: {
                            reversed: true
                        },
                        plotOptions: {
                            series: {
                                stacking: 'normal',
                                dataLabels: {
                                    enabled: true
                                }
                            }
                        },
                        series: [{
                            name: 'Motorcycles',
                            data: [74, 27, 52, 93, 1272]
                        }, {
                            name: 'Null-emission vehicles',
                            data: [2106, 2398, 3046, 3195, 4916]
                        }, {
                            name: 'Conventional vehicles',
                            data: [12213, 12721, 15242, 16518, 25037]
                        }]
                    });
                });
            </script>
        </div>
    </div>

</body>
</html>
