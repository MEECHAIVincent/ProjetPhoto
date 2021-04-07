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
} else if(isset($_POST['newmdp']) and !empty($_POST['newmdp']) and isset($_POST['newmdp']) and $_POST['newmdp'] != $_POST['confirm']) { 
	echo 'Vos mdp ne correspondent pas';
	
	header('Location: profile.php');
}

$result = $pdo->query("SELECT * FROM users WHERE login = '" . $_SESSION['login'] . "'");
    while ($user = $result->fetch(PDO::FETCH_OBJ)) {
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
					<h1 class="page-title">Mes informations</h1>
				</header>
				<div>    
                        <img style="width: 300px; float:left; padding-right: 15px; clear:left"  src="<?php echo $user->img; ?>"/>
                </div>
                <div>
                    <p> <b> nom: </b><?php echo $user->nom; ?></p> 
                    <p> <b> prenom: </b><?php echo $user->prenom; ?></p>
                    <p> <b> email: </b><?php echo $user->email; ?></p>
                    <p> <b> date de naissance: </b><?php echo date('d-m-Y',strtotime($user->date_naissance)); ?></p>
                    <p> <b> inscrit depuis le: </b><?php echo date('d-m-Y',strtotime($user->inscription)); ?></p>

                </div>
				<div>
					<a href="editprofile.php" class="btn btn-primary">Modifer</a>
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