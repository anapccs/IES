<div class="equipaments form">
<?php echo $this->Form->create('Equipament'); ?>
	<fieldset>
		<legend><?php echo __('Editar Equipamento'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label' => 'Equipamento'));
		echo $this->Form->input('status', array('label' => 'Ativo'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Editar')); ?>
</div>
<div class="actions">
	<ul>
        <li><?php echo $this->Html->link(__('Novo Equipamento'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Form->postLink(__('Excluir'), array('action' => 'delete', $this->Form->value('Equipament.id')), null, __('Deseja realmente excluir %s?', $this->Form->value('Equipament.name'))); ?></li>
	</ul>
</div>
