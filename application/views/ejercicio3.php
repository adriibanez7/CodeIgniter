<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Ejercicio3</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
<div class="container">
		<table >
			<thead>
			<tr>
				<th>NOMBRE_PRODUCTO</th>
				<th>MARCA</th>
				<th>PRECIO</th>
				<th>NOMBRE_CATEGORIA</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($productos as $p): ?>
				<tr>
					<td><?= $p['NOMBRE_PRODUCTO']?></td>
					<td><?= $p['MARCA']?></td>
					<td><?= $p['PRECIO']?></td>
					<td><?= $p['NOMBRE_CATEGORIA']?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		<p><?php echo $links; ?></p>
	</div>
</body>
</html>
