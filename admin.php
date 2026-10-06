<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$pesan = "";

// CREATE
if (isset($_POST['tambah'])) {
    $judul = trim($_POST['judul']);
    $pengarang = trim($_POST['pengarang']);

    if ($judul !== "" && $pengarang !== "") {
        $stmt = mysqli_prepare($conn, "INSERT INTO buku (judul, pengarang) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $judul, $pengarang);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("Location: admin.php");
        exit;
    }
}

// DELETE
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];

    $stmt = mysqli_prepare($conn, "DELETE FROM buku WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: admin.php");
    exit;
}

// UPDATE
if (isset($_POST['update'])) {
    $id = (int) $_POST['id'];
    $judul = trim($_POST['judul']);
    $pengarang = trim($_POST['pengarang']);

    $stmt = mysqli_prepare($conn, "UPDATE buku SET judul = ?, pengarang = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "ssi", $judul, $pengarang, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: admin.php");
    exit;
}

// DATA YANG AKAN DIEDIT
$edit = null;

if (isset($_GET['edit'])) {
    $id = (int) $_GET['edit'];

    $stmt = mysqli_prepare($conn, "SELECT id, judul, pengarang FROM buku WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $result_edit = mysqli_stmt_get_result($stmt);
    $edit = mysqli_fetch_assoc($result_edit);

    mysqli_stmt_close($stmt);
}

// READ
$data_buku = mysqli_query($conn, "SELECT * FROM buku ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin CRUD</title>
</head>
<body>

    <h1>Halaman Admin</h1>
    <p>Selamat datang, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></p>

    <a href="logout.php">Logout</a>

    <hr>

    <?php if ($edit): ?>

        <h2>Edit Buku</h2>

        <form method="POST">
            <input type="hidden" name="id" value="<?= $edit['id'] ?>">

            <label>Judul</label><br>
            <input type="text" name="judul" value="<?= htmlspecialchars($edit['judul']) ?>" required>

            <br><br>

            <label>Pengarang</label><br>
            <input type="text" name="pengarang" value="<?= htmlspecialchars($edit['pengarang']) ?>" required>

            <br><br>

            <button type="submit" name="update">Update</button>
            <a href="admin.php">Batal</a>
        </form>

    <?php else: ?>

        <h2>Tambah Buku</h2>

        <form method="POST">
            <label>Judul</label><br>
            <input type="text" name="judul" required>

            <br><br>

            <label>Pengarang</label><br>
            <input type="text" name="pengarang" required>

            <br><br>

            <button type="submit" name="tambah">Tambah</button>
        </form>

    <?php endif; ?>

    <hr>

    <h2>Data Buku</h2>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Aksi</th>
        </tr>

        <?php while ($buku = mysqli_fetch_assoc($data_buku)): ?>
            <tr>
                <td><?= $buku['id'] ?></td>
                <td><?= htmlspecialchars($buku['judul']) ?></td>
                <td><?= htmlspecialchars($buku['pengarang']) ?></td>
                <td>
                    <a href="admin.php?edit=<?= $buku['id'] ?>">Edit</a>
                    |
                    <a href="admin.php?hapus=<?= $buku['id'] ?>"
                       onclick="return confirm('Yakin ingin menghapus data ini?')">
                        Hapus
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>
