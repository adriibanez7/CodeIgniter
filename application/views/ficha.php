<div>
	<h2>Información del Vehículo</h2>
	<?= form_label('Marca','marca')?>
	<?= form_input(['name' => 'marca', 'value' => $vehiculo[0]['MARCA'], 'readonly' => 'readonly']); ?>
	<?= form_label('Modelo','modelo')?>
	<?= form_input(['name' => 'modelo', 'value' => $vehiculo[0]['MODELO'], 'readonly' => 'readonly']); ?>
	<?= form_label('Matrícula','matricula')?>
	<?= form_input(['name' => 'matricula', 'value' => $vehiculo[0]['MATRICULA'], 'readonly' => 'readonly']); ?>
	<?= form_label('Ubicación','ubicacion')?>
	<?= form_input(['name' => 'ubicacion', 'value' => $vehiculo[0]['UBICACION'], 'readonly' => 'readonly']); ?>

	<br>
	<?php
	$url_ficha = site_url('vehiculos/reservar/' . $vehiculo[0]['PK_ID_VEHICULO']);
	echo form_button('btn_reservar','Reservar', 'onclick="window.location.href =\'' . $url_ficha . '\'"');

	$url_cancelar = site_url('vehiculos/');
	echo form_button('btn_cancelar','Cancelar', 'onclick="window.location.href =\'' . $url_cancelar . '\'"');

	?>
</div>

<div>
	<h2>Listado de Reservas</h2>

	<?php if (!empty($reservas)): ?>
		<?php $this->table->set_heading(array('EMPLEADO', 'ESTADO','FECHA_DESDE','FECHA_HASTA')); ?>
		<?php foreach ($reservas as $r): ?>
			<?php
			$this->table->add_row($r['NOMBRE'] . ' ' . $r['APELLIDOS'], $r['NOMBRE_ESTADO'], $r['FECHA_DESDE'], $r['FECHA_HASTA']); ?>
		<?php endforeach; ?>


		<?= $this->table->generate(); ?>
	<?php else:?>
		<h3>No se han encontrado reservas</h3>
	<?php endif;?>
</div>
