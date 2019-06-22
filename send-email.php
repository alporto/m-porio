<?php
$email=$_POST["mail"];
?>
<!DOCTYPE html>
<html>
<head>
	<title>invio email</title>

	<!-- lastest bootstrap for test -->

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>
<body>
<?php
	if ($email==""){
?>
	<form action="send-email.php" method="POST">
		<table border="0">
		  <tr>
		    <td>Email</td>
		    <td><input type="text" name="mail" size="30" required></td>
		  </tr>
		  <tr>
		    <td>Oggetto</td>
		    <td><input type="text" name="oggetto" size="30"></td>
		  </tr>
		  <tr>
		    <td valign="top">Messaggio</td>
		    <td><textarea rows="6" name="mex" cols="50" required></textarea></td>
		  </tr>
		  <tr>
		    <td colspan="2" valign="bottom" align="center" height="30">
		    <input type="submit" value="Invia">
		    <input type="reset" value="Cancella"></td>
		  </tr>
		</table>
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
		echo "email: ".$email."<br>";
		echo "oggetto: ".$oggetto."<br>";
		echo "messaggio: ".$messaggio."<br>";

		mail($to,$subject,$message,$headers);
		echo "<br>Messaggio inviato correttamente!";
	}
?>
</body>
</html>