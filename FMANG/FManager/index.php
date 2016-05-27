<!DOCTYPE html>
<html>
	<head>
		<title>Flight case manager V1.0</title>
		<link rel="stylesheet" href="style.css" />
		<link rel="icon" type="image/png" href="desktop1.jpg"/>
		<script src="sweetalert.min.js"></script>
		<link rel="stylesheet" type="text/css" href="sweetalert.css">
		<meta charset="utf-8" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	</head>

	<script type="text/javascript">
		function showLog() {
			if(document.getElementById('tb').style.display == "none")
	  			document.getElementById('tb').style.display = "block";
	  		else
	  			document.getElementById('tb').style.display = "none";
		}
		function showReg() {
			if(document.getElementById('tb2').style.display == "none")
	  			document.getElementById('tb2').style.display = "block";
	  		else
	  			document.getElementById('tb2').style.display = "none";
		}
	</script>

	<?php 
	
		if (isset($_POST['mail']) AND isset($_POST['password'])) {

					/*$req = $bdd->prepare('SELECT * FROM  `wdidy-user` WHERE 1');
					$req->execute();
					while ($result = $req->fetch(PDO::FETCH_ASSOC)) {
						if($result['email'] == $_POST['mail']){
							$isExist = 1;
						}else{
							$isExist = 0;
						}
					}*/
					$isExist = 1;
					if($isExist == 1){
						echo "<script> swal({
										title:'Oops...',
										text:'It seems like you are alreday in our database !',
										type:'error'
										},
										function(){
											window.location.href = 'index.php';
										});
							 </script>";
					}
		}
	 ?>

	<body>
		<div class = "upper">
			<div class = "uppermost"></div>
			<div class = "header"></div>
			<img class="logosono" src="logosono.png" height="32" width="32">
			<img class="logo" src="logo.png" height="32">
			<div class = "buttons">
				<div class = "login">LOGIN</div>
				<div class = "register">REGISTER</div>
			</div>
				<form action="index.php" method="post" class = "logbox" id="tb">
					<input type="text" name="mail"  class = "tb1" placeholder="email address"><br>
					<input type="password" name="password"  class = "tb1" placeholder="password"><br>
					<input type="submit" style="display: none"/>
				</form>
			<div class = "title">FLIGHT CASE MANAGER</div>
			<div class = "subtitle">Improve the magament of your flight cases</div>
		</div>
		<div class = "txt">
			Flight case manager allows you to <font color="#32CBCB">keep track of the material stored in your warehouse</font> anywhere you want from wherever you are located in the world<br> by simply <font color="#32CBCB">sticking an RFID tag</font> on each of your device 
		</div>
			<table style="width:100%" class = "tabl">
			  <tr>
			    <td><font color="#032F3E" size="4" face="spro">Easy to use<br><br><font color="#032F3E" size="3" face="sprol">stick RFID tags on your <br> material and set up your <br> database on the website ! </font></td>
			    <td><font color="#032F3E" size="4" face="spro">Real time acquisition<br><br><font color="#032F3E" size="3" face="sprol">Don't ever lose track or<br> forget anything during your <br> anymore thanks to F Manager</font></td>	
			    <td><font color="#032F3E" size="4" face="spro">Highly customisable<br><br><font color="#032F3E" size="3" face="sprol">Customize your database <br> with special names<br> and color codes,<br></font></td>
			  </tr>
			</table>
		<div class = "sponsors">
			<font color="#032F3E" size="20">How does it work ?</font>
			<div class="section">Configuration</font></div>
			<div class="section">Data sharing</font></div>
			</div>
			<div class = "circle">
				<div class = "up">
					UP
				</div>
			</div>
		</div>
		<div class = "line1"></div>
		<div class = "footer"></div>
		<div class = "footermost"></div>
		<img class = "info" url="RFID.png">
	</body>
</html>