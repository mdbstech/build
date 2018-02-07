@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                   
                    <h4 class="page-title">FollowUP</h4>
                    <ol class="breadcrumb">
                    </ol>
                </div>
            </div>
            @if(session()->has('success-message'))
               <div class="alert alert-success alert-dismissable">
                    <button type="submit" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       {{ session()->get('success-message') }}
               </div>
           @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-inverse">
                       <div class="panel-heading">New FollowUp</div>
                        <form class="form-horizontal" action="{{ url('/calllog/store')}}" method="POST" autocomplete="off" role="form-horizontal" id="callog-form" enctype="multipart/form-data">
                        <div class="panel-body">
                                {{ csrf_field() }}
                                
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('contact_id') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="contact_id" class="control-label">Contact Name *</label>
                                    </div>
                                    <div class="col-md-12">
                                        <select id="contact_id" name="contact_id" class="form-control" autofocus>
                                            
                                           
                                                <option @if(old('contact_id')==$contact->contact_id) selected @endif value="{{ $contact->contact_id }}">{{ $contact->contact_name }}
                                                </option>
                                            
                                        </select> 

                                        @if ($errors->has('contact_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('contact_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('reference_type') ? ' has-error' : '' }}">
                                        <div class="col-md-6">
                                            <label for="reference_type" class="control-label">Reference Type*</label>
                                        </div>
                                        <div class="col-md-12">
                                            <select id="reference_type" type="text" class="form-control" name="   reference_type" onchange="GetData()">
                                                <option @if(old('contact_id')==$contact->contact_id) selected @endif value="{{ $contact->contact_id }}">{{ $contact->reference_type }}
                                                </option>
                                            </select>
                                            @if ($errors->has('reference_type'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('reference_type') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="user_id" class="control-label">Reference *</label>
                                    </div>
                                    <div class="col-md-12">
                                        <select id="user_id" name="user_id" class="form-control" autofocus>
                                            <option value="">Select Agent</option>
                                            @foreach($agents as $agent)
                                                <option @if(old('user_id')==$agent->user_id) selected @endif value="{{ $agent->user_id }}">{{ $agent->username }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('user_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('user_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form_datetime{{ $errors->has('call_log') ? ' has-error' : '' }}">
                                    <div class="col-md-6">
                                        <label for="call_log" class="control-label">Call Log</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="call_log" name="call_log"  data-date-format="d-m-yyyy H:i:s"  value="{{ date('d-m-Y H:i:s') }}" readonly="">

                                        @if ($errors->has('call_log'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('call_log') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form_datetime{{ $errors->has('followup_date') ? ' has-error' : '' }}">
                                    <div class="col-md-6">
                                        <label for="followup_date" class="control-label">FollowUp</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="followup_date" name="followup_date"  data-date-format="d-m-yyyy H:i:s"  value="{{ date('d-m-Y H:i:s') }}" readonly="">

                                        @if ($errors->has('followup_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('followup_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                      <label for="note" class="control-label">Note </label>
                                       </div>
                                      <div class="col-md-12">
                                        <textarea type="text" class="form-control" id="note" name="note" placeholder="Note" value="{{ old('note') }}"></textarea>
                                        @if ($errors->has('note'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('note') }}</strong>
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
                                        <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                            <a href="{{ url('/calllog/create') }}" class="btn btn-danger waves-effect waves-light">Discard</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
             <div class="col-md-6">
                <div class="panel panel-inverse">
                        <div class="panel-heading">FollowUps</div>
                        <div class="panel-body">
                            <form class="form-group" id="form" action="{{ url('/calllog/search') }}" method="GET" autocomplete="off" role="search">
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

                                            
                                            <th class="text-nowrap" >Agent</th>
                                            <th class="text-nowrap" >Call Log</th>
                                            <th class="text-nowrap" >Followup</th>
                                            <th class="text-nowrap" >Note</th>
                                            <th class="text-nowrap">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=$calllogs->perPage() * ($calllogs->currentPage()-1); @endphp
                                        @foreach($calllogs as $calllog)
                                            <tr>

                                               
                                              
                                                <td>{{ $calllog->Agent->username }}</td>
                                                <td>
                                                {{ date('d-m-Y',strtotime($calllog->call_log)) }}
                                                </td>
                                                <td>
                                                {{ date('d-m-Y',strtotime($calllog->followup_date)) }}
                                                </td>
                                                <td>{{ $calllog->note }}</td>
                                                <td class="text-nowrap">
                                                    <a href="{{ url('/calllog/edit/'.$calllog->calllog_id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>
                                                    @if(Auth::User()->user_role=='Super Admin')
                                                        <a onclick="Delete('{{ $calllog->calllog_id }}')" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer; cursor:hand"> <i class="fa fa-close text-danger"></i> </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($calllogs->total() > $calllogs->perPage())
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="pull-right">
                                         {{ $calllogs->render() }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
        </div>

    </div>
</div>
@endsection
@section('js')
 <script type="text/javascript">

        function Delete(calllog_id)
        {
            if(confirm('Do you want to Continue...?'))
            {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('calllog.delete') }}",
                    data: {
                            calllog_id: calllog_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/calllog/create") }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/calllog/create") }}';
                    }
                });
            }
        }
    
    $('#followup_date').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });
    $('#call_log').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });
    
    
</script>
@endsection


