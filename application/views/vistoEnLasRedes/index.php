<?php
	$this->load->view('inc/cabecera.php');
?>

<main>
	<h1><?php echo $titulo; ?></h1>

	</ul>
		<?php
			foreach($lista as $persona) {
				?>
					<li><?php echo ($persona-> nombre); ?></li>
				<?php
			}
		?>
	</ul>


</main>

<?php
	$this->load->view('inc/pie.php');
?>
