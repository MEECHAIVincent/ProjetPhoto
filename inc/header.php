<?php
//require 'connect.php';
	// Initialiser la session
        session_start();
        
?>


<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>CYNOV</title>

	<link rel="shortcut icon" href="assets/images/gt_favicon.png">
	
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen" >
	<link rel="stylesheet" href="assets/css/main.css">
        <script type="text/javascript" src="JQUERY/jquery-3.1.1.js"></script>
        
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.js"></script>
	<script src="assets/js/respond.min.js"></script>
    <![endif]-->
    	<!-- Fixed navbar -->
        
        <?php 
// if (isset($_SESSION['login'])){       
//        $bdd = getBdd();
//        $userid = $_SESSION['login'];
//        $sqli = mysqli_query($bdd, "SELECT admin FROM user WHERE login='$userid' ");
//        $result = mysqli_fetch_assoc($sqli);
//        $idadmin = $result['admin'];
//        //statut admin
//        if ($idadmin=="0") {
?>
	<div class="navbar navbar-inverse navbar-fixed-top headroom" >
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="index.php"><img src="assets/images/logo.svg" alt="Progressus HTML5 template"></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right">
					<li><a href="index.php">Accueil</a></li>
					<li><a href="nvarticle.php">Nouvel article</a></li>
					<li><a href="allarticles.php">Articles</a></li>
					
					<?php
						if (isset($_SESSION['login']) && !empty($_SESSION['login']) && $_SESSION['admin']==0 ){?>
                                                                
								<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Mon compte<b class="caret"></b></a>
									<ul class="dropdown-menu">
											<li><a href="profile.php">Mes informations</a></li>
											
									</ul>
								</li>
							    
								<li><a class="btn" href="logout.php">Déconnexion</a></li>
								
                                        <?php  }else if (isset($_SESSION['login']) && !empty($_SESSION['login'])&& $_SESSION['admin']==1) {	?>
                                                                <li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Administration<b class="caret"></b></a>
									<ul class="dropdown-menu">
											<li><a href="gestionuser.php">Gestion utilisateur</a></li>
                                                                                        <li><a href="gestionarticle.php">Gestion article</a></li>
											
									</ul>
								</li>
                                                                <li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Mon compte<b class="caret"></b></a>
									<ul class="dropdown-menu">
											<li><a href="profile.php">Mes informations</a></li>
											
									</ul>
								</li>
							    
								<li><a class="btn" href="logout.php">Déconnexion</a></li>

					<?php	} else {?>
						<li><a class="btn" href="signin.php">Connexion / Inscription</a></li>
							

					<?php	}






					?>
					
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div> 
	<!-- /.navbar -->
            <?php // } 
        
// }
        ?>
	<header id="head" class="secondary"></header>
</head>
<?php include "data\data.php" ?>