<?php
	$this->load->view('inc/cabecera.php');
?>

<!-- Script de JQuery -->
<script type="text/javascript">

	$(document).ready(function() {
		$("#errBusqueda").hide();
		
		$("#formBusqueda").submit(function(e) {
			var textoBusqueda = $("#textoBusqueda").val();

			if(textoBusqueda == "" || textoBusqueda.length < 3) {
				e.preventDefault();
				$("#errBusqueda").show();
				$("#errBusqueda").focus();
				$("#textoBusqueda").addClass("error");
			}
		});

		$("#textoBusqueda").change(function() {
			if($(this).val() != "") {
				$("#errBusqueda").hide();
				$("#textoBusqueda").removeClass("error");
			}
		});

	});
</script>

<main class="container" style="background-color: white;background-clip:content-box; ">

	<ul class="flecha" style="margin-left: 30px;margin-right: 50px;">
		<li><h3>Búsqueda avanzada</h3></li>
		<br>

		<p>Se trata de una búsqueda de aportaciones por su título. Por ejemplo, si desea buscar aportaciones que en su título contengan la palabra prueba, busque por el término 'prueba'.</p>
		<br>

		<form style="margin-left:20px;margin-right:20px;" class="form" role="form" method="POST" action="busqueda" id="formBusqueda">
			<div class="form-group">
				<label class="control-label" for="textoBusqueda">Texto a buscar:</label>
				<span class="obligatorio">(*)</span>
				<input class="form-control" type="text" id="textoBusqueda" name="textoBusqueda" placeholder="Búsqueda">

				<div id="errBusqueda" class="alert alert-danger">
					Debe introducir al menos 3 caracteres.
				</div>
			</div>
			<br>

			<div class="form-group">
				<input class="btn btn-primary" type="submit" name="busquedaSubmitButton" id="busquedaSubmitButton" value="Buscar">
			</div>
		</form>
		
	</ul>
	<br><br>

</main>

<?php
	$this->load->view('inc/pie.php');
?>
