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
                    <h4 class="page-title">Accounts</h4>
                    <ol class="breadcrumb">
                        <li>
                            <a>Builders &amp; Developers</a>
                        </li>
                        <li>
                            <a>Configuration</a>
                        </li>
                        <li class="active">
                            Edit Accounts
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
                        <div class="panel-heading">Edit Accounts</div>
                        <form class="form-horizontal" action="{{ url('/account/update/'.$account->account_id) }}" method="POST" autocomplete="off" role="form-horizontal" id="account_type-form">
                            <div class="panel-body">
                                {{ csrf_field() }}
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('account_type_id') ? ' has-error' : '' }}">
                                            <div class="col-md-12">
                                                <label for="account_type_id" class="control-label">Account Type *</label>
                                            </div>
                                            <div class="col-md-12">
                                                <select id="account_type_id" name="account_type_id" class="form-control" autofocus>
                                                    <option value="">Select Account Type</option>
                                                    @foreach($account_types as $account_type)
                                                        <option @if($account->account_type_id==$account_type->account_type_id) selected @endif value="{{ $account_type->account_type_id }}">{{ $account_type->account_type }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('account_type_id'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('account_type_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('account_code') ? ' has-error' : '' }}">
                                            <div class="col-md-12">
                                                <label for="account_code" class="control-label">Account Code *</label>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" id="account_code" name="account_code" placeholder="Account Code" value="{{ $account->account_code }}">
                                                @if ($errors->has('account_code'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('account_code') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('account_name') ? ' has-error' : '' }}">
                                            <div class="col-md-12">
                                                <label for="account_name" class="control-label">Account Name *</label>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Account Name" value="{{ $account->account_name }}">
                                                @if ($errors->has('account_name'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('account_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('account_no') ? ' has-error' : '' }}">
                                            <div class="col-md-12">
                                                <label for="account_no" class="control-label">Account No </label>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" id="account_no" name="account_no" placeholder="Account No" value="{{ $account->account_no }}">
                                                @if ($errors->has('account_no'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('account_no') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                            <div class="col-md-12">
                                                <label for="bank_name" class="control-label">Bank Name</label>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Bank Name" value="{{ $account->bank_name }}">
                                                @if ($errors->has('bank_name'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('bank_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('branch_name') ? ' has-error' : '' }}">
                                            <div class="col-md-12">
                                                <label for="branch_name" class="control-label">Branch Name</label>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" id=" branch_name" name="branch_name" placeholder="Branch Name" value="{{ $account->branch_name }}">
                                                @if ($errors->has(' branch_name'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first(' branch_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                         <div class="form-group{{ $errors->has('ifsc_code') ? ' has-error' : '' }}">
                                            <div class="col-md-12">
                                                <label for="ifsc_code" class="control-label">IFSC Code</label>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" placeholder="IFSC Code" value="{{ $account->ifsc_code }}">
                                                @if ($errors->has('ifsc_code'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('ifsc_code') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('account_status') ? ' has-error' : '' }}">
                                            <div class="col-md-12">
                                                <label for="account_status" class="control-label">Account Status</label>
                                            </div>
                                            <div class="col-md-12">
                                                 <select class="form-control" id="account_status" name="account_status">
                                                    <option value="0" @if($account->account_status=='0') selected @endif>Active</option>
                                                    <option value="1" @if($account->account_status=='1') selected @endif>In Active</option>
                                                </select>
                                                @if($errors->has('account_status'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('account_status') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                         <div class="form-group{{ $errors->has('account_description') ? ' has-error' : '' }}">
                                            <div class="col-md-12">
                                                <label for="account_description" class="control-label">Account Description</label>
                                            </div>
                                            <div class="col-md-12">
                                                <textarea type="text" class="form-control" id=" account_description" name="account_description" placeholder="Account Description">{{ $account->account_description }}</textarea>
                                                @if ($errors->has('account_description'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('account_description') }}</strong>
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
                                                <a href="{{ url('/account/create') }}" class="btn btn-danger waves-effect waves-light">Discard</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">Accounts</div>
                        <div class="panel-body">
                            <form class="form-group" id="form" action="{{ url('/account/search') }}" method="GET" autocomplete="off" role="search">
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
                                            <th class="text-nowrap" >Account Name</th>
                                            <th class="text-nowrap">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=$accounts->perPage() * ($accounts->currentPage()-1); @endphp
                                        @foreach($accounts as $account)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $account->AccountType->account_type }}</td>
                                                <td>{{ $account->account_name}}</td>
                                                <td class="text-nowrap">
                                                    <a href="{{ url('/account/edit/'.$account->account_id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>
                                                    @if(Auth::User()->user_role=='Super Admin')
                                                        <a onclick="Delete('{{ $account->account_id }}')" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer; cursor:hand"> <i class="fa fa-close text-danger"></i> </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($accounts->total() > $accounts->perPage())
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="pull-right">
                                         {{ $accounts->render() }}
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
        function Delete(account_id)
        {
            if(confirm('Do you want to Continue...?'))
            {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('account.delete') }}",
                    data: {
                            account_id: account_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/account/create") }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/account/create") }}';
                    }
                });
            }
        }
    </script>
@endsection
