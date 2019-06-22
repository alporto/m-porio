<?php
// avvio la sessione
session_start();

// verifico che esista la sessione di autenticazione
if (empty($_SESSION['userid'])) {
  header("location: http://www.krakenstudio.it/test/emporio/login.php");
  exit;
}

// gestisco la richiesta di logout
if (isset($_GET['logout'])) {
  session_destroy();
  echo "Sei uscito con successo";
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Emporio Solidale - Anagrafica utenti">
  <meta name="author" content="www.krakenstudio.it">

  <title>Emporio Solidale - Utenti</title>

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
          <li class="breadcrumb-item active">Utenti</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <button type="button" class="btn btn-primary new-user" data-toggle="modal" data-target="#modalForm">Inserisci nuovo utente</button>'
          <!-- modal new user -->

          <div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Nuovo Iscritto</h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
                <form role="form">
                    <div class="form-group">
                        <label for="nome-form">Nome</label>
                        <input type="text" class="form-control" id="nome-form" placeholder="Inserisci il nome"/>
                    </div>
                    <div class="form-group">
                        <label for="cognome-form">Cognome</label>
                        <input type="text" class="form-control" id="cognome-form" placeholder="Inserisci il cognome"/>
                    </div>
                    <div class="form-group">
                        <label for="cf-form">Cod Fiscale</label>
                        <input type="text" class="form-control" id="cf-form" placeholder="Inserisci Codice Fiscale"/>
                    </div>
                    <div class="form-group">
                        <label for="bs-form">Punteggio</label>
                        <input type="number" name="quantity" min="1" max="10000" class="form-control" id="bs-form" placeholder="Inserisci Punteggio">
                    </div>
                    <div class="form-group">
                        <label for="tel-form">Telefono</label>
                        <input type="text" class="form-control" id="tel-form" placeholder="Telefono"/>
                    </div>
                    <div class="form-group">
                        <label for="email-form">E-mail</label>
                        <input type="email" class="form-control" id="email-form" placeholder="Inserisci Email"/>
                    </div>
                    <!--<div class="form-group">
                        <label for="nascita-form">Data di nascita</label>
                        <br>
                        <input type="date" name="bday" id="nascita-form">
                    </div>
                     
                    <div class="form-group">
                      <label for="tessera-form">Tessera</label>
                      <select id="tessera-form">
                        <option value="0">No</option>
                        <option value="1">Si</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="deposito-form">Deposito</label>
                      <select id="deposito-form">
                        <option value="0">No</option>
                        <option value="1">Si</option>
                      </select>
                    </div>
                    -->
                    
                </form>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
                <button type="button" class="btn btn-primary submitBtn" id="submitform" onclick="submitContactForm()">Ok</button>
            </div>
        </div>
    </div>
</div>
          <!-- / Modal -->
          <div class="card-header">
            <i class="fas fa-table"></i>
            Anagrafica Utenti</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>Codice Fiscale</th>
                    <th>Punti Mensili</th>
                    <th>Punti Rimasti</th>
                    <th>Telefono</th>
                    <th>Email</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                   <th>Id</th>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>Codice Fiscale</th>
                    <th>Punti Mensili</th>
                    <th>Punti Rimasti</th>
                    <th>Telefono</th>
                    <th>Email</th>
                  </tr>
                </tfoot>
                <tbody>
<?php
include 'conn.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
else{
    echo "<!-- Connessione riuscita -->";

    //stampo tabella utenti
  $sql_user = "SELECT * FROM Users WHERE IsVolunteer=0 ORDER BY id DESC;";
  $result = $conn->query($sql_user);

  if ($result->num_rows > 0) {
      // se l'indirizzo email è già registrato mando messaggio
    
      while($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["Id"]. "</td>";
          echo "<td>" . $row["FirstMiddleName"]. "</td>";
          echo "<td>" . $row["Surname"]. "</td>";
          echo "<td>" . $row["StateCode"]. "</td>";
          echo "<td>" . $row["BasePoints"]. "</td>";
          echo "<td>" . $row["ActivePoints"]. "</td>";
          echo "<td>" . $row["UserMail"]. "</td>";
          echo "<td>" . $row["UserPhone"]. "</td>";
          echo "</tr>";
      }
    
  }
}

?>
            
                  
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

        <p class="small text-center text-muted my-5">
          <em>More table examples coming soon...</em>
        </p>

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
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>

</body>
<script>

function submitContactForm(){
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var nome = $('#nome-form').val();
    var cognome = $('#cognome-form').val();
    var cf = $('#cf-form').val();
    var email = $('#email-form').val();
    var tel = $('#tel-form').val();
    var bs = $('#bs-form').val();
    //var tessera = $('#tessera-form').val();
    //var deposito= $('#deposito-form').val();

    document.getElementById("submitform").disabled = true;
    
    // controllo su NOME
    if(nome.trim() == '' ){
        alert('Inserire il nome.');
        $('#nome-form').focus();
        return false;
    }

    // controllo su COGNOME
    else if(cognome.trim() == '' ){
        alert('Inserire il cognome.');
        $('#cognome-form').focus();
        return false;
    }

    // controllo su COGNOME
    else if(cf.trim() == '' ){
        alert('Inserire il codice fiscale.');
        $('#cf-form').focus();
        return false;
    }

    // controllo su EMAIL (vuoto)
    else if(email.trim() == '' ){
        alert('Inserire email.');
        $('#inputEmail').focus();
        return false;
    }

    // controllo su EMAIL VALIDA
    else if(email.trim() != '' && !reg.test(email)){
        alert('Inserire email valida.');
        $('#inputEmail').focus();
        return false;
    }

    // controllo su TELEFONO
    else if(tel.trim() == '' ){
        alert('Inserisci telefono.');
        $('#tel-form').focus();
        return false;
    }

    // controllo su BS
    else if(cf.trim() == '' ){
        alert('Inserire il Punteggio.');
        $('#bs-form').focus();
        return false;
    }


    // DATI CORRETTI, mando via ajax
    else{
        $.ajax({
            type:'POST',
            url:'insert-user.php',
            data:'contactFrmSubmit=1&nome='+nome+'&cognome='+cognome+'&cf='+cf+'&email='+email+'&tel='+tel+'&bs='+bs,
            beforeSend: function () {
                $('.submitBtn').attr("disabled","disabled");
                $('.modal-body').css('opacity', '.5');
            },
            success:function(msg){
            alert("mess:"+msg);
                if(msg == 'ok'){
                    $('#inputName').val('');
                    $('#inputEmail').val('');
                    $('#inputMessage').val('');
                    $('.statusMsg').html('<span class="success-status">Nuovo utente inserito con successo!</p>');
                
                    setTimeout(function(){
                       window.location.reload(1);
                    },3000);
                }else if(msg == 'errcf'){
                    $('.statusMsg').html('<span class="error-status">Utente già inserito!</span>');
                }
                else{
                    $('.statusMsg').html('<span class="error-status">Errore!</span>');
                }
                $('.submitBtn').removeAttr("disabled");
                $('.modal-body').css('opacity', '');
            }
        });
    }
}

</script>
</html>
