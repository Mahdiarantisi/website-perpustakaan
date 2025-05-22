<?php include 'koneksi.php'; ?>
<!-- Menghubungkan file ke database melalui koneksi.php -->

<!DOCTYPE html>
<html>
<head>
  <title>Daftar Peminjaman Buku</title>
  <!-- Mengimpor font Inter dari Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
  <style>
    /* Gaya umum untuk body */
    body {
      font-family: 'Inter', sans-serif;
      margin: 0;
      background-color: #f9f9f9;
    }

    /* Sidebar kiri */
    .sidebar {
      width: 220px;
      background-color: #2c2f38;
      color: #fff;
      position: fixed;
      height: 100vh;
      padding: 20px;
    }

    .sidebar h2 {
      font-size: 16px;
      margin-bottom: 30px;
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
    }

    .sidebar ul li {
      margin: 15px 0;
    }

    .sidebar ul li a {
      color: #fff;
      text-decoration: none;
    }

    /* Konten utama */
    .main {
      margin-left: 240px; /* Memberi ruang agar tidak tertutup sidebar */
      padding: 30px;
    }

    .main h2 {
      margin-bottom: 20px;
    }

    /* Tombol tambah */
    .btn {
      background-color: #3a71f8;
      color: #fff;
      padding: 8px 14px;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      margin-bottom: 20px;
      display: inline-block;
    }

    /* Tabel daftar peminjaman */
    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #fff;
    }

    table th, table td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
      text-align: left;
    }

    /* Status pinjaman */
    .status {
      padding: 4px 10px;
      border-radius: 6px;
      font-size: 12px;
      display: inline-block;
    }

    .dipinjam {
      background-color: #ddd;
      color: #333;
    }

    .dikembalikan {
      background-color: #c9f3da;
      color: #176c4d;
    }

    /* Tombol aksi */
    .aksi a {
      margin-right: 8px;
      text-decoration: none;
      color: #1a73e8;
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <h2>📚 Sistem Peminjaman <br> Buku Perpustakaan</h2>
  <ul>
    <li><a href="#">Dashboard</a></li>
    <li><a href="#">Peminjam</a></li>
    <li><a href="#">Buku</a></li>
    <li><a href="#">Peminjaman</a></li>
  </ul>
</div>

<!-- Konten utama -->
<div class="main">
  <h2>Peminjaman</h2>
  <!-- Tombol menuju halaman tambah -->
  <a class="btn" href="tambah_peminjaman.php">Pinjam Buku</a>

  <!-- Tabel daftar peminjaman -->
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Peminjam</th>
        <th>Judul Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    <?php
    // Query untuk mengambil data pinjaman beserta nama user dan judul buku
    $query = "SELECT loans.*, users.nama, books.judul FROM loans
              JOIN users ON loans.user_id = users.id
              JOIN books ON loans.book_id = books.id";
    $result = mysqli_query($conn, $query); // Eksekusi query
    $no = 1;

    // Menampilkan hasil query ke dalam baris-baris tabel
    while ($row = mysqli_fetch_assoc($result)) {
      // Menentukan kelas status berdasarkan isi kolom status
      $statusClass = ($row['status'] === 'Dikembalikan') ? 'dikembalikan' : 'dipinjam';

      // Menampilkan baris data
      echo "<tr>
              <td>$no</td>
              <td>{$row['nama']}</td>
              <td>{$row['judul']}</td>
              <td>{$row['tanggal_pinjam']}</td>
              <td><span class='status $statusClass'>{$row['status']}</span></td>
              <td class='aksi'>
                <a href='kembalikan.php?id={$row['id']}'>Kembalikan</a>
                <a href='edit_peminjaman.php?id={$row['id']}'>Update</a>
                <a href='hapus_peminjaman.php?id={$row['id']}'>Hapus</a>
              </td>
            </tr>";
      $no++;
    }
    ?>
    </tbody>
  </table>
</div>

</body>
</html>
