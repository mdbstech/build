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
                                            <th class="text-nowrap">Voucher_no</th>
                                             <th class="text-nowrap">Voucher Date</th>
                                            <th class="text-nowrap" >Member</th>
                                            <th class="text-nowrap" >Payment Mode</th>
                                            <th class="text-nowrap">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=$refunds->perPage() * ($refunds->currentPage()-1); @endphp
                                        @foreach($refunds as $refund)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $refund->voucher_no }}</td>
                                                <td>{{ date('d-m-Y',strtotime($refund->voucher_date)) }}</td>
                                                <td>{{ $refund->Contact->contact_name }}</td>
                                                <td>{{ $refund->payment_mode }}</td>
                                                <td>{{ $refund->amount }}</td>
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


