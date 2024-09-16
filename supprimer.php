<?php
    include 'db_connect.php'; 
    
    if (isset($_GET['id'])) {
        // Sanitize the id to prevent SQL injection
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        
        // Create the delete query
        $delete_user = "DELETE FROM utilisateur WHERE id = $id;";
        
        // Execute the query
        $result_delete_user = mysqli_query($conn, $delete_user);
        
        if ($result_delete_user) {
            header("Location: listes.php");
        } else {
            echo "Erreur lors de la suppression de l'utilisateur : " . mysqli_error($conn);
        }
    } else {
        echo "Aucun identifiant d'utilisateur fourni.";
    }
?>
