<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de l'utilisateur</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Détails de l'utilisateur</h2>
    <?php
        include 'db_connect.php'; 

        if (isset($_GET['id'])) {
            $id = mysqli_real_escape_string($conn, $_GET['id']);
            $get_student_query = "SELECT nom, prenom, id_parcours, date_naissance, adresse, sexe FROM utilisateur WHERE id = $id";
            $student_result = mysqli_query($conn, $get_student_query);

            if (mysqli_num_rows($student_result) > 0) {
                $student = mysqli_fetch_assoc($student_result);

                // Fetch parcours details for display
                $parcours_query = "SELECT libelle FROM parcours WHERE id = ".$student['id_parcours'];
                $parcours_result = mysqli_query($conn, $parcours_query);
                $parcours = mysqli_fetch_assoc($parcours_result);
    ?>
                <p><strong>Nom :</strong> <?php echo htmlspecialchars($student['nom']); ?></p>
                <p><strong>Prénom :</strong> <?php echo htmlspecialchars($student['prenom']); ?></p>
                <p><strong>Parcours :</strong> <?php echo htmlspecialchars($parcours['libelle']); ?></p>
                <p><strong>Date de naissance :</strong> <?php echo htmlspecialchars($student['date_naissance']); ?></p>
                <p><strong>Adresse :</strong> <?php echo htmlspecialchars($student['adresse']); ?></p>
                <p><strong>Sexe :</strong> <?php echo htmlspecialchars($student['sexe']); ?></p>
                <br>
                <button><a href='listes.php'>Voir la liste des autres utilisateurs</a></button>
    <?php
            } else {
                echo "Aucun utilisateur trouvé avec cet identifiant.";
            }
        } else {
            echo "Aucun identifiant d'utilisateur fourni.";
        }
    ?>
</body>
</html>
