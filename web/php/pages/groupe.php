<?php
$titrePage = "Création d'un groupe";
$style = "../../css/style.css";
include("../includes/header.php");
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
                        <option value="1">Theme1</option>
                        <option value="2">Theme2</option>
                    </select>
                </div>
                <div class="membres_groupe">
                    <label>Membres du groupe</label><br>
                    <input type="text" name="membre_groupe[]" onchange="nouvInput()" required/>
                </div>
                <input type="submit" value="CREATION"/>
            </form>
        </section>
    </main>

<?php
include("../includes/footer.php");
?>