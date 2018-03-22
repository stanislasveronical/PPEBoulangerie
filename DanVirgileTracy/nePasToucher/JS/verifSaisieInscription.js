function verifSaisieInscription(monForm)
{
	var pseudo = monForm.pseudo.value;
	var password = monForm.password.value;
	var répétition = monForm.répétition.value;
	var mail = monForm.mail.value;

	var okSaisie = false;

	if (pseudo != "" && password != "" && répétition != "" && mail != "")
	{
		okSaisie = true;
	}

	else
	{
		document.getElementById("msgErreur").style.color = "red";
		document.getElementById("msgErreur").innerHTML = "Veuillez remplir correctement les champs";
	}


}

// Vérification de la validité des informations
		/*$okPseudo = false;
		$okPass = false;
		$okMail = false;

		//le pseudo existe-t-il déjà ?
		$pseudo = $_POST['pseudo'];
		$requetePseudo = "SELECT COUNT (*) AS NbPseudos FROM membre WHERE pseudo='".$pseudo."'";
		$resultat = $connexion->query($requetePseudo);
		//$jeu->setFetchMode(PDO::FETCH_OBJ);
		//$ligne = $resultat->fetch();

		if($resultat->NbPseudos == 0)
		{
			$okPseudo = true;
		}

		else
		{
			$okPseudo = false;
		}

		//les deux mots de passe sont-ils identiques ?




		// Hachage du mot de passe
		/*$pass_hache = sha1($_POST['password']);


		// Insertion
		$req = $bdd->prepare('INSERT INTO membres(pseudo, pass, email, date_inscription) VALUES(:pseudo, :pass, :email, CURDATE())');

		$req->execute(array(
		    'pseudo' => $pseudo,
		    'pass' => $pass_hache,
		    'email' => $email));*/

