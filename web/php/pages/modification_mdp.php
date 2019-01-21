<!doctype html>


<?php
$titrePage = "Mise à jour du profil";
$style = "../../css/style.css";
include("../includes/header.php");
?>

<?php
    include("../includes/fonctions.php");
    $connect = connexionBD();
    $stat=pg_connection_status($connect);
    
    $mailconnect = $_SESSION['mailU'];
	$query="SELECT * FROM utilisateurs WHERE mailU = '$mailconnect'";
	$result=pg_query($connect, $query);
	$utilisateur=pg_fetch_row($result);
  
?>
	<main>
        <section>
 		<h1>Modifier mot de passe</h1>
			<form method = "post" action = "">
				<table>
				<tr><td><label>Ancien mot de passe</label> <td><input type = "password" name = "mdpAn" id="mdpAn" required value="<?php if(isset($mdpAn)) { echo $mdpAn; } ?>" ><tr>
				<tr><td><label>Nouveau mot de passe</label> <td><input type = "password" name = "mdpNou" id="mdpNou" required value="<?php if(isset($mdpNou)) { echo $mdpNou; } ?>"><tr>
				<tr><td><label>Confirmer mot de passe</label> <td><input type = "password" name = "mdpC" id="mdpC" required value="<?php if(isset($mdpC)) { echo $mdpC; } ?>"><tr>
				<tr><td><td><input type = "submit" value = "OK" name="modification"><tr>
				</table>
			</form>
		</section>
	</main>
	<?php
	if(isset($_POST['modification'])) {
	 $mdpAn = $_POST['mdpAn'];
	 $mdpNou = $_POST['mdpNou'];
	 $mdpC = $_POST['mdpC'];
	 if(!empty($_POST['mdpAn']) AND !empty($_POST['mdpNou']) AND !empty($_POST['mdpC']))
	 {

	 	if($mdpNou===$mdpC){

	 		 $sql="UPDATE utilisateurs SET mdpu='$mdpNou' where mailu='$mailconnect'";
              $result1=pg_query($connect, $sql);
              $_SESSION['mdpU'] = $mdpNou;
                header("Location: profil.php");
        }
          else{
          	echo  ("<script type='text/javascript'>alert('votre mot de passe est incorrect')</script>"); 

              } 

     } 

       else{
           echo  ("<script type='text/javascript'>alert('Tous les champs doivent être complétés !')</script>");
       }

}


	


	?>
<?php
	include("../includes/footer.php");
?>