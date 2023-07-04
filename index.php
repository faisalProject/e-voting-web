<?php

  session_start();
  require 'api/conn.php';

  $db = new Voting("localhost", "root", "", "db_evoting_web");
  $conn = $db->connect();

  if ( isset($_COOKIE['xyz']) && isset($_COOKIE['zyx']) ) {
    header("Location: dashboard.php");
  }

  $candidate_list = $db->query($conn, "SELECT id_candidate, name, nis, class_name, vision, mission FROM candidate
  INNER JOIN student ON candidate.fk_id_student = student.id_student 
  INNER JOIN student_data ON student.fk_id_data = student_data.id_data 
  INNER JOIN class ON student_data.fk_id_class = class.id_class ORDER BY id_candidate DESC");

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Voting</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/main.css">
  </head>
  <body>
    <!-- navbar -->
    <?php 
    require 'component/navbarLandingPage.php';
    ?>
    <!-- end of navbar -->

    <main>

      <div class="container jumbotron">
        <div class="description">
          <h3>E-Voting</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid aperiam voluptatum illum voluptatibus ipsa. Velit id eos est? Distinctio, cum incidunt! At ut saepe a vitae repellat perferendis consectetur magni.</p>
          <a href="#id-candidate-list" class="lets-choose page-scroll">Let's Choose!</a>
        </div>
        <img src="assets/img/360_F_272866039_y2WIeSCCxmDVrc3M3JQd5t22rfwhqZsf-removebg-preview.png" alt="">
        <div class="description">
          <h3>E-Voting</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid aperiam voluptatum illum voluptatibus ipsa. Velit id eos est? Distinctio, cum incidunt! At ut saepe a vitae repellat perferendis consectetur magni.</p>
          <a href="#id-candidate-list" class="lets-choose page-scroll">Let's Choose!</a>
        </div>
      </div>

      <div class="candidate-contents" id="id-candidate-list">
        <div class="container">
          <div class="pagination">
            <div class="circle prev-btn">
              <i class="bi bi-arrow-left"></i>
            </div>
            <div class="circle next-btn">
              <i class="bi bi-arrow-right"></i>
            </div>
          </div>
          <div class="candidate">
            <div class="left card-wrapper">
              <?php foreach ( $candidate_list as $c ) : ?>
                <div class="card">
                  <img src="assets/img/person.jpg" alt="">
                  <div class="description">
                    <div class="top">
                      <p>Name : <?= substr($c['name'], 0, 10) ?>....</p>
                      <p>NIS : <?= $c['nis'] ?></p>
                    </div>
                    <div class="bottom">
                      <h3 class="vision-text hidden">Vision</h3>
                      <p><?= substr($c['vision'], 0, 45) ?>....</p>
                      <p class="vision-description hidden"><?= substr($c['vision'], 0, 400) ?>...</p>
                      <h3 class="mission-text hidden">Mission</h3>
                      <p class="mission-description hidden"><?= substr($c['mission'], 0, 400) ?>...</p>
                    </div>
                  </div>
                  <a href="#id-candidate-list" class="page-scroll"></a>
                </div>
              <?php endforeach; ?>
            </div>
            <div class="right">
              <div class="vision">
                <h3 class="core-vision-text">Vision</h3>
                <p class="core-vision-description"><?= substr($candidate_list[0]['vision'], 0, 400) ?>...</p>
              </div>
              <div class="mission">
                <h3 class="core-mission-text">Mission</h3>
                <p class="core-mission-description"><?= substr($candidate_list[0]['mission'], 0, 400) ?>...</p>
              </div>
              <button class="more">More</button>
            </div>
          </div>
        </div>
      </div>

      <?php 
      require 'component/mobileNavbarLandingPage.php';
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