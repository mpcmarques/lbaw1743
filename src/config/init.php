<?php
$BASE_DIR = '/home/jotapsa/git/lbaw1743/src';

require($BASE_DIR . '/libs/Smarty.class.php');

$smarty = new Smarty();
$smarty->caching = true;
$smarty->cache_lifetime = 120;
?>
