@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Expenses</h4>
                    <ol class="breadcrumb">
                        <li>
                            <a>Builders &amp; Developers</a>
                        </li>
                        <li>
                            <a>Configuration</a>
                        </li>
                        <li class="active">
                            Edit Expense
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
                    <div class="panel-heading">Edit Expense</div>
                    <form class="form-horizontal" action="{{ url('/expense/update/'.$expense->expense_id) }}" method="POST" autocomplete="off" role="form-horizontal" id="expense-form" enctype="multipart/form-data">
                        <div class="panel-body">
                            {{ csrf_field() }}
                              <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('voucher_no') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="voucher_no" class="control-label">Voucher No *</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="voucher_no" name="voucher_no" placeholder="Voucher No" value="{{ $expense->voucher_no }}">
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
                                        <div class="col-md-12">
                                            <label for="voucher_date" class="control-label">Voucher Date *</label>
                                        </div>
                                        <div class="col-md-12">
                                           <input type="text" class="datepicker-autoclose form-control" id="voucher_date" name="voucher_date"  data-date-format="dd-mm-yyyy" value="{{ date('d-m-Y',strtotime($expense->voucher_date)) }}">
                                            @if ($errors->has('voucher_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('voucher_date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('expense_account') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="expense_account" class="control-label">Expense Account *</label>
                                        </div>
                                        <div class="col-md-12">
                                             <select class="form-control select2" name="expense_account" id="expense_account">
                                                <option value="">Select Expense Account</option>
                                                @foreach($accounts as $account)
                                                    <option @if($expense->expense_account==$account->account_id) selected @endif value="{{ $account->account_id }}">{{ $account->account_name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('expense_account'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('expense_account') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('paid_through') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="paid_through" class="control-label">Paid Through *</label>
                                        </div>
                                        <div class="col-md-12">
                                             <select class="form-control select2" name="paid_through" id="paid_through">
                                                <option value="">Select paid_Through</option>
                                                @foreach($accounts as $account)
                                                    <option @if($expense->paid_through==$account->account_id) selected @endif value="{{ $account->account_id }}">{{ $account->account_name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('paid_through'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('paid_through') }}</strong>
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
                                                    <option @if($expense->contact_id==$contact->contact_id) selected @endif value="{{ $contact->contact_id }}">{{ $contact->contact_name }}</option>
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
                                                    <option @if($expense->payment_mode==$payment_mode->master_value) selected @endif>{{ $payment_mode->master_value }}</option>
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
                                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount" value="{{ $expense->amount }}">
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
                                            <textarea rows="5" type="text" class="form-control" id="note" name="note" placeholder="Note">{{ $expense->note }}</textarea>
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
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Update  </button>
                                            <a href="{{ url('/expense/create') }}" class="btn btn-danger waves-effect waves-light">Discard</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-inverse">
                    <div class="panel-heading">Expenses</div>
                    <div class="panel-body">
                        <form class="form-group" id="form" action="{{ url('/expense/search') }}" method="GET" autocomplete="off" role="search">
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
                                        
                                        <th class="text-nowrap" >Voucher No</th>
                                        <th class="text-nowrap" >Voucher date</th>
                                        <th class="text-nowrap" >Expense Account</th>
                                        <th class="text-nowrap" >Paid_through</th>
                                        <th class="text-nowrap" >Contact</th>
                                        <th class="text-nowrap" >Amount</th>
                                        <th class="text-nowrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=$expenses->perPage() * ($expenses->currentPage()-1); @endphp
                                    @foreach($expenses as $expense)
                                        <tr>
                                            
                                            <td>{{ $expense->voucher_no }}</td>
                                            <td>
                                                {{ date('d-m-Y',strtotime($expense->voucher_date)) }}
                                                </td>
                                            <td>{{ $expense->ExpenseAccount->account_name}}</td>
                                            <td>{{ $expense->PaidThrough->account_name}}</td>
                                            <td>{{ $expense->Contact->contact_name}}</td>
                                            <td>{{ $expense->amount }}</td>
                                            <td class="text-nowrap">
                                                <a href="{{ url('/expense/edit/'.$expense->expense_id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>
                                                @if(Auth::User()->user_role=='Super Admin')
                                                    <a onclick="Delete('{{ $expense->expense_id }}')" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer; cursor:hand"> <i class="fa fa-close text-danger"></i> </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if($expenses->total() > $expenses->perPage())
                        <div class="panel-footer">
                            <div class="row">
                                <div class="pull-right">
                                     {{ $expenses->render() }}
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
        function Delete(expense_id)
        {
            if(confirm('Do you want to Continue...?'))
            {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('expense.delete') }}",
                    data: {
                            expense_id: expense_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/expense/create") }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/expense/create") }}';
                    }
                });
            }
        }
    </script>
@endsection
