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

// route to show the login form
Route::get('/admin/login', 'Admin\AdminController@show');

// logout
Route::get('/admin/logout', function(){
    Auth::logout();

    return redirect('/admin');
});

// route to process the login form
Route::post('/admin/login', 'Admin\AdminController@login')->name('/admin/login');

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
//TODO: redirecte project/id to project/id/tasks

Route::get('/project/{id}/tasks', 'Project\ProjectTasksController@show');

Route::get('/project/{id}/members', 'Project\ProjectMembersController@show');

Route::get('/project/{id}/forum', 'Project\ProjectForumController@show');

Route::get('/project/{id}/options', 'Project\ProjectOptionsController@show');

Route::get('/project/{id}/manage_tasks', 'Project\ProjectManageTasksController@show');

Route::get('/project/{id}/manage_users', 'Project\ProjectManageUsersController@show');

// search

Route::get('/search/projects', 'Search\SearchProjectsController@show');

Route::get('/search/tasks', 'Search\SearchTasksController@show');

Route::get('/search/users', 'Search\SearchUsersController@show');

// task

Route::get('/task', 'Task\TaskController@show');

Route::get('/task/edit', 'Task\TaskEditController@show');

// profile

Route::get('/profile/{id}', 'ProfileController@show');

// contact

Route::get('/contact', 'ContactController@show');

// about

Route::get('/about', 'AboutController@show');

// faq

Route::get('/faq', 'FaqController@show');

/* Register
Route::view('/register', 'home', ['signupOn' => 'true'])
*/

// Authentication
/*
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');

Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
*/
