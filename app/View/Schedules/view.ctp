<div class="schedules view">
<h2><?php  echo __('Classroom'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($classroom['Classroom']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($classroom['Classroom']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($classroom['Classroom']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Classroom'), array('action' => 'edit', $classroom['Classroom']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Classroom'), array('action' => 'delete', $classroom['Classroom']['id']), null, __('Are you sure you want to delete # %s?', $classroom['Classroom']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Classrooms'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Classroom'), array('action' => 'add')); ?> </li>
	</ul>
</div>
