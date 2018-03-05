<?php
require('libs/Smarty.class.php');

// create object
$smarty = new Smarty;

$smarty->caching = true;
$smarty->cache_lifetime = 120;
// display it

// Check if user is logged in
// if he is ->
$smarty->display('templates/admin/header.tpl');
// $smarty->display('templates/admin/controlpanel.tpl');
// $smarty->display('templates/common/footer/footer.tpl');

// if not ->
$smarty->display('templates/admin/login/login.tpl');
?>
