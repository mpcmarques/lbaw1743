<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;

use App\Model\Task;
use App\Model\Project;
use App\Model\Tag;
use App\Model\Comment;
use App\Model\CloseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class TaskEditController extends Controller
{
    public function show($idproject, $idtask)
    {
      $project = Project::findOrFail($idproject);
      $task = Task::findOrFail($idtask);

      return view('task.task_edit', ['task' => $task, 'project' => $project]);
    }

    function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|string',
            'description' => 'required|string',
            'deadline' => 'nullable|date'
        ]);
    }

    public function editTask(Request $request, $idproject, $idtask){
      $this->validator($request->all())->validate();

      $data = $request->all();

      // Task::update([
      //     'title' => $data['title'],
      //     'description' => $data['description'],
      //     'lasteditdate' => date('Y-m-d H:i:s', strtotime(Carbon::now()))
      // ], $idtask);

      $task = Task::findOrFail($idtask);

      $task->title = $data['title'];
      $task->description = $data['description'];
      $task->lasteditdate = date('Y-m-d H:i:s', strtotime(Carbon::now()));
      if(isset($data['deadline'])){
        $task->deadline = $data['deadline'];
      }
      else{
        $task->deadline = null;
      }

      $task->save();

      return redirect('/project/'.$idproject.'/task/'.$idtask);
    }

    public function update($idtask){
      $task = Task::findOrFail($idtask);
      $task->lasteditdate = date('Y-m-d H:i:s', strtotime(Carbon::now()));
      $task->save();
    }

    public function addTag(Request $request, $idproject, $idtask){
      $data = $request->all();

      // $tag = Tag::firstOrCreate(['name' => $data['tag']]);  //wish you were here

      $tag = Tag::where('name', $data['tag'])->first();
      if(!$tag){
        $tag = new Tag;
        $tag->name = $data['tag'];
        $tag->save();
      }

      Task::findOrFail($idtask)->tags()->attach($tag->idtag);

      $this->update($idtask);

      return redirect('/project/'.$idproject.'/task/'.$idtask);
    }

    public function removeTag($idproject, $idtask, $idtag){

      Task::findOrFail($idtask)->tags()->detach($idtag);

      $this->update($idtask);

      return redirect('/project/'.$idproject.'/task/'.$idtask);
    }

    public function postComment(Request $request, $idproject, $idtask){
      $data = $request->all();

      $profile = Auth::user();

      $comment = new Comment;
      $comment->content = $data['content'];
      $comment->creationdate = date('Y-m-d H:i:s', strtotime(Carbon::now()));
      $comment->lasteditdate = date('Y-m-d H:i:s', strtotime(Carbon::now()));
      $comment->idtask = $idtask;
      $comment->iduser= $profile->iduser;
      $comment->save();

      $this->update($idtask);

      return redirect('/project/'.$idproject.'/task/'.$idtask);
    }

    public function deleteComment($idproject, $idtask, $idcomment){
      $comment = Comment::findOrFail($idcomment);
      $task = Task::findOrFail($idtask);

      $comment->delete();

      $this->update($idtask);

      return redirect('/project/'.$idproject.'/task/'.$idtask);
    }

    public function complete($idproject, $idtask, $idrequest){
      $closeRequest = CloseRequest::findOrFail($idrequest);
      $task = Task::findOrFail($idtask);

      $closeRequest->approved = true;
      $closeRequest->approveduser = Auth::user()->iduser;
      $closeRequest->approveddate = date('Y-m-d H:i:s', strtotime(Carbon::now()));

      $task->completed = true;
      $task->lasteditdate = date('Y-m-d H:i:s', strtotime(Carbon::now()));
      $task->completetiondate = date('Y-m-d H:i:s', strtotime(Carbon::now()));

      $closeRequest->save();
      $task->save();

      return redirect('/project/'.$idproject.'/task/'.$idtask);
    }
}
