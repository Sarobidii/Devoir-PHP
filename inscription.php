<?php
include 'db_connect.php'; 
$parcours = "SELECT id, libelle FROM parcours";
$result = mysqli_query($conn, $parcours);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Formulaire d'inscription</h2>
    <form action="insert.php" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" ><br><br>
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" ><br><br>
        <label for="parcours">Parcours :</label>
        <select name="parcours" id="parcours">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='".$row['id']."'>".$row['libelle']."</option>";
                }
            } else {
                echo "<option value=''>Aucun parcours trouvé</option>";
            }
            ?>
        </select><br><br>

        <label for="date_naissance">Date de naissance :</label>
        <input type="date" name="date_naissance"><br><br>
        <label for="adresse">Adresse :</label>
        <input type="text" name="adresse"><br><br>
        <label for="sexe">Masculin</label>
        <input type="radio" name="sexe" value="Masculin">
        <label for="sexe">Féminin</label>
        <input type="radio" name="sexe" value="Féminin"><br><br>
        <input type="submit" value="S'inscrire">
    </form>
    <button><a href='listes.php'>Voir les utilisateurs</a></button>
</body>
</html>

