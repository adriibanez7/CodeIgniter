<div class="container">
	<h2>Listado de todos los Productos</h2>
	<?php $this->table->set_heading(array('ID', 'PRODUCTO', 'MARCA', 'CATEGORIA','CANTIDAD','PRECIO')); ?>

	<?php foreach ($productos as $producto): ?>
		<?php
		$detalles_url = site_url('ficha/mostrar_ficha/' . $producto['PK_ID_PRODUCTO']);
		?>
		<?php $this->table->add_row(
			anchor(site_url("ficha/mostrar_ficha/"). $producto['PK_ID_PRODUCTO'],$producto['PK_ID_PRODUCTO']),
			$producto['NOMBRE_PRODUCTO'],
			$producto['MARCA'],
			$producto['NOMBRE_CATEGORIA'],
			$producto['CANTIDAD'] . ' uds.',
			$producto['PRECIO']. ' €'
		); ?>
	<?php endforeach; ?>

	<?= $this->table->generate(); ?>

	<div class="pagination">
		<?php echo $links; ?>
	</div>

	<p><?= $pagination_text; ?></p>

	<?php
	echo form_open('listado/mostrar_listado', array('id' => 'form_num_registros'));
	echo form_dropdown_num_records('num_registros', $num_registros_selected, 'form_num_registros');
	echo form_close();
	?>
</div>
