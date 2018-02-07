@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
          <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">PROJECT</h4>            
                </div>
            </div>
            @if(session()->has('success-message'))
                <div class="alert alert-success alert-dismissable">
                    <button type="submit" class="close" data-dismiss="alert" aria-hidden="true"></button>
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
            <div class="row m-t-15">
                <div class="col-md-6">
                    <div class="panel panel-color panel-custom">
                        <div class="panel-heading">
                            <h3 class="panel-title">NEW PROJECT</h3>
                        </div>
                        <form class="form-horizontal" action="{{ url('/project/store') }}" method="POST" autocomplete="off" role="form-horizontal"
                         id="project-form" enctype="multipart/form-data">
                            <div class="panel-body">
                                {{ csrf_field() }}
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('project_code') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="project_code" class="control-label">Project Code *</label>
                                    </div>
                                    <div class="col-md-12">
                                       <input type="text" class="form-control" id="project_code" name="project_code" placeholder="Project Code" value="{{ $project_code }}">
                                    </div>
                                </div>
                             </div>
                             <div class="col-md-6">
                                <div class="form-group{{ $errors->has('project_name') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="project_name" class="control-label">Project Name *</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="project_name" name="project_name" placeholder="Project Name" value="{{ old('project_name') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('project_location') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="project_location" class="control-label">Project Location *</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="project_location" name="project_location" placeholder="Project Location" value="{{ old('project_location') }}">
                                        
                                    </div>
                                </div>
                           </div>
                           <div class="col-md-6">
                                <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                      <label for="city" class="control-label">City* </label>
                                       </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{ old('city') }}">
                                       
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                      <label for="address1" class="control-label">Address 1* </label>
                                       </div>
                                    <div class="col-md-12">
                                        <textarea type="text" class="form-control" id="address1" name="address1" placeholder="Address 1" ">{{ old('address1') }}</textarea>
                                        
                                    </div>
                                </div>
                           </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                      <label for="address2" class="control-label">Address 2 </label>
                                       </div>
                                    <div class="col-md-12">
                                        <textarea type="text" class="form-control" id="address2" name="address2" placeholder="Address 2" >{{ old('address2') }}</textarea>
                                        
                                    </div>
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                      <label for="state" class="control-label">State* </label>
                                       </div>
                                      <div class="col-md-12">
                                        <input type="text" class="form-control" id="state" name="state" placeholder="State" value="{{ old('state') }}">
                                      
                                    </div>
                                </div>
                           </div>

                             <div class="col-md-6">
                                <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                      <label for="country" class="control-label">Country* </label>
                                       </div>
                                      <div class="col-md-12">
                                        <input type="text" class="form-control" id="country" name="country" placeholder="Country" value="{{ old('country') }}">
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group{{ $errors->has('no_of_sites') ? ' has-error' : '' }}">
                                   <div class="col-md-12">
                                     <label for="no_of_sites" class="control-label">No of Sites* </label>
                                      </div>
                                     <div class="col-md-12">
                                       <input type="text" class="form-control" id="no_of_sites" name="no_of_sites" placeholder="no of sites" value="{{ old('no_of_sites') }}">
                                       
                                   </div>
                               </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('project_image') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                      <label for="project_image" class="control-label">Project Image </label>
                                       </div>
                                      <div class="col-md-12">
                                        <input type="file" class="form-control" id="project_images" name="project_image[]" multiple  value="{{ old('project_image') }}">
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pull-right">
                                            <a href="{{ url('/project/create') }}" class="btn btn-danger waves-effect waves-light">Discard</a>
                                            <button type="submit" class="btn btn-default waves-effect waves-light">Save</button>
                                            
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
                            <h3 class="panel-title">PROJECTS</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-group" id="form" action="{{ url('/project/search') }}" method="GET" autocomplete="off" role="search">
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
                                            <th class="text-nowrap" >Project Code</th>
                                            <th class="text-nowrap" >Project Name</th>
                                            
                                            <th class="text-nowrap">No of Sites</th>
                                            <th class="text-nowrap">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=$projects->perPage() * ($projects->currentPage()-1); @endphp
                                        @foreach($projects as $project)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $project->project_code }}</td>
                                                <td>{{ $project->project_name }}</td>
                                                
                                                <td>{{ $project->no_of_sites }}</td>
                                                <td class="text-nowrap">
                                                    <a href="{{ url('/project/edit/'.$project->project_id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>
                                                      @if(Auth::User()->user_role=='Super Admin')
                                                        <a onclick="Delete('{{ $project->project_id }}')" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer; cursor:hand"> <i class="fa fa-close text-danger"></i> </a>
                                                        @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($projects->total() > $projects->perPage())
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="pull-right">
                                         {{ $projects->render() }}
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
        function Delete(project_id)
        {
            if(confirm('Do you want to Continue...?'))
            {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('project.delete') }}",
                    data: {
                            project_id: project_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/project/create") }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/project/create") }}';
                    }
                });
            }
        }
    </script>
@endsection
