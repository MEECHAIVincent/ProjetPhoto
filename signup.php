
<?php include "inc\header.php" ?>

<body> 

	<!-- container -->
	<div class="container">

		<!-- <ol class="breadcrumb">
			<li><a href="index.php">Accueil</a></li>
			<li class="active">Inscription</li>
		</ol> -->



		<?php //Page d'inscription 

if (isset($_REQUEST['login'], $_REQUEST['nom'], $_REQUEST['mdp'], $_REQUEST['prenom'], $_REQUEST['email'], $_REQUEST['date_naissance'])){
	// récupére le nom d'utilisateur et supprime les antislashes ajoutés par le formulaire
	$login = stripslashes($_REQUEST['login']);
	$login = mysqli_real_escape_string($conn, $login); 
	// récupére le nom et supprime les antislashes ajoutés par le formulaire
	$nom = stripslashes($_REQUEST['nom']);
	$nom = mysqli_real_escape_string($conn, $nom);
	// récupére le mot de passe et supprime les antislashes ajoutés par le formulaire
	$mdp = stripslashes($_REQUEST['mdp']);
    $mdp = mysqli_real_escape_string($conn, $mdp);
    // récupére le prénom et supprime les antislashes ajoutés par le formulaire
	$prenom = stripslashes($_REQUEST['prenom']);
    $prenom = mysqli_real_escape_string($conn, $prenom);
	// récupére le mail et supprime les antislashes ajoutés par le formulaire
	$email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($conn, $email);
	// récupére la date_naissance et supprime les antislashes ajoutés par le formulaire
	$date_naissance = stripslashes($_REQUEST['date_naissance']);
	$date_naissance = mysqli_real_escape_string($conn, $date_naissance);

	// récupére la date_naissance et supprime les antislashes ajoutés par le formulaire
	// $photo = $_POST['photo'];
	// $file_name = $_FILES[`$photo`]['name'];
	// var_dump($file_name);
    // $file_extension = strchr($file_name, ".");
    // $file_tmp_name = $_FILES[`$photo`]['tmp_name'];
    // $file_dest ="assets/profile/".$file_tmp_name;
	// var_dump($file_dest);

    // $extensions_autorisees = array('.jpg', '.jpeg', '.gif', '.png' );
    // move_uploaded_file($file_tmp_name, $file_dest );

	//requéte SQL + mot de passe crypté
    $query = "INSERT into `users` (login, nom, mdp, prenom, email, date_naissance, admin)
              VALUES ('$login' , '$nom', '".hash('sha256', $mdp)."', '$prenom', '$email', '$date_naissance', 0)";
	// Exécute la requête sur la base de données
    $res = mysqli_query($conn, $query);
    if($res){ ?>

				<ol class="breadcrumb">
					<li><a href="index.php">Accueil</a></li>
					<li><a href="signin.php">Connexion</a></li>
					<li class="active">Inscription</li>
				</ol>

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
							<p class="text-center text-muted">Entrez vos informations pour vous connecter. </p>
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
									<label>Date de naissance<span class="text-danger">*</span></label>
									<input type="date" name="date_naissance" class="form-control">
								</div>

								<div class="top-margin">
									<label>Email<span class="text-danger">*</span></label>
									<input type="email" name="email" class="form-control">
								</div>

								<div class="top-margin">
										<label>Mot de passe <span class="text-danger">*</span></label>
										<input type="password" name="mdp" class="form-control">
								</div>
<!-- 
								<div class="form-group">
                        				<h3>Photo</h3>
										<label for="myfile">Selectionnez une photo</label>
										<input type="file" id="photo" name="photo"><br><br>
								</div> -->
								<hr>

								<div class="row">
									<div class="col-lg-8">
										<b><a href="signin.php">Déjà inscrit?</a></b>
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

		<ol class="breadcrumb">
			<li><a href="index.php">Accueil</a></li>
			<li><a href="signin.php">Connexion</a></li>
			<li class="active">Inscription</li>
		</ol>

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
							<p class="text-center text-muted">Entrez vos informations pour vous connecter. </p>
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
									<label>Date de naissance<span class="text-danger">*</span></label>
									<input type="date" name="date_naissance" class="form-control">
								</div>

								<div class="top-margin">
									<label>Email<span class="text-danger">*</span></label>
									<input type="email" name="email" class="form-control">
								</div>

								<div class="top-margin">
									
										<label>Mot de passe <span class="text-danger">*</span></label>
										<input type="password" name="mdp" class="form-control">
								
								</div>

								<!-- <div class="form-group">
                        				<h3>Photo</h3>
										<label for="myfile">Selectionnez une photo</label>
										<input type="file" id="photo" name="photo"><br><br>
								</div> -->

								<hr>

								<div class="row">
									<div class="col-lg-8">
										<b><a href="signin.php">Déjà inscrit?</a></b>
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
