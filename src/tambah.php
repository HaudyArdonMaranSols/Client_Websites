<?php
require "koneksi.php"; // Koneksi ke database

// Mengecek apakah form telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_barang = $_POST['nama_barang'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];

    // Mengunggah file foto
    $foto = $_FILES['foto'];
    $foto_nama = $foto['name'];
    $foto_tmp = $foto['tmp_name'];
    $foto_folder = "uploads/"; // Folder tempat menyimpan file foto

    // Membuat folder jika belum ada
    if (!is_dir($foto_folder)) {
        mkdir($foto_folder, 0777, true);
    }

    // Menentukan lokasi file tujuan
    $foto_path = $foto_folder . basename($foto_nama);

    // Memindahkan file yang diunggah ke folder tujuan
    if (move_uploaded_file($foto_tmp, $foto_path)) {
        // Query untuk menyimpan data ke database
        $query = "INSERT INTO produk (nama_produk, stok, harga, kategori_id, foto) VALUES ('$nama_barang', '$stok', '$harga', '$kategori', '$foto_path')";
        if ($con->query($query) === TRUE) {
            echo "<script>
                alert('Barang berhasil ditambahkan');
                window.location.href = 'index.html';
            </script>";
        } else {
            echo "<script>
                alert('Gagal menambahkan barang: " . $con->error . "');
                window.history.back();
            </script>";
        }
    } else {
        echo "<script>
            alert('Gagal mengunggah foto.');
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
