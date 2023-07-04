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

  $candidate_list = $db->query($conn, "SELECT id_candidate, vision, mission, picture, name, nis, class_name FROM candidate 
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
    <title>Daftar Kandidat</title>
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

        <div class="candidate-list">
            <div class="container">
                <div class="cards-container">
                  <?php foreach ( $candidate_list as $c ) : ?>
                    <div class="card">
                      <div class="img-container">
                        <img src="../assets/img/<?= $c['picture'] ?>" alt="person">
                        <a href="candidate-details.php?id=<?= $c['id_candidate'] ?>"></a>  
                      </div>
                      <div class="description">
                        <div class="top">
                          <p>Nama: <?= substr($c['name'], 0, 10) ?>....</p>
                          <p>NIS: <?= $c['nis'] ?></p>
                          <p>Kelas: <?= $c['class_name'] ?></p>
                        </div>
                        <div class="bottom">
                          <p><?= substr($c['vision'], 0, 70); ?></p>
                          <div class="button-container">
                            <a href="update-candidate.php?id=<?= $c['id_candidate'] ?>" class="btn-update"><i class="bi bi-pencil-square"></i></a>
                            <button onclick="confirmDelete(<?= $c['id_candidate'] ?>)" class="btn-delete btn-delete-candidate"><i class="bi bi-trash3"></i></button>
                          </div>
                        </div>
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

    <script type='text/javascript'>
      var confirmDelete = (id_candidate) => {
        Swal.fire({
          title: 'Apakah kamu yakin?',
          html: "<p class='msg'>Ingin menghapus data kandidat ini!</p>",
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if(result.isConfirmed) {
            window.location.href = 'delete-candidate.php?id_candidate=' + id_candidate;
            Swal.fire({
                icon: 'success',
                title: 'Berhasil', 
                html: '<p class="."p-popup".">Data kandidat berhasil dihapus!</p>',
                showConfirmButton: false,
                timer: 2000
                })
          } else {
            Swal.fire('Batal', 'Tidak jadi menghapus data', 'info');
          }
        })
      }
    </script>
</body>
</html>