<?php include "inc\header.php" ;?>


<?php
if (empty($_GET['login']) && empty($_SESSION['login'])) {
    header('Location: signin.php');
    die;
}?>




	<!-- container -->
	<div class="container">
    <div class="article">
    <article class="col-sm-8 mainarticle">

		

			<!-- Article main article -->

                            
            <!-- Récuppérer l'id de l'article de la page précédente -->
            <?php
                    if(isset($_POST["id"]) && !empty($_POST["id"])) {   
                        $id = $_POST["id"];   
            //            echo "id: ".$id."<br/>";  
                    } 
                    else {
                        echo"Pas de id <br/>";
                    }
                    $comment = null;

            
            // <!-- récupérations des valeurs -->
            

            $requete2 = $pdo->query("SELECT distinct image,p.id,description,login, appareil,objectif, DATE_FORMAT(date_publication,'%d/%m/%Y')as publication 
                                    FROM `post` as p JOIN appareil as a on p.id_appareil = a.id
                                    JOIN users as u on p.id_user = u.id
                                    where p.id='$id' ");
            while ($data = $requete2->fetch(PDO::FETCH_OBJ)) {
            // <!-- affichage des valeurs  -->
            echo '
                <div style="font-size: large; display: inline-flex" >                        
                    <div>    
                        <img style="width: 300px; float:left; padding-right: 15px; clear:left"  src="'.$data->image.'"/>
                    </div>
                    <div>
                        <p> <b> Publié par: </b>'.$data->login.'</p> 
                        <p> <b>Date de sortie: </b>'.$data->publication.'</p>
                        <p> <b>Appareil utilisé: </b>'.$data->appareil.'</p>
                        <p> <b>Objectif utilisé: </b>'.$data->objectif.'</p>
                            <!-- AddToAny BEGIN -->
                            <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                            <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                            <a class="a2a_button_facebook"></a>
                            <a class="a2a_button_twitter"></a>
                            <a class="a2a_button_email"></a>
                            </div>
                            <script async src="https://static.addtoany.com/menu/page.js"></script>
                            <!-- AddToAny END -->
                    </div>
                </div>

                <section>
                <h2><b>Description</b></h2>
                <div>
                <p> '.$data->description. '</p>

                </div>
                </section>

            ';
            }
            
                //Espace Commentaire
            echo '<div ><h2><b>Commentaire</b></h2></div>';

                //Ajouter un commentaire
                
                    //Text Area pour le commentaire
                    //Après avoirs cliqué sur le bouton submit on revient sur la meme page
            echo'
            <form action="detailpost.php" method="POST"enctype=" multipart/form-data">
            <div class="form-group">
                <input type="hidden" name="id" value='.$_POST["id"].'>
                <textarea class="form-control" name="comment" required></textarea>
            <input class="btn btn-warning" type="submit" action="article.php" value="Ajouter un commentaire" >
            
            </div>
            </form>';

            

            //récup de l'id de l'user courrant
            $login = $_SESSION['login'];
            $requete = mysqli_query($conn,"SELECT id from users  where login='$login'");;
            $data = mysqli_fetch_assoc($requete);
            $aut = $data['id'];

            //récup du nom de l'user courrant
            
            $requete2 = mysqli_query($conn,"SELECT login from users  where login='$login'");;
            $data2 = mysqli_fetch_assoc($requete2);
            $autnom = $data2['login'];
            
            //récupére le commentaire de la texte area
            if(isset($_POST["comment"]) && !empty($_POST["comment"])) {   
                $comment = $_POST["comment"] ;
                $comment = addslashes($comment);

                // requete pour exécuter la commande insert 
                $req = $pdo->exec("INSERT into commentaire (id_post, id_user, user_nom, publication, commentaire ) values ( '$id','$aut', '$autnom',CURRENT_TIMESTAMP,'$comment')");
            }






            
            


            //$com_insert = "INSERT into commentaire(user, article, commentaire, date_publication, ) values(?,?,?,CURRENT_TIMESTAMP)";  
            //$com_resultat = mysqli_prepare($conn, $com_insert);

            //mysqli_stmt_bind_param($com_resultat,$aut,$comment);
            //mysqli_stmt_execute($com_resultat);
            
            //echo $com_resultat;






                // Affichage des commentaires BLOQUE ???
            
//            $com_req = mysqli_query($conn, "SELECT distinct user,article,commentaire, (date_publication,'%d/%m/%Y')as publication FROM commentaire where id_article='$id' order by publication desc ");





            $result = $pdo->query("SELECT * FROM commentaire where id_post='$id' order by publication desc ");

            while  ($com = $result->fetch(PDO::FETCH_OBJ)) {

                echo '
                <div style="border: 1px solid ; margin: 10px 0 10px 0; ">
                <p>'.$com->user_nom. '</p>
                <p>'.$com->publication. '</p>
                <p>'.$com->commentaire. '</p>
                </div>
                ';
            }






            $com_req = mysqli_query($conn, "SELECT all FROM commentaire where id_article='$id' order by publication desc ");

            
            
            
            mysqli_close($conn);          
            ?>
            
        </div>
    </div>
</body>


<?php include "inc\jooter.php" ?> 