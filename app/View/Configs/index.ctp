<div class="configs index">
	<h2><?php echo __('Configurações'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('check_in', 'Hora limite de confirmação'); ?></th>
			<th><?php echo $this->Paginator->sort('total_time', 'Tempo total por reserva'); ?></th>
			<th><?php echo $this->Paginator->sort('total_days', 'Dias entre cada reserva'); ?></th>
			<th class="actions"><?php echo __(''); ?></th>
	</tr>
	<?php foreach ($configs as $config): ?>
	<tr>
		<td><?php echo $this->Html->link($config['Config']['id'], array('action' => 'view', $config['Config']['id'])); ?>&nbsp;</td>
		<td><?php echo h($config['Config']['check_in']); ?>&nbsp;</td>
		<td><?php echo h($config['Config']['total_time']); ?>&nbsp;</td>
		<td><?php echo h($config['Config']['total_days']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $config['Config']['id'])); ?>
			<?php echo $this->Form->postLink(__(''), array('')); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>