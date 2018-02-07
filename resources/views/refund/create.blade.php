@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">REFUND</h4>
                </div>
            </div>
            @if(session()->has('success-message'))
               <div class="alert alert-success alert-dismissable">
                    <button type="submit" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       {{ session()->get('success-message') }}
               </div>
            @endif
            <div class="row m-t-15">
                <div class="col-md-6">
                    <div class="panel panel-color panel-custom">
                        <div class="panel-heading">
                            <h3 class="panel-title">NEW REFUND</h3>
                        </div>
                        <form class="form-horizontal" action="{{ url('/refund/store')}}" method="POST" autocomplete="off" role="form-horizontal"
                         id="refund-form">
                         <div class="panel-body">
                            {{ csrf_field() }}
                            <input type="hidden" name="site_allotment_id" id="site_allotment_id" value="{{ $site_allotment->site_allotment_id }}">
                             <div class="col-md-6">
                                <div class="form-group{{ $errors->has('voucher_no') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="voucher_no" class="control-label">Voucher No *</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="voucher_no"  name="voucher_no" placeholder="voucher_no" value="{{ $voucher_no }}">
                                        @if ($errors->has('voucher_no'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('voucher_no') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                             <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('voucher_date') ? ' has-error' : '' }}">
                                        <div class="col-md-6">
                                            <label for="voucher_date" class="control-label">Voucher_date</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input class="form-control" data-date-format="dd-mm-yyyy" data-link-format="dd-mm-yyyy" id="voucher_date" name="voucher_date" size="16" type="text" value="{{ date('d-m-Y') }}" >
                                            @if ($errors->has('voucher_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('voucher_date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('contact_id') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="contact_id" class="control-label">Member *</label>
                                        </div>
                                        <div class="col-md-12">
                                            <select id="contact_id" name="contact_id" class="form-control" autofocus>
                                                
                                                <option @if(old('contact_id')==$contact->contact_id) selected @endif value="{{ $contact->contact_id }}">{{ $contact->contact_name }}</option>
                                               
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
                                    <div class="form-group{{ $errors->has('refund') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="refund" class="control-label">Refund Amount</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="refund" name="refund" value="{{ $refund_amount }}" readonly="true">
                                            @if ($errors->has('refund'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('refund') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('payment_mode') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="payment_mode" class="control-label">Payment Mode *</label>
                                    </div>
                                    <div class="col-md-12">
                                        <select id="payment_mode" type="text" class="select2" name="payment_mode">
                                            <option value="">Select Payment Mode</option>
                                            @foreach($payment_modes as $payment_mode)
                                                <option @if(old('payment_mode')==$payment_mode->master_value) @endif>{{ $payment_mode->master_value }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('payment_mode'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('payment_mode') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                                    <div class="col-md-6">
                                        <label for="date" class="control-label">Date</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input class="form-control" data-date-format="dd-mm-yyyy" data-link-format="dd-mm-yyyy" id="date" name="date" size="16" type="text" value="{{ date('d-m-Y') }}" >
                                        @if ($errors->has('date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('num') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="num" class="control-label">Number </label>
                                    </div>
                                    <div class="col-md-12">
                                       <input type="text" class="form-control" id="num" name="num" placeholder="num" value="{{ old('num') }}">
                                        @if ($errors->has('num'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('num') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="amount" class="control-label">Amount *</label>
                                    </div>
                                    <div class="col-md-12">
                                       <input type="text" class="form-control" id="amount" name="amount" placeholder="amount" value="{{ old('amount') }}">
                                        @if ($errors->has('amount'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('amount') }}</strong>
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
                                          
                                            <a href="{{ url('/refund/create/'.$site_allotment->site_allotment_id) }}" class="btn btn-danger waves-effect waves-light">Discard</a>
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
                            <h3 class="panel-title">REFUNDS</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-group" id="form" action="{{ url('/refund/search') }}" method="GET" autocomplete="off" role="search">
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
                                            <th class="text-nowrap">voucher No</th>
                                            <th class="text-nowrap">Payment Mode</th>
                                            <th class="text-nowrap">Amount</th>
                                            <th class="text-nowrap">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=$refunds->perPage() * ($refunds->currentPage()-1); @endphp
                                        @foreach($refunds as $refund)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $refund->voucher_no }}</td>
                                                <td>{{ $refund->payment_mode }}</td>
                                                <td>{{ $refund->amount }}</td>
                                                <td class="text-nowrap">
                                                    <a href="{{ url('/refund/edit/'.$refund->refund_id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>
                                                    @if(Auth::User()->user_role=='Super Admin')
                                                        <a onclick="Delete('{{ $refund->refund_id }}')" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer; cursor:hand"> <i class="fa fa-close text-danger"></i> </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @if($refunds->total() > $refunds->perPage())
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="pull-right">
                                         {{ $refunds->render() }}
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
        function Delete(refund_id)
        {
            if(confirm('Do you want to Continue...?'))
            {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('refund.delete') }}",
                    data: {
                            refund_id: refund_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/refund/create/".$site_allotment->site_allotment_id) }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/refund/create/".$site_allotment->site_allotment_id) }}';
                    }
                });
            }
        }
    </script>
     <script type="text/javascript">
        $('#voucher_date').datetimepicker({
            language:  'fr',
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0
        });
    </script> 
     <script type="text/javascript">
        $('#date').datetimepicker({
            language:  'fr',
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0
        });
    </script>   
@endsection
