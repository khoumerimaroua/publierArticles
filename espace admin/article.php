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
        <title>Afficher tous les articles</title>
    </head>
    <body>
      <?php 
      $recupArticles=$bdd->query('SELECT * FROM articles');
    while ($article = $recupArticles->fetch()){
?>
<div class="article" style="border: 1px solid black">
     <h1> <?=$article['titre']; ?></h1>
   <p><?= $article['description'];?></p>
   <a href="supprimer_articles.php?id=<?= $article['id']; ?>">
    <button style="color:white;background-color:red;margin-bottom:10px">Supprimer l'article</button>
</a>
<a href="modifier_article.php?id=<?= $article['id']; ?>">
    <button style="color:black;background-color:yellow;margin-bottom:10px">Modifier l'article</button>
</a>
</div>
<br>
<?php 
    }
    ?>
    </body>
    </html>