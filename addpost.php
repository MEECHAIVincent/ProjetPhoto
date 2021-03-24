<?php include "inc\header.php" ;
       

?>
<body>

<?php

if (empty($_GET['login']) && empty($_SESSION['login'])) {
    header('Location: signin.php');
    die;
}?>
    
<?php 


if (!empty($_POST) && !empty($_FILES)) {


    $_POST['objectif'] = htmlentities($_POST['objectif']);
    $obj = $_POST["objectif"] ;
    $obj = addslashes($obj); //pour ajouter des slashes pour prendre en compte les apostrophes
  
    
    $_POST['appareil'] = htmlentities($_POST['appareil']);
    $app = $_POST["appareil"] ;


    if (!empty($obj)) {
        $requete = mysqli_query($conn,"SELECT id from appareil  where appareil='$app' AND objectif='$obj' ");; //selectionne l'id de l'utilisateur pour savoir qui a publié l'article
    } else {
        $requete = mysqli_query($conn,"SELECT id from appareil  where appareil='$app'");; //selectionne l'id de l'utilisateur pour savoir qui a publié l'article
    }
    $data = mysqli_fetch_assoc($requete);
    $id_app = $data['id'];
 
    $_POST['description'] = htmlentities($_POST['description']);
    $desc = $_POST["description"] ;
    $desc = addslashes($desc); //pour ajouter des slashes pour prendre en compte les apostrophes
  

    $login = $_SESSION['login'];
    $requete = mysqli_query($conn,"SELECT id from users  where login='$login'");; //selectionne l'id de l'utilisateur pour savoir qui a publié l'article
    $data = mysqli_fetch_assoc($requete);
    $aut = $data['id'];
   


    $file_name = $_FILES['photo']['name'];
    $file_extension = strchr($file_name, ".");

    $file_tmp_name = $_FILES['photo']['tmp_name'];
    $file_dest ="assets/photo/".$file_name;

    $extensions_autorisees = array('.jpg', '.jpeg', '.gif', '.png' );

        // var_dump(move_uploaded_file($file_tmp_name, $file_dest ));
        // if(move_uploaded_file($file_tmp_name, $file_dest )){
            //Insert les donnée de l'article de l'utilisateur dans la bdd 
            // $requete2 = "INSERT into post(id_article, film, realisateur,date_sortie, categorie, note, commentaire, auteur, affiche, date_publication, statut) values(NULL,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP, 0)";  
            $requete2 = "INSERT INTO `post` (`id`, `image`, `description`, `id_user`, `id_appareil`, `date_publication`) VALUES (NULL, '$file_dest', '$desc', $aut, $id_app, CURRENT_TIMESTAMP);";  
            var_dump($requete2);
            
            $resultat2 = mysqli_query($conn, $requete2);
            // mysqli_stmt_bind_param($resultat2, "ssssssss", $file_dest, $desc, $aut, $id_app);
            // mysqli_stmt_execute($resultat2);

?>
            <div class="alert alert-success">
                <b>Votre post a été publié</b> 
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>
            
         <?php 
        // }
        // else{
        //     echo "Une erreur est survenue";
        // }
}
?>
	<!-- container -->
	<div class="container">


		<div class="row">
			
			<!-- Article main content -->
			<article class="col-sm-8 maincontent">
				<header class="page-header">
					<h1 class="page-title">Nouvel article</h1>
                </header>
                <form method="POST" action="" enctype="multipart/form-data">
                
                    <div class="form-group">
                        <h3>Photo</h3>
                        <label for="myfile">Selectionnez une photo</label>
                        <input type="file" id="photo" name="photo" required><br><br>

                    </div>

                    <div class="form-group">
                        <h3>Appareil</h3>
                       <?php
                       
                // Affichage des sites sur liste
                echo '<input list="appareils" name="appareil" id="appareil">';
                echo '<datalist id="appareils">';
                echo '<option value=" ">';
                $sql = mysqli_query($conn, "SELECT DISTINCT appareil FROM appareil order by appareil");
                while ( ($row = mysqli_fetch_assoc($sql)) ) {
                    echo '<option value="'.$row['appareil'].'">'.$row['appareil'].'</option>';
                }
                echo '</datalist>';
                echo '</input>';

?>

                    </div>

                    <div class="form-group">
                        <h3>Objectif</h3>
                       <?php
                       
                // Affichage des sites sur liste
                echo '<input list="objectifs" name="objectif" id="objetif">';
                echo '<datalist id="objectifs">';
                echo '<option value=" " >';
                $sql = mysqli_query($conn, "SELECT DISTINCT objectif FROM appareil order by objectif");
                while ( ($row = mysqli_fetch_assoc($sql)) ) {
                    echo '<option value="'.$row['objectif'].'">'.$row['objectif'].'</option>';
                }
                echo '</datalist>';
                mysqli_close($conn);
                echo '</input>';

?>

                    </div>

                    <div class="form-group">
                        <h3>Description</h3>
                        <textarea class="form-control" id="description" name="description" rows="5" cols="100"></textarea>
                        
                    </div>

                    <button type="submit" class="btn btn-primary">Publier</button>
                    


                </form>



			</article>
			<!-- /Article -->
			

		</div>
	</div>	<!-- /container -->

</body>

<?php include "inc\jooter.php" ?>