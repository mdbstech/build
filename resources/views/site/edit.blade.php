@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                   

                    <h4 class="page-title">Sites</h4>
                    
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
                            <h3 class="panel-title">EDIT SITE</h3>
                        </div>
                        <form class="form-horizontal" action="{{ url('/site/update/'.$site->site_id) }}" method="POST" autocomplete="off" role="form-horizontal" id="site-form" enctype="multipart/form-data">
                            <div class="panel-body">
                                {{ csrf_field() }}
                              
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('project_id') ? ' has-error' : '' }}">

                                        <label for="project_id" class="control-label">Project*</label>

                                        <div class="col-md-12">
                                          <select id="project_id" name="project_id" class="select2" autofocus>
                                              <option value="">Select Project </option>
                                              @foreach($projects as $project)
                                                  <option @if($site->project_id==$project->project_id) selected @endif value="{{ $project->project_id }}">{{ $project->project_name }}</option>
                                              @endforeach
                                          </select>
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">

                                        <label for="category_id" class="control-label">Category*</label>

                                        <div class="col-md-12">
                                          <select id="category_id" name="category_id" class="select2" autofocus>
                                              <option value="">Select Category </option>
                                              @foreach($categories as $category)
                                                  <option @if($site->category_id==$category->category_id) selected @endif value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                              @endforeach
                                          </select>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('site_no') ? ' has-error' : '' }}">

                                            <label for="site_no" class="control-label">Site No  *</label>

                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="site_no" name="site_no" placeholder="Site no " value="{{ $site->site_no }}">
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('color') ? ' has-error' : '' }}">
                                       
                                        <label for="color" class="control-label">Site Color*</label>
                                        
                                        <div class="col-md-12">
                                            <input type="text" class="colorpicker-rgba form-control" value="rgb(0,194,255,0.78)" id="color" name="color"  data-color-format="rgba" placeholder="Color" value="{{ $site->color }}"> 
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('site_dimension') ? ' has-error' : '' }}">

                                            <label for="site_dimension" class="control-label">Site Dimension  *</label>

                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="site_dimension" name="site_dimension" placeholder="site dimension " value="{{ $site->site_dimension }}">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                   <div class="form-group{{ $errors->has('site_description') ? ' has-error' : '' }}">
                                       <div class="col-md-12">
                                         <label for="site_description" class="control-label">Site Description </label>
                                          </div>
                                       <div class="col-md-12">
                                           <textarea type="text" class="form-control" id="site_description" name="site_description" placeholder="Site description">{{ $site->site_description }}</textarea>
                                           
                                       </div>
                                   </div>
                               </div>
                            </div>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pull-right">
                                           
                                            <a href="{{ url('/site/create') }}" class="btn btn-danger waves-effect waves-light">Discard</a>
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
                            <h3 class="panel-title">SITES</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-group" id="form" action="{{ url('/site/search') }}" method="GET" autocomplete="off" role="search">
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
                                            <th class="text-nowrap">Project</th>
                                           
                                            <th class="text-nowrap">Site No</th>
                                            <th class="text-nowrap">Site Dimension</th>
                                            
                                            <th class="text-nowrap">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=$sites->perPage() * ($sites->currentPage()-1); @endphp
                                        @foreach($sites as $site)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $site->Project->project_name }}</td>
                                                
                                                <td>{{ $site->site_no }}</td>
                                                <td>{{ $site->site_dimension }}</td>
                                                <td class="text-nowrap">
                                                    <a href="{{ url('/site/edit/'.$site->site_id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>
                                                      @if(Auth::User()->user_role=='Super Admin')
                                                        <a onclick="Delete('{{ $site->site_id }}')" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer; cursor:hand"> <i class="fa fa-close text-danger"></i> </a>
                                                        @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($sites->total() > $sites->perPage())
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="pull-right">
                                         {{ $sites->render() }}
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
        function Delete(site_id)
        {
            if(confirm('Do you want to Continue...?'))
            {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('site.delete') }}",
                    data: {
                            site_id: site_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/site/create") }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/site/create") }}';
                    }
                });
            }
        }
    </script>
@endsection
