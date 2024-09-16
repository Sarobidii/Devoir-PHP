<?php
session_start();
include 'db_connect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    $email = stripslashes($email);
    $mdp = stripslashes($mdp);
    $email = mysqli_real_escape_string($conn, $email);
    $mdp = mysqli_real_escape_string($conn, $mdp);

    $sql = "SELECT id, mdp FROM admin WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['mdp'];

        if ($mdp === $hashed_password) { 
            $_SESSION['email_user'] = $email;
            header("Location: listes.php");
            exit();
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password.";
    }
} 
?>
