<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Priority;

class PriorityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {   
        $id = Priority::max('priority_id');
        $priority_code = $id + 1;
        $length = strlen($priority_code);
        $n = 4 - $length;
        for ($i=0; $i < $n; $i++)
        {
            $priority_code = '0'.$priority_code;
        } 
        $priorities = Priority::paginate(10);
        return view('priority.create',compact('priorities','priority_code'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'priority_code' => 'required|max:20',
            'priority_name' => 'required|max:50',
            'color' => 'required|max:50',
            'description' => 'max:2550',

        ]);

        $priority = Priority::create([
            'priority_code' => $request['priority_code'],
            'priority_name' => $request['priority_name'],
            'color' => $request['color'],
            'description' => $request['description'],
            'created_by' => Auth::User()->username,

        ]);

        return redirect('/priority/create/')->with('success-message', 'Priority '.$priority->priority_name.' is successfully Created...!');
    }
    public function edit(Priority $priority)
    {
        $priorities = Priority::paginate(10);
        return view('priority.edit',compact('priorities','priority'));
    }
    public function update(Request $request, Priority  $priority)
    {
        $this->validate($request, [
            'priority_code' => 'required|max:20',
            'priority_name' => 'required|max:50',
            'color' => 'required|max:50',
            'description' => 'max:2550',
        ]);

        Priority::where('priority_id',$priority->priority_id)->update([
            'priority_code' => $request['priority_code'],
            'priority_name' => $request['priority_name'],
            'color' => $request['color'],
            'description' => $request['description'],
            'updated_by' => Auth::User()->username,

        ]);

        return redirect('/priority/create/')->with('success-message', 'Priority '.$priority->priority_name.' is successfully Updated...!');
    }
    public function delete(Request $request)
    {
        Priority::where('priority_id',$request->priority_id)->delete();
    }
    public function search(Request $request)
    {

        $this->validate($request, [
            'search' => 'required'
        ]);

        $id = Priority::max('priority_id');
        $priority_code = $id + 1;
        $length = strlen($priority_code);
        $n = 4 - $length;
        for ($i=0; $i < $n; $i++)
        {
            $priority_code = '0'.$priority_code;
        } 
        $priorities = Priority::
            where('priority_code', 'like', "%$request->search%")
            ->orwhere('priority_name', 'like', "%$request->search%")
            ->orwhere('color', 'like', "%$request->search%")
            ->orWhere('description', 'like', "%$request->search%")
            ->paginate(10)
            ->appends(['search' => $request->search]);
        return view('priority.create',compact('priorities','priority_code'));
    }

}
