<?php
session_start();
$user = 'root';
$pass = '';
$bdd = new PDO('mysql:dbname=espace_admin;host=localhost', $user, $pass);

if (!isset($_SESSION['mdp']) || empty($_SESSION['mdp'])){ 
    header('Location: connexion.php'); 
    exit;
}

if (isset($_POST['envoi'])) {
    $titre = htmlspecialchars($_POST['titre']); 
    $description = nl2br(htmlspecialchars($_POST['description'])); 

    if (!empty($titre) && !empty($description)) { 
        $insertArticle = $bdd->prepare('INSERT INTO articles (titre, description) VALUES (?, ?)');
        $insertArticle->execute(array($titre, $description));
        echo "L'article a bien été envoyé";
    } else {
        echo "Veuillez compléter tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publier un article</title>
</head>
<body>
    <form method="POST" action=""> 
        <input type="text" name="titre">
        <br>
        <textarea name="description" id=""></textarea><br>
        <input type="submit" name="envoi">
    </form> 
</body>
</html>
