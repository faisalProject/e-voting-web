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

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="assets/css/main.css">
  <title>E-Voting | About</title>
</head>
<body>
  <!-- navbar -->
  <?php
  require 'component/navbarUser.php';
  ?>
  <!-- end of navbar -->

  <main>
    <div class="container about-contents">
      <div class="top">
        <div class="left">
          <h4>Vision</h4>
          <ol>
            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, neque.</li>
            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque facilis vel sint assumenda. Animi tenetur fugiat vero id. Magni, inventore!</li>
            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse, eaque minus quam aspernatur beatae natus.</li>
            <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nobis excepturi consequuntur nisi non facilis, ullam quo dicta corrupti voluptates adipisci aliquid ipsa odio ratione? Enim.</li>
          </ol>
        </div>
        <div class="right">
          <h4>Mision</h4>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus tempore, ipsa at blanditiis porro maiores animi, quaerat doloribus aspernatur dolorum numquam deserunt vel. Adipisci, eveniet aut recusandae maxime quisquam eius nam facilis ex quibusdam blanditiis omnis? Culpa sit reprehenderit nostrum.</p>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi reiciendis cupiditate laboriosam assumenda, sit alias, amet quidem magni sapiente, eum blanditiis minima a eius labore!</p>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem facere esse, voluptates id accusantium aliquam corrupti sint, ut aliquid, nemo magnam. Officiis officia distinctio voluptas laboriosam quisquam nisi inventore impedit quae eveniet, architecto, minus, illo dolorem ipsa facilis nesciunt. Architecto!</p>
        </div>
      </div>
      <div class="bottom">
        <h4>Facility</h4>
        <ol>
          <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam animi, quo corrupti vitae saepe aliquam. Vitae dolor natus ab eius!</li>
          <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos, debitis perspiciatis. Commodi eaque minima consequuntur minus voluptates consectetur fugit? Sint perspiciatis ut odit aut facilis.</li>
          <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quibusdam tenetur ab non, dignissimos quas!</li>
          <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Suscipit, ipsa aliquam odio dolores quaerat eaque laudantium facilis officiis commodi laboriosam?</li>
          <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur dolorem repellat reiciendis ex rem? Ipsam iste quia nemo consequatur, labore perspiciatis rem ipsum quidem obcaecati.</li>
        </ol>
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
</body>
</html>