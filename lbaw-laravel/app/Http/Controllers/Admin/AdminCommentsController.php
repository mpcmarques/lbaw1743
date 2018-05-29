<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Comment;

class AdminCommentsController extends Controller
{
    public function show(){
      $comments = Comment::orderBy('idcomment', 'ASC')->get();

      return view('admin.comments_card', ['comments' => $comments]);
    }

    public function search(Request $request){
      $text = $request->input('search-comment');

      if(is_null($text)){
        return redirect()->back();
      }
      else{
        $comments = Comment::where('content', 'ilike', "%{$text}%")->orderBy('idtask','ASC')->get();
      }

      return view('admin.comments_card', ['comments' => $comments]);
    }

    public function removeComments(Request $request){
      $data = $request->all();
      $comments = Comment::orderBy('idcomment', 'ASC')->get();

      foreach($comments as $comment){
        if(isset($data['comment'.$comment->idcomment])){
          $comment->delete();
        }
      }

      return redirect('/admin/comments');
    }
}
