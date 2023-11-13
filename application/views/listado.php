<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="stylesheet" type="text/css">
	<meta charset="utf-8">
	<title>Ejercicio1_TEMA5</title>
</head>
<body>

<div class="container">
	<h2>Listado</h2>
	<?php $this->table->set_heading(array('Clave', 'ValorCustom','Valor')); ?>
	<?php foreach ($listado as $key => $value): ?>
		<?php $this->table->add_row($key,alt_text($value),$value); ?>
	<?php endforeach; ?>

	<?= $this->table->generate(); ?>


</div>



</body>
</html>
