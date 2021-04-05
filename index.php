<?php include "inc\header.php";
?>

<?php 
// if (empty($_GET['login']) && empty($_SESSION['login'])) {
//     header('Location: signin.php');
//     die;
// } 
?>
<body>
	<!-- Intro -->
	<div class="container text-center">
		<h2 class="thin">LibPhoto est l'application qui permet de partager ses posts photos et voir les commentaire etc.</h2>
		<p class="text-muted">
			Consultez les posts ou bien ajoutez les vôtres afin de pouvoir partager vos avis sur vos posts favoris! 
		</p>
	</div>
		
	<!-- Highlights - jumbotron -->
	<div class="jumbotron">
		<div class="container">
			
			<h3 class="text-center thin">Dernier post photo</h3>

			<?php
			$result = $pdo->query("SELECT p.id,image,description,date_publication,id_appareil,login
                                    FROM `post` as p JOIN appareil as a on p.id_appareil = a.id
                                    JOIN users as u on p.id_user = u.id
                                    ORDER BY date_publication DESC
                                    LIMIT 10");
            while ($data = $result->fetch(PDO::FETCH_OBJ)) {
			?>
			
				<div class="col-md-6 mb-4 highlight">
					<div class="h-body text-center">
						<form method="POST" action="detailpost.php">
						<input type="hidden" name="id" value=' <?php echo $data->id; ?>'>
						<img src="<?php echo $data->image ?>" alt="img_bdd" class="img-responsive">
						<article>
                            Description :<?php echo substr($data->description, 0,220). "..."; ?>
						</article>
                        <p>
						    Publié par : <?php echo $data->login; ?>
                        </p>
                        <small> Le : <?php echo $data->date_publication; ?> </small>
						<p>
						<input type="submit" class="btn btn-primary" value="Regarder ce post">
                        </p>
						</form>
					</div>
				</div>


			<?php

			}

			?>

		
		</div>
	</div>	


</body>

<?php include "inc\jooter.php" ?>