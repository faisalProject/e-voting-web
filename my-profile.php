<?php

  session_start();
  require 'api/conn.php';

  if ( !isset($_COOKIE['xyz']) && !isset($_COOKIE['zyx']) ) {
    $_SESSION = [];
    session_unset();
    session_destroy();

    setcookie('xyz', '', time() - 3600);
    setcookie('zyx', '', time() - 3600);

    header("Location: signin.php");
    exit;
  }

  if ( isset($_COOKIE['xyz']) && isset($_COOKIE['zyx']) ) {
    $id_student = $_COOKIE['xyz'];

    $result = mysqli_query($conn, "SELECT id_student, name, nis, email, class_name FROM student_data
    INNER JOIN student ON student_data.id_data = student.fk_id_data
    INNER JOIN class ON student_data.fk_id_class = class.id_class WHERE id_student = $id_student");

    $student = mysqli_fetch_assoc($result);

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
  <title>E-Voting | My Profile</title>
</head>
<body>
  <!-- navbar -->
  <?php
  require 'component/navbarUser.php';
  ?>
  <!-- end of navbar -->
  
  <main>
    <div class="container my-profile-contents">
      <div class="top">
        <div class="left">
          <img src="assets/img/f1.png" alt="person">
          <div class="description">
            <p>Name: <?= $student['name'] ?></p>
            <p>NIS: <?= $student['nis'] ?></p>
          </div>
        </div>
        <div class="right">
          <div class="description">
            <p>Email: <?= $student['email'] ?></p>
            <p>School: SMAN 2 Karawang</p>
          </div>
        </div>
      </div>
      <div class="bottom">
        <div class="left">
          <h5>Other Information</h5>
          <p>Class: <?= $student['class_name'] ?></p>
          <p>Homeroom Teacher: Nani Sumarni S.Pd</p>
          <p>Headmaster: Drs. Djoko Parmono</p>
        </div>
        <div class="right">
          <h5>Login Activity</h5>
          <p class="bold">First time access</p>
          <p>Saturday, 11 September 2021, 19:31 (1 Year 198 days)</p>
          <p class="bold">Last access to site</p>
          <p>Tuesday, 28 March 2023, 19:59 (4 seconds)</p>
        </div>
      </div>
    </div>

    <?php
    require 'component/sidebarMenuUser.php';
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