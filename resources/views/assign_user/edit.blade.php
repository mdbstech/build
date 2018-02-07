@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    

                    <h4 class="page-title">Assign Users</h4>
                    <ol class="breadcrumb">
                        <li>
                            <a>Builders &amp; Developers</a>
                        </li>
                        <li>
                            <a>Configuration</a>
                        </li>
                        <li class="active">
                            Edit Assign User
                        </li>
                         <li class="active">
                            <a href="{{ url('/contact/display') }}"> Contact</a>
                        </li>
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
                        <div class="panel-heading">Edit assign user</div>
                        <form class="form-horizontal" action="{{ url('/assign_user/update/'.$assign_user->assign_id) }}" method="POST" autocomplete="off" role="form-horizontal" id="assign_user-form" enctype="multipart/form-data">
                            <div class="panel-body">
                                {{ csrf_field() }}
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('assign_date') ? ' has-error' : '' }}">

                                            <label for="assign_date" class="control-label">Assign Date  *</label>

                                        <div class="col-md-12">
                                            <input type="text" class="datepicker-autoclose form-control" id="assign_date" name="assign_date" data-date-format="dd-mm-yyyy" value="{{ date('d-m-Y',strtotime($assign_user->assign_date)) }}">
                                            @if ($errors->has('assign_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('assign_date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">

                                        <label for="user_id" class="control-label">User*</label>

                                        <div class="col-md-12">
                                          <select id="user_id" name="user_id" class="form-control" autofocus>
                                              <option value="">Select User </option>
                                              @foreach($users as $user)
                                                  <option @if($assign_user->user_id==$user->user_id) selected @endif value="{{ $user->user_id }}">{{ $user->username }}</option>
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
                                    <div class="form-group{{ $errors->has('contact_id') ? ' has-error' : '' }}">

                                        <label for="contact_id" class="control-label">Contact*</label>

                                        <div class="col-md-12">
                                          <select id="contact_id" name="contact_id" class="form-control" autofocus>
                                              <option value="">Select Contact </option>
                                              @foreach($contacts as $contact)
                                                  <option @if($assign_user->contact_id==$contact->contact_id) selected @endif value="{{ $contact->contact_id }}">{{ $contact->contact_name }}</option>
                                              @endforeach
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
                                   <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                                       <div class="col-md-12">
                                         <label for="note" class="control-label">Note </label>
                                          </div>
                                       <div class="col-md-12">
                                           <textarea type="text" class="form-control" id="note" name="note" placeholder="note">{{ $assign_user->note }}</textarea>
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
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                                            <a href="{{ url('/assign_user/create/'.$assign_user->contact_id) }}" class="btn btn-danger waves-effect waves-light">Discard</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">Assign Users</div>
                        <div class="panel-body">
                          {{--   <form class="form-group" id="form" action="{{ url('/assign_user/search') }}" method="GET" autocomplete="off" role="search">
                                <div class="input-group">
                                    <input type="text" id="search" name="search" class="form-control" placeholder="Search">
                                     <span class="input-group-btn">
                                        <button type="submit" class="btn waves-effect waves-light btn-info"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </form> --}}
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th >#</th>
                                            <th class="text-nowrap">Assign Date</th>
                                            <th class="text-nowrap">User</th>
                                            <th class="text-nowrap">Contact</th>
                                            <th class="text-nowrap">Note</th>
                                            <th class="text-nowrap">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=$assign_users->perPage() * ($assign_users->currentPage()-1); @endphp
                                        @foreach($assign_users as $assign_user)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>
                                                {{ date('d-m-Y',strtotime($assign_user->assign_date)) }}
                                                </td>
                                                <td>{{ $assign_user->User->username }}</td>
                                                <td>{{ $assign_user->Contact->contact_name }}</td>
                                                <td>{{ $assign_user->note }}</td>
                                                <td class="text-nowrap">
                                                    <a href="{{ url('/assign_user/edit/'.$assign_user->assign_id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>
                                                      @if(Auth::User()->user_role=='Super Admin')
                                                        <a onclick="Delete('{{ $assign_user->assign_id }}')" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer; cursor:hand"> <i class="fa fa-close text-danger"></i> </a>
                                                        @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($assign_users->total() > $assign_users->perPage())
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="pull-right">
                                         {{ $assign_users->render() }}
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
        function Delete(assign_id)
        {
            if(confirm('Do you want to Continue...?'))
            {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('assign_user.delete') }}",
                    data: {
                            assign_id: assign_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/assign_user/create/".$contact->contact_id) }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/assign_user/create/".$contact->contact_id) }}';
                    }
                });
            }
        }
    </script>
@endsection
