<?php
	$signupEmailError = "";
	$signupPasswordError = "";
	$signupFirstNameError = "";
	$signupLastNameError = "";

	if(isset($_POST["signupEmail"]))
	{
			if(empty($_POST["signupEmail"])) 
			{
				$signupEmailError = "See väli on kohustuslik";
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
			<input name="signupEmail" placeholder="E-post" type="text" />
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
			<input type="radio" name="Sugu" value="Mees" checked /> Mees<br>
			<input type="radio" name="Sugu" value="Naine" /> Naine<br>
			<input type="radio" name="Sugu" value="Muu" /> Muu
			<br><br>
			<input type="submit" value="Loo kasutaja">
		</form>	
</body>
</html>


