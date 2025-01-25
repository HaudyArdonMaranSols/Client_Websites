<?php "koneksi.php"; ?>
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
    <header class="bg-blue-500 text-orange-500 text-center flex items-center justify-center h-[100px] text-[40px] font-bold shadow-md">
        STOK TO
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
                            <th class="p-2 text-left">Nama Produk</th>
                            <th class="p-2 text-left">Stok</th>
                            <th class="p-2 text-left">Harga</th>
                            <th class="p-2">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="p-2">
                                <div class="font-bold">main query kategori barang disini</div>
                                <ul class="ml-4 list-disc">
                                    <li>main query barang disini</li>
                                </ul>
                            </td>
                            <td class="p-2">
                                <ul>
                                    <li>query</li>
                                </ul>
                            </td>
                            <td class="p-2">
                                <ul>
                                    <li>query</li>
                                </ul>
                            </td>
                            <td class="p-2 text-blue-500">
                                <a href="#" class="underline">Ubah</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-2">
                                <div class="font-bold">query kategori barang</div>
                                <ul class="ml-4 list-disc">
                                    <li>query barang</li>
                                </ul>
                            </td>
                            <td class="p-2">query</td>
                            <td class="p-2">query</td>
                            <td class="p-2 text-blue-500">
                                <a href="#" class="underline">Ubah</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <!-- tambah barang -->
    <div id="stuff" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white w-1/3 p-6 rounded shadow-lg">
            <h2 class="text-2xl font-bold mb-4">Tambah Barang</h2>
            <form action="proses_tambah_barang.php" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="nama_barang" class="block font-semibold mb-2">Nama Barang:</label>
                    <input type="text" id="nama_barang" name="nama_barang" class="w-full border rounded px-2 py-1" required>
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
                        <option value="parfum">Parfum</option>
                        <option value="pengharum">Pengharum Ruangan</option>
                        <option value="pewarna">Pewarna & Perawatan Rambut</option>
                        <option value="peralatan rumah tangga">Perawatan Tubuh & Skincare</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="foto" class="block font-semibold mb-2">Foto Barang:</label>
                    <input type="file" id="foto" name="foto" class="w-full border rounded px-2 py-1" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closestuff()" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Batal</button>
                    <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>


    <?php require "footer.php" ?>
</body>