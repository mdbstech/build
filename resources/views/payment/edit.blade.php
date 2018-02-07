@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">PAYMENT</h4>
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
                            <h3 class="panel-title">EDIT PAYMENT</h3>
                        </div>
                        <form class="form-horizontal" action="{{ url('/payment/update/'.$payment->payment_id )}}" method="POST" autocomplete="off" role="form-horizontal"
                         id="payment-form">
                         <div class="panel-body">
                            {{ csrf_field() }}
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('receipt_no') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="receipt_no" class="control-label">Receipt No *</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="receipt_no"  name="receipt_no" placeholder="Receipt No" value="{{ $payment->receipt_no }}">
                                        @if ($errors->has('receipt_no'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('     receipt_no') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                              <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('receipt_date') ? ' has-error' : '' }}">
                                            <div class="col-md-12">
                                                <label for="receipt_date" class="control-label">Receipt Date *</label>
                                            </div>
                                            <div class="col-md-12">
                                               <input type="text" class="datepicker-autoclose form-control" id="receipt_date" name="receipt_date"  data-date-format="dd-mm-yyyy" value="{{ date('d-m-Y',strtotime($payment->receipt_date)) }}">
                                                @if ($errors->has('receipt_date'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('receipt_date') }}</strong>
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
                                            <option value="">Select Member</option>
                                            @foreach($contacts as $contact)
                                                <option  @if($payment->contact_id==$contact->contact_id) selected @endif value="{{ $contact->contact_id }}">{{ $contact->contact_name }}</option>
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
                                <div class="form-group{{ $errors->has('project') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="project" class="control-label">Project*</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="project" name="project" value="{{ $site_allotment->Project->project_name }}" readonly="true">
                                        @if ($errors->has('project'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('project') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('assign_amount') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="assign_amount" class="control-label">Assigned Amount*</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="project" name="project" value="{{ $site_allotment->amount }}" readonly="true">
                                        @if ($errors->has('assign_amount'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('assign_amount') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('due_amount') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="due_amount" class="control-label">Due Amount*</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="project" name="project" value="{{ $due_amount }}" readonly="true">
                                        @if ($errors->has('due_amount'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('due_amount') }}</strong>
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
                                        <select id="payment_mode" type="text" class="form-control" name="payment_mode">
                                            <option value="">Select Payment Mode</option>
                                            @foreach($payment_modes as $payment_mode)
                                                <option @if($payment->payment_mode==$payment_mode->master_value) selected @endif>{{ $payment_mode->master_value }}</option>
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
                                            <div class="col-md-12">
                                                <label for="date" class="control-label">Date *</label>
                                            </div>
                                            <div class="col-md-12">
                                               <input type="text" class="datepicker-autoclose form-control" id="date" name="date"  data-date-format="dd-mm-yyyy" value="{{ date('d-m-Y',strtotime($payment->date)) }}">
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
                                        <label for="num" class="control-label">Number *</label>
                                    </div>
                                    <div class="col-md-12">
                                       <input type="text" class="form-control" id="num" name="num" placeholder="Number " value="{{ $payment->num }}">
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
                                       <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount " value="{{ $payment->amount }}">
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
                                           
                                            <a href="{{ url('/payment/create/'.$site_allotment->site_allotment_id) }}" class="btn btn-danger waves-effect waves-light">Discard</a>
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
                            <h3 class="panel-title">PAYMENTS</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-group" id="form" action="{{ url('/payment/search') }}" method="GET" autocomplete="off" role="search">
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
                                            <th class="text-nowrap">Receipt No</th>
                                            <th class="text-nowrap">Payment Mode</th>
                                            <th class="text-nowrap">Amount</th>
                                            <th class="text-nowrap">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=$payments->perPage() * ($payments->currentPage()-1); @endphp
                                        @foreach($payments as $payment)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $payment->receipt_no }}</td>
                                                <td>{{ $payment->payment_mode }}</td>
                                                <td>{{ $payment->amount }}</td>
                                                <td class="text-nowrap">
                                                    <a href="{{ url('/payment/edit/'.$payment->payment_id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>
                                                    @if(Auth::User()->user_role=='Super Admin')
                                                        <a onclick="Delete('{{ $payment->payment_id }}')" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer; cursor:hand"> <i class="fa fa-close text-danger"></i> </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @if($payments->total() > $payments->perPage())
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="pull-right">
                                         {{ $payments->render() }}
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
        function Delete(payment_id)
        {
            if(confirm('Do you want to Continue...?'))
            {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('payment.delete') }}",
                    data: {
                            payment_id: payment_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/payment/create/".$site_allotment->site_allotment_id) }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/payment/create/".$site_allotment->site_allotment_id) }}';
                    }
                });
            }
        }
         $('#receipt_date').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
        $('#date').datetimepicker({
        //language:  'fr',
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
