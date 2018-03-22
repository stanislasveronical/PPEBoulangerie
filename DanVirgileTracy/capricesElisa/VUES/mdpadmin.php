
<html>
<head>
<title> Titre de la page </title>
</head>
<body>

<?php
if (isset($_POST['mot_de_passe']) && isset($_POST['identifiant']))


{
	print_r ($_POST);
$mot_de_passe = $_POST['mot_de_passe'];

$identifiant = $_POST['identifiant'];

}
else
{

$mot_de_passe = "votre mdp";
$identifiant = "votre identifiant";

}
if (($mot_de_passe == "siojjr") && ($identifiant == "root"))

{

?>
Vous allez être redirigé vers l'espace administrateur dans un instant. Veuillez patienter !
<?php
	$suivant = "administration";
}
else {
	$suivant = "mdpadmin";
}
//echo 'page suivante : '.$suivant;
?>
Accès a l'espace administrateur. Remplissez les champs suivant et cliquer sur confirmer. Le site est Actuellement en maintenance ! <br />
<br />
<form method="post" action="index.php?page=
<?php
echo $suivant;
?>
"> <br />
Identifiant <br />
<input type="text" name="identifiant" value="" /> <br />
Mot de passe <br />
<input type="password" name="mot_de_passe" value="" /> <br />
<input type="submit" value="Confirmer" /> <br />
</form>



</body>
</html>