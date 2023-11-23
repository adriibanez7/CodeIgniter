<!DOCTYPE html>
<html>
<head/>
<body>
	<h1>Plataforma - Zona privada</h1>
	<p>Soy el listado de empleados</p>



	<div class="container">
		<?= form_open('zona_privada/empleados/listado', ['method' => 'post']); ?>
		<div>
			<?= form_hidden('order_dir', set_value('order_dir', $this->input->post('order_dir'))); ?>
			<?= form_hidden('order_by', set_value('order_by', $this->input->post('order_by'))); ?>
		</div>

		<div>
			<?= form_label('Código:', 'cod_emple'); ?>
			<?= form_input(['name' => 'tx_cod_emple', 'id' => 'tx_cod_emple', 'value' => set_value('tx_cod_emple', $this->input->post('tx_cod_emple'))]); ?>
		</div>

		<div>
			<?= form_label('Nombre:', 'nombre'); ?>
			<?= form_input(['name' => 'tx_nombre', 'id' => 'tx_nombre', 'value' => set_value('tx_nombre', $this->input->post('tx_nombre'))]); ?>
		</div>

		<div>
			<?= form_label('Apellidos:', 'apellidos'); ?>
			<?= form_input(['name' => 'tx_apellidos', 'id' => 'tx_apellidos', 'value' => set_value('tx_apellidos', $this->input->post('tx_apellidos'))]); ?>
		</div>

		<div>
			<?= form_submit('buscar', 'Buscar'); ?>
		</div>
		<?= form_close(); ?>

		<?php var_dump($empleados);?>

		<?php if (!empty($empleados)): ?>
			<h2>Listado de empleados de TALLERES GUZMÁN S.L.</h2>
			<?php $this->table->set_heading(
				array('ID_EMPLEADO',
					'COD_EMPLEADO',
					array('data' => 'NOMBRE', 'style' => 'cursor:pointer;', 'onclick' => 'ordenar(`nombre`)'),
					array('data' => 'APELLIDOS', 'style' => 'cursor:pointer;', 'onclick' => 'ordenar(`apellidos`)'),
					'EMAIL',
					array('data' => 'FECHA_NACIMIENTO', 'style' => 'cursor:pointer;', 'onclick' => 'ordenar(`fecha_nacimiento`)'),
					'BAJA')); ?>

			<?php foreach ($empleados as $e): ?>
				<?php
				$url_ficha = site_url('zona_privada/empleados/ver/' . $e['PK_ID_EMPLEADO']);
				$this->table->add_row(
					anchor($url_ficha, $e['PK_ID_EMPLEADO']),
					anchor($url_ficha, $e['COD_EMPLEADO']),
					anchor($url_ficha, $e['NOMBRE']),
					anchor($url_ficha, $e['APELLIDOS']),
					anchor($url_ficha, $e['EMAIL']),
					anchor($url_ficha, $e['FECHA_NACIMIENTO']),
					anchor($url_ficha, $e['BAJA']),
				);
				?>
			<?php endforeach; ?>
			<?= $this->table->generate(); ?>

			<div class="pagination">
				<?php echo $this->pagination->create_links(); ?>
			</div>

			<p><?= $pagination_text; ?></p>

			<?php
			echo form_open('zona_privada/empleados/listado', array('id' => 'form_num_registros'));
			echo form_dropdown_num_records('num_registros', $num_registros_selected, 'form_num_registros');
			echo form_close();
			?>

		<?php else: ?>
			<h2>No se han encontrado empleados</h2>
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
