<?php
include "koneksi_oracle.php";

// Query SELECT
$sql = "SELECT * FROM BUKU";
$stmt = oci_parse($con, $sql);
oci_execute($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampilkan Data Buku</title>
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
            <h1>Tampilkan Data Buku</h1>
            <table border="1">
                <tr>
                    <th>ID Buku</th>
                    <th>Nama Buku</th>
                    <th>Jenis Buku</th>
                </tr>
                <?php while ($row = oci_fetch_assoc($stmt)): ?>
                    <tr>
                        <td><?= $row['ID_BUKU'] ?></td>
                        <td><?= $row['NAMA_BUKU'] ?></td>
                        <td><?= $row['JENIS_BUKU'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </main>
    </div>
</body>
</html>
