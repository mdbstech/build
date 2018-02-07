<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Agent;



class AgentController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function create()
    {
        $agents = Agent::paginate(10);
        return view('agent.create',compact('agents'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'agent_name' => 'required|max:50',
            'agent_code' => 'required|max:50',
            'mobile_no' => 'required|max:50',
            'phone_no' => 'required|max:50',
            'email' => 'max:50|email',
            'project_name' => 'required|max:50',
            'customers' => 'required|max:50',
            'call_logs' => 'required|max:50',
            'task' => 'required|max:50',
            'targets' => 'required|max:50',
            'sales' => 'required|max:50',         
        ]);

        Agent::create([
            'agent_name' => $request['agent_name'],
            'agent_code' => $request['agent_code'],
            'mobile_no' => $request['mobile_no'],
            'phone_no' => $request['phone_no'],
            'email' => $request['email'],
            'project_name' => $request['project_name'],
            'customers' => $request['customers'],
            'call_logs' => $request['call_logs'],
            'task' => $request['task'],
            'targets' => $request['targets'],
            'sales' => $request['sales'],
            'created_by' => Auth::User()->username,         
        ]);

        return redirect('agent/create');
    }

    public function edit(Agent $agent)
    {
        $agents = Agent::paginate(10);
        return view('agent.edit',compact('agents','agent'));

    }

    public function update(Request $request, Agent  $agent)
        {
        	$this->validate($request, [
             	'agent_name' => 'required|max:50',
            	'agent_code' => 'required|max:50',
            	'mobile_no' => 'required|max:50',
            	'phone_no' => 'required|max:50',
            	'email' => 'max:50|email',
            	'project_name' => 'required|max:50',
            	'customers' => 'max:50',
            	'call_logs' => 'required|max:50',
            	'task' => 'required|max:50',
            	'targets' => 'required|max:50',
            	'sales' => 'required|max:50',
            ]);

            Agent::where('agent_id',$agent->agent_id)->update([
            	'agent_name' => $request['contact_name'],
            	'agent_code' => $request['agent_code'],
            	'mobile_no' => $request['mobile_no'],
            	'phone_no' => $request['phone_no'],
            	'email' => $request['email'],
            	'project_name' => $request['project_name'],
            	'customers' => $request['customers'],
            	'call_logs' => $request['call_logs'],
            	'task' => $request['task'],
            	'targets' => $request['targets'],
            	'sales' => $request['sales'],
            	'updated_by' => Auth::User()->username, 

            	]);

            return redirect('agent/create');
    
        }

  	public function delete(Request $request)
        {
            Agent::where('agent_id',$request->agent_id)->delete();
        }

  	        public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required'
        ]);

        $agents = Agent::
            where('agent_name', 'like', "%$request->search%")
            ->orWhere('agent_code', 'like', "%$request->search%")
            ->orWhere('mobile_no', 'like', "%$request->search%")
            ->orWhere('phone_no', 'like', "%$request->search%")
            ->orWhere('email', 'like', "%$request->search%")
            ->orWhere('project_name', 'like', "%$request->search%")
            ->orWhere('customers', 'like', "%$request->search%")
            ->orWhere('call_logs', 'like', "%$request->search%")
            ->orWhere('task', 'like', "%$request->search%")
            ->orWhere('targets','like', "%$request->search%")
            ->orWhere('sales', 'like', "%$request->search%")
            ->paginate(10)
            ->appends(['search' => $request->search]);
        return view('agent.create',compact('agents'));
    }
  
}
