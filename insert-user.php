<?php
include 'conn.php';

// Submitted form data
$nome=strtoupper($_POST['nome']);
$cognome=strtoupper($_POST['cognome']);
$cf=strtoupper($_POST['cf']);
$tel=$_POST['tel'];
$email=$_POST['email'];
$bs=$_POST['bs'];
//$data_iscrizione=date("Y-m-d");


//condizione riuscita ajax, gestisci poi
if (1==1){
    
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    else{
        // controllo se il CF è già inserito. Se non lo è procedo con l'inserimento
        $sql_user = "SELECT * FROM Users WHERE StateCode='".$cf."' ORDER BY id DESC;";
        $result = $conn->query($sql_user);


        if ($result->num_rows > 0) {
            $status = 'errcf';
            echo $status;
        }
        else{
        
            //nb: assegno ai punti rimanenti il totale inserito. Se un utente è nuovo avrà ancora il 100% dei suoi punti
            $sql = "INSERT INTO Users (FirstMiddleName, Surname, StateCode,BasePoints,ActivePoints,UserMail,UserPhone)
            VALUES ('".$nome."', '".$cognome."', '".$cf."','".$bs."','".$bs."','".$email."','".$tel."')";

            if ($conn->query($sql) === TRUE) {
                $status = 'ok';
                echo $status;

            } else {
                $status = 'err';
                echo $status;
                //echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}
else{
    $status = 'err';
}

return $status

?>