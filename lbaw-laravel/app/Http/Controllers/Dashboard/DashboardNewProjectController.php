<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Model\Project;
use App\Model\Joined;

class DashboardNewProjectController extends Controller
{
    public function show()
    {
      return view('new-project');
    }

    function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'private' => 'required|boolean',
        ]);
    }

    function create(array $data) {
      $profile = Auth::user();

      \DB::beginTransaction();

      $project = new Project;

      $project->creationdate = date('Y-m-d H:i:s', strtotime(Carbon::now()));
      $project->name = $data['name'];
      $project->description = $data['description'];
      $project->private = $data['private'];

      $project->save();

      // ----------------------

      $joined = new Joined;

      $joined->iduser = $profile->iduser;
      $joined->idproject = $project->idproject;
      $joined->joineddate = $project->creationdate;
      $joined->role = 'Owner';

      $joined->save();

      \DB::commit();

      return $project;
    }

    public function newProject(Request $request) {
      // $this->validator($request->all())->validate();

      $newProject = $this->newPro($request->all());

      if(empty($newProject)) { // Failed to register project
          redirect('dashboard/new-project'); // Wherever you want to redirect
      }

      if($request->has('projectPicture')){
        $request->projectPicture->move(public_path().'/img/project/', $newProject->idproject.'.png');
      }

      // redirect('project/'.$newProject->idproject);
    }
}
