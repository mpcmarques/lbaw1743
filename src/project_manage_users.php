<?php
require('libs/Smarty.class.php');

// create object
$smarty = new Smarty;

$smarty->caching = true;
$smarty->cache_lifetime = 120;
// display it
$smarty->display('templates/common/header/header.tpl');
$smarty->display('templates/project/project_manage_users.tpl');
$smarty->display('templates/common/footer/footer.tpl');
?>
