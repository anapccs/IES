<div class="schedules form">
<?php echo $this->Form->create('Schedule'); ?>
	<fieldset>
		<legend><?php echo __('Editar Horário'); ?></legend>
	<?php
		echo $this->Form->input('id');
        echo $this->Form->input('start', array('label' => 'Início'));
        echo $this->Form->input('end', array('label' => 'Fim'));
        echo $this->Form->input('status', array('label' => 'Ativo'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Editar')); ?>
</div>
<div class="actions">
	<ul>
        <li><?php echo $this->Html->link(__('Novo Horário'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Form->postLink(__('Excluir'), array('action' => 'delete', $this->Form->value('Classroom.id')), null, __('Deseja realmente excluir %s?', $this->Form->value('Classroom.name'))); ?></li>
	</ul>
</div>
