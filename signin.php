<?php
  session_start();
  require 'api/conn.php';

  $db = new Voting("localhost", "root", "", "db_evoting_web");
  $conn = $db->connect();

  // check cookie
  if ( isset($_COOKIE['xyz']) && isset($_COOKIE['zyx']) ) {
    $xyz = $_COOKIE['xyz'];
    $zyx = $_COOKIE['zyx'];

    // get nis by id
    $result = mysqli_query($conn, "SELECT nis FROM student_data
    INNER JOIN student ON student_data.id_data = student.fk_id_data WHERE id_student = $xyz");
    
    $user = mysqli_fetch_assoc($result);
    
    if ( $zyx === hash('sha256', $user['nis']) ) {
      $_SESSION['login'] = true;
    }

  }

  if ( isset($_SESSION['login']) ) {
    header("Location: dashboard.php");
  }

  if ( isset($_POST['login']) ) {
    $nis = $_POST['nis'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT id_student, nis, password FROM student_data
    INNER JOIN student ON student_data.id_data = student.fk_id_data WHERE nis = '$nis'");

    // check email
    if ( mysqli_num_rows($result) === 1 ) {
      // check password
      $user = mysqli_fetch_assoc($result);

      var_dump(password_verify($password, $user['password']));
      if ( password_verify($password, $user['password']) ) {

        // set session
        $_SESSION['login'] = true;

        // setcookie
        setcookie('xyz', $user['id_student'], time() + 3600);
        setcookie('zyx', hash('sha256', $user['nis']), time() + 3600);

        header("Location: dashboard.php");
        exit;
      }
    }

    $err = true;

    if ( isset($err) ) {
      echo "
        <script type='text/javascript'>
          document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
              icon: 'error',
              title: 'Gagal', 
              html: '<p class="."p-popup".">NIS atau password salah!</p>',
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
  <title>E-Voting | Sign in</title>
</head>
<body>
  <!-- navbar -->
  <?php 
    require 'component/navbarLandingPage.php';
  ?>
  <!-- end of navbar -->

  <main>
    <div class="container signin-contents">
      <div class="signin">
        <div class="top">
          <h4>Sign in</h4>
        </div>
        <form action="" method="post" class="middle">
          <input type="text" class="form-control" placeholder="NIS" name="nis">
          <div class="password">
            <input type="password" class="form-control input-type" placeholder="Password" name="password">
            <div class="show">
              <i class="bi bi-eye-slash"></i>
              <i class="bi bi-eye"></i>
            </div>
          </div>
          <a href="#">Forgot Password?</a>
          <button type="submit" name="login" class="btn-signin">Sign in</button>
          <p>don't have account yet? <a href="register.php">Register</a></p>
        </form>
        <div class="bottom">
          <p>Dengan melakukan login, Anda setuju dengan syarat & ketentuan E-Voting. This site is protected by reCAPTCHA and the Google Privacy Policy and Terms of Service apply.</p>
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