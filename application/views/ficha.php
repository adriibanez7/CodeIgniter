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

<?php

echo heading('Nuevo producto', 1);

echo form_open('productos/guardar');

echo form_label('Nombre ', 'txNombre');
echo form_input($txNombre);
echo form_error('txNombre');

echo form_label('Marca ', 'txMarca');
echo form_input($txMarca);
echo form_error('txMarca');

echo form_label('Precio ', 'txPrecio');
echo form_input($txPrecio);
echo form_error('txPrecio');

echo form_label('Cantidad ', 'txCantidad');
echo form_input($txCantidad);
echo form_error('txCantidad');

echo form_label('Categoria ', 'selCategoria');
echo form_dropdown('selCategoria', $options, $selectedCategoria);
echo form_error('selCategoria');

echo form_button($btSubmit);

echo form_close();
?>

</body>
</html>
