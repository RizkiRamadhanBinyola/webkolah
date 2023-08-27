

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Webkolah</title>
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
                        <div class="container text-center px-4 mt-5">
                            <div class="row row-cols-2 row-cols-lg-6 g-2 g-lg-3">
                                <div class="col">
                                    <div class="p-3">
                                        <div class="card text-bg-danger">
                                            <div class="card-header">
                                                <h4><i class="fa-solid fa-user"></i> RPL</h4>
                                            </div>
                                            <div class="card-body">
                                                <h3>1</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="p-3">
                                        <div class="card text-bg-info">
                                            <div class="card-header">
                                                <h4><i class="fa-solid fa-user"></i> DKV</h4>
                                            </div>
                                            <div class="card-body">
                                                <h3>1</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="p-3">
                                        <div class="card" style="background-color: #E966A0; color: #fff;">
                                            <div class="card-header">
                                                <h4><i class="fa-solid fa-user"></i> AK</h4>
                                            </div>
                                            <div class="card-body">
                                                <h3>0</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="p-3">
                                        <div class="card text-bg-warning">
                                            <div class="card-header">
                                                <h4><i class="fa-solid fa-user"></i> MP</h4>
                                            </div>
                                            <div class="card-body">
                                                <h3>0</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="p-3">
                                        <div class="card text-bg-success">
                                            <div class="card-header">
                                                <h4><i class="fa-solid fa-user"></i> BDP</h4>
                                            </div>
                                            <div class="card-body">
                                                <h3>0</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="p-3">
                                        <div class="card" style="background-color: #FFE17B;">
                                            <div class="card-header">
                                                <h4><i class="fa-solid fa-user"></i> PKM</h4>
                                            </div>
                                            <div class="card-body">
                                                <h3>0</h3>
                                            </div>
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
        <script>
            function prosesLogin() {
                let timerInterval
                Swal.fire({
                    title: 'Auto close alert!',
                    html: 'I will close in <b></b> milliseconds.',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                    }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                    }
                })
            }    
        </script>
    
    </body>
</html>
