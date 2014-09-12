<div class="schedules form">
<?php echo $this->Form->create('Schedule'); ?>
	<fieldset>
		<legend><?php echo __('Adicionar Horário'); ?></legend>
	<?php
        echo $this->Form->input('start', array('label' => 'Início'));
        echo $this->Form->input('end', array('label' => 'Fim'));
        echo $this->Form->input('status', array('label' => 'Ativo', 'default' => true));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Adicionar')); ?>
</div>