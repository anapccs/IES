<div class="classrooms form">
<?php echo $this->Form->create('Classroom'); ?>
	<fieldset>
		<legend><?php echo __('Adicionar Sala'); ?></legend>
	<?php
        echo $this->Form->input('name', array('label' => 'Sala'));
        echo $this->Form->input('status', array('label' => 'Ativa', 'default' => true));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Adicionar')); ?>
</div>