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

  if ( isset($_POST['submit']) ) {
    if ( $db->addCandidate($conn, $_POST) > 0 ) {
      echo "
          <script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', () => {
              Swal.fire({
                icon: 'success',
                title: 'success', 
                html: '<p class="."p-popup".">Siswa berhasil ditambahkan sebagai kandidat!</p>',
                showConfirmButton: false,
                timer: 2000
              })
            })
          </script>
        ";

      header("Location: student-account.php");
    }
  }

  $id_student = $_GET['id'];

  $student_account = $db->query($conn, "SELECT id_student, name, nis, class_name, email, status FROM student 
  INNER JOIN student_data ON student.fk_id_data = student_data.id_data 
  INNER JOIN class ON student_data.fk_id_class = class.id_class WHERE id_student = $id_student")[0];

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
                <p>TAMBAH KANDIDAT</p>
                <form action="" class="form-field" method="post" enctype="multipart/form-data">
                    <input type="text" class="form-control input-hidden" name="id_student" placeholder="NIS" value="<?= $student_account['id_student'] ?>">
                    <textarea name="vision" cols="30" rows="7" placeholder="Visi" class="form-control"></textarea>
                    <textarea name="mission" cols="30" rows="7" placeholder="Misi" class="form-control"></textarea>
                    <input type="file" name="picture" placeholder="Gambar" class="form-control">
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