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
    </head>
    <body class="sb-nav-fixed">
        <!-- Navbar -->
        <?php include 'navbar.php'; ?>
        
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
                                <?php
                                    $db_host = "localhost";
                                    $db_user = "root";
                                    $db_pass = "";
                                    $db_name = "webkolah";

                                    try {    
                                        //create PDO connection 
                                        $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
                                    } catch(PDOException $e) {

                                    }
                                    if(isset($_POST['register'])){

                                        // filter data yang diinputkan
                                        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
                                        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
                                        // enkripsi password
                                        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                                        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                                        $hakAkses = $_POST["hak_akses"];

                                        

                                        // Validasi data kosong
                                        if(empty($name) || empty($username) || empty($_POST["password"]) || empty($email) || empty($_POST["hak_akses"])) {
                                            $message = "Semua kolom harus diisi.";
                                        } else {
                                            // menyiapkan query
                                            $sql = "INSERT INTO user (nama, username, email, password, hak_akses) 
                                                    VALUES (:name, :username, :email, :password, :hak_akses)";
                                            $stmt = $db->prepare($sql);

                                            // bind parameter ke query
                                            $params = array(
                                                ":name" => $name,
                                                ":username" => $username,
                                                ":password" => $password,
                                                ":email" => $email,
                                                ":hak_akses" => $hakAkses
                                            );

                                            // eksekusi query untuk menyimpan ke database
                                            $saved = $stmt->execute($params);

                                            if ($saved) {
                                                $message = "Registrasi berhasil.";
                                            } else {
                                                
                                            }
                                        }
                                    }
                                ?>


                                <?php echo $message ? "<script>alert('$message');</script>" : ''; ?>
                                <form action="" method="POST">

                                    <div class="form-group mb-3">
                                        <label for="name">Nama Lengkap</label>
                                        <input class="form-control" type="text" name="name" placeholder="Nama kamu" />
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="username">Username</label>
                                        <input class="form-control" type="text" name="username" placeholder="Username" />
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="email">Email</label>
                                        <input class="form-control" type="email" name="email" placeholder="Alamat Email" />
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" name="password" placeholder="Password" />
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Confirm Passoword</label>
                                        <input class="form-control" type="password" name="confirm_password" placeholder="Repeat Password" />
                                    </div>

                                    <select class="form-select pb-3 mb-3" aria-label=".form-select-lg example" name="hak_akses">
                                        <option hidden>Hak Akses</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Operator">Operator</option>
                                    </select>

                                    <div class="row">
                                        <div class="col col-md-6">
                                            <input type="submit" class="btn btn-success btn-block w-100" name="register" value="Daftar" />
                                        </div>
                                        <div class="col col-md-6">
                                            <input type="reset" class="btn btn-danger btn-block w-100">
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
