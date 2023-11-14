<div class="container">
	<h2>Listado</h2>
		<?php $this->table->set_heading(array('CLAVE', 'VALOR_INICIAL','VALOR_FINAL')); ?>
	<?php foreach ($listado as $clave => $valor): ?>
<!--		--><?php //var_dump($listado); var_dump(alt_text($listado['vacio']));?>
		<?php $this->table->add_row($clave,$valor,alt_text($valor)); ?>
	<?php endforeach; ?>

	<?= $this->table->generate(); ?>


</div>
