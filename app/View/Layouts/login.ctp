<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'Sistema de Reservas - CESUFOZ');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $cakeDescription;?></title>
<style type="text/css">
*{padding:0; margin:0}
body {min-width:335px; min-height:300px; font:14px "Trebuchet MS", Arial, Helvetica, sans-serif }
#login{ width:310px; height:365px; position:absolute; left:50%; top:20%; margin-left:-155px; margin-top:-53px; padding:20px; text-align:center}
#login img{}
#login form {margin:15px 0; width:265px;border-radius:10px; -moz-border-radius:10px; -webkit-border-radius:10px; border:1px solid #ccc; padding:20px;float:left; text-align:left}
#login form label{width: 100%; float:left;}
#login form label span{float:left; text-align:left; margin:-2px 0 0 2px}
#login form label:last-child{}
#login form label span:last-child{float:none;width:150px; margin-left:5px}
#login form input{float:left}
#login form input[type='text'], #login form input[type='password']{border:1px solid #ccc; width:97%;text-align:left; float:left; margin:2px 0 15px; font-size:18px; height:30px; padding:2px}
#login form input[type='submit']{cursor:pointer; margin-top:10px; border-radius:7px; -moz-border-radius:7px; -webkit-border-radius:7px; background:#003d4c; color:#fff;font-size:18px; height:40px; line-height:40px; border:0; width:100%}
#login a{float:left}
#login a:last-child{float:right}
p.error{color: #FF0000}
#recover{position: absolute; right: 47px; bottom: 157px}
#login hr{border: 1px solid #ccc;}
#login h2{margin: 5px 0; font-size: 16px; text-align: center; font-weight: 900}
</style>
</head>
<body>
	<?php echo $this->Session->flash(); ?>
	<?php echo $this->Session->flash('auth'); ?>		
	<?php echo $this->fetch('content'); ?>
	</body>
	</html>