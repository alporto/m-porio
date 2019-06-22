
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Emporio - Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <style type="text/css">
    .corretto,
    .errore {
      padding: 3px;
      text-align: center;
    }
    .corretto,
    .errore {
      width: auto;
      font-weight: bold;
      border: 1px solid #349534;
      background: #C9FFCA;
      color: #008000;
    }
    .errore {
      border: 1px solid #CC0000;
      background: #F7CBCA;
      color: #CC0000;
      margin-bottom: 10px;
    }
  </style>
</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Emporio - Login</div>
      <div class="card-body">
        <div id="messaggio"></div>
        <form id="modulo_login">
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" class="form-control" placeholder="Indirizzo email" required="required" autofocus="autofocus">
              <label for="inputEmail">Indirizzo Email</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <!-- <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me">
                Ricorda Password
              </label>
            </div>
          </div> -->
          <input id="inputsubmit" type="submit" class="btn btn-primary btn-block" placeholder="Login">
        </form>
        
        <!-- <div class="text-center">
          <a class="d-block small mt-3" href="register.html">Register an Account</a>
          <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
        </div> -->
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <script type="text/javascript">
$("#modulo_login").submit(function() {
  // passo i dati (via POST) al file PHP che effettua le verifiche 
  $.post("ajax-login.php", { username: $('#inputEmail').val(), password: $('#inputPassword').val(), rand: Math.random() }, function(risposta) {
    //console.log("username: "+$('#inputEmail').val());
    //console.log("pwd: "+$('#inputPassword').val());
    // se i dati sono corretti...
    if (risposta == 1) {
      // applico l'effetto allo span con id "messaggio"
      $("#messaggio").fadeTo(200, 0.1, function() {
        // per prima cosa mostro, con effetto fade, un messaggio di attesa
        $(this).removeClass().addClass('corretto').text('Login in corso...').fadeTo(900, 1, function() {
          // al termine effettuo il redirect alla pagina privata
          document.location = 'index.php';
        });
      });
    // se, invece, i dati non sono corretti...
    }
    else if(risposta==2){
      // stampo un messaggio di errore
      $("#messaggio").fadeTo(200, 0.1, function() {
        $(this).removeClass().addClass('errore').text('Nessun utente con questa mail').fadeTo(900,1);
      });
    }
    else{
      // stampo un messaggio di errore
      $("#messaggio").fadeTo(200, 0.1, function() {
        $(this).removeClass().addClass('errore').text('Password sbagliata').fadeTo(900,1);
      });
    }
  });
  // evito il submit del form (che deve essere gestito solo dalla funzione Javascript)
  return false;
});
</script>

</body>

</html>
