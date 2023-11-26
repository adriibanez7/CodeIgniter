<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ficha de Empleado</title>
</head>
<body>

<h2>Ficha de Empleado</h2>
<?= form_open('zona_privada/empleados/guardar', ['method' => 'post']); ?>
<label for="nombre">Nombre:</label>
<?php echo form_input('tx_nombre', set_value('tx_nombre', $empleado[0]['NOMBRE'] ?? '')); ?>

<label for="apellidos">Apellidos:</label>
<?php echo form_input('tx_apellidos', set_value('tx_apellidos', $empleado[0]['APELLIDOS'] ?? '')); ?>

<label for="fecha_nacimiento">Fecha de Nacimiento:</label>
<?php
echo form_input(array(
	'type' => 'date',
	'name' => 'tx_fecha_nacimiento',
	'id' => 'tx_fecha_nacimiento',
	'value' => set_value('tx_fecha_nacimiento', $empleado[0]['FECHA_NACIMIENTO'] ?? ''),
));
?>

<?php if ($empleado) : ?>
	<input type="hidden" name="tx_PK_ID_EMPLEADO" value="<?php echo $empleado[0]['PK_ID_EMPLEADO']; ?>">

	<label for="cod_emple">Código de empleado:</label>
	<?php echo form_input('tx_cod_emple', set_value('tx_cod_emple', $empleado[0]['COD_EMPLEADO'] ?? ''),array('readonly' => 'readonly')); ?>

	<?php echo form_submit('submit', 'Actualizar Empleado'); ?>

<?php else : ?>
	<?php echo form_submit('submit', 'Agregar Empleado'); ?>
<?php endif; ?>

<?php echo validation_errors(); ?>
<?php echo form_close(); ?>

<?php
$url_listado_empleados = site_url(RUTA_ADMINISTRACION.'/empleados/listado');
echo form_button('btn_volver_listado_emple', 'Volver', 'onclick="window.location.href =\'' . $url_listado_empleados . '\'"');
?>

</body>
</html>
