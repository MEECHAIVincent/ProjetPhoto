<?php

include ('auth.php');

// Connexion � la base de donn�es MySQL 
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// V�rifier la connexion
if($conn === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}
?>

<?php $pdo = new PDO("mysql:host=localhost;dbname=libphoto", "root", "" , array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION)); ?>