<?php include "inc\header.php";?>

<?php


if (empty($_GET['login']) && empty($_SESSION['login'])) {
    header('Location: index.php');
    die;
}

$login = $_SESSION['login'];

$requete = mysqli_query($conn, "SELECT id from users  where login='$login'");
$data = mysqli_fetch_assoc($requete);
$aut = $data['id'];

//Récupérer les infos du profil et les modifier
if (isset($_POST['newnom']) and !empty($_POST['newnom']) and isset($_POST['newnom'])) {
    $newnom = htmlspecialchars($_POST['newnom']);
    $pdo->query("UPDATE users SET nom = '$newnom' WHERE id = '$aut' ");

    header('Location: profile.php');
}

if (isset($_POST['newprenom']) and !empty($_POST['newprenom']) and isset($_POST['newprenom'])) {
    $newprenom = htmlspecialchars($_POST['newprenom']);
    $pdo->query("UPDATE users SET prenom = '$newprenom' WHERE id = '$aut'");

    header('Location: profile.php');
}

if (isset($_POST['newemail']) and !empty($_POST['newemail']) and isset($_POST['newemail'])) {
    $newemail = htmlspecialchars($_POST['newemail']);
    $pdo->query("UPDATE users SET email = '$newemail' WHERE login = '" . $_SESSION['login'] . "'");

    header('Location: profile.php');
}

if (isset($_POST['newdate_naissance']) and !empty($_POST['newdate_naissance']) and isset($_POST['newdate_naissance'])) {
    $newdate_naissance = htmlspecialchars($_POST['newdate_naissance']);
    $pdo->query("UPDATE users SET date_naissance = '$newdate_naissance' WHERE login = '" . $_SESSION['login'] . "'");

    header('Location: profile.php');
}

if (isset($_POST['newmdp']) and !empty($_POST['newmdp']) and isset($_POST['newmdp']) and $_POST['newmdp'] == $_POST['confirm']) {

    $newmdp = stripslashes($_POST['newmdp']);
    $pdo->query("UPDATE users SET mdp = '" . hash('sha256', $newmdp) . "' WHERE id= '$aut' ");

    header('Location: profile.php');
}   



$result = $pdo->query("SELECT * FROM users WHERE login = '" . $_SESSION['login'] . "'");
    while ($users = $result->fetch(PDO::FETCH_OBJ)) {
?>

<body>
	

	<!-- container -->
	<div class="container">
		
		<ol class="breadcrumb">
			<li><a href="index.php">Accueil</a></li>
			<li class="active">Mes informations</li>
		</ol>

		
        <div class="row">
			
			<!-- Article main content -->
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">Modifier Mon profil</h1>
				</header>
				
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<form action="" method="post">
								<div class="top-margin">
									<label>Nom: </label>
									<input type="text" name="newnom" class="form-control" placeholder="<?php echo $users->nom ?>">
								</div>

								<div class="top-margin">
									<label>Prénom: </label>
									<input type="text" name="newprenom" class="form-control" placeholder="<?php echo $users->prenom ?>">
								</div>

								<div class="top-margin">
									<label>Date de naissance: </label>
									<input type="date" name="newdate_naissance" class="form-control" value="<?php echo $users->date_naissance ?>">
								</div>

								<div class="top-margin">
									<label>Email</label>
									<input type="email" name="newemail" class="form-control" placeholder="<?php echo $users->email ?>">
								</div>

								<div class="top-margin">
										<label>Mot de passe: </label>
										<input type="password" name="newmdp" class="form-control">
								</div>
                                <div class="top-margin">
										<label>Confirmez votre Mot de passe: </label>
										<input type="password" name="confirm" class="form-control">
								</div>

								<hr>

								<div class="row">
									<div class="col-lg-4">
										<center><button class="btn btn-action" type="submit">Modifier mes informations</button></center>
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
             ?>
	</div>	<!-- /container -->


	


</body>

<?php include "inc\jooter.php" ?>