<?php
include 'koneksi.php';

$user_id = $_POST['user_id'];
$book_id = $_POST['book_id'];
$tanggal_pinjam = $_POST['tanggal_pinjam'];
$tanggal_kembali = $_POST['tanggal_kembali'];

$query = "INSERT INTO loans (user_id, book_id, tanggal_pinjam, tanggal_kembali, status)
          VALUES ('$user_id', '$book_id', '$tanggal_pinjam', '$tanggal_kembali', 'Dipinjam')";

if (mysqli_query($conn, $query)) {
  header("Location: index.php");
} else {
  echo "Gagal menyimpan data: " . mysqli_error($conn);
}
?>
