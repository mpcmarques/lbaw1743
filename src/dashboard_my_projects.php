<?php
  require('libs/Smarty.class.php');

  $smarty = new Smarty();
  $smarty->caching = true;
  $smarty->cache_lifetime = 120;

  $page='templates/dashboard/my_projects.tpl';

  $smarty->assign('page', $page);
  $smarty->display('templates/common/header.tpl');
  $smarty->display('templates/dashboard/dashboard.tpl');
  $smarty->display('templates/common/footer/footer.tpl');
?>
