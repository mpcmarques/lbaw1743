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

/* ==> Mark admin */

Route::get('/admin', 'Admin\AdminController@show');

Route::get('/admin/users', 'Admin\AdminUsersController@show');

Route::get('/admin/projects', 'Admin\AdminProjectsController@show');

/* ==> MARK: app */

Route::get('/','HomeController@show');

// dashboard

Route::get('/dashboard', 'Dashboard\DashboardController@show');

Route::get('/dashboard/tasks', 'Dashboard\DashboardTasksController@show');

Route::get('/dashboard/projects', 'Dashboard\DashboardProjectsController@show');

Route::get('/dashboard/new-project', 'Dashboard\DashboardNewProjectController@show');

// project

Route::get('/project/tasks', 'Project\ProjectTasksController@show');

Route::get('/project/members', 'Project\ProjectMembersController@show');

Route::get('/project/forum', 'Project\ProjectForumController@show');

Route::get('/project/options', 'Project\ProjectOptionsController@show');

Route::get('/project/manage_tasks', 'Project\ProjectManageTasksController@show');

Route::get('/project/manage_users', 'Project\ProjectManageUsersController@show');

// search

Route::view('/search_projects', 'search.projects_card');
Route::view('/search_tasks', 'search.tasks_card');
Route::view('/search_users', 'search.users_card');

Route::view('/task', 'task');
Route::view('/task/edit', 'task_edit');

Route::view('/profile', 'profile.index');

Route::view('/contact', 'contact');

Route::view('/about', 'about');

Route::view('/faq', 'faq.faq');

/* Register
Route::view('/register', 'home', ['signupOn' => 'true'])
*/
