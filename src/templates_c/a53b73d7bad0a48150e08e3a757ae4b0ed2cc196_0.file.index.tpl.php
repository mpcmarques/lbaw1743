<?php
/* Smarty version 3.1.30, created on 2018-02-28 14:21:21
  from "C:\wamp64\www\Site\templates\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a96bae1347d78_33264998',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a53b73d7bad0a48150e08e3a757ae4b0ed2cc196' => 
    array (
      0 => 'C:\\wamp64\\www\\Site\\templates\\index.tpl',
      1 => 1519827655,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:navbar.tpl' => 1,
  ),
),false)) {
function content_5a96bae1347d78_33264998 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" >
	<title>Document</title>
	<meta name="viewport" content="width=device-width,
	intitial-scale=1.0">

	<link rel="stylesheet" href="css/bootstrap.min.css">

	<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="js/bootstrap.min.js"><?php echo '</script'; ?>
>
</head>
<body>

<!-- navbar -->
<?php $_smarty_tpl->_subTemplateRender("file:navbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"navbar"), 0, false);
?>


</body><?php }
}
