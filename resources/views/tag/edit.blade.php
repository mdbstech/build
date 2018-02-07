@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="btn-group pull-right m-t-15">
                        <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Settings <span class="m-l-5"><i class="fa fa-cog"></i></span></button>
                        <ul class="dropdown-menu drop-menu-right" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </div>

                    <h4 class="page-title">Tags</h4>
                    
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
                        <div class="panel-heading">Edit tag</div>
                        <form class="form-horizontal" action="{{ url('/tag/update/'.$tag->tag_id) }}" method="POST" autocomplete="off" role="form-horizontal" id="tag-form" enctype="multipart/form-data">
                            <div class="panel-body">
                                {{ csrf_field() }}
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('tag_name') ? ' has-error' : '' }}">

                                        <label for="tag_name" class="control-label">Tag Name *</label>

                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="tag_name" name="tag_name" placeholder="tag name" value="{{ $tag->tag_name }}">
                                            @if ($errors->has('tag_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('tag_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('tag_color') ? ' has-error' : '' }}">

                                            <label for="tag_color" class="control-label">Tag Color *</label>

                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="tag_color" name="tag_color" placeholder="tax rate" value="{{ $tag->tag_color }}">
                                            @if ($errors->has('tag_color'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('tag_color') }}</strong>
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
                                            <a href="{{ url('/tag/create') }}" class="btn btn-danger waves-effect waves-light">Discard</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">Tags</div>
                        <div class="panel-body">
                            <form class="form-group" id="form" action="{{ url('/tag/search') }}" method="GET" autocomplete="off" role="search">
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
                                            <th class="text-nowrap">Tag Name</th>
                                            <th class="text-nowrap">Tag Color</th>
                                            <th class="text-nowrap">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=$tags->perPage() * ($tags->currentPage()-1); @endphp
                                        @foreach($tags as $tag)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $tag->tag_name }}</td>
                                                <td>{{ $tag->tag_color }}</td>

                                                <td class="text-nowrap">
                                                    <a href="{{ url('/tag/edit/'.$tag->tag_id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>
                                                      @if(Auth::User()->user_role=='Super Admin')
                                                        <a onclick="Delete('{{ $tag->tag_id }}')" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer; cursor:hand"> <i class="fa fa-close text-danger"></i> </a>
                                                      @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($tags->total() > $tags->perPage())
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="pull-right">
                                         {{ $tags->render() }}
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
        function Delete(tag_id)
        {
            if(confirm('Do you want to Continue...?'))
            {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('tag.delete') }}",
                    data: {
                            tag_id: tag_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/tag/create") }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/tag/create") }}';
                    }
                });
            }
        }
    </script>
@endsection
