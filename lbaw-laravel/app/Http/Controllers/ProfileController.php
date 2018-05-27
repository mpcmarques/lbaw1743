<?php

namespace App\Http\Controllers;

use App\Model\User;
use App\Model\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
  public function show($id)
  {
    $profile = User::findOrFail($id);

    return view('profile.index', ['profile' => $profile]);
  }

  function showEditModal($id)
  {
    $profile = User::findOrFail($id);

    return view('profile.index', ['profile' => $profile], ['editProfile' => true]);
  }

  /**
  * Handle a update request for the application.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function editProfile(Request $request) {
    $profile = Auth::user();

    $data = $request->all();

    if($request->has('profilePicture')){
      $request->profilePicture->move(public_path().'/img/profile/', $profile->iduser.'.png');
    }

    if($data['name'] != $profile->name){
      Validator::make($data,['name' => 'required|string|max:255'])->validate();
      $profile->name = $data['name'];
    }

    if($data['username'] != $profile->username){
      Validator::make($data,['username' => 'required|string|unique:usertable'])->validate();
      $profile->username = $data['username'];
    }

    if($data['email'] != $profile->email){
      Validator::make($data,['email' => 'required|string|email|max:255|unique:usertable'])->validate();
      $profile->email = $data['email'];
    }

    if($data['description'] != $profile->description){
      $profile->description = $data['description'];
    }

    if($data['institution'] != $profile->institution){
      $profile->institution = $data['institution'];
    }

    if($data['birthdate'] != $profile->birthdate){
      Validator::make($data,['birthdate' => 'required|date'])->validate();
      $profile->birthdate = $data['birthdate'];
    }

    if($data['password'] != '' && bcrypt($data['password']) != $profile->password && $data['password'] == $data['password_confirmation']){
      Validator::make($data,['password' => 'required|string|min:6|confirmed'])->validate();
      $profile->password = bcrypt($data['password']);
    }

    if($data['gender'] != $profile->gender){
      $profile->gender = $data['gender'];
    }

    $profile->save();

    return redirect('/profile/'.$profile->iduser);
  }

  public function deleteProfile($iduser){
    $user = User::findOrFail($iduser);

    if( !(Auth::check() && Auth::user() == $user) ){
      return redirect('/profile/'.$user->iduser);
    }

    foreach ($user->projects as $project) {
      if($project->owner->contains('iduser', $user->iduser)){
        return redirect('/profile/'.$user->iduser);
      }
    }

    $premiumSignatures = $user->premiumSignatures()->get();
    foreach ($premiumSignatures as $premiumSignature) {
      $premiumSignature->delete();
    }

    $forumPosts = $user->forumPosts()->get();
    foreach ($forumPosts as $forumPost) {
      $replys = $forumPost->replys()->get();
      foreach ($replys as $reply){
        $reply->delete();
      }

      $forumPost->delete();
    }

    $comments = $user->comments()->get();
    foreach ($comments as $comment) {
      $comment->delete();
    }

    $user->assignedTasks()->detach();

    $tasks = $user->tasks()->get();
    foreach ($tasks as $task){
      $comments = $task->comments()->get();
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

    $user->projects()->detach();

    //TODO: Banned record

    if (file_exists('img/profile/'.$user->iduser.'.png')){
      unlink(public_path().'/img/profile/'.$user->iduser.'.png');
    }

    //$user->delete();

    return redirect('/logout');
  }
}
