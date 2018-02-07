@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Priority</h4>
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
                <div class="col-md-6">
                   <div class="panel panel-color panel-custom">
                        <div class="panel-heading">
                            <h3 class="panel-title">New Priority</h3>
                        </div>
                        <form class="form-horizontal" action="{{ url('/priority/store')}}" method="POST" autocomplete="off" role="form-horizontal"
                         id="priority-form">
                         <div class="panel-body">
                                {{ csrf_field() }}
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('priority_code') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="priority_code" class="control-label">Priority Code *</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="priority_code" name="priority_code" placeholder="priority name" value="{{ $priority_code }}">   
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('priority_name') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="priority_name" class="control-label">Priority Name *</label>
                                        </div>
                                        <div class="col-md-12">
                                          <input type="text" class="form-control" id="priority_name" name="priority_name" placeholder="priority name" value="{{ old('priority_name') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('color') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="color" class="control-label">Color *</label>
                                        </div>
                                        <div class="col-md-12">
                                         <input type="text" class="colorpicker-rgba form-control"  id="color" name="color"  data-color-format="rgba" placeholder="Color"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="description" class="control-label"> Description   </label>
                                        </div>
                                        <div class="col-md-12">
                                            <textarea type="text" class="form-control" id="description" name="description" placeholder=" description">{{ old('description') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-default waves-effect waves-light">Save</button>
                                            <a href="{{ url('/priority/create') }}" class="btn btn-danger waves-effect waves-light">Discard</a>
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
                            <h3 class="panel-title"> Priorities</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-group" id="form" action="{{ url('/priority/search') }}" method="GET" autocomplete="off" role="search">
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
                                            <th class="text-nowrap"> Code</th>
                                            <th class="text-nowrap">Priority Name</th>
                                            <th class="text-nowrap">Color</th>
                                            <th class="text-nowrap">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=$priorities->perPage() * ($priorities->currentPage()-1); @endphp
                                        @foreach($priorities as $priority)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $priority->priority_code }}</td>
                                                <td>{{ $priority->priority_name }}</td>
                                                <td>{{ $priority->color }}</td>
                                                <td class="text-nowrap">
                                                    <a href="{{ url('/priority/edit/'.$priority->priority_id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>
                                                      @if(Auth::User()->user_role=='Super Admin')
                                                        <a onclick="Delete('{{ $priority->priority_id }}')" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer; cursor:hand"> <i class="fa fa-close text-danger"></i> </a>
                                                        @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($priorities->total() > $priorities->perPage())
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="pull-right">
                                         {{ $priorities->render() }}
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
        function Delete(priority_id)
        {
            if(confirm('Do you want to Continue...?'))
            {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('priority.delete') }}",
                    data: {
                            priority_id: priority_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/priority/create") }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/priority/create") }}';
                    }
                });
            }
        }
    </script>
@endsection
