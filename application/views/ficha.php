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

echo heading('Ficha producto', 1);

echo form_open('ficha/guardar');

echo form_hidden('tx_PK_ID_PRODUCTO', $producto[0]['PK_ID_PRODUCTO'] ?? '');

echo form_label('Nombre ', 'txNombre');
echo form_input($txNombre, set_value('txNombre', $producto[0]['NOMBRE_PRODUCTO'] ?? ''));
echo form_error('txNombre');


echo form_label('Marca ', 'txMarca');
echo form_input($txMarca,set_value('txMarca', $producto[0]['MARCA'] ?? ''));
echo form_error('txMarca');

echo form_label('Precio ', 'txPrecio');
echo form_input($txPrecio,set_value('txPrecio', $producto[0]['PRECIO'] ?? ''));
echo form_error('txPrecio');

echo form_label('Cantidad ', 'txCantidad');
echo form_input($txCantidad,set_value('txCantidad', $producto[0]['CANTIDAD'] ?? ''));
echo form_error('txCantidad');

echo form_label('Categoria ', 'selCategoria');
echo form_dropdown('selCategoria', $options, $selectedCategoria);
echo form_error('selCategoria');

echo form_button($btSubmit);
echo anchor('listado/mostrar_listado', 'Volver', 'class="button-link"');

if (isset($producto[0]['PK_ID_PRODUCTO'])) {
	echo anchor('ficha/eliminar/' . $producto[0]['PK_ID_PRODUCTO'], 'Eliminar', 'class="button-link"');
}

echo form_close();
?>


</body>
</html>
