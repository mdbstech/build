<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Project;
use App\Site;

class ProjectController extends Controller
{
     public function __construct()
    {
         $this->middleware('auth');
    }
    public function create()
    {
      $id = Project::max('project_id');
      $project_code = $id + 1;
      $length = strlen($project_code);
      $n = 4 - $length;
      for ($i=0; $i < $n; $i++)
      {
          $project_code = '0'.$project_code;
      }
        $projects = Project::paginate(10);
        return view('project.create',compact('projects','project_code'));
    }
     public function store(Request $request)
    {
        $this->validate($request, [
            'project_code' => 'required|max:50',
            'project_name' => 'required|max:50',
            'project_location' => 'required|max:50',
            'address1' => 'required|max:50',
            'address2' => 'max:50',
            'city' => 'required|max:50',
            'state' => 'required|max:50',
            'country' => 'required|max:50',
            'no_of_sites' => 'required|max:50',

        ]);

        $project = Project::create([
            'project_code' => $request['project_code'],
            'project_name' => $request['project_name'],
            'project_location' => $request['project_location'],
            'address1' => $request['address1'],
            'address2' => $request['address2'],
            'city' => $request['city'],
            'state' => $request['state'],
            'country' => $request['country'],
            'no_of_sites' => $request['no_of_sites'],
            'created_by' => Auth::User()->username,
        ]);

        if($request->hasFile('project_image'))
        {
            $project_images = $request->file('project_image');
            $name='';
            $i = 1;
            foreach ($project_images as $project_image)
            {
                $filename = 'project_image'.$i . '-' . $project->project_id . '.' . $project_image->getClientOriginalExtension();
                $project_image->storeAs('Project',$filename);
                $name = $filename.','.$name;
                $i = $i+1;
            }
            Project::where('project_id',$project->project_id)->update([
                'project_image' => $name,
            ]);
        }

        return redirect('/project/create/')->with('success-message', 'Project '.$project->project_name.' is successfully created...!');
    }
    public function edit(Project $project)
        {
        	$projects = project::paginate(10);
            return view('project.edit',compact('projects','project'));
        }
        public function update(Request $request, Project  $project)
        {
        	$this->validate($request, [
                'project_code' => 'required|max:50',
                'project_name' => 'required|max:50',
                'project_location' => 'required|max:50',
                'address1' => 'required|max:50',
                'address2' => 'max:50',
                'city' => 'required|max:50',
                'state' => 'required|max:50',
                'country' => 'required|max:50',
                'no_of_sites' => 'required|max:50',
            ]);

            Project::where('project_id',$project->project_id)->update([
                'project_code' => $request['project_code'],
                'project_name' => $request['project_name'],
                'project_location' => $request['project_location'],
                'address1' => $request['address1'],
                'address2' => $request['address2'],
                'city' => $request['city'],
                'state' => $request['state'],
                'country' => $request['country'],
                'no_of_sites' => $request['no_of_sites'],
                'updated_by' => Auth::User()->username,

            	]);

            
            if($request->hasFile('project_image'))
            {
                $project_images = $request->file('project_image');
                $name='';
                $i = 1;
                foreach ($project_images as $project_image)
                {
                    $filename = 'project_image'.$i . '-' . $project->project_id . '.' . $project_image->getClientOriginalExtension();
                    $project_image->storeAs('Project',$filename);
                    $name = $filename.','.$name;
                    $i = $i+1;
                }
                Project::where('project_id',$project->project_id)->update([
                    'project_image' => $name,
                ]);
            }
            return redirect('/project/create/')->with('success-message', 'Project '.$project->project_name.' is successfully updated...!');

        }
        public function delete(Request $request)
        {

            Project::where('project_id',$request->project_id)->delete();
        }

        public function search(Request $request)
    	{
        $this->validate($request, [
            'search' => 'required'
        ]);
        $id = Project::max('project_id');
        $project_code = $id + 1;
        $length = strlen($project_code);
        $n = 4 - $length;
        for ($i=0; $i < $n; $i++)
        {
            $project_code = '0'.$project_code;
        }

        $projects = Project::
            where('project_code', 'like', "%$request->search%")
            ->orWhere('project_name', 'like', "%$request->search%")
            ->orWhere('project_code', 'like', "%$request->search%")
            ->orWhere('project_location', 'like', "%$request->search%")
            ->orWhere('city', 'like', "%$request->search%")
            ->orWhere('address1', 'like', "%$request->search%")
            ->orWhere('address2', 'like', "%$request->search%")
            ->orWhere('state', 'like', "%$request->search%")
            ->orWhere('country', 'like', "%$request->search%")
            ->orWhere('no_of_sites', 'like', "%$request->search%")
            ->paginate(10)
            ->appends(['search' => $request->search]);
        return view('project.create',compact('projects','project_code'));
    }

    public function view(Project $project)
    {
        $projects = Project::paginate(10);
        $sites = Site::where('project_id',$project->project_id)->get();
        return view('project.view',compact('project','projects','sites'));

    }

}
