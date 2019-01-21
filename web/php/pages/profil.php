<?php
session_start();
include("../includes/fonctions.php");
if(!isset($_SESSION['mailU'])){
    //header("Location: inscription.php");
}
?>

<?php
$titrePage = "Profil";
$style = "../../css/style.css";
include("../includes/header.php");
	
    $connect = connexionBD();
	$stat=pg_connection_status($connect);
	$mailconnect = $_SESSION['mailU'];
	$query="SELECT * FROM utilisateurs WHERE mailU = '$mailconnect'";
	$result=pg_query($connect, $query);
	$utilisateur=pg_fetch_array($result);
	pg_close($connect);
?>
    <main>
        <section class="profil">
        	<h1>Mes coordonnées</h1>
        	<div id="Coordonnees">
              	  <?php
                		 echo "Nom : ".$utilisateur['nomu']."<br>";
               			 echo "Prenom : ".$utilisateur['prenomu']."<br>";
           				 echo "Email : ".$utilisateur['mailu']."<br>";
             	   ?>
                <a href="modification_mdp.php">Pour modifier votre mot de passe</a>
            </div>
			
			<h1>Informations complémentaires</h1>
			<div id="infos_comp">
              	  <?php
              	  if ($utilisateur['telu'] != null) echo "\tTéléphone : ".$utilisateur['telu']."<br>\n";
              	  if ($utilisateur['villeu'] != null) echo "\tVille : ".$utilisateur['villeu']."<br>\n";
              	  if ($utilisateur['professionu'] != null) echo "\tProfession : ".$utilisateur['professionu']."<br>\n";
              	  if ($utilisateur['domaineu'] != null) domaine($utilisateur['domaineu']);
              	  if ($utilisateur['entrepriseu'] != null) echo "\tEntreprise : ".$utilisateur['entrepriseu']."<br>\n";
              	  if ($utilisateur['diplomeu'] != null) echo "\tDiplôme : ".$utilisateur['diplomeu']."<br>\n";
             	   ?>
                <a href="infos_profil.php">Pour mettre à jour les informations de votre profil</a>
            </div>
          	
			<h1>Liste des groupes</h1>
			<table id="liste_groupes">
			<?php
			    $connect = connexionBD();
			    $query="SELECT nomG, g.idG
			    FROM groupes_projets g
			    INNER JOIN faire_partie f ON g.idG = f.idG
			    INNER JOIN utilisateurs u ON f.mailU = u.mailU
			    WHERE u.mailU = '$mailconnect';";

			    $result = pg_query($connect, $query);
				$i = 1;
				while($row = pg_fetch_array($result)){
				    echo "<tr>\n";
					echo "\t<td>Groupe n°$i : ".$row['nomg']."</td>\n";
					echo "\t<td><a href=\"groupe_prive.php?idg=".$row['idg']."\"><button>Accéder</button></a></td>\n";
					echo "</tr>\n";
					$i++;
				}
			?>
			</table>
			<td><a href="./creation_groupe.php"><button>Créer un groupe</button></a></td>
			<br></br>
			<h1>Liste de mes tâches</h1>
			<table id="liste_taches">
			    <tr>
                    <th>Tâche</th>
                    <th>Etat</th>
                </tr>
			    <?php
			    $connect = connexionBD();
			    $query="SELECT descriptionT, datet
			    FROM taches t
			    INNER JOIN Ajouter_taches a ON t.idT=a.idT
			    INNER JOIN utilisateurs u ON u.mailU=a.mailU
			    WHERE u.mailU='$mailconnect'
			    ORDER BY datet;";

			    $result=pg_query($connect, $query);
			    $i = 1;
				while($row = pg_fetch_array($result)){
				    echo "<tr>\n";
					echo "\t<td>Tâche n°$i : ".$row['descriptiont']."</td>\n";
					$date_system = date("Y-m-d");
					if($row['datet']>$date_system)
						echo "\t<td>Délai : ".$row['datet']."</td>\n";
					else
						echo"\t<td>Effectuée</td>\n";
					echo "</tr>\n";
					$i++;
				}
			    ?>
			</table>
        </section>
    </main>
<?php
include("../includes/footer.php");
?>