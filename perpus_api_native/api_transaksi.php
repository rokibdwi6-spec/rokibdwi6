<?php
require "config.php";
$action = $_GET['action'] ?? '';

switch($action){

    case "pinjam":
        $buku_id = $_POST['buku_id'];
        $nama = $_POST['nama_peminjam'];
        $cek = mysqli_fetch_assoc(mysqli_query($conn,"SELECT stok FROM buku WHERE id='$buku_id'"));
        if($cek['stok']<=0){
            echo json_encode(["error"=>"Stok habis"]);
            exit;
        }
        mysqli_query($conn,"UPDATE buku SET stok=stok-1 WHERE id='$buku_id'");
        mysqli_query($conn,"INSERT INTO peminjaman (buku_id,nama_peminjam,tanggal_pinjam) VALUES('$buku_id','$nama',NOW())");
        echo json_encode(["status"=>"Peminjaman berhasil"]);
    break;

    case "kembali":
        $id = $_POST['id'];
        mysqli_query($conn,"UPDATE peminjaman SET status='kembali', tanggal_kembali=NOW() WHERE id='$id'");
        $data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT buku_id FROM peminjaman WHERE id='$id'"));
        $buku_id = $data['buku_id'];
        mysqli_query($conn,"UPDATE buku SET stok=stok+1 WHERE id='$buku_id'");
        echo json_encode(["status"=>"Pengembalian berhasil"]);
    break;

    case "riwayat":
        $query = mysqli_query($conn,"
            SELECT p.*, b.judul 
            FROM peminjaman p 
            JOIN buku b ON p.buku_id=b.id
            ORDER BY p.id DESC
        ");
        $data = mysqli_fetch_all($query, MYSQLI_ASSOC);
        echo json_encode($data);
    break;

    default:
        echo json_encode(["error"=>"Action tidak ditemukan"]);
}
?>
