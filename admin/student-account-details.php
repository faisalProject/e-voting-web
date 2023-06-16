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

  $id_student = $_GET['id'];

  $student_account = query("SELECT name, nis, class_name, email, status FROM student 
  INNER JOIN student_data ON student.fk_id_data = student_data.id_data 
  INNER JOIN class ON student_data.fk_id_class = class.id_class WHERE id_student = $id_student")[0];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Akun Siswa</title>
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

        <div class="detail-student-data">
            <div class="container">
                <p>DETAIL AKUN SISWA</p>
                <div class="card-student">
                    <p>Nama: <?= $student_account['name'] ?></p>
                    <p>NIS: <?= $student_account['nis'] ?></p>
                    <p>Kelas: <?= $student_account['class_name'] ?></p>
                    <p>Email: <?= $student_account['email'] ?></p>
                    <p>Status: <?= $student_account['status'] ?></p>
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
</body>
</html>