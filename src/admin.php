<?php
require('libs/Smarty.class.php');

// create object
$smarty = new Smarty;

$smarty->caching = true;
$smarty->cache_lifetime = 120;
// display it
$smarty->display('templates/common/header.tpl');
$smarty->display('templates/admin/controlpanel.tpl');
$smarty->display('templates/common/footer.tpl');

// Check if user is logged in
// if he is -> goto projects include('projects.php')
// if not -> goto home include('home.php')

?>
