<!DOCTYPE html>
<html>
	<head>
		<title>Flight case manag V1.0</title>
		<link rel="stylesheet" href="style.css" />
		<link rel="icon" type="image/png" href="desktop1.jpg"/>
		<meta charset="utf-8" />
	</head>

	<body>  
	<b>ziziziziiziziziz</b>
		<?php

			include("../include/sql2.php")
		   $req = $bdd->prepare('SELECT * FROM `rfid-users` usr,
                                       WHERE usr.mail = ?
                                       /*AND user.IDuser = sender.IDsender*/
                                       ');
		    $req->execute(array("time.kadel@sfr.fr"));

		    echo $result['password'];
		?>
	</body>
</html>