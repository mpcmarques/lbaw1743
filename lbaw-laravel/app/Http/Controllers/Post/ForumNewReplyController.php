<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Model\Project;
use App\Model\Post;
use App\Model\Reply;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ForumNewReplyController extends Controller
{
  public function show($id)
  {
    $project = Project::findOrFail($id);

    return view('project.new-reply', ['project' => $project]);
  }

  function validator(array $data){
      return Validator::make($data, [
          'content' => 'required|string',]);
  }

  public function newReply(Request $request, $id){
    $this->validator($request->all())->validate();
    $profile = Auth::user();
    $data = $request->all();

    $reply = new Reply;
    $reply->content = $data['content'];
    $reply->creationdate = date('Y-m-d H:i:s', strtotime(Carbon::now()));
    $reply->lasteditdate = date('Y-m-d H:i:s', strtotime(Carbon::now()));
    $reply->idPost = $id;
    $reply->iduser = $profile->iduser;
    $reply->save();

    if(empty($reply)){
      return redirect('/project/'.$id.'/forum/');
    }

    $project = Project::findOrFail($id);
    $project->lasteditdate = date('Y-m-d H:i:s', strtotime(Carbon::now()));
    $project->save();

    return redirect('/project/'.$id.'/forum/');
  }
}
