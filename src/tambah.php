<?php
require "koneksi.php"; // Koneksi ke database

// Ambil produk_id dari URL
$produk_id = isset($_POST['produk_id']) ? intval($_POST['produk_id']) : 0;

// Mengecek apakah form telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Menyimpan hasil var_dump dalam sebuah variabel
    ob_start(); // Mulai buffering output
    var_dump($_POST); // Output var_dump
    $output = ob_get_clean(); // Menyimpan hasil ke dalam variabel dan membersihkan output buffer

    // Menampilkan hasil var_dump di console.log melalui JavaScript
    echo "<script>console.log(" . json_encode($output) . ");</script>";

    // Pastikan semua input diterima dari form
    $stok = isset($_POST['stok']) ? intval($_POST['stok']) : 0; 
    $jenis = isset($_POST['jenis']) ? $_POST['jenis'] : '';

    echo "Produk ID: " . $produk_id . "<br>";
    echo "Stok: " . $stok . "<br>";
    echo "Jenis: " . $jenis . "<br>";

    // Validasi input
    if ($produk_id > 0 && $stok > 0 && !empty($jenis)) {
        // Query untuk menyimpan data ke tabel stok_log
        $query_stok_log = "INSERT INTO stok_log (produk_id, jumlah, jenis, tanggal) VALUES (?, ?, ?, NOW())";
        $stmt_stok_log = $con->prepare($query_stok_log);
        $stmt_stok_log->bind_param("iis", $produk_id, $stok, $jenis);

        if ($stmt_stok_log->execute()) {
            echo "<script>
                alert('Log stok berhasil ditambahkan');
                window.location.href = 'stockview.php?produk_id=" . $produk_id . "';
            </script>";
        } else {
            echo "<script>
                alert('Gagal menambahkan log stok: " . $stmt_stok_log->error . "');
                window.history.back();
            </script>";
        }
    } else {
        echo "<script>
            alert('Harap isi semua data dengan benar');
            window.history.back();
        </script>";
    }
} else {
    echo "<script>
        alert('Invalid request');
        window.history.back();
    </script>";
}
?>
