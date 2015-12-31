<?php
	$this->load->view('inc/cabecera.php');
?>

<main>
	<!-- Include de bootstrap -->
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!-- Include de JQuery -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

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

	<a href="hacerLogout" class="btn btn-primary" role="button" name="logoutButton" id="logoutButton">Logout</a>
</main>

<?php
	$this->load->view('inc/pie.php');
?>
