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

  $candidate_list = query("SELECT id_candidate, picture, name, nis, class_name, vision, mission FROM candidate
  INNER JOIN student ON candidate.fk_id_student = student.id_student 
  INNER JOIN student_data ON student.fk_id_data = student_data.id_data 
  INNER JOIN class ON student_data.fk_id_class = class.id_class ORDER BY id_candidate DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-Voting | Candidate List</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
  <!-- navbar -->
  <?php
  require 'component/navbarUser.php';
  ?>
  <!-- end of navbar -->

  <main>
    <div class="container candidate-list-contents">
      <?php foreach ( $candidate_list as $c ) : ?>
      <div class="candidate-card">
        <img src="assets/img/<?= $c['picture'] ?>" alt="person">
        <div class="description">
          <div class="top">
            <p>Name : <?= substr($c['name'], 0, 10) ?>....</p>
            <p>NIS : <?= $c['nis'] ?></p>
            <p>Kelas : <?= $c['class_name'] ?></p>
          </div>
          <div class="bottom">
            <p><?= substr($c['vision'], 0, 55) ?>...</p>
            <a href="candidate-details.php?id=<?= $c['id_candidate'] ?>" class="btn-more">More</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
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