<?php
	$this->load->view('inc/cabecera.php');
?>


<main class="container" style="background-color: white;background-clip:content-box; ">
	<h1 style="margin-left: 40px;">Categorías</h1>

	<br><br>

	<div class="form-group" style="margin-left: 40px;margin-right: 40px;">

		<?php
			foreach($categorias as $categoria) {
		?>
				<a class="btn btn-primary" style="background-color: #36619C; margin-left:0px; margin-top:20px;" href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/categoria/<?php echo $categoria->nombre; ?>">
					<?php echo $categoria->nombre; ?>
				</a>

				
		<?php
			}
		?>
	</div>

	<br><br>
</main>

<?php
	$this->load->view('inc/pie.php');
?>
