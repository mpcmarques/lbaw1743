<?php
/* Smarty version 3.1.30, created on 2018-02-28 14:21:21
  from "C:\wamp64\www\Site\templates\navbar.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a96bae139b461_14308282',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9efa3a8c3137b270aaedd49d98fa7ae1064dbe90' => 
    array (
      0 => 'C:\\wamp64\\www\\Site\\templates\\navbar.tpl',
      1 => 1519827655,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a96bae139b461_14308282 (Smarty_Internal_Template $_smarty_tpl) {
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a class="navbar-brand mr-auto" href="#"><img src="images/logo.png" alt="Plenum" width='50'>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				  <span class="navbar-toggler-icon"></span>
				</button>
				</a>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
				  <ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="#">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">About</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">FAQ</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Dashboard</a>
					</li>
					<li>
						<form class="form-inline">
							<input class="form-control" type="search" placeholder="Search" aria-label="Search">
						</form>
					</li>
				  	</ul>
				 	 <div class="nav-item dropdown">
						<a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
						  Authentification
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						  <a class="dropdown-item" href="#">Sign In</a>
						  <a class="dropdown-item" href="#">Sign Up</a>
					</div>

				</div>
</nav><?php }
}
