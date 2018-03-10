<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'home');
Route::view('/admin', 'admin');

Route::view('/dashboard', 'dashboard.dashboard_card');
Route::view('/dashboard_tasks', 'dashboard.tasks_card');
Route::view('/dashboard_my_projects', 'dashboard.my_projects_card');

Route::view('/project_tasks', 'project.tasks_card');
Route::view('/project_members', 'project.members_card');
Route::view('/project_forum', 'project.forum_card');
Route::view('/project_options', 'project.options_card');
Route::view('/project_manage_tasks', 'project.manage_tasks_card');
Route::view('/project_manage_users', 'project.manage_users_card');

Route::view('/profile', 'profile');

Route::view('/contact', 'contact');

Route::view('/about', 'contact');

Route::view('/faq', 'faq');

/* Register
Route::view('/register', 'home', ['signupOn' => 'true'])
*/
