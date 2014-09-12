<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Adicionar Usuário'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label' => 'Nome'));
		echo $this->Form->input('password', array('label' => 'Funcional'));
		echo $this->Form->input('role_id', array('label' => 'Grupo'));
		echo $this->Form->input('status', array('label' => 'Ativo'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Adicionar')); ?>
</div>