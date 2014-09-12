<script type="text/javascript">
    $(document).ready(function(){
        $('#meal-group input[type="checkbox"]').click(function(){
            $(this).parent().next().toggle();
        });

        $('.time-picker').timepicker({
            altField: $(this).next().val(),
            timeFormat: 'HH:mm',
            stepHour: 1,
            stepMinute: 5
        });
        $.datepicker.setDefaults($.datepicker.regional['pt-BR']);
        $('.date-picker').datepicker({dateFormat: "dd/mm/yy"});
    });
</script>
<div class="bookings form">
<?php echo $this->Form->create('Booking'); ?>
	<fieldset>
		<legend><?php echo __('Editar Reserva'); ?></legend>
	<?php
        $this->request->data['Booking']['start'] = $this->Time->format('H:i', $this->request->data['Booking']['start']);
        $this->request->data['Booking']['end'] = $this->Time->format('H:i', $this->request->data['Booking']['end']);
		echo $this->Form->input('id');
        echo $this->Form->input('date', array('label' => 'Data', 'type' => 'text', 'class' => 'date-picker', 'value' => $this->Time->format('d/m/Y', $this->request->data['Booking']['date'])));
        echo $this->Form->input('start', array('label' => 'Início', 'type' => 'text', 'class' => 'time-picker'));
        echo $this->Form->input('end', array('label' => 'Término', 'type' => 'text', 'class' => 'time-picker'));
        echo $this->Form->input('classroom_id', array('label' => 'Sala', 'empty' => 'Selecione a Sala'));
		echo $this->Form->input('equipament_id', array('label' => 'Equipamento', 'empty' => 'Selecione o Equipamento'));

        if ($userData['role_id'] != 3 OR ( $this->request->data['Booking']['date'] == date('Y-m-d') AND date('H:i') < $config['Config']['check_in']))
        {
		    echo $this->Form->input('user_id', array('label' => 'Usuário'));
            echo $this->Form->input('checkin', array('label' => 'Confirmado'));
        }

	?>
	</fieldset>
<?php echo $this->Form->end(__('Editar')); ?>
</div>
<div class="actions">
	<ul>
        <li><?php echo $this->Html->link(__('Nova Reserva'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Form->postLink(__('Excluir'), array('action' => 'delete', $this->Form->value('Booking.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Booking.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Reservas'), array('action' => 'index')); ?></li>
	</ul>
</div>
