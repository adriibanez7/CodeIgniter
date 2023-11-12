<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/styles.css'); ?>">
	<meta charset="utf-8">
	<title>Ejercicio1</title>
</head>
<body>

<div class="container">
	<h2>Listado de todos los Productos</h2>
	<?= anchor(site_url('ficha/'), 'Nuevo producto'); ?>
	<?php $this->table->set_heading(array('ID', 'PRODUCTO', 'MARCA', 'CATEGORIA','CANTIDAD','PRECIO')); ?>
	<?php foreach ($productos as $producto): ?>
		<?php
		$detalles_url = site_url('ficha/mostrar_ficha/' . $producto['PK_ID_PRODUCTO']);
		?>
		<?php $this->table->add_row( anchor(site_url("ficha/mostrar_ficha/"). $producto['PK_ID_PRODUCTO'],$producto['PK_ID_PRODUCTO']), $producto['NOMBRE_PRODUCTO'], $producto['MARCA'], $producto['NOMBRE_CATEGORIA'], $producto['CANTIDAD'] . ' uds.', $producto['PRECIO']. ' €'); ?>
	<?php endforeach; ?>

	<?= $this->table->generate(); ?>

	<div class="pagination">
		<?php echo $links; ?>
	</div>

	<p><?= $pagination_text; ?></p>
</div>

</body>
</html>

