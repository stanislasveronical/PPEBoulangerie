<html>
	<body>
		<?php
			//Message si il y a une erreur
			if(!isset($_GET['numero'])){
				 ?><font size="6"><b>Aucune catégorie n'a été sélectionnée</font> <?php
			}
			else{
				$categ = $_GET['numero'];

				$request = "select libelleTypeProduit from typeProduit where codeTypeProduit = " . $categ . ";";
				$result = $connexion->query($request);
				$result->setFetchMode(PDO::FETCH_OBJ);
				$ligne = $result->fetch();
				echo "<br><br><b><u>".$ligne->libelleTypeProduit."</u></b>";


				$request = "select produit.photo,produit.codeProduit,produit.libelleProduit,declinaison.prix
				from produit,declinaison
				where produit.codeProduit=declinaison.codeProduit
				and produit.codeTypeProduit = " . $categ . ";";
			$result = $connexion->query($request);
			$result->setFetchMode(PDO::FETCH_OBJ);
			$ligne = $result->fetch();
			


			?>
			<br><br><br>
			<?php

			$increment=1;
			while($ligne)
			{
				$bddlibelle=$ligne->libelleProduit;
				$bddphoto=$ligne->photo;
				$bddprix=$ligne->prix;
				if($increment%2!=0)
				{
				?>
					<table>
					<tr>
				<?php
				}
			?>
					<section id="produit">
						<section id="nomP">

					
						<td>
							<?php echo $bddlibelle; ?>
						</td>
						</section>
						<section id="photoP">
						<td>
							

						<?php
							
							if (file_exists('./IMAGES/'.$bddphoto))
							{
						?>
								<img src='./IMAGES/<?php echo $bddphoto; ?>' width="345" height="259px">
								<input type='submit' name='valider' value='Ajouter au panier' onclick="return creationPanier();"/>
						<?php
						
							}
							else
							{
						?>
								<img src='./IMAGES/notfound.jpg' width="345" height="259px">
						<?php
							}
						?>

						</td>
						</section>
																		
						<section id="prixP">
						<td>
							<?php echo $bddprix." €"; ?>
						</td>
						</section>
						
					</section>
					<?php
						if($increment%2==0)
						{
					?>
						</tr>
						</table>
					<?php
						}
						else
						{
						?>
						
						<?php
						}
					?>

				
				<br><br>
			<?php
				$ligne = $result->fetch();
				$increment+=1;
			}
			?>
			
			<?php
	
		}
		?>
		
	</body>
</html>
			
			