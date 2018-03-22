<?php
	session_start();
?>

<!DOCTYPE html>
	<html>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title>Les Caprices d'Elisa</title>
			<link href="CSS/style.css" rel="stylesheet" type="text/css"/>
		</head>

		<body>

			<?php
				require_once("FONCTIONS/fct_boulangerie.php");

				$PARAM_hote='apache2sio1'; // le chemin vers le serveur
				$PARAM_port='3306';
				$PARAM_nom_bd='boulangerie3'; // le nom de votre base de données
				$PARAM_utilisateur='root'; // nom d'utilisateur pour se connecter
				$PARAM_mot_passe=''; // mot de passe de l'utilisateur pour se connecter
				$connexion =connexionMysqlBdd($PARAM_hote, $PARAM_port, 
				$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
			?>

			<header>
				<figure>
					<center>
						<a href="index.php"><img src = "IMAGES/logo.jpg" alt = "Logo de la boulangerie" title = "Magnifique logo"/></a>
					</center>
				</figure>
			</header>

			<header>
				<center>
					<div id="conteneur">
						<nav id= "navigation">	
							<?php include("VUES/menu.php"); ?>
						</nav>
						<div id="page">
						<?php 
							if (isset($_GET['page']))
							{
								$page = $_GET['page'];
							}

							else
							{
								$page = "accueil"; 
							}
							//echo $page;
							switch ($page) {
								case "accueil" : 
									include ("VUES/accueil.php");
									break;

								case "categories"  :
									include ("VUES/produits.php");
									break;
								case "pains"  :
									include ("VUES/pains.php");
									break;
								case "viennoiseries"  :
									include ("VUES/viennoiseries.php");
									break;
								case "commander"  :
									include ("VUES/commandes.php");
									break;
								case "contact"  :
									include ("VUES/contact.php");
									break;
								case "envoi"  :
									include ("VUES/envoi.php");
									break;
								case "administration"  :
									include ("VUES/administration.php");
									break;
								case "interCateg"	:
									include ("VUES/interCateg.php");
									break;
								case "interProd"	:
									include ("VUES/interProd.php");
									break;

								case "mentionsLegales":
									include("VUES/mentionsLegales.php");
									break;
								case "plan":
									include("VUES/plan.php");
									break;

								case "ConfirmationCommande" :
									include ("VUES/erreur.php");
									break;
									
								case "creationEtiquette":
									include("VUES/creationEtiquette.php");
									break;

								case "inscription":
									include("VUES/inscription.php");
									break;	

								case "mdpadmin":
									include("VUES/mdpadmin.php");
									break;									
								default :
									include ("VUES/accueil.php");
									break;  
							}
						?>
						</div>
					</div>
				</center>
			</header>
		</body>

		<footer>
			<center>
				<br/><br/>
				<br/><br/>
				<ul id="menuProduit"><li><a href="index.php?page=mdpadmin">Reservé à l'administrateur</a><li></ul>
				</br>
				<ul id = "menuProduit"><li><a href="index.php?page=mentionsLegales">Mentions légales</a><li></ul>
				</ul>
			</center>
		</footer>
	</html>
