<?php
$titrePage = "Connexion";
$style = "../../css/style.css";
include("../includes/header.php");
?>
<?php
/*Etablissement de la connexion avec la BD*/
include("../includes/fonctions.php");
$connect = connexionBD();
$stat=pg_connection_status($connect);
 
/*Si le formulaire a été rempli*/
if(isset($_POST['mailconnect']) AND !empty($_POST['mailconnect']))
{
    /*Récupération de l'identifiant et du mot de passe saisi dans le formulaire*/
    $mailconnect= $_POST['mailconnect'];
    $mdpconnect= $_POST['mdpconnect'];
    
    /*Récupération du mot de passe correspondant à l'identifiant saisi dans le formulaire*/
    $query= "SELECT mailU, mdpU FROM Utilisateurs WHERE mailU='".$mailconnect."'";
    $result=pg_query($connect,$query);
    /*Stockage de l'identifiant et du mot de passe récupérés dans la base de données*/
    $row=pg_fetch_row($result);
    
    /*Si l'identifiant n'existe pas dans la BD*/
    if($row[0] != $mailconnect){
        echo 'Login incorrect';
	}
	/*Si l'identifiant existe dans la BD mais que le mot de passe ne correspond pas à celui-ci*/
	elseif($row[1]!= md5($mdpconnect)){
		echo 'Mot de passe incorrect';
	}
	/*Si l'identifiant existe dans la BD et le mot de passe associé aussi*/
	else{
		/*Ouverture d'une session pour se connecter*/
		session_start();
		echo 'Login et mot de passe corrects';
		/*Création d'une variable de session afin de récupérer l'identifiant de la personne connectée sur les autre pages de la Plateforme*/
		$_SESSION['mailU'] = $mailconnect;
		echo $_SESSION['mailU'];
		
		/*Redirection vers la page Profil de la plateforme*/
		header("Location: profil.php");
	}
}
?>

    <main>
        <section id="connexion">
            <h1>Connexion</h1>
            <form name="connexion" method="post" action="" id="formulaireConnexion">
                <table>
                    <tr>
                        <td><label for="">Identifiant:</label></td>
                        <td><input type="mail" name="mailconnect" id="mailconnect" placeholder="votre mail" required></td>
                    </tr>
                    <tr>
                        <td><label for="">Mot de passe:</label></td>
                        <td><input type="password" name="mdpconnect" id="mdpconnect" placeholder="votre mot de passe" required></td>
                    </tr>
                    <tr>
                        <td><label  style="color:black"><b>Se connecter :  </b></label></td>
                        <td><input required type="submit" class="form-control" name="connexion"  value="Valider"></td>
                    </tr>
                </table>
                <a href="inscription.php" class="lien_inscription">Si vous n'avez pas de compte cliquer ici</a>
            </form>
        </section>
    </main>
		 
<?php
include("../includes/footer.php");
?>