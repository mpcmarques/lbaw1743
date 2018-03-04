<?php
require('libs/Smarty.class.php');

// create object
$smarty = new Smarty;

$smarty->caching = true;
$smarty->cache_lifetime = 120;
// display it
$smarty->display('templates/common/header.tpl');
$smarty->display('templates/profile.tpl');
$smarty->display('templates/common/footer/footer.tpl');
?>
