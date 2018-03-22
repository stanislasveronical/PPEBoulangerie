<?php
	$choice = ' ';
	
	if(isset($_POST['valider']))
	{
		$choice = $_POST['valider'];

		if(isset($_POST['pseudo']))
		{
			$pseudo = $_POST['pseudo'];
		}

		else
		{
			$pseudo = '';
		}

		if(isset($_POST['password']))
		{
			$password = $_POST['password'];
		}

		else
		{
			$password = '';
		}

		if(isset($_POST['répétition']))
		{
			$répétition = $_POST['répétition'];
		}

		else
		{
			$répétition = '';
		}

		if(isset($_POST['mail']))
		{
			$mail = $_POST['mail'];
		}

		else
		{
			$mail = '';
		}

		switch ($choice)
		{
			case '<<':
			try
			{
				$i = $_SESSION['numProd'] = 0;
				recupProd($liste,$i);
			}
				

			catch(Exception $e)
			{
				echo 'Erreur : '.$e->getMessage();
			}
				
			break;

			case 'Reset':
			try
			{
				$pseudo = '';
				$password = '';
				$répétition = '';
				$mail = '';
			}

			catch(Exception $e)
			{
				echo 'Erreur : '.$e->getMessage();
			}
				
			break;

			case 'Verif':
			try
			{
				if ($password == $répétition)
				{
					echo "true";
				}

				else
				{
					echo "false";
				}
				
			}

			catch(Exception $e)
			{
				echo 'Erreur : '.$e->getMessage();
			}
				
			break;
		}
	}

	else
	{
		echo "569";
	}
?>

<form name = "inscription" method="post" action="index.php?page=inscription" onsubmit="return verifSaisieInscription(this);">
	<table>
		<tr>
			<td>Pseudo</td>
			<td><input type="text" name="pseudo" id="pseudo"></td>
		</tr>
		<br />
		<tr>
			<td>Mot de passe</td>
			<td><input type="password" name="password" id="password"></td>
		</tr>
		<br />
		<tr>
			<td>Répétition du mot de passe</td>
			<td><input type="password" name="répétition" id="répétition"></td>
		</tr>
		<br />
		<tr>
			<td>Adresse email</td>
			<td><input type="text" name="mail" id="mail"></td>
		</tr>
	</table>

	<br/>

	<input type="submit" name="valider" value="Verif"/>
	<input type="submit" name="valider" value="Valider"/>	
	<input type="submit" name="valider" value="Reset"/>

	<br/><br/>

	<?php
		$_SESSION['captcha'] = mt_rand(1000,9999);
		$img = imagecreate(100,30);
		$font = 'fonts/28DaysLater.ttf';

		$bg = imagecolorallocate($img,255, 255,255);
		$textcolor = imagecolorallocate($img, 0, 0, 0);

		imagettftext($img, 23, 0, 0, 25, $textcolor, $font, $_SESSION['captcha']);

		//header('Content-type:image/jpeg');
		//imagejpeg($img);
		//imagedestroy($img);

	?>
</form>

<?php
	//crypt --> hachage
	//lcfirst/ucfirst --> premier caractère en minuscule/majuscule
	//str_rot13 --> ROT13
	//str_shuffle --> mélange
	//strrev --> inverse
	//strtr --> remplace

	echo hash('sha256',str_rot13(strtr(strrev(ucfirst('hello256')),'e','r')))."<br><br><br>";

	echo codageMDP('hello256')."<br>";
	echo strlen(codageMDP('hello'));

?>

<script src="JS/verifSaisieInscription.js"></script>