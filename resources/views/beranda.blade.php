<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konten Dashboard</title>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body,
        html {
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
            margin-top: 0;
            /* Adjusted margin-top */
        }

        .content {
            padding: 10px;
            flex: 1;
        }

        .content h1 {
            margin-top: 0;
            /* Ensure no top margin */
            padding-top: 0;
            /* Ensure no top padding */
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
                margin-left: 250px;
                /* Tetap menjaga margin kiri karena sidebar masih dapat ditampilkan */
            }

            .content {
                margin-top: -100px;
                padding: 10px;
            }

            .card {
                flex: 1 1 calc(33.333% - 20px);
                /* Membuat kartu tetap sejajar dalam satu baris */
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
                        <span id="total_warga" class="card-body-number"></span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <p>Jumlah Laki-laki</p>
                    </div>
                    <div class="card-body">
                        <span id="total_lakiLaki" class="card-body-number"></span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <p>Jumlah perempuan</p>
                    </div>
                    <div class="card-body">
                        <span id="total_perempuan" class="card-body-number"></span>
                    </div>
                </div>
            </div>

            <h1>Grafik Gender</h1>
            <div id="genderChart" style="width:100%; height:400px;"></div>
            <div id="genderChartByRW" style="width:100%; height:400px;"></div>

            <h1>Grafik Umur Warga Laki-laki</h1>
            <div id="umurLakiChart" style="width:100%; height:400px;"></div>
            <div id="umurLakiChartByRW" style="width:100%; height:400px;"></div>

            <h1>Grafik Umur Warga Perempuan</h1>
            <div id="umurPerempuanChart" style="width:100%; height:400px;"></div>
            <div id="umurPerempuanChartByRW" style="width:100%; height:400px;"></div>

            <h1>Grafik Kepemilikan Akta Lahir</h1>
            <div id="aktaLahirChart" style="width:100%; height:400px;"></div>
            <div id="aktaLahirChartByRW" style="width:100%; height:400px;"></div>

            <h1>Grafik Kepemilikan KTP</h1>
            <div id="ktpChart" style="width:100%; height:400px;"></div>
            <div id="ktpChartByRW" style="width:100%; height:400px;"></div>

            <h1>Grafik Status JKN</h1>
            <div id="jknChart" style="width:100%; height:400px;"></div>
            <div id="jknChartByRW" style="width:100%; height:400px;"></div>

            <h1>Grafik Penerima PKH</h1>
            <div id="pkhChart" style="width:100%; height:400px;"></div>
            <div id="pkhChartByRW" style="width:100%; height:400px;"></div>

            {{-- * JavaScript --}}
            {{-- Grafik Gender --}}
            <script>
                $(document).ready(function() {
                    $.getJSON('{{ route('grafik.gender') }}', function(response) {
                        var dataPerRW = response.dataPerRW;
                        var totalLakiLaki = response.totalLakiLaki;
                        var totalPerempuan = response.totalPerempuan;

                        console.log(dataPerRW); // Log the data for debugging

                        var rwCategories = [];
                        var lakiLaki = [];
                        var perempuan = [];

                        for (var i = 0; i < dataPerRW.length; i++) {
                            rwCategories.push(dataPerRW[i].rw);
                            lakiLaki.push(parseInt(dataPerRW[i].laki_laki));
                            perempuan.push(parseInt(dataPerRW[i].perempuan));
                        }

                        console.log('RW Categories:', rwCategories); // Log categories
                        console.log('Laki-laki:', lakiLaki); // Log Laki-laki
                        console.log('Perempuan:', perempuan); // Log Perempuan

                        // Grafik Kolom
                        Highcharts.chart('genderChartByRW', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Jumlah Warga Berdasarkan Gender per RW'
                            },
                            tooltip: {
                                valueSuffix: ' Orang'
                            },
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.y} Orang', // Tampilkan nilai asli
                                        style: {
                                            fontSize: '13px', // Ukuran font bisa disesuaikan
                                            fontWeight: 'bold' // Bisa ditambah ketebalan font
                                        }
                                    }
                                }
                            },
                            xAxis: {
                                categories: rwCategories,
                                title: {
                                    text: 'RW'
                                }
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'Jumlah Warga'
                                }
                            },
                            series: [{
                                name: 'Laki-laki',
                                data: lakiLaki
                            }, {
                                name: 'Perempuan',
                                data: perempuan
                            }]
                        });

                        // Grafik Pie
                        Highcharts.chart('genderChart', {
                            chart: {
                                type: 'pie'
                            },
                            title: {
                                text: 'Perbandingan Jumlah Laki-laki dan Perempuan'
                            },
                            tooltip: {
                                valueSuffix: ' Orang'
                            },
                            plotOptions: {
                                series: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    dataLabels: [{
                                        enabled: true,
                                        distance: 20
                                    }, {
                                        enabled: true,
                                        distance: -40,
                                        format: '{point.percentage:.1f}%',
                                        style: {
                                            fontSize: '1.2em',
                                            textOutline: 'none',
                                            opacity: 0.7
                                        },
                                        filter: {
                                            operator: '>',
                                            property: 'percentage',
                                            value: 10
                                        }
                                    }]
                                }
                            },
                            series: [{
                                name: 'Jumlah',
                                data: [{
                                        name: 'Laki-laki',
                                        y: totalLakiLaki
                                    },
                                    {
                                        name: 'Perempuan',
                                        y: totalPerempuan
                                    }
                                ]
                            }]
                        });
                    });
                });
            </script>

            {{-- Grafik Umur Laki-laki --}}
            <script>
                $(document).ready(function() {
                    $.getJSON('{{ route('grafik.umur_laki') }}', function(response) {
                        var dataPerRW = response.dataPerRW;
                        var totalAgeGroup0_17 = response.totalAgeGroup_0_17;
                        var totalAgeGroup18_35 = response.totalAgeGroup_18_35;
                        var totalAgeGroup36_55 = response.totalAgeGroup_36_55;
                        var totalAgeGroup56Above = response.totalAgeGroup_56_Above;

                        console.log(dataPerRW); // Log the data for debugging

                        var rwCategories = [];
                        var ageGroup0_17 = [];
                        var ageGroup18_35 = [];
                        var ageGroup36_55 = [];
                        var ageGroup56Above = [];

                        for (var i = 0; i < dataPerRW.length; i++) {
                            rwCategories.push(dataPerRW[i].rw);
                            ageGroup0_17.push(parseInt(dataPerRW[i].age_group_0_17));
                            ageGroup18_35.push(parseInt(dataPerRW[i].age_group_18_35));
                            ageGroup36_55.push(parseInt(dataPerRW[i].age_group_36_55));
                            ageGroup56Above.push(parseInt(dataPerRW[i].age_group_56_above));
                        }

                        console.log('RW Categories:', rwCategories); // Log categories
                        console.log('Age Group 0-17:', ageGroup0_17); // Log age group 0-17
                        console.log('Age Group 18-35:', ageGroup18_35); // Log age group 18-35
                        console.log('Age Group 36-55:', ageGroup36_55); // Log age group 36-55
                        console.log('Age Group 56 Above:', ageGroup56Above); // Log age group 56 above

                        // Grafik Kolom
                        Highcharts.chart('umurLakiChartByRW', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Perbandingan Umur Warga Jenis Kelamin Laki-laki per RW'
                            },
                            tooltip: {
                                valueSuffix: ' Orang'
                            },
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.y} Orang', // Tampilkan nilai asli
                                        style: {
                                            fontSize: '13px', // Ukuran font bisa disesuaikan
                                            fontWeight: 'bold' // Bisa ditambah ketebalan font
                                        }
                                    }
                                }
                            },
                            xAxis: {
                                categories: rwCategories,
                                title: {
                                    text: 'RW'
                                }
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'Jumlah Warga'
                                }
                            },
                            series: [{
                                name: '0 - 17 Tahun',
                                data: ageGroup0_17
                            }, {
                                name: '18 - 35 Tahun',
                                data: ageGroup18_35
                            }, {
                                name: '36 - 55 Tahun',
                                data: ageGroup36_55
                            }, {
                                name: '56 Tahun Lebih',
                                data: ageGroup56Above
                            }]
                        });

                        // Grafik Pie
                        Highcharts.chart('umurLakiChart', {
                            chart: {
                                type: 'pie'
                            },
                            title: {
                                text: 'Perbandingan Umur Warga Laki-laki'
                            },
                            tooltip: {
                                valueSuffix: ' Orang'
                            },
                            plotOptions: {
                                series: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    dataLabels: [{
                                        enabled: true,
                                        distance: 20
                                    }, {
                                        enabled: true,
                                        distance: -40,
                                        format: '{point.percentage:.1f}%',
                                        style: {
                                            fontSize: '1.2em',
                                            textOutline: 'none',
                                            opacity: 0.7
                                        },
                                        filter: {
                                            operator: '>',
                                            property: 'percentage',
                                            value: 10
                                        }
                                    }]
                                }
                            },
                            series: [{
                                name: 'Jumlah',
                                data: [{
                                        name: '0 - 17 Tahun',
                                        y: totalAgeGroup0_17
                                    },
                                    {
                                        name: '18 - 35 Tahun',
                                        y: totalAgeGroup18_35
                                    },
                                    {
                                        name: '36 - 55 Tahun',
                                        y: totalAgeGroup36_55
                                    },
                                    {
                                        name: '55 Tahun Lebih',
                                        y: totalAgeGroup56Above
                                    }
                                ]
                            }]
                        });
                    });
                });
            </script>

            {{-- Grafik Umur Perempuan --}}
            <script>
                $(document).ready(function() {
                    $.getJSON('{{ route('grafik.umur_perempuan') }}', function(response) {
                        var dataPerRW = response.dataPerRW;
                        var totalAgeGroup0_17 = response.totalAgeGroup_0_17;
                        var totalAgeGroup18_35 = response.totalAgeGroup_18_35;
                        var totalAgeGroup36_55 = response.totalAgeGroup_36_55;
                        var totalAgeGroup56Above = response.totalAgeGroup_56_Above;

                        console.log(dataPerRW); // Log the data for debugging

                        var rwCategories = [];
                        var ageGroup0_17 = [];
                        var ageGroup18_35 = [];
                        var ageGroup36_55 = [];
                        var ageGroup56Above = [];

                        for (var i = 0; i < dataPerRW.length; i++) {
                            rwCategories.push(dataPerRW[i].rw);
                            ageGroup0_17.push(parseInt(dataPerRW[i].age_group_0_17));
                            ageGroup18_35.push(parseInt(dataPerRW[i].age_group_18_35));
                            ageGroup36_55.push(parseInt(dataPerRW[i].age_group_36_55));
                            ageGroup56Above.push(parseInt(dataPerRW[i].age_group_56_above));
                        }

                        console.log('RW Categories:', rwCategories); // Log categories
                        console.log('Age Group 0-17:', ageGroup0_17); // Log age group 0-17
                        console.log('Age Group 18-35:', ageGroup18_35); // Log age group 18-35
                        console.log('Age Group 36-55:', ageGroup36_55); // Log age group 36-55
                        console.log('Age Group 56 Above:', ageGroup56Above); // Log age group 56 above

                        // Grafik Kolom
                        Highcharts.chart('umurPerempuanChartByRW', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Perbandingan Umur Warga Jenis Kelamin Laki-laki per RW'
                            },
                            tooltip: {
                                valueSuffix: ' Orang'
                            },
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.y} Orang', // Tampilkan nilai asli
                                        style: {
                                            fontSize: '13px', // Ukuran font bisa disesuaikan
                                            fontWeight: 'bold' // Bisa ditambah ketebalan font
                                        }
                                    }
                                }
                            },
                            xAxis: {
                                categories: rwCategories,
                                title: {
                                    text: 'RW'
                                }
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'Jumlah Warga'
                                }
                            },
                            series: [{
                                name: '0 - 17 Tahun',
                                data: ageGroup0_17
                            }, {
                                name: '18 - 35 Tahun',
                                data: ageGroup18_35
                            }, {
                                name: '36 - 55 Tahun',
                                data: ageGroup36_55
                            }, {
                                name: '56 Tahun Lebih',
                                data: ageGroup56Above
                            }]
                        });

                        // Grafik Pie
                        Highcharts.chart('umurPerempuanChart', {
                            chart: {
                                type: 'pie'
                            },
                            title: {
                                text: 'Perbandingan Umur Warga Laki-laki'
                            },
                            tooltip: {
                                valueSuffix: ' Orang'
                            },
                            plotOptions: {
                                series: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    dataLabels: [{
                                        enabled: true,
                                        distance: 20
                                    }, {
                                        enabled: true,
                                        distance: -40,
                                        format: '{point.percentage:.1f}%',
                                        style: {
                                            fontSize: '1.2em',
                                            textOutline: 'none',
                                            opacity: 0.7
                                        },
                                        filter: {
                                            operator: '>',
                                            property: 'percentage',
                                            value: 10
                                        }
                                    }]
                                }
                            },
                            series: [{
                                name: 'Jumlah',
                                data: [{
                                        name: '0 - 17 Tahun',
                                        y: totalAgeGroup0_17
                                    },
                                    {
                                        name: '18 - 35 Tahun',
                                        y: totalAgeGroup18_35
                                    },
                                    {
                                        name: '36 - 55 Tahun',
                                        y: totalAgeGroup36_55
                                    },
                                    {
                                        name: '55 Tahun Lebih',
                                        y: totalAgeGroup56Above
                                    }
                                ]
                            }]
                        });
                    });
                });
            </script>

            {{-- Grafik Akta Lahir --}}
            <script>
                $(document).ready(function() {
                    $.getJSON('{{ route('grafik.akta_lahir') }}', function(response) {
                        var dataPerRW = response.dataPerRW;
                        var totalWithCertificate = response.totalWithCertificate;
                        var totalWithoutCertificate = response.totalWithoutCertificate;

                        console.log(dataPerRW); // Log the data for debugging

                        var rwCategories = [];
                        var withCertificate = [];
                        var withoutCertificate = [];

                        for (var i = 0; i < dataPerRW.length; i++) {
                            rwCategories.push(dataPerRW[i].rw);
                            withCertificate.push(parseInt(dataPerRW[i].with_certificate));
                            withoutCertificate.push(parseInt(dataPerRW[i].without_certificate));
                        }

                        console.log('RW Categories:', rwCategories); // Log categories
                        console.log('Punya Akta Lahir:', withCertificate); // Log Laki-laki
                        console.log('Tidak Punya Akta Lahir:', withoutCertificate); // Log Perempuan

                        // Grafik Kolom
                        Highcharts.chart('aktaLahirChartByRW', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Jumlah Status Kepemilikan Akta Lahir per RW'
                            },
                            tooltip: {
                                valueSuffix: ' Orang'
                            },
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.y} Orang', // Tampilkan nilai asli
                                        style: {
                                            fontSize: '13px', // Ukuran font bisa disesuaikan
                                            fontWeight: 'bold' // Bisa ditambah ketebalan font
                                        }
                                    }
                                }
                            },
                            xAxis: {
                                categories: rwCategories,
                                title: {
                                    text: 'RW'
                                }
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'Jumlah Warga'
                                }
                            },
                            series: [{
                                name: 'Memiliki',
                                data: withCertificate
                            }, {
                                name: 'Tidak Memiliki',
                                data: withoutCertificate
                            }]
                        });

                        // Grafik Pie
                        Highcharts.chart('aktaLahirChart', {
                            chart: {
                                type: 'pie'
                            },
                            title: {
                                text: 'Perbandingan Status Kepemilikan Akta Lahir'
                            },
                            tooltip: {
                                valueSuffix: ' Orang'
                            },
                            plotOptions: {
                                series: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    dataLabels: [{
                                        enabled: true,
                                        distance: 20
                                    }, {
                                        enabled: true,
                                        distance: -40,
                                        format: '{point.percentage:.1f}%',
                                        style: {
                                            fontSize: '1.2em',
                                            textOutline: 'none',
                                            opacity: 0.7
                                        },
                                        filter: {
                                            operator: '>',
                                            property: 'percentage',
                                            value: 10
                                        }
                                    }]
                                }
                            },
                            series: [{
                                name: 'Jumlah',
                                data: [{
                                        name: 'Memiliki',
                                        y: totalWithCertificate
                                    },
                                    {
                                        name: 'Tidak Memiliki',
                                        y: totalWithoutCertificate
                                    }
                                ]
                            }]
                        });
                    });
                });
            </script>

            {{-- Grafik KTP --}}
            <script>
                $(document).ready(function() {
                    $.getJSON('{{ route('grafik.ktp') }}', function(response) {
                        var dataPerRW = response.dataPerRW;
                        var totalWithKtp = response.totalWithKtp;
                        var totalWithoutKtp = response.totalWithoutKtp;

                        console.log(dataPerRW); // Log the data for debugging

                        var rwCategories = [];
                        var withKtp = [];
                        var withoutKtp = [];

                        for (var i = 0; i < dataPerRW.length; i++) {
                            rwCategories.push(dataPerRW[i].rw);
                            withKtp.push(parseInt(dataPerRW[i].with_ktp));
                            withoutKtp.push(parseInt(dataPerRW[i].without_ktp));
                        }

                        console.log('RW Categories:', rwCategories); // Log categories
                        console.log('Punya KTP:', withKtp); // Log Laki-laki
                        console.log('Tidak Punya KTP:', withoutKtp); // Log Perempuan

                        // Grafik Kolom
                        Highcharts.chart('ktpChartByRW', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Jumlah Status KTP per RW'
                            },
                            tooltip: {
                                valueSuffix: ' Orang'
                            },
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.y} Orang', // Tampilkan nilai asli
                                        style: {
                                            fontSize: '13px', // Ukuran font bisa disesuaikan
                                            fontWeight: 'bold' // Bisa ditambah ketebalan font
                                        }
                                    }
                                }
                            },
                            xAxis: {
                                categories: rwCategories,
                                title: {
                                    text: 'RW'
                                }
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'Jumlah Warga'
                                }
                            },
                            series: [{
                                name: 'Memiliki',
                                data: withKtp
                            }, {
                                name: 'Tidak Memiliki',
                                data: withoutKtp
                            }]
                        });

                        // Grafik Pie
                        Highcharts.chart('ktpChart', {
                            chart: {
                                type: 'pie'
                            },
                            title: {
                                text: 'Perbandingan Status Kepemilikan KTP'
                            },
                            tooltip: {
                                valueSuffix: ' Orang'
                            },
                            plotOptions: {
                                series: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    dataLabels: [{
                                        enabled: true,
                                        distance: 20
                                    }, {
                                        enabled: true,
                                        distance: -40,
                                        format: '{point.percentage:.1f}%',
                                        style: {
                                            fontSize: '1.2em',
                                            textOutline: 'none',
                                            opacity: 0.7
                                        },
                                        filter: {
                                            operator: '>',
                                            property: 'percentage',
                                            value: 10
                                        }
                                    }]
                                }
                            },
                            series: [{
                                name: 'Jumlah',
                                data: [{
                                        name: 'Memiliki',
                                        y: totalWithKtp
                                    },
                                    {
                                        name: 'Tidak Memiliki',
                                        y: totalWithoutKtp
                                    }
                                ]
                            }]
                        });
                    });
                });
            </script>

            {{-- Grafik Status JKN --}}
            <script>
                $(document).ready(function() {
                    $.getJSON('{{ route('grafik.jkn') }}', function(response) {
                        var dataPerRW = response.dataPerRW;
                        var totalJknPbi = response.totalJknPbi;
                        var totalJknNonPbi = response.totalJknNonPbi;
                        var totalNonJkn = response.totalNonJkn;

                        console.log(dataPerRW); // Log the data for debugging

                        var rwCategories = [];
                        var JknPbi = [];
                        var JknNonPbi = [];
                        var NonJkn = [];

                        for (var i = 0; i < dataPerRW.length; i++) {
                            rwCategories.push(dataPerRW[i].rw);
                            JknPbi.push(parseInt(dataPerRW[i].jkn_pbi));
                            JknNonPbi.push(parseInt(dataPerRW[i].jkn_non_pbi));
                            NonJkn.push(parseInt(dataPerRW[i].non_jkn));
                        }

                        console.log('RW Categories:', rwCategories); // Log categories
                        console.log('JKN PBI:', JknPbi); // Log Laki-laki
                        console.log('JKN NON PBI:', JknNonPbi); // Log Perempuan
                        console.log('NON JKN:', NonJkn); // Log Perempuan

                        // Grafik Kolom
                        Highcharts.chart('jknChartByRW', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Perbandingan Status JKN per RW'
                            },
                            tooltip: {
                                valueSuffix: ' Orang'
                            },
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.y} Orang', // Tampilkan nilai asli
                                        style: {
                                            fontSize: '13px', // Ukuran font bisa disesuaikan
                                            fontWeight: 'bold' // Bisa ditambah ketebalan font
                                        }
                                    }
                                }
                            },
                            xAxis: {
                                categories: rwCategories,
                                title: {
                                    text: 'RW'
                                }
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'Jumlah Warga'
                                }
                            },
                            series: [{
                                name: 'JKN PBI',
                                data: JknPbi
                            }, {
                                name: 'JKB NON PBI',
                                data: JknNonPbi
                            }, {
                                name: 'NON JKN',
                                data: NonJkn
                            }]
                        });

                        // Grafik Pie
                        Highcharts.chart('jknChart', {
                            chart: {
                                type: 'pie'
                            },
                            title: {
                                text: 'Perbandingan Status JKN'
                            },
                            tooltip: {
                                valueSuffix: ' Orang'
                            },
                            plotOptions: {
                                series: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    dataLabels: [{
                                        enabled: true,
                                        distance: 20
                                    }, {
                                        enabled: true,
                                        distance: -40,
                                        format: '{point.percentage:.1f}%',
                                        style: {
                                            fontSize: '1.2em',
                                            textOutline: 'none',
                                            opacity: 0.7
                                        },
                                        filter: {
                                            operator: '>',
                                            property: 'percentage',
                                            value: 10
                                        }
                                    }]
                                }
                            },
                            series: [{
                                name: 'Jumlah',
                                data: [{
                                        name: 'JKN PBI',
                                        y: totalJknPbi
                                    },
                                    {
                                        name: 'JKN NON PBI',
                                        y: totalJknNonPbi
                                    },
                                    {
                                        name: 'NON JKN',
                                        y: totalNonJkn
                                    }
                                ]
                            }]
                        });
                    });
                });
            </script>

            {{-- Grafik Status PKH --}}
            <script>
                $(document).ready(function() {
                    $.getJSON('{{ route('grafik.pkh') }}', function(response) {
                        var dataPerRW = response.dataPerRW;
                        var totalPkhRecipients = response.totalPkhRecipients;
                        var totalNonPkhRecipients = response.totalNonPkhRecipients;

                        console.log(dataPerRW); // Log the data for debugging

                        var rwCategories = [];
                        var pkhRecipients = [];
                        var nonPkhRecipients = [];

                        for (var i = 0; i < dataPerRW.length; i++) {
                            rwCategories.push(dataPerRW[i].rw);
                            pkhRecipients.push(parseInt(dataPerRW[i].pkh_recipients));
                            nonPkhRecipients.push(parseInt(dataPerRW[i].non_pkh_recipients));
                        }

                        console.log('RW Categories:', rwCategories); // Log categories
                        console.log('Penerima PKH:', pkhRecipients); // Log Laki-laki
                        console.log('Bukan Penerima PKH:', nonPkhRecipients); // Log Perempuan

                        // Grafik Kolom
                        Highcharts.chart('pkhChartByRW', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Jumlah Status PKH per RW'
                            },
                            tooltip: {
                                valueSuffix: ' Keluarga'
                            },
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.y} Orang', // Tampilkan nilai asli
                                        style: {
                                            fontSize: '13px', // Ukuran font bisa disesuaikan
                                            fontWeight: 'bold' // Bisa ditambah ketebalan font
                                        }
                                    }
                                }
                            },
                            xAxis: {
                                categories: rwCategories,
                                title: {
                                    text: 'RW'
                                }
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'Jumlah Keluarga'
                                }
                            },
                            series: [{
                                name: 'Penerima',
                                data: pkhRecipients
                            }, {
                                name: 'Bukan Penerima',
                                data: nonPkhRecipients
                            }]
                        });

                        // Grafik Pie
                        Highcharts.chart('pkhChart', {
                            chart: {
                                type: 'pie'
                            },
                            title: {
                                text: 'Perbandingan Status PKH'
                            },
                            tooltip: {
                                valueSuffix: ' Keluarga',
                                // pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                            },
                            plotOptions: {
                                series: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    dataLabels: [{
                                        enabled: true,
                                        distance: 20
                                    }, {
                                        enabled: true,
                                        distance: -40,
                                        format: '{point.percentage:.1f}%',
                                        style: {
                                            fontSize: '1.2em',
                                            textOutline: 'none',
                                            opacity: 0.7
                                        },
                                        filter: {
                                            operator: '>',
                                            property: 'percentage',
                                            value: 10
                                        }
                                    }]
                                }
                            },
                            series: [{
                                name: 'Jumlah',
                                data: [{
                                        name: 'Penerima',
                                        y: totalPkhRecipients
                                    },
                                    {
                                        name: 'Bukan Penerima',
                                        y: totalNonPkhRecipients
                                    }
                                ]
                            }]
                        });
                    });
                });
            </script>
        </div>
    </div>

</body>

</html>
