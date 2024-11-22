<?php

session_start();

class AntrianPuskesmas {
    private $nomor_antrian;

    public function __construct() {
        if (!isset($_SESSION['nomor_antrian'])) {
            $_SESSION['nomor_antrian'] = 0; 
        }
        $this->nomor_antrian = $_SESSION['nomor_antrian'];
    }

    public function ambilNomorAntrian() {
        $this->nomor_antrian++;
        $_SESSION['nomor_antrian'] = $this->nomor_antrian;
        return $this->nomor_antrian;
    }

    public function resetNomorAntrian() {
        $this->nomor_antrian = 0;
        $_SESSION['nomor_antrian'] = $this->nomor_antrian;
    }
}

if (!isset($_SESSION['antrian_puskesmas'])) {
    $_SESSION['antrian_puskesmas'] = new AntrianPuskesmas();
}

$antrianPuskesmas = $_SESSION['antrian_puskesmas'];

if (!isset($_SESSION['last_reset']) || date('Y-m-d') != $_SESSION['last_reset']) {
    $antrianPuskesmas->resetNomorAntrian();
    $_SESSION['last_reset'] = date('Y-m-d'); 
}

if (isset($_POST['daftar'])) {
    
    $_SESSION['pendaftaran'] = $_POST;

    $_SESSION['pendaftaran']['nomor_antrian'] = $antrianPuskesmas->ambilNomorAntrian();

    header("Location: submit.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOHON ISI DATA DIRI ANDA</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>MOHON ISI DATA DIRI ANDA</h2>
        <form method="post" action="">
            <label for="nama">Nama Lengkap Pasien:</label>
            <input type="text" id="nama" name="nama" placeholder="Nama Anda" required>

            <label for="alamat_rumah">Alamat Rumah:</label>
            <input type="text" id="Alamat" name="Alamat" placeholder="Alamat Anda" required>

            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" id="Tanggal_Lahir" name="Tanggal_Lahir" required>

            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>

            <label for="status_pasien">Status Pasien:</label>
            <select id="Status_Pasien" name="Status_Pasien" required>
                <option value="Bayi">Bayi</option>
                <option value="Balita">Balita</option>
                <option value="Anak-Anak">Anak-Anak</option>
                <option value="Remaja">Remaja</option>
                <option value="Dewasa">Dewasa</option>
                <option value="Lansia">Lansia</option>
            </select>

            <label for="golongan_darah">Golongan Darah:</label>
            <select id="golongan_darah" name="golongan_Darah" required>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="AB">AB</option>
                <option value="O">O</option>
            </select>

            <label for="memiliki_penyakit_bawaan">Memiliki Penyakit Bawaan:</label>
            <select id="memiliki_penyakit_bawaan" name="Memiliki_Penyakit_Bawaan" required>
                <option value="Iya">Iya</option>
                <option value="Tidak">Tidak</option>
            </select>

            <label for="pendidikan_Yang_Sedang_Di_Tempuh">Pendidikan Yang Sedang Di Tempuh:</label>
            <select id="Pendidikan" name="Pendidikan" required>
                <option value="-">-</option>
                <option value="PAUD">PAUD</option>
                <option value="TK">TK</option>
                <option value="SD">SD</option>
                <option value="SMP">SMP</option>
                <option value="SMA">SMA</option>
                <option value="Mahasiswa">Mahasiswa</option>
                <option value="Sudah Bekerja">Sudah Bekerja</option>
            </select>

            <label for="pekerjaan">Pekerjaan: (Beri Tanda Strip Jika Belum Bekerja)</label>
            <input type="text" id="pekerjaan" name="pekerjaan" required>
        
            <label for="nomor_telepon">Nomor Telepon:</label>
            <input type="tel" id="nomor_telepon" name="nomor_telepon" required>

            <button type="submit" name="daftar">Daftar</button>
        </form>
    </div>
</body>
</html>
