<form name="saisie" method="post" action="./index.php?page=panier" 
onSubmit="return verifSaisie(this);"> <!-- fonction javascript pour vérifier la saisie -->
<!-- on utilise un tableau pour aligner les libellés et les champs -->
</br></br>
<center>
<table>
	<caption>Mon Panier</caption>

	<tr>
		<td>Mon produit</td>
		<!-- <td><input type="text" name="codeProduit" value="-->
	<?php 
	 if(!empty($_POST['codeProduit']) && is_numeric($_POST['codeProduit'])) { 
		echo htmlspecialchars($_POST['codeProduit'], ENT_QUOTES);
	 }
	?>
	<!--"/></td>-->
	
	<td rowspan="5"><img src="IMAGES\
	<?php
		echo $_POST['photo']
		?>
		" alt="<?php echo $_POST['photo']; ?>" title="<?php echo $_POST['libelleProduit']; ?>"/></td>
	</tr>

	<tr>
		<td>Quantité</td>
		<td><input type="text" name="libelleProduit" value="
	<?php 
	 if(!empty($_POST['libelleProduit'])) { 
		echo htmlspecialchars($_POST['libelleProduit'], ENT_QUOTES);
	 }
	?>
	"/></td>
	</tr>

	<tr>
		<td>Prix</td>
		<td><input type="text" name="composition" value="
	<?php 
	 if(!empty($_POST['composition'])) { 
		echo htmlspecialchars($_POST['composition'], ENT_QUOTES);
	 }
	?>
	"/></td>
	</tr>

	<tr>
		<td>Photo du produit</td>
		<td><input type="text" name="photo" value="
	<?php 
	 if(!empty($_POST['photo'])) { 
		echo htmlspecialchars($_POST['photo'], ENT_QUOTES);
	 }
	?>
	"/></td>
	</tr>
<input type="submit" name="valider" value="Supprimer"/>

	<!-- ajouter les autres champs ………..-->
</table>
</center>