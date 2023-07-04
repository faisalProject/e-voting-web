<?php 

  session_start();
  require '../api/conn.php';

  $db = new Voting("localhost", "root", "", "db_evoting_web");
  $conn = $db->connect();

  // check cookie
  if ( isset($_COOKIE['hij']) && isset($_COOKIE['jih']) ) {
    $hij = $_COOKIE['hij'];
    $jih = $_COOKIE['jih'];

    // get username by id
    $result = mysqli_query($conn, "SELECT username FROM admin WHERE id_admin = $hij");
    $user = mysqli_fetch_assoc($result);

    // check cookie
    if ( $jih === hash('sha256', $user['username']) ) {
      $_SESSION['login'] = true;
    } 
  }

  if ( isset($_SESSION['login']) ) {
    header("Location: index.php");
  }

  if ( isset($_POST['login']) ) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");

    // check username
    if ( mysqli_num_rows($result) === 1 ) {
      // check password
      $user = mysqli_fetch_assoc($result);
      
      if ( password_verify($password, $user['password']) ) {
        // set session
        $_SESSION['login'] = true;

        // setcookie
        setcookie('hij', $user['id_admin'], time() + 3600);
        setcookie('jih', hash('sha256', $user['username']), time() + 3600);
        
        header("Location: index.php");
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
              html: '<p class="."p-popup".">Username atau password salah!</p>',
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
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/main-admin.css">
    <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body>

    <main>
      <div class="container signin-contents">
        <div class="signin">
          <div class="top">
            <h4>Sign in</h4>
          </div>
          <form action="" method="post" class="middle">
          <input type="text" class="form-control" name="username" placeholder="Username" required>
            <div class="password">
              <input type="password" class="form-control input-type" name="password" placeholder="Password"required>
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