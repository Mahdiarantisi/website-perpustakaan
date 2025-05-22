<?php
// Menghubungkan ke file koneksi.php yang berisi konfigurasi koneksi ke database
include 'koneksi.php';

// Mengecek apakah parameter 'id' dikirim melalui URL menggunakan metode GET
if (isset($_GET['id'])) {
    // Menyimpan nilai ID dari parameter URL ke dalam variabel $id
    $id = $_GET['id'];

    // Membuat query SQL untuk memperbarui kolom 'status' menjadi 'Dikembalikan' pada tabel loans berdasarkan ID
    $query = "UPDATE loans SET status = 'Dikembalikan' WHERE id = $id";

    // Menjalankan query SQL di atas menggunakan koneksi $conn
    $result = mysqli_query($conn, $query);

    // Mengecek apakah query berhasil dijalankan
    if ($result) {
        // Jika berhasil, pengguna akan diarahkan kembali ke halaman index.php
        header("Location: index.php");
        exit; // Menghentikan eksekusi skrip setelah redirect
    } else {
        // Jika terjadi kesalahan saat menjalankan query, tampilkan pesan error
        echo "<h3>❌ Gagal mengubah status. Pesan error:</h3>";
        echo "<p>" . mysqli_error($conn) . "</p>"; // Menampilkan detail error dari MySQL
    }
} else {
    // Jika parameter 'id' tidak tersedia di URL, tampilkan peringatan
    echo "<h3>⚠️ ID peminjaman tidak ditemukan.</h3>";
}
?>
