<!DOCTYPE html>
<html>
	<head>
		<title>Login - Visto en las redes</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<meta charset="UTF-8">

		<!-- Include de JQuery -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include de bootstrap -->
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<!-- Script de JQuery -->
		<script type="text/javascript">

			function scrollToTop() {
    			window.scrollTo(0, 0);
			}

			$(document).ready(function() {
				$("#errUsername").hide();
				$("#errPassword").hide();
				
				$("#formLogin").submit(function(e) {
					var elUsername = $("#username").val();
					var elPassword = $("#password").val();

					if(elUsername == "") {
						e.preventDefault();
						$("#errUsername").show();
						$("#errUsername").focus();
						$("#username").addClass("error");
						scrollToTop();
					}

					if(elPassword == "") {
						e.preventDefault();
						$("#errPassword").show();
						$("#errPassword").focus();
						$("#password").addClass("error");
						scrollToTop();
					}
				});

				$("#username").change(function() {
					if($(this).val() != "") {
						$("#errUsername").hide();
						$("#username").removeClass("error");
					}
				});

				$("#password").change(function() {
					if($(this).val() != "") {
						$("#errPassword").hide();
						$("#password").removeClass("error");
					}
				});

			});
		</script>

		<style>
			.error { color: red; }
			.obligatorio { color: red; }
			.legendForm { font-size: 15px; font-weight: bold; color: blue; }
		</style>
	</head>

	<body>
		<header class="container">
			<h1>Login</h1>
		</header>

		<main class="container">
			<!-- Lo de action="hacerLogin" es porque en el controller hay un método que se llama así -->
			<form class="form" role="form" method="POST" action="hacerLogin" id="formLogin" name="formLogin">
				<!-- Información para acceder a la web. -->
				<legend class="legendForm">Datos del usuario</legend>

				<div class="form-group">
					<label class="control-label" for="username">UserName:</label>
					<span class="obligatorio">(*)</span>
					<input class="form-control" type="text" id="username" name="username" placeholder="Nombre de usuario">

					<div id="errUsername" class="alert alert-danger">
						Debe introducir un nombre de usuario.
					</div>
				</div>

				<div class="form-group">
					<label class="control-label" for="password">Contraseña:</label>
					<span class="obligatorio">(*)</span>
					<input class="form-control" type="password" id="password" name="password" placeholder="Contraseña">

					<div id="errPassword" class="alert alert-danger">
						Debe introducir una contraseña.
					</div>
				</div>
				<br>

				<div class="form-group">
					<input class="btn btn-primary" type="submit" name="loginSubmitButton" id="loginSubmitButton" value="Login">
				</div>
				<br>

				<div class="form-group">
					<a href="recuperarContrasenya">¿Olvidó la contraseña? Recuperar contraseña</a>
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