<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Hola mundo con CI</title>

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
<body>