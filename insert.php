<?php
    include 'db_connect.php';
    if(isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["parcours"]) && isset($_POST["date_naissance"]) && isset($_POST["adresse"]) && isset($_POST["sexe"]))
    {
        $nom = mysqli_real_escape_string($conn, $_POST["nom"]);
        $prenom = mysqli_real_escape_string($conn, $_POST["prenom"]);
        $parcours = mysqli_real_escape_string($conn, $_POST["parcours"]);
        $date_naissance = mysqli_real_escape_string($conn, $_POST["date_naissance"]);
        $adresse = mysqli_real_escape_string($conn, $_POST["adresse"]);
        $sexe = mysqli_real_escape_string($conn, $_POST["sexe"]);
    
        $get_student_exist = "SELECT nom, prenom, id_parcours, date_naissance, adresse, sexe FROM utilisateur";
        $result_student_exist = mysqli_query($conn, $get_student_exist);
    
        $new_student = "INSERT INTO utilisateur (nom, prenom, date_naissance, adresse, id_parcours, sexe) 
                        VALUES ('$nom', '$prenom', '$date_naissance', '$adresse', '$parcours', '$sexe')";
        $insert = mysqli_query($conn, $new_student);
    
        if(!$insert) {
            echo "Erreur: " . mysqli_error($conn);
        } 
    }
    header("Location: listes.php");
?>