<?php

  session_start();
  require 'api/conn.php';

  $db = new Voting("localhost", "root", "", "db_evoting_web");
  $conn = $db->connect();

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
    $isVote = mysqli_query($conn, "SELECT * FROM voting WHERE fk_id_student = $id_student");
    $vote =  mysqli_num_rows($isVote);
  }

  $id_candidate = $_GET['id'];

  $result = mysqli_query($conn, "SELECT id_candidate, picture, name, nis, class_name, vision, mission FROM candidate
  INNER JOIN student ON candidate.fk_id_student = student.id_student 
  INNER JOIN student_data ON student.fk_id_data = student_data.id_data 
  INNER JOIN class ON student_data.fk_id_class = class.id_class WHERE id_candidate = $id_candidate");

  $candidate_details = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-Voting | Candidate Details</title>
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
    <div class="container candidate-details-contents">
      <div class="top">
        <div class="right">
          <img src="assets/img/person.jpg" alt="person">
          <div class="description">
            <div class="list">
              <p>Nama: <?= $candidate_details['name'] ?></p>
            </div>
            <div class="list">
              <p>NIS: <?= $candidate_details['nis'] ?></p>
            </div>
            <div class="list">
              <p>Kelas: <?= $candidate_details['class_name'] ?></p>
            </div>
          </div>
        </div>
        <div class="left">
          <div class="vision">
            <h3>Vision</h3>
            <p><?= $candidate_details['vision'] ?></p>
          </div>
          <div class="mission">
            <h3>Mission</h3>
            <p><?= $candidate_details['mission'] ?></p>
            <?php if ( $vote ) : ?>
              <button type="submit" class="btn-choose active" disabled>Anda sudah memilih</button>  
            <?php elseif ( !$vote ) : ?>
              <button type="submit" onclick="vote(<?= $candidate_details['id_candidate'] ?>)" class="btn-choose">Pilih</button>  
            <?php endif; ?>
          </div>
        </div>
        <div class="right">
          <img src="assets/img/person.jpg" alt="person">
          <div class="description">
            <div class="list">
              <p>Name: <?= $candidate_details['name'] ?></p>
            </div>
            <div class="list">
              <p>NIS: <?= $candidate_details['nis'] ?></p>
            </div>
            <div class="list">
              <p>Class: <?= $candidate_details['class_name'] ?></p>
            </div>
          </div>
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
  
  <script type="text/javascript">
    var vote = (id) => {
      Swal.fire({
        title: 'Apakah kamu yakin?',
        html: "<p class='msg'>Ingin memilih kandidat ini</p>",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if ( result.isConfirmed ) {
          window.location.href = 'vote.php?id=' + id;
          Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            html: "<p class='msg'>Kandidat berhasil dipilih!</p>",
            showConfirmButton: false,
            showCancelButton: false,
            timer: 2000
          }) 
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Batal',
            html: "<p class='msg'>Kandidat batal dipilih!</p>",
            showConfirmButton: false,
            showCancelButton: false,
            timer: 2000
          })
        }
      })
    }
  </script>
</body>
</html>