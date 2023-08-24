<?php  
 session_start();  
 include 'dashboard/koneksi/config.php';
 try  
 {   
      if(isset($_POST["login"]))  
      {  
           if(empty($_POST["username"]) || empty($_POST["password"]))  
           {  
               echo "<script>
               Swal.fire({
                   icon: 'error',
                   title: 'Gagal terkirim',
                   text: 'Harap isi semua form',
               });
               </script>";  
           }  
           else  
           {  
                $query = "SELECT * FROM user WHERE username = :username AND password = :password";  
                $statement = $conn->prepare($query);  
                $statement->execute(  
                     array(  
                          'username'     =>     $_POST["username"],  
                          'password'     =>     $_POST["password"]  
                     )  
                );  
                $count = $statement->rowCount();  
                if($count > 0)  
                {  
                    $_SESSION["username"] = $_POST["username"];  
                    header("location:dashboard/");  
                    echo "<script>
                    Swal.fire({
                         icon: 'success',
                         title: 'Berhasil',
                         text: 'Berhasil Login',
                    });
                    </script>";
                }  
                else  
                {  
                    echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal terkirim',
                        text: 'Username atau Password salah!.',
                    });
                    </script>";
                }  
           }  
      }  
 }  

 catch(PDOException $error)  
 {  
      $message = $error->getMessage();  
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
            <title>Login | Admin</title> 
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <meta name="description" content="" />
            <meta name="author" content="" />
            <title>Dashboard - Webkolah</title>
            <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
            <link href="dashboard/css/styles.css" rel="stylesheet" />
            <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <style>
                .background-radial-gradient {
                background-color: hsl(218, 41%, 15%);
               
                background-size: auto;
                background-image: radial-gradient(650px circle at 0% 0%,
                    hsl(218, 41%, 35%) 15%,
                    hsl(218, 41%, 30%) 35%,
                    hsl(218, 41%, 20%) 75%,
                    hsl(218, 41%, 19%) 80%,
                    transparent 100%),
                    radial-gradient(1250px circle at 100% 100%,
                    hsl(218, 41%, 45%) 15%,
                    hsl(218, 41%, 30%) 35%,
                    hsl(218, 41%, 20%) 75%,
                    hsl(218, 41%, 19%) 80%,
                    transparent 100%);
                }

                #radius-shape-1 {
                height: 220px;
                width: 220px;
                top: -60px;
                left: -130px;
                background: radial-gradient(#44006b, #ad1fff);
                overflow: hidden;
                }

                #radius-shape-2 {
                border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
                bottom: -60px;
                right: -110px;
                width: 300px;
                height: 300px;
                background: radial-gradient(#44006b, #ad1fff);
                overflow: hidden;
                }

                .bg-glass {
                background-color: hsla(0, 0%, 100%, 0.9) !important;
                backdrop-filter: saturate(200%) blur(25px);
                }
            </style>
      </head>  
      <body  class="background-radial-gradient overflow-hidden">  
           <!-- <br />  
           <div class="container" style="width:500px;"> 
                <h3 align="">PHP Login Script using PDO</h3><br />  
                <form method="post">  
                     <label>Username</label>  
                     <input type="text" name="username" class="form-control" />  
                     <br />  
                     <label>Password</label>  
                     <input type="password" name="password" class="form-control" />  
                     <br />  
                     <input type="submit" name="login" class="btn btn-info" value="Login" />  
                </form>  
           </div>  
           <br />   -->
        <!-- Section: Design Block -->
        <section>

        <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5">
            <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                Terput2 <br />
                <span style="color: hsl(218, 81%, 75%)">Dashboard</span>
                </h1>
                <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                Temporibus, expedita iusto veniam atque, magni tempora mollitia
                dolorum consequatur nulla, neque debitis eos reprehenderit quasi
                ab ipsum nisi dolorem modi. Quos?
                </p>
            </div>

            <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                <div class="card bg-glass">
                <div class="card-body px-4 py-5 px-md-5">
                    <?php  
                         if(isset($message))  
                         {  
                              echo '<label class="text-danger">'.$message.'</label>';  
                         }  
                    ?>  
                    <form method="post">

                         <!-- Email input -->
                         <div class="form-outline mb-4">
                              <input type="text" name="username" class="form-control" id="username" placeholder="Username">
                         </div>

                         <!-- Password input -->
                         <div class="form-outline mb-4">
                              <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                         </div>

                         <!-- Submit button -->
                         <input type="submit" name="login" class="btn btn-info" value="Login" />  

                    </form>
                </div>
                </div>
            </div>
            </div>
        </div>
        </section>
        <!-- Section: Design Block -->
           

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="dashboardjs/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
      </body>  
 </html>  