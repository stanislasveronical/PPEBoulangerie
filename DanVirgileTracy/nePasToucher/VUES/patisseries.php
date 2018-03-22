<!DOCTYPE html>
	<html>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title>Les Caprices d'Elisa</title>
			<link href="CSS/style.css" rel="stylesheet" type="text/css"/>
		</head>
			
		<body>
			<?php
				//Message si il y a une erreur
				if(isset($_GET['numero'])){$categ=$_GET['numero']; echo "---".$categ."---";}else{echo "---".$_GET['numero']."---";}
				$hote="172.16.0.28";
				$port="3306";
				$nomBDD="boulangerie2";
				$utilisateur="root";
				$mdp="";
				$conn=new PDO('mysql:host='.$hote.';dbname='.$nomBDD,$utilisateur,$mdp);
				
				//Modifier la requete si nom du fichier !=patisseries.php pour selectionner where codeTypeProduit=(select....)
				//$request = "select libelleProduit from Produit where codeTypeProduit=$categ;";
				$request = "select libelleProduit from Produit where codeTypeProduit=$categ";
				$result = $conn->query($request);
				$result->setFetchMode(PDO::FETCH_OBJ);
				$ligne = $result->fetch();
				$decalage=0;
				
				while($ligne)
				{
					echo $bddlibelle;
					$bddlibelle=$ligne->libelleProduit;
					
			?>
			<!--
			<table>
				<tr>
					
					
					<div style="position:relative; height:<?php echo $bddlibelle; ?>px;">
					<img src=<?php echo $bddlibelle.".jpg"; ?>
					   style="position:absolute; top:-10px; left:<?php echo $decalage?>px; width:400px; height:300px; border:none;"/>
					   
					   <p><td><?php echo $bddlibelle; ?></td></p>
					   
					</div>
					

					<?php $decalage+=100;?>

   
				</tr>
			</table>
			-->
	
					<div style="text-align: center; float: left; width: 259px;">
					<!--   <img src='./IMAGES/'<?php echo $bddlibelle.".jpg"; ?> width="345" height="259px">   -->
					
					<img src=<?php echo $bddlibelle; ?> width="345" height="259px">
					<?php echo $bddlibelle; ?>
					</div>

				
			
			<?php
					$ligne = $result->fetch();
				}
			?>
			
			</body>
		</html>
			
			

			
			

