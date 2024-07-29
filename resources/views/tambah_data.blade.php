<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            width: calc(100% - 260px);
            max-width: auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 300px;
            margin-left: 280px;
        }

        h2.page-title {
            margin-bottom: 20px;
            color: #333;
            text-align: left;
            font-size: 30px;
            font-weight: bold;
        }

        .form-container {
            background-color: #d9d9d9;
            border-radius: 50px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .form-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding: 5px;
        }

        label {
            flex: 0 0 30%;
            font-size: 1em;
            color: #333;
        }

        input[type="text"],
        input[type="date"],
        select {
            flex: 1;
            padding: 10px;
            background-color: #969696;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 0.9em;
        }

        input[type="text"]::placeholder,
        input[type="date"]::placeholder {
            color: #dcdcdc;
        }

        .radio-group {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            flex: 1;
        }

        .radio-group label {
            margin-right: 20px;
            font-size: 0.9em;
        }

        .radio-group input {
            margin-right: 5px;
        }

        .button-group {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .btn-back,
        .btn-save {
            background-color: #ccc;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 1em;
            color: #fff;
            cursor: pointer;
            margin: 0 10px;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
        }

        .btn-back {
            background-color: #888;
        }

        .btn-save {
            background-color: #6247aa;
        }

        .btn-back:hover {
            background-color: #666;
        }

        .btn-save:hover {
            background-color: #4d2f8e;
        }

        .fas {
            margin-right: 5px;
        }

        /* Responsive styles */
        @media (max-width: 1024px) {
            .container {
                margin-left: 60px;
                margin-top: 80px;
                width: calc(100% - 80px);
            }
        }

        @media (max-width: 768px) {
            .container {
                margin-left: 20px;
                margin-top: 60px;
                width: calc(100% - 40px);
            }

            .form-group {
                flex-direction: column;
                align-items: flex-start;
            }

            label {
                flex: 0 0 100%;
                margin-bottom: 5px;
            }

            input[type="text"],
            input[type="date"],
            select {
                flex: 1;
                width: 100%;
            }
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 300px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .modal-content h3 {
            margin: 0 0 15px;
            color: #333;
        }

        .modal-content p {
            margin: 0 0 20px;
            color: #666;
        }

        .close {
            position: absolute;
            right: 15px;
            top: 10px;
            color: #aaa;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #333;
            text-decoration: none;
            cursor: pointer;
        }

        .button-group-modal {
            display: flex;
            justify-content: center;
        }

        .btn-cancel,
        .btn-confirm {
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9em;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
        }

        .btn-cancel {
            background-color: #ccc;
            color: #333;
        }

        .btn-confirm {
            background-color: #6247aa;
            color: #fff;
        }

        .btn-cancel:hover {
            background-color: #aaa;
        }

        .btn-confirm:hover {
            background-color: #4d2f8e;
        }

    </style>
</head>

<body>
    @include('header-sidebar') <!-- Mengikutsertakan layout header-sidebar -->

    <div class="container">
        <h2 class="page-title">Detail Data yang Dipilih</h2>
        <div class="form-container">
            <form action="#" method="POST">
                @csrf <!-- Menambahkan token CSRF untuk keamanan -->

                <div class="form-group">
                    <label for="kk">KK:</label>
                    <input type="text" id="kk" name="kk" placeholder="Masukkan KK">
                </div>

                <div class="form-group">
                    <label for="nik">NIK:</label>
                    <input type="text" id="nik" name="nik" placeholder="Masukkan NIK">
                </div>

                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan Nama">
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" id="alamat" name="alamat" placeholder="Masukkan Alamat">
                </div>

                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir:</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" placeholder="Masukkan Tanggal Lahir">
                </div>

                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender">
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="kewarganegaraan">Kewarganegaraan:</label>
                    <input type="text" id="kewarganegaraan" name="kewarganegaraan"
                        placeholder="Masukkan Kewarganegaraan">
                </div>

                <div class="form-group">
                    <label for="agama">Agama:</label>
                    <select id="agama" name="agama">
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
                    <label for="bpjs">Apakah BPJS sudah terdaftar?</label>
                    <div class="radio-group">
                        <label><input type="radio" name="bpjs" value="sudah"> Sudah</label>
                        <label><input type="radio" name="bpjs" value="belum"> Belum</label>
                        <label><input type="radio" name="bpjs" value="tidak_tahu"> Tidak Tahu</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="ktp">Apakah KTP sudah terdaftar?</label>
                    <div class="radio-group">
                        <label><input type="radio" name="ktp" value="sudah"> Sudah</label>
                        <label><input type="radio" name="ktp" value="belum"> Belum</label>
                        <label><input type="radio" name="ktp" value="tidak_tahu"> Tidak Tahu</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="tahun">Tahun Data:</label>
                    <input type="text" id="tahun" name="tahun" placeholder="Masukkan Tahun Data">
                </div>

                <div class="button-group">
                    <!-- Mengubah onclick untuk menggunakan history.back() -->
                    <button class="btn-back" type="button" onclick="history.back()"><i class="fas fa-arrow-left"></i> Kembali</button>
                    <!-- Menggunakan modal untuk konfirmasi simpan -->
                    <button class="btn-save" type="button"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal untuk konfirmasi -->
    <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Konfirmasi</h3>
            <p>Apakah Anda yakin ingin menyimpan perubahan?</p>
            <div class="button-group-modal">
                <button class="btn-cancel"><i class="fas fa-times"></i> Batalkan</button>
                <button class="btn-confirm"><i class="fas fa-check"></i> Simpan Perubahan</button>
            </div>
        </div>
    </div>

    <script>
        // Ambil elemen modal dan tombol
        const modal = document.getElementById("confirmationModal");
        const closeBtn = document.querySelector(".close");
        const cancelBtn = document.querySelector(".btn-cancel");
        const confirmBtn = document.querySelector(".btn-confirm");

        // Fungsi untuk menampilkan modal
        function showModal() {
            modal.style.display = "flex"; // Menampilkan modal
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            modal.style.display = "none"; // Menyembunyikan modal
        }

        // Tambahkan event listener ke tombol "Simpan" untuk menampilkan modal
        document.querySelector(".btn-save").addEventListener("click", showModal);

        // Tambahkan event listener ke tombol tutup dan "Batalkan"
        closeBtn.addEventListener("click", closeModal);
        cancelBtn.addEventListener("click", closeModal);

        // Tambahkan event listener ke tombol "Simpan Perubahan"
        confirmBtn.addEventListener("click", function () {
            // Aksi ketika konfirmasi
            alert("Perubahan disimpan!");
            closeModal(); // Tutup modal setelah konfirmasi

            // Menggunakan form submit untuk mengirimkan data
            document.querySelector("form").submit();
        });

        // Tutup modal jika pengguna mengklik di luar konten modal
        window.addEventListener("click", function (event) {
            if (event.target === modal) {
                closeModal();
            }
        });
    </script>
</body>

</html>
