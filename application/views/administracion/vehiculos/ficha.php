<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ficha de Vehículos</title>
</head>
<body>

<h2>Ficha de Vehículos</h2>
<?= form_open_multipart('zona_privada/vehiculos/guardar', ['method' => 'post']); ?>
<label for="marca">Marca:</label>
<?php echo form_input('tx_marca', set_value('tx_marca', $vehiculo[0]['MARCA'] ?? '')); ?>

<label for="modelo">Modelo:</label>
<?php echo form_input('tx_modelo', set_value('tx_modelo', $vehiculo[0]['MODELO'] ?? '')); ?>

<label for="matricula">Mátricula:</label>
<?php echo form_input('tx_matricula', set_value('tx_matricula', $vehiculo[0]['MATRICULA'] ?? '')); ?>

<label for="ubicacion">Ubicación:</label>
<?php echo form_input('tx_ubicacion', set_value('tx_ubicacion', $vehiculo[0]['UBICACION'] ?? '')); ?>

<div>
	<?= form_label('Imagen del vehículo:', 'imagen'); ?>
	<?= form_upload(['name' => 'imagen', 'id' => 'imagen']); ?>
</div>

<?php if ($vehiculo) : ?>
	<input type="hidden" name="tx_PK_ID_VEHICULO" value="<?php echo $vehiculo[0]['PK_ID_VEHICULO']; ?>">

	<?php echo form_submit('submit', 'Actualizar Vehículo'); ?>

<?php else : ?>
	<?php echo form_submit('submit', 'Agregar Vehículo'); ?>
<?php endif; ?>

<?php echo validation_errors(); ?>
<?php echo form_close(); ?>

<?php
$url_listado_vehiculos = site_url(RUTA_ADMINISTRACION.'/vehiculos/listado');
echo form_button('btn_volver_listado_vehiculos', 'Volver', 'onclick="window.location.href =\'' . $url_listado_vehiculos . '\'"');
?>

</body>
</html>
