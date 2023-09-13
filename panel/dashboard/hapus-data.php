<?php
include 'koneksi/koneksi.php';

$form = $_GET['form'];

try {
    switch ($form) {
        case 1:
            # code...
            $id = $_GET["id_agama"];
            //mengambil id yang ingin dihapus

                //jalankan query DELETE untuk menghapus data
                $query = "DELETE FROM agama WHERE id_agama='$id' ";
                $hasil_query = mysqli_query($conn, $query);

                //periksa query, apakah ada kesalahan
                if(!$hasil_query) {
                die ("Gagal menghapus data: ".mysqli_errno($conn).
                " - ".mysqli_error($conn));
                } else {
                echo "<script>alert('Data berhasil dihapus.');window.location='agama.php';</script>";
                }
            break;
        case 2:
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
            break;
        default:
            # code...
            break;
    }
}catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}