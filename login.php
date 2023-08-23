<?php
session_start(); // Mulai sesi

include 'config.php';
error_reporting(0);

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $katasandi = $_POST['katasandi'];

  $sql = "SELECT * FROM user WHERE email='$email' AND katasandi='$katasandi'";
  $result = mysqli_query($conn, $sql);

  if ($result && $result->num_rows > 0) {
      $_SESSION['email'] = $email;
      header("Location: dashboard.html");
      exit;
  } else {
      echo "<script>alert('Email atau kata sandi salah.')</script>";
      exit;
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LOGIN</title>
  <link rel="stylesheet" href="loginn.css">
</head>
<body>
  
<div id="container">
  
  <!-- Login Box -->
  <div id="login">
    <h1>Bergabung</h1>
    
    <p>Masukkan email dan kata sandi sesuai dengan registrasi sebelumnya!</p>
    <form action="login.php" method="POST" name="loginForm" onsubmit="return validateForm();">
      <input type="email" placeholder="Email" name="email"><br>
      <input type="password" placeholder="Kata Sandi" name="katasandi"><br>
      <p class="add">Belum punya akun? <a href="logregist.php">Registrasi.</a></p>
      <input class="submit-btn" type="submit" value="Masuk" name="submit">
    </form>
  </div>

</div>

<script>
    function validateForm() {
        var email = document.forms["loginForm"]["email"].value;
        var katasandi = document.forms["loginForm"]["katasandi"].value;

        if (email === "" || katasandi === "") {
            alert("Data belum lengkap. Harap lengkapi form.");
            return false;
        }

        return true;
    }
</script>
</body>
</html>