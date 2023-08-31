<?php
include 'koneksi/koneksi.php';
if ($status !== 'admin') {
    echo "<script>
        document.location.href='http://localhost/webkolah/panel/dashboard/';
    </script>";
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            var elements = document.getElementsByClassName("admin"); // Replace with the actual class name
            for (var i = 0; i < elements.length; i++) {
                elements[i].classList.add("d-none");
            }
        });
    </script>';
}
?>