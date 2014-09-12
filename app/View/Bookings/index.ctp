<script type="text/javascript">
    $(document).ready(function(){
        $.datepicker.setDefaults($.datepicker.regional['pt-BR']);
        //$('#wait').reveal();
        var from = '';
        var start = '';
        var end = '';

        $("#from").datepicker({
            defaultDate: "-2m",
            changeMonth: true,
            numberOfMonths: 3,
            dateFormat: "dd/mm/yy",
            onSelect: function( selectedDate ) {
                start = selectedDate;
                setSession('date_start', selectedDate);
                $("#to").datepicker( "option", "minDate", selectedDate );
                from = selectedDate;
            }
        });
        $("#to").datepicker({
            defaultDate: "-2m",
            changeMonth: true,
            numberOfMonths: 3,
            dateFormat: "dd/mm/yy",
            onSelect: function( selectedDate ) {
                end = selectedDate;
                setSession('date_end', selectedDate);
                setSession('set_graph', 1);
                $("#from").datepicker( "option", "maxDate", selectedDate );
                if(from != ''){
                    $('#wait').reveal();
                    //setGraphs(start, end);
                    //getSellsByPeriod(start, end);
                }
            }
        });
    });
</script>
<div class="bookings index">
    <div class="date-range">
        <?php echo $this->Form->create('Filtro', array('type' => 'get')); ?>
        <label for="from"></label>
        <?php
        $dateEnd = new DateTime();
        $dateEnd = $dateEnd->add(new DateInterval('P7D'));
        $dateEnd = $dateEnd->format('d/m/Y');

        $dateStart = new DateTime();
        $dateStart = $dateStart->format('d/m/Y');

        if ( $this->request->query('from') ){
            $dateStart = $this->request->query['from'];
            $dateEnd   = $this->request->query['to'];
        }
        ?>
        <input type="text" id="from" name="from" value="<?php echo $dateStart;?>"/>
        <label for="to">até</label>
        <input type="text" id="to" name="to" value="<?php echo $dateEnd;?>"/>
        <?php echo $this->Form->end(__('Filtrar'));?>
    </div>
	<h2><?php echo __('Reservas'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('equipament_id', 'Equipamento'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id', 'Usuário'); ?></th>
			<th><?php echo $this->Paginator->sort('classroom_id', 'Sala'); ?></th>
			<th><?php echo $this->Paginator->sort('date', 'Data'); ?></th>
			<th><?php echo $this->Paginator->sort('start', 'Início'); ?></th>
			<th><?php echo $this->Paginator->sort('end', 'Término'); ?></th>
			<th><?php echo $this->Paginator->sort('chekin', 'Confirmado'); ?></th>
			<th class="actions"><?php echo __(''); ?></th>
	</tr>

	<?php foreach ($bookings as $key => $value):


        ?>
        <tr class="schedules"><td colspan="9"><?php echo $bookings[$key]['schedule'];?></td></tr>

        <?php foreach($bookings[$key]['bookings'] as $booking):?>
	<tr>
		<td><?php echo $this->Html->link($booking['Booking']['id'], array('action' => 'view', $booking['Booking']['id'])); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($booking['Equipament']['name'], array('controller' => 'equipaments', 'action' => 'view', $booking['Equipament']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($booking['User']['name'], array('controller' => 'users', 'action' => 'view', $booking['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($booking['Classroom']['name'], array('controller' => 'classrooms', 'action' => 'view', $booking['Classroom']['id'])); ?>
		</td>
		<td><?php echo $this->Time->format('d/m', h($booking['Booking']['date'])); ?>&nbsp;</td>
		<td><?php echo $this->Time->format('H\hi', h($booking['Booking']['start'])); ?>&nbsp;</td>
		<td><?php echo $this->Time->format('H\hi', h($booking['Booking']['end'])); ?>&nbsp;</td>
		<td><?php $checkin = 'Não'; if ($booking['Booking']['checkin']) $checkin = 'Sim'; echo $checkin; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $booking['Booking']['id'])); ?>
			<?php echo $this->Form->postLink(__('Excluir'), array('action' => 'delete', $booking['Booking']['id']), null, __('Deseja realmente excluir a reserva # %s?', $booking['Booking']['id'])); ?>
		</td>
	</tr>
<?php
         endforeach;
endforeach; ?>
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
		<li><?php echo $this->Html->link(__('Nova Reserva'), array('action' => 'add')); ?></li>
	</ul>
</div>
