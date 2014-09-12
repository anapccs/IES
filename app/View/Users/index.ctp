<div class="users index">
    <h2><?php echo __('Usuários'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('name', 'Nome'); ?></th>
            <th><?php echo $this->Paginator->sort('status'); ?></th>
            <th class="actions"><?php echo __(''); ?></th>
        </tr>
        <?php foreach ($Users as $User): ?>
            <tr>
                <td><?php echo $this->Html->link(h($User['User']['name']), array('action' => 'edit', $User['User']['id'])); ?>&nbsp;</td>
                <!--<td><?php /*echo $User['User']['username']; */?>&nbsp;</td>
                <td><?php /*echo h($User['User']['email']); */?>&nbsp;</td>-->
                <td><?php $status = 'Inativo'; if($User['User']['status']) $status = 'Ativo'; echo h($status); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $User['User']['id'])); ?>
                    <?php echo $this->Form->postLink(__('Excluir'), array('action' => 'delete', $User['User']['id']), null, __('Deseja realmente excluir %s?', $User['User']['name'])); ?>
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
        <li><?php echo $this->Html->link(__('Novo Usuário'), array('action' => 'add')); ?></li>
    </ul>
</div>