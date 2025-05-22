<?php
// Mengimpor koneksi ke database dari file koneksi.php
include 'koneksi.php';

// Memeriksa apakah parameter 'id' dikirim melalui URL (GET)
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Menyimpan nilai id dari URL ke variabel $id

    // Query SQL untuk menghapus data dari tabel loans berdasarkan id
    $query = "DELETE FROM loans WHERE id = $id";
    $result = mysqli_query($conn, $query); // Menjalankan query ke database

    // Jika query berhasil dijalankan
    if ($result) {
        // Redirect pengguna kembali ke halaman index.php
        header("Location: index.php");
        exit; // Menghentikan eksekusi script
    } else {
        // Jika terjadi kesalahan saat menghapus data, tampilkan pesan error
        echo "<h3>❌ Gagal menghapus data peminjaman. Pesan error:</h3>";
        echo "<p>" . mysqli_error($conn) . "</p>"; // Menampilkan error dari MySQL
    }
} else {
    // Jika tidak ada parameter 'id' di URL, tampilkan peringatan
    echo "<h3>⚠️ ID peminjaman tidak ditemukan.</h3>";
}
?>

