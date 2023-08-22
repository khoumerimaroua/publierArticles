<?php
session_start();
$user = 'root'; 
$pass = ''; 
$bdd = new PDO('mysql:dbname=espace_admin;host=localhost', $user, $pass);
if(!$_SESSION['mdp']){
    header('Location:connexion.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afficher les membres</title>
</head>
<body>
    <?php 
    $recupUsers = $bdd->query('SELECT*FROM membres');
    while($user = $recupUsers->fetch()){
        ?>
        <p><?= $user['pseudo'];?><a href="bannir.php?id=<?= $user['id'];?>"style="color:red;text-decoration:none;">Bannir le membre </a></p>
        <?php
    }
    ?>
</body>
</html>

   
