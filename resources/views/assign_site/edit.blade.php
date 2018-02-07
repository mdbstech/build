@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                   

                    <h4 class="page-title">Assign Sites</h4>
                    <ol class="breadcrumb">
                        <li>
                            <a>Builders &amp; Developers</a>
                        </li>
                        <li>
                            <a>Configuration</a>
                        </li>
                        <li class="active">
                            Edit Assign Site
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
                        <div class="panel-heading">Edit assign site</div>
                        <form class="form-horizontal" action="{{ url('/assign_site/update/'.$assign_site->assign_site_id) }}" method="POST" autocomplete="off" role="form-horizontal" id="assign_site-form" enctype="multipart/form-data">
                            <div class="panel-body">
                                {{ csrf_field() }}
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('contact_id') ? ' has-error' : '' }}">

                                        <label for="contact_id" class="control-label">Contact*</label>

                                        <div class="col-md-12">
                                          <select id="contact_id" name="contact_id" class="form-control" autofocus>
                                              <option value="">Select Contact </option>
                                              @foreach($contacts as $contact)
                                                  <option @if($assign_site->contact_id==$contact->contact_id) selected @endif value="{{ $contact->contact_id }}">{{ $contact->contact_name }}</option>
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
                                    <div class="form-group{{ $errors->has('project_id') ? ' has-error' : '' }}">

                                        <label for="project_id" class="control-label">Project*</label>

                                        <div class="col-md-12">
                                          <select id="project_id" name="project_id" class="form-control" autofocus>
                                              <option value="">Select Project </option>
                                              @foreach($projects as $project)
                                                  <option @if($assign_site->project_id==$project->project_id) selected @endif value="{{ $project->project_id }}">{{ $project->project_name }}</option>
                                              @endforeach
                                          </select>
                                            @if ($errors->has('project_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('project_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('site_id') ? ' has-error' : '' }}">

                                        <label for="site_id" class="control-label">Site*</label>

                                        <div class="col-md-12">
                                          <select id="site_id" name="site_id" class="form-control" autofocus>
                                              <option value="">Select Site </option>
                                              @foreach($sites as $site)
                                                  <option @if($assign_site->site_id==$site->site_id) selected @endif value="{{ $site->site_id }}">{{ $site->site_no }}</option>
                                              @endforeach
                                          </select>
                                            @if ($errors->has('site_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('site_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('assign_date') ? ' has-error' : '' }}">

                                            <label for="assign_date" class="control-label">Assign Date  *</label>

                                        <div class="col-md-12">
                                            <input type="text" class="datepicker-autoclose form-control" id="assign_date" name="assign_date" data-date-format="dd-mm-yyyy" value="{{ date('d-m-Y',strtotime($assign_site->assign_date)) }}">
                                            @if ($errors->has('assign_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('assign_date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                   <div class="form-group{{ $errors->has('reference_no') ? ' has-error' : '' }}">
                                       <div class="col-md-12">
                                         <label for="reference_no" class="control-label">Reference No* </label>
                                          </div>
                                       <div class="col-md-12">
                                           <input type="text" class="form-control" id="reference_no" name="reference_no" placeholder="Reference No" value="{{ $assign_site->reference_no }}">
                                           @if ($errors->has('reference_no'))
                                               <span class="help-block">
                                                   <strong>{{ $errors->first('reference_no') }}</strong>
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
                                            <a href="{{ url('/assign_site/create/'.$assign_site->contact_id) }}" class="btn btn-danger waves-effect waves-light">Discard</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">Assign Sites</div>
                        <div class="panel-body">
                            {{-- <form class="form-group" id="form" action="{{ url('/assign_site/search') }}" method="GET" autocomplete="off" role="search">
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
                                            <th class="text-nowrap">Contact</th>
                                            <th class="text-nowrap">Project</th>
                                            <th class="text-nowrap">Site</th>
                                            <th class="text-nowrap">Assign Date</th>
                                            <th class="text-nowrap">Reference No</th>
                                            <th class="text-nowrap">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=$assign_sites->perPage() * ($assign_sites->currentPage()-1); @endphp
                                        @foreach($assign_sites as $assign_site)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $assign_site->Contact->contact_name }}</td>
                                                <td>{{ $assign_site->Project->project_name }}</td>
                                                <td>{{ $assign_site->Site->site_no }}</td>
                                                <td>
                                                {{ date('d-m-Y',strtotime($assign_site->assign_date)) }}
                                                </td>
                                                <td>{{ $assign_site->reference_no }}</td>
                                                <td class="text-nowrap">
                                                    <a href="{{ url('/assign_site/edit/'.$assign_site->assign_site_id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>
                                                      @if(Auth::User()->user_role=='Super Admin')
                                                        <a onclick="Delete('{{ $assign_site->assign_site_id }}')" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer; cursor:hand"> <i class="fa fa-close text-danger"></i> </a>
                                                        @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($assign_sites->total() > $assign_sites->perPage())
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="pull-right">
                                         {{ $assign_sites->render() }}
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
        function Delete(assign_site_id)
        {
            if(confirm('Do you want to Continue...?'))
            {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('assign_site.delete') }}",
                    data: {
                            assign_site_id: assign_site_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/assign_site/create/".$contact->contact_id) }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/assign_site/create/".$contact->contact_id) }}';
                    }
                });
            }
        }
    </script>
@endsection
