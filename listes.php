<?php
session_start();
if(!isset($_SESSION['email_user'])){
    header("location: login_form.php");
    exit;
}
?>
<?php
    include 'db_connect.php';
    $get_student = "SELECT id, nom, prenom, id_parcours, date_naissance, adresse, sexe FROM utilisateur";
    $result_student = mysqli_query($conn, $get_student);
    echo "<!DOCTYPE html>";
    echo "<html>";
    echo "<head>";
    echo "  <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200\" />";
    echo "  <link rel=\"stylesheet\" href=\"style.css\">";
    echo "</head>";
    echo "<body>";
    echo "<h2>Liste des utilisateurs</h2>";
    echo "<button><a href='inscription.php'>Ajouter un nouvel utilisateur</a></button>";
    echo "<button><a href='logout.php'>Se déconnecter</a></button>";
    echo "<table border='1'>\n";
    echo "<tr>\n";
    echo "  <th>Nom</th>\n";
    echo "  <th>Prénoms</th>\n";
    echo "  <th>Parcours</th>\n";
    echo "  <th>Date de naissance</th>\n";
    echo "  <th>Adresse</th>\n";
    echo "  <th>Sexe</th>\n";
    echo "  <th>Actions</th>\n";
    echo "</tr>";

    if (mysqli_num_rows($result_student) > 0) {
        while ($row = mysqli_fetch_assoc($result_student)) {
            $id_parcours = $row['id_parcours'];
            $get_parcours_student = "SELECT libelle FROM parcours WHERE id = $id_parcours";
            $result_parcours_student = mysqli_query($conn, $get_parcours_student);
            $parcours_student = mysqli_fetch_assoc($result_parcours_student);

            echo "<tr>\n";
            echo "  <td>" . $row['nom'] . "</td>\n";
            echo "  <td>" . $row['prenom'] . "</td>\n";
            echo "  <td>" . $parcours_student['libelle'] . "</td>\n"; 
            echo "  <td>" . $row['date_naissance'] . "</td>\n";
            echo "  <td>" . $row['adresse'] . "</td>\n";
            echo "  <td>" . $row['sexe'] . "</td>\n";
            echo "  <td><button><a href='modifier.php?id=" . $row['id'] . "'><span class=\"material-symbols-outlined\">edit</span></a></button>";
            echo "      <button><a href='supprimer.php?id=" . $row['id'] . "'><span class=\"material-symbols-outlined\">delete</span></a></button>";
            echo "      <button><a href='details.php?id=" . $row['id'] . "'><span class=\"material-symbols-outlined\">visibility</span></a></button></td>\n";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>Aucun utilisateur trouvé</td></tr>";
    }
    echo "</table>";
    echo "</body>";
    echo "</html>";
    ?>