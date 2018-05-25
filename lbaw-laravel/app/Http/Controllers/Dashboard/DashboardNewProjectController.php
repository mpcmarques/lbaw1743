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
            'name' => 'required|string',
            'description' => 'required|string',
            'private' => 'required|string',
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

      $project->members()->attach($profile->iduser,['joineddate' => date('Y-m-d H:i:s', strtotime(Carbon::now())),
                                            'role' => 'Owner']);

      \DB::commit();

      return $project;
    }

    public function newProject(Request $request) {
      $this->validator($request->all())->validate();

      $newProject = $this->create($request->all());

      if(empty($newProject)) { // Failed to register project
          redirect('dashboard/new-project'); // Wherever you want to redirect
      }

      if($request->has('projectPicture')){
        $request->projectPicture->move(public_path().'/img/project/', $newProject->idproject.'.png');
      }

      return redirect('project/'.$newProject->idproject);
    }
}
