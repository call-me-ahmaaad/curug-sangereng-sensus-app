<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tambahkan CSS Choices.js -->
    <link href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" />

    <!-- Tambahkan JS Choices.js -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            padding: 40px;
            top: 650px;
            left: 100px;
            bottom: 20px;
            ;
            max-width: 1000px;
            width: 100%;
        }

        .modal-content {
            background-color: #fefefe;
            border: 1px solid #888;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .modal-content .close {
            position: absolute;
            right: 15px;
            top: 10px;
            color: #aaa;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
        }

        .modal-content .close:hover,
        .modal-content .close:focus {
            color: #333;
            text-decoration: none;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-check {
            margin-bottom: 1rem;
        }

        .d-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            text-align: center;
            margin-bottom: 2rem;
        }
    </style>
</head>

<body>
    @include('header-sidebar') <!-- Mengikutsertakan layout header-sidebar -->
    <div class="container">
        <div class="form-selection">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="formSelect" id="keluargaRadio" value="keluarga"
                    onclick="showForm('keluarga')">
                <label class="form-check-label" for="keluargaRadio">Form Keluarga</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="formSelect" id="peroranganRadio" value="perorangan"
                    onclick="showForm('perorangan')"checked>
                <label class="form-check-label" for="peroranganRadio">Form Perorangan</label>
            </div>
            <h2 class="page-title">Detail Data yang Dipilih</h2>
            <!-- form keluarga -->
            <div class="form-container" id="keluargaForm">
                <form action="#" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="kk">No KK:</label>
                        <input type="text" class="form-control" id="kk" name="kk"
                            placeholder="Masukkan No KK">
                    </div>
                    <div class="form-group">
                        <label for="kepala_keluarga">Kepala Keluarga:</label>
                        <input type="text" class="form-control" id="kepala_keluarga" name="kepala_keluarga"
                            placeholder="Masukkan Kepala Keluarga">
                    </div>
                    <div class="form-group">
                        <label>Status PKH:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="pkh_menerima" name="status_pkh"
                                value="menerima">
                            <label class="form-check-label" for="pkh_menerima">Menerima</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="pkh_tidak_menerima" name="status_pkh"
                                value="tidak_menerima">
                            <label class="form-check-label" for="pkh_tidak_menerima">Tidak Menerima</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="rt">RT:</label>
                        <select class="form-control" id="rt" name="rt">
                            <option value="">Pilih RT</option>
                            <!-- Tambahkan opsi RT di sini -->
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <!-- Tambahkan lebih banyak opsi sesuai kebutuhan -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="rw">RW:</label>
                        <select class="form-control" id="rw" name="rw">
                            <option value="">Pilih RW</option>
                            <!-- Tambahkan opsi RW di sini -->
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <!-- Tambahkan lebih banyak opsi sesuai kebutuhan -->
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-secondary" type="button" onclick="history.back()"><i
                                class="fas fa-arrow-left"></i> Kembali</button>
                        <button class="btn btn-primary" type="button" data-toggle="modal"
                            data-target="#confirmationModal"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
            <!-- form perorangan -->
            <div class="form-container" id="peroranganForm">
                <form action="#" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nik">NIK:</label>
                        <input type="text" class="form-control" id="nik" name="nik"
                            placeholder="Masukkan NIK">
                    </div>

                    <div class="form-group">
                        <label for="akte">No Akte Lahir:</label>
                        <input type="text" class="form-control" id="akte" name="akte"
                            placeholder="Masukkan No Akte Lahir">
                    </div>

                    <div class="form-group">
                        <label for="kk">No KK:</label>
                        <input type="text" class="form-control" id="kk" name="kk"
                            placeholder="Masukkan No KK">
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            placeholder="Masukkan Nama">
                    </div>

                    <div class="form-group">
                        <label>Apakah KTP sudah terdaftar?</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ktp" id="ktpSudah"
                                value="sudah">
                            <label class="form-check-label" for="ktpSudah">Sudah</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ktp" id="ktpBelum"
                                value="belum">
                            <label class="form-check-label" for="ktpBelum">Belum</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status_jkn">Status JKN:</label>
                        <select class="form-control" id="status_jkn" name="status_jkn">
                            <option value="jkn_pbi">JKN PBI</option>
                            <option value="jkn_non_pbi">JKN NON PBI</option>
                            <option value="non_jkn">NON JKN</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tempat_lahir">Tempat Lahir:</label>
                        <select class="form-control" id="tempat_lahir" name="tempat_lahir">
                            <option value="">Pilih Tempat Lahir</option>
                            <option value="jakarta">Jakarta</option>
                            <option value="bandung">Bandung</option>
                            <option value="surabaya">Surabaya</option>
                            <option value="yogyakarta">Yogyakarta</option>
                            <option value="medan">Medan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir:</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                            placeholder="Masukkan Tanggal Lahir">
                    </div>

                    <div class="form-group">
                        <label for="gender">Jenis Kelamin:</label>
                        <select class="form-control" id="gender" name="gender">
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="agama">Agama:</label>
                        <select class="form-control" id="agama" name="agama">
                            <option value="islam">Islam</option>
                            <option value="kristen">Kristen</option>
                            <option value="katolik">Katolik</option>
                            <option value="hindu">Hindu</option>
                            <option value="buddha">Buddha</option>
                            <option value="konghucu">Konghucu</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="golongan_darah">Golongan Darah:</label>
                        <select class="form-control" id="golongan_darah" name="golongan_darah">
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pendidikan">Pendidikan:</label>
                        <select class="form-control" id="pendidikan" name="pendidikan">
                            <option value="sd">Sekolah Dasar (SD)</option>
                            <option value="smp">Sekolah Menengah Pertama (SMP)</option>
                            <option value="sma">Sekolah Menengah Atas (SMA)</option>
                            <option value="d1">Diploma 1 (D1)</option>
                            <option value="d2">Diploma 2 (D2)</option>
                            <option value="d3">Diploma 3 (D3)</option>
                            <option value="s1">Sarjana (S1)</option>
                            <option value="s2">Magister (S2)</option>
                            <option value="s3">Doktor (S3)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pekerjaan">Pekerjaan:</label>
                        <select class="form-control" id="pekerjaan" name="pekerjaan">
                            <option value="pelajar">Pelajar</option>
                            <option value="mahasiswa">Mahasiswa</option>
                            <option value="pegawai_negeri">Pegawai Negeri</option>
                            <option value="pegawai_swasta">Pegawai Swasta</option>
                            <option value="wiraswasta">Wiraswasta</option>
                            <option value="pensiunan">Pensiunan</option>
                            <option value="ibu_rumah_tangga">Ibu Rumah Tangga</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status_pernikahan">Status Pernikahan:</label>
                        <select class="form-control" id="status_pernikahan" name="status_pernikahan">
                            <option value="belum_menikah">Belum Menikah</option>
                            <option value="menikah">Menikah</option>
                            <option value="cerai_hidup">Cerai Hidup</option>
                            <option value="cerai_mati">Cerai Mati</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status_keluarga">Status Keluarga:</label>
                        <select class="form-control" id="status_keluarga" name="status_keluarga">
                            <option value="kepala_keluarga">Kepala Keluarga</option>
                            <option value="istri">Istri</option>
                            <option value="anak">Anak</option>
                            <option value="bukan_anggota_keluarga">Bukan Anggota Keluarga</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="kewarganegaraan">Kewarganegaraan:</label>
                        <select class="form-control" id="kewarganegaraan" name="kewarganegaraan">
                            <option value="wni">WNI</option>
                            <option value="wna">WNA</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama_ibu">Nama Ibu:</label>
                        <input type="text" class="form-control" id="nama_ibu" name="nama_ibu"
                            placeholder="Masukkan nama ibu">
                    </div>

                    <div class="form-group">
                        <label for="tahun">Tahun Data:</label>
                        <input type="text" class="form-control" id="tahun" name="tahun"
                            placeholder="Masukkan Tahun Data">
                    </div>

                    <div class="d-flex justify-content-between">
                        <button class="btn btn-secondary" type="button" onclick="history.back()"><i
                                class="fas fa-arrow-left"></i> Kembali</button>
                        <button class="btn btn-primary" type="button" data-toggle="modal"
                            data-target="#confirmationModal"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal untuk konfirmasi -->
        <div id="confirmationModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menyimpan perubahan?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fas fa-times"></i> Batalkan</button>
                        <button type="button" class="btn btn-primary" id="confirmSave"><i class="fas fa-check"></i>
                            Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
            document.getElementById('confirmSave').addEventListener('click', function() {
                // Aksi untuk menyimpan data setelah konfirmasi
                document.querySelector('form').submit();
            });

            document.addEventListener('DOMContentLoaded', function() {
                var tempatLahir = document.getElementById('tempat_lahir');
                var choices = new Choices(tempatLahir, {
                    placeholderValue: 'Pilih Tempat Lahir',
                    searchEnabled: true
                });
            });
            var keluargaForm = document.getElementById('keluargaForm');
            keluargaForm.style.display = 'none';

            function showForm(formType) {
                var keluargaForm = document.getElementById('keluargaForm');
                var peroranganForm = document.getElementById('peroranganForm');
                let container = document.querySelector('.container');

                if (formType === 'keluarga') {
                    keluargaForm.style.display = 'block';
                    peroranganForm.style.display = 'none';
                    container.style.top = "40px";

                } else if (formType === 'perorangan') {
                    keluargaForm.style.display = 'none';
                    peroranganForm.style.display = 'block';
                    container.style.top = "650px";
                }
            }
        </script>
</body>

</html>
