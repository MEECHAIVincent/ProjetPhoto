<?php include "inc\header.php";?>

<?php
$id = $_POST['id'];
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $requete = mysqli_query($conn, "DELETE FROM `post` WHERE id='$id'");
    header('Location: profile.php');
}

?>

<?php include "inc\jooter.php" ?>