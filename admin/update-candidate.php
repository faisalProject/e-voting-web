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

  if ( isset($_POST['submit']) ) {
    if ( updateCandidate($_POST) > 0 ) {
      echo "
          <script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', () => {
              Swal.fire({
                icon: 'success',
                title: 'success', 
                html: '<p class="."p-popup".">Kandidate berhasil diubah!</p>',
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
    <title>Tambah Kandidat</title>
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

      <div class="add-candidate">
          <div class="container">
              <p>UPDATE KANDIDAT</p>
              <form action="" class="form-field" method="post" enctype="multipart/form-data">
                  <input name="id_candidate" value="<?= $candidate_details['id_candidate'] ?>" class="form-control input-hidden"></input>
                  <textarea name="vision" id="" cols="30" rows="7" placeholder="Visi" class="form-control"><?= $candidate_details['vision'] ?></textarea>
                  <textarea name="mission" id="" cols="30" rows="7" placeholder="Misi" class="form-control"><?= $candidate_details['mission'] ?></textarea>
                  <input type="file" name="picture" placeholder="Gambar" class="form-control">
                  <input type="hidden" name="old_picture" class="form-control" value="<?= $candidate_details['picture'] ?>">
                  <button type="submit" name="submit" class="btn-update">UBAH</button>
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