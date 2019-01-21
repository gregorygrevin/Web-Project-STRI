<?php
session_start();
include("../includes/fonctions.php");
if(!isset($_SESSION['mailU'])){
    //header("Location: inscription.php");
}

$titrePage = "Création d'un groupe";
$style = "../../css/style.css";
include("../includes/header.php");
?>

<?php
if(isset($_POST['submit'])){
    $nom_groupe = $_POST['nom_groupe'];
    $theme_groupe = $_POST['theme_groupe'];
    $membres_groupe = $_POST['membres_groupe'];
    $mail_createur_groupe = $_SESSION['mailU'];
    if(verifUtilisateurs($membres_groupe)){
        $connect = connexionBD();
        $id = getId("groupes_projets", "idg") + 1;
        $query = "INSERT INTO groupes_projets (idg, nomg, themeg, dateg, mailcreateurg) VALUES ($id, $nom_groupe, $theme_groupe, ".date('Y-m-d').", $mail_createur_groupe);";
        $result = pg_query($query);
        if(!$result){
            echo "erreur création groupe\n";
        }else{
            echo "le groupe a été créé\n";
        }
    }
}
?>

    <main>
        <section>
            <h1>Création d'un groupe</h1>
            <form action="" method="post" id="formulaireCreationGroupe">
                <div class="nom_groupe">
                    <label>Nom du groupe</label>
                    <input type="text" name="nom_groupe" required/>
                </div>
                <div class="theme_groupe">
                    <label>Thème du groupe</label>
                    <select name="theme_groupe" required>
                        <option disabled selected>Liste des thèmes</option>
                        <?php
                        $connect = connexionBD();
                        $query = "select distinct themeg from groupe_projets;";
                        $result = pg_query($connect, $query);
                        while($row = pg_fetch_row($result)){
                            $theme = $row[0];
                            echo "<option value=\"$theme\">$theme</option>\n";
                        }
                        ?>
                    </select>
                </div>
                <div class="membres_groupe">
                    <label>Membres du groupe</label><br>
                    <input type="text" name="membres_groupe[]" onchange="nouvInput()" placeholder="login" required/>
                </div>
                <input type="submit" value="CREATION" name="submit"/>
            </form>
        </section>
    </main>
    
    
    <script type="text/javascript">
    function nouvInput(){
        var nouv = document.createElement("input");
        nouv.setAttribute("type", "text");
        nouv.setAttribute("name", "membres_groupe[]");
        nouv.setAttribute("onchange", "nouvInput()");
        nouv.setAttribute("placeholder", "login");
        var groupe = document.getElementsByClassName("membres_groupe")[0];
        var br = document.createElement("br");
        groupe.appendChild(br);
        groupe.appendChild(nouv);
        var membres = groupe.getElementsByTagName("input");
        membres[membres.length - 2].removeAttribute("onchange");
    }
    </script>

<?php
include("../includes/footer.php");
?>