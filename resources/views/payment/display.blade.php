@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            @if(session()->has('success-message'))
                <div class="alert alert-success alert-dismissable">
                     <button type="submit" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session()->get('success-message') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-inverse">
                      
                       
                    </div>
                </div>
                <div class="col-md-12">
                     <div class="panel panel-color panel-custom">
                        <div class="panel-heading">
                            <h3 class="panel-title">PAMENTS</h3>
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
                                            <th class="text-nowrap" >Receipt No</th>
                                             <th class="text-nowrap" >Receipt Date</th>
                                            <th class="text-nowrap" >Member</th>
                                            <th class="text-nowrap" >Payment Mode</th>
                                            <th class="text-nowrap">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=$payments->perPage() * ($payments->currentPage()-1); @endphp
                                        @foreach($payments as $payment)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $payment->receipt_no }}</td>
                                                <td>{{ date('d-m-Y',strtotime($payment->receipt_date)) }}</td>
                                                <td>{{ $payment->Contact->contact_name }}</td>
                                                <td>{{ $payment->payment_mode }}</td>
                                                <td>{{ $payment->amount }}</td>
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
                        window.location='{{ url("/payment/display") }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/payment/display") }}';
                    }
                });
            }
        }
    </script>
@endsection
