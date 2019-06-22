<?php
// avvio la sessione
session_start();

// recupero i valori passati via POST
$username = htmlspecialchars($_POST['username'],ENT_QUOTES);
$password = md5($_POST['password']);

// mi connetto al MySQL
define ('DB_USER', 'wspylneb_admin-emporio');
define ('DB_PASS', 'Zzy6%uUG4vyrTgX5');
define ('DB_HOST', 'localhost');
define ('DB_NAME', 'wspylneb_emporio');


$dbconn = mysql_connect(DB_HOST, DB_USER, DB_PASS);
$db2conn = mysql_connect(DB_HOST, DB_USER, DB_PASS);
mysql_select_db(DB_NAME, $dbconn);

// effettuo la query per verificare la correttezza del login
$result = mysql_query("SELECT * FROM back_user WHERE email = '" . mysql_real_escape_string($username) . "'");

// verifico che ci siano dei risultati...
if (mysql_num_rows($result) > 0)
{
  $row = mysql_fetch_assoc($result);
  // effettuo la comparazione della password digitata con quella salvata nel DB
  if (strcmp(md5($row['pwd']), $password) == 0) {
    // in caso di successo creo la sesione
    $_SESSION['userid'] = $row['name'];
    
    //salvo il log del login utente  
    /*$result2 = mysql_query("INSERT INTO user_log (data,id_user,descrizione) VALUES (".date("Y-m-d H:i:s").",".$row['id'].",'Login - inizio sessione');");
    if ($db2conn>query($result2) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $result2 . "<br>" . $db2conn->error;
    }   */

  // e stampo 1 (che identifica il successo)
    echo 1;
  }else{
    // in caso di comparazione non riuscita stampo zero
    echo 0;
  }
}else{
  // se non ci sono risultati stampo 2
  echo 2;
}

if (isset($_SESSION['userid'])) {
    
} 
?>