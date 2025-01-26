<?php
require "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_produk = $_POST['nama_produk'] ?? null;
    $stok = $_POST['stok'] ?? null;
    $harga = $_POST['harga'] ?? null;
    $kategori_id = $_POST['kategori'] ?? null;
    $target_dir = "../img/";
    $nama_file = pathinfo($_FILES["foto"]["name"], PATHINFO_FILENAME); // Nama file tanpa ekstensi
    $imageFileType = strtolower(pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION)); // Ekstensi file
    $new_name = $nama_file . "_" . time() . "." . $imageFileType; // Nama unik untuk file
    $target_file = $target_dir . $new_name;

    // Validasi field input
    if ($nama_produk && $stok && $harga && $kategori_id && $imageFileType) {
        // Validasi ukuran file (contoh: max 2MB)
        if ($_FILES["foto"]["size"] > 2 * 1024 * 1024) {
            echo "Ukuran file terlalu besar. Maksimal 2MB.";
            exit();
        }

        // Validasi tipe file (hanya menerima JPG, PNG, JPEG)
        $allowed_types = ["jpg", "jpeg", "png"];
        if (!in_array($imageFileType, $allowed_types)) {
            echo "Format file tidak didukung. Gunakan JPG, JPEG, atau PNG.";
            exit();
        }

        // Pindahkan file ke folder tujuan
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            // Simpan data ke database
            $sql = "INSERT INTO produk (nama_produk, stok, harga, kategori_id, foto) 
                    VALUES ('$nama_produk', $stok, $harga, $kategori_id, '$new_name')";

            if ($con->query($sql) === TRUE) {
                echo '<script>alert("Data berhasil ditambahkan."); window.location.href = "land.php";</script>';
            } else {
                echo "Error: " . $sql . "<br>" . $con->error;
            }
        } else {
            echo "Gagal mengunggah file.";
        }
    } else {
        echo "Semua field harus diisi.";
    }
}
?>
