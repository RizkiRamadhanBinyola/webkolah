<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Data Pendaftaran - WebKolah</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <!-- Navbar -->
        <?php include 'navbar.php'; ?>
        
            <div id="layoutSidenav_content">
                <!-- Start Body Content -->
                <main>
                    <!-- Body Content -->
                    <div class="container">
                        <h3 class="text-secondary display-6">Data Pendaftaran</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Data Pendaftaran</li>
                            </ol>
                        </nav>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Akses</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include 'koneksi/koneksi.php';
                                    $no = 1;
                                    $query = "SELECT *
                                    FROM user ";
                                    $sql = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($sql)) {
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['username']; ?></td>
                                        <td><?= $row['nama']; ?></td>
                                        <td><?= $row['email']; ?></td>
                                        <td><?= $row['hak_akses']; ?></td>
                                        <td>
                                            <a class="btn btn-warning btn-sm" type="button"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a class="btn btn-danger btn-sm" type="button" onclick="return confirm('Data akan di Hapus?')" href="hapus_user.php?id_user=<?= $row['id_user']; ?>"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                ?>

                            </tbody>
                        </table>
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
