@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                   <h4 class="page-title">Users</h4>
                </div>
            </div>
            <br>
            @if(session()->has('success-message'))
                <div class="alert alert-success alert-dismissable">
                    <button type="submit" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session()->get('success-message') }}
                           </div>
            @endif
            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                @foreach($errors->all() as $error)
                  <li>  <strong>{{ $error }}</strong></li>
                 @endforeach
            </div>
        @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-color panel-custom">
                        <div class="panel-heading">
                            <h3 class="panel-title">EDIT USERS</h3>
                        </div>
                    <form class="form-horizontal" action="{{ url('/user/update/'.$user->user_id) }}"
                        method="POST" autocomplete="off" role="form-horizontal"
                        id="user-form" enctype="multipart/form-data">
                        <div class="panel-body">
                            {{ csrf_field() }}
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="username" class="control-label">Username *</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{ $user->username }}">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="name" class="control-label"> Name *</label>
                                    </div>
                                    <div class="col-md-12">
                                       <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $user->name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="email" class="control-label">Email *</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ $user->email }}">
                                        
                                    </div>
                                </div>
                            </div>
                          
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('mobile_no') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                      <label for="mobile_no" class="control-label">Mobile No* </label>
                                       </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Mobile No" value="{{ $user->mobile_no }}">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('phone_no') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                      <label for="phone_no" class="control-label">Phone No </label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Phone No" value="{{ $user->phone_no }}">
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                      <label for="address1" class="control-label">Address 1* </label>
                                    </div>
                                    <div class="col-md-12">
                                        <textarea type="text" class="form-control" id="address1" name="address1" placeholder="Address 1" value="">{{ $user->address1 }}</textarea>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                      <label for="address2" class="control-label">Address 2</label>
                                    </div>
                                    <div class="col-md-12">
                                        <textarea type="text" class="form-control" id="address2" name="address2" placeholder="Address 2" value="">{{ $user->address2 }}</textarea>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                      <label for="city" class="control-label">City* </label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{ $user->city }}">
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                      <label for="state" class="control-label">State* </label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="state" name="state" placeholder="State" value="{{ $user->state }}">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                      <label for="country" class="control-label">Country* </label>
                                       </div>
                                      <div class="col-md-12">
                                        <input type="text" class="form-control" id="country" name="country" placeholder="country" value="{{ $user->country }}">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                       <label for="zipcode" class="control-label">Zip Code* </label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Zip Code" value="{{ $user->zipcode }}">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="avatar" class="control-label">Avatar </label>
                                    </div>
                                    <div class="col-md-12">
                                           
                                        <input type="file" id="avatar" name="avatar" class="dropify" data-default-file="{{ asset('public/images/User/') }}/{{ $user->avatar }}"> 
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('user_role') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                       <label for="user_role" class="control-label">User Role* </label>
                                    </div>
                                    <div class="col-md-12">
                                        <select class="form-control" id="user_role" name="user_role">
                                            <option value="{{ $user->user_role }}">Select User Role</option>
                                            <option @if($user->user_role=='Admin') selected @endif >Admin</option>
                                            <option @if($user->user_role=='Agent') selected @endif >Agent</option>
                                            <option @if($user->user_role=='Employee') selected @endif>Employee</option>
                                        </select>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        
                                        <a href="{{ url('/user/create') }}" class="btn btn-danger waves-effect waves-light">Discard</a>
                                        <button type="submit" class="btn btn-default waves-effect waves-light">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-color panel-custom">
                        <div class="panel-heading">
                            <h3 class="panel-title">USERS</h3>
                        </div>
                    <div class="panel-body">
                        <form class="form-group" id="form" action="{{ url('/user/search') }}" method="GET" autocomplete="off" role="search">
                            <div class="input-group">
                                <input type="text" id="search" name="search" class="form-control" placeholder="Search">
                                 <span class="input-group-btn">
                                    <button type="submit" class="btn waves-effect waves-light btn-default"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th >#</th>
                                        <th class="text-nowrap" >User Name</th>
                                        <th class="text-nowrap" >Name </th>
                                        
                                        <th class="text-nowrap">User Role</th>
                                        <th class="text-nowrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=$users->perPage() * ($users->currentPage()-1); @endphp
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->name }}</td>
                                           
                                            <td>{{ $user->user_role }}</td>
                                            <td class="text-nowrap">
                                                <a href="{{ url('/user/edit/'.$user->user_id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>
                                                <a href="{{ url('/user/view/'.$user->user_id) }}" data-toggle="tooltip" data-original-title="View"> <i class="fa fa-eye text-inverse m-r-10"></i></a>
                                                @if(Auth::User()->user_role=='Super Admin')
                                                    <a onclick="Delete('{{ $user->user_id }}')" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer; cursor:hand"> <i class="fa fa-close text-danger"></i> </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if($users->total() > $users->perPage())
                        <div class="panel-footer">
                            <div class="row">
                                <div class="pull-right">
                                     {{ $users->render() }}
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
        function Delete(user_id)
        {
            if(confirm('Do you want to Continue...?'))
            {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('user.delete') }}",
                    data: {
                            user_id: user_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/user/create") }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/user/create") }}';
                    }
                });
            }
        }
    </script>
@endsection
