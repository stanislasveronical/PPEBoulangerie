<form name = "inscription" method="post" action="index.php?page=administration" onsubmit="return verifSaisieInscription(this);">
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
			<td><input type="text" name="pseudo" id="mail"></td>
		</tr>
	</table>


<?php
	//crypt --> hachage
	//lcfirst/ucfirst --> premier caractère en minuscule/majuscule
	//str_rot13 --> ROT13
	//str_shuffle --> mélange
	//strrev --> inverse
	//strtr --> remplace

	echo hash('sha256',str_rot13(strtr(strrev(ucfirst('hello')),'e','r')))."<br><br><br>";

	echo codageMDP('hello')."<br>";
	echo strlen(codageMDP('hello'));
	


?>

<script src="JS/verifSaisieInscription.js"></script>