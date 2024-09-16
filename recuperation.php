<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Entrez votre adresse email</h2>
    <form action="" method="post">
        <label for="email">E-mail : </label>
        <input type="email" name="email" required><br><br>
        <input type="submit" value="Valider"><br><br>
    </form>

    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    include 'db_connect.php'; 

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
        $email = $_POST['email'];

        // Protection contre les injections SQL
        $email = stripslashes($email);
        $email = mysqli_real_escape_string($conn, $email);

        // Requête pour vérifier l'existence de l'e-mail
        $sql = "SELECT id FROM admin WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            // Envoi de l'email (à vérifier si mail() fonctionne bien)
            if (mail($email, "Modification de mot de passe", "Votre mot de passe a été modifié")) {
                $new_password = '123456';

                $update_sql = "UPDATE admin SET mdp = '$new_password' WHERE email = '$email'";
                if (mysqli_query($conn, $update_sql)) {
                    echo "Mot de passe mis à jour avec succès.";
                } else {
                    echo "Erreur de mise à jour du mot de passe : " . mysqli_error($conn);
                }
            } else {
                echo "Erreur lors de l'envoi de l'e-mail.";
            }
        } else {
            echo "E-mail non trouvé";
        }
    }
    ?>
</body>
</html>
