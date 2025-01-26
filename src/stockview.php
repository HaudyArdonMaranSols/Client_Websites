<?php "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kazumi Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="tailwind.css">

</head>
<body>
    <header class="bg-blue-500 text-orange-500 text-center flex items-center justify-center h-[100px] text-[40px] font-bold shadow-md">
        STOK GUDANG
    </header>

    <main class="flex">
        <aside class="w-1/4 bg-white shadow-md p-4">
            <div class="text-center mb-6">
                <img src="../Assets/BannerKazumi.png" alt="Kazumi Store" class="w-32 mx-auto">
                <h2 class="text-lg font-bold mt-2">Kazumi Store</h2>
                
            </div>
            <div class="text-center mb-6">
                // Kode untuk Menampilkan Nama Barang Disini
            </div>
            

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
                            <th class="p-2 text-left">Stok Gudang</th>
                            <th class="p-2 text-left">Stok Masuk</th>
                            <th class="p-2 text-left">Stok Keluar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php require "koneksi.php";
                        $query = "
                            SELECT p.nama_produk, p.stok, l.perubahan, l.keterangan, l.tanggal 
                            FROM stok_log l
                            JOIN produk p ON l.produk_id = p.produk_id
                            ORDER BY l.tanggal DESC
                        ";

                        $result = $con->query($query);

                        if ($result && $result->num_rows > 0):
                            while ($row = $result->fetch_assoc()): ?>
                                <tr class="border-b">
                                    <td class="p-2"><?= $row['stok']; ?></td>
                                    <td class="p-2"><?= $row['perubahan'] > 0 ? $row['perubahan'] : '-'; ?></td>
                                    <td class="p-2"><?= $row['perubahan'] < 0 ? abs($row['perubahan']) : '-'; ?></td>
                                    <td class="p-2"><?= date("d M Y, H:i", strtotime($row['tanggal'])); ?></td>
                                </tr>
                            <?php endwhile;
                        else: ?>
                            <tr>
                                <td colspan="5" class="text-center p-2">Belum ada log stok</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <?php require "footer.php" ?>
</body>