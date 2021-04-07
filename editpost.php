<?php include "inc\header.php";?>

<?php


if (empty($_GET['login']) && empty($_SESSION['login'])) {
    header('Location: index.php');
    die;
}
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $requete = mysqli_query($conn, "SELECT * from post where id='$id'");
    $data = mysqli_fetch_assoc($requete);
    
    
    //Récupérer les infos du profil et les modifier
    if (isset($_POST['newdescription']) and !empty($_POST['newdescription']) and isset($_POST['newdescription'])) {
        $newdescription = htmlspecialchars($_POST['newdescription']);
        $pdo->query("UPDATE post SET description = '$newdescription' WHERE id ='$id' ");
        
        header('Location: editpost.php');
    }
    
    $result = $pdo->query("SELECT * from post where id=$id");
    while ($post = $result->fetch(PDO::FETCH_OBJ)) {
        ?>

<body>
	
    
	<!-- container -->
	<div class="container">
        
        <ol class="breadcrumb">
			<li><a href="index.php">Accueil</a></li>
            <li><a href="profile.php">Profile</a></li>
			<li class="active">Modifier le post</li>
		</ol>

		
        <div class="row">
			
            <!-- Article main content -->
			<article class="col-xs-12 maincontent">
				<header class="page-header">
                    <h1 class="page-title">Modifier le post</h1>
				</header>
				
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
                        <div class="panel-body">
							<form action="" method="post">
                                <input type="hidden" name="id" value=' <?php echo $post->id; ?>'>
                                <div class="top-margin">
                                    <img src="<?php echo $post->image ?>" style="width:20rem">
								</div>
                                
								<div class="top-margin">
                                    <label>Description: </label>
									<input type="text" name="newdescription" class="form-control" placeholder="<?php echo $post->description ?>">
								</div>

								<hr>

								<div class="row">
                                    <div class="col-lg-4">
                                        <center><button class="btn btn-action" type="submit">Modifier le post</button></center>
									</div>
								</div>
							</form>
						</div>
					</div>

				</div>
				
			</article>
			<!-- /Article -->
		</div>
        
			 <?php
            }
    } else {
        header('Location: profile.php');

    }
             ?>
	</div>	<!-- /container -->


	


</body>

<?php include "inc\jooter.php" ?>