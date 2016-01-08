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


	<h2 style="margin-left: 40px;">Comentarios de <?php echo $userName; ?></h2>
	<br>

	<!-- Los comentarios de la aportación -->
	<div style="margin-left: 40px;margin-right: 40px;" id="comentariosAportacion">
		<?php 
			if(count($comentariosUsuario) == 0) {
		?>
				El usuario aún no tiene ningún comentario.
				<br>
				<br>
		<?php
			}
			else {
				$i = 1;
				foreach($comentariosUsuario as $comentario) {
		?>
					<div class="alert alert-info" id="<?php echo 'comentario' . $i; ?>">
		<?php
							echo '<b>#' . $comentario->oid . '<br></b>';
							echo '<b>Autor:</b> ';
		?>
							<a href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/perfil/<?php echo $comentario->autorUserName; ?>">
								<?php echo $comentario->autorUserName; ?>
							</a>
		<?php
							echo '<br><b>Fecha:</b> ' . date('d-m-Y', strtotime($comentario->fecha));
		?>
							<p style="color: black">
		<?php
							echo '<br><b>Comentario:</b><br>' . $comentario->cuerpo;
		?>
							</p>
						</p>
					</div>
			<?php
				$i++;
				}
			}
		?>
	</div>

	<br><br>

	<div class="paginacion" style="text-align: center; ">
		<?php echo $paginacion ?>
	</div>
	<br>

</main>

<?php
	$this->load->view('inc/pie.php');
?>
