<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading....</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function alert() {
            let timerInterval
            Swal.fire({
            title: 'Loading...',
            html: 'Redirect ke dashboard admin dalam <b></b> milliseconds',
            timer: 2000,
            timerProgressBar: true,
            footer: '',
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft()
                }, 100)
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
            }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
                console.log('Akan tertutup dengan waktu!.')
            }
            })
        }
    </script>
</head>
<body>
<?php
    session_start();
    // Mengecek inputan email
    if(isset($_SESSION['email'])) {
        // Pindah ke dahsboard
        header("location: dashboard.php");
    } else {
    // Var email password
    $username = "iki";
    $email = "iki@gmail.com";
    $password = "123456";

    if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['user'])) {
        if($_POST['email'] == $email && $_POST['password'] == $password && $_POST['user']) {
            $_SESSION['user'] = $_POST['user'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = $_POST['password'];
            echo '<meta http-equiv="refresh" content="2; url=dashboard.php"/>';
            echo '<script>alert();</script>';
        } elseif ($_POST['user'] != $username && $_POST['email'] == $email && $_POST['password'] == $password) {
            echo "<center><h1>Gagal!, Username Salah</h1></center>";
            echo '<meta http-equiv="refresh" content="2; url=login.php"/>';
        }
         elseif($_POST['user'] == $username && $_POST['email'] != $email && $_POST['password'] == $password) {
            echo "<center><h1>Gagal!, Email Salah</h1></center>";
            echo '<meta http-equiv="refresh" content="2; url=login.php"/>';
        } elseif($_POST['user'] == $username && $_POST['email'] == $email && $_POST['password'] != $password) {
            echo "<center><h1>Gagal!, Password Salah</h1></center>";
            echo '<meta http-equiv="refresh" content="2; url=login.php"/>';
        } elseif($_POST['user'] != $username && $_POST['email'] != $email && $_POST['password'] != $password) {
            echo "<center><h1>Gagal!,Username, Email & Password Salah</h1></center>";
            echo '<meta http-equiv="refresh" content="2; url=login.php"/>';

        } 
    } else {
        echo "<center><h1>Gagal!, jangan biarkan email & password kosong</h1></center>";
        echo '<meta http-equiv="refresh" content="2; url=login.php"/>';
    }
    }
?>
</body>
</html>