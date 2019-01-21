    <?php
function connexionBD(){
    $n="plateforme_recherche";
    $u="plateforme";
    $p="projetweb";
    $connect=pg_connect("host=postgresql-plateforme.alwaysdata.net port=5432 dbname=$n user=$u password=$p");
    return $connect;
}

function verifUtilisateurs($tabLogin){
    $connect = connexionBD();
    foreach($tabLogin as $login){
        $query= "SELECT mailU FROM Utilisateurs WHERE mailU='".$login."'";
        $result=pg_query($connect,$query);
        if(!pg_fetch_row($result)){
            return false;
        }
    }
    return true;
}

function getId($table, $nomChamp){
    $connect = connexionBD();
    $query = "SELECT $nomChamp from $table orderby $nomChamp desc limit 1;";
    $result = pg_query($connect,$query);
    $row = pg_fetch_row($result);
    $id = $row[0];
    return $id;
}

function getEnum($connect, $nom){
    $query = "select enum_range(null::$nom);";
    $result = pg_query($connect, $query);
    $row = pg_fetch_array($result);
    $enum = $row[0];
    $enum = substr($enum, 1, strlen($enum)-2);
    $enum = explode(',', $enum);
    return $enum;
}

function domaine($nomDomaine){
    switch ($nomDomaine){
        case "chimie" :
            return "Chimie/Physique";
            break;
        case "reseau" :
            return "Réseaux";
            break;
        case "agroalimentaire" :
            return "Agroalimentaire/Agriculture";
            break;
        case "environnement" :
            return "Environnement";
            break;
        case "medecine_bio" :
            return "Médecine/Biologie";
            break;
        case "info_telecom" :
            return "Informatique/Télécoms";
            break;
        case "elec" :
            return "Électricité/Électronique";
            break;
        case "sciences" :
            return "Sciences Fondamentales";
            break;
        default :
    }
function diplome($nomDiplome){
    switch ($nomDiplome){
        case "licence" :
            return "Licence";
            break;
        case "master" :
            return "Master";
            break;
        case "ingenieur" :
            return "Ingénieur";
            break;
        case "doctorat" :
            return "Doctorat    ";
            break;
        case "autre" :
            return "Autre";
            break;
        default :
    }
}
}
?>