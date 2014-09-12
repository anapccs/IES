<div class="classrooms form">
<?php echo $this->Form->create('Classroom'); ?>
	<fieldset>
		<legend><?php echo __('Editar Sala'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label' => 'Sala'));
		echo $this->Form->input('status', array('label' => 'Ativa'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Editar')); ?>
</div>
<div class="actions">
	<ul>
        <li><?php echo $this->Html->link(__('Nova Sala'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Form->postLink(__('Excluir'), array('action' => 'delete', $this->Form->value('Classroom.id')), null, __('Deseja realmente excluir %s?', $this->Form->value('Classroom.name'))); ?></li>
	</ul>
</div>
