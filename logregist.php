<?php

include 'config.php';
error_reporting(0); //untuk menampilkan error saat program dijalankan

if (isset($_POST['submit'])) {
  $nama = mysqli_real_escape_string($conn, $_POST['nama']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $katasandi = ($_POST['katasandi']);
  $ckatasandi = ($_POST['ckatasandi']);

  // Validasi username sudah terdaftar
  $sql_check_username = "SELECT * FROM user WHERE nama='$nama'";
  $result_check_username = mysqli_query($conn, $sql_check_username);

  if (mysqli_num_rows($result_check_username) > 0) {
      echo '<script>alert("Nama pengguna sudah digunakan. Silakan ganti nama pengguna.");</script>';
      exit;
  }

  if ($katasandi == $ckatasandi) {
    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if (!$result->num_rows > 0) {
      $sql = "INSERT INTO user (nama, email, katasandi)
              VALUES ('$nama', '$email', '$katasandi')";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        header("Location: berhasil.html");
        $nama = "";
        $email = "";
        $_POST['katasandi'] = "";
        $_POST['ckatasandi'] = "";

        exit;
      } else {
        echo "<script>alert('OoWw! Terjadi kesalahan.')</script>";
        exit;
      }
      
    } else {
      echo "<script>alert('Email sudah terdaftar ngab.')</script>";
      exit;
    }

  } else {
    echo "<script>alert('Upzz! Konfirmasi kata sandi salah.')</script>";
    exit;
  }

}

?>


<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login Registration</title>
  <link rel="stylesheet" href="logregist.css">

</head>
<body>

<div id="container">
  <div id="register">
    <h1>Registrasi</h1>
    
    <p>Masukkan data pribadimu yaa-!</p>
    <form action= "" method="POST" name="registrationForm" onsubmit="return validateForm();">
      <input type="text" placeholder="Nama" name="nama"><br>
      <input type="email" placeholder="Email" name="email"><br>
      <input type="password" placeholder="Kata Sandi" name="katasandi"><br>
      <input type="text" placeholder="Konfirmasi Kata sandi" name="ckatasandi"><br>
      <p class="add">Sudah punya akun? <a href="login.php">Bergabung.</a></p>
      <input class="submit-btn" type="submit" value="Daftar" name="submit">
    </form>
  </div>
  
</div>

<script>
    function validateForm() {
        var nama = document.forms["registrationForm"]["nama"].value;
        var email = document.forms["registrationForm"]["email"].value;
        var katasandi = document.forms["registrationForm"]["katasandi"].value;
        var ckatasandi = document.forms["registrationForm"]["ckatasandi"].value;

        if (nama === "" || email === "" || katasandi === "" || ckatasandi === "") {
            alert("Data belum lengkap. Harap lengkapi form.");
            return false;
        }

        return true;
    }
</script>

</body>
</html>
