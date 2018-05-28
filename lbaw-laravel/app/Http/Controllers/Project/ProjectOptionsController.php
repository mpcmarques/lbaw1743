<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Model\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ProjectOptionsController extends Controller
{
  public function show($id)
  {
    $project = Project::findOrFail($id);

    return view('project.options_card', ['project' => $project]);
  }

  public static function delete($project){
    $forumPosts = $project->forumPosts()->get();

    foreach ($forumPosts as $forumPost) {
      $replys = $forumPost->replys()->get();
      foreach ($replys as $reply){
        $reply->delete();
      }

      $forumPost->delete();
    }

    $tasks = $project->tasks()->get();
    foreach ($tasks as $task){
      $comments = $task->comments()->get();
      // echo $comments;

      foreach($comments as $comment){
        $comment->delete();
      }

      $closerequests = $task->closeRequest()->get();
      foreach($closerequests as $closerequest){
        $closerequest->delete();
      }

      $task->tags()->detach();
      $task->assigned()->detach();

      $task->delete();
    }

    $project->members()->detach();

    if (file_exists('img/project/'.$project->idproject.'.png')){
      unlink(public_path().'/img/project/'.$project->idproject.'.png');
    }

    $project->delete();
  }

  public function deleteProject($id){
    $project = Project::findOrFail($id);

    ProjectOptionsController::delete($project);

    return redirect('/');
  }

  function validator(array $data)
  {
      return Validator::make($data, [
          'title' => 'required|string',
          'description' => 'required|string',
          'private' => 'required'
      ]);
  }

  public function editProject(Request $request, $idproject){
    // $this->validator($request->all())->validate();

    $data = $request->all();

    $project = Project::findOrFail($idproject);

    if($request->has('projectPicture')){
      $request->projectPicture->move(public_path().'/img/project/', $project->idproject.'.png');
    }

    $project->name = $data['name'];
    $project->description = $data['description'];
    $project->lasteditdate = date('Y-m-d H:i:s', strtotime(Carbon::now()));
    $project->private = $data['private'];

    $project->save();

    return redirect('/project/'.$idproject);
  }
}
