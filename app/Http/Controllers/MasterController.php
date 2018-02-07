<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Master;

class MasterController extends Controller
{
     public function __construct()
     {
         $this->middleware('auth');
     }

    public function create()
    {
        $masters = Master::paginate(10);
        return view('master.create',compact('masters'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'master_name' => 'required|max:50',
            'master_value' => 'required|max:50',
            

        ]);

        $master = Master::create([
            'master_name' => $request['master_name'],
            'master_value' => $request['master_value'],
          
            'created_by' => Auth::User()->username,
        ]);

        return redirect('/master/create/')->with('success-message', 'Master '.$master->master_name.' is successfully Created...!');
    }

        public function edit(Master $master)
        {
        	$masters = Master::paginate(10);
            return view('master.edit',compact('masters','master'));
        }

        public function update(Request $request, Master  $master)
        {
        	$this->validate($request, [
            'master_name' => 'required|max:50',
            'master_value' => 'required|max:50',
            
            ]);

            Master::where('master_id',$master->master_id)->update([
            	'master_name' => $request['master_name'],
            	'master_value' => $request['master_value'],
            
            	'updated_by' => Auth::User()->username,

            	]);

            return redirect('/master/create/')->with('success-message', 'Master '.$master->master_name.' is successfully Updated...!');

        }

        public function delete(Request $request)
        {
            Master::where('master_id',$request->master_id)->delete();
        }
    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required'
        ]);

        $masters = Master::
            where('master_name', 'like', "%$request->search%")
            ->orWhere('master_value', 'like', "%$request->search%")
           
            ->paginate(10)
            ->appends(['search' => $request->search]);
        return view('master.create',compact('masters'));
    }
}
