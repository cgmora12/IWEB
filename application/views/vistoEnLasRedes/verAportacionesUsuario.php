<?php
	$this->load->view('inc/cabecera.php');
?>

<main class="container" style="background-color: white;background-clip:content-box; ">
	<h1 style="margin-left: 40px;">Perfil de <?php echo $userName; ?></h1>
	
	<!-- La aportación en sí -->
	<div style="margin-left: 40px;" id="datosAportacion">

		<br>
		<?php
			if($usuario->avatarUrl == null){
		?>
			<img src="<?php base_url(); ?>/iweb/public/images/default.png" alt="<?php echo "Avatar Usuario " . $userName; ?>" style="float: left; max-width:200px; max-height:200px;margin-left:20px;">
		
		<?php
			}else{
		?>
		
			<img src="<?php echo $usuario->avatarUrl; ?>" alt="<?php echo "Avatar Usuario " . $userName; ?>" style="float: left; max-width:200px; max-height:200px;margin-left:20px;">

		<?php
			}
		?>

		<p style="margin-left: 250px;">
			<b>Miembro desde:</b> <?php echo $usuario->fechaRegistro; ?><br>
		<?php 
			if($this->session->userdata('usuarioLogueado')) {
				if($usuario->pais != null) {
			?>
					<b>País:</b> <?php echo $usuario->pais; ?><br>
			<?php
				}
				if($usuario->provincia != null){
			?>
					<b>Provincia:</b> <?php echo $usuario->provincia; ?><br>
			<?php
				}
				if($usuario->localidad != null){
			?>
					<b>Localidad:</b> <?php echo $usuario->localidad; ?><br>
			<?php
				}
				if($usuario->fechaNacimiento != null){
			?>
					<b>Fecha de nacimiento:</b> <?php echo $usuario->fechaNacimiento; ?><br>
			<?php
				}
			?>
					<b>Sexo:</b> <?php echo $usuario->sexo; ?><br>

		<?php
			}
		?>
			
		<?php 
			if($usuario->paginaWeb != null) {
		?>	
				<b>Página web:</b>
				<a href="<?php echo $usuario->paginaWeb; ?>">
					<?php echo $usuario->paginaWeb; ?>
				</a>
				<br>

		<?php
			}
		?>
			<b>Número de aportaciones:</b> <?php echo $usuario->numAportaciones; ?><br>
			<b>Número de comentarios:</b> <?php echo $usuario->numComentarios; ?><br>

		</p>

		<div style="clear: both;">
		<br><br>


		<div class="form-group">
			<a class="btn btn-primary" style="background-color: #36619C;" href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/verAportacionesUsuario/<?php echo $userName; ?>">
				Aportaciones
			</a>
			<a class="btn btn-primary" style="background-color: #36619C;" href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/verComentariosUsuario/<?php echo $userName; ?>">
				Comentarios
			</a>
		</div>

		<div id="mostrarAportaciones"></div>
		<div id="mostrarComentarios"></div>

		<br><br>
	</div>


	<h2 style="margin-left: 40px;">Aportaciones de <?php echo $userName; ?></h2>

	<ul class="flecha" style="margin-left: 40px;">
		<?php
			if(count($aportacionesUsuario) > 0) {

				for ($i = 0; $i < 5 && $i < count($aportacionesUsuario); $i++){
					?>
					
						<br>
						<li>
							<h3><a href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/verAportacion/<?php echo $aportacionesUsuario[$i]->oid; ?>"><?php echo $aportacionesUsuario[$i]->titulo; ?></a></h3>

							<p>Enviado por <a href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/perfil/<?php echo $aportacionesUsuario[$i]->creadorUserName; ?>"><?php echo $aportacionesUsuario[$i]->creadorUserName; ?></a> (<?php echo $aportacionesUsuario[$i]->fecha; ?>)</p>
							<br>
							<a href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/verAportacion/<?php echo $aportacionesUsuario[$i]->oid; ?>">
								<img src="<?php echo $aportacionesUsuario[$i]->imagenUrl; ?>" style="max-width:600px; max-height:600px; margin-left:20px;">
							</a>
							<br><br><br>

							<p>
								<span class="glyphicon glyphicon-globe"></span>
								Vía: 
								<a href="<?php echo $aportacionesUsuario[$i]->fuenteUrl; ?>">
									<?php echo $aportacionesUsuario[$i]->fuenteUrl; ?>
								</a>
							</p>
							<p>
								<span class="glyphicon glyphicon-bookmark"></span>
								Categoría: 
								<a href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/categoria/<?php echo $aportacionesUsuario[$i]->nombreCategoria; ?>">
									<?php echo $aportacionesUsuario[$i]->nombreCategoria; ?>
								</a>
							</p>
							<p>
								<span class="glyphicon glyphicon-tag"></span>
								Etiquetas: 
								
								<?php 

									// Etiquetas
									$resultadosEtiquetas = $this->EtiquetaAportacion_m->get_etiquetasAportacion($aportacionesUsuario[$i]->oid);
									$listaEtiquetas = $resultadosEtiquetas;
									$numEtiquetas = count($resultadosEtiquetas);

									$j = 1;
									foreach($listaEtiquetas as $etiqueta) {
								?>
										
								<?php
										if($j == $numEtiquetas) {
											echo $etiqueta->etiquetaValor;
										}
										else {
											echo $etiqueta->etiquetaValor . ",";
										}
								?>
										
								<?php
									$j++;
									}
								?>
							</p>
							<br>
							<p>
								<a href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/reportarAportacion/<?php echo $aportacionesUsuario[$i]->oid; ?>">Reportar por inapropiado</a> 
							</p>
						</li>
					<?php
				}

			}
			else {
				echo "No hay ninguna aportación...";
			}
		?>
	</ul>
	<br><br>

	<div class="paginacion" style="text-align: center; ">
		<?php echo $paginacion ?>
	</div>
	<br>

</main>

<?php
	$this->load->view('inc/pie.php');
?>
