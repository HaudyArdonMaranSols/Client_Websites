
<?php 
require "koneksi.php";
// Ambil produk_id dari URL
$produk_id = isset($_GET['produk_id']) ? $_GET['produk_id'] : '';
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
    <header class="bg-blue-500 text-white text-center flex items-center justify-center h-[100px] text-[40px] font-bold shadow-md">
        STOK GUDANG
    </header>

    <main class="flex">
        <aside class="w-1/4 bg-white shadow-md p-4">
            <div class="text-center mb-6">
                <img src="../Assets/BannerKazumi.png" alt="Kazumi Store" class="w-32 mx-auto">
                <h2 class="text-lg font-bold mt-2">Kazumi Store</h2>
            </div>
            <button onclick="openstuff()" class="bg-orange-500 text-white px-4 py-2 rounded w-full font-semibold mb-4">
                Tambah Stok
            </button>
            <div class="text-center mb-6">
                <?php
                    if ($produk_id) {
                        // Query untuk mengambil data produk berdasarkan produk_id
                        $query = "SELECT nama_produk FROM produk WHERE produk_id = ?";
                        $stmt = $con->prepare($query);
                        $stmt->bind_param('i', $produk_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                    
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo "<h2 class='text-center mb-6'>Stok Barang: " . $row['nama_produk'] . "</h2>";
                        } else {
                            echo "<p>Produk tidak ditemukan.</p>";
                        }
                    }
                ?>
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
                            <th class="p-2 text-left">Stok Gudang Aktif</th>
                            <th class="p-2 text-left">Stok Masuk</th>
                            <th class="p-2 text-left">Stok Keluar</th>
                            <th class="p-2 text-left">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $query = "
                            SELECT p.nama_produk, p.stok, l.jumlah, l.jenis, l.tanggal 
                            FROM stok_log l
                            JOIN produk p ON l.produk_id = p.produk_id
                            WHERE p.produk_id = ?
                            ORDER BY l.tanggal ASC
                        ";
                        
                        $stmt = $con->prepare($query);
                        $stmt->bind_param('i', $produk_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result && $result->num_rows > 0):
                            while ($row = $result->fetch_assoc()): ?>
                                <tr class="border-b">
                                    <td class="p-2"><?= $row['stok']; ?></td>
                                    <td class="p-2"><?= $row['jenis'] === 'masuk' ? $row['jumlah'] : '-'; ?></td>
                                    <td class="p-2"><?= $row['jenis'] === 'keluar' ? $row['jumlah'] : '-'; ?></td>
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

    <!-- tambah stok -->
    <div id="stuff" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white w-1/3 p-6 rounded shadow-lg">
            <h2 class="text-2xl font-bold mb-4">Tambah Stok</h2>
            <form action="tambah.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="produk_id" value="<?php echo $produk_id; ?>">

                <div class="mb-4">
                    <label for="stok" class="block font-semibold mb-2">Jumlah Barang:</label>
                    <input type="number" id="stok" name="stok" class="w-full border rounded px-2 py-1" required>
                </div>
                
                <div class="mb-4">
                    <label for="jenis" class="block font-semibold mb-2">Kategori:</label>
                    <select id="jenis" name="jenis" class="w-full border rounded px-2 py-1" required>
                        <option value="" disabled selected>Pilih Kategori</option>
                        <option value="masuk">Masuk</option>
                        <option value="keluar">Keluar</option>
                    </select>
                </div>
                
                <div class="flex justify-end">
                    <button type="button" onclick="closestuff()" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Batal</button>
                    <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded" name="simpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <?php require "footer.php" ?>
</body>
