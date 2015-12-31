<!DOCTYPE html>
<html>

	<head>
		<title>Recuperar contraseña - Visto en las redes</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<meta charset="UTF-8">

		<!-- Include de JQuery -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include de bootstrap -->
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


		<!-- Script de JQuery -->
		<script type="text/javascript">

			function isValidEmailAddress(emailAddress) {
    			var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    			return pattern.test(emailAddress);
			}

			function scrollToTop() {
    			window.scrollTo(0, 0);
			}

			$(document).ready(function() {
				$("#errEmail").hide();				
				
				$("#formRecuperacionDatos").submit(function(e) {
					var elEmail = $("#email").val();

					if(elEmail == "" || !(isValidEmailAddress(elEmail))) {
						e.preventDefault();
						$("#errEmail").show();
						$("#errEmail").focus();
						$("#email").addClass("error");
						scrollToTop();
					}
				});

				$("#email").change(function() {
					if($(this).val() != "" && isValidEmailAddress($(this).val())) {
						$("#errEmail").hide();
						$("#email").removeClass("error");
					}
				});
			});
		</script>

		<style>
			.error { color: red; }
			.obligatorio { color: red; }
			.legendForm { font-size:15px; font-weight:bold; color:blue;}
			.errorForm { font-size:18px; font-weight:bold; color:red;}
		</style>
	</head>

	<body>
		<header class="container">
			<h1>Recuperación de su contraseña</h1>
		</header>

		<main class="container">
			<div id="sobreDatosForm">
				<legend>¿Olvidó sus datos de acceso? Recupérelos a continuación.</legend>
				<p>
					No se preocupe, introduzca su email y se enviará un correo electrónico con sus datos para acceder a la web. 
				</p>
				<br>
			</div>

			<form class="form" role="form" method="POST" action="hacerRecuperacionDatos" name="formRecuperacionDatos" id="formRecuperacionDatos">
				<legend class="legendForm">Información para recuperar los datos</legend>

				<div class="form-group">
					<label class="control-label" for="email">Email con el que se registró en la web:</label>
					<span class="obligatorio">(*)</span>
					<input class="form-control" type="text" name="email" id="email" placeholder="ejemplo@dominio.com">

					<div id="errEmail" class="alert alert-danger">
						Debe introducir un email válido. Ejemplo: ejemplo@dominio.com
					</div>
				</div>

				<div class="form-group">
					<input class="btn btn-primary" type="submit" value="Recuperar datos">
				</div>

				<div class="form-group">
					<a href="login">¿Ha recordado sus datos de acceso? Haga login</a>
					<br>
					<br>
					<a href="registro">¿Aún no tiene una cuenta? Regístrese</a> 
				</div>
			</form>

			<div id="info" class="alert alert-info">
				<p class="obligatorio">(*): Campo obligatorio</p>
			</div>
		</main>
	</body>
</html>