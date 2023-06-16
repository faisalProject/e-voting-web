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

  $id_data = $_GET['id'];
  $result = mysqli_query($conn, "SELECT * FROM student_data INNER JOIN class ON student_data.fk_id_class = class.id_class WHERE id_data = $id_data");
  $student = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Data Siswa</title>
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
                <p>DETAIL DATA SISWA</p>
                <div class="card-student">
                    <p>Nama: <?= $student['name'] ?></p>
                    <p>NIS: <?= $student['nis'] ?></p>
                    <p>Kelas: <?= $student['class_name'] ?></p>
                    <p>Email: <?= $student['email'] ?></p>
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