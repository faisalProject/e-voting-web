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

  $student_account = $db->query($conn, "SELECT id_student, name, email, status FROM student INNER JOIN student_data ON student.fk_id_data = student_data.id_data ORDER BY id_student DESC");

  if ( isset($_POST['submit']) ) {
    $student_account = $db->searchStudentAccount($_POST['keyword']);
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun Siswa</title>
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

      <div class="main-contents">
        <div class="container">
            <div class="search-field">
                <form action="" class="form-field" method="post">
                    <input type="text" class="form-control" name="keyword" placeholder="nama, email...">
                    <button type="submit" name="submit" class="btn-search"><i class="bi bi-search"></i></button>
                </form>
            </div>

            <div class="list-of-student-account">
              <?php foreach ( $student_account as $s ) : ?>
                <div class="data-row student-account">
                  <div class="left">
                    <a href="student-account-details.php?id=<?= $s['id_student'] ?>"><?= $s['name'] ?></a>
                    <p><?= $s['email'] ?></p>
                  </div>
                  <div class="right">
                    <?php if ( $s['status'] !== 'kandidat' ) : ?>
                      <a href="add-candidate.php?id=<?= $s['id_student'] ?>" class="btn-add-candidate btn btn-primary"><i class="bi bi-person-plus-fill"></i></a>
                    <?php endif; ?>
                  </div>
                </div>
              <?php endforeach; ?>
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