 <?php
	$titrePage = "Mise à jour du profil";
	$style = "../../css/style.css";
	include("../includes/header.php");

	session_start();

	include("../includes/fonctions.php");
    $connect = connexionBD();
	$stat=pg_connection_status($connect);
    
	$mailconnect = $_SESSION['mailU'];
	$query="SELECT * FROM utilisateurs WHERE mailU = '$mailconnect'";
	$result=pg_query($connect, $query);
	$row=pg_fetch_array($result);
	
?>
	<main>
        <section>
				<form method = "post" action = "info_profil_modifier.php">
					<table>
                        <tr>
                            <td><label for="number">Telephone:</label></td>
                            <td><input type="tel"pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" name="tel" id="tel" maxlength="10" placeholder="votre numero de telephone"  value="<?php if(isset($tel)) { echo $tel; } ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="">Ville:</label></td>
                            <td><input type="text" name="ville" id="ville" placeholder="votre ville "  value="<?php if(isset($ville)) { echo $ville; } ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="">Profession:</label> </td>
                            <td><input type="text" name="profs" id="profs" placeholder="votre profession "  value="<?php if(isset($profs)) { echo $profs; } ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="pays">Domaine d'activite:</label></td>
                            <td>
                                <select name="dda" id="dda" value="<?php if(isset($dda)) { echo $dda; } ?>">
                                    <option disabled selected>Liste des domaines</option>
                                    <?php
                                    $enum = getEnum($connect, 'Domaine');
                                    foreach($enum as $value){
                                        echo '<option value="'.$value.'">'.domaine($value).'</option>\n';
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="">Entreprise:</label> </td>
                            <td><input type="text" name="etps" id="etps" placeholder="votre entreprise "  value="<?php if(isset($etps)) { echo $etps; } ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="">Diplome:</label></td>
                            <td>
                                <select name = "diplome" id = "diplome" value="<?php if(isset($dpl)) { echo $dpl; } ?>">
                                    <option disabled selected>Liste des diplomes</option>
					                <?php
                                    $enum = getEnum($connect, 'Diplome');
                                    foreach($enum as $value){
                                        echo '<option value="'.$value.'">'.diplome($value).'</option>\n';
                                    }
                                    ?>
					            </select>
                            </td>
                        </tr>
                        <tr><td><input type = "submit" value = "OK" name = "formprofil"/></td></tr>
                    </table>
				</form>
		</section>
	</main>
	

<?php
	include("../includes/footer.php");
?>
