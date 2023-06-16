<?php
  session_start();
  require '../api/conn.php';

  if (isset($_POST['register']) > 0) {
        
    if (register($_POST) > 0) {
        echo "
          <script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', () => {
              Swal.fire({
                icon: 'success',
                title: 'success', 
                html: '<p class="."p-popup".">Akun berhasil terdaftar sebagai admin!</p>',
                showConfirmButton: false,
                timer: 2000
              })
            })
          </script>
        ";
    }
}  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/main-admin.css">
    <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body>
    <main>
      <div class="container register-contents">
        <div class="register">
          <div class="top">
            <h4>Register</h4>
          </div>
          <form action="" method="post" class="middle">
            <input type="text" class="form-control" name="username" placeholder="Username" required>
            <input type="email" class="form-control" name="email" placeholder="Email"required>
            <div class="password">
              <input type="password" class="form-control input-type" name="password" placeholder="Password"required>
              <div class="show">
                <i class="bi bi-eye-slash"></i>
                <i class="bi bi-eye"></i>
              </div>
            </div>
            <div class="password">
              <input type="password" class="form-control input-type" name="confirmation-password" placeholder="Confirm Password" required>
              <div class="show">
                <i class="bi bi-eye-slash"></i>
                <i class="bi bi-eye"></i>
              </div>
            </div>
            <button type="submit" name="register" class="register-btn">Register</button>
            <p>already have an account? <a href="login.php">Sign in</a></p>
          </form>
          <div class="bottom">
            <p>Dengan melakukan Register, Anda setuju dengan syarat & ketentuan E-Voting. This site is protected by reCAPTCHA and the Google Privacy Policy and Terms of Service apply.</p>
          </div>
        </div>
      </div>
    </main>
  
    <?php 
    require '../component/footerAdmin.php';
    ?>
  
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sweetalert2@11.js"></script>
    <script src="../assets/js/main-admin.js"></script>
    <script src="../assets/js/main.js"></script>
  </body>
</html>