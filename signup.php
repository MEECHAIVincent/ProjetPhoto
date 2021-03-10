
<?php include "inc\header.php" ?>

<body> 

	<!-- container -->
	<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.php">Accueil</a></li>
			<li class="active">Inscription</li>
		</ol>



		<?php //Page d'inscription 

if (isset($_REQUEST['login'], $_REQUEST['nom'], $_REQUEST['mdp'], $_REQUEST['prenom'])){
	// récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
	$login = stripslashes($_REQUEST['login']);
	$login = mysqli_real_escape_string($conn, $login); 
	// récupérer l'nom et supprimer les antislashes ajoutés par le formulaire
	$nom = stripslashes($_REQUEST['nom']);
	$nom = mysqli_real_escape_string($conn, $nom);
	// récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
	$mdp = stripslashes($_REQUEST['mdp']);
    $mdp = mysqli_real_escape_string($conn, $mdp);
    // récupérer le téléphone et supprimer les antislashes ajoutés par le formulaire
	$prenom = stripslashes($_REQUEST['prenom']);
    $prenom = mysqli_real_escape_string($conn, $prenom);

	//requéte SQL + mot de passe crypté
    $query = "INSERT into `users` (login, nom, mdp, prenom)
              VALUES ('$login', '$nom', '".hash('sha256', $mdp)."', '$prenom')";
	// Exécute la requête sur la base de données
    $res = mysqli_query($conn, $query);
    if($res){



			 
			 ?>
				<div class="alert alert-success">
					<b>Votre inscription est réussi.</b> 
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				</div>


				<div class="row">
			
			<!-- Article main content -->
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">Inscription</h1>
				</header>
				
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">S'inscrire</h3>
							<p class="text-center text-muted">Vous êtes déjà inscrit? Connectez vous dès maintenant <a href="signin.php">ici</a> . </p>
							<hr>

							<form action="" method="post">
								<div class="top-margin">
									<label>Pseudo<span class="text-danger">*</span></label>
									<input type="text" name="login" class="form-control">
								</div>
								<div class="top-margin">
									<label>Nom <span class="text-danger">*</span></label>
									<input type="text" name="nom" class="form-control">
								</div>

								<div class="top-margin">
									<label>Prénom<span class="text-danger">*</span></label>
									<input type="text" name="prenom" class="form-control">
								</div>

								<div class="top-margin">
									
										<label>Mot de passe <span class="text-danger">*</span></label>
										<input type="password" name="mdp" class="form-control">
								
								</div>

								<hr>

								<div class="row">
									<div class="col-lg-8">
										<label class="checkbox">
											<input type="checkbox"> 
											J'ai lu et j'accepte les <a href="page_terms.html">termes et conditions</a>
										</label>                        
									</div>
									<div class="col-lg-4 text-right">
										<button class="btn btn-action" type="submit">S'inscrire</button>
										
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
}else{ 
?>

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">Inscription</h1>
				</header>
				
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">S'inscrire</h3>
							<p class="text-center text-muted">Vous êtes déjà inscrit? Connectez vous dès maintenant <a href="signin.php">ici</a> . </p>
							<hr>

							<form action="" method="post">
								<div class="top-margin">
									<label>Pseudo<span class="text-danger">*</span></label>
									<input type="text" name="login" class="form-control">
								</div>
								<div class="top-margin">
									<label>Nom <span class="text-danger">*</span></label>
									<input type="text" name="nom" class="form-control">
								</div>

								<div class="top-margin">
									<label>Prénom<span class="text-danger">*</span></label>
									<input type="text" name="prenom" class="form-control">
								</div>

								<div class="top-margin">
									
										<label>Mot de passe <span class="text-danger">*</span></label>
										<input type="password" name="mdp" class="form-control">
								
								</div>

								<hr>

								<div class="row">
									<div class="col-lg-8">
										<label class="checkbox">
											<input type="checkbox"> 
											J'ai lu et j'accepte les <a href="page_terms.html">termes et conditions</a>
										</label>                        
									</div>
									<div class="col-lg-4 text-right">
										<button class="btn btn-action" type="submit">S'inscrire</button>
										
									</div>
								</div>
							</form>
						</div>
					</div>

				</div>
				
			</article>
			<!-- /Article -->
		</div>

<?php } ?>
	</div>	<!-- /container -->


	

	

</body>



<?php include "inc\jooter.php" ?>
