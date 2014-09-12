<div class="equipaments form">
<?php echo $this->Form->create('Equipament'); ?>
	<fieldset>
		<legend><?php echo __('Adicionar Equipamento'); ?></legend>
	<?php
        echo $this->Form->input('name', array('label' => 'Equipamento'));
        echo $this->Form->input('status', array('label' => 'Ativo'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Adicionar')); ?>
</div>