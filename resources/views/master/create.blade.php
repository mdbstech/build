@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">MASTERS</h4>
                </div>
            </div><br>
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
                       <li> <strong>{{ $error }}</strong></li>
                     @endforeach
                </div>
            @endif
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-color panel-custom">
                        <div class="panel-heading">
                            <h3 class="panel-title">New Master</h3>
                        </div>
                        <form class="form-horizontal" action="{{ url('/master/store') }}" method="POST" autocomplete="off" role="form-horizontal" id="master-form">
                            <div class="panel-body">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('master_name') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="master_name" class="control-label">Master Name *</label>
                                    </div>
                                    <div class="col-md-12">
                                        <select class="select2" id="master_name" name="master_name" autofocus>
                                            <option value="">Select Master Name</option>
                                            <option @if(old('master_name')=='Payment Mode') selected @endif>Payment Mode</option>
                                            <option @if(old('master_name')=='Relationship Type') selected @endif> Relationship Type</option>
                                            <option @if(old('master_name')=='City') selected @endif> City</option>
                                            <option @if(old('master_name')=='Occupation') selected @endif> Occupation</option>
                                            <option @if(old('master_name')=='Reference Type') selected @endif>Reference Type</option>
                                            <option @if(old('master_name')=='Religion') selected @endif>Religion</option>
                                            <option @if(old('master_name')=='Caste') selected @endif>Caste</option>
                                            <option @if(old('master_name')=='Category') selected @endif>Category</option>
                                            <option @if(old('master_name')=='Ticket Status') selected @endif>Ticket Status</option>
                                        </select>
                                       
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('master_value') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="master_value" class="control-label">Master Value *</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="master_value" name="master_value" placeholder="Master Value" value="{{ old('master_value') }}">
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pull-right">
                                            
                                            <a href="{{ url('/master/create') }}" class="btn btn-danger waves-effect waves-light">Discard</a>
                                            <button type="submit" class="btn btn-default waves-effect waves-light">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-color panel-custom">
                        <div class="panel-heading">
                            <h3 class="panel-title">Masters</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-group" id="form" action="{{ url('/master/search') }}" method="GET" autocomplete="off" role="search">
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
                                            <th class="text-nowrap" >Master Name</th>
                                            <th class="text-nowrap" >Master Value</th>
                                        
                                            <th class="text-nowrap">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=$masters->perPage() * ($masters->currentPage()-1); @endphp
                                        @foreach($masters as $master)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $master->master_name }}</td>
                                                <td>{{ $master->master_value }}</td>
                                               
                                                <td class="text-nowrap">
                                                    <a href="{{ url('/master/edit/'.$master->master_id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>
                                                    @if(Auth::User()->user_role=='Super Admin')
                                                        <a onclick="Delete('{{ $master->master_id }}')" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer; cursor:hand"> <i class="fa fa-close text-danger"></i> </a>
                                                      @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($masters->total() > $masters->perPage())
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="pull-right">
                                         {{ $masters->render() }}
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
        function Delete(master_id)
        {
            if(confirm('Do you want to Continue...?'))
            {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('master.delete') }}",
                    data: {
                            master_id: master_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/master/create") }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/master/create") }}';
                    }
                });
            }
        }
    </script>
@endsection
