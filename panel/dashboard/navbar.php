<?php
session_start();
if (!isset($_SESSION['login'])) {

?>
    <script>
        alert("HARUS LOGIN TERLEBIH DAHULU!");
        window.open('../login.php', '_self');
    </script>
<?php
} else {
    $status = $_SESSION['hak_akses'];
}

?>           
        
        <!-- Navbar -->
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
                <!-- Navbar Brand-->
                <a class="navbar-brand mx-5" href="#">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/3/31/Logo-smkterataiputihglobal.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                    Dashboard
                </a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </nav>

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-house"></i></div>
                                Home
                            </a>
                            <?php if($_SESSION['hak_akses'] == 'admin') : ?>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-pen-to-square"></i></div>
                                Master
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="agama.php">Agama</a>
                                    <a class="nav-link" href="kewarganegaraan.php">Kewarganegaraan</a>
                                    <a class="nav-link" href="jurusan.php">Jurusan</a>
                                    <a class="nav-link" href="jenjang.php">Jenjang</a>
                                </nav>
                            </div>
                            <?php endif; ?>
                            <div class="sb-sidenav-menu-heading">Daftar</div>
                            <a class="nav-link" href="pendaftaran.php">
                                <div class="sb-nav-link-icon"><i class="fa-regular fa-registered"></i></div>
                                Pendaftaran
                            </a>
                            <a class="nav-link" href="data-pendaftaran.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Data Pendaftaran
                            </a>
                            
                            <?php if ($_SESSION['hak_akses'] == 'admin') : ?>
                                <div class="sb-sidenav-menu-heading">Register</div>
                                <a class="nav-link" href="register.php">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-id-card"></i></div>
                                    Register user
                                </a>

                            <!-- <div class="sb-sidenav-menu-heading">Data</div> -->
                            <a class="nav-link" href="data-user.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-table"></i></div>
                                Data user
                            </a>
                            <?php endif; ?>

                            <a class="nav-link" href="logout.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-right-from-bracket"></i></div>
                                Logout
                            </a>

                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <?php
                            if (isset($_SESSION['nama'], $_SESSION['hak_akses'])) {
                        ?>
                        <div class="fs-6"><i class="fa-solid fa-user"></i> <?= $_SESSION['nama']; ?> Sebagai <?= $_SESSION['hak_akses']; ?></div>

                        <?php
                            }
                        ?>
                    </div>
                </nav>
            </div>