<div class="bookings form">
<?php echo $this->Form->create('Booking'); ?>
	<fieldset>
		<legend><?php echo __('Adicionar Reserva'); ?></legend>
	<?php
//    echo $this->Form->input('date', array('label' => 'Data', 'type' => 'text', 'class' => 'date-picker', 'value' => '25/11/2013'));
    echo $this->Form->input('date', array('label' => 'Data', 'type' => 'text', 'class' => 'date-picker', 'readonly' => true));

    //echo $this->Form->input('start', array('label' => 'Início', 'type' => 'text', 'class' => 'time-picker', 'value' => '19:10'));
    if($schedules != NULL){
        echo $this->Form->input('schedule_id', array('label'   => 'Horários',
            'empty' => 'Selecione um Horário',
            'options' => $schedules));
    }

    echo $this->Form->input('start', array('label' => 'Início', 'type' => 'text', 'class' => 'time-picker'));
    //echo $this->Form->input('end', array('label' => 'Término', 'type' => 'text', 'class' => 'time-picker', 'value' => '20:20'));
    echo $this->Form->input('end', array('label' => 'Término', 'type' => 'text', 'class' => 'time-picker'));

    echo $this->Form->input('classroom_id', array('label' => 'Sala', 'empty' => 'Selecione a Sala'));
    echo $this->Form->input('equipament_id', array('label' => 'Equipamento', 'empty' => 'Selecione o Equipamento'));
    ?>
<?php

    if ($userData['role_id'] != 3)
    {
        echo $this->Form->input('user_id', array('label' => 'Usuário', 'empty' => 'Selecione um Usuário'));
        echo $this->Form->input('checkin', array('label' => 'Confirmado'));
    }else{
        echo $this->Form->hidden('user_id', array('value' => $userData['id']));
    }
	?>
	</fieldset>
<?php echo $this->Form->end(__('Adicionar')); ?>
</div>
<div class="actions">

</div>