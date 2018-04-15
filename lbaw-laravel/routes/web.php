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

/* admin */
Route::get('/admin', 'Admin\AdminController@show');

Route::get('/admin/users', 'Admin\AdminUsersController@show');

Route::get('/admin/projects', 'Admin\AdminProjectsController@show');

/* page */
Route::get('/','HomeController@show');

Route::get('/dashboard', 'Dashboard\DashboardController@show');

Route::get('/dashboard/tasks', 'Dashboard\DashboardTasksController@show');

Route::get('/dashboard/projects', 'Dashboard\DashboardProjectsController@show');

Route::view('/project_tasks', 'project.tasks_card');
Route::view('/project_members', 'project.members_card');
Route::view('/project_forum', 'project.forum_card');
Route::view('/project_options', 'project.options_card');
Route::view('/project_manage_tasks', 'project.manage_tasks_card');
Route::view('/project_manage_users', 'project.manage_users_card');

Route::view('/search_projects', 'search.projects_card');
Route::view('/search_tasks', 'search.tasks_card');
Route::view('/search_users', 'search.users_card');

Route::view('/task', 'task');
Route::view('/task/edit', 'task_edit');

Route::view('/profile', 'profile.index');

Route::view('/contact', 'contact');

Route::view('/about', 'about');

Route::view('/faq', 'faq.faq');

Route::view('/dashboard/new-project', 'new-project');

/* Register
Route::view('/register', 'home', ['signupOn' => 'true'])
*/
