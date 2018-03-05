<?php
require('../libs/Smarty.class.php');

// create object
$smarty = new Smarty;

// display it
$smarty->display('templates/header.tpl');
$smarty->display('templates/users.tpl');

?>
