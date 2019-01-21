<?php
$titrePage = "Contact";
$style = "../../css/style.css";
include("../includes/header.php");
?>

    <main>
        <section>
            <h1>Contact</h1>
            <form action="" method="post" id="formulaireContact">
                <div class="email">
                    <label>Adresse Mail</label>
                    <input type="email" name="email_utilisateur" required/>
                </div>
                <div class="nom">
                    <label>Nom</label>
                    <input type="text" name="nom_utilisateur" required/>
                </div>
                <div class="prenom">
                    <label>Prénom</label>
                    <input type="text" name="prenom_utilisateur" required/>
                </div>
                <div class="message">
                    <label>Message</label>
                    <textarea form="formulaireContact" wrap="soft" name="message"></textarea>
                </div>
                <input type="submit" value="ENVOI" name="submit"/>
            </form>
        </section>
    </main>

<?php
    $email_utilisateur = $_POST['email_utilisateur'];
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $prenom_utilisateur = $_POST['prenom_utilisateur'];
    $message = $_POST['message'];
    $to = 'plateformeprojetweb@gmail.com';
    $objet = 'contact - projet web';
    $corps = "Par: $nom_utilisateur $prenom_utilisateur\nEmail: $email_utilisateur\nMessage:\n$message";
    
    if (isset($_POST['submit'])){
        if(mail ($to, $objet, $corps, "De: ProjetWeb")){
            echo '<p>Message envoyé</p>';
        }else{
            echo '<p>Erreur: message</p>';
        }
    }
?>

<?php
include("../includes/footer.php");
?>