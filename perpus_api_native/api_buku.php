<?php
require "config.php";
$action = $_GET['action'] ?? '';

switch($action){

    case "read":
        $query = mysqli_query($conn,"SELECT * FROM buku");
        $data = mysqli_fetch_all($query, MYSQLI_ASSOC);
        echo json_encode($data);
    break;

    case "create":
        $judul = $_POST['judul'];
        $penulis = $_POST['penulis'];
        $stok = $_POST['stok'];
        $query = mysqli_query($conn,"INSERT INTO buku (judul,penulis,stok) VALUES('$judul','$penulis','$stok')");
        echo json_encode(["status"=>$query]);
    break;

    case "update":
        $id = $_POST['id'];
        $judul = $_POST['judul'];
        $penulis = $_POST['penulis'];
        $stok = $_POST['stok'];
        $query = mysqli_query($conn,"UPDATE buku SET judul='$judul', penulis='$penulis', stok='$stok' WHERE id='$id'");
        echo json_encode(["status"=>$query]);
    break;

    case "delete":
        $id = $_POST['id'];
        $query = mysqli_query($conn,"DELETE FROM buku WHERE id='$id'");
        echo json_encode(["status"=>$query]);
    break;

    default:
        echo json_encode(["error"=>"Action tidak ditemukan"]);
}
?>
