<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Model\Project;

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
            'description' => 'string',
            'private' => 'required|boolean',
        ]);
    }

    function create(array $data)
    {
        return Project::create([
            'creationdate' => Carbon::now()->format('Y-m-d'),
            'name' => $data['name'],
            'description' => $data['description'],
            'private' => $data['private'],
        ]);
    }

    public function newProject(Request $request) {
      $profile = Auth::user();

      echo $request;

      // $this->validator($request->all())->validate();
      //
      $newProject = $this->create($request->all());

      // if(empty($newProject)) { // Failed to register project
      //     redirect('dashboard/new-project'); // Wherever you want to redirect
      // }
      //
      // if($request->has('projectPicture')){
      //   $request->projectPicture->move(public_path().'/img/project/', $newProject->idproject.'.png');
      // }
      //
      // redirect('project/'.$newProject->idproject);
    }
}
