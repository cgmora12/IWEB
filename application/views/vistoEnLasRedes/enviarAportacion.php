<?php
	$this->load->view('inc/cabecera.php');
?>


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

		

<main class="container" style="background-color: white;background-clip:content-box; ">

	<h1 style="margin-left: 20px;">Enviar aportación</h1>

	<div style="margin-left: 20px;" id="sobreDatosForm">
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


	<div style="margin-left: 20px;" id="errForm" class="alert alert-danger fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<label class="errorForm">Hay errores en el formulario. Por favor, corríjalos y vuelva a enviar sus datos.</label>
		</div>


	<form style="margin-left: 20px; margin-right: 20px;" class="form" role="form" method="POST" action="guardarAportacion" name="formEnviarAportacion" id="formEnviarAportacion">

		<div class="form-group">
			<label class="control-label" for="username">UserName:</label>
			<?php 
				if($this->session->userdata('usuarioLogueado')) {
			?>
					<input class="form-control" type="text" id="username" name="username" readonly
						value="<?php echo $this->session->userdata('usuarioLogueado') ?>"
					>
			<?php
				}
				else {
			?>
					<input class="form-control" type="text" id="username" name="username" value="Anonimo" readonly>
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

	<div style="margin-left: 20px;" id="info" class="alert alert-info">
		<p class="obligatorio">(*): Campo obligatorio</p>
	</div>
	<br><br>
</main>

<?php
	$this->load->view('inc/pie.php');
?>