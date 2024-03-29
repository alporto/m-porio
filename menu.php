<?php

?>
<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1 desktop" href="index.php"><img src="img/logo-mini.jpg" width="30" style="margin-right: 5px;">Emporio Solidale - Admin</a>
    <a class="navbar-brand mr-1 mobile" href="index.php"><img src="img/logo-mini.jpg" width="30" style="margin-right: 5px;">ES - Admin</a>

<?php
function writeMsg() {
  $pag=str_replace("/test/emporio/","",$_SERVER['REQUEST_URI']);
  //echo "<!-- test: ".$pag." -->";
?>
  <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <!-- <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <!-- <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <span class="badge badge-danger">9+</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"></i>
          <span class="badge badge-danger">7</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li> -->
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
          <span>Ciao <?php echo $_SESSION['userid'] ?>!</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">Settings</a>
          <a class="dropdown-item" href="#">Activity Log</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal" href="javascript:void(0)">Logout</a>
        </div>
      </li>
    </ul>

  </nav>
 <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Uscire dal pannello Admin</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Clicca su Logout per confermare l'uscita.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Annulla</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav toggled">
      <?php 
      //if ($pag=="index.php") || ($pag=="") 
      if ($pag=="index.php" or $pag==""){
        $classe="active";
      }
      else{
        $classe="";
      }
      echo "<!-- test1 ".$pag." / ".$classe."-->";
      ?>
      <li class="nav-item <?php echo $classe; ?>">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">Login Screens:</h6>
          <a class="dropdown-item" href="login.html">Login</a>
          <a class="dropdown-item" href="register.html">Register</a>
          <a class="dropdown-item" href="forgot-password.html">Forgot Password</a>
          <div class="dropdown-divider"></div>
          <h6 class="dropdown-header">Other Pages:</h6>
          <a class="dropdown-item" href="404.html">404 Page</a>
          <a class="dropdown-item" href="blank.html">Blank Page</a>
        </div>
      </li> -->
      <?php 
      if ($pag=="calendar.php") {
        $classe="active";
      }
      else{
        $classe="";
      }
      ?>
      <li class="nav-item <?php echo $classe; ?>">
        <a class="nav-link" href="calendar.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Calendario</span></a>
      </li>
      <?php 
      if ($pag=="utenti.php") {
        $classe="active";
      }
      else{
        $classe="";
      }
      ?>
      <li class="nav-item <?php echo $classe; ?>">
        <a class="nav-link" href="utenti.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Utenti</span></a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Scrivi SMS</span></a>
      </li> -->
      <?php 
      if ($pag=="email.php") {
        $classe="active";
      }
      else{
        $classe="";
      }
      echo "<!-- test3 ".$pag." / ".$classe."-->";
      ?>
      <li class="nav-item <?php echo $classe; ?>">
        <a class="nav-link" href="email.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Scrivi Email</span></a>
      </li>
    </ul>
<?php
}
writeMsg();
?>