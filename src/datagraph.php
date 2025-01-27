<?php
$query_stok_log = "
    SELECT tanggal, SUM(CASE WHEN jenis = 'masuk' THEN jumlah ELSE 0 END) AS stok_masuk,
           SUM(CASE WHEN jenis = 'keluar' THEN jumlah ELSE 0 END) AS stok_keluar
    FROM stok_log
    WHERE produk_id = ?
    GROUP BY DATE(tanggal)
    ORDER BY tanggal ASC
";

$stmt = $con->prepare($query_stok_log);
$stmt->bind_param('i', $produk_id);
$stmt->execute();
$result = $stmt->get_result();

$stok_masuk = [];
$stok_keluar = [];
$dates = [];

while ($row = $result->fetch_assoc()) {
    $dates[] = date('d M Y', strtotime($row['tanggal']));
    $stok_masuk[] = (int) $row['stok_masuk'];
    $stok_keluar[] = (int) $row['stok_keluar'];
}
?>
