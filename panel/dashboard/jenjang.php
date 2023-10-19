<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Jenjang - WebKolah</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <!-- Navbar -->
    <?php
    include 'koneksi/koneksi.php';
    include 'navbar.php';

    $id_jenjang = "";
    $nama_jenjang = "";
    $mode = "Tambah"; // Default mode adalah tambah

    if (isset($_GET['action']) && $_GET['action'] == 'update') {
        // Jika sedang dalam mode edit, ambil data yang akan diedit dari database
        $mode = "Edit";
        $id_jenjang_to_update = $_GET['id_jenjang']; // Ganti dengan parameter yang sesuai
        $query = "SELECT * FROM jenjang WHERE id_jenjang = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $id_jenjang_to_update);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $id_jenjang = $row['id_jenjang'];
            $nama_jenjang = $row['nama_jenjang'];
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['simpan'])) {
            // Jika tombol "simpan" ditekan, proses simpan atau update data

            // Ambil data dari form
            $id_jenjang = $_POST['id_jenjang'];
            $nama_jenjang = $_POST['nama_jenjang'];

            // Filter data yang diinputkan
            $id_jenjang = filter_var($id_jenjang, FILTER_SANITIZE_STRING);
            $nama_jenjang = filter_var($nama_jenjang, FILTER_SANITIZE_STRING);

            // Validasi data
            if (empty($id_jenjang) || empty($nama_jenjang)) {
                $error = "Form kosong";
                echo "<script>alert('Form kosong');</script>";
            }

            if (!isset($error)) {
                if ($mode == "Tambah") {
                    // Jika dalam mode tambah, lakukan penambahan data
                    $insert_query = "INSERT INTO jenjang (id_jenjang, nama_jenjang, tgl_input, user_input) VALUES (?, ?, ?, ?)";
                    $insert_stmt = $conn->prepare($insert_query);
                    $tgl_input = date("Y-m-d");
                    $user_input = $_SESSION['nama'];
                    $insert_stmt->bind_param('ssss', $id_jenjang, $nama_jenjang, $tgl_input, $user_input);
                    if ($insert_stmt->execute()) {
                        echo "<script>alert('Data berhasil disimpan');</script>";
                    } else {
                        echo "<script>alert('Data gagal disimpan');</script>";
                    }
                } elseif ($mode == "Edit") {
                    // Jika dalam mode edit, lakukan pembaruan data
                    $update_query = "UPDATE jenjang SET nama_jenjang = ?, tgl_update = ?, user_update = ? WHERE id_jenjang = ?";
                    $update_stmt = $conn->prepare($update_query);
                    $tgl_update = date("Y-m-d");
                    $user_update = $_SESSION['nama'];
                    $update_stmt->bind_param('ssss', $nama_jenjang, $tgl_update, $user_update, $id_jenjang);
                    if ($update_stmt->execute()) {
                        echo "<script>
                            alert('Data berhasil diperbarui');
                            window.location.href='jenjang.php';
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
                            Form Jenjang
                        </div>
                        <div class="card-body">
                            <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
                                <input type="hidden" name="id_jenjang" value="<?= $id_jenjang ?>">

                                <div class="row">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="id_jenjang" class="form-control" id="id_jenjang" placeholder="id_jenjang" value="<?= $id_jenjang ?>">
                                        <label class="mx-2" for="id_jenjang">Id Jenjang</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" name="nama_jenjang" class="form-control" id="nama_jenjang" placeholder="nama_jenjang" value="<?= $nama_jenjang ?>">
                                        <label class="mx-2" for="nama_jenjang">Nama Jenjang</label>
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
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'koneksi/koneksi.php';

                                    $no = 1;
                                    $query = "SELECT * FROM jenjang";
                                    $sql = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($sql)) {

                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['nama_jenjang']; ?></td>
                                            <td><?= $row['tgl_input']; ?></td>
                                            <td><?= $row['user_input']; ?></td>
                                            <td><?= $row['tgl_update']; ?></td>
                                            <td><?= $row['user_update']; ?></td>
                                            <td>
                                                <a class="btn btn-warning btn-sm" type="button" href="jenjang.php?action=update&id_jenjang=<?= $row['id_jenjang'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                                <a class="btn btn-danger btn-sm" type="button" onclick="return confirm('Data akan di Hapus?')" href="hapus-data.php?id_jenjang=<?= $row['id_jenjang']; ?>&form=4"><i class="fa-solid fa-trash"></i></a>
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