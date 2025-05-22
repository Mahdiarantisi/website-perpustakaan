<?php
include 'koneksi.php';

$nama = $_POST['nama_peminjam'];
$judul = $_POST['judul_buku'];
$tanggal_pinjam = $_POST['tanggal_pinjam'];
$tanggal_kembali = $_POST['tanggal_kembali'];

// Cek atau insert user
$userCheck = mysqli_query($conn, "SELECT id FROM users WHERE nama='$nama'");
if (mysqli_num_rows($userCheck) > 0) {
  $user = mysqli_fetch_assoc($userCheck);
  $user_id = $user['id'];
} else {
  mysqli_query($conn, "INSERT INTO users (nama) VALUES ('$nama')");
  $user_id = mysqli_insert_id($conn);
}

// Cek atau insert buku
$bookCheck = mysqli_query($conn, "SELECT id FROM books WHERE judul='$judul'");
if (mysqli_num_rows($bookCheck) > 0) {
  $book = mysqli_fetch_assoc($bookCheck);
  $book_id = $book['id'];
} else {
  mysqli_query($conn, "INSERT INTO books (judul) VALUES ('$judul')");
  $book_id = mysqli_insert_id($conn);
}

// Insert ke loans
$query = "INSERT INTO loans (user_id, book_id, tanggal_pinjam, tanggal_kembali, status)
          VALUES ('$user_id', '$book_id', '$tanggal_pinjam', '$tanggal_kembali', 'Dipinjam')";

if (mysqli_query($conn, $query)) {
  header("Location: index.php");
} else {
  echo "Gagal menyimpan data: " . mysqli_error($conn);
}
?>
