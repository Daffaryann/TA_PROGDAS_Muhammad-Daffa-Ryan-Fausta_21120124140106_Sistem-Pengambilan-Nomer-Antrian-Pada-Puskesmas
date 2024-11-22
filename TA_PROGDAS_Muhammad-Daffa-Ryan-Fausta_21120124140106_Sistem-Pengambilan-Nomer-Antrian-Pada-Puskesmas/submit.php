<?php
// Memulai sesi
session_start();

// Definisi kelas AntrianPuskesmas
class AntrianPuskesmas {
    private $nomor_antrian;

    public function __construct() {
        if (!isset($_SESSION['nomor_antrian'])) {
            $_SESSION['nomor_antrian'] = 0; // Inisialisasi nomor antrian
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

// Membuat objek AntrianPuskesmas jika belum ada
if (!isset($_SESSION['antrian_puskesmas'])) {
    $_SESSION['antrian_puskesmas'] = new AntrianPuskesmas();
}

$antrianPuskesmas = $_SESSION['antrian_puskesmas'];

// Ambil data pendaftaran dari session
$data_pendaftaran = isset($_SESSION['pendaftaran']) ? $_SESSION['pendaftaran'] : null;

// Jika pengguna mengonfirmasi pendaftaran
if (isset($_POST['konfirmasi'])) {
    // Ambil nomor antrean dari AntrianPuskesmas
    $nomor_antrian = $antrianPuskesmas->ambilNomorAntrian();
    
    // Hapus data pendaftaran dari session
    unset($_SESSION['pendaftaran']);

    // Tampilkan kotak konfirmasi nomor antrean
    echo "<title>PUSKESMAS TEMBALANG</title>
            <style>
                body {
                    font-family: 'Arial', sans-serif;
                    background: url('puskesmas.jpg');
                    background-repeat: no-repeat;
                    background-size: cover;
                    background-position: center;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                }
                .confirmation-box {
                    max-width: 400px;
                    padding: 20px;
                    background-color: #fff;
                    border: 1px solid #ddd;
                    border-radius: 10px;
                    text-align: center;
                    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
                    animation: fadeIn 1s ease-in-out;
                }
                .confirmation-box h2 {
                    margin-top: 10;
                    color: #025460;
                    font-size: 36px;
                    margin-bottom: 0px;
                    padding-bottom: 10px;
                }
                .confirmation-box p {
                    font-size: 18px;
                    margin-bottom: 10px;
                    color: #555;
                }
                .confirmation-box .nomor-antrian {
                    font-size: 120px;
                    font-weight: bold;
                    color: #48cc19;
                    margin-bottom:20px;
                    margin-top:0px;
                }
                .confirmation-box .terima-kasih {
                    font-style: italic;
                    color: #777;
                    margin-bottom: 20px;
                }
               
                @keyframes fadeIn {
                    from {
                        opacity: 0;
                        transform: scale(0.9);
                    }
                    to {
                        opacity: 1;
                        transform: scale(1);
                    }
                }
            </style>
            <div class='confirmation-box'>
            <h2>PUSKESMAS TEMBALANG</h2>
            <h3>NOMOR ANTRIAN ANDA</h3>
            <p class='nomor-antrian'>$nomor_antrian</p>
            <h5>HARAP TUNGGU ANTRIAN ANDA HINGGA DI PANGGIL</h5>
          </div>";
          
    exit(); // Menghentikan eksekusi skrip setelah menampilkan nomor antrian
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA PASIEN PUSKESMAS</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: url(puskesmas.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .confirmation-box {
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
            margin-left: auto;
            margin-right: auto;
        }
        .confirmation-box h2 {
            margin-top: 0;
            color: #025460;
            font-size: 24px;
            margin-bottom: 10px;
            padding-bottom: 10px;
        }
        .confirmation-box p {
            font-size: 18px;
            margin-bottom: 10px;
            color: #555;
            text-align: left;
            padding-left: 20px;
            margin-left: 20px;
        }
        .confirmation-box .nomor-antrian {
            font-size: 32px;
            font-weight: bold;
            color: #ddd;
            margin-bottom: 20px;
        }
        .confirmation-box .terima-kasih {
            font-style: italic;
            color: #777;
            margin-bottom: 20px;
        }
        .cetak-button {
            background-color: #007BFF;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s, transform 0.3s;
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }
        .cetak-button:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
        }
        .cetak-button:active {
            background-color: #004494;
            transform: translateY(0);
        }
        
    </style>
</head>
<body>
    <div class="confirmation-box">
        <h2>DATA PASIEN PUSKESMAS</h2>
        <?php
        if ($data_pendaftaran) {
            foreach ($data_pendaftaran as $key => $value) {
                if ($key != 'nomor_antrian') { // Jangan tampilkan nomor antrian di sini
                    $label = ucfirst(str_replace('_', ' ', $key));
                    echo "<p><strong>$label:</strong> $value</p>";
                }
            }
        } else {
            echo "<p>Tidak ada data pendaftaran yang tersedia.</p>";
        }
        ?>
        <form method="post" action="">
            <button type="submit" name="konfirmasi">Submit</button>
            <button type="button" onclick="window.history.back();">Back</button>
        </form>
    </div>
</body>
</html>
