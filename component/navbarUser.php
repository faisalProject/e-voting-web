<nav>
    <div class="container">
      <div class="left-menu">
        <div class="beranda">
          <a href="dashboard.php">Dashboard</a>
        </div>
        <div class="candidate-list">
          <a href="candidate-list.php">Candidate List</a>
        </div>
        <div class="about">
          <a href="about.php">About</a>
        </div>
      </div>
      <div class="right-menu">
        <!-- <div class="button">
          <a href="signin.html" class="btn-signin">Sign in</a>
          <a href="register.html" class="btn-signup">Sign up</a>
        </div> -->
        <p><?= $student['name'] ?></p>
        <div class="dropdown">
          <div class="profile">
            <img src="assets/img/f2.png" alt="person">
            <i class="bi bi-chevron-down"></i>
          </div>
          <div class="menu">
            <a href="my-profile.php" class="menu-list">My Profile</a>
            <a href="logout.php" class="menu-list">Logout</a>
          </div>
        </div>
        <div class="hamburger">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
  </nav>