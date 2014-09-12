<div class="users view">
<h2><?php  echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($user['User']['nome']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Role']['id'], array('controller' => 'roles', 'action' => 'view', $user['Role']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dias Treino'); ?></dt>
		<dd>
			<?php echo h($user['User']['dias_treino']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($user['User']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cargos'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Role'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Treinos'), array('controller' => 'treinos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Treino'), array('controller' => 'treinos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Treinos'); ?></h3>
	<?php if (!empty($user['Treino'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Treino'); ?></th>
		<th><?php echo __('Objetivo'); ?></th>
		<th><?php echo __('Inicio'); ?></th>
		<th><?php echo __('Fim'); ?></th>
		<th><?php echo __('Descanso Series'); ?></th>
		<th><?php echo __('Duracao Treino'); ?></th>
		<th><?php echo __('Criado'); ?></th>
		<th><?php echo __('Modificado'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Treino'] as $treino): ?>
		<tr>
			<td><?php echo $treino['id']; ?></td>
			<td><?php echo $treino['user_id']; ?></td>
			<td><?php echo $treino['treino']; ?></td>
			<td><?php echo $treino['objetivo']; ?></td>
			<td><?php echo $treino['inicio']; ?></td>
			<td><?php echo $treino['fim']; ?></td>
			<td><?php echo $treino['descanso_series']; ?></td>
			<td><?php echo $treino['duracao_treino']; ?></td>
			<td><?php echo $treino['criado']; ?></td>
			<td><?php echo $treino['modificado']; ?></td>
			<td><?php echo $treino['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'treinos', 'action' => 'view', $treino['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'treinos', 'action' => 'edit', $treino['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'treinos', 'action' => 'delete', $treino['id']), null, __('Are you sure you want to delete # %s?', $treino['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Treino'), array('controller' => 'treinos', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
