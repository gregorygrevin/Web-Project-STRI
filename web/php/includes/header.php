<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="<?php echo $style ?>">
    <title><?php echo $titrePage ?></title>
</head>
<body>
    <header>
        <a href="https://plateforme.alwaysdata.net/index.php"><img src="https://plateforme.alwaysdata.net/media/logo_40.jpg" alt="logo" id="logo"></a>
        <div id="titre">
            <p><?php echo $titrePage ?></p>
        </div>
        <nav>
            <div id="liens">
                <a href="https://plateforme.alwaysdata.net/index.php"><img src="../../media/accueil_30.png" alt="accueil"></a>
                <?php
                session_start();
                if(isset($_SESSION['mailU'])){
                    echo '<a href="https://plateforme.alwaysdata.net/php/pages/profil.php"><img src="../../media/profil_30.png" alt="profil"></a>'."\n";
                    $lien = "deconnexion.php";
                    $image = "deconnexion_30.png";
                    $alt = "deconnexion";
                }else{
                    $lien = "connexion.php";
                    $image = "connexion_30.png";
                    $alt = "connexion";
                }
                ?>
                <a href="https://plateforme.alwaysdata.net/php/pages/<?php echo $lien ?>"><img src="https://plateforme.alwaysdata.net//media/<?php echo $image ?>" alt="<?php echo $alt ?>"></a>
                <a href="https://plateforme.alwaysdata.net/php/pages/contact.php"><img src="https://plateforme.alwaysdata.net//media/contact_30.png" alt="contact"></a>
            </div>
            <form action="" method="post" id="formRecherche">
                <div id="texteRecherche">
                    <img src="https://plateforme.alwaysdata.net/media/rechercheSansLegende_7.jpg" alt="icone recherche">
                    <input type="text" name="recherche" placeholder="nom, thème ou membre d'un groupe" size="30">
                    <div class="header_recherche_criteres">
                        <input type="radio" name="colonne" value="nomg" checked>Nom
                        <input type="radio" name="colonne" value="themeg">Theme
                        <input type="radio" name="colonne" value="nomu" disabled>Utilisateur
                    </div>
                </div>
                <input type="submit" value="Rechercher des groupes">
            </form>
        </nav>
    </header>