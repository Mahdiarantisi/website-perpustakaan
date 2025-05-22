<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Tambah Peminjaman</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      margin: 0;
      background-color: #f5f5f5;
    }

    .container {
      max-width: 500px;
      margin: 60px auto;
      background-color: #fff;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      font-size: 26px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      margin-top: 18px;
      font-weight: 600;
    }

    input[type="text"], input[type="date"] {
      width: 100%;
      padding: 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 14px;
      outline: none;
    }

    .btn {
      display: block;
      width: 100%;
      padding: 12px;
      background-color: #3366ff;
      color: white;
      border: none;
      border-radius: 6px;
      margin-top: 25px;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
    }

    .btn:hover {
      background-color: #254eda;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Tambah Peminjaman</h2>
  <form action="simpan_peminjaman_manual.php" method="post">
    <label>Nama Peminjam:</label>
    <input type="text" name="nama_peminjam" placeholder="Masukkan nama peminjam" required>

    <label>Judul Buku:</label>
    <input type="text" name="judul_buku" placeholder="Masukkan judul buku" required>

    <label>Tanggal Pinjam:</label>
    <input type="date" name="tanggal_pinjam" required>

    <label>Tanggal Kembali:</label>
    <input type="date" name="tanggal_kembali">

    <button class="btn" type="submit">Simpan</button>
  </form>
</div>

</body>
</html>
