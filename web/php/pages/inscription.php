<?php
$titrePage = "Inscription";
$style = "../../css/style.css";
include("../includes/header.php");
?>

<?php
include("../includes/fonctions.php");
$connect = connexionBD();
$stat=pg_connection_status($connect);

if(isset($_POST['forminscription'])) {
    
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $mail = htmlspecialchars($_POST['mail']);
    $mdp = md5(htmlspecialchars($_POST['mdp']));
    $mdpC = md5(htmlspecialchars($_POST['mdpC']));
    $tel = htmlspecialchars($_POST['tel']);
    $ville = htmlspecialchars($_POST['ville']);
    $profs = htmlspecialchars($_POST['profs']);
    $dda = htmlspecialchars($_POST['dda']);
    $etps = htmlspecialchars($_POST['etps']);
    $dpl = htmlspecialchars($_POST['dpl']);
   
 if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['mail']) AND !empty($_POST['mdp']) and !empty($_POST['mdpC'])){
         if($mdp===$mdpC){
            if((empty($tel))||(preg_match('`^[0-9]{10}$`',$tel))){
                $insertcmd = "INSERT INTO Utilisateurs VALUES('".$nom."','".$prenom."','".$mail."','".$mdp."','".$tel."','".$ville."','".$profs."','".$dda."','".$etps."','".$dpl."' );";
                pg_send_query($connect, $insertcmd);
                $result = pg_get_result($connect);
                echo pg_result_error($result)."\n";
                /*Redirection vers la page Profil de la plateforme*/
                session_start();
                $_SESSION['mailU'] = $mail;
                header("Location: profil.php");
            }else{
                echo  ("<script type='text/javascript'>alert('Vous  devez inserer que 10 chiffres')</script>");
            }
         } else {
            echo  ("<script type='text/javascript'>alert('votre mot de passe est incorrect')</script>");
            }
         } else{
       echo  ("<script type='text/javascript'>alert('Tous les champs doivent être complétés !')</script>");
   }
}
?>
    <main>
        <section id="inscription">
            <form name="forminscription" method="post" action="" class="form_inscription">
                <fieldset>
                    <legend><strong style="color:#660000">Coordonées</strong></legend>
                    <table>
                        <tr>
                            <td><label for="">Nom:</label></td>
                            <td><input type="text" name="nom" id="nom" placeholder="votre nom" required value="<?php if(isset($nom)) { echo $nom; } ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="">Prenom:</label></td>
                            <td><input type="text" name="prenom" id="prenom" placeholder="votre prenom" required value="<?php if(isset($prenom)) { echo $prenom; } ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="">Mail:</label></td>
                            <td><input type="mail" name="mail" id="mail" placeholder="votre mail" required value="<?php if(isset($mail)) { echo $mail; } ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="">Mot de passe:</label></td>
                            <td><input type="password" name="mdp" id="mdp" placeholder=" votre mot de passe" required></td>
                        </tr>
                        <tr>
                            <td> <label for="">Confirmer votre mot de passe:</label></td>
                            <td><input type="password" name="mdpC" id="mdpC"  required></td>
                        </tr>
                    </table>
                </fieldset>
                <fieldset>
                    <legend><strong style="color:#660000">Informations Complementaires</strong></legend>
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
                                    $connect = connexionBD();
                                    $enum = getEnum($connect, 'Domaine');
                                    foreach($enum as $value){
                                        if($value == '') continue;
                                        echo "\t<option value=\"".$value.'">'.domaine($value)."</option>\n";
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
					                $connect = connexionBD();
                                    $enum = getEnum($connect, 'Diplome');
                                    foreach($enum as $value){
                                        if($value == '') continue;
                                        echo "\t<option value=\"".$value.'">'.diplome($value)."</option>\n";
                                    }
                                    ?>
					            </select>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <div class="inscription_cgu">
                    <input type="checkbox" name="" required value="">
                    <span>Accepter les <a href="../../media/CGU.pdf" target="_blank">conditions générales d'utilisation</a> de la plateforme</span>
                </div>
                <div>
                    <input type="reset" class="form-control" value="Réinitialiser">
                    <input required type="submit" class="form-control" name="forminscription"  value="Valider">
                </div>
            </form>
        </section>
    </main>

<?php
include("../includes/footer.php");
?>
