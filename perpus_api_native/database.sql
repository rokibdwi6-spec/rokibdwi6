CREATE DATABASE perpustakaan;
USE perpustakaan;

-- Tabel Buku
CREATE TABLE buku (
  id INT AUTO_INCREMENT PRIMARY KEY,
  judul VARCHAR(255),
  penulis VARCHAR(255),
  stok INT
);

-- Tabel Transaksi Peminjaman
CREATE TABLE peminjaman (
  id INT AUTO_INCREMENT PRIMARY KEY,
  buku_id INT,
  nama_peminjam VARCHAR(255),
  tanggal_pinjam DATE,
  tanggal_kembali DATE,
  status ENUM('pinjam', 'kembali') DEFAULT 'pinjam',
  FOREIGN KEY (buku_id) REFERENCES buku(id)
);
