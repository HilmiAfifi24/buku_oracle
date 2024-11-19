<?php
include "koneksi_oracle.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_buku = $_POST['nama_buku'];
    $jenis_buku = $_POST['jenis_buku'];

    // Query INSERT
    $sql = "INSERT INTO BUKU (NAMA_BUKU, JENIS_BUKU) VALUES (:nama_buku, :jenis_buku)";
    $stmt = oci_parse($con, $sql);

    // Bind parameter
    oci_bind_by_name($stmt, ":nama_buku", $nama_buku);
    oci_bind_by_name($stmt, ":jenis_buku", $jenis_buku);

    // Eksekusi query
    if (oci_execute($stmt)) {
        echo "<script>alert('Data berhasil ditambahkan!');</script>";
    } else {
        $e = oci_error($stmt);
        echo "<script>alert('Gagal menambahkan data: " . $e['message'] . "');</script>";
    }

    oci_free_statement($stmt);
}

oci_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Data Buku</title>
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
            <h1>Create Data Buku</h1>
            <form method="POST" action="create_buku.php">
                <label for="nama_buku">Nama Buku:</label><br>
                <input type="text" name="nama_buku" required><br><br>
                <label for="jenis_buku">Jenis Buku:</label><br>
                <input type="text" name="jenis_buku" required><br><br>
                <button type="submit">Submit</button>
            </form>
        </main>
    </div>
</body>
</html>