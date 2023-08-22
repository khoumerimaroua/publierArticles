<?php 
// Connexion à la base de données
$user = 'root'; 
$pass = ''; 
$bdd = new PDO('mysql:dbname=espace_admin;host=localhost', $user, $pass);

// Vérification de l'existence et de la non-vacuité de l'identifiant dans la requête GET
if(isset($_GET['id']) && !empty($_GET['id'])){
    $getid = $_GET['id'];
    // Récupération de l'article correspondant à l'identifiant
    $recupArticle = $bdd->prepare('SELECT * FROM articles WHERE id =?');
    // ette ligne prépare une instruction SQL . Le ? est un espace réservé qui sera remplacé ultérieurement par la valeur réelle.
    $recupArticle->execute(array($getid));
    // En PHP, la méthode execute() attend un tableau en argument, où chaque élément du . Dans ce cas, la requête préparée contient un espace réservé ?, qui doit être remplacé par la valeur réelle de l'identifiant ($getid).

// En utilisant la syntaxe array($getid), nous créons un tableau contenant une seule valeur, qui est la valeur de $getid. Cela permet de lier cette valeur à l'espace réservé dans la requête préparée lors de l'exécution.
    // Vérification si l'article existe
    if($recupArticle->rowCount() > 0){
        // Récupération des informations de l'article
        $articleInfo = $recupArticle->fetch(PDO::FETCH_ASSOC);
        // PDO::FETCH_ASSOC est un mode de récupération des données utilisé avec la méthode fetch() de l'objet PDOStatement. Il spécifie que les données récupérées doivent être retournées sous forme de tableau associatif, où les noms des colonnes de la requête sont utilisés comme clés et les valeurs des enregistrements correspondants sont utilisées comme valeurs.
        $titre = $articleInfo['titre'];
        // Remplacement de la balise <br> par un retour à la ligne
        $description = str_replace('<br>', "\n", $articleInfo['description']);
// Les variables $titre et $description sont utilisées ultérieurement dans le formulaire HTML pour afficher les valeurs actuelles de l'article.
        // Vérification si le formulaire est soumis
        if(isset($_POST['titre'])){
            // Récupération des valeurs saisies dans le formulaire
            $titre_saisi = htmlspecialchars($_POST['titre']);
            $description_saisi = htmlspecialchars($_POST['description']);
            // Mise à jour de l'article dans la base de données
            $updateArticle = $bdd->prepare('UPDATE articles SET titre=?, description=? WHERE id=?');
            $updateArticle->execute(array($titre_saisi, $description_saisi, $getid));
            // Redirection vers la page de l'article
            header('location: article.php');
            exit();
        }
    }
    else{
        echo "Aucun article trouvé";
    }
}
else{
    echo "Aucun identifiant trouvé";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'article</title>
</head>
<body>
    <form action="" method="POST">
        <!-- Champ de saisie pour le titre avec la valeur de l'article actuel -->
        <input type="text" name="titre" value="<?= $titre;?>">
        <br>
        <!-- Zone de texte pour la description avec la valeur de l'article actuel (retours à la ligne inclus) -->
        <textarea name="description"><?= $description;?></textarea>
        <br><br>
        <!-- Bouton de validation du formulaire -->
        <input type="submit" name="valider">
    </form>
</body>
</html>
