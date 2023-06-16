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

  $student_data = query("SELECT * FROM student_data ORDER BY id_data DESC");

  if ( isset($_POST['submit']) ) {
    $student_data = searchStudentData($_POST['keyword']);
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Data Siswa</title>
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
            <a href="add-student-data.php" class="btn-add">
              <i class="bi bi-plus-lg"></i>
            </a>
            <form action="" class="form-field" method="post">
              <input type="text" class="form-control" name="keyword" placeholder="nama, nis...">
              <button type="submit" class="btn-search" name="submit"><i class="bi bi-search"></i></button>
            </form>
          </div>

          <div class="list-student-data">
            <?php foreach ( $student_data as $s ) : ?>
              <div class="data-row">
                <div class="left">
                  <a href="student-details.php?id=<?= $s['id_data'] ?>"><?= $s['name'] ?></a>
                  <p><?= $s['nis'] ?></p>
                </div>
                <div class="right">
                  <a href="update-student-data.php?id=<?= $s['id_data'] ?>" class="btn-update"><i class="bi bi-pencil-square"></i></a>
                  <a href="#" onclick="confirmDelete(<?= $s['id_data'] ?>)" class="btn-delete"><i class="bi bi-trash3"></i></a>
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
      var confirmDelete = (id) => {
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
            window.location.href = 'delete.php?id=' + id;
            Swal.fire({
                icon: 'success',
                title: 'Berhasil', 
                html: '<p class="."p-popup".">Data siswa berhasil dihapus!</p>',
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