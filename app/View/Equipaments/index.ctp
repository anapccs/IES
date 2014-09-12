<div class="equipaments index">
	<h2><?php echo __('Equipamentos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name', 'Equipamento'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __(''); ?></th>
	</tr>
	<?php foreach ($equipaments as $equipament): ?>
	<tr>
		<td><?php echo $this->Html->link($equipament['Equipament']['name'], array('action' => 'edit', $equipament['Equipament']['id'])); ?>&nbsp;</td>
		<td><?php $status = 'Inativo'; if($equipament['Equipament']['status']) $status = 'Ativo'; echo $status; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $equipament['Equipament']['id'])); ?>
			<?php echo $this->Form->postLink(__('Excluir'), array('action' => 'delete', $equipament['Equipament']['id']), null, __('Deseja realmente excluir %s?', $equipament['Equipament']['name'])); ?>
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
		<li><?php echo $this->Html->link(__('Novo Equipamento'), array('action' => 'add')); ?></li>
	</ul>
</div>
