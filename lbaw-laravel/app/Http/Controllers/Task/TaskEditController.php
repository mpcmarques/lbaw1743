<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;

use App\Model\Task;
use App\Model\Project;
use App\Model\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class TaskEditController extends Controller
{
    public function show($idproject, $idtask)
    {
      $project = Project::find($idproject);
      $task = Task::find($idtask);

      return view('task_edit', ['task' => $task, 'project' => $project]);
    }

    function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|string',
            'description' => 'required|string',
            'deadline' => 'date'
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
      $task->deadline = $data['deadline'];
      $task->lasteditdate = date('Y-m-d H:i:s', strtotime(Carbon::now()));

      $task->save();

      return redirect('/project/'.$idproject.'/task/'.$idtask);
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

      Task::find($idtask)->tags()->attach($tag->idtag);

      return redirect('/project/'.$idproject.'/task/'.$idtask);
    }

    public function removeTag($idproject, $idtask, $idtag){

      Task::find($idtask)->tags()->detach($idtag);

      return redirect('/project/'.$idproject.'/task/'.$idtask);
    }
}
