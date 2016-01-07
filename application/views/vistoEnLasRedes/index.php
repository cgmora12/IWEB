<?php
	$this->load->view('inc/cabecera.php');
?>

<main class="container" style="background-color: white;background-clip:content-box; ">

	<?php if($categoria != null){ ?>
		<h1 style="margin-left: 30px;"> Categoria <?php echo $categoria; ?></h1>
	<?php } ?>
	<?php if($busqueda != null){ ?>
		<h1 style="margin-left: 30px;"> Búsqueda: <?php echo $busqueda; ?></h1>
	<?php } ?>

	<?php if($this->session->flashdata('login') != null){ ?>
		<div class="alert alert-info">
			<?php echo $this->session->flashdata('login'); ?>
		</div>
	<?php } ?>

	<ul class="flecha" style="margin-left: 30px;">
		<?php
			if(count($aportaciones) > 0) {

				for ($i = 0; $i < 5 && $i < count($aportaciones); $i++){
					?>
					
						<br>
						<li>
							<h3><a href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/verAportacion/<?php echo $aportaciones[$i]->oid; ?>"><?php echo $aportaciones[$i]->titulo; ?></a></h3>

							<p>Enviado por <a href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/perfil/<?php echo $aportaciones[$i]->creadorUserName; ?>"><?php echo $aportaciones[$i]->creadorUserName; ?></a> (<?php echo $aportaciones[$i]->fecha; ?>)</p>
							<br>
							<a href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/verAportacion/<?php echo $aportaciones[$i]->oid; ?>">
								<img src="<?php echo $aportaciones[$i]->imagenUrl; ?>" style="max-width:600px; max-height:600px; margin-left:20px;">
							</a>
							<br><br><br>

							<p>
								<span class="glyphicon glyphicon-globe"></span>
								Vía: 
								<a href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/<?php echo $aportaciones[$i]->fuenteUrl; ?>">
									<?php echo $aportaciones[$i]->fuenteUrl; ?>
								</a>
							</p>
							<p>
								<span class="glyphicon glyphicon-bookmark"></span>
								Categoría: 
								<a href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/categoria/<?php echo $aportaciones[$i]->nombreCategoria; ?>">
									<?php echo $aportaciones[$i]->nombreCategoria; ?>
								</a>
							</p>
							<p>
								<span class="glyphicon glyphicon-tag"></span>
								Etiquetas: 
								
								<?php 

									// Etiquetas
									$resultadosEtiquetas = $this->EtiquetaAportacion_m->get_etiquetasAportacion($aportaciones[$i]->oid);
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
								<a href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/reportarAportacion/<?php echo $aportaciones[$i]->oid; ?>">Reportar por inapropiado</a> 
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
