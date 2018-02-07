<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Site;

use App\Project;

use App\Contact;

use App\Category;

class SiteController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function create()
  {
      $sites = Site::paginate(10);
      $projects = Project::get();
      $categories = Category::get();
      $contacts = Contact::where('contact_type','Member')->get();
      return view('site.create',compact('sites','projects','categories','contacts'));
  }
  public function store(Request $request)
  {
        $this->validate($request, [
            'project_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'site_from' => 'required|numeric',
            'site_to' => 'required|numeric',
            'site_dimension' => 'required|max:50',
            'color' => 'required|max:50',
            'site_description' => 'max:2550',
        ]);


            $site_from = $request->site_from;
            $site_to = $request->site_to;

        for($i=$site_from; $i<=$site_to; $i++)
        {


        $site = Site::create([
            'project_id' => $request['project_id'],
            'category_id' => $request['category_id'],
            'contact_id' => $request['contact_id'],
            'site_no' => $i,
            'site_dimension' => $request['site_dimension'],
            'color' => $request['color'],
            'site_description' => $request['site_description'],
            'created_by' => Auth::User()->username,
      ]);

    }

      return redirect('/site/create/')->with('success-message', 'Site '.$site->site_no.' is successfully Created...!');
  }
  public function edit(Site $site)
      {
          $sites = Site::paginate(10);
          $projects = Project::get();
          $categories = Category::get();
          $contacts = Contact::where('contact_type','Member')->get();
          return view('site.edit',compact('sites','projects','site','categories','contacts'));
      }

      public function update(Request $request, Site  $site)
      {
            $this->validate($request, [
              'project_id' => 'required|numeric',
              'category_id' => 'required|numeric',
              'site_no' => 'required|numeric',
              'site_dimension' => 'required|max:50',
              'color' => 'required|max:50',
              'site_description' => 'max:2550',
            ]);

            Site::where('site_id',$site->site_id)->update([
              'project_id' => $request['project_id'],
              'category_id' => $request['category_id'],
              'contact_id' => $request['contact_id'],
              'site_no' => $request['site_no'],
              'site_dimension' => $request['site_dimension'],
              'color' => $request['color'],
              'site_description' => $request['site_description'],
              'updated_by' => Auth::User()->username,

              ]);

          return redirect('/site/create/')->with('success-message', 'Site '.$site->site_no.' is successfully Updated...!');
       }
       public function delete(Request $request)
       {
           Site::where('site_id',$request->site_id)->delete();
       }
       public function search(Request $request)
    {
       $this->validate($request, [
           'search' => 'required'
       ]);

        $projects = Project::get();
        $categories = Category::get();
        $contacts = Contact::where('contact_type','Member')->get();
        $sites = Site::
           where('site_no', 'like', "%$request->search%")
           ->orWhereHas('Project', function($query) use($request){
               $query->where('project_name','like','%'.$request->search.'%');
           })
           ->orWhereHas('Category', function($query) use($request){
               $query->where('category_name','like','%'.$request->search.'%');
           })
           ->orWhereHas('Contact', function($query) use($request){
               $query->where('contact_name','like','%'.$request->search.'%');
           })
           ->orWhere('site_dimension', 'like', "%$request->search%")
           ->orWhere('site_description', 'like', "%$request->search%")
           
           ->paginate(10)
           ->appends(['search' => $request->search]);
       return view('site.create',compact('sites','projects','categories','contacts'));
    }

}
