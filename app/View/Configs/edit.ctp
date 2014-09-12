<script type="text/javascript">
    $(document).ready(function(){
        $('.time-picker').timepicker({
            altField: $(this).next().val(),
            timeFormat: 'HH:mm',
            stepHour: 1,
            stepMinute: 5
        });
    });
</script>
<div class="configs form">
<?php echo $this->Form->create('Config'); ?>
	<fieldset>
		<legend><?php echo __('Editar Configurações'); ?></legend>
	<?php
        $this->request->data['Config']['check_in'] = $this->Time->format('H:i', $this->request->data['Config']['check_in']);
        $this->request->data['Config']['total_time'] = $this->Time->format('H:i', $this->request->data['Config']['total_time']);
		echo $this->Form->input('id');
		echo $this->Form->input('check_in', array('label' => 'Horário de confirmação', 'type' => 'text', 'class' => 'time-picker'));
		echo $this->Form->input('total_time', array('label' => 'Tempo total por reserva', 'type' => 'text', 'class' => 'time-picker'));
		echo $this->Form->input('total_days', array('label' => 'Dias entre cada reserva'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Editar')); ?>
</div>