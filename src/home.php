<?php
  require('libs/Smarty.class.php');

  $smarty = new Smarty();
  $smarty->caching = true;
  $smarty->cache_lifetime = 120;

  $smarty->display('templates/common/header/header.tpl');
  $smarty->display('templates/home/home.tpl');
  $smarty->display('templates/common/footer/footer.tpl');
?>