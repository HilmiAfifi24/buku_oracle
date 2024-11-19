<?php
include "koneksi_oracle.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ID_BUKU'])) {
    $ID_BUKU = $_POST['ID_BUKU'];

    // Query DELETE
    $sql = "DELETE FROM BUKU WHERE ID_BUKU = :ID_BUKU";
    $stmt = oci_parse($con, $sql);

    // Bind parameter
    oci_bind_by_name($stmt, ":ID_BUKU", $ID_BUKU);

    // Eksekusi query
    if (oci_execute($stmt)) {
        echo "<script>alert('Data berhasil dihapus!');</script>";
    } else {
        $e = oci_error($stmt);
        echo "<script>alert('Gagal menghapus data: " . $e['message'] . "');</script>";
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
    <title>Delete Data Buku</title>
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
            <h1>Delete Data Buku</h1>
            <form method="POST" action="delete_buku.php">
                <label for="ID_BUKU">ID Buku:</label><br>
                <input type="text" name="ID_BUKU" required><br><br>
                <button type="submit">Delete</button>
            </form>
        </main>
    </div>
</body>
</html>
