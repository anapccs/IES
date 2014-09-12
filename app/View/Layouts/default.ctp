<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'Sistema de Reservas');
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $cakeDescription; ?>
    </title>
    <?php
    /*echo $this->Html->meta('icon');*/

    echo $this->Html->script('jquery-1.8.2.min');
    echo $this->Html->script('jquery.reveal');
    echo $this->Html->script('jquery.noty');
    // 		echo $this->Html->script('jquery.autocomplete.min');
    echo $this->Html->script('jquery-ui');
    echo $this->Html->script('jquery.tipsy');
    echo $this->Html->script('jquery-ui-timepicker-addon.js');
    echo $this->Html->script('jquery.ui.datepicker-pt-BR');
    echo $this->Html->css('jquery-ui');

    if ($this->params['controller'] == 'bookings')
        echo $this->Html->script('js');
//    echo $this->Js->writeBuffer();

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    if($_SERVER['REMOTE_ADDR'] == '127.0.0.1'):
    ?>
    <link rel="stylesheet" type="text/css" href="/app/webroot/css/cake.generic.css"/>
    <?php else:
        echo $this->Html->css('cake.generic');
    endif;?>
    <!--<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>-->
    <!--<link href='http://fonts.googleapis.com/css?family=Mako' rel='stylesheet' type='text/css'>-->
    <!--<link href='http://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>-->
<script type="text/javascript">
$(document).ready(function(){


    $(function () {
        $('.tooltip').tipsy({ gravity: 's', html: true, opacity: 1});
        $('.tooltip-2').tipsy({ gravity: 'n', html: true, opacity: 1});
    });
    <?php
    $message = $this->Session->flash();
    if($message):
        preg_match('~>(.*?)<~i', $message, $match);
    //echo 'ok';
    ?>
    var message = "<?php echo $match[1]?>";
    if(message!='')
        showAlert(message, 'alert');
    <?php endif;?>

    /*$('.index table tr').click(function(){
        var link = $(this).find('a').first().attr('href');
        window.location.href = link;
        //console.log(link);
    })*/
});

function showAlert(message, type){
    $('.alert').noty({text: message, type: type, "layout":"topCenter"});
}
</script>
</head>
<body class="<?php echo $this->request['controller'];?>">
<div class="alert"><?php echo $this->Session->flash();?><?php echo $this->Session->flash('auth');?></div>
<div id="container">
    <div id="header">
        <div class="center">
            <h1><?php echo $this->Html->link($cakeDescription, '/bookings'); ?></h1>

            <ul id="panel">
                <li>Olá, <?php echo $userData['name'];?></li>
                <li>|</li>
                <li><?php echo $this->Html->link('Sair', '/users/logout');?></li>
            </ul>
            <ul id="nav">
                <?php if ( $userData['role_id'] != 3 ):?>
                <li><?php echo $this->Html->link('Configurações', '/configs'); ?></li>
                <li><?php echo $this->Html->link('Cargos', '/roles'); ?></li>
                <li><?php echo $this->Html->link('Horários', '/schedules'); ?></li>
                <li><?php echo $this->Html->link('Usuários', '/users'); ?></li>
                <li><?php echo $this->Html->link('Equipamentos', '/equipaments'); ?></li>
                <li><?php echo $this->Html->link('Salas', '/classrooms'); ?></li>
                <?php endif;?>
                <li><?php echo $this->Html->link('Reservas', '/bookings'); ?></li>

            </ul>
        </div>
    </div>
    <div id="content">
        <div class="center">
            <?php //echo $this->Html->getCrumbs(' > ', array('url' => '/dashboard', 'text' => 'Início'));?>
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->fetch('content'); ?>
            <div id="footer">
                <?php echo $this->Html->link(
                    $this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
                    '#',
                    array('escape' => false)
                );
                ?>
            </div>
        </div>

    </div>

</div>
<?php
//var_dump($_SESSION['Auth']);
if ( $_SESSION['Auth']['User']['role_id'] == 1 )
    echo $this->element('sql_dump'); ?>
</body>
</html>
