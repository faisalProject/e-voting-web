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

  $id_candidate = $_GET['id'];

  $candidate_details = query("SELECT id_candidate, vision, mission, picture, name, nis, class_name FROM candidate 
  INNER JOIN student ON candidate.fk_id_student = student.id_student 
  INNER JOIN student_data ON student.fk_id_data = student_data.id_data 
  INNER JOIN class ON student_data.fk_id_class = class.id_class WHERE id_candidate = $id_candidate")[0];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kandidat</title>
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

        <div class="candidate-details">
            <div class="container">
                <div class="left">
                    <img src="../assets/img/<?= $candidate_details['picture'] ?>" alt="candidate">
                    <div class="description">
                        <div class="item">
                            <p>Nama: <?= $candidate_details['name'] ?></p>
                        </div>
                        <div class="item">
                            <p>NIS: <?= $candidate_details['nis'] ?></p>
                        </div>
                        <div class="item">
                            <p>Kelas: <?= $candidate_details['class_name'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="middle">
                    <div class="top">
                        <h5>Visi</h5>
                        <p><?= $candidate_details['vision'] ?></p>
                    </div>
                    <div class="bottom">
                        <h5>Misi</h5>
                        <p><?= $candidate_details['mission'] ?></p>
                    </div>
                </div>
                <div class="right">
                    <img src="../assets/img/<?= $candidate_details['picture'] ?>" alt="candidate">
                    <div class="description">
                        <div class="item">
                            <p>Nama: <?= $candidate_details['name'] ?></p>
                        </div>
                        <div class="item">
                            <p>NIS: <?= $candidate_details['nis'] ?></p>
                        </div>
                        <div class="item">
                            <p>Kelas: <?= $candidate_details['class_name'] ?></p>
                        </div>
                    </div>
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