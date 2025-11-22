<?php
header("Content-Type: application/json");
$conn = mysqli_connect("localhost", "root", "", "perpustakaan");
if(!$conn){
    echo json_encode(["error"=>"Gagal koneksi database"]);
    exit;
}
?>
