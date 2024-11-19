<?php
include "koneksi_oracle.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_buku = $_POST['id_buku'];
    $nama_buku = $_POST['nama_buku'];
    $jenis_buku = $_POST['jenis_buku'];

    // Query UPDATE
    $sql = "UPDATE BUKU SET NAMA_BUKU = :nama_buku, JENIS_BUKU = :jenis_buku WHERE ID_BUKU = :id_buku";
    $stmt = oci_parse($con, $sql);

    // Bind parameter
    oci_bind_by_name($stmt, ":id_buku", $id_buku);
    oci_bind_by_name($stmt, ":nama_buku", $nama_buku);
    oci_bind_by_name($stmt, ":jenis_buku", $jenis_buku);

    // Eksekusi query
    if (oci_execute($stmt)) {
        // Periksa jumlah baris yang diperbarui
        $rows_updated = oci_num_rows($stmt);
        if ($rows_updated > 0) {
            echo "<script>alert('Data berhasil diperbarui!');</script>";
        } else {
            echo "<script>alert('Data dengan ID Buku $id_buku tidak ditemukan!');</script>";
        }
    } else {
        // Tangani error jika query gagal
        $e = oci_error($stmt);
        echo "<script>alert('Gagal memperbarui data: " . $e['message'] . "');</script>";
    }

    // Bersihkan statement
    oci_free_statement($stmt);
}

// Tutup koneksi
oci_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Buku</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <nav>
                <ul>
                    <li><a href="create_buku.php">Create Data</a></li>
                    <li><a href="update_buku.php">Update Data</a></li>
                    <li><a href="delete_buku.php">Delete Data</a></li>
                    <li><a href="show_buku.php">Tampilkan Data</a></li>
                </ul>
            </nav>
        </aside>
        <main class="content">
            <h1>Update Data Buku</h1>
            <form method="POST" action="update_buku.php">
                <label for="id_buku">ID Buku:</label><br>
                <input type="text" name="id_buku" required><br><br>
                <label for="nama_buku">Nama Buku:</label><br>
                <input type="text" name="nama_buku" required><br><br>
                <label for="jenis_buku">Jenis Buku:</label><br>
                <input type="text" name="jenis_buku" required><br><br>
                <button type="submit">Update</button>
            </form>
        </main>
    </div>
</body>
</html>
