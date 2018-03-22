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
	<li><a href="index.php?page=commander">Clients</a></li>
	<li><a href="index.php?page=contact">Nous contacter</a></li>
	<li><a href="VUES/panier.php?action=ajout&amp;l=LIBELLEPRODUIT&amp;q=QUANTITEPRODUIT&amp;p=PRIXPRODUIT" onclick="window.open(this.href, '', 
'toolbar=no, location=no, directories=no, status=yes, scrollbars=yes, resizable=yes, copyhistory=no, width=600, height=350'); return false;">Mon Panier</a></li>
	
</ul>
