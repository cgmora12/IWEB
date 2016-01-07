<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Visto en las Redes</title>
    <link rel="icon" type="image/gif" href="<?php base_url(); ?>/iweb/public/images/favicon.gif">

	<!-- Include de JQuery -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Include de bootstrap -->
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	<!-- Include Bootstrap Datepicker -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>

	<?php
		if(isset($output)){
		foreach ($css_files as $css) {

			?>

			<link type="text/css" rel="stylesheet" href="<?php echo $css ?>" />

	<?php

		}
		
		foreach ($js_files as $js) {
			?>

			<script type="text/javascript" src="<?php echo $js ?>"> </script>

	<?php

		}
}

	?>

</head>
<style>

	.menuses ul {
	    list-style-type: none;
	    margin: 0;
	    padding: 0;
	    overflow: hidden;
	    background-color: #333;
	}

	.menuses li {
	    float: left;
	}

	.menuses li a {
	    display: block;
	    color: white;
	    text-align: center;
	    padding: 14px 16px;
	    text-decoration: none;
	}

	/* Change the link color to #111 (black) on hover */
	.menuses li a:hover {
	    background-color: #111;
	}

	.menuses .active {
	    background-color: #36619C;
	}

	ul.flecha{
		list-style-image: url("<?php base_url(); ?>/iweb/public/images/flecha_azul.png");
	}


	.error { color: red; }
	.obligatorio { color: red; }
	.errorForm { font-size:18px; font-weight:bold; color:red;}
	.legendForm { font-size: 15px; font-weight: bold; color: blue; }
		
</style>

<body style="background: url(<?php base_url(); ?>/iweb/public/images/bg.jpg);background-clip:content-box; ">

	<header class="container">

		<a style="text-decoration: none;" href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/index">
			<h1 style="text-align:left;float:left;color: white; margin-left:20px;font-weight:700;">Visto en las REDES</h1>
		</a>

		<?php
			// Si el usuario ya se ha logueado, que entre al index
			if($this->session->userdata('usuarioLogueado')) {
		?>

				<div style="float: right; margin-right:20px; margin-top:20px;">
					<p style="color: white;">

						Hola <b><a style="color: white;" href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/perfil/<?php echo $this->session->userdata('usuarioLogueado') ?>"><?php echo $this->session->userdata('usuarioLogueado') ?></a></b>!
						(<a  style="color: white;" href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/hacerLogout" name="logoutButton" id="logoutButton">Salir</a>)
						
						<?php $resultados = $this->Usuario_m->get_usuarioAvatarByUsername($this->session->userdata('usuarioLogueado')); 
						if($resultados[0]->avatarUrl != null) { ?>
							<a href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/perfil"><img style="width: 40px; height: 40px; margin-left: 10px;" src="<?php echo $resultados[0]->avatarUrl ?>"/></a>
						<?php } ?>

					</p>
					<br><br>
				</div>

		<?php
			}
			else{
		?>

				<div style="float: right; margin-right:20px; margin-top:20px;">
					<a style="color: white; margin-right:10px;" href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/login">Entrar</a>
					<a style="color: white;" href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/registro">Registro</a>
				</div>
				<br><br>
		<?php
			}
		?>
		
		<br><br>
	</header>

	<nav class="menuses container">
		<ul><b>

			<?php $url="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>

			<?php if(strpos($url,'index') !== false) { ?>
				<li class="active"><a style="padding-right: 30px; padding-left: 30px;" href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/index">ÚLTIMOS</a></li>

			<?php } else { ?>
				<li><a style="padding-right: 30px; padding-left: 30px;" href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/index">ÚLTIMOS</a></li>
			<?php } ?>
		
			<?php if(strpos($url,'verCategorias') !== false) { ?>
				<li class="active"><a style="padding-right: 30px; padding-left: 30px;" href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/verCategorias">CATEGORÍAS</a></li>
			<?php } else { ?>
				<li><a style="padding-right: 30px; padding-left: 30px;" href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/verCategorias">CATEGORÍAS</a></li>
			<?php } ?>
		
			<?php if(strpos($url,'enviarAportacion') !== false) { ?>
				<li class="active"><a style="padding-right: 30px; padding-left: 30px;" href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/enviarAportacion">ENVIAR APORTACIÓN</a></li>
			<?php } else { ?>
				<li><a style="padding-right: 30px; padding-left: 30px;" href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/enviarAportacion">ENVIAR APORTACIÓN</a></li>
			<?php } ?>
		
			<?php if(strpos($url,'buscar') !== false) { ?>
				<li class="active"><a style="padding-right: 30px; padding-left: 30px;" href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/buscar">BUSCAR</a></li>
			<?php } else { ?>
				<li><a style="padding-right: 30px; padding-left: 30px;" href="<?php base_url(); ?>/IWEB/vistoEnLasRedes/buscar">BUSCAR</a></li>
			<?php } ?>
		</b>
		</ul>
		
	</nav>