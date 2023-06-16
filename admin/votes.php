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

  $candidate_list = query("SELECT c.id_candidate, sd.name, sd.nis, c2.class_name, COUNT(v.fk_id_candidate) AS votes FROM candidate c 
                          LEFT JOIN student_data sd ON c.fk_id_data = sd.id_data
                          LEFT JOIN class c2 ON sd.fk_id_class = c2.id_class
                          LEFT JOIN voting v ON c.id_candidate = v.fk_id_candidate GROUP BY c.id_candidate ORDER BY id_candidate DESC");



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jumlah Suara</title>
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

      <div class="votes">
        <div class="container">
          <?php foreach ( $candidate_list as $c ) : ?>
            <div class="card">
              <img src="../assets/img/person.jpg" alt="candidate">
              <div class="description">
                  <p>Nama: <?= substr($c['name'], 0, 10) ?>....</p>
                  <p>NIS: <?= $c['nis'] ?></p>
                  <p>Kelas: <?= $c['class_name'] ?></p>
                  <p>Suara: <?= $c['votes'] ?></p>
              </div>
            </div>
          <?php endforeach; ?>
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