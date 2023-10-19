<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Kewarganegaraan - WebKolah</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <!-- Navbar -->
    <?php
    include 'koneksi/koneksi.php';
    include 'navbar.php';

    $id_negara = "";
    $nama_negara = "";
    $mode = "Tambah"; // Default mode adalah tambah

    if (isset($_GET['action']) && $_GET['action'] == 'update') {
        // Jika sedang dalam mode edit, ambil data yang akan diedit dari database
        $mode = "Edit";
        $id_negara_to_update = $_GET['id_negara']; // Ganti dengan parameter yang sesuai
        $query = "SELECT * FROM kewarganegaraan WHERE id_negara = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $id_negara_to_update);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $id_negara = $row['id_negara'];
            $nama_negara = $row['nama_negara'];
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['simpan'])) {
            // Jika tombol "simpan" ditekan, proses simpan atau update data

            // Ambil data dari form
            $id_negara = $_POST['id_negara'];
            $nama_negara = $_POST['nama_negara'];

            // Filter data yang diinputkan
            $id_negara = filter_var($id_negara, FILTER_SANITIZE_STRING);
            $nama_negara = filter_var($nama_negara, FILTER_SANITIZE_STRING);

            // Validasi data
            if (empty($id_negara) || empty($nama_negara)) {
                $error = "Form kosong";
                echo "<script>alert('Form kosong');</script>";
            }

            if (!isset($error)) {
                if ($mode == "Tambah") {
                    // Jika dalam mode tambah, lakukan penambahan data
                    $insert_query = "INSERT INTO kewarganegaraan (id_negara, nama_negara, tgl_input, user_input, id_user, tgl_update, user_update) VALUES (?, ?, ?, ?, ?,'', '')";
                    $insert_stmt = $conn->prepare($insert_query);
                    $tgl_input = date("Y-m-d");
                    $user_input = $_SESSION['nama'];
                    $id_user = $_SESSION['id_user'];
                    $insert_stmt->bind_param('sssss', $id_negara, $nama_negara, $tgl_input, $user_input, $id_user);
                    if ($insert_stmt->execute()) {
                        echo "<script>alert('Data berhasil disimpan');</script>";
                    } else {

                        echo "<script>alert('Data gagal disimpan');</script>";
                    }
                } elseif ($mode == "Edit") {
                    // Jika dalam mode edit, lakukan pembaruan data
                    $update_query = "UPDATE kewarganegaraan SET nama_negara = ?, tgl_update = ?, user_update = ? WHERE id_negara = ?";
                    $update_stmt = $conn->prepare($update_query);
                    $tgl_update = date("Y-m-d");
                    $user_update = $_SESSION['nama'];
                    $update_stmt->bind_param('ssss', $nama_negara, $tgl_update, $user_update, $id_negara);
                    if ($update_stmt->execute()) {
                        echo "<script>
                                   alert('Data berhasil diperbarui');
                                   window.location.href='kewarganegaraan.php';
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
                                <input type="hidden" name="id_negara" value="<?= $id_negara ?>">

                                <div class="row">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="id_negara" class="form-control" id="id_negara" placeholder="id_negara" value="<?= $id_negara ?>">
                                        <label class="mx-2" for="id_negara">Id Negara</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" name="nama_negara" class="form-control" id="nama_negara" placeholder="nama_negara" value="<?= $nama_negara ?>">
                                        <label class="mx-2" for="nama_negara">Nama Negara</label>
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
                                        <th>Nama Negara</th>
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
                                    $query = "SELECT * FROM kewarganegaraan AS k INNER JOIN user AS u ON k.id_user = u.id_user";
                                    $sql = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($sql)) {

                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['nama_negara']; ?></td>
                                            <td><?= $row['tgl_input']; ?></td>
                                            <td><?= $row['user_input']; ?></td>
                                            <td><?= $row['tgl_update']; ?></td>
                                            <td><?= $row['user_update']; ?></td>
                                            <td><?= $row['hak_akses']; ?>(<?= $row['username'] ?>)</td>
                                            <td><?= $row['id_user']; ?></td>
                                            <td>
                                                <a class="btn btn-warning btn-sm" type="button" href="kewarganegaraan.php?action=update&id_negara=<?= $row['id_negara'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                                <a class="btn btn-danger btn-sm" type="button" onclick="return confirm('Data akan di Hapus?')" href="hapus-data.php?id_negara=<?= $row['id_negara']; ?>&form=3"><i class="fa-solid fa-trash"></i></a>
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

</body>

</html>