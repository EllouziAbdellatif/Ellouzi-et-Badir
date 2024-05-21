<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("connexion.php");

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['dateNaissance'];
    $filiere = $_POST['idFiliere'];

    $photo_profil = $_FILES['photoProfil']['name'];
    $target_dir = "img/"
    $photo_profil = $target_dir . $image_name;

    move_uploaded_file($photo_profil_tmp, $photo_profil_destination);

    try {
        $requete = $pdo->prepare("INSERT INTO stagiaire (nom, prenom, dateNaissance, photoProfil, idFiliere) VALUES (?, ?, ?, ?, ?)");

        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':prenom', $prenom);
        $requete->bindParam(':dateNaissance', $date_naissance);
        $requete->bindParam(':photoProfil', $photo_profil_destination);
        $requete->bindParam(':idFiliere', $filiere);

        $requete->execute();
        
        header("Location: authentification.php");
        exit;
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .form-container {
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

        input[type="text"], input[type="date"], input[type="file"], select {
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
    </style>
</head>
<body>

<div class="form-container">
    <h2>Inscription</h2>
    <form action="" method="post" >
        <div>
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required>
        </div>

        <div>
            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" required>
        </div>

        <div>
            <label for="date_naissance">Date de naissance:</label>
            <input type="date" id="date_naissance" name="dateNaissance" required>
        </div>

        <div>
            <label for="photo_profil">Photo de profil:</label>
            <input type="file" id="photo_profil" name="photoProfil" required>
        </div>

        <div>
            <label for="filiere">Filière:</label>
            <select id="filiere" name="idFiliere" required>
                <option value="informatique">Informatique</option>
                <option value="mathematiques">Mathématiques</option>
                <option value="physique">Physique</option>
                <option value="chimie">Chimie</option>
                <option value="biologie">Biologie</option>
            </select>
        </div>

        <div>
            <input type="submit" value="S'inscrire">
        </div>
    </form>
</div>

</body>
</html>
