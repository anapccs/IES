/**
 * Created with JetBrains PhpStorm.
 * User: Eduardo Alves Pereira
 * Date: 24/11/13
 * Time: 20:18
 * To change this template use File | Settings | File Templates.
 */
$(document).ready(function(){
    $('.time-picker').timepicker({
        altField: $(this).next().val(),
        timeFormat: 'HH:mm',
        stepHour: 1,
        stepMinute: 5,
        onSelect: populateList
    });

    $.datepicker.setDefaults($.datepicker.regional['pt-BR']);
    $('.date-picker').datepicker({
        onSelect: dateCheck,
        dateFormat: "dd/mm/yy"
    });

    getMinDate();

    $('#BookingEquipamentId').click(function(){
        if($('.date-picker').val() == ''){
            showAlert('Informe uma data');
            $('#BookingDate').focus();
        }else if($('.time-picker:eq(0)').val() == ''){
            showAlert('Informe o horário de início');
            $('.time-picker:eq(0)').focus();
        }else if($('.time-picker:eq(1)').val() == ''){
            showAlert('Informe o horário de término');
            $('.time-picker:eq(1)').focus();
        }else if($('#BookingClassroomId').find(":selected").val() == ''){
            showAlert('Informe a Sala');
            $('#BookingClassroomId').focus();
        }
    });

    $('#BookingScheduleId').bind('change, click', function(){
        var schedule = $(this).find('option:selected').text();
        if(schedule != 'Selecione um Horário'){
            schedule = schedule.replace(/h/g, ':');
            schedule = schedule.split(' - ');
            $('#BookingStart').val(schedule[0]);
            $('#BookingEnd').val(schedule[1]);

            populateList();
        }else{
            $('#BookingStart').val('');
            $('#BookingEnd').val('');
        }

    });

    $('#BookingClassroomId').change(function(){
        populateEquipament();
    });

    $('#BookingClassroomId').click(function(){
        if($('.date-picker').val() == ''){
            showAlert('Informe uma data');
            $('#BookingDate').focus();
        }else if($('.time-picker:eq(0)').val() == ''){
            showAlert('Informe o horário de início');
            $('.time-picker:eq(0)').focus();
        }else if($('.time-picker:eq(1)').val() == ''){
            showAlert('Informe o horário de término');
            $('.time-picker:eq(1)').focus();
        }
    });
});
function dateCheck(){
    if($('.time-picker:eq(0)').val() != '' && $('.time-picker:eq(1)').val() != ''){
        $('.time-picker').val('');
    }
}
function populateEquipament(){
    var date = $('.date-picker').val();
    var start = $('.time-picker:eq(0)').val();
    var end = $('.time-picker:eq(1)').val();
    $.ajax({
        url: '/equipaments/get_equipaments',
        type: 'POST',
        data: {date: date, start: start, end: end },
        dataType: 'json',
        success: function (data) {
            $('#BookingEquipamentId option[value!=""]').remove();
            $.each(data, function(i, item){
                $('#BookingEquipamentId').append(new Option(data[i].Equipament.name, data[i].Equipament.id));
            });
            getTotalTime();
        },
        error: function () {
            showAlert('Erro ao carregar Equipamentos. Por favor, tente novamente');
        }
    });
}

function populateList(){

    if($('.time-picker:eq(0)').val() != '' && $('.time-picker:eq(1)').val() != ''){
        var date = $('.date-picker').val();
        var start = $('.time-picker:eq(0)').val();
        var end = $('.time-picker:eq(1)').val();
        $.ajax({
            async: true,
            url: '/classrooms/get_classrooms',
            type: 'POST',
            data: {date: date, start: start, end: end },
            dataType: 'json',

            success: function (data) {
                    $('#BookingClassroomId option[value!=""]').remove();
                    $.each(data, function(i, item){
                        $('#BookingClassroomId').append(new Option(data[i].Classroom.name, data[i].Classroom.id));
                    });
                getTotalTime();
            },
            error: function () {
                showAlert('Erro ao carregar Salas. Por favor, tente novamente');
            }
        });
    }
}

function getTotalTime(){
    var start = $('.time-picker:eq(0)').val();
    var end = $('.time-picker:eq(1)').val();
    if ( $('.time-picker:eq(0)').val() != '' && $('.time-picker:eq(1)').val() != '' ){
        $.ajax({
            async: true,
            url: '/configs/getTotalTime',
            type: 'POST',
            data: {start: start, end: end },
            dataType: 'json',
            success: function (data) {
                if(data != null){
                    showAlert("Tempo máximo de reserva é de " + data + ".");
                    $('.time-picker:eq(1)').val('');
                }
            },
            error: function () {
                showAlert('Erro ao calcular limite entre horários');
            }
        });
    }
}

function getMinDate(){

    $.ajax({
        async: true,
        url: '/configs/getMinMaxDate',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            $('.date-picker').datepicker( "option", "minDate", new Date(data.minDate.year, data.minDate.month - 1, data.minDate.day) );
            $('.date-picker').datepicker( "option", "maxDate", new Date(data.maxDate.year, data.maxDate.month - 1, data.maxDate.day) );
        },
        error: function () {
            showAlert('Erro ao calcular limite de horário mínimo para confirmação');
        }
    });

}