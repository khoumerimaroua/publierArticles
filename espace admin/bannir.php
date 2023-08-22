<?php
session_start();
$user = 'root'; 
$pass = ''; 
$bdd = new PDO('mysql:dbname=espace_admin;host=localhost', $user, $pass);
if(isset($_GET['id']) && !empty($_GET['id'])){
$getid=$_GET['id'];
$recupUser=$bdd->prepare('SELECT*FROM membres WHERE id =?');
$recupUser->execute(array($getid));
if($recupUser->rowCount()>0){
$bannirUser = $bdd->prepare('DELETE FROM membres WHERE id =?');
$bannirUser->execute(array($getid));
header ('Location:menbres.php');
}else{
    echo"Aucun membre n'a été trouvé";
}
}else{
    echo"l'identifiant n 'a pas été récupéré";
}?>