<!DOCTYPE html>
<html>
<head/>
<body>
<h1>Vehiculos - Zona privada</h1>

<div class="container">
	<?= form_open('zona_privada/vehiculos/listado', ['method' => 'post']); ?>
	<div>
		<?= form_hidden('order_dir', set_value('order_dir', $this->input->post('order_dir'))); ?>
		<?= form_hidden('order_by', set_value('order_by', $this->input->post('order_by'))); ?>
	</div>

	<div>
		<?= form_label('Marca:', 'marca'); ?>
		<?= form_dropdown('tx_marca', $marcas, set_value('tx_marca', $this->input->post('tx_marca')), 'id="tx_marca"');
		?>
	</div>

	<div>
		<?= form_label('Modelo:', 'modelo'); ?>
		<?= form_input(['name' => 'tx_modelo', 'id' => 'tx_modelo', 'value' => set_value('tx_modelo', $this->input->post('tx_modelo'))]); ?>
	</div>

	<div>
		<?= form_label('Mátricula:', 'matricula'); ?>
		<?= form_input(['name' => 'tx_matricula', 'id' => 'tx_matricula', 'value' => set_value('tx_matricula', $this->input->post('tx_matricula'))]); ?>
	</div>

	<div>
		<?= form_label('Ubicación:', 'ubicacion'); ?>
		<?= form_input(['name' => 'tx_ubicacion', 'id' => 'tx_ubicacion', 'value' => set_value('tx_ubicacion', $this->input->post('tx_ubicacion'))]); ?>
	</div>


	<div>
		<?= form_submit('buscar', 'Buscar'); ?>
	</div>
	<?= form_close(); ?>

	<?php
	$url_ficha_vehiculo = site_url(RUTA_ADMINISTRACION.'/vehiculos/ficha');
	//		var_dump($url_ficha_vehiculo);
	echo form_button('btn_nuevo_vehiculo', 'Nuevo Vehiculo', 'onclick="window.location.href =\'' . $url_ficha_vehiculo . '\'"');
	?>

	<!--		--><?php //var_dump($vehiculos);?>

	<?php if (!empty($vehiculos)): ?>
		<h2>Listado de vehiculos de TALLERES GUZMÁN S.L.</h2>
		<?php $this->table->set_heading(
			array('ID_VEHICULO',
				array('data' => 'MARCA', 'style' => 'cursor:pointer;', 'onclick' => 'ordenar(`marca`)'),
				array('data' => 'MODELO', 'style' => 'cursor:pointer;', 'onclick' => 'ordenar(`modelo`)'),
				array('data' => 'MATRICULA', 'style' => 'cursor:pointer;', 'onclick' => 'ordenar(`matricula`)'),
				'UBICACIÓN',
				'IMAGEN')); ?>

		<?php foreach ($vehiculos as $v): ?>
			<?php
			$url_ficha = site_url('zona_privada/vehiculos/ficha/' . $v['PK_ID_VEHICULO']);

			$imagen = $this->Vehiculos_model->obtener_ruta_imagen($v['PK_ID_VEHICULO']);
//			var_dump(base_url() . $imagen);
			$imagen_html = ($imagen) ? '<img src="' . base_url() . $imagen . '" width="50" height="50">' : '';

			$this->table->add_row(
				anchor($url_ficha, $v['PK_ID_VEHICULO']),
				anchor($url_ficha, $v['MARCA']),
				anchor($url_ficha, $v['MODELO']),
				anchor($url_ficha, $v['MATRICULA']),
				anchor($url_ficha, $v['UBICACION']),
				$imagen_html
			);
			?>
		<?php endforeach; ?>
		<?= $this->table->generate(); ?>

		<div class="pagination">
			<?php echo $this->pagination->create_links(); ?>
		</div>

		<p><?= $pagination_text; ?></p>

		<?php
		echo form_open('zona_privada/vehiculos/listado', array('id' => 'form_num_registros'));
		echo form_dropdown_num_records('num_registros', $num_registros_selected, 'form_num_registros');
		echo form_close();
		?>

	<?php else: ?>
		<h2>No se han encontrado vehiculos</h2>
	<?php endif; ?>
</div>




<br/>
<button onclick="window.location.href='<?=site_url(RUTA_ADMINISTRACION)?>'">Volver</button>
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
