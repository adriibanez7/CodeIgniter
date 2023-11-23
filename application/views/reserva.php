<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Reserva</title>
</head>
<body>

<?php echo form_open('vehiculos/guardar', ['method' => 'post']); ?>

<?php
echo form_hidden('id_vehiculo', set_value('id_vehiculo', $id_vehiculo ?? ''));

echo form_label('Selecciona un empleado: ', 's_empleados');
echo form_dropdown('s_empleados', $op_emple, set_value('s_empleados', $selected_employee ?? ''), 'id="s_empleados"');
echo form_error('s_empleados');

echo form_label('Fecha desde: ', 'fecha_desde');
echo form_input(array(
	'type' => 'date',
	'name' => 'fecha_desde',
	'id' => 'fecha_desde',
	'value' => set_value('fecha_desde', $fecha_desde ?? ''),
));
echo form_error('fecha_desde');

echo form_label('Fecha hasta: ', 'fecha_hasta');
echo form_input(array(
	'type' => 'date',
	'name' => 'fecha_hasta',
	'id' => 'fecha_hasta',
	'value' => set_value('fecha_hasta', $fecha_hasta ?? ''),
));
echo form_error('fecha_hasta');

echo form_submit('reservar', 'Confirmar reserva');

$url_cancelar = site_url('vehiculos/ver/' . set_value('id_vehiculo', $id_vehiculo ?? ''));
echo form_button('btn_cancelar', 'Cancelar', 'onclick="window.location.href =\'' . $url_cancelar . '\'"');

echo form_close();
?>

</body>
</html>
