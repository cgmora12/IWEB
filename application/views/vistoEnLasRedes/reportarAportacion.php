<!DOCTYPE html>
<html>

	<head>
		<title>Reportar aportación <?php echo $idAportacion; ?> - Visto en las redes</title>
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

			function scrollToTop() {
    			window.scrollTo(0, 0);
			}

			$(document).ready(function() {
				$("#errMotivo").hide();			
				
				$("#formReportarAportacion").submit(function(e) {
					var elMotivo = $("#motivo").val();

					if(elMotivo == "") {
						e.preventDefault();
						$("#errMotivo").show();
						$("#errMotivo").focus();
						$("#motivo").addClass("error");
						scrollToTop();
					}

				});

				$("#motivo").change(function() {
					if($(this).val() != "") {
						$("#errMotivo").hide();
						$("#motivo").removeClass("error");
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
			<h1>Reportar aportación</h1>
		</header>

		<main class="container">
			<div id="sobreDatosForm">
				<p>
					Por favor, si cree que la aportación es inapropiada, háganoslo saber y se intentará solucionarlo lo antes posible. Intente ser lo más detallado posible. Gracias.
				</p>
				<br>
			</div>

			<form class="form" role="form" method="POST" action="guardarReporteAportacion" name="formReportarAportacion" id="formReportarAportacion">

				<div class="form-group">
					<label class="control-label" for="username">UserName:</label>
					<?php 
						if($this->session->userdata('usuarioLogueado')) {
					?>
							<input class="form-control" type="text" id="username" name="username" readonly
								value="<?php echo $this->session->userdata('usuarioLogueado')?>"
							>
					<?php
						}
						else {
					?>
							<input class="form-control" type="text" id="username" name="username" value="Anónimo" readonly>
					<?php
						}
					?>
				</div>

				<div class="form-group">
					<label class="control-label" for="motivo">Motivo del reporte:</label>
					<span class="obligatorio">(*)</span>
					<input class="form-control" type="text" name="motivo" id="motivo" placeholder="Motivo del reporte:">

					<div id="errMotivo" class="alert alert-danger">
						Debe introducir un motivo para el reporte.
					</div>
				</div>

				<div class="form-group">
					<input class="btn btn-primary" type="submit" value="Enviar reporte">
				</div>
			</form>

			<div id="info" class="alert alert-info">
				<p class="obligatorio">(*): Campo obligatorio</p>
			</div>
		</main>
	</body>
</html>