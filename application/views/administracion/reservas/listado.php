<!DOCTYPE html>
<html>
<head/>
<body>
	<h1>Reservas - Zona privada</h1>

	<div class="container">
		<?= form_open('zona_privada/reservas/listado', ['method' => 'post']); ?>
		<div>
			<?= form_hidden('order_dir', set_value('order_dir', $this->input->post('order_dir'))); ?>
			<?= form_hidden('order_by', set_value('order_by', $this->input->post('order_by'))); ?>
		</div>

		<div>
			<?= form_label('Marca:', 'marca'); ?>
			<?= form_dropdown('tx_marca', $marcas, set_value('tx_marca', $this->input->post('tx_marca')), 'id="tx_marca"'); ?>
		</div>

		<div>
			<?= form_label('Modelo:', 'modelo'); ?>
			<?= form_input(['name' => 'tx_modelo', 'id' => 'tx_modelo', 'value' => set_value('tx_modelo', $this->input->post('tx_modelo'))]); ?>
		</div>

		<div>
			<?= form_label('Matrícula:', 'matricula'); ?>
			<?= form_input(['name' => 'tx_matricula', 'id' => 'tx_matricula', 'value' => set_value('tx_matricula', $this->input->post('tx_matricula'))]); ?>
		</div>

		<div>
			<?= form_label('Nombre Empleado:', 'nom_emple'); ?>
			<?= form_input(['name' => 'tx_nom_emple', 'id' => 'tx_nom_emple', 'value' => set_value('tx_nom_emple', $this->input->post('tx_nom_emple'))]); ?>
		</div>

		<div>
			<?= form_label('Apellidos Empleado:', 'ape_emple'); ?>
			<?= form_input(['name' => 'tx_ape_emple', 'id' => 'tx_ape_emple', 'value' => set_value('tx_ape_emple', $this->input->post('tx_ape_emple'))]); ?>
		</div>

		<div>
			<?= form_label('Fecha Desde:', 'fecha_desde'); ?>
			<?= form_input(['name' => 'tx_fecha_desde','type'=>'date', 'id' => 'tx_fecha_desde', 'value' => set_value('tx_fecha_desde', $this->input->post('tx_fecha_desde'))]); ?>
		</div>

		<div>
			<?= form_label('Fecha Hasta:', 'fecha_hasta'); ?>
			<?= form_input(['name' => 'tx_fecha_hasta','type'=>'date', 'id' => 'tx_fecha_hasta', 'value' => set_value('tx_fecha_hasta', $this->input->post('tx_fecha_hasta'))]); ?>
		</div>

		<div>
			<?= form_label('Estado:', 'estado'); ?>
			<?= form_dropdown('tx_estado', $opciones, set_value('tx_estado', $this->input->post('tx_estado')), 'id="tx_estado"'); ?>
		</div>

		<div>
			<?= form_submit('buscar', 'Buscar'); ?>
		</div>
		<?= form_close(); ?>

		<?php if (!empty($reservas)): ?>
			<h2>Listado de reservas de TALLERES GUZMÁN S.L.</h2>
			<?php $this->table->set_heading(
				array('PK_ID_RESERVA',
					'MARCA',
					array('data' => 'MODELO', 'style' => 'cursor:pointer;', 'onclick' => 'ordenar(`nombre`)'),
					array('data' => 'MATRICULA', 'style' => 'cursor:pointer;', 'onclick' => 'ordenar(`apellidos`)'),
					array('data' => 'UBICACION', 'style' => 'cursor:pointer;', 'onclick' => 'ordenar(`fecha_nacimiento`)'),
					'NOMBRE_EMPLEADO',
					'APELLIDOS_EMPLEADO',
					'FECHA_DESDE',
					'FECHA_HASTA',
					'ESTADO_RESERVA',
					'ACEPTAR O RECHAZAR'
					)); ?>

			<?php foreach ($reservas as $r): ?>
				<?php
				$this->table->add_row(
					 $r['PK_ID_RESERVA'],
					 $r['MARCA'],
					 $r['MODELO'],
					 $r['MATRICULA'],
					$r['UBICACION'],
					 $r['NOMBRE'],
					 $r['APELLIDOS'],
					$r['FECHA_DESDE'],
					$r['FECHA_HASTA'],
					$r['NOMBRE_ESTADO'],
					($r['NOMBRE_ESTADO'] == 'Pte. de aceptar') ?
//						form_button(array('name' => 'aceptar_reserva', 'id' => 'btn_aceptar' . $r['PK_ID_RESERVA'], 'type' => 'submit', 'class' => 'btn btn-success', 'content' => 'Aceptar', 'value' => $r['PK_ID_RESERVA'])) .
						form_button('aceptar_reserva', 'Aceptar', 'onclick="window.location.href =\'' . site_url(RUTA_ADMINISTRACION.'/reservas/aceptar_reserva/'.$r['PK_ID_RESERVA']) . '\'"') .
						form_button('rechazar_reserva', 'Rechazar', 'onclick="window.location.href =\'' . site_url(RUTA_ADMINISTRACION.'/reservas/rechazar_reserva/'.$r['PK_ID_RESERVA']) . '\'"') :
						''
				);
				?>
			<?php endforeach; ?>
			<?= $this->table->generate(); ?>

			<div class="pagination">
				<?php echo $this->pagination->create_links(); ?>
			</div>

			<p><?= $pagination_text; ?></p>

			<?php
			echo form_open('zona_privada/reservas/listado', array('id' => 'form_num_registros'));
			echo form_dropdown_num_records('num_registros', $num_registros_selected, 'form_num_registros');
			echo form_close();
			?>

		<?php else: ?>
			<h2>No se han encontrado reservas</h2>
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
