<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="<?php echo $style ?>">
    <title><?php echo $titrePage ?></title>
</head>
<body>
    <header>
        <a href="gabarit_accueil.php"><img src="../../media/logo_40.jpg" alt="logo" id="logo"></a>
        <div id="titre">
            <p><?php echo $titrePage ?></p>
        </div>
        <nav>
            <div id="liens">
                <a href=""><img src="../../media/accueil_20.png" alt="accueil"></a>
                <a href=""><img src="../../media/deconnexion.png" alt="connexion"></a>
                <a href=""><img src="../../media/contact_20.png" alt="contact"></a>
            </div>
            <form action="" method="post" id="formRecherche">
                <div id="texteRecherche">
                    <img src="../../media/rechercheSansLegende_7.jpg" alt="icone recherche">
                    <input type="text" name="requete" placeholder="nom, thème ou membre d'un groupe" size="30">
                </div>
                <input type="submit" value="Rechercher des groupes">
            </form>
        </nav>
    </header>