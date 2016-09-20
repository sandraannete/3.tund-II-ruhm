<?php
	require("../../config.php");

	//echo hash("sha512", "romil");
	
	
	
	
	$signupEmailError = "";
	$signupPasswordError = "";
	$signupFirstNameError = "";
	$signupLastNameError = "";
	$signupEmail = "";
	$signupGender = "";

	if( isset( $_POST["signupGender"] ) ){
		
		if(!empty( $_POST["signupGender"] ) ){
		
			$signupGender = $_POST["signupGender"];
			
		}
		
	} 
	
	if(isset($_POST["signupEmail"]))
	{
			if(empty($_POST["signupEmail"])) 
			{
				$signupEmailError = "See väli on kohustuslik";
			} else {
				
				//email olemas
				$signupEmail= $_POST["signupEmail"];
				
			}
	}
	if(isset($_POST["signupPassword"]))
	{
			if(empty($_POST["signupPassword"]))
			{
				$signupPasswordError = "See väli on kohustuslik";
			} 
			else 
			{	
				if (strlen($_POST["signupPassword"]) < 8) 
				{	
					$signupPasswordError = "Parool peab olema vähemalt 8 tähemärki pikk";
				}
			}
	}
	if(isset($_POST["eesnimi"]))
	{
		if(empty($_POST["eesnimi"])) 
		{
			$signupFirstNameError = "See väli on kohustuslik";
		}
	}
	if(isset($_POST["perekonnanimi"]))
	{
		if(empty($_POST["perekonnanimi"]))
		{
			$signupLastNameError = "See väli on kohustuslik";
		}
	}
	
	
	// peab olema email ja parool
	// ühtegi errorit
	// kumbki alumistest tuleb kasutusse võtta, valin ise
	
	if ( isset($_POST["signupEmail"]) && 
		 isset($_POST["signupPassword"]) && 
		 $signupEmailError == "" && 
		 empty($signupPasswordError)
		) {
		
		// salvestame ab'i
		echo "Salvestan... <br>";
		
		echo "email: ".$signupEmail."<br>";
		echo "password: ".$_POST["signupPassword"]."<br>";
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
		echo "password hashed: ".$password."<br>";
		
		echo $serverUsername;
		//errori korral echo $mysqli->error;
		//ÜHENDUS
		$database = "if16_sandra_2";
		$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
		
		
		
		// sqli rida
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
		
		// stringina üks täht iga muutuja kohta (?), mis tüüp
		// string - s
		// integer - i
		// float (double) - d
		// küsimärgid asendada muutujaga
		$stmt->bind_param("ss", $signupEmail, $password);
		
		//täida käsku
		if($stmt->execute()) {
			
			echo "salvestamine õnnestus";
			
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		//panen ühenduse kinni
		$stmt->close();
		$mysqli->close();
		
	}
?>
<!DOCTYPE html>
<body style="background-color:aquamarine;">
<html>
<head>
	<title>Logi sisse või loo kasutaja</title>
</head>
<body>
	<h1>Logi sisse</h1>
		<form method="POST"> 
			<input name="loginEmail" placeholder="E-post" type="Email">
			<br><br>
			<input name="loginPassword" placeholder="Parool" type="password">
			<br><br>
			<input type="submit" value="Logi sisse">
		</form>
	<h1>Loo kasutaja</h1>
		<form method="POST">
			<input name="signupEmail" placeholder="E-post" type="text" value="<?=$signupEmail;?>" />
			<?php echo $signupEmailError; ?>
			
			<br><br>
			
			<input type="password" placeholder="Parool" name="signupPassword" /> 
			<?php echo $signupPasswordError; ?>
			<br><br>
			
			<input name="eesnimi" placeholder="Eesnimi" type="name" />
			<?php echo $signupFirstNameError; ?>
			<br><br>
			
			<input name="perekonnanimi" placeholder="Perekonnanimi" type="surname" />
			<?php echo $signupLastNameError; ?>
			
<h3>Sugu</h3>
			<?php if($signupGender == "Mees") { ?>
			<input type="radio" name="signupGender" value="Mees" checked> Mees<br>
		<?php }else { ?>
			<input type="radio" name="signupGender" value="Mees"> Mees<br>
		<?php } ?>
		
		<?php if($signupGender == "Naine") { ?>
			<input type="radio" name="signupGender" value="Naine" checked> Naine<br>
		<?php }else { ?>
			<input type="radio" name="signupGender" value="Naine"> Naine<br>
		<?php } ?>
		
		<?php if($signupGender == "Muu") { ?>
			<input type="radio" name="signupGender" value="Muu" checked> Muu<br>
		<?php }else { ?>
			<input type="radio" name="signupGender" value="Muu"> Muu<br>
		<?php } ?>
			
			<br><br>
			
			<input type="submit" value="Loo kasutaja">
		</form>	
</body>
</html>


