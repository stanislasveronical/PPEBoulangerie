<?php
	$choix = ' ';
	
	if (isset($_POST['valider']))
	{
		$choix=$_POST['valider'];

		// else
		// {
			// $choix='';
			// $_SESSION['id']=0;
		// }
		if (isset($_POST['id']))
		{
			$id = $_POST['id'];
		}
		else
		{
			$id = '';
		}
		if (isset($_POST['nom'])){
			$nom = $_POST['nom'];
		}
		else{
			$nom = '';
		}
		if (isset($_POST['prenom'])){
			$prenom = $_POST['prenom'];
		}
		else{
			$prenom = '';
		}
		if (isset($_POST['adresse'])){
			$adresse = $_POST['adresse'];
		}
		else{
			$adresse = '';
		}
		if (isset($_POST['cp'])){
			$cp = $_POST['cp'];
		}
		else{
			$cp = '';
		}
		if (isset($_POST['ville'])){
			$ville = $_POST['ville'];
		}
		else{
			$ville = '';
		}
		if (isset($_POST['mail'])){
			$mail = $_POST['mail'];
		}
		else{
			$mail= '';
		}
		if (isset($_POST['portable'])){
			$portable = $_POST['portable'];
		}
		else{
			$portable = '';
		}
		if (isset($_POST['quantite'])){
			$quantite = $_POST['quantite'];
		}
		else{
			$quantite = '';
		}
	}
	
	switch($choix)
	{
		case 'Valider la commande':
			try
			{
				InsertionCommande($nom, $prenom, $adresse, $cp, $ville, $mail, $portable, $quantite, $connexion);
				echo "Insertion réussie, les informations sont dans la base de données !";
			}

			catch(Exception $e)
			{
				echo 'Erreur : '.$e->getMessage();
			}
			
		break;
	}
?>
	
</br></br>
	<b>C'est à vous ! </b></br></br></br>
	
	<form name="saisie" method="post" action="./index.php?page=commander">
	<table>
	
	<tr>
		<td>Nom</td>
		<td><input type="text" name="nom" value="
	<?php
	
	if(!empty($_POST['nom'])&& is_string($_POST['nom'])){
		echo htmlspecialchars($_POST['nom'], ENT_QUOTES);
		}
	?>"/></td>
	</tr>
	<tr>
		<td>Prénom</td>
		<td><input type="text" name="prenom" value="
	<?php
	if(!empty($_POST['prenom'])&& is_string($_POST['prenom'])){
		echo htmlspecialchars($_POST['prenom'], ENT_QUOTES);
		}
	?>"/></td>
	</tr>
	<tr>
		<td>Adresse</td>
		<td><input type="text" name="adresse" value="
	<?php
	if(!empty($_POST['adresse']) && is_string($_POST['adresse'])){
		echo htmlspecialchars($_POST['adresse'], ENT_QUOTES);
		}
	?>"/></td>
	</tr>
	<tr>
		<td>Code Postal</td>
		<td><input type="text" name="cp" value="
	<?php
	if(!empty($_POST['cp']) && is_numeric($_POST['cp'])){
		echo htmlspecialchars($_POST['cp'], ENT_QUOTES);
		}
	?>"/></td>
	</tr>
	<tr>
		<td>Ville</td>
		<td><input type="text" name="ville" value="
	<?php 
	if(!empty($_POST['ville']) && is_string($_POST['ville'])){
		echo htmlspecialchars($_POST['ville'], ENT_QUOTES);
		}
	?>"/></td>
	</tr>
	<tr>
		<td>E-mail</td>
		<td><input type="text" name="mail" value="
	<?php 
	if(!empty($_POST['mail']) && is_string($_POST['mail'])){
		echo htmlspecialchars($_POST['mail'], ENT_QUOTES);
		}
	?>"/></td>
	</tr>
	<tr>
		<td>Portable</td>
		<td><input type="text" name="portable" value="
	<?php 
	if(!empty($_POST['portable']) && is_numeric($_POST['portable'])){
		echo htmlspecialchars($_POST['portable'], ENT_QUOTES);
		}
	?>
	"/></td>
	
	</tr>
	
		
	</table>
	
	<br/>
	<p>Le paiement de votre commande se fera sur place.</p>
</br></br>

<input type='submit' name='valider' value='Valider la commande'/>


</form>

<?php

include_once("FONCTIONS/fct_boulangerie.php");

$erreur = false;

$action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
if($action !== null)
{
   if(!in_array($action,array('ajout', 'suppression', 'refresh')))
   $erreur=true;

   //récuperation des variables en POST ou GET
   $l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
   $p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
   $q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;

   //Suppression des espaces verticaux
   $l = preg_replace('#\v#', '',$l);
   //On verifie que $p soit un float
   $p = floatval($p);

   //On traite $q qui peut etre un entier simple ou un tableau d'entier
    
   if (is_array($q)){
      $QteArticle = array();
      $i=0;
      foreach ($q as $contenu){
         $QteArticle[$i++] = intval($contenu);
      }
   }
   else
   $q = intval($q);
    
}

if (!$erreur){
   switch($action){
      Case "ajout":
         ajouterArticle($l,$q,$p);
         break;

      Case "suppression":
         supprimerArticle($l);
         break;

      Case "refresh" :
         for ($i = 0 ; $i < count($QteArticle) ; $i++)
         {
            modifierQTeArticle($_SESSION['panier']['libelleProduit'][$i],round($QteArticle[$i]));
         }
         break;

      Default:
         break;
   }
}

echo '<?xml version="1.0" encoding="utf-8"?>';?>
</br></br></br></br>


<script type="text/javascript"> 
function add( nom ) { 
document.getElementById( nom ).value ++; 
}

function substract( nom ) { 
if ( document.getElementById( nom ).value > 0 )
document.getElementById( nom ).value --; 
} 
 
function isNumberKey(evt) 
{ 
var charCode = (evt.which) ? evt.which : event.keyCode 
if (charCode > 31 && (charCode < 48 || charCode > 57)) 
return false; 
 
return true; 
} 

</script>

<script>
	function verfiSaisie(monForm){
		var valeur, controle, ok;
		ok = true;
		valeur = monForm.valider.value;
		controle = parseInt(valeur);
		if(controle!=valeur){
			alert("Saisie incorrecte !");
			monForm.valider.focus();
			ok=false;
		}
		else {
			valeur = monForm.valider.value;
			controle = parseFloat(valeur);
			if(controle!=valeur){
				alert("Saisie incorrecte!");
				monForm.valider.focus();
				ok=false;
			}
		}
		return ok;
	}
</script>



