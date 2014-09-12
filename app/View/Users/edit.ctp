<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Editar Usuário'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label' => 'Nome'));
        echo $this->Form->input('password', array('type' => 'text', 'label' => 'Funcional', 'value' => $this->request->data['User']['funcional'], 'empty' => true));
        echo $this->Form->input('role_id', array('label' => 'Grupo'));
		echo $this->Form->input('status', array('label' => 'Ativo'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Editar')); ?>
</div>
<div class="actions">
	<ul>
        <li><?php echo $this->Html->link(__('Novo Usuário'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Form->postLink(__('Excluir'), array('action' => 'delete', $this->Form->value('User.id')), null, __('Deseja realmente excluir %s?', $this->Form->value('User.name'))); ?></li>
	</ul>
</div>
