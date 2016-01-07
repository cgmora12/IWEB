<?php
	$this->load->view('inc/cabecera.php');
?>


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

		
<main class="container" style="background-color: white;background-clip:content-box; ">
	<h1 style="margin-left: 20px;">Login</h1>


	<?php if($this->session->flashdata('login') != null){ ?>
		<div style="margin-left: 20px;margin-right: 20px;" class="alert alert-info">
			<?php echo $this->session->flashdata('login'); ?>
		</div>
	<?php } ?>

	<!-- Lo de action="hacerLogin" es porque en el controller hay un método que se llama así -->
	<form style="margin-left: 20px; margin-right: 20px;" class="form" role="form" method="POST" action="hacerLogin" id="formLogin" name="formLogin">
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

	<div style="margin-left: 20px;" id="info" class="alert alert-info">
		<p class="obligatorio">(*): Campo obligatorio</p>
	</div>
	<br><br>
</main>

<?php
	$this->load->view('inc/pie.php');
?>
