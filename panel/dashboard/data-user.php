<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Data User - WebKolah</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body class="sb-nav-fixed">
        <!-- Navbar -->
        <?php include 'navbar.php'; ?>

            <div id="layoutSidenav_content">
                <!-- Start Body Content -->
                <main>
                    <!-- Body Content -->
                    <div class="container">
                        <h3 class="text-secondary display-6">Data user</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">data user</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="container">
                        <!-- <table border="1">
                            <tr>
                                <th>NO</th>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Alamat</th>
                                <th>OPSI</th>
                            </tr>
                            <?php 
                            include 'koneksi/config.php';
                            $no = 1;
                            $sql = "SELECT * FROM `user`";
                            $query = $conn->prepare($sql);
                            $query->execute();
                    
                            while($fetch = $query->fetch()){
                                ?>
                                <tr>
                                    <td><?php echo $fetch['nama']?></td>
                                    <td><?php echo $fetch['email']?></td>
                                    <td><?php echo $fetch['hak_akses']?></td>
                                </tr>
                                <?php 
                            }
                            ?>
                        </table> -->

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Hak akses</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    include 'koneksi/config.php';
                                    if(isset($_POST['action']) && $_POST['action'] == 'delete') {
                                        $id_user = $_POST['id_user'];
                                        
                                        // Construct the delete statement
                                        $sql = 'DELETE FROM user
                                                WHERE id_user = :id_user';
                                    
                                        // Prepare the statement for execution
                                        $statement = $conn->prepare($sql);
                                        $statement->bindParam(':id_user', $id_user, PDO::PARAM_INT);
                                    
                                        // Execute the statement
                                        if ($statement->execute()) {
                                            // Redirect back to the page after deletion
                                            echo "<script>
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Berhasil dihapus',
                                                text: 'Data berhasil dihapus',
                                            });
                                            </script>";
                                        }
                                    }

                                    $sql = "SELECT * FROM `user`";
                                    $query = $conn->prepare($sql);
                                    $query->execute();
                                    $no = 1;

                                    while($fetch = $query->fetch()){
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $no; ?></th>
                                    <td><?php echo $fetch['username']; ?></td>
                                    <td><?php echo $fetch['nama']; ?></td>
                                    <td><?php echo $fetch['email']; ?></td>
                                    <td><?php echo $fetch['hak_akses']; ?></td>
                                    <td>
                                        <form method="POST" action="data-user.php">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="id_user" value="<?php echo $fetch['id_user']; ?>">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin akan menghapus data ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        <a href="edit_user.php?id=<?php echo $fetch['id_user']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                                <?php
                                        $no++;
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
