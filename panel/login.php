<?php
session_start();
include 'dashboard/koneksi/koneksi.php';

//cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
  $id = $_COOKIE['id'];
  $key = $_COOKIE['key'];

  $db = mysqli_query($conn, "SELECT username FROM user WHERE id_user = '$id'");

  $row = mysqli_fetch_assoc($db);

  // cek cookie denganm username
  if ($key === hash('sha256', $row['username'])) {
    $_SESSION['login'] = true;
  }
}

//masuk ke session
if (isset($_SESSION["login"])) {
  header("Location: index.php");
}
//cek username dan password
if (isset($_POST['login'])) {
  $username = htmlspecialchars($_POST["username"]);
  $password = htmlspecialchars($_POST["password"]);

  $cek = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

  if (mysqli_num_rows($cek) === 1) {
    //cek password
    $row = mysqli_fetch_assoc($cek);
    $_SESSION['nama'] = $row['nama'];
    $_SESSION['id_user'] = $row['id_user'];
    if ($row['hak_akses'] == 'admin') {
      $_SESSION['username'] = $username;
      $_SESSION['hak_akses'] = 'admin';
      if (password_verify($password, $row['password'])) {
        // mengeecek dan buat session
        $_SESSION['login'] = true;
        //buat dan cek cookie
        if (isset($_POST['remember'])) {
          setcookie('id', $row['id_user'], time() + 60);
          setcookie('key', hash('sha256', $row['username']), time() + 60);
        }
        echo "
    <script>
        alert('Login Admin Berhasil!');
        document.location.href='dashboard/';
    </script>
    ";
      }
    } else if ($row['hak_akses'] == 'operator') {
      $_SESSION['username'] = $username;
      $_SESSION['hak_akses'] = 'operator';
      if (password_verify($password, $row['password'])) {
        //cek dan buat session
        $_SESSION['login'] = true;
        //buat dan cek cookie
        if (isset($_POST['remember'])) {
          setcookie('id', $row['id_user'], time() + 60);
          setcookie('key', hash('sha256', $row['username']), time() + 60);
        }
        echo "
    <script>
        alert('Login Operator Berhasil!');
        document.location.href='dashboard/';
    </script>
    ";
      }
    } else {
      $_SESSION['username'] = '';
      $_SESSION['hak_akses'] = '';
      echo "
    <script>
        alert('Login Gagal!');
        document.location.href='login.php';
    </script>
    ";
    }
  }
  $error = true;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page || TPG2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-5">
      <div class="row d-flex justify-content-center m-3">
        <div class="card">
          <div class="card-body">
            <form method="post" action="">
              <div class="mb-3">
              <label class="form-label">Username</label>
                <input name="username" type="text" class="form-control">
              </div>
              <div class="mb-3">               
                <label class="form-label">Password</label>
                <input name="password" type="password" class="form-control">
              </div>

              <button type="submit" class="btn btn-primary" name="login">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>