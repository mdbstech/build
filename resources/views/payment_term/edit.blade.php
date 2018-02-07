@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                  

                    <h4 class="page-title">Payment Terms</h4>
                   
                </div>
            </div><br>
            @if(session()->has('success-message'))
                <div class="alert alert-success alert-dismissable">
                    <button type="submit" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session()->get('success-message') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">Edit payment term</div>
                        <form class="form-horizontal" action="{{ url('/payment_term/update/'.$payment_term->payment_term_id) }}" method="POST" autocomplete="off" role="form-horizontal" id="payment_term-form" enctype="multipart/form-data">
                            <div class="panel-body">
                                {{ csrf_field() }}
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('payment_term') ? ' has-error' : '' }}">

                                        <label for="payment_term" class="control-label">Payment Term *</label>

                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="payment_term" name="payment_term" placeholder="payment term" value="{{ $payment_term->payment_term }}">
                                            @if ($errors->has('payment_term'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('payment_term') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('no_of_days') ? ' has-error' : '' }}">

                                            <label for="no_of_days" class="control-label">No of Days *</label>

                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="no_of_days" name="no_of_days" placeholder="no of days" value="{{ $payment_term->no_of_days }}">
                                            @if ($errors->has('no_of_days'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('no_of_days') }}</strong>
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
                                            <button type="submit" class="btn btn-default waves-effect waves-light">Update</button>
                                            <a href="{{ url('/payment_term/create') }}" class="btn btn-danger waves-effect waves-light">Discard</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">Payment Terms</div>
                        <div class="panel-body">
                            <form class="form-group" id="form" action="{{ url('/payment_term/search') }}" method="GET" autocomplete="off" role="search">
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
                                            <th class="text-nowrap">Payment Term</th>
                                            <th class="text-nowrap">No of Days</th>
                                            <th class="text-nowrap">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=$payment_terms->perPage() * ($payment_terms->currentPage()-1); @endphp
                                        @foreach($payment_terms as $payment_term)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $payment_term->payment_term }}</td>
                                                <td>{{ $payment_term->no_of_days }}</td>

                                                <td class="text-nowrap">
                                                    <a href="{{ url('/payment_term/edit/'.$payment_term->payment_term_id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>
                                                      @if(Auth::User()->user_role=='Super Admin')
                                                        <a onclick="Delete('{{ $payment_term->payment_term_id }}')" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer; cursor:hand"> <i class="fa fa-close text-danger"></i> </a>
                                                      @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($payment_terms->total() > $payment_terms->perPage())
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="pull-right">
                                         {{ $payment_terms->render() }}
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
        function Delete(payment_term_id)
        {
            if(confirm('Do you want to Continue...?'))
            {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('payment_term.delete') }}",
                    data: {
                            payment_term_id: payment_term_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/payment_term/create") }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/payment_term/create") }}';
                    }
                });
            }
        }
    </script>
@endsection
