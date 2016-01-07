<?php
	$this->load->view('inc/cabecera.php');
?>


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

<main class="container" style="background-color: white;background-clip:content-box; ">


	<?php if($this->session->flashdata('añadir') != null){ ?>
		
		<div class="alert alert-info">
			<?php echo $this->session->flashdata('añadir'); ?>
		</div>
	<?php } ?>
	<h1 style="margin-left: 40px;"> <?php echo $aportacion->titulo; ?></h1>
	
	<!-- La aportación en sí -->
	<div style="margin-left: 40px;" id="datosAportacion">
		<p style="margin-left:20px;">

			Enviado por <a href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/perfil/<?php echo $aportacion->creadorUserName; ?>"><?php echo $aportacion->creadorUserName; ?></a>
			el <?php echo $aportacion->fecha; ?>
		</p>

		<br>
		<img src="<?php echo $aportacion->imagenUrl; ?>" alt="<?php echo "Aportación " . $idAportacion; ?>" style="max-width:600px; max-height:600px;margin-left:20px;">

		<br><br><br>
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
			<a href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/categoria/<?php echo $aportacion->nombreCategoria; ?>">
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
			<?php
					if($i == $numEtiquetas) {
						echo $etiqueta->etiquetaValor;
					}
					else {
						echo $etiqueta->etiquetaValor . ",";
					}
			?>
			<?php
				$i++;
				}
			?>
		</p>
		<br>
		<p>
			<a href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/reportarAportacion/<?php echo $idAportacion; ?>">Reportar por inapropiado</a> 
		</p>
		<br>
	</div>


	<!-- Los comentarios de la aportación -->
	<div style="margin-left: 40px;margin-right: 40px;" id="comentariosAportacion">
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
							if($paginaActual > 1){
								echo '<b>#' . ($i + ($paginaActual - 1) * 5) . '</b>';
							} else {
								echo '<b>#' . $i . '</b>';
							}

							echo '<br> <b>Autor:</b> ';
						
		?>
							<a href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/perfil/<?php echo $comentario->autorUserName; ?>">
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

	<br><br>

	<div class="paginacion" style="text-align: center; ">
		<?php echo $paginacion ?>
	</div>
	<br>


	<!-- El formulario para comentar la aportación -->
	<div style="margin-left: 40px;" id="divComentarSinLoguear">
		<legend>Deje su comentario</legend>
		<div>
			<p>
				Necesita estar logueado en la web para poder comentar aportaciones.
			</p>
			<br>
			<a href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/login">¿Ya tiene una cuenta? Haga login</a>
			<br>
			<br>
			<a href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/registro">¿Aún no tiene una cuenta? Regístrese</a>
		</div>
	</div>

	<div style="margin-left: 40px;margin-right: 40px;" id="divComentarLogueado">
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

		<form class="form" role="form" method="POST" action="<?php base_url(); ?>/IWEB/vistoEnLasRedes/comentarAportacion/<?php echo $idAportacion; ?>" name="formComentar" id="formComentar">

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
	<br><br>
</main>

<?php
	$this->load->view('inc/pie.php');
?>
