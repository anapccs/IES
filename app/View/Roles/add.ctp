<div class="roles form">
<?php echo $this->Form->create('Role'); ?>
	<fieldset>
		<legend><?php echo __('Adicionar Cargo'); ?></legend>
	<?php
		echo $this->Form->input('role', array('label' => 'Cargo'));
		echo $this->Form->input('role_status', array('label' => 'Ativo'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Adicionar')); ?>
</div>
<div class="actions">
</div>
