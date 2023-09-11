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
        <?php include 'navbar.php'; ?>
        
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
                                                <option selected hidden disabled>-- Hak Akses --</option>
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
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    
    </body>
</html>
