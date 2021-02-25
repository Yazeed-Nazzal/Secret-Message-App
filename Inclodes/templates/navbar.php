<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Saraha Time</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <?php
      if (isset($_SESSION['email'])) {
          ?>
        <li class="nav-item active">
        <a class="nav-link" href="index.php">  Massages <span class="sr-only">(current)</span></a>
      </li>
      <?php
      }


      ?>
           <?php
      if (!isset($_SESSION['email'])) {
          ?>
     <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
      <?php
      }
      else {
        ?>
        <li class="nav-item">
           <a class="nav-link" href="logout.php">Logout</a>
         </li>
         <li class="nav-item">
        <a class="nav-link " href="profile.php" tabindex="-1" aria-disabled="true">Profile</a>
      </li>
      </ul>
         <?php

      }


      ?>
  
     
  
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>