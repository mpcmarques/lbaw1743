<?php
  require('libs/Smarty.class.php');

  $smarty = new Smarty();
  $smarty->caching = true;
  $smarty->cache_lifetime = 120;

  $smarty->display('templates/common/header.tpl');
  $smarty->display('templates/about/about.tpl');
  $smarty->display('templates/common/footer.tpl');
?>
