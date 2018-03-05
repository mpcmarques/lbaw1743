<?php
require('libs/Smarty.class.php');

// create object
$smarty = new Smarty;

$smarty->caching = true;
$smarty->cache_lifetime = 120;

// display it
$smarty->display('templates/common/header/header.tpl');
$smarty->display('templates/search/search_tasks.tpl');
$smarty->display('templates/common/footer/footer.tpl');
?>
