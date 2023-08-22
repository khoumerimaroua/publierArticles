<?php
$user = 'root'; 
$pass = ''; 
$bdd = new PDO('mysql:dbname=espace_admin;host=localhost', $user, $pass);
if(isset($_GET['id']) && !empty($_GET['id'])){
  $getid =$_GET['id'];
  $recupArticle = $bdd->prepare('SELECT * FROM liste de souhaits WHERE id =?');
  $recupArticle ->execute(array($getid));
  if($recupArticle->rowCount()>0){
  $deleteArticle = $bdd->prepare('DELETE FROM liste de souhaits where id =?');
  $deleteArticle->execute(array($getid));
  header('Location:profil.php');
  }else{
    echo"Aucun liste trouvé";
  }
}else{
echo" aucun identifiant trouvé ";
}
?>