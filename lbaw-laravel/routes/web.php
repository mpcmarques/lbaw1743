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

/* ========> Mark admin */

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

/* =========> MARK: app */

Route::get('/','HomeController@show');

// login
Route::get('login', 'HomeController@showLogin');
Route::post('login', 'HomeController@login')->name('login');

// register
Route::get('register', 'HomeController@showRegisterModal');
Route::post('register', 'HomeController@register')->name('register');

// logout
Route::get('/logout', function(){
    Auth::logout();
    return redirect('/');
});

// dashboard

Route::get('/dashboard', 'Dashboard\DashboardController@show')->middleware('auth');

Route::get('/dashboard/tasks', 'Dashboard\DashboardTasksController@show')->middleware('auth');

Route::get('/dashboard/projects', 'Dashboard\DashboardProjectsController@show')->middleware('auth');

// project

Route::get('/dashboard/new-project', 'Dashboard\DashboardNewProjectController@show')->middleware('auth');
Route::post('/dashboard/new-project/', 'Dashboard\DashboardNewProjectController@newProject');

Route::get('/project/{id}', function($id){
  return redirect('/project/'.$id.'/tasks');
});

Route::get('/project/{id}/tasks', 'Project\ProjectTasksController@show')->middleware('project');

Route::get('/project/{id}/members', 'Project\ProjectMembersController@show')->middleware('project');

Route::get('/project/{id}/forum', 'Project\ProjectForumController@show')->middleware('project');

Route::get('/project/{id}/options', 'Project\ProjectOptionsController@show')->middleware('project')->middleware('owner');
Route::post('/project/{id}/options', 'Project\ProjectOptionsController@editProject')->middleware('project')->middleware('owner');

Route::get('/project/{id}/options/delete', 'Project\ProjectOptionsController@delete')->middleware('owner');

Route::get('/project/{id}/manage_tasks', 'Project\ProjectManageTasksController@show')->middleware('project')->middleware('manager');
Route::post('/project/{id}/manage_tasks/remove', 'Project\ProjectManageTasksController@remove')->middleware('project')->middleware('manager');

Route::get('/project/{id}/manage_users', 'Project\ProjectManageUsersController@show')->middleware('project')->middleware('manager');
Route::post('/project/{id}/manage_users/remove', 'Project\ProjectManageUsersController@remove')->middleware('project')->middleware('manager');
Route::post('/project/{id}/manage_users/update', 'Project\ProjectManageUsersController@update')->middleware('project')->middleware('manager');

Route::get('/project/{id}/join/{iduser}', 'Project\ProjectController@join')->middleware('project');
Route::get('/project/{id}/leave/{iduser}', 'Project\ProjectController@leave')->middleware('project');

Route::get('/project/{id}/new-task', 'Project\ProjectNewTaskController@show')->middleware('project');
Route::post('/project/{id}/new-task', 'Project\ProjectNewTaskController@newTask')->middleware('project');

// search
Route::post('/search', 'Search\SearchController@search')->name('/search');

// Route::get('/search/{text}', function($text){
//   return redirect('/search/'.$text.'/projects');
// });

Route::get('/search/{text}', 'Search\SearchController@show');

Route::get('/search/{text}/projects', 'Search\SearchProjectsController@show');

Route::get('/search/{text}/tasks', 'Search\SearchTasksController@show');

Route::get('/search/{text}/users', 'Search\SearchUsersController@show');

// task

Route::get('project/{id}/task/{idTask}', 'Task\TaskController@show')->middleware('project')->middleware('task');
Route::get('project/{id}/task/{idTask}/delete', 'Task\TaskController@delete')->middleware('project')->middleware('task')->middleware('deleteTask');

Route::get('project/{id}/task/{idTask}/assign', 'Task\TaskController@assign')->middleware('project')->middleware('task')->middleware('assignTask');
Route::get('project/{id}/task/{idTask}/unassign', 'Task\TaskController@unassign')->middleware('project')->middleware('task')->middleware('unassignTask');

Route::get('project/{id}/task/{idTask}/edit', 'Task\TaskEditController@show')->middleware('project')->middleware('task')->middleware('editTask');
Route::post('project/{id}/task/{idTask}/edit', 'Task\TaskEditController@editTask')->middleware('project')->middleware('task')->middleware('editTask');

Route::post('project/{id}/task/{idTask}/comment', 'Task\TaskEditController@postComment')->middleware('project')->middleware('task')->middleware('commentTask');
Route::get('project/{id}/task/{idTask}/delete-comment/{idComment}', 'Task\TaskEditController@deleteComment');

Route::get('project/{id}/task/{idTask}/new-cr', 'Task\TaskNewCloseRequestController@show');
Route::post('project/{id}/task/{idTask}/new-cr', 'Task\TaskNewCloseRequestController@newCloseRequest');
Route::get('project/{id}/task/{idTask}/approve-cr/{idUser}', 'Task\TaskEditController@complete');

// tags

Route::post('project/{id}/task/{idTask}/add-tag', 'Task\TaskEditController@addTag');
Route::get('project/{id}/task/{idTask}/remove-tag/{idTag}', 'Task\TaskEditController@removeTag');

// profile

Route::get('/profile/{id}', 'ProfileController@show');

Route::get('/profile/{id}/edit', 'ProfileController@showEditModal');
Route::post('/profile/{id}/edit', 'ProfileController@editProfile');

Route::get('/profile/{id}/delete', 'ProfileController@deleteProfile');

// contact

Route::get('/contact', 'ContactController@show');

// about

Route::get('/about', 'AboutController@show');

// faq

Route::get('/faq', 'FaqController@show');
