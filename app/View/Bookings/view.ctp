<div class="bookings view">
<h2><?php  echo __('Reserva'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($booking['Booking']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Equipamento'); ?></dt>
		<dd>
			<?php echo $this->Html->link($booking['Equipament']['name'], array('controller' => 'equipaments', 'action' => 'view', $booking['Equipament']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Usuário'); ?></dt>
		<dd>
			<?php echo $this->Html->link($booking['User']['name'], array('controller' => 'users', 'action' => 'view', $booking['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sala'); ?></dt>
		<dd>
			<?php echo $this->Html->link($booking['Classroom']['name'], array('controller' => 'classrooms', 'action' => 'view', $booking['Classroom']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Data'); ?></dt>
		<dd>
			<?php echo h($booking['Booking']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Início'); ?></dt>
		<dd>
			<?php echo h($booking['Booking']['start']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Término'); ?></dt>
		<dd>
			<?php echo h($booking['Booking']['end']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Confirmado'); ?></dt>
		<dd>
			<?php $checkin = 'Não'; if ($booking['Booking']['checkin']) $checkin = 'Sim'; echo $checkin; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($booking['Booking']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($booking['Booking']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>