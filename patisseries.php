			<?php
				//Message si il y a une erreur
				if(isset($_POST['ok'])){$categ=$_POST['ok'];}else{echo "NOPE";}
				$hote="172.16.0.28";
				$port="3306";
				$nomBDD="boulangerie2";
				$utilisateur="root";
				$mdp="";
				$conn=new PDO('mysql:host='.$hote.';dbname='.$nomBDD,$utilisateur,$mdp);
				
				//Modifier la requete si nom du fichier !=patisseries.php pour selectionner where codeTypeProduit=(select....)
				//$request = "select libelleProduit from Produit where codeTypeProduit=$categ;";
				$request = "select libelleProduit from Produit where codeTypeProduit=$categ;";
				$result = $conn->query($request);
				$result->setFetchMode(PDO::FETCH_OBJ);
				$ligne = $result->fetch();
				$decalage=0;
				while($ligne)
				{
					$bddlibelle=$ligne->libelleProduit;
					$decalage+=100;
					?>
					<div style="text-align: center; float: left; padding:95px; width: 259px;">
					<img src=<?php echo "IMAGES/".$bddlibelle.".jpg"; ?> width="345" height="259px" style="left:<?php echo $decalage?>px;">
					<?php echo $bddlibelle; ?>
					</div>
				<?php
					$ligne = $result->fetch();
				}
				?>
			
			
			

			
			

