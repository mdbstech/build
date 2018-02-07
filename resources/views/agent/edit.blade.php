@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">AGENTS</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a>Configuration</a></li>
                    <li class="active">New Agent</li>
                </ol>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">New Agent</div>
                    <form class="form-horizontal" action="{{ url('/agent/store/'.$agent->agent_id) }}" method="POST" autocomplete="off" role="form-horizontal" id="agent-form">
                        <div class="panel-body">
                            {{ csrf_field() }}
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('agent_name') ? ' has-error' : '' }}">
                                <div class="col-md-12"> 
                                    <label for="agent_name" class="control-label">Agent Name *</label>
                                </div>
                                <div class="col-md-12"> 
                                   <input type="text" class="form-control" id="agent_name" name="agent_name" placeholder="Agent Name" value="{{ old('agent_name') }}">
                                    @if ($errors->has('agent_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('agent_name') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('agent_code') ? ' has-error' : '' }}">
                                <div class="col-md-12"> 
                                    <label for="agent_code" class="control-label">Agent Code *</label>
                                </div>
                                <div class="col-md-12"> 
                                    <input type="text" class="form-control" id="agent_code" name="agent_code" placeholder="Agent Code" value="{{ old('agent_code') }}">
                                    @if ($errors->has('agent_code'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('agent_code') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('mobile_no') ? ' has-error' : '' }}">
                                <div class="col-md-12"> 
                                    <label for="mobile_no" class="control-label">Mobile No *</label>
                                </div>
                                <div class="col-md-12"> 
                                    <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Mobile No" value="{{ old('mobile_no') }}">
                                    @if ($errors->has('mobile_no'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('mobile_no') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('phone_no') ? ' has-error' : '' }}">
                                <div class="col-md-12"> 
                                  <label for="phone_no" class="control-label">Phone No* </label>
                                   </div>
                                <div class="col-md-12"> 
                                    <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Phone No" value="{{ old('phone_no') }}">
                                    @if ($errors->has('phone_no'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone_no') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="col-md-12"> 
                                  <label for="email" class="control-label">Email* </label>
                                   </div>
                                <div class="col-md-12"> 
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('project_name') ? ' has-error' : '' }}">
                                <div class="col-md-12"> 
                                  <label for="project_name" class="control-label">Project Name* </label>
                                   </div>
                                <div class="col-md-12"> 
                                    <input type="text" class="form-control" id="project_name" name="project_name" placeholder="Project Name" value="{{ old('project_name') }}">
                                    @if ($errors->has('project_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('project_name') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('customers') ? ' has-error' : '' }}">
                                <div class="col-md-12"> 
                                  <label for="customers" class="control-label">Customers* </label>
                                   </div>
                                  <div class="col-md-12"> 
                                    <input type="text" class="form-control" id="customers" name="customers" placeholder="Customers" value="{{ old('customers') }}">
                                    @if ($errors->has('customers'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('customers') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                            </div>
                        </div>


                        <div class="col-md-6">  
                            <div class="form-group{{ $errors->has('call_logs') ? ' has-error' : '' }}">
                                <div class="col-md-12"> 
                                  <label for="call_logs" class="control-label">Call Logs* </label>
                                   </div>
                                  <div class="col-md-12"> 
                                    <input type="text" class="form-control" id="call_logs" name="call_logs" placeholder="Call Logs" value="{{ old('call_logs') }}">
                                    @if ($errors->has('call_logs'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('call_logs') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                            </div>
                        </div>



                        <div class="col-md-6">  
                            <div class="form-group{{ $errors->has('task') ? ' has-error' : '' }}">
                                <div class="col-md-12"> 
                                  <label for="task" class="control-label">Task* </label>
                                   </div>
                                  <div class="col-md-12"> 
                                    <input type="text" class="form-control" id="task" name="task" placeholder="Task" value="{{ old('task') }}">
                                    @if ($errors->has('task'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('task') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                            </div>
                        </div>

                        <div class="col-md-6">
                           <div class="form-group{{ $errors->has('targets') ? ' has-error' : '' }}">
                                <div class="col-md-12"> 
                                  <label for="targets" class="control-label">Targets* </label>
                                   </div>
                                  <div class="col-md-12"> 
                                    <input type="text" class="form-control" id="targets" name="targets" placeholder="Targets" value="{{ old('targets') }}">
                                    @if ($errors->has('targets'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('targets') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                            </div>
                        </div>
                        
                            
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('sales') ? ' has-error' : '' }}">
                                <div class="col-md-12"> 
                                  <label for="sales" class="control-label">Sales* </label>
                                   </div>
                                  <div class="col-md-12"> 
                                    <input type="text" class="form-control" id="sales" name="sales" placeholder="Sales" value="{{ old('sales') }}">
                                    @if ($errors->has('sales'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('sales') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                            </div>
                        </div>
                     </div>

                        <div class="panel-footer"> 
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                     
                                        <a href="{{ url('/agent/create') }}" class="btn btn-danger waves-effect waves-light">Discard</a>
                                           <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
       
           <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Agents</div>
                    <div class="panel-body">
                        <form class="form-group" id="form" action="{{ url('/agent/search') }}" method="GET" autocomplete="off" role="search">
                            <div class="input-group">
                                <input type="text" id="search" name="search" class="form-control" placeholder="Search">
                                 <span class="input-group-btn">
                                    <button type="submit" class="btn waves-effect waves-light btn-info"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th >#</th>
                                        <th class="text-nowrap" >Agent Name</th>
                                        <th class="text-nowrap" >Agent Code</th>
                                        <th class="text-nowrap">Mobile No</th>
                                        <th class="text-nowrap">Phone No</th>
                                        <th class="text-nowrap">Email Address</th>
                                        <th class="text-nowrap">Project Name</th>
                                        <th class="text-nowrap">Customers</th>
                                        <th class="text-nowrap">Call Logs</th>
                                        <th class="text-nowrap">Task</th>
                                        <th class="text-nowrap">Targets</th>
                                        <th class="text-nowrap">Sales</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=$agents->perPage() * ($agents->currentPage()-1); @endphp
                                    @foreach($agents as $agent)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $agent->agent_name }}</td>
                                            <td>{{ $agent->agent_code }}</td>
                                            <td>{{ $agent->mobile_no }}</td>
                                            <td>{{ $agent->phone_no }}</td>
                                            <td>{{ $agent->email }}</td>
                                            <td>{{ $agent->project_name }}</td>
                                            <td>{{ $agent->customers }}</td>
                                            <td>{{ $agent->call_logs }}</td>
                                            <td>{{ $agent->task }}</td>
                                            <td>{{ $agent->targets }}</td>
                                            <td>{{ $agent->sales }}</td>

                                            <td class="text-nowrap">
                                                <a href="{{ url('/agent/edit/'.$agent->agent_id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>
                                                
                                                    <a onclick="Delete('{{ $agent->agent_id }}')" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer; cursor:hand"> <i class="fa fa-close text-danger"></i> </a>
                                               
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if($agents->total() > $agents->perPage())
                        <div class="panel-footer"> 
                            <div class="row">
                                <div class="pull-right">
                                     {{ $agents->render() }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        function Delete(agent_id) 
        {
            if(confirm('Do you want to Continue...?'))
            {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('agent.delete') }}",
                    data: {
                            agent_id: agent_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/agent/create") }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/agent/create") }}';
                    }
                });
            }
        }
    </script>
@endsection