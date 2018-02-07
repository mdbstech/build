@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
          <div class="row">
                <div class="col-sm-12">
                   
                    <h4 class="page-title">Income</h4>
                    <ol class="breadcrumb">
                        <li>
                            <a>Builders &amp; Developers</a>
                        </li>
                        <li>
                            <a>Configuration</a>
                        </li>
                        <li class="active">
                            New Income
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
                        <div class="panel-heading">New Income</div>
                        <form class="form-horizontal" action="{{ url('/income/store') }}" method="POST" autocomplete="off" role="form-horizontal" id="income-form" enctype="multipart/form-data">
                            <div class="panel-body">
                                {{ csrf_field() }}
                                  <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('receipt_no') ? ' has-error' : '' }}">
                                            <div class="col-md-12">
                                                <label for="receipt_no" class="control-label">Receipt No *</label>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" id="receipt_no"  name="receipt_no" placeholder="Receipt No" value="{{ $receipt_no }}">
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
                                               <input type="text" class="datepicker-autoclose form-control" id="receipt_date" name="receipt_date"  data-date-format="dd-mm-yyyy" value="{{ date('d-m-Y') }}">
                                                @if ($errors->has('receipt_date'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('receipt_date') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('income_account') ? ' has-error' : '' }}">
                                            <div class="col-md-12">
                                                <label for="income_account" class="control-label">Income Account *</label>
                                            </div>
                                            <div class="col-md-12">
                                                 <select class="form-control select2" name="income_account" id="income_account">
                                                    <option value="">Select Income Account</option>
                                                    @foreach($accounts as $account)
                                                        <option @if(old('income_account')==$account->account_id) selected @endif value="{{ $account->account_id }}">{{ $account->account_name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('income_account'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('income_account') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('deposit_to') ? ' has-error' : '' }}">
                                            <div class="col-md-12">
                                                <label for="deposit_to" class="control-label">Deposit To *</label>
                                            </div>
                                            <div class="col-md-12">
                                                 <select class="form-control select2" name="deposit_to" id="deposit_to">
                                                    <option value="">Select deposit_to</option>
                                                    @foreach($accounts as $account)
                                                        <option @if(old('deposit_to')==$account->account_id) selected @endif value="{{ $account->account_id }}">{{ $account->account_name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('deposit_to'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('deposit_to') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('contact_id') ? ' has-error' : '' }}">
                                            <div class="col-md-12">
                                                <label for="contact_id" class="control-label">Contact *</label>
                                            </div>
                                            <div class="col-md-12">
                                                <select id="contact_id" name="contact_id" class="form-control" autofocus>
                                                    <option value="">Select Contact</option>
                                                    @foreach($contacts as $contact)
                                                        <option @if(old('contact_id')==$contact->contact_id) selected @endif value="{{ $contact->contact_id }}">{{ $contact->contact_name }}</option>
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
                                        <div class="form-group{{ $errors->has('payment_mode') ? ' has-error' : '' }}">
                                            <div class="col-md-12">
                                                <label for="payment_mode" class="control-label">Payment Mode *</label>
                                            </div>
                                            <div class="col-md-12">
                                                <select id="payment_mode" type="text" class="form-control" name="payment_mode">
                                                    <option value="">Select Payment Mode</option>
                                                    @foreach($payment_modes as $payment_mode)
                                                        <option @if(old('payment_mode')==$payment_mode->master_value) @endif>{{ $payment_mode->master_value }}</option>
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
                                        <div class="form-group{{ $errors->has('files') ? ' has-error' : '' }}">
                                            <div class="col-md-12">
                                                <label for="files" class="control-label">Attach Files</label>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="file" id="files" name="files[]" multiple class="dropify">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                            <div class="col-md-12">
                                                <label for="amount" class="control-label">Amount* </label>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount" value="{{ old('amount') }}">
                                                @if ($errors->has('amount'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('amount') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                                            <div class="col-md-12">
                                                <label for="note" class="control-label">Note</label>
                                            </div>
                                            <div class="col-md-12">
                                                <textarea rows="5" type="text" class="form-control" id="note" name="note" placeholder="Note">{{ old('note') }}</textarea>
                                                @if ($errors->has(' note'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first(' note') }}</strong>
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
                                                <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                                <a href="{{ url('/income/create') }}" class="btn btn-danger waves-effect waves-light">Discard</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">Income</div>
                        <div class="panel-body">
                            <form class="form-group" id="form" action="{{ url('/income/search') }}" method="GET" autocomplete="off" role="search">
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
                                           
                                            <th class="text-nowrap" >Receipt No</th>
                                            <th class="text-nowrap" >Receipt date</th>
                                            <th class="text-nowrap" >Income Account</th>
                                            <th class="text-nowrap" >Deposit To</th>
                                            <th class="text-nowrap" >Contact</th>
                                            <th class="text-nowrap" >Amount</th>
                                            <th class="text-nowrap">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=$incomes->perPage() * ($incomes->currentPage()-1); @endphp
                                        @foreach($incomes as $income)
                                            <tr>
                                                
                                                <td>{{ $income->receipt_no }}</td>
                                                <td>
                                                {{ date('d-m-Y',strtotime($income->receipt_date)) }}
                                                </td>
                                                <td>{{ $income->IncomeAccount->account_name}}</td>
                                                <td>{{ $income->DepositTo->account_name}}</td>
                                                <td>{{ $income->Contact->contact_name}}</td>
                                                <td>{{ $income->amount }}</td>
                                                <td class="text-nowrap">
                                                    <a href="{{ url('/income/edit/'.$income->income_id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>
                                                    @if(Auth::User()->user_role=='Super Admin')
                                                        <a onclick="Delete('{{ $income->income_id }}')" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer; cursor:hand"> <i class="fa fa-close text-danger"></i> </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($incomes->total() > $incomes->perPage())
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="pull-right">
                                         {{ $incomes->render() }}
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
        function Delete(income_id)
        {
            if(confirm('Do you want to Continue...?'))
            {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('income.delete') }}",
                    data: {
                            income_id: income_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/income/create") }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/income/create") }}';
                    }
                });
            }
        }
    </script>
@endsection
