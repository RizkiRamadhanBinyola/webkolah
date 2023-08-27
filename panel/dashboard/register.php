<?php

include 'navbar.php';
include 'koneksi/koneksi.php';

if ($_SESSION['hak_akses'] !== 'admin') {
    echo "
    <script>
        alert('Tidak mempunyai akses, Dilarang Masuk!');
        document.location.href = 'index.php';
    </script>
    ";
    exit();
}

if (isset($_POST['regis'])) {
    $username = strtolower(stripslashes($_POST['username']));
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password2 = mysqli_real_escape_string($conn, $_POST['password2']);
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    if (isset($_POST['hak_akses'])) {
        # code...
        $hakAkses = $_POST['hak_akses'];
    }

    if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['password2']) || empty($_POST['nama']) || empty($_POST['email']) || empty($_POST['hak_akses'])) {
        echo "
        <script>
            alert('Form tidak boleh kosong');
            document.location.href='register.php';
        </script>
        ";
        exit();
    }
    

    // Cek username yang sudah terdaftar
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "
        <script>
            alert('username sudah terdaftar, silahkan ganit!');
            document.location.href='register.php';
        </script>
        ";
        return false;
    }

    // Mengecek repeat password
    if ($password !== $password2) {
        echo "
        <script>
            alert('Konfirmasi Password Salah');
            document.location.href='register.php';
        </script>
        ";
        return false;
    }

    //ENKRIPSI PW
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Menyimpan data ke db
    mysqli_query($conn, "INSERT INTO user VALUES('','$username','$password','$nama','$email','$akses')");
    if (mysqli_affected_rows($conn)) {
        echo "
        <script>
            alert('username baru berhasil di buat!');
            document.location.href='register.php';
        </script>
        ";
    } else {
        echo mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register - WebKolah</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body class="sb-nav-fixed">
        <!-- Navbar -->
        
            <div id="layoutSidenav_content">
                <!-- Start Body Content -->
                <main>
                    <!-- Body Content -->
                    <div class="container mt-5">
                        <h3 class="text-secondary display-6">Form Register User</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Form Register User</li>
                            </ol>
                        </nav>
                        <div class="card">
                            <div class="card-body">
                                <h4>Input data user baru</h4>
                                <hr>
                                <form action="" method="POST">
                                    <div class="row">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="username" class="form-control" id="username" placeholder="Username">
                                            <label class="mx-2" for="username">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" name="nama" class="form-control" id="nm" placeholder="Nama">
                                            <label class="mx-2" for="nm">Nama</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                                            <label class="mx-2" for="floatingPassword">Password</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" name="password2" class="form-control" id="rfloatingPassword" placeholder="Repeat Password">
                                            <label class="mx-2" for="rfloatingPassword">Repeat Password</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                            <label class="mx-2" for="floatingInput">Email address</label>
                                        </div>
                                        <div>
                                            <select name="hak_akses" class="form-select form-select mb-3" aria-label=".form-select-lg example">
                                                <option selected hidden disabled>Hak Akses</option>
                                                <option value="admin">admin</option>
                                                <option value="operator">operator</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <input class="btn btn-success btn-block w-100" type="submit" name="regis" value="Daftar">
                                        </div>
                                        <div class="col-6">
                                            <input class="btn btn-danger btn-block w-100" type="reset">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
                <!-- End Body Content -->
            <?php include 'footer.php'; ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

        
    </body>
</html>
