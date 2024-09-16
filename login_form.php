<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Formulaire de connexion</h2>
    <form action="login.php" method="post">
        <label for="email">E-mail : </label>
        <input type="email" name="email" required><br><br>
        <label for="mdp">Mot de passe : </label>
        <input type="password" id="mdp" name="mdp" required><br><br>
        <input type="submit" value="Connexion"><br><br>
        <a href="recuperation.php">Mot de passe oublié</a>
    </form>
</body>
</html>
