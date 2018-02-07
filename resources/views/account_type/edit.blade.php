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
                    <h4 class="page-title">Account Types</h4>
                    <ol class="breadcrumb">
                        <li>
                            <a>Builders &amp; Developers</a>
                        </li>
                        <li>
                            <a>Configuration</a>
                        </li>
                        <li class="active">
                            Edit AccountTypes
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
                    <div class="panel-heading">Edit Account Types</div>
                    <form class="form-horizontal" action="{{ url('/account_type/update/'.$account_type->account_type_id) }}" method="POST" autocomplete="off" role="form-horizontal" id="account_type-form" enctype="multipart/form-data">
                        <div class="panel-body">
                            {{ csrf_field() }}

                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('account_type') ? ' has-error' : '' }}">

                                        <label for="account_type" class="control-label">Account Type *</label>

                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="account_type" name="account_type" placeholder="Project Name" value="{{ $account_type->account_type }}">
                                        @if ($errors->has('account_type'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('account_type') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('account_type_description') ? ' has-error' : '' }}">

                                        <label for="account_type_description" class="control-label">AccountType description </label>

                                    <div class="col-md-12">
                                        <textarea type="text" class="form-control" id="account_type_description" name="account_type_description" placeholder="AccountType Description"> {{ $account_type->account_type_description }}</textarea>
                                        @if ($errors->has('account_type_description'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('account_type_description') }}</strong>
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
                                        <a href="{{ url('/account_type/create') }}" class="btn btn-danger waves-effect waves-light">Discard</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-inverse">
                    <div class="panel-heading">Account Types</div>
                    <div class="panel-body">
                        <form class="form-group" id="form" action="{{ url('/account_type/search') }}" method="GET" autocomplete="off" role="search">
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
                                       <th class="text-nowrap" >Account Type</th>
                                        <th class="text-nowrap" >Account Description</th>
                                        <th class="text-nowrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=$account_types->perPage() * ($account_types->currentPage()-1); @endphp
                                    @foreach($account_types as $account_type)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $account_type->account_type }}</td>
                                            <td>{{ $account_type->account_type_description }}</td>
                                            <td class="text-nowrap">
                                                <a href="{{ url('/account_type/edit/'.$account_type->account_type_id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>

                                                    <a onclick="Delete('{{ $account_type->account_type_id }}')" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer; cursor:hand"> <i class="fa fa-close text-danger"></i> </a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if($account_types->total() > $account_types->perPage())
                        <div class="panel-footer">
                            <div class="row">
                                <div class="pull-right">
                                     {{ $account_types->render() }}
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
        function Delete(account_type_id)
        {
            if(confirm('Do you want to Continue...?'))
            {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('account_type.delete') }}",
                    data: {
                            account_type_id: account_type_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/account_type/create") }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/account_type/create") }}';
                    }
                });
            }
        }
    </script>
@endsection
