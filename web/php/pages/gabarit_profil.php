<?php
$titrePage = "test";
$style = "../../css/style.css";
include("../includes/header.php");
?>

    <main>
        <section>
            <h1>Modifier mot de passe</h1>
			<form method = "post" action = "modification_mdp.php">
				<table>
				<tr><td><label>Ancien mot de passe</label> <td><input type = "password" name = "Ancien mot de passe" /><tr>
				<tr><td><label>Nouveau mot de passe</label> <td><input type = "password" name = "Nouveau mot de passe"/><tr>
				<tr><td><label>Confirmer mot de passe</label> <td><input type = "password" name = "Confirmation mot de passe"/><tr>
				<tr><td><td><input type = "submit" value = "OK"/><tr>
				</table>
			</form>
			<h1>Informations complémentaires</h1>
			<form method = "post" action = "infos_ptofil.php">
				<table>
				<tr><td><label>Téléphone</label> <td><input type = "email" name = "Téléphone" placeholder = "ex : 0651284763"/><tr>
				<tr><td> <label>Ville</label> <td><input type = "text" name = "Ville"/><tr>
				<tr><td> <label>Domaine d'activité</label><td><select name = "Domaine d'activité">
					<option value = "Agroalimentaire/Agriculture">Agroalimentaire/Agriculture</option>
					<option value = "Envrironnement">Environnement</option>
					<option value = "Chimie">Chimie</option>
					<option value = "Médecine/Biologie">Médecine/Biologie</option>
					<option value = "Informatique/Télécoms">Informatique/Télécoms</option>
					<option value = "Electricité/Télécoms">Electricité/Electronique</option>
					<option value = "Sciences fondamentales">Sciences fondamentales</option>
				</select><tr>
				<tr><td><label>Profession</label> <td><input type = "text" name = "Profession"/><tr>
				<tr><td><label>Entreprise</label> <td><input type = "text" name = "Entreprise" /><tr>
				<tr><td><label>Diplôme</label> <td><select name = "Dipôme"/>
					<option value = "Licence">Licence</option>
					<option value = "Master">Master</option>
					<option value = "Diplôme d'ingénieur">Diplôme d'ingénieur</option>
					<option value = "Doctorat">Doctorat</option>
					<option value = "Autre">Autre</option>
				</select><tr>
				<tr><td><td><input type = "submit" value = "OK"/><tr>
				</table>
			</form>
        </section>
    </main>
<?php
include("../includes/footer.php");
?>