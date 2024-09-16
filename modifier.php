<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Formulaire d'inscription</h2>
    <?php
        include 'db_connect.php'; 
        $parcours_query = "SELECT id, libelle FROM parcours";
        $parcours_result = mysqli_query($conn, $parcours_query);

        if (isset($_GET['id'])) {
            $id = mysqli_real_escape_string($conn, $_GET['id']);
            $get_student_query = "SELECT nom, prenom, id_parcours, date_naissance, adresse, sexe FROM utilisateur WHERE id = $id";
            $student_result = mysqli_query($conn, $get_student_query);

            if (mysqli_num_rows($student_result) > 0) {
                $student = mysqli_fetch_assoc($student_result);
    ?>
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($student['nom']); ?>"><br><br>
                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($student['prenom']); ?>"><br><br>
                    <label for="parcours">Parcours :</label>
                    <select name="parcours" id="parcours">
                        <?php
                        if (mysqli_num_rows($parcours_result) > 0) {
                            while ($parcours = mysqli_fetch_assoc($parcours_result)) {
                                $selected = ($parcours['id'] == $student['id_parcours']) ? 'selected' : '';
                                echo "<option value='".$parcours['id']."' $selected>".$parcours['libelle']."</option>";
                            }
                        } else {
                            echo "<option value=''>Aucun parcours trouvé</option>";
                        }
                        ?>
                    </select><br><br>
                    <label for="date_naissance">Date de naissance :</label>
                    <input type="date" name="date_naissance" value="<?php echo htmlspecialchars($student['date_naissance']); ?>"><br><br>
                    <label for="adresse">Adresse :</label>
                    <input type="text" name="adresse" value="<?php echo htmlspecialchars($student['adresse']); ?>"><br><br>
                    <label for="sexe">Masculin</label>
                    <input type="radio" name="sexe" value="Masculin" <?php echo ($student['sexe'] == 'Masculin') ? 'checked' : ''; ?>>
                    <label for="sexe">Féminin</label>
                    <input type="radio" name="sexe" value="Féminin" <?php echo ($student['sexe'] == 'Féminin') ? 'checked' : ''; ?>><br><br>
                    <input type="submit" value="Modifier">
                </form>
    <?php
            } else {
                echo "Aucun utilisateur trouvé pour cet identifiant.";
            }
        } else {
            echo "Aucun identifiant d'utilisateur fourni.";
        }
    ?>
</body>
</html>
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["id"]) && isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["parcours"]) && isset($_POST["date_naissance"]) && isset($_POST["adresse"]) && isset($_POST["sexe"])) {
        $id = mysqli_real_escape_string($conn, $_POST["id"]);
        $nom = mysqli_real_escape_string($conn, $_POST["nom"]);
        $prenom = mysqli_real_escape_string($conn, $_POST["prenom"]);
        $parcours = mysqli_real_escape_string($conn, $_POST["parcours"]);
        $date_naissance = mysqli_real_escape_string($conn, $_POST["date_naissance"]);
        $adresse = mysqli_real_escape_string($conn, $_POST["adresse"]);
        $sexe = mysqli_real_escape_string($conn, $_POST["sexe"]);

        $update_student = "UPDATE utilisateur SET nom = '$nom', prenom = '$prenom', id_parcours = '$parcours', date_naissance = '$date_naissance', adresse = '$adresse', sexe = '$sexe' WHERE id = $id";
        $update_result = mysqli_query($conn, $update_student);

        if ($update_result) {
            header("Location: listes.php");
            exit();
        } else {
            echo "Erreur: " . mysqli_error($conn);
        }
    }
?>
