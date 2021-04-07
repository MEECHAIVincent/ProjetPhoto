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
					<div class="card">
						<a href="detailpost.php">
							<!-- Image à la une -->
							<div class="card-image"><img src="<?php echo $data->image; ?>" alt="img_bdd" /></div>
							<!-- Fin de l'image à la une -->

							<!-- Corp de notre carte -->
							<div class="card-body">

								<!-- Date de publication de l'article-->
								<div class="card-date">
									<p> Le :
										<?php
											echo date('d-m-Y',strtotime($data->date_publication));
										?>
									</p>
								</div>

								<!-- Titre de l'article -->
								<div class="card-title">
									<h3>Publié par : <?php echo $data->login; ?></h3>
								</div>
								<!-- Extrait de l'article -->
								<div class="card-excerpt">
									<p> Description : <?php echo substr($data->description, 0,220). "..."; ?></p>
								</div>

							</div>
							<!-- Fin du corp de notre carte -->
						</a>
					</div>
				</div>


			<?php

			}

			?>

		
		</div>
	</div>	


</body>

<?php include "inc\jooter.php" ?>