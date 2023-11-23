<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Vehículos</title>
</head>
<body>

<div class="container">
	<?= form_open('vehiculos/mostrar_vehiculos', ['method' => 'post']); ?>
	<div>
		<?= form_hidden('order_dir', set_value('order_dir', $this->input->post('order_dir'))); ?>
		<?= form_hidden('order_by', set_value('order_by', $this->input->post('order_by'))); ?>
	</div>

	<div>
		<?= form_label('Marca:', 'marca'); ?>
		<?php

		echo form_dropdown('tx_marca', $marcas, set_value('tx_marca', $this->input->post('tx_marca')), 'id="tx_marca"');
		?>
	</div>

	<div>
		<?= form_label('Modelo:', 'modelo'); ?>
		<?= form_input(['name' => 'tx_modelo', 'id' => 'tx_modelo', 'value' => set_value('tx_modelo', $this->input->post('tx_modelo'))]); ?>
	</div>

	<div>
		<?= form_label('Matrícula:', 'matricula'); ?>
		<?= form_input(['name' => 'tx_matricula', 'id' => 'tx_matricula', 'value' => set_value('tx_matricula', $this->input->post('tx_matricula'))]); ?>
	</div>

	<div>
		<?= form_submit('buscar', 'Buscar'); ?>
	</div>
	<?= form_close(); ?>

	<h3>Acceso zona privada</h3>
	<?php
	$url_zona_privada = site_url(RUTA_ADMINISTRACION);
	echo form_button('btn_zona_privada', 'Acceder', 'onclick="window.location.href =\'' . $url_zona_privada . '\'"');
	?>

	<?php if (!empty($vehiculos)): ?>
		<h2>Listado de vehículos TALLERES GUZMÁN S.L.</h2>
		<?php $this->table->set_heading(
			array('ID_VEHICULO',
			array('data' => 'MARCA', 'style' => 'cursor:pointer;', 'onclick' => 'ordenar(`marca`)'),
			array('data' => 'MODELO', 'style' => 'cursor:pointer;', 'onclick' => 'ordenar(`modelo`)'),
			'MATRÍCULA',
				'UBICACIÓN')); ?>

		<?php foreach ($vehiculos as $v): ?>
			<?php
			$url_ficha = site_url('vehiculos/ver/' . $v['PK_ID_VEHICULO']);
			$this->table->add_row(
				anchor($url_ficha, $v['PK_ID_VEHICULO']),
				anchor($url_ficha, $v['MARCA']),
				anchor($url_ficha, $v['MODELO']),
				anchor($url_ficha, $v['MATRICULA']),
				anchor($url_ficha, $v['UBICACION'])
			);
			?>
		<?php endforeach; ?>
			<?= $this->table->generate(); ?>

		<div class="pagination">
			<?php echo $this->pagination->create_links(); ?>
		</div>

		<p><?= $pagination_text; ?></p>

		<?php
		echo form_open('vehiculos/mostrar_vehiculos', array('id' => 'form_num_registros'));
		echo form_dropdown_num_records('num_registros', $num_registros_selected, 'form_num_registros');
		echo form_close();
		?>

	<?php else: ?>
		<h2>No se han encontrado vehículos</h2>
	<?php endif; ?>
</div>


</body>
</html>

	<script>
		function ordenar(campo){
			let order = 'asc';
			let current_order_dir = document.getElementsByName('order_dir')[0].value;
			let current_order_value = document.getElementsByName('order_by')[0].value;
			if(current_order_value === campo){
				if(current_order_dir === 'asc')
					order = 'desc';
			}
			console.log(current_order_dir);
			console.log(current_order_value);

			document.getElementsByName('order_dir')[0].value = order;
			document.getElementsByName('order_by')[0].value = campo;

			console.log(current_order_dir);
			console.log(current_order_value);


			document.forms[0].submit();
		}
	</script>







