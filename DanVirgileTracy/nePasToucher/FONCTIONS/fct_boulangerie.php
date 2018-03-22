<?php
// fonction de connexion à la base de données
function connexionMysqlBdd($hote, $port, $bd, $util, $mpas){
		$PARAM_hote=$hote; // le chemin vers le serveur
		$PARAM_port=$port;
		$PARAM_nom_bd=$bd; // le nom de votre base de données
		$PARAM_utilisateur=$util; // nom d'utilisateur pour se connecter
		$PARAM_mot_passe=$mpas; // mot de passe de l'utilisateur pour se connecter
		try
		{ 
			$connexion = new PDO('mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
		}  
		
		catch(Exception $e)
		{
			echo 'Erreur : '.$e->getMessage(); 
?>
<br />
<?php			
			echo 'N° : '.$e->getCode();
		}
		
		return $connexion;
	}
	
function InsertionCommande($nom, $prenom, $adresse, $cp, $ville, $mail, $portable, $quantite, $connexion){
	$requete_prepare_insert = $connexion-> prepare ("INSERT INTO commander (nom,
					prenom,
					adresse,
					cp,
					ville,
					mail,
					portable,
					quantite
					) VALUES (:nom,
					:prenom,
					:adresse,
					:cp,
					:ville,
					:mail,
					:portable,
					:quantite);");
$requete_prepare_insert -> execute(array(
':nom' => $nom,
':prenom' =>  $prenom,
':adresse' =>  $adresse,
':cp' => $cp,
':ville' => $ville,
':mail' => $mail,
':quantite' => $quantite,
':portable' => $portable));
}


function insertionCateg($libelleTypeProduit,$connexion)
{
	$requete_prep =
	$connexion->prepare("insert into typeproduit (libelleTypeProduit) values(:libelleTypeProduit)"); 
// on prépare notre requête
	$requete_prep->execute(array(':libelleTypeProduit' => $libelleTypeProduit));
}

// fonction pour modifier une occurrence dans la table typeproduit
function modificationCateg($codeTypeProduit,$libelleTypeProduit,$connexion)
{
	$requete_prep =
	$connexion->prepare("update typeproduit set codeTypeProduit = :codeTypeProduit, libelleTypeProduit = :libelleTypeProduit where codeTypeProduit = :codeTypeProduit");
	
	$requete_prep->execute(array( ':codeTypeProduit' => $_POST['codeTypeProduit'], ':libelleTypeProduit' => $_POST['libelleTypeProduit']));
}

// fonction pour supprimer une occurrence dans la table typeproduit
function suppressionCateg($codeTypeProduit, $connexion)
{
	$requete_prep =
	$connexion->prepare("delete from typeproduit where codeTypeProduit = :codeTypeProduit");
	
	$requete_prep->execute(array('codeTypeProduit' => $_POST['codeTypeProduit'] ));
}

function insertionProd($libelleProduit,$composition,$photo,$codeTypeProduit,$connexion)
{
	$requete_prep =
	$connexion->prepare("insert into produit (libelleProduit, composition, photo, codeTypeProduit) values(:libelleTypeProduit, :composition, :photo, :codeTypeProduit)"); 
// on prépare notre requête
	$requete_prep->execute(array(':libelleProduit' => $libelleProduit, ':composition' => $composition, 'photo' => $photo, 'codeTypeProduit' => $codeTypeProduit));
}

// fonction pour modifier une occurrence dans la table produit
function modificationProd($codeProduit,$libelleProduit,$composition,$photo,$codeTypeProduit,$connexion)
{
	$requete_prep =
	$connexion->prepare("update produit set codeProduit = :codeProduit, libelleProduit = :libelleProduit, composition = :composition, photo = :photo, codeTypeProduit = :codeTypeProduit where codeProduit = :codeProduit");
	
	$requete_prep->execute(array( ':codeProduit' => $_POST['codeProduit'], ':libelleProduit' => $_POST['libelleProduit'], ':composition' => $_POST['composition'], ':photo' => $_POST['photo'], ':codeTypeProduit' => $_POST['codeTypeProduit']));
}

// fonction pour supprimer une occurrence dans la table typeproduit
function suppressionProd($codeProduit, $connexion)
{
	$requete_prep =
	$connexion->prepare("delete from produit where codeProduit = :codeProduit");
	
	$requete_prep->execute(array('codeProduit' => $_POST['codeProduit'] ));
}

function recupCateg($liste,$i)
{
	foreach ($liste as $categ)
	{
		$_POST['codeTypeProduit'] = $categ[$i][0];
		$_POST['libelleTypeProduit'] = $categ[$i][1];
	}
}

function listeCateg($connexion)
{

	$requete = "select * from typeproduit order by codeTypeProduit";
	$jeu = $connexion->query($requete);
	$jeu->setFetchMode(PDO::FETCH_OBJ);
	$ligne = $jeu->fetch();;
	$i = 0;
	$liste = array();
	$_SESSION['nbrCategMax'] = -1;

	while ($ligne)
	{
		$codeTypeProduit=$ligne->codeTypeProduit ;
		$codeTypeProduit = $codeTypeProduit;
		$libelleTypeProduit = $ligne->libelleTypeProduit;
			
		$categ = array($codeTypeProduit,$libelleTypeProduit);
		$liste[$i]= $categ;
		$ligne = $jeu->fetch();
		$i = $i+1;
		$_SESSION['nbrCategMax'] = $_SESSION['nbrCategMax'] +1;
	}
		
	return (array($liste));
}

function recupProd($liste,$i)
{
	foreach ($liste as $prod)
	{
		$_POST['codeProduit'] = $prod[$i][0];
		$_POST['libelleProduit'] = $prod[$i][1];
		$_POST['composition'] = $prod[$i][2];
		$_POST['photo'] = $prod[$i][3];
		$_POST['codeTypeProduit'] = $prod[$i][4];
	}
}

function listeProd($connexion)
{

	$requete = "select * from produit order by codeProduit";
	$jeu = $connexion->query($requete);
	$jeu->setFetchMode(PDO::FETCH_OBJ);
	$ligne = $jeu->fetch();;
	$i = 0;
	$liste = array();
	$_SESSION['nbrProdMax'] = -1;

	while ($ligne)
	{
		$codeProduit= $ligne->codeProduit ;
		$codeProduit = $codeProduit;
		$libelleProduit = $ligne->libelleProduit;
		$composition = $ligne->composition;
		$photo = $ligne->photo;
		$codeTypeProduit = $ligne->codeTypeProduit;
			
		$prod = array($codeProduit,$libelleProduit,$composition,$photo,$codeTypeProduit);
		$liste[$i]= $prod;
		$ligne = $jeu->fetch();
		$i = $i+1;
		$_SESSION['nbrProdMax'] = $_SESSION['nbrProdMax'] +1;
	}
		
	return (array($liste));
}

//fonctions panier
function creationPanier()
{
	//si le panier n'existe pas, on le crée
   if (!isset($_SESSION['panier']))
   {
      $_SESSION['panier']=array();
      $_SESSION['panier']['libelleProduit'] = array();
      $_SESSION['panier']['qteProduit'] = array();
      $_SESSION['panier']['prixProduit'] = array();
      //permettra de vérouiller toute action sur le panier
      $_SESSION['panier']['verrou'] = false;
   }

   return true;
}

function ajouterArticle($libelleProduit,$qteProduit,$prixProduit)
{
   //si le panier existe
   if (creationPanier() && !isVerrouille())
   {
      //si le produit existe déjà on ajoute seulement la quantité
      $positionProduit = array_search($libelleProduit,  $_SESSION['panier']['libelleProduit']);

      if ($positionProduit !== false)
      {
         $_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit ;
      }

      else
      {
         //sinon on ajoute le produit
         array_push( $_SESSION['panier']['libelleProduit'],$libelleProduit);
         array_push( $_SESSION['panier']['qteProduit'],$qteProduit);
         array_push( $_SESSION['panier']['prixProduit'],$prixProduit);
      }
   }

   else
   {
   		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
   }  
}

function supprimerArticle($libelleProduit)
{
   //si le panier existe
   if (creationPanier() && !isVerrouille())
   {
      //on passe dans un panier temporaire
      $tmp=array();
      $tmp['libelleProduit'] = array();
      $tmp['qteProduit'] = array();
      $tmp['prixProduit'] = array();
      $tmp['verrou'] = $_SESSION['panier']['verrou'];

      for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++)
      {
         if ($_SESSION['panier']['libelleProduit'][$i] !== $libelleProduit)
         {
            array_push( $tmp['libelleProduit'],$_SESSION['panier']['libelleProduit'][$i]);
            array_push( $tmp['qteProduit'],$_SESSION['panier']['qteProduit'][$i]);
            array_push( $tmp['prixProduit'],$_SESSION['panier']['prixProduit'][$i]);
         }

      }
      //on remplace le panier en session par le panier temporaire à jour
      $_SESSION['panier'] =  $tmp;
      //on efface le panier temporaire
      unset($tmp);
   }

   else
   {
   		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
   }
}

function modifierQTeArticle($libelleProduit,$qteProduit)
{
   //si le panier existe
   if (creationPanier() && !isVerrouille())
   {
      //si la quantité est positive, on modifie, sinon on supprime l'article
      if ($qteProduit > 0)
      {
         //recherche du produit dans le panier
         $positionProduit = array_search($libelleProduit,  $_SESSION['panier']['libelleProduit']);

         if ($positionProduit !== false)
         {
            $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit ;
         }
      }

      //une quantité négative ou nulle revient à suprimmer l'article
      else
      {
      		supprimerArticle($libelleProduit);
      }
   }

   else
   {
   		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
   }
}

function MontantGlobal()
{
   $total=0;

   for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++)
   {
      $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
   }
   
   return $total;
}

//fonctions inscription,connexion,deconnexion
function codageMDP($password)
{
	//premier caractère majuscule
	$maj = ucfirst($password);

	//mot inversé
	$inv = strrev($maj);

	//remplacement d'un caractère par un autre
	$rep = strtr($inv, 'e', 'r');

	//codage en ROT13
	$rot = str_rot13($rep);

	//hachage
	$hash = hash('sha256', $rot);

	return $hash;
}



?>

