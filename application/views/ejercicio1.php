<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Ejercicio1</title>

</head>
<body>


<div id="container">
	<h1><?= $titulo1 ?></h1>
	<table>
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>Marca</th>
			<th>Categoria</th>
			<th>Cantidad</th>
			<th>Precio</th>

		</tr>

		<?php foreach ($listado1 as $row_item): ?>
			<tr>
				<td><?= $row_item['PK_ID_PRODUCTO'] ?></td>
				<td><?= $row_item['NOMBRE'] ?></td>
				<td><?= $row_item['MARCA'] ?? "-" ?></td>
				<td><?= $row_item['FK_ID_CATEGORIA'] ?></td>
				<td><?= $row_item['CANTIDAD'] ?></td>
				<td><?= $row_item['PRECIO'] . " €" ?></td>
			</tr>
		<?php endforeach; ?>

	</table>

</div>

<div id="container">
	<h1><?= $titulo2 ?></h1>
	<table>
		<tr>
			<th>ID</th>
			<th>Categoria</th>
		</tr>

		<?php foreach ($listado2 as $row_item): ?>
			<tr>
				<td><?= $row_item['PK_ID_CATEGORIA'] ?></td>
				<td><?= $row_item['NOMBRE'] ?></td>
			</tr>
		<?php endforeach; ?>

	</table>
</div>

<div id="container">
	<h1><?= $titulo3 ?></h1>
	<table>
		<tr>
			<th>ID Producto</th>
			<th>Producto</th>
			<th>Marca</th>
			<th>Categoria</th>
			<th>Cantidad</th>
			<th>Precio</th>
			<th>ID Categoria</th>
			<th>Categoria</th>
		</tr>

		<?php foreach ($listado3 as $row_item): ?>
			<tr>
				<td><?= $row_item['PK_ID_PRODUCTO'] ?></td>
				<td><?= $row_item['NOMBRE'] ?></td>
				<td><?= $row_item['MARCA'] ?? "-" ?></td>
				<td><?= $row_item['FK_ID_CATEGORIA'] ?></td>
				<td><?= $row_item['CANTIDAD'] ?></td>
				<td><?= $row_item['PRECIO'] . " €" ?></td>
				<td><?= $row_item['PK_ID_CATEGORIA'] ?></td>
				<td><?= $row_item['NOMBRE'] ?></td>
			</tr>
		<?php endforeach; ?>

	</table>

</div>


<div id="container">
	<h1><?= $titulo4?></h1>
	<table>
		<tr>
			<th>ID Producto</th>
			<th>Producto</th>
			<th>Marca</th>
			<th>Categoria</th>
			<th>Cantidad</th>
			<th>Precio</th>
			<th>ID Categoria</th>
			<th>Categoria</th>
		</tr>

		<?php foreach ($listado4 as $row_item): ?>
			<tr>
				<td><?= $row_item['PK_ID_PRODUCTO'] ?></td>
				<td><?= $row_item['NOMBRE'] ?></td>
				<td><?= $row_item['MARCA'] ?? "-" ?></td>
				<td><?= $row_item['FK_ID_CATEGORIA'] ?></td>
				<td><?= $row_item['CANTIDAD'] ?></td>
				<td><?= $row_item['PRECIO'] . " €" ?></td>
				<td><?= $row_item['PK_ID_CATEGORIA'] ?></td>
				<td><?= $row_item['NOMBRE'] ?></td>
			</tr>
		<?php endforeach; ?>

	</table>

</div>


<div id="container">
	<h1><?= $titulo5?></h1>
	<table>
		<tr>
			<th>ID Producto</th>
			<th>Producto</th>
			<th>Marca</th>
			<th>Categoria</th>
			<th>Cantidad</th>
			<th>Precio</th>
			<th>ID Categoria</th>
			<th>Categoria</th>
		</tr>

		<?php foreach ($listado5 as $row_item): ?>
			<tr>
				<td><?= $row_item['PK_ID_PRODUCTO'] ?></td>
				<td><?= $row_item['NOMBRE'] ?></td>
				<td><?= $row_item['MARCA'] ?? "-" ?></td>
				<td><?= $row_item['FK_ID_CATEGORIA'] ?></td>
				<td><?= $row_item['CANTIDAD'] ?></td>
				<td><?= $row_item['PRECIO'] . " €" ?></td>
				<td><?= $row_item['PK_ID_CATEGORIA'] ?></td>
				<td><?= $row_item['NOMBRE'] ?></td>
			</tr>
		<?php endforeach; ?>

	</table>

</div>

<div id="container">
	<h1><?= $titulo6?></h1>
	<h2><?= $listado6[0]['PRECIO_MEDIO'] . " €"?></h2>
</div>

<div id="container">
	<h1><?= $titulo7?></h1>
	<table>
		<tr>
			<th>ID Categoría</th>
			<th>Nombre Categoría</th>
			<th>Número de productos</th>
		</tr>

		<?php foreach ($listado7 as $row_item): ?>
			<tr>
				<td><?= $row_item['PK_ID_CATEGORIA'] ?></td>
				<td><?= $row_item['NOMBRE_CATEGORIA'] ?></td>
				<td><?= $row_item['NUMERO_DE_PRODUCTOS'] ?? "-" ?></td>
			</tr>
		<?php endforeach; ?>

	</table>

</div>


<div id="container">
	<h1><?= $titulo8?></h1>

	<?php if($listado8):?>
	<table>
		<tr>
			<th>ID Categoría</th>
			<th>Nombre Categoría</th>
			<th>Número de productos</th>
		</tr>
		<?php foreach ($listado8 as $row_item): ?>
			<tr>
				<td><?= $row_item['PK_ID_CATEGORIA'] ?></td>
				<td><?= $row_item['NOMBRE_CATEGORIA'] ?></td>
				<td><?= $row_item['NUMERO_DE_PRODUCTOS'] ?></td>
			</tr>
			</table>
		<?php endforeach; ?>
	<?php else:?>
		<h1><?= "No hay datos"?></h1>
		<?php endif;?>

</div>

</body>
</html>
