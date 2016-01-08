<?php
	$this->load->view('inc/cabecera.php');
?>


<!-- Script de JQuery -->
<script type="text/javascript">

	function isValidEmailAddress(emailAddress) {
		var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
		return pattern.test(emailAddress);
	}

	function isValidAvatar(avatarURL) {
        var obj = new Image();
        obj.src = avatarURL;
        return obj.complete;
    }

    function isValidURL(str) {
    	var regex = /^(http|https):\/\/(([a-zA-Z0-9$\-_.+!*'(),;:&=]|%[0-9a-fA-F]{2})+@)?(((25[0-5]|2[0-4][0-9]|[0-1][0-9][0-9]|[1-9][0-9]|[0-9])(\.(25[0-5]|2[0-4][0-9]|[0-1][0-9][0-9]|[1-9][0-9]|[0-9])){3})|localhost|([a-zA-Z0-9\-\u00C0-\u017F]+\.)+([a-zA-Z]{2,}))(:[0-9]+)?(\/(([a-zA-Z0-9$\-_.+!*'(),;:@&=]|%[0-9a-fA-F]{2})*(\/([a-zA-Z0-9$\-_.+!*'(),;:@&=]|%[0-9a-fA-F]{2})*)*)?(\?([a-zA-Z0-9$\-_.+!*'(),;:@&=\/?]|%[0-9a-fA-F]{2})*)?(\#([a-zA-Z0-9$\-_.+!*'(),;:@&=\/?]|%[0-9a-fA-F]{2})*)?)?$/;
    	return regex.test(str);
	}

	function confirmPassIguales(pass1, pass2) {
		return pass1 == pass2;
	}

	function confirmEmailIguales(email1, email2) {
		return email1 == email2;
	}


	function scrollToTop() {
		window.scrollTo(0, 0);
	}

	$(document).ready(function() {
		$("#errForm").hide();
		$("#errUsername").hide();
		$("#errPassword").hide();
		$("#errConfirmPass").hide();
		$("#errEmail").hide();
		$("#errConfirmEmail").hide();
		$("#errAvatar").hide();
		$("#errPaginaWeb").hide();
		
		
		$("#formRegistro").submit(function(e) {
			var elUsername = $("#username").val();
			var elPassword = $("#password").val();
			var elConfirmPass = $("#confirmPass").val();
			var elEmail = $("#email").val();
			var elConfirmEmail = $("#confirmEmail").val();
			var elAvatar = $("#avatar").val();
			var elPaginaWeb = $("#paginaWeb").val();

			if(elUsername == "") {
				e.preventDefault();
				$("#errUsername").show();
				$("#errUsername").focus();
				$("#username").addClass("error");

				$("#errForm").show();
				scrollToTop();
			}

			if(elPassword == "") {
				e.preventDefault();
				$("#errPassword").show();
				$("#errPassword").focus();
				$("#password").addClass("error");

				$("#errForm").show();
				scrollToTop();
			}

			if(!(confirmPassIguales(elPassword, elConfirmPass))) {
				e.preventDefault();
				$("#errConfirmPass").show();
				$("#errConfirmPass").focus();
				$("#confirmPass").addClass("error");

				$("#errForm").show();
				scrollToTop();
			}

			if(elEmail == "" || !(isValidEmailAddress(elEmail))) {
				e.preventDefault();
				$("#errEmail").show();
				$("#errEmail").focus();
				$("#email").addClass("error");

				$("#errForm").show();
				scrollToTop();
			}

			if(!(confirmEmailIguales(elEmail, elConfirmEmail))) {
				e.preventDefault();
				$("#errConfirmEmail").show();
				$("#errConfirmEmail").focus();
				$("#confirmEmail").addClass("error");

				$("#errForm").show();
				scrollToTop();
			}

			if(elAvatar != "" && !(isValidAvatar(elAvatar))) {
				e.preventDefault();
				$("#errAvatar").show();
				$("#errAvatar").focus();
				$("#avatar").addClass("error");

				$("#errForm").show();
				scrollToTop();
			}

			if(elPaginaWeb != "" && !(isValidURL(elPaginaWeb))) {
				e.preventDefault();
				$("#errPaginaWeb").show();
				$("#errPaginaWeb").focus();
				$("#paginaWeb").addClass("error");

				$("#errForm").show();
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

		$("#confirmPass").change(function() {
			if($(this).val() != "" && confirmPassIguales($(this).val(), $("#password").val())) {
				$("#errConfirmPass").hide();
				$("#confirmPass").removeClass("error");
			}
		});

		$("#email").change(function() {
			if($(this).val() != "" && isValidEmailAddress($(this).val())) {
				$("#errEmail").hide();
				$("#email").removeClass("error");
			}
		});

		$("#confirmEmail").change(function() {
			if($(this).val() != "" && confirmEmailIguales($(this).val(), $("#email").val())) {
				$("#errConfirmEmail").hide();
				$("#confirmEmail").removeClass("error");
			}
		});

		$("#avatar").change(function() {
			if($(this).val() == "" || isValidAvatar($(this).val())) {
				$("#errAvatar").hide();
				$("#avatar").removeClass("error");
			}
		});

		$("#paginaWeb").change(function() {
			if($(this).val() == "" || isValidURL($(this).val())) {
				$("#errPaginaWeb").hide();
				$("#paginaWeb").removeClass("error");
			}
		});

		$('#fechaNacimientoDiv').datepicker({
            format: 'dd-mm-yyyy',
            startDate: '01-01-1900',
            endDate: '30-12-2020'
        });
	});
</script>

<main class="container" style="background-color: white;background-clip:content-box; ">
	<h1 style="margin-left: 20px;" >Registro de nuevo usuario</h1>

	<?php if($this->session->flashdata('registro') != null){ ?>
		<div style="margin-left: 20px;margin-right: 20px;" class="alert alert-info">
			<?php echo $this->session->flashdata('registro'); ?>
		</div>
	<?php } ?>

	<div style="margin-left: 20px;"  id="sobreDatosForm">
		<legend>¿Es nuevo? Regístrese a continuación.</legend>
		<p>
			Registra tu cuenta en VEF para tener tu propio perfil, poder dejar comentarios en las aportaciones y poder interactuar con la web de forma más cómoda.
		</p>
		<p>
			Los datos facilitados únicamente serán utilizados para acceder a la web y poder interactuar con todas las funcionalidades que ofrece la web utilizando tu nombre de usuario.
		</p>
		<br>
	</div>


	<div style="margin-left: 20px;"  id="errForm" class="alert alert-danger fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<label class="errorForm">Hay errores en el formulario. Por favor, corríjalos y vuelva a enviar sus datos.</label>
		</div>


	<form style="margin-left: 20px; margin-right: 20px;"  class="form" role="form" method="POST" action="hacerRegistro" name="formRegistro" id="formRegistro">
		<!-- Información para acceder a la web. -->
		<legend class="legendForm">Información de acceso</legend>

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
			<input class="form-control" type="password" name="password" id="password" placeholder="Contraseña">

			<div id="errPassword" class="alert alert-danger">
				Debe introducir una contraseña.
			</div>
		</div>

		<div class="form-group">
			<label class="control-label" for="confirmPass">Confirmar contraseña:</label>
			<span class="obligatorio">(*)</span>
			<input class="form-control" type="password" name="confirmPass" id="confirmPass" placeholder="Repetir contraseña">

			<div id="errConfirmPass" class="alert alert-danger">
				Las contraseñas no coinciden.
			</div>
		</div>


		<div class="form-group">
			<label class="control-label" for="email">Email:</label>
			<span class="obligatorio">(*)</span>
			<input class="form-control" type="text" name="email" id="email" placeholder="ejemplo@dominio.com">

			<div id="errEmail" class="alert alert-danger">
				Debe introducir un email válido. Ejemplo: ejemplo@dominio.com
			</div>
		</div>

		<div class="form-group">
			<label class="control-label" for="confirmEmail">Confirmar email:</label>
			<span class="obligatorio">(*)</span>
			<input class="form-control" type="text" name="confirmEmail" id="confirmEmail" placeholder="Repetir email">

			<div id="errConfirmEmail" class="alert alert-danger">
				Los emails no coinciden.
			</div>
		</div>
		<br>

		<!-- Información personal -->
		<legend class="legendForm">Información personal</legend>

		<div class="form-group">
	        <label class="control-label" for="avatar">Avatar (introduzca la URL de internet):</label>
	        <input class="form-control" type="text" name="avatar" id="avatar" placeholder="URL de la imagen de internet">

	        <div id="errAvatar" class="alert alert-danger">
	            Debe introducir un avatar válido. Con una URL de internet que sea una imagen.
	        </div>
	    </div>

		<div class="form-group">
			<label class="control-label" for="pais">País:</label>
			<input class="form-control" type="text" name="pais" id="pais" placeholder="Su país de nacimiento">
		</div>

		<div class="form-group">
			<label class="control-label" for="provincia">Provincia:</label>
			<input class="form-control" type="text" name="provincia" id="provincia" placeholder="Su provincia de nacimiento">
		</div>

		<div class="form-group">
			<label class="control-label" for="localidad">Localidad:</label>
			<input class="form-control" type="text" name="localidad" id="localidad" placeholder="Su localidad de nacimiento">
		</div>

	    <div class="form-group">
	        <label class="control-label" for="fechaNacimiento">Fecha de nacimiento: </label>
	        <div class="date">
	            <div class="input-group input-append date" id="fechaNacimientoDiv" name="fechaNacimientoDiv">
	                <input type="text" class="form-control" id="fechaNacimientoInput" name="fechaNacimientoInput" />
	                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
	            </div>
	        </div>
	    </div>

		<div class="form-group">
			<label class="control-label" for="genero">Sexo:</label>
			<br>
			<!-- Importante que tengan el mismo nombre porque así se comportan como un array y sólo se podrá seleccionar uno cada vez. -->
			<input type="radio" name="sexo" id="sexoHombre" value="Hombre">Hombre
			<br>
			<input type="radio" name="sexo" id="sexoMujer" value="Mujer">Mujer
			<br>
			<input type="radio" name="sexo" id="sexoSinIndicar" value="Sin indicar" checked>Sin indicar
		</div>

		<div class="form-group">
	        <label class="control-label" for="paginaWeb">Página web:</label>
	        <input class="form-control" type="text" name="paginaWeb" id="paginaWeb" placeholder="http://www.ejemplo.com">

	        <div id="errPaginaWeb" class="alert alert-danger">
	            Debe introducir una URL válida. No se puede acceder a la URL introducida.
	        </div>
	    </div>

		<div class="form-group">
			<input class="btn btn-primary" type="submit" value="Registro">
		</div>

		<div class="form-group">
			<a href="login">¿Ya tiene una cuenta? Haga login</a>
		</div>
	</form>

	<div style="margin-left: 20px;margin-right: 20px;" id="info" class="alert alert-info">
		<p class="obligatorio">(*): Campo obligatorio</p>
	</div>

	<br><br>
</main>

<?php
	$this->load->view('inc/pie.php');
?>
