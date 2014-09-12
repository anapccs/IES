<div class="roles index">
	<h2><?php echo __('Cargos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('role', 'Cargo'); ?></th>
			<th><?php echo $this->Paginator->sort('role_status', 'Status'); ?></th>
			<th class="actions"></th>
	</tr>
	<?php foreach ($roles as $role): ?>
	<tr>
		<td><?php echo h($role['Role']['id']); ?>&nbsp;</td>
		<td><?php echo h($role['Role']['role']); ?>&nbsp;</td>
		<td><?php $status = 'Inativo'; if($role['Role']['role_status']) $status = 'Ativo'; echo h($status); ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $role['Role']['id'])); ?>
			<?php echo $this->Form->postLink(__('Excluir'), array('action' => 'delete', $role['Role']['id']), null, __('Deseja realmente excluir %s?', $role['Role']['role'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Página {:page} de {:pages}, exibindo {:current} registros de {:count} total, começando no {:start}, terminando no {:end}')
        ));
        ?>	</p>
    <div class="paging">
        <?php
        echo $this->Paginator->prev('< ' . __('anterior'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('próximo') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
    </div>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Novo Cargo'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Permissões'), '/admin/acl/aros/ajax_role_permissions'); ?></li>
	</ul>
</div>
