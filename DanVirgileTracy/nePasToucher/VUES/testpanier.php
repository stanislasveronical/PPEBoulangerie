<?php
session_start();
include("index.php"); //fichier de connexion à la base de données

//recupération des données
$codeProduit = $_POST['codeProduit'];
$quantite = $_POST['quantite'];

//si le panier est vide====================================>
if (empty($_SESSION['boulangerie2']))
  {

  //On construit notre panier avec l'id de l'article choisi et la quantité
  $_SESSION['commander'][$id]=$qte;

  //requete sur la table avec un seul id

  $requete = mysql_query("SELECT * FROM commander WHERE id = '$id'");
  }

//Il faudra ensuite mettre en forme (tableau html) le résultat de cette requête

//si panier déjà rempli===================================>
else
  {
    //suppression d'un article (on a cliqué sur un bouton supprimer)
    if(isset($_POST['supprimer']))
    {
    unset($_SESSION['commander'][$codeProduit]);

    //requete si le panier n'est toujours pas vide malgré la suppression

    if(!empty($_SESSION['commander']))
      {
      // on "extrait" les id du panier
      $id_liste=implode(',',array_keys($_SESSION['commander']));
      $requete = mysql_query("SELECT * FROM table WHERE codeProduit IN ($id_liste)");
      }

    }

    else
    {
    //Ajout d'un nouvel id et une nouvelle quantité ou modification de la quantité d'un article
    $_SESSION['commander'][$codeProduit] = $quantite;

    // on "extrait" les id du panier

    $id_liste=implode(',',array_keys($_SESSION['commander']));

    //requete sur la table avec tous les id présents dans $id_liste

    $requete = mysql_query("SELECT * FROM commander WHERE codeProduit IN ($id_liste)");
    }
  }

//Il faudra ensuite mettre en forme avec une boucle et un tableau html le résultat de cette requête

?>