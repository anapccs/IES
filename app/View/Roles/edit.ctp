<div class="roles form">
<?php echo $this->Form->create('Role'); ?>
	<fieldset>
		<legend><?php echo __('Editar Cargo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('role', array('label' => 'Cargo'));
		echo $this->Form->input('role_status', array('label' => 'Ativo'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Editar')); ?>
</div>
<div class="actions">
	<ul>
        <li><?php echo $this->Html->link(__('Novo Cargo'), array('action' => 'add')); ?> </li>
        <li><?php echo $this->Form->postLink(__('Excluir'), array('action' => 'delete', $this->Form->value('Role.id')), null, __('Deseja realmente excluir %s?', $this->Form->value('Role.name'))); ?></li>
	</ul>
</div>
