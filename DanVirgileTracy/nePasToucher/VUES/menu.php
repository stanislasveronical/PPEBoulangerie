<ul id = "menuProduit">
	<li><a href="index.php?page=accueil">Accueil</a></li>
	<li><a href="index.php?page=produit">Nos Produits</a>
		<ul>
			<?php
				$requete = "select * from typeproduit;";
				$jeu = $connexion->query($requete);
				$jeu->setFetchMode(PDO::FETCH_OBJ);
				$ligne = $jeu->fetch();
				while ($ligne)  {
			?>
			<li><a href="index.php?page=categories&numero=<?php echo $ligne->codeTypeProduit; ?>">

    		<?php   echo $ligne->libelleTypeProduit;  ?>

			</a></li>	
			<?php

				$ligne = $jeu->fetch();
				}
			?>
		</ul>
	<li><a href="index.php?page=commander">Mon Panier</a></li>
	<li><a href="index.php?page=contact">Nous contacter</a></li>
	
</ul>
