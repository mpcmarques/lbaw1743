<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Model\Project;
use App\Model\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ProjectNewPostController extends Controller
{
  public function show($id)
  {
    $project = Project::findOrFail($id);

    return view('project.new-post', ['project' => $project]);
  }

  function validator(array $data){
      return Validator::make($data, [
          'title' => 'required|string',
          'content' => 'required|string',
      ]);
  }

  public function newPost(Request $request, $id){
    $this->validator($request->all())->validate();
    $profile = Auth::user();
    
    $data = $request->all();

    $post = new Post;
    $post->title = $data['title'];
    $post->content = $data['content'];
    $post->creationdate = date('Y-m-d H:i:s', strtotime(Carbon::now()));
    $post->lasteditdate = date('Y-m-d H:i:s', strtotime(Carbon::now()));
    $post->idproject = $id;
    $post->iduser = $profile->iduser;
    $post->save();

    if(empty($post)){
      return redirect('/project/'.$id);
    }

    $project = Project::findOrFail($id);
    $project->lasteditdate = date('Y-m-d H:i:s', strtotime(Carbon::now()));
    $project->save();

    return redirect('/project/'.$id.'/forum/');
  }
}
