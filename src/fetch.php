<?php
require "koneksi.php"; // Koneksi ke database

// Query untuk mengambil data produk dari tabel
$query = "SELECT p.produk_id, p.nama_produk, p.harga, p.stok, k.nama, p.foto
          FROM produk p
          JOIN kategori_jenis_barang k ON p.kategori_id = k.kategori_id"; 
$result = $con->query($query); // Eksekusi query


if (!$result) {
    die("Query error: " . $con->error);
}