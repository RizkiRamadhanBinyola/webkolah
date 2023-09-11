<?php 
    include 'koneksi/koneksi.php';

    if (isset($_POST['simpan'])) {
        $id_agama = htmlspecialchars($_POST['id_agama']);
        $nama_agama = htmlspecialchars($_POST['nama_agama']);
        $tgl_input = htmlspecialchars($_POST['tgl_input']);
        $user_input = htmlspecialchars($_POST['user_input']);
        $id_user = htmlspecialchars($_POST['id_user']);
    
        //cek id sudah terdaftar belum
        $result = mysqli_query($conn, "SELECT id_agama FROM agama WHERE id_agama = '$id_agama'");
        if (mysqli_fetch_assoc($result)) {
            echo "
            <script>
                alert('ID sudah terdaftar, silahkan ganit!');
                document.location.href='agama.php';
            </script>
            ";
            return false;
        }
    
        mysqli_query($conn, "INSERT INTO agama VALUES('$id_agama','$nama_agama','$tgl_input','$user_input','','','$id_user')");
    
        // var_dump($cek);
        // exit();
    
        if (mysqli_affected_rows($conn) > 0) {
            echo "
            <script>
                alert('Data Agama Berhasil dibuat');
                document.location.href='agama.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Data Agama Gagal dibuat');
                document.location.href='agama.php';
            </script>
            ";
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
        <title>Agama - WebKolah</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <!-- Navbar -->
        <?php include 'navbar.php'; ?>
        
            <div id="layoutSidenav_content">
                <!-- Start Body Content -->
                <main class="admin">
                    <!-- Body Content -->
                    <div class="container">
                        <h3 class="text-secondary display-6">Agama</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Master</li>
                                <li class="breadcrumb-item active" aria-current="page">Agama</li>
                            </ol>
                        </nav>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="fas fa-table me-1"></i>
                                    Data Agama
                                </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="card mb-4">

                                            <div class="card-body">
                                                <table id="datatablesSimple">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Agama</th>
                                                            <th>Tgl Input</th>
                                                            <th>User Input</th>
                                                            <th>Tgl Update</th>
                                                            <th>User Update</th>
                                                            <th>Akses</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php

                                                            $no = 1;
                                                            $query = "SELECT * FROM agama";
                                                            $sql = mysqli_query($conn, $query);
                                                            while ($row = mysqli_fetch_assoc($sql)) {
                                                                
                                                        ?>
                                                            <tr>
                                                                <td><?= $no++; ?></td>
                                                                <td><?= $row['nama_agama']; ?></td>
                                                                <td><?= $row['tgl_input']; ?></td>
                                                                <td><?= $row['user_input']; ?></td>
                                                                <td><?= $row['tgl_update']; ?></td>
                                                                <td><?= $row['user_update']; ?></td>
                                                                <td><?= $row['id_user']; ?></td>
                                                                <td>
                                                                    <a class="btn btn-warning btn-sm" type="button" href="edit_user.php?id_user=<?= $row['id_user']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                                                    <a class="btn btn-danger btn-sm" type="button" onclick="return confirm('Data akan di Hapus?')" href="hapus_user.php?id_user=<?= $row['id_user']; ?>"><i class="fa-solid fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                            }
                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Form Agama
                                </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <form action="" method="POST">
                                            <div class="row">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="id_agama" id="id_agama" required="required" class="form-control " placeholder="ID Agama">
                                                    <label class="mx-2" for="Id ">ID Agama</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="nama_agama" class="form-control" id="nama_agama" placeholder="Nama Agama">
                                                    <label class="mx-2" for="agama">Nama agama</label>
                                                </div>
                                                <div class="item form-group mb-3">
                                                        <input id="tgl_input" name="tgl_input" class="date-picker form-control" type="date" required="required">
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="text" id="user_input" name="user_input" required="required" class="form-control" placeholder="User Input">
                                                    <label class="mx-2" for="user input">User Input</label>
                                                </div>

                                                <div class="mb-3">
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected hidden disabled>-- Hak Akses --</option>
                                                         <?php
                                                         

                                                            $sql = mysqli_query($conn, "SELECT * FROM user WHERE hak_akses = '$status' AND id_user='$_SESSION[id_user];'");
                                                            while ($data = mysqli_fetch_assoc($sql)) {
                                                            ?>
                                                                <option value="<?= $data['id_user'] ?>"><?= $data['hak_akses'] ?> (<?= $data['nama'] ?>)</option>
                                                            <?php
                                                            }
                                                            ?>
                                                    </select>
                                                </div>

                                                <div class="col-6">
                                                    <input class="btn btn-success btn-block w-100" type="submit" name="simpan" value="Submit">
                                                </div>
                                                <div class="col-6">
                                                    <input class="btn btn-danger btn-block w-100" type="reset">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
        <script>
            $(function(){
                $('#datepicker').datepicker();
            });
        </script>
    </body>
</html>
