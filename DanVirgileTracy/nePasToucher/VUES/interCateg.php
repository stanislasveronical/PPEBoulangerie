<?php
	$choice = ' ';
	
	if(isset($_POST['valider']))
	{
		$choice = $_POST['valider'];

		if(isset($_POST['codeTypeProduit']))
		{
			$codeTypeProduit = $_POST['codeTypeProduit'];
		}

		else
		{
			$codeTypeProduit = '';
		}

		if(isset($_POST['libelleTypeProduit']))
		{
			$libelleTypeProduit = $_POST['libelleTypeProduit'];
		}

		else
		{
			$libelleTypeProduit = '';
		}

		$liste = listeCateg($connexion);

		switch ($choice)
		{
			case '<<':
			try
			{
				$i = $_SESSION['numCateg'] = 0;
				$c = $i + 1;
				recupCateg($liste,$i);
				echo "Déplacement vers la catégorie n°".$c;
			}

			catch(Exception $e)
			{
				echo 'Erreur : '.$e->getMessage();
			}
				
			break;

			case '<':
			try
			{
				if ($_SESSION['numCateg'] > 0)
				{
					$i = $_SESSION['numCateg'] = $_SESSION['numCateg'] - 1;
				}

				else
				{
					$i = $_SESSION['numCateg'] = $_SESSION['nbrCategMax'];
				}

				recupCateg($liste,$i);
			}

			catch(Exception $e)
			{
				echo 'Erreur : '.$e->getMessage();
			}
				
			break;

			case 'Ajouter':
			try
			{
				insertionCateg($libelleTypeProduit,$connexion);
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
				modificationCateg($codeTypeProduit,$libelleTypeProduit,$connexion);
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
				suppressionCateg($codeTypeProduit, $connexion);
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
				if ($_SESSION['numCateg'] < $_SESSION['nbrCategMax'])
				{
					$i = $_SESSION['numCateg'] = $_SESSION['numCateg'] + 1;
				}

				else
				{
					$i = $_SESSION['numCateg'] = 0;
				}

				recupCateg($liste,$i);
			}

			catch(Exception $e)
			{
				echo 'Erreur : '.$e->getMessage();
			}
				
			break;

			case '>>':
			try
			{
				$_SESSION['numCateg'] = $_SESSION['nbrCategMax'];
				$i = $_SESSION['numCateg'];
				#echo $_SESSION['numEleve'];
				recupCateg($liste,$i);
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
		$liste = listeCateg($connexion);
		$i = 0;
		recupCateg($liste,$i);
		$_SESSION['numCateg'] = $i;
		#echo $i;
	}
?>

<form name="saisie" method="post" action="./index.php?page=interCateg" 
onSubmit="return verifSaisie(this);"> <!-- fonction javascript pour vérifier la saisie -->
<!-- on utilise un tableau pour aligner les libellés et les champs -->
</br></br>
<table>
<caption>Modifier les catégories de produit</caption>
<tr>
	<td>Numéro de la catégorie</td>
	<td><input type="text" name="codeTypeProduit" value="
<?php 
 if(!empty($_POST['codeTypeProduit']) && is_numeric($_POST['codeTypeProduit'])) { 
	echo htmlspecialchars($_POST['codeTypeProduit'], ENT_QUOTES);
 }
?>
"/></td>
</tr>

<tr>
	<td>Nom de la catégorie</td>
	<td><input type="text" name="libelleTypeProduit" value="
<?php 
 if(!empty($_POST['libelleTypeProduit'])) { 
	echo htmlspecialchars($_POST['libelleTypeProduit'], ENT_QUOTES);
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

<?php
// faire une requête pour obtenir le jeu d'enregistrements de la table typeproduit
	$requete = "select * from typeproduit order by codeTypeProduit asc;";
	$jeu = $connexion->query($requete);
	$jeu->setFetchMode(PDO::FETCH_OBJ);
	$ligne = $jeu->fetch();
?>

<table>
	<caption>Etat actuel de la base de données</caption>
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