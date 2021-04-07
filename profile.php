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
                        <img style="max-width: 20rem; float:left; padding-right: 15px; clear:left"  src="<?php echo $user->img; ?>"/>
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
		<table class="profile--post">
			<thead>
				<tr>
					<th>Image</th>
					<th>Description</th>
					<th>Appareil</th>
					<th>Objectif</th>
					<th>Action</th>
				</tr>
			</thead>
				<tbody>
					<?php
				}
				$requete = $pdo->query("SELECT p.id as id, image, description, appareil, objectif FROM post as p JOIN appareil as a ON p.id_appareil=a.id WHERE p.id_user = $aut");
				while ($posts = $requete->fetch(PDO::FETCH_OBJ)) {
				?>
					<tr>
						<td>
							<img src="<?php echo $posts->image ?>" style="width: 20rem;">
						</td>
						<td><?php echo $posts->description ?></td>
						<td><?php echo $posts->appareil?></td>
						<td><?php echo $posts->objectif?></td>
						<td>
							<form action="editpost.php" method="POST">
								<input type="hidden" name="id" value=' <?php echo $posts->id; ?>'>
								<input type="submit" class="btn btn-primary" value="Modifier">
							</form>
							<br/>
							<form action="deletepost.php" method="POST">
								<input type="hidden" name="id" value=' <?php echo $posts->id; ?>'>
								<input type="submit" class="btn btn-danger" value="Supprimer">
							</form>
						</td>
					</tr>
					</tbody>
				<?php
					}
				?>
			</table>


	</div>	<!-- /container -->


	


</body>

<?php include "inc\jooter.php" ?>