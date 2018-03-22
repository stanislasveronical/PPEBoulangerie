<?php
	$choice = ' ';
	
	if(isset($_POST['valider']))
	{
		$choice = $_POST['valider'];

		if(isset($_POST['codeProduit']))
		{
			$codeProduit = $_POST['codeProduit'];
		}

		else
		{
			$codeProduit = '';
		}

		if(isset($_POST['libelleProduit']))
		{
			$libelleProduit = $_POST['libelleProduit'];
		}

		else
		{
			$libelleProduit = '';
		}

		if(isset($_POST['composition']))
		{
			$composition = $_POST['composition'];
		}

		else
		{
			$composition = '';
		}

		if(isset($_POST['photo']))
		{
			$photo = $_POST['photo'];
		}

		else
		{
			$photo = '';
		}

		if(isset($_POST['codeTypeProduit']))
		{
			$codeTypeProduit = $_POST['codeTypeProduit'];
		}

		else
		{
			$codeTypeProduit = '';
		}

		$liste = listeProd($connexion);

		switch ($choice)
		{
			case '<<':
			try
			{
				$i = $_SESSION['numProd'] = 0;
				$c = $i + 1;
				recupProd($liste,$i);
				echo "Déplacement vers le produit n°".$c;
			}

			catch(Exception $e)
			{
				echo 'Erreur : '.$e->getMessage();
			}
				
			break;

			case '<':
			try
			{
				if ($_SESSION['numProd'] > 0)
				{
					$i = $_SESSION['numProd'] = $_SESSION['numProd'] - 1;
				}

				else
				{
					$i = $_SESSION['numProd'] = $_SESSION['nbrProdMax'];
				}

				recupProd($liste,$i);
			}

			catch(Exception $e)
			{
				echo 'Erreur : '.$e->getMessage();
			}
				
			break;

			case 'Ajouter':
			try
			{
				insertionProd($libelleProduit,$composition,$photo,$codeTypeProduit,$connexion);
				echo "Insertion réussie";
			}

			catch(Exception $e)
			{
				echo 'Erreur : '.$e->getMessage();
			}
				
			break;

			case 'Mettre à jour':
			try
			{
				modificationProd($codeProduit,$libelleProduit,$composition,$photo,$codeTypeProduit,$connexion);
				echo "Modification réussie";
			}

			catch(Exception $e)
			{
				echo 'Erreur : '.$e->getMessage();
			}

			break;

			case 'Supprimer':
			try
			{
				suppressionProd($codeProduit, $connexion);
				echo "Suppression réussie";
			}

			catch(Exception $e)
			{
				echo 'Erreur : '.$e->getMessage();
			}

			break;

			case '>':
			try
			{
				if ($_SESSION['numProd'] < $_SESSION['nbrProdMax'])
				{
					$i = $_SESSION['numProd'] = $_SESSION['numProd'] + 1;
				}

				else
				{
					$i = $_SESSION['numProd'] = 0;
				}

				recupProd($liste,$i);
			}

			catch(Exception $e)
			{
				echo 'Erreur : '.$e->getMessage();
			}
				
			break;

			case '>>':
			try
			{
				$_SESSION['numProd'] = $_SESSION['nbrProdMax'];
				$i = $_SESSION['numProd'];
				recupProd($liste,$i);
				echo "Déplacement vers la catégorie n°";
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
		$liste = listeProd($connexion);
		$i = 0;
		recupProd($liste,$i);
		$_SESSION['numProd'] = $i;
	}
?>

<form name="saisie" method="post" action="./index.php?page=interProd" 
onSubmit="return verifSaisie(this);"> <!-- fonction javascript pour vérifier la saisie -->
<!-- on utilise un tableau pour aligner les libellés et les champs -->
</br></br>
<table>
	<caption>Modifier les produits</caption>

	<tr>
		<td>Numéro du produit</td>
		<td><input type="text" name="codeProduit" value="
	<?php 
	 if(!empty($_POST['codeProduit']) && is_numeric($_POST['codeProduit'])) { 
		echo htmlspecialchars($_POST['codeProduit'], ENT_QUOTES);
	 }
	?>
	"/></td>
	<td rowspan="5"><img src="IMAGES\
	<?php
		echo $_POST['photo']
		?>
		" alt="<?php echo $_POST['photo']; ?>" title="<?php echo $_POST['libelleProduit']; ?>"/></td>
	</tr>

	<tr>
		<td>Nom du produit</td>
		<td><input type="text" name="libelleProduit" value="
	<?php 
	 if(!empty($_POST['libelleProduit'])) { 
		echo htmlspecialchars($_POST['libelleProduit'], ENT_QUOTES);
	 }
	?>
	"/></td>
	</tr>

	<tr>
		<td>Composition du produit</td>
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
	"/><input type="file" name="photo" value="Parcourir"><input type="hidden" name="MAX_FILE_SIZE" value="10000" /></td>
	</tr>

	<tr>
		<td>Numéro de catégorie du produit</td>
		<td><input type="text" name="codeTypeProduit" value="
	<?php 
	 if(!empty($_POST['codeTypeProduit'])) { 
		echo htmlspecialchars($_POST['codeTypeProduit'], ENT_QUOTES);
	 }
	?>
	"/></td>
	</tr>
	<!-- ajouter les autres champs ………..-->
</table>
<br/>
<!--  boutons  -->
<input type="submit" name="valider" value="<<"/>	
<input type="submit" name="valider" value="<"/>	
<input type="submit" name="valider" value="Ajouter"/>
<input type="submit" name="valider" value="Mettre à jour"/>
<input type="submit" name="valider" value="Supprimer"/>
<input type="submit" name="valider" value=">"/>	
<input type="submit" name="valider" value=">>"/>
</form>

<div>
	<?php
	// faire une requête pour obtenir le jeu d'enregistrements de la table typeproduit
		$requete = "select * from produit order by codeProduit asc;";
		$jeu = $connexion->query($requete);
		$jeu->setFetchMode(PDO::FETCH_OBJ);
		$ligne = $jeu->fetch();
	?>

	<table>
		<caption>Etat actuel de la base de données</caption>
	   <thead> <!-- En-tête du tableau -->
	       <tr>
	       		<th>Code du produit</th>
	 			<th>Nom du produit</th>
	 			<th>Composition</th>
	 			<th>Catégorie</th>
			</tr>
		</thead>
	  
		<tbody> <!-- Corps du tableau -->
			<?php
				// traiter chaque ligne du jeu d'enregistrements pour l'afficher dans le tableau
				while ($ligne)
				{
					 $numProduit = $ligne->codeProduit;
					 $nomProduit = $ligne->libelleProduit;
					 $compo = $ligne->composition;
					 $numCateg = $ligne->codeTypeProduit;
			
			?>

				<tr>
					<td><?php echo $numProduit;?></td>
					<td><?php echo $nomProduit;?></td>
					<td><?php echo $compo;?></td>
					<td><?php echo $numCateg;?></td>
				</tr>

			<?php
					$ligne=$jeu->fetch();
				}
			?>
		</tbody>
	</table>


</div>

<div>
	<?php
	// faire une requête pour obtenir le jeu d'enregistrements de la table typeproduit
		$requete = "select * from typeproduit order by codeTypeProduit asc;";
		$jeu = $connexion->query($requete);
		$jeu->setFetchMode(PDO::FETCH_OBJ);
		$ligne = $jeu->fetch();
	?>

	<table>
		<caption>Table des catégories</caption>
	   <thead> <!-- En-tête du tableau -->
	       <tr>
	       		<th>Numéro de la catégorie</th>
	 			<th>Nom de la catégorie</th>
			</tr>
		</thead>
	  
		<tbody> <!-- Corps du tableau -->
			<?php
				// traiter chaque ligne du jeu d'enregistrements pour l'afficher dans le tableau
				while ($ligne)
				{
					$numCateg = $ligne->codeTypeProduit;
				 	$nomCateg = $ligne->libelleTypeProduit;
			
			?>

				<tr>
					<td><?php echo $numCateg;?></td>
					<td><?php echo $nomCateg;?></td>
				</tr>

			<?php
					$ligne=$jeu->fetch();
				}
			?>
		</tbody>
	</table>
</div>