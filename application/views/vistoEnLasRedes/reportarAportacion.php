<?php
	$this->load->view('inc/cabecera.php');
?>



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

<main class="container" style="background-color: white;background-clip:content-box; ">
	<h1 style="margin-left: 20px;">Reportar aportación</h1>
	<div style="margin-left: 20px;" id="sobreDatosForm">
		<p>
			Por favor, si cree que la aportación es inapropiada, háganoslo saber y se intentará solucionarlo lo antes posible. Intente ser lo más detallado posible. Gracias.
		</p>
		<br>
	</div>

	<form style="margin-left: 20px; margin-right: 20px;" class="form" role="form" method="POST" action="<?php base_url(); ?>/IWEB/vistoEnLasRedes/guardarReporteAportacion/<?php echo $idAportacion ?>" name="formReportarAportacion" id="formReportarAportacion">

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

	<div style="margin-left: 20px;" id="info" class="alert alert-info">
		<p class="obligatorio">(*): Campo obligatorio</p>
	</div>
	<br><br>
</main>

<?php
	$this->load->view('inc/pie.php');
?>