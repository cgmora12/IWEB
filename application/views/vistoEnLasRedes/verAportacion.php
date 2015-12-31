<!DOCTYPE html>
<html>

	<head>
		<title>Aportación <?php echo $idAportacion; ?> - Visto en las redes</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<meta charset="UTF-8">

		<!-- Include de JQuery -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include de bootstrap -->
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


		<!-- Script de JQuery -->
		<script type="text/javascript">

			$(document).ready(function() {
				$("#errComentar").hide();				
				
				$("#formComentar").submit(function(e) {
					var elComentario = $("#comentario").val();

					if(elComentario == "") {
						e.preventDefault();
						$("#errComentar").show();
						$("#errComentar").focus();
						$("#comentario").addClass("error");
					}
				});

				$("#comentario").change(function() {
					if($(this).val() != "") {
						$("#errComentar").hide();
						$("#comentario").removeClass("error");
					}
				});
			});
		</script>

		<style>
			.error { color: red; }
			.obligatorio { color: red; }
		</style>
	</head>

	<body>
		<header class="container">
			<h1> <?php echo $aportacion->titulo; ?></h1>
		</header>

		<main class="container">
			<!-- La aportación en sí -->
			<div id="datosAportacion">
				<p>
					Enviado por <a href="#"><?php echo $aportacion->creadorUserName; ?></a>
					el <?php echo $aportacion->fecha; ?>
				</p>

				<img src="<?php echo $aportacion->imagenUrl; ?>" alt="<?php echo "Aportación " . $idAportacion; ?>" style="max-width:600px; max-height:600px;">

				<br>
				<br>
				<p>
					<span class="glyphicon glyphicon-globe"></span>
					Vía: 
					<a href="<?php echo $aportacion->fuenteUrl; ?>">
						<?php echo $aportacion->fuenteUrl; ?>
					</a>
				</p>
				<p>
					<span class="glyphicon glyphicon-bookmark"></span>
					Categoría: 
					<a href="<?php echo $aportacion->nombreCategoria; ?>">
						<?php echo $aportacion->nombreCategoria; ?>
					</a>
				</p>
				<p>
					<span class="glyphicon glyphicon-tag"></span>
					Etiquetas: 
					
					<?php 
						$i = 1;
						foreach($listaEtiquetas as $etiqueta) {
					?>
							<a href="<?php echo $etiqueta->etiquetaValor; ?>">
					<?php
							if($i == $numEtiquetas) {
								echo $etiqueta->etiquetaValor;
							}
							else {
								echo $etiqueta->etiquetaValor . ",";
							}
					?>
							</a>
					<?php
						$i++;
						}
					?>
				</p>
				<br>
				<p>
					<a href="<?php echo $idAportacion; ?>/reportarAportacion">Reportar por inapropiado</a> 
				</p>
				<br>
			</div>


			<!-- Los comentarios de la aportación -->
			<div id="comentariosAportacion">
				<legend>Comentarios</legend>
				<?php 
					if($numComentarios == 0) {
				?>
						La aportación aún no tiene ningún comentario.
						<br>
						<br>
				<?php
					}
					else {
						$i = 1;
						foreach($listaComentarios as $comentario) {
				?>
							<div class="alert alert-info" id="<?php echo 'comentario' . $i; ?>">
				<?php
									echo '<b>#' . $i . '</b>';
									echo '<br> <b>Autor:</b> ';
				?>
									<a href="#">
										<?php echo $comentario->autorUserName; ?>
									</a>
				<?php
									echo '<br><b>Fecha:</b> ' . date('d-m-Y', strtotime($comentario->fecha));
				?>
									<p style="color: black">
				<?php
									echo '<br><b>Comentario:</b><br>' . $comentario->cuerpo;
				?>
									</p>
								</p>
							</div>
					<?php
						$i++;
						}
					}
				?>
			</div>


			<!-- El formulario para comentar la aportación -->
			<div id="divComentarSinLoguear">
				<legend>Deje su comentario</legend>
				<div>
					<p>
						Necesita estar logueado en la web para poder comentar aportaciones.
					</p>
					<br>
					<a href="/iweb/index.php/vistoEnLasRedes/login">¿Ya tiene una cuenta? Haga login</a>
					<br>
					<br>
					<a href="/iweb/index.php/vistoEnLasRedes/registro">¿Aún no tiene una cuenta? Regístrese</a>
				</div>
			</div>

			<div id="divComentarLogueado">
				<legend>Deje su comentario</legend>
				<div>
					<p>
						Intente ser respetuoso, educado y no dar patadas al diccionario.
					</p>
					<p>
						No cumplir con las normas puede implicar la expulsión de la página. Cuesta muy poco ser vulgar, pero algo más ser ingenioso.
					</p>
					<p>
						Está logueado como <a href="#"><?php echo $this->session->userdata('usuarioLogueado'); ?></a>
					</p>
				</div>

				<form class="form" role="form" method="POST" action="<?php echo $idAportacion; ?>/comentarAportacion" name="formComentar" id="formComentar">

					<div class="form-group">
						<label class="control-label" for="comentario">Su comentario:</label>
						<span class="obligatorio">(*)</span>
						<textarea class="form-control" rows="3" name="comentario" id="comentario" placeholder="Su Comentario"></textarea>

						<div id="errComentar" class="alert alert-danger">
							Debe introducir algo en su comentario.
						</div>
					</div>

					<div class="form-group">
						<input class="btn btn-primary" type="submit" value="Enviar comentario">
					</div>
				</form>

				<div id="info" class="alert alert-info">
					<p class="obligatorio">(*): Campo obligatorio</p>
				</div>
			</div>

			<?php 
				if($this->session->userdata('usuarioLogueado')) {
			?>
					<script type="text/javascript">
						$('#divComentarSinLoguear').hide();
						$('#divComentarLogueado').show();
					</script>
			<?php
				}
				else {
			?>
					<script type="text/javascript">
						$('#divComentarSinLoguear').show();
						$('#divComentarLogueado').hide();
					</script>
			<?php
				}
			?>
		</main>
	</body>
</html>