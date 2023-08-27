<?php
include 'koneksi/koneksi.php';
$id = $_GET["id_user"];
//mengambil id yang ingin dihapus

    //jalankan query DELETE untuk menghapus data
    $query = "DELETE FROM user WHERE id_user='$id' ";
    $hasil_query = mysqli_query($conn, $query);

    //periksa query, apakah ada kesalahan
    if(!$hasil_query) {
      die ("Gagal menghapus data: ".mysqli_errno($conn).
       " - ".mysqli_error($conn));
    } else {
      echo "<script>alert('Data berhasil dihapus.');window.location='data-user.php';</script>";
    }