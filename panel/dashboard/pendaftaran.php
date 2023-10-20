<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pendaftaran - WebKolah</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <!-- Navbar -->
    <?php 
        include 'koneksi/koneksi.php';
        include 'navbar.php'; 

        if (isset($_POST['daftar'])) {
            $nis = htmlspecialchars($_POST['nis']);
            $nama_siswa = htmlspecialchars($_POST['nama_siswa']);
            $alamat = htmlspecialchars($_POST['alamat']);
            $jk = htmlspecialchars($_POST['jenis_kelamin']);
            $tempatLahir = htmlspecialchars($_POST['tempat_lahir']);
            $negara = htmlspecialchars($_POST['negara']);
            $agama = htmlspecialchars($_POST['agama']);
            $kelas = htmlspecialchars($_POST['kelas']);
            $tglInput = date("Y-m-d");
            $userInput = $_SESSION['nama'];
            $id_user = $_SESSION['id_user'];

            $result = mysqli_query($conn, "SELECT nis FROM pendaftaran WHERE nis = '$nis'");
            if (mysqli_fetch_assoc($result)) {
                # code...
                echo "
                <script>
                    alert('username sudah terdaftar, silahkan ganit!');
                    document.location.href='pendaftaran.php';
                </script>
                ";
                return false;
            }

            mysqli_query($conn, "INSERT INTO pendaftaran (nis, nama_siswa, alamat, jenis_kelamin, tempat_lahir, tgl_lahir, status, id_negara, id_agama, id_jurusan, tgl_input, user_input, tgl_update, user_update, id_user) VALUES ('$nis', '$nama_siswa', '$alamat', '$jk', '$tempatLahir', '$tglInput', 'status', '$negara', '$agama', '$kelas', '$tglInput', '$userInput', '$tglInput', '$userInput', '$id_user')");

            if (mysqli_affected_rows($conn) > 0) {
                # code...
                echo "
                <script>
                    alert('username baru berhasil di buat!');
                    document.location.href='pendaftaran.php';
                </script>
                ";

            }else {
                echo mysqli_error($conn);
            }
        }
    ?>

    <div id="layoutSidenav_content">
        <!-- Start Body Content -->
        <main>
            <!-- Body Content -->
            <div class="container">
                <h3 class="text-secondary display-6">Pendaftaran</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pendaftaran</li>
                    </ol>
                </nav>

                <div class="card">
                    <div class="card-body">
                        <h4>Input data user baru</h4>
                        <hr>
                        <form action="" method="POST">
                            <div class="row">
                                <div class="form-floating mb-3">
                                    <input type="text" name="nis" class="form-control" id="nis" placeholder="NIS">
                                    <label class="mx-2" for="nis">NIS</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="nama_siswa" class="form-control" id="nm_siswa" placeholder="Nama Siswa">
                                    <label class="mx-2" for="nm_siswa">Nama Siswa</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="alamat" class="form-control" id="floatingPassword" placeholder="Password">
                                    <label class="mx-2" for="floatingPassword">Alamat</label>
                                </div>
                                <div>
                                    <select name="jenis_kelamin" class="form-select form-select mb-3" aria-label=".form-select-lg example">
                                        <option selected hidden disabled>-- Jenis Kelamin --</option>
                                        <option value="laki - laki">Laki - Laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="tempat_lahir" class="form-control" id="floatingInput" placeholder="Tempat Lahir">
                                    <label class="mx-2" for="floatingInput">Tempat Lahir</label>
                                </div>

                                <div>
                                    <select name="status" class="form-select form-select mb-3" aria-label=".form-select-lg example">
                                        <option selected hidden disabled>-- Status --</option>
                                        <option value="Baru">Baru</option>
                                        <option value="Pindahan">Pindahan</option>
                                    </select>
                                </div>

                                <div>
                                    <select name="negara" class="form-select form-select mb-3" aria-label=".form-select-lg example">
                                        <option selected hidden disabled>-- Kewarganegaraan --</option>
                                        <?php

                                        $query = "SELECT *
                                                    FROM kewarganegaraan ";
                                        $sql = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_assoc($sql)) {
                                        ?>

                                            <option value="<?= $row['id_negara']; ?>"><?= $row['nama_negara']; ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div>
                                    <select name="agama" class="form-select form-select mb-3" aria-label=".form-select-lg example">
                                        <option selected hidden disabled>-- Agama --</option>
                                        <?php
                                        $query = "SELECT * FROM agama";
                                        $sql = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_assoc($sql)) {

                                        ?>

                                            <option value="<?= $row['id_agama'] ?>"><?= $row['nama_agama'] ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div>
                                    <select name="kelas" class="form-select form-select mb-3" aria-label=".form-select-lg example">
                                        <option selected hidden disabled>-- Kelas --</option>
                                        <?php
                                                $query = "SELECT j.*, jj.nama_jenjang
                                                FROM jurusan AS j
                                                INNER JOIN jenjang AS jj ON j.id_jenjang = jj.id_jenjang";

                                                $sql = mysqli_query($conn, $query);
                                                while ($row = mysqli_fetch_assoc($sql)) {
                                        ?>
                                            <option value="<?= $row['id_jurusan']?>"><?= $row['nama_jenjang']; ?> <?= $row['nama_jurusan'] ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>


                                <div class="col-6">
                                    <input class="btn btn-success btn-block w-100" type="submit" name="daftar" value="Daftar">
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
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>

</body>

</html>