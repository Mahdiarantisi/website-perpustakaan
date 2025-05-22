<?php
include 'koneksi.php';

$id = $_GET['id'];

// Ambil data peminjaman berdasarkan ID
$query = "SELECT * FROM loans WHERE id = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

// Ambil data user dan buku untuk dropdown
$users = mysqli_query($conn, "SELECT * FROM users");
$books = mysqli_query($conn, "SELECT * FROM books");

// Proses saat form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id']; // tetap diterima dari input hidden
    $book_id = $_POST['book_id'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];

    $update = "UPDATE loans SET user_id='$user_id', book_id='$book_id', tanggal_pinjam='$tanggal_pinjam' WHERE id=$id";
    mysqli_query($conn, $update);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Peminjaman</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f2f2f2;
      padding: 30px;
    }
    .form-container {
      background: #fff;
      padding: 20px 30px;
      border-radius: 8px;
      max-width: 500px;
      margin: auto;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }
    input, select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 4px;
      border: 1px solid #ccc;
    }
    select[disabled] {
      background-color: #eee;
      color: #555;
    }
    button {
      margin-top: 20px;
      background: #3a71f8;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
    }
    a {
      display: inline-block;
      margin-top: 15px;
      text-decoration: none;
      color: #3a71f8;
    }
  </style>
</head>
<body>

<div class="form-container">
  <h2>Edit Data Peminjaman</h2>
  <form method="POST" onsubmit="return confirm('Apakah kamu yakin ingin mengubah data ini?')">
    
    <label>Nama Peminjam</label>
    <select disabled>
      <?php 
      mysqli_data_seek($users, 0); // Reset pointer
      while ($user = mysqli_fetch_assoc($users)) { ?>
        <option value="<?= $user['id']; ?>" <?= $user['id'] == $data['user_id'] ? 'selected' : ''; ?>>
          <?= $user['nama']; ?>
        </option>
      <?php } ?>
    </select>
    <input type="hidden" name="user_id" value="<?= $data['user_id']; ?>">

    <label>Judul Buku</label>
    <select name="book_id" required>
      <?php 
      mysqli_data_seek($books, 0); // Reset pointer
      while ($book = mysqli_fetch_assoc($books)) { ?>
        <option value="<?= $book['id']; ?>" <?= $book['id'] == $data['book_id'] ? 'selected' : ''; ?>>
          <?= $book['judul']; ?>
        </option>
      <?php } ?>
    </select>

    <label>Tanggal Pinjam</label>
    <input type="date" name="tanggal_pinjam" value="<?= $data['tanggal_pinjam']; ?>" required>

    <button type="submit">Simpan Perubahan</button>
  </form>
  <a href="index.php">← Kembali ke daftar</a>
</div>

</body>
</html>
