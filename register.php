<?php
  require 'api/conn.php';

  if ( isset($_POST['submit']) ) {
    if ( studentRegister($_POST) > 0 ) {
      echo "
          <script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', () => {
              Swal.fire({
                icon: 'success',
                title: 'success', 
                html: '<p class="."p-popup".">Akun berhasil terdaftar sebagai siswa!</p>',
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
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="assets/css/main.css">
  <title>E-Voting | Register</title>
</head>
<body>
  <!-- navbar -->
  <?php 
    require 'component/navbarLandingPage.php';
  ?>
  <!-- end of navbar -->

  <main>
    <div class="container register-contents">
      <div class="register">
        <div class="top">
          <h4>Register</h4>
        </div>
        <form action="" method="post" class="middle">
          <input type="text" class="form-control" name="nis" placeholder="NIS">
          <input type="email" class="form-control" name="email" placeholder="Email">
          <div class="password">
            <input type="password" class="form-control input-type" name="password" placeholder="Password">
            <div class="show">
              <i class="bi bi-eye-slash"></i>
              <i class="bi bi-eye"></i>
            </div>
          </div>
          <div class="password">
            <input type="password" class="form-control input-type" name="confirmation-password" placeholder="Confirm Password">
            <div class="show">
              <i class="bi bi-eye-slash"></i>
              <i class="bi bi-eye"></i>
            </div>
          </div>
          <button type="submit" name="submit" class="register-btn">Register</button>
          <p>already have an account? <a href="signin.php">Sign in</a></p>
        </form>
        <div class="bottom">
          <p>Dengan melakukan Register, Anda setuju dengan syarat & ketentuan E-Voting. This site is protected by reCAPTCHA and the Google Privacy Policy and Terms of Service apply.</p>
        </div>
      </div>
    </div>

    <?php 
    require 'component/mobileNavbarLandingPage.php';
    ?>
  </main>

  <?php
    require 'component/footer.php';
  ?>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/sweetalert2@11.js"></script>
  <script src="assets/js/main.js"></script>
</body>
</html>