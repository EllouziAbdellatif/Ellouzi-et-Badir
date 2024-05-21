<?php
session_start();
require_once 'connexion.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {   
    $loginAdmin = trim($_POST['loginAdmin']);
    $motPasse = trim($_POST['motPasse']);
    if(empty($loginAdmin) || empty($motPasse)){
        header('location: authentification.php?msg=les données d’authentification sont obligatoires.');
        exit;
    }
}

?>

<?php
include("connexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginAdmin = $_POST['loginAdmin'];
    $motPasse = $_POST['motPasse']; 

    $requete = $pdo->prepare("SELECT * FROM compteAdministrateur WHERE loginAdmin = :loginAdmin AND motPasse = :motPasse");
    $requete->bindParam(':loginAdmin', $loginAdmin);
    $requete->bindParam(':motPasse', $motPasse);
    $requete->execute();
    $utilisateur = $requete->fetch();

    
    if ($requete->rowCount() == 1) {
        
        header("Location: espaceprivee.php");
        exit;
    } else {
        header('location: authentification.php?msg=Login ou mot de passe incorect.');
    }
}
?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .login-container {
            max-width: 400px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            margin-top: 0;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input[type="text"], input[type="password"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        p {
            color: red;
            font-weight: bold;
        }

    </style>
</head>
<body>

<div class="login-container">
    <h2>Authentification</h2>

    <?php if (isset($_GET['msg'])): ?>
        <p style="color:red"><?= $_GET['msg'] ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <div>
            <label for="login">Login:</label>
            <input type="text" id="login" name="loginAdmin">
        </div>

        <div>
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="motPasse">
        </div>

        <div>
            <input type="submit" value="S'authentifier">
        </div>
    </form>
</div>

</body>
</html>
