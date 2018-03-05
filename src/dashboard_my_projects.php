<?php
  require('libs/Smarty.class.php');

  $smarty = new Smarty();
  $smarty->caching = true;
  $smarty->cache_lifetime = 120;

  $page='templates/dashboard/tasks.tpl';

  $smarty->assign('page', $page);
  $smarty->display('templates/common/header/header.tpl');
  $smarty->display('templates/dashboard/my_projects.tpl');
  $smarty->display('templates/common/footer/footer.tpl');
?>
