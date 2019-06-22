<?php
$servername = "89.40.172.189";
$username = "wspylneb_hybrid_admin";
$password = "lovingmum1";
$dbname = "wspylneb_hybrid";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
else{
    echo "<!-- Connessione riuscita -->";

    //stampo tabella utenti
	$sql_user = "SELECT * FROM utente;";
	$result = $conn->query($sql_user);

	if ($result->num_rows > 0) {
	    // se l'indirizzo email è già registrato mando messaggio
	    while($row = $result->fetch_assoc()) {
	    	//echo "<p><br> Codice corretto!<br></p>";
	        echo $row["nome"]. " " . $row["cognome"]. " " . $row["data_di_nascita"]. "<br>";
	    }
	}
}

?>