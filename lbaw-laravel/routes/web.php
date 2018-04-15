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

Route::get('/project', 'Project\ProjectTasksController@show');

Route::get('/project/tasks', 'Project\ProjectTasksController@show');

Route::get('/project/members', 'Project\ProjectMembersController@show');

Route::get('/project/forum', 'Project\ProjectForumController@show');

Route::get('/project/options', 'Project\ProjectOptionsController@show');

Route::get('/project/manage_tasks', 'Project\ProjectManageTasksController@show');

Route::get('/project/manage_users', 'Project\ProjectManageUsersController@show');

// search

Route::get('/search/projects', 'Search\SearchProjectsController@show');

Route::get('/search/tasks', 'Search\SearchTasksController@show');

Route::get('/search/users', 'Search\SearchUsersController@show');

// task

Route::get('/task', 'Task\TaskController@show');

Route::get('/task/edit', 'Task\TaskEditController@show');

// profile

Route::view('/profile', 'profile.index');

// contact

Route::view('/contact', 'contact');

// about

Route::view('/about', 'about');

// faq

Route::view('/faq', 'faq.faq');

/* Register
Route::view('/register', 'home', ['signupOn' => 'true'])
*/
