<?php
include("../includes/fonctions.php");
if(isset($_GET['idg'])){
    $idg = $_GET['idg'];
}else{
    header("Location: /index.php");
}
$connect = connexionBD();
$query = "select * from groupes_projets where idg=$idg";
$result = pg_query($connect, $query);
$row = pg_fetch_array($result);
$nomg = $row['nomg'];
$themeg = $row['themeg'];

$titrePage = $nomg;
$style = "../../css/style.css";
include("../includes/header.php");
?>

<?php
if(isset($_POST['submit_document'])){
    $target_dir = "../../media/$idg/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    if (file_exists($target_file)) {
        echo "Le fichier existe deja\n";
        $uploadOk = 0;
    }
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Fichier trop large\n";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "pas upload\n";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "fichier ". basename( $_FILES["fileToUpload"]["name"]). " enregistré\n";
            $connect = connexionBD();
            $iddoc = $getId('documents','iddoc') + 1;
            $datedoc = date('Y-m-d');
            $mailu = $_SESSION['mailU'];
            $nomdoc = basename( $_FILES["fileToUpload"]["name"]);
            $vuedoc = $_POST['vuedoc'];
            $typedeoc = $_POST['typedoc'];
            $commentairedoc = $_POST['commentairedoc'];
            $query = "insert into documents (iddoc,nomdoc,typedoc,commentairedoc,datedoc,vuedoc,mailu,idg)
            values('$iddoc','$nomdoc','$typedeoc','$commentairedoc','$datedoc','$vuedoc','$mailu','$idg');";
            pg_query($connect, $query);
            echo "fichier ". $nomdoc ." enregistré\n";
        } else {
            echo "Erreur - upload\n";
        }
    }
}
?>

<?php
if(isset($_POST['submit_tache'])){
    $mailu = $_POST['mailu'];
    $datet = $_POST['datet'];
    $descriptiont = $_POST['descriptiont'];
    $idt = getId('taches','idt') + 1;
    $connect = connexionBD();
    $query = "INSERT INTO taches VALUES ('$idt','$descriptiont');";
    pg_query($connect,$query) or die("fkck");
    $query = "INSERT INTO ajouter_taches VALUES ('$mailu','$idg','$idt','$datet');";
    pg_query($connect,$query) or die ('fkck');
}
?>

    <main>
        <section id="groupe_prive">
            <h1>Theme du groupe : <?php echo ucfirst($themeg) ?></h1>
            <article class="documents">
                <button title="Ajouter un document" class="button_ajouter" id="button_document">+</button>
                <a href="groupe_prive.php?idg=<?php echo $idg; if($idoc > 0) echo "&amp;idoc=".--$idoc?>">
                    <button id="button_precedent"><<</button>
                </a>
                <a href="groupe_prive.php?idg=<?php echo "$idg&amp;idoc=".++$idoc?>">
                    <button id="button_suivant">>></button>
                </a>
                <div class="liste_documents">
                    <?php
                    $connect = connexionBD();
                    $query = "select * from documents where idg=$idg order by datedoc desc;";
                    $result = pg_query($connect, $query);
                    if(isset($_GET['idoc'])){
                        $idoc = $_GET['idoc'];
                    }else{
                        $idoc = 0;
                    }
                    for($i=1;$i<$idoc*5;$i++){
                        pg_fetch_row($result);
                    }
                    while($row = pg_fetch_array($result)){
                        echo '
                        <a href="/media/'."$idg/".$row['nomdoc'].'" alt="'.$row['commentairedoc'].'">
                            <div>
                                '.$row['commentairedoc'].'
                                <button type="button" class="button_fermer">&times;</button>
                            </div>
                        </a>';
                    }
                    ?>
                </div>
            </article>
            <article class="taches">
                <button title="Ajouter une tache" class="button_ajouter" id="button_tache">+</button>
                <table class="table_taches">
                    <tr>
                        <th>Date</th>
                        <th>Tâche</th>
                        <th>Membre concerné    </th>
                    </tr>
                    <?php
                    $connect = connexionBD();
                    $query="SELECT descriptionT, datet, prenomu, nomu
                    FROM taches t
                    INNER JOIN Ajouter_taches a ON t.idT=a.idT
                    INNER JOIN utilisateurs u ON a.mailu=u.mailu
                    WHERE a.idg=$idg
                    ORDER BY datet DESC";
                    $result=pg_query($connect, $query);
                    while($row = pg_fetch_array($result)){
                        echo "<tr>\n";
                        echo "\t<td>".$row['datet']."</td>\n";
                        echo "\t<td>".$row['descriptiont']."</td>\n";
                        echo "\t<td>".$row['prenomu']." ".$row['nomu']."</td>\n";
                        echo "</tr>\n";
				    }
                    ?>
                </table>
            </article>
        </section>
    </main>
    
    <div id="modal_document" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" id="close_document">&times;</span>
                <h2>Ajouter un document</h2>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" action="" method="post">
                    <table>
                        <tr>
                            <td><label>Fichier :</label></td>
                            <td><input type="file" name="fileToUpload" id="fileToUpload" required></td>
                        </tr>
                        <tr>
                            <td><label>Commentaire : </label></td>
                            <td><input type="text" name="commentairedoc" required></td>
                        </tr>
                        <tr>
                            <td><label>Visibilité :</label></td>
                            <td>
                                <select name="vuedoc" required>
                                    <?php
                                    $connect = connexionBD();
                                    $enum = getEnum($connect, 'visibilite');
                                    foreach($enum as $value){
                                        echo "<option value\"$value\">$value</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <input type="submit" name="submit_document" value="Enregistrer">
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
    <div id="modal_tache" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" id="close_tache">&times;</span>
                <h2>Ajouter une tâche</h2>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    Membre: <input type="mail" name="mailu" required><br>
                    Description: <input type="text" name="descriptiont" required><br>
                    Délai: <input type="date" name="datet" min="<?php echo date('Y-m-d') ?>" required><br>
                    <input type="submit" name="submit_tache">
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
    
    <script>
    var modal_document = document.getElementById('modal_document');
    var btn_document = document.getElementById("button_document");
    var span_document = document.getElementById("close_document");
    btn_document.onclick = function() {
        modal_document.style.display = "block";
    }
    span_document.onclick = function() {
        modal_document.style.display = "none";
    }
    
    var modal_tache = document.getElementById('modal_tache');
    var btn_tache = document.getElementById("button_tache");
    var span_tache = document.getElementById("close_tache");
    btn_tache.onclick = function() {
        modal_tache.style.display = "block";
    }
    span_tache.onclick = function() {
        modal_tache.style.display = "none";
    }
    
    window.onclick = function(event) {
        if (event.target == modal_document) {
            modal_document.style.display = "none";
        }
        if (event.target == modal_tache) {
            modal_tache.style.display = "none";
        }
    }
    </script>

<?php
include("../includes/footer.php");
?>