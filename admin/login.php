<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login </title>
        <!-- Bootstrap core CSS -->
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../assets/css/templatemo-grad-school.css">

    <style>
        html,body{
        background-image: url('../assets/images/choosing-bg.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        height: 100%;
        font-family: 'Numans', sans-serif;
        }
    </style>
</head>
<body>

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img class="m-3" src="https://upload.wikimedia.org/wikipedia/commons/3/31/Logo-smkterataiputihglobal.png" id="icon" alt="User Icon" />
    </div>

    <?php
    session_start();
    if(isset($_SESSION['email'])) {
        echo '<script>window.location.replace("dashboard.php");</script>';
    } else {
    ?>
    <!-- Login Form -->
    <form action="aksi.php" method="POST">
      <input type="text" name="user" placeholder="Username" alt="user" required="required">
      <input type="email" name="email" placeholder="Email" alt="email" required="required"/><br/>
      <input type="password" name="password" placeholder="Password" alt="password" required="required"/><br/><br/>
      <input type="submit" class="fadeIn fourth" name="submit" value="Submit" alt="submit"/>
    </form>

    <?php
      }
    ?>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>

  </div>
</div>


      <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
      <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>