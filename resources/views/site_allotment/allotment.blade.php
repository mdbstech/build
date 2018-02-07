@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                   

                    <h4 class="page-title">SITE ALLOTMENT</h4>
                    
                </div>
            </div><br>
            @if(session()->has('success-message'))
                <div class="alert alert-success alert-dismissable">
                    <button type="submit" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session()->get('success-message') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading"> Site Allotment</div>
                        <form class="form-horizontal" action="{{ url('/site_allotment/update_allotment/'.$site_allotment->site_allotment_id) }}" method="POST" autocomplete="off" role="form-horizontal" id="site-form" enctype="multipart/form-data">
                            <div class="panel-body">
                                {{ csrf_field() }}
                                <div  class="col-md-6">
                                    <div class="form-group{{ $errors->has('contact_id') ? ' has-error' : '' }}">
                                        <label for="contact_id" class="col-md-3 control-label">Contact*</label>
                                        <div class="col-md-8">
                                            <select id="contact_id" name="contact_id" class="form-control" disabled="disabled" autofocus="">
                                                <option @if(old('contact_id')==$contact->contact_id) selected @endif value="{{ $contact->contact_id }}">{{ $contact->contact_name }}
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
                                    <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                        <label for="category_id" class="col-md-3 control-label">Category*</label>
                                        <div class="col-md-8">
                                            <select id="category_id" name="category_id" class="form-control"  autofocus="" disabled="disabled">
                                                <option value="">Select Category </option>
                                                @foreach($categories as $category)
                                                    <option @if($site_allotment->category_id==$category->category_id) selected @endif value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('category_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('category_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('project_id') ? ' has-error' : '' }}">
                                        <label for="project_id" class="col-md-3 control-label">Project*</label>
                                        <div class="col-md-8">
                                            <select id="project_id" name="project_id" class="form-control" disabled="disabled" autofocus="">
                                                <option value="">Select Project </option>
                                                @foreach($projects as $project)
                                                    <option @if($site_allotment->project_id==$project->project_id) selected @endif value="{{ $project->project_id }}">{{ $project->project_name }}</option>
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
                                    <div class="form-group{{ $errors->has('dimension') ? ' has-error' : '' }}">
                                        <label for="dimension" class="col-md-3 control-label">Site Dimension  *</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="dimension" name="dimension" placeholder="site dimension " value="{{ $site_allotment->dimension }}" disabled="disabled" autofocus="">
                                            @if ($errors->has('dimension'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('dimension') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                        <label for="amount" class="col-md-3 control-label"> Amount*</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="amount" name="amount" placeholder="site amount " value="{{ $site_allotment->amount }}" autofocus="" disabled="disabled">
                                            @if ($errors->has('amount'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('amount') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if($site_allotment->site_id != null)
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('site_id') ? ' has-error' : '' }}">
                                            <label for="site_id" class="col-md-3 control-label">Site No*</label>
                                            <div class="col-md-8">
                                                <select id="site_id" name="site_id" class="form-control">
                                                    @foreach($selected_sites as $s_site)
                                                        <option @if($site_allotment->site_id == $s_site->site_id) selected @endif value="{{ $s_site->site_id }}">{{ $s_site->site_no }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endif  
                                @if($site_allotment->site_id == null)
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('site_id') ? ' has-error' : '' }}">
                                            <label for="site_id" class="col-md-3 control-label">Site No*</label>
                                            <div class="col-md-8">
                                                <select id="site_id" name="site_id" class="form-control">
                                                    <option>Select Site</option>
                                                    @foreach($sites as $site)
                                                        <option value="{{ $site->site_id }}">{{ $site->site_no }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endif  
                            </div>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                                            <a href="{{ url('/site_allotment/create') }}" class="btn btn-danger waves-effect waves-light">Discard</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        GetSite();
        function Delete(site_allotment_id)
        {
            if(confirm('Do you want to Continue...?'))
            {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('site_allotment.delete') }}",
                    data: {
                            site_allotment_id: site_allotment_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/site_allotment/create") }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/site_allotment/create") }}';
                    }
                });
            }
        }
    </script>
@endsection
