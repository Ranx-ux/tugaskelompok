<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Kasir Sederhana</title>
</head>
<body>
    <h2>Sistem Kasir Sederhana</h2>
    <form method="POST">
        <label for="nama">Nama Pembeli:</label><br>
        <input type="text" name="nama" id="nama" required><br><br>

        <h4>Jumlah Barang:</h4>
        <label for="pensil">Pensil:</label>
        <input type="number" name="jumlah_pensil" id="pensil" value="0" min="0"><br>
        <label for="buku">Buku:</label>
        <input type="number" name="jumlah_buku" id="buku" value="0" min="0"><br>
        <label for="penghapus">Penghapus:</label>
        <input type="number" name="jumlah_penghapus" id="penghapus" value="0" min="0"><br>
        <label for="pulpen">Pulpen:</label>
        <input type="number" name="jumlah_pulpen" id="pulpen" value="0" min="0"><br><br>

        <button type="submit">Hitung</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Data barang
        $barang = [
            ["nama" => "Pensil", "harga" => 5000],
            ["nama" => "Buku", "harga" => 15000],
            ["nama" => "Penghapus", "harga" => 3000],
            ["nama" => "Pulpen", "harga" => 7000],
        ];

        // Input dari user
        $namaPembeli = $_POST['nama'];
        $jumlahBarang = [
            (int)$_POST['jumlah_pensil'],
            (int)$_POST['jumlah_buku'],
            (int)$_POST['jumlah_penghapus'],
            (int)$_POST['jumlah_pulpen']
        ];

        // Fungsi untuk menghitung total belanja
        function hitungTotal($barang, $jumlahBarang) {
            $total = 0;
            foreach ($barang as $index => $item) {
                $subtotal = $item['harga'] * $jumlahBarang[$index];
                $total += $subtotal;
            }
            return $total;
        }

        // Fungsi untuk menghitung diskon
        function hitungDiskon($total) {
            return ($total > 100000) ? $total * 0.1 : 0;
        }

        // Fungsi untuk mencetak detail belanja
        function cetakDetail($barang, $jumlahBarang) {
            $total = 0;
            echo "<table border='1' cellpadding='5'>";
            echo "<tr><th>Nama Barang</th><th>Harga Satuan</th><th>Jumlah</th><th>Subtotal</th></tr>";
            foreach ($barang as $index => $item) {
                $subtotal = $item['harga'] * $jumlahBarang[$index];
                $total += $subtotal;
                echo "<tr>
                        <td>{$item['nama']}</td>
                        <td>Rp" . number_format($item['harga'], 0, ',', '.') . "</td>
                        <td>{$jumlahBarang[$index]}</td>
                        <td>Rp" . number_format($subtotal, 0, ',', '.') . "</td>
                      </tr>";
            }
            echo "</table>";
            return $total;
        }

        // Proses perhitungan
        $totalBelanja = hitungTotal($barang, $jumlahBarang);
        $diskon = hitungDiskon($totalBelanja);
        $totalAkhir = $totalBelanja - $diskon;

        // Tampilkan detail belanja
        echo "<h3>Detail Belanja</h3>";
        cetakDetail($barang, $jumlahBarang);

        echo "<p>Total Belanja: Rp" . number_format($totalBelanja, 0, ',', '.') . "</p>";
        echo "<p>Diskon: Rp" . number_format($diskon, 0, ',', '.') . "</p>";
        echo "<p><strong>Total Bayar: Rp" . number_format($totalAkhir, 0, ',', '.') . "</strong></p>";

        // Ucapan terima kasih
        echo "<p>Terima kasih, $namaPembeli, sudah berbelanja di toko kami!</p>";
    }
    ?>
</body>
</html>
