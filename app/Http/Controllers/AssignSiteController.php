<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\AssignSite;

use App\Contact;

use App\Project;

use App\Site;

class AssignSiteController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function create(Contact $contact)
  {
      $assign_sites = AssignSite::where('contact_id',$contact->contact_id)->paginate(10);
      $contacts = Contact::get();
      $projects = Project::get();
      $sites = Site::get();
      //$contact_id = $contact->contact_id;
      return view('assign_site.create',compact('assign_sites','contacts','projects','sites','contact'));
  }
  public function store(Request $request)
  {
      $this->validate($request, [
          'assign_date' => 'required|max:50',
          'reference_no' => 'required|max:50',
          'contact_id' => 'required|numeric',
          'project_id' => 'required|numeric',
          'site_id' => 'required|numeric',

      ]);

      $assign_site = AssignSite::create([
          'assign_date' => $request['assign_date'],
          'reference_no' => $request['reference_no'],
          'contact_id' => $request['contact_id'],
          'project_id' => $request['project_id'],
          'site_id' => $request['site_id'],
          'created_by' => Auth::User()->username,
      ]);

      return redirect('/assign_site/create/'.$assign_site->contact_id)->with('success-message', 'AssignSite '.$assign_site->contact_id.' is successfully Created...!');
  }
  public function edit(AssignSite $assign_site)
      {
          $assign_sites = AssignSite::where('contact_id',$assign_site->contact_id)->paginate(10);
          $contacts = Contact::get();
          $projects = Project::get();
          $sites = Site::get();
          return view('assign_site.edit',compact('assign_sites','contacts','projects','sites','assign_site','contact'));
      }
      public function update(Request $request,AssignSite  $assign_site)
      {
            $this->validate($request, [
              'assign_date' => 'required|max:50',
              'reference_no' => 'required|max:50',
              'contact_id' => 'required|numeric',
              'project_id' => 'required|numeric',
              'site_id' => 'required|numeric',
            ]);

          AssignSite::where('assign_site_id',$assign_site->assign_site_id)->update([
            'assign_date' => $request['assign_date'],
            'reference_no' => $request['reference_no'],
            'contact_id' => $request['contact_id'],
            'project_id' => $request['project_id'],
            'site_id' => $request['site_id'],
            'updated_by' => Auth::User()->username,

              ]);

          return redirect('/assign_site/create/'.$assign_site->contact_id)->with('success-message', 'AssignSite '.$assign_site->contact_id.' is successfully Updated...!');
       }
       public function delete(Request $request)
       {
          //$assign_site = AssignSite::where('assign_site_id',$request->assign_site_id)->first();
          AssignSite::where('assign_site_id',$request->assign_site_id)->delete();

          //return resource()->json($assign_site);
       }

       /*public function search(Request $request)
    {
       $this->validate($request, [
           'search' => 'required'
       ]);


       $contacts = Contact::get();
       $projects =Project::get();
       $sites = Site::get();
       $assign_sites =AssignSite::
           whereHas('Project', function($query) use($request){
               $query->where('project_name','like','%'.$request->search.'%');
           })
           ->orWhereHas('Contact', function($query) use($request){
               $query->where('contact_name','like','%'.$request->search.'%');
           })
           ->orWhereHas('Site', function($query) use($request){
               $query->where('site_no','like','%'.$request->search.'%');
           })
           ->orWhere('reference_no', 'like', "%$request->search%")
           ->orWhere('assign_date', 'like', "%$request->search%")
           ->paginate(10)
           ->appends(['search' => $request->search]);
       return view('assign_site.create',compact('assign_sites','contacts','projects','sites'));
    }
*/
}
