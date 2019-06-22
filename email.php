<?php
// avvio la sessione
session_start();

// verifico che esista la sessione di autenticazione
if (empty($_SESSION['userid'])) {
  header("location: http://www.krakenstudio.it/test/hybrid/login.php");
  exit;
}

// gestisco la richiesta di logout
if (isset($_GET['logout'])) {
  session_destroy();
  echo "Sei uscito con successo";
  exit;
}
$email=$_POST["mail"];
?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Hybrid Studio Lab Admin - Pannello email">
  <meta name="author" content="www.krakenstudio.it">

  <title>Scrivi Email</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link rel="icon" href="img/logo-mini.jpg" />
</head>

<body id="page-top">

  <?php include 'menu.php';?>
  

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Spedisci Email</li>
        </ol>

        <h3>Manda Email</h3>
<?php
  if ($email==""){
?>
<!-- desktop -->
  <form class="desktop" action="email.php" method="POST">
    <table border="0">
      <tr>
        <td>Destinatario</td>
        <td><input type="text" name="mail" size="100%" required></td>
      </tr>
      <tr>
        <td>Oggetto</td>
        <td><input type="text" name="oggetto" size="100%"></td>
      </tr>
      <tr>
        <td valign="top">Messaggio</td>
        <td><textarea rows="6" name="mex" required></textarea></td>
      </tr>
      <tr>
        <td colspan="2" valign="bottom" align="center" height="30">
        <input type="submit" value="Invia">
        <input type="reset" value="Cancella"></td>
      </tr>
    </table>
  </form>
  <!-- mobile -->
  <form class="mobile" action="email.php" method="POST">
    <ul class="form-mobile">
      <li>
        <span>A </span><input type="text" name="mail" size="100%" required>
      </li>
      <li>
        <span>Oggetto </span><input type="text" name="oggetto" size="100%">
      </li>
      <li id="textarea-mobile">
        <textarea rows="6" name="mex" required></textarea>
      </li>
    </ul>
    <div class="submit-form">
      <button type="button" class="btn btn-primary submit-mobile">
        <input type="submit" value="Invia">
      </button>
    </div>
    
  </form>
<?php
  }
  else{
    
    $oggetto=$_POST["oggetto"];
    $messaggio=$_POST["mex"];

    $to = $email;
    $subject = "Hybrid Music - ".$oggetto;

    $message = "
    <html>
    <head>
    <title>HTML email</title>
    </head>
    <body>
    <p>".$messaggio."</p>
    <br>
    -------------------------
    <br>
    <i>Hybrid Music Staff</i>
    </body>
    </html>
    ";

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <webmaster@example.com>' . "\r\n";
    $headers .= 'Cc: myboss@example.com' . "\r\n";
    echo "<div class='response-mail'>";
    echo "<h5><b>Destinatario</b>: ".$email."</h5>";
    echo "<h5><b>Oggetto</b>: ".$oggetto."</h5>";
    echo "<h5><b>Messaggio</b>: ".$messaggio."</h5>";

    mail($to,$subject,$message,$headers);
    echo '<h5 class="success">Messaggio inviato correttamente!<h5>';
    echo "</div>";
    echo '<a href="index.php" title="Torna alla index">';
    echo '<button type="button" class="btn btn-primary back">Torna Indietro</button>';
    echo '</a>';
  }
?>








      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Kraken Studio 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-bar-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
