<?php

  session_start();
  require '../api/conn.php';

  if ( !isset($_COOKIE['hij']) && !isset($_COOKIE['jih']) ) {
    $_SESSION = [];
    session_unset();
    session_destroy();

    setcookie('hij', '', time() - 3600);
    setcookie('jih', '', time() - 3600);

    header("Location: login.php");
    exit;
  }

  $db = new Voting("localhost", "root", "", "db_evoting_web");
  $conn = $db->connect();

  $class = $db->query($conn,"SELECT * FROM class");
  
  if ( isset($_POST['submit']) ) {
    if ( $db->addStudentData($conn, $_POST) > 0 ) {
      echo "
          <script type='text/javascript'>
              document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil', 
                    html: '<p class="."p-popup".">Data berhasil ditambahkan!</p>',
                    showConfirmButton: false,
                    timer: 2000
                })
              })
          </script>
          ";
    }
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data Siswa</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/main-admin.css">
  </head>
  <body>
    
    
    <!-- navbar -->
    <?php 
    require '../component/navbarAdmin.php';
    ?>
    <!-- end of navbar -->

    <main>
      <?php 
      require '../component/sidebarMenuAdmin.php';
      ?>

      <div class="add-student-data">
        <div class="container">
            <p>TAMBAH DATA SISWA</p>

            <form action="" method="post" class="form-field">
                <input type="text" class="form-control" name="nis" placeholder="NIS" required>
                <input type="text" class="form-control" name="name" placeholder="Name" required>
                <input type="text" class="form-control" name="email" placeholder="Email" required>
                <select class="form-select" aria-label="Default select example" name="id_class" required>
                  <option value="">Pilih</option>
                  <?php foreach($class as $c) : ?>
                    <option value="<?= $c['id_class'] ?>"><?= $c['class_name'] ?></option>
                  <?php endforeach; ?>
                </select>
                <button type="submit" name="submit" class="btn-add">TAMBAH</button>
            </form>
        </div>
      </div>
    </main>

    <?php 
    require '../component/footerAdmin.php';
    ?>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sweetalert2@11.js"></script>
    <script src="../assets/js/main-admin.js"></script>
  </body>
</html>