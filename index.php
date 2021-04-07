<?php include "inc\header.php";
?>

<body>
	<!-- Intro -->
	<div class="container text-center">
		<h2>LibPhoto est l'application qui permet de partager ses posts photos et voir les commentaire etc.</h2>
		<p class="text-muted">
			Consultez les posts ou bien ajoutez les vôtres afin de pouvoir partager vos avis sur vos posts favoris! 
		</p>
		<hr/>
		<form action="" method="post">
			<select class="form-control" name="type">
				<?php $result = $pdo->query("SELECT * FROM appareil");
				while ($appareil = $result->fetch(PDO::FETCH_OBJ)) { ?>
					<option name="appareil" value="<?php echo $appareil->id ?>"><?php echo $appareil->appareil ?></option>
				<?php } ?>
			</select>
			<br>

			<div style="text-align: center">
				<button class="btn btn-success">Rechercher la catégorie</button>
			</div>

		</form>
	</div>
	<br>
	<!-- Highlights - jumbotron -->
	<div class="jumbotron">
		<div class="container">
			
			<h3 class="text-center thin">Dernier post photo</h3>


			<?php
			if (isset($_POST['type'])) {
				$appareil = $_POST['type'];
				$result = $pdo->query("SELECT *  FROM `post` as p JOIN appareil as a on p.id_appareil = a.id JOIN users as u on p.id_user = u.id  WHERE p.id_appareil = '$appareil'   ");
            while ($data = $result->fetch(PDO::FETCH_OBJ)) {
			?>
				<div class="col-md-6 mb-4 highlight">
					<div class="card">
						
						<form method="POST" action="detailpost.php">
							<input type="hidden" name="id" value=' <?php echo $data->id; ?>'>
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

								<div class="card-title">
									<input type="submit" class="btn btn-primary" value="Regarder ce post">
								</div>	

								<!-- AddToAny BEGIN -->
								<div class="a2a_kit a2a_kit_size_32 a2a_default_style" style="background-color: grey; padding-left:auto; padding-right:auto; margin-bottom: 10px;" >
									<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
									<a class="a2a_button_facebook "></a>
									<a class="a2a_button_twitter"></a>
									<a class="a2a_button_email"></a>
								</div>
								<script async src="https://static.addtoany.com/menu/page.js"></script>
                            	<!-- AddToAny END -->

									

							</div>
							<!-- Fin du corp de notre carte -->
						</form>
					</div>
				</div>


			<?php
			}

			} else {
				$result = $pdo->query("SELECT p.id,image,description,date_publication,id_appareil,login
				FROM `post` as p JOIN appareil as a on p.id_appareil = a.id
				JOIN users as u on p.id_user = u.id
				ORDER BY date_publication DESC
				LIMIT 10");
				while ($data = $result->fetch(PDO::FETCH_OBJ)) {
			?>

					<div class="col-md-6 mb-4 highlight">
						<div class="card">
						
							<form method="POST" action="detailpost.php">
								<input type="hidden" name="id" value=' <?php echo $data->id; ?>'>
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

								<div class="card-title">
									<input type="submit" class="btn btn-primary" value="Regarder ce post">
								</div>	

								<!-- AddToAny BEGIN -->
								<div class="a2a_kit a2a_kit_size_32 a2a_default_style" style="background-color: grey; padding-left:auto; padding-right:auto; margin-bottom: 10px;" >
									<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
									<a class="a2a_button_facebook "></a>
									<a class="a2a_button_twitter"></a>
									<a class="a2a_button_email"></a>
								</div>
								<script async src="https://static.addtoany.com/menu/page.js"></script>
								<!-- AddToAny END -->

										

								</div>
									<!-- Fin du corp de notre carte -->
							</form>
						</div>
					</div>
			<?php
				}
			}

			?>

		
		</div>
	</div>	


</body>

<?php include "inc\jooter.php" ?>