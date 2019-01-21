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
                    <label> votre Adresse Mail</label>
                    <input type="email" name="email_utilisateur" required/>
                </div>
                <div class="email">
                    <label>Adresse Mail du membre contactée</label>
                    <input type="email" name="email_contactee" required/>
                </div>
               <div>
               <label>Objet</label>
               <input type="text" name="objet" required/>
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
session_start();
include("../includes/fonctions.php");
     $connect = connexionBD();




    if (isset($_POST['submit'])){
    $email_utilisateur =htmlspecialchars($_POST['email_utilisateur']);
    $email_contactee = htmlspecialchars($_POST['email_contactee']);
    $objet = htmlspecialchars($_POST['objet']);
    $message = htmlspecialchars($_POST['message']);
    $today = date("Y-m-d"); 
    
    //$to = 'plateformeprojetweb@gmail.com';
    //$objet = 'contact - projet web';
    //$corps = "Par: $nom_utilisateur $prenom_utilisateur\nEmail: $email_utilisateur\nMessage:\n$message";
    
    
         if(!empty($_POST['email_utilisateur']) AND !empty($_POST['email_contactee']) AND !empty($_POST['objet'])  and !empty($_POST['message'])) {

            if(verifUtilisateurs((array)$email_utilisateur) && verifUtilisateurs((array)$email_contactee)) {
                $query = "INSERT INTO contacter VALUES('$email_utilisateur','$email_contactee','$objet','$message', '$today');";
                pg_query($connect,$query);
            }
            else {
                echo  ("<script type='text/javascript'>alert('Au moins 1 des mails n'est pas reconnu comme membre enregistré sur notre site.)</script>");
            }
         }
         else{    
       echo  ("<script type='text/javascript'>alert('Tous les champs doivent être complétés !')</script>");       
             }
    }
?>

<?php
    $to = '$email_contactee';
    $objet = 'contact - projet web';
    $corps = "Par: $email_contactee\nEmail: $email_utilisateur\nMessage:\n$message";
    
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