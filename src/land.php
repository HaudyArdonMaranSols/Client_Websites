<?php 
    require "koneksi.php"; 
    require 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kazumi Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="tailwind.css">
    <script>
        function openstuff() {
            document.getElementById("stuff").classList.remove("hidden");
        }

        function closestuff() {
            document.getElementById("stuff").classList.add("hidden");
        }
    </script>

</head>
<body>
    <header class="bg-blue-500 text-white relative flex items-center justify-center h-[100px] text-[40px] font-bold shadow-md">
        STOK GUDANG

        <button 
            onclick="window.location.href='logout.php'"
            class="absolute right-6 bg-orange-500 text-white px-4 py-2 rounded text-[16px] font-medium shadow-md hover:bg-orange-600">
            Logout
        </button>
    </header>



    <main class="flex">
        <aside class="w-1/4 bg-white shadow-md p-4">
            <div class="text-center mb-6">
                <img src="../Assets/BannerKazumi.png" alt="Kazumi Store" class="w-32 mx-auto">
                <h2 class="text-lg font-bold mt-2">Kazumi Store</h2>
                
            </div>
            <div class="text-center mb-6">
                <label for="search" class="mr-2">Cari:</label>
                <input type="text" id="search" class="border rounded px-2 py-1" placeholder="Cari produk...">
            </div>
            <button onclick="openstuff()" class="bg-orange-500 text-white px-4 py-2 rounded w-full font-semibold mb-4">
                Tambah Barang
            </button>

            <!-- <div class="mb-4">
                <label for="sort" class="block font-semibold mb-2">Sort by:</label>
                <select id="sort" class="w-full border-gray-300 rounded p-2">
                    <option value="kategori">Kategori</option>
                    <option value="harga">Harga</option>
                    <option value="stok">Stok</option>
                </select>
            </div> -->
        </aside>

        <section class="flex-1 bg-blue-100 p-6">
            <div class="overflow-x-auto bg-white shadow-md rounded p-4">
                <table class="w-full border-collapse">
                    <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="p-2 text-center">Produk ID</th>
                            <th class="p-2 text-center">Nama Produk</th>
                            <th class="p-2 text-center">Harga</th>
                            <th class="p-2 text-center">Stok</th>
                            <th class="p-2 text-center">Kategori</th>
                            <th class="p-2 text-center">Gambar</th>
                            <th class="p-2 text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require "fetch.php"; // PHP untuk Membaca Data dari Database

                            if ($result->num_rows > 0):
                                while ($row = $result->fetch_assoc()): ?>
                                    <tr class="border-b">
                                        <td class="p-2 text-center"><?= $row['produk_id']; ?></td>
                                        <td class="p-2 text-center"><?= $row['nama_produk']; ?></td>
                                        <td class="p-2 text-center">Rp.<?= number_format($row['harga'], 2); ?></td>
                                        <td class="p-2 text-center"><?= $row['stok']; ?></td>
                                        <td class="p-2 text-center"><?= $row['nama']; ?></td>
                                        <td class="p-2 text-center">
                                            <img class="mx-auto" src="../img/<?= $row['foto'] ?>" alt="" width="150px">
                                        </td>
                                        <td class="p-2 text-center">
                                            <a href="stockview.php?produk_id=<?= $row['produk_id']; ?>" class="bg-blue-500 text-white px-4 py-2 rounded">Lihat Stok</a>
                                        </td>
                                    </tr>
                                <?php endwhile;
                            else: ?>
                                <tr>
                                    <td colspan="5" class="text-center p-2">Tidak ada data tersedia</td>
                                </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <!-- tambah barang -->
    <div id="stuff" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white w-1/3 p-6 rounded shadow-lg">
            <h2 class="text-2xl font-bold mb-4">Tambah Barang</h2>
            <form action="tambah_data.php" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="nama_produk" class="block font-semibold mb-2">Nama Barang:</label>
                    <input type="text" id="nama_produk" name="nama_produk" class="w-full border rounded px-2 py-1" required>
                </div>
                <div class="mb-4">
                    <label for="stok" class="block font-semibold mb-2">Stok:</label>
                    <input type="number" id="stok" name="stok" class="w-full border rounded px-2 py-1" required>
                </div>
                <div class="mb-4">
                    <label for="harga" class="block font-semibold mb-2">Harga:</label>
                    <input type="number" id="harga" name="harga" class="w-full border rounded px-2 py-1" required>
                </div>
                <div class="mb-4">
                    <label for="kategori" class="block font-semibold mb-2">Kategori:</label>
                    <select id="kategori" name="kategori" class="w-full border rounded px-2 py-1" required>
                        <option value="" disabled selected>Pilih Kategori</option>
                        <?php
                        // Query untuk mengambil kategori
                        $query_kategori = "SELECT kategori_id, nama FROM kategori_jenis_barang";
                        $result_kategori = $con->query($query_kategori);

                        if ($result_kategori->num_rows > 0) {
                            while ($row = $result_kategori->fetch_assoc()) {
                                echo "<option value='{$row['kategori_id']}'>{$row['nama']}</option>";
                            }
                        } else {
                            echo "<option value='' disabled>Tidak ada kategori</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="foto" class="block font-semibold mb-2">Foto Barang:</label>
                    <input type="file" id="foto" name="foto" class="w-full border rounded px-2 py-1" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closestuff()" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Batal</button>
                    <button type="submit" onclick="'tambah.php'" class="bg-orange-500 text-white px-4 py-2 rounded" name="simpan">Simpan</button>
                </div>
            </form>
            
        </div>
    </div>

    <?php require "footer.php" ?>
</body>