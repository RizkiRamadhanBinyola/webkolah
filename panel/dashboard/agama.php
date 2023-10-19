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
    <?php
    include 'koneksi/koneksi.php';
    include 'navbar.php';

    $id_agama = "";
    $nama_agama = "";
    $mode = "Tambah"; // Default mode adalah tambah

    if (isset($_GET['action']) && $_GET['action'] == 'update') {
        // Jika sedang dalam mode edit, ambil data yang akan diedit dari database
        $mode = "Edit";
        $id_agama_to_update = $_GET['id_agama']; // Ganti dengan parameter yang sesuai
        $query = "SELECT * FROM agama WHERE id_agama = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $id_agama_to_update);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $id_agama = $row['id_agama'];
            $nama_agama = $row['nama_agama'];
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['simpan'])) {
            // Jika tombol "simpan" ditekan, proses simpan atau update data

            // Ambil data dari form
            $id_agama = $_POST['id_agama'];
            $nama_agama = $_POST['nama_agama'];

            // Filter data yang diinputkan
            $id_agama = filter_var($id_agama, FILTER_SANITIZE_STRING);
            $nama_agama = filter_var($nama_agama, FILTER_SANITIZE_STRING);

            // Validasi data
            if (empty($id_agama) || empty($nama_agama)) {
                $error = "Form kosong";
                echo "<script>alert('Form kosong');</script>";
            }

            if (!isset($error)) {
                if ($mode == "Tambah") {
                    // Jika dalam mode tambah, lakukan penambahan data
                    $insert_query = "INSERT INTO agama (id_agama, nama_agama, tgl_input, user_input, id_user, tgl_update, user_update) VALUES (?, ?, ?, ?, ?,'', '')";
                    $insert_stmt = $conn->prepare($insert_query);
                    $tgl_input = date("Y-m-d");
                    $user_input = $_SESSION['nama'];
                    $id_user = $_SESSION['id_user'];
                    $insert_stmt->bind_param('sssss', $id_agama, $nama_agama, $tgl_input, $user_input, $id_user);
                    if ($insert_stmt->execute()) {
                        echo "<script>alert('Data berhasil disimpan');</script>";
                    } else {

                        echo "<script>alert('Data gagal disimpan');</script>";
                    }
                } elseif ($mode == "Edit") {
                    // Jika dalam mode edit, lakukan pembaruan data
                    $update_query = "UPDATE agama SET nama_agama = ?, tgl_update = ?, user_update = ? WHERE id_agama = ?";
                    $update_stmt = $conn->prepare($update_query);
                    $tgl_update = date("Y-m-d");
                    $user_update = $_SESSION['nama'];
                    $update_stmt->bind_param('ssss', $nama_agama, $tgl_update, $user_update, $id_agama);
                    if ($update_stmt->execute()) {
                        echo "<script>
                        alert('Data berhasil diperbarui');
                        window.location.href='agama.php';
                    </script>";
                    } else {
                        echo "<script>alert('Data gagal diperbarui');</script>";
                    }
                }
            }
        }
    }

    ?>

    <div id="layoutSidenav_content">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            Form Agama
                        </div>
                        <div class="card-body">
                            <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
                                <input type="hidden" name="id_agama" value="<?= $id_agama ?>">

                                <div class="row">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="id_agama" class="form-control" id="id_agama" placeholder="id_agama" value="<?= $id_agama ?>">
                                        <label class="mx-2" for="id_agama">Id Agama</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" name="nama_agama" class="form-control" id="nama_agama" placeholder="nama_agama" value="<?= $nama_agama ?>">
                                        <label class="mx-2" for="nama_agama">Nama Agama</label>
                                    </div>
                                    <div class="col-6">
                                        <input class="btn btn-primary btn-block w-100" type="submit" name="simpan" value="<?= $mode ?>">
                                    </div>
                                    <div class="col-6">
                                        <input class="btn btn-danger btn-block w-100" type="reset">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            Tabel Agama
                        </div>
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
                                        <th>ID USER</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'koneksi/koneksi.php';

                                    $no = 1;
                                    $query = "SELECT * FROM agama AS a INNER JOIN user AS u ON a.id_user = u.id_user";
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
                                            <td><?= $row['hak_akses']; ?>(<?= $row['username'] ?>)</td>
                                            <td><?= $row['id_user']; ?></td>
                                            <td>
                                                <a class="btn btn-warning btn-sm" type="button" href="agama.php?action=update&id_agama=<?= $row['id_agama'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                                <a class="btn btn-danger btn-sm" type="button" onclick="return confirm('Data akan di Hapus?')" href="hapus-data.php?id_agama=<?= $row['id_agama']; ?>&form=1"><i class="fa-solid fa-trash"></i></a>
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
        $(function() {
            $('#datepicker').datepicker();
        });
    </script>
</body>

</html>