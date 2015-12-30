<!DOCTYPE html>
<html>

	<head>
		<title>Enviar aportación - Visto en las redes</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<meta charset="UTF-8">

		<!-- Include de JQuery -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include de bootstrap -->
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<!-- Include Bootstrap Datepicker -->
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
		<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>


		<!-- Script de JQuery -->
		<script type="text/javascript">

			function isValidImage(imageURL) {
		        var obj = new Image();
		        obj.src = imageURL;
		        return obj.complete;
		    }

		    function isValidURL(str) {
		    	var regex = /^(http|https):\/\/(([a-zA-Z0-9$\-_.+!*'(),;:&=]|%[0-9a-fA-F]{2})+@)?(((25[0-5]|2[0-4][0-9]|[0-1][0-9][0-9]|[1-9][0-9]|[0-9])(\.(25[0-5]|2[0-4][0-9]|[0-1][0-9][0-9]|[1-9][0-9]|[0-9])){3})|localhost|([a-zA-Z0-9\-\u00C0-\u017F]+\.)+([a-zA-Z]{2,}))(:[0-9]+)?(\/(([a-zA-Z0-9$\-_.+!*'(),;:@&=]|%[0-9a-fA-F]{2})*(\/([a-zA-Z0-9$\-_.+!*'(),;:@&=]|%[0-9a-fA-F]{2})*)*)?(\?([a-zA-Z0-9$\-_.+!*'(),;:@&=\/?]|%[0-9a-fA-F]{2})*)?(\#([a-zA-Z0-9$\-_.+!*'(),;:@&=\/?]|%[0-9a-fA-F]{2})*)?)?$/;
		    	return regex.test(str);
			}

			function scrollToTop() {
    			window.scrollTo(0, 0);
			}

			$(document).ready(function() {
				$("#errForm").hide();
				$("#errTitulo").hide();
				$("#errCategoria").hide();
				$("#errImagen").hide();
				$("#errFuente").hide();				
				
				$("#formEnviarAportacion").submit(function(e) {
					var elTitulo = $("#titulo").val();
					var elCategoria = $("#categoria").val();
					var elImagen = $("#imagen").val();
					var elFuente = $("#fuente").val();

					if(elTitulo == "") {
						e.preventDefault();
						$("#errTitulo").show();
						$("#errTitulo").focus();
						$("#titulo").addClass("error");

						$("#errForm").show();
						scrollToTop();
					}

					if(elCategoria == "sinElegir") {
						e.preventDefault();
						$("#errCategoria").show();
						$("#errCategoria").focus();
						$("#categoria").addClass("error");

						$("#errForm").show();
						scrollToTop();
					}

					if(elImagen == "" || !(isValidImage(elImagen))) {
						e.preventDefault();
						$("#errImagen").show();
						$("#errImagen").focus();
						$("#imagen").addClass("error");

						$("#errForm").show();
						scrollToTop();
					}

					if(elFuente == "" || !(isValidURL(elFuente))) {
						e.preventDefault();
						$("#errFuente").show();
						$("#errFuente").focus();
						$("#fuente").addClass("error");

						$("#errForm").show();
						scrollToTop();
					}

				});

				$("#titulo").change(function() {
					if($(this).val() != "") {
						$("#errTitulo").hide();
						$("#titulo").removeClass("error");
					}
				});

				$("#categoria").change(function() {
					if($(this).val() != "sinElegir") {
						$("#errCategoria").hide();
						$("#categoria").removeClass("error");
					}
				});

				$("#imagen").change(function() {
					if($(this).val() != "" && isValidImage($(this).val())) {
						$("#errImagen").hide();
						$("#imagen").removeClass("error");
					}
				});

				$("#fuente").change(function() {
					if($(this).val() != "" && isValidURL($(this).val())) {
						$("#errFuente").hide();
						$("#fuente").removeClass("error");
					}
				});
			});
		</script>

		<style>
			.error { color: red; }
			.obligatorio { color: red; }
			.errorForm { font-size:18px; font-weight:bold; color:red;}
		</style>
	</head>

	<body>
		<header class="container">
			<h1>Enviar aportación</h1>
		</header>

		<main class="container">
			<div id="sobreDatosForm">
				<p>
					Hagános llegar todo aquello que encuentre por internet y crea que puede ser divertido, desde fotos, estados peculiares, contestaciones a estados, grupos divertidos, etc.
				</p>
				<p>
					- ANTES DE ENVIAR LAS IMÁGENES, BORRE TODO RASTRO DE INFORMACIÓN CONFIDENCIAL (FOTOS Y APELLIDOS).
					<br>
					- NO SON VÁLIDAS IMÁGENES CON NOMBRES DE PERSONAS NI FOTOS.
					<br>
					- EN EL CASO DE ENVIAR FOTOS, ASEGÚRESE DE TAPAR LOS ROSTROS DE LAS PERSONAS.
				</p>
				<br>
			</div>


			<div id="errForm" class="alert alert-danger fade in">
    			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    			<label class="errorForm">Hay errores en el formulario. Por favor, corríjalos y vuelva a enviar sus datos.</label>
  			</div>


			<form class="form" role="form" method="POST" action="guardarAportacion" name="formEnviarAportacion" id="formEnviarAportacion">

				<div class="form-group">
					<label class="control-label" for="username">UserName:</label>
					<?php 
						if($this->session->userdata('usuarioLogueado')) {
					?>
							<input class="form-control" type="text" id="username" name="username" disabled 
								value="<?php echo $this->session->userdata('usuarioLogueado')?>"
							>
					<?php
						}
						else {
					?>
							<input class="form-control" type="text" id="username" name="username" value="Anónimo" disabled>
					<?php
						}
					?>
				</div>

				<div class="form-group">
					<label class="control-label" for="titulo">Título:</label>
					<span class="obligatorio">(*)</span>
					<input class="form-control" type="text" name="titulo" id="titulo" placeholder="Título">

					<div id="errTitulo" class="alert alert-danger">
						Debe introducir un título para la aportación.
					</div>
				</div>

				<div class="form-group">
					<label class="control-label" for="categoria">Categoría:</label>
					<span class="obligatorio">(*)</span>
					<select class="form-control" id="categoria" name="categoria">
						<option value="sinElegir" selected>Eliga una categoría</option>
					    <?php 
							foreach($listaCategorias as $categoria) {
								echo '<option value="' . $categoria->nombre . '">' . $categoria->nombre . '</option>';
							}
						?>
					</select>

					<div id="errCategoria" class="alert alert-danger">
						Debe elegir una categoría para la aportación.
					</div>
				</div>

				<div class="form-group">
					<label class="control-label" for="etiqueta">Etiqueta:</label>
					<select class="form-control" id="etiqueta" name="etiqueta">
						<option value="sinElegir" selected>Eliga una etiqueta</option>
					    <?php 
							foreach($listaEtiquetas as $etiqueta) {
								echo '<option value="' . $etiqueta->valor . '">' . $etiqueta->valor . '</option>';
							}
						?>
					</select>
				</div>

				<div class="form-group">
					<label class="control-label" for="imagen">Imagen (introduzca la URL de internet):</label>
					<span class="obligatorio">(*)</span>
					<input class="form-control" type="text" name="imagen" id="imagen" placeholder="URL de la imagen de internet">

					<div id="errImagen" class="alert alert-danger">
						Debe introducir una imagen válida. Con una URL de internet que sea una imagen.
					</div>
				</div>

				<div class="form-group">
			        <label class="control-label" for="fuente">Fuente (introduzca la URL de internet):</label>
			        <span class="obligatorio">(*)</span>
			        <input class="form-control" type="text" name="fuente" id="fuente" placeholder="http://www.ejemplo.com">

			        <div id="errFuente" class="alert alert-danger">
			            Debe introducir una URL válida. No se puede acceder a la URL introducida.
			        </div>
			    </div>

				<div class="form-group">
					<input class="btn btn-primary" type="submit" value="Enviar aportación">
				</div>
			</form>

			<div id="info" class="alert alert-info">
				<p class="obligatorio">(*): Campo obligatorio</p>
			</div>
		</main>
	</body>
</html>