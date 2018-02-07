@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
           <div class="row">
                <div class="col-sm-12">
                   <div class="button-list pull-right">
                        <button type="button" id="csv" class="btn btn-default btn-custom waves-effect waves-light">CSV</button>
                       
                        <button type="button" id="excel" class="btn btn-primary btn-custom waves-effect waves-light">EXCEL</button>
                        
                        <button type="button" id="pdf" class="btn btn-info btn-custom waves-effect waves-light">PDF</button>
                        <button type="button" id="xml" class="btn btn-warning btn-custom waves-effect waves-light">XML</button>
                        <button type="button" class="btn btn-pink btn-custom waves-effect waves-light" data-toggle="modal" data-target="#filter-modal">Filter</button>
                    </div>
                   
                </div>
            </div><br>
            @if(session()->has('success-message'))
               <div class="alert alert-success alert-dismissable">
                    <button type="submit" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       {{ session()->get('success-message') }}
               </div>
            @endif
           <div class="row" id="pdf-table">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table2excel">
                                <tr>
                                    <th colspan="12">
                                        <center>
                                            <h2>{{ $org->org_name }}</h2>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td class="text-nowrap text-center" colspan="12">
                                        <p>{{ $org->address1 }}, {{ $org->address2 }}, {{ $org->city }}, {{ $org->state }}, {{ $org->zip_code }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="12">
                                        <center>
                                            <p>Refund Report</p>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="12">
                                        <center>
                                            <p>From {{ $from_date }} To {{ $to_date }}</p>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th>Voucher No</th>
                                    <th>Voucher Date</th>
                                    <th>Member No</th>
                                    <th>Member Name</th>
                                    <th>Project</th>
                                    <th>Category</th>
                                    <th>Site</th>
                                    <th>Payment Mode</th>
                                    <th>Amount</th>
                                </tr>
                                 @php 
                                    $i=0;
                                    $total = 0;
                                @endphp
                                @foreach($refunds as $refund)
                                    <tr>
                                        <td class="text-nowrap">{{ ++$i }}</td>
                                        <td class="text-nowrap">{{ $refund->voucher_no }}</td>
                                        <td class="text-nowrap">{{ date('d-m-Y',strtotime($refund->voucher_date)) }}</td>
                                        <td class="text-nowrap">{{ $refund->Contact->membership_no}}</td>
                                        <td class="text-nowrap">{{ $refund->Contact->contact_name }}</td>
                                        <td class="text-nowrap">{{ $refund->SiteAllotment->Project->project_name }}</td>
                                        <td class="text-nowrap">{{ $refund->SiteAllotment->Category->category_name }}</td>
                                        @if($refund->SiteAllotment->Site == '')
                                            <td></td>
                                        @else
                                            <td class="text-nowrap">{{ $refund->SiteAllotment->Site->site_no }}</td>
                                        @endif
                                        <td class="text-nowrap">{{ $refund->payment_mode }}</td>
                                        <td class="text-nowrap text-right" align="right">{{ number_format($refund->amount,2) }}</td>
                                    </tr>
                                    @php
                                        $total += $refund->amount;
                                    @endphp
                                @endforeach
                                <tr>
                                    <td class="text-nowrap text-right" style="text-align: right" colspan="9">Total Refund</td>
                                    <td class="text-nowrap text-right" style="text-align: right"><b>{{number_format($total,2)}}</b></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div id="filter-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog"> 
            <div class="modal-content"> 
                <form action="{{ url('reports/refund_report') }}" method="get" autocomplete="off">
                    <div class="modal-header"> 
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                        <h4 class="modal-title" id="myModalLabel">Filters</h4> 
                    </div> 
                    <div class="modal-body"> 
                        <div class="row"> 
                            <div class="col-md-12"> 
                                <div class="form-group"> 
                                    <label for="from_date" class="control-label">From Date:</label> 
                                    <input type="text" class="form-control" data-date-format="dd-mm-yyyy" data-link-format="dd-mm-yyyy"  id="from_date" name="from_date" placeholder="From-Date" value="@if(app('request')->input('from_date')){{ app('request')->input('from_date') }}@else{{ date('d-m-Y') }}@endif"> 
                                </div> 
                            </div> 
                            <div class="col-md-12"> 
                                <div class="form-group"> 
                                    <label for="to_date" class="control-label">To Date:</label> 
                                    <input type="text" class="form-control" data-date-format="dd-mm-yyyy" data-link-format="dd-mm-yyyy"  id="to_date" name="to_date" placeholder="To-Date" value="@if(app('request')->input('to_date')){{ app('request')->input('to_date') }}@else{{ date('d-m-Y') }}@endif">
                                </div> 
                            </div> 
                        </div> 
                        <div class="row"> 
                            <div class="col-md-12"> 
                                <div class="form-group"> 
                                    <label for="contact_id" class="control-label">Member</label> 
                                    <select class="select2" id="contact_id" name="contact_id" >
                                        <option value="">Select Member</option>
                                        @foreach($contacts as $contact)
                                             <option @if(app('request')->input('contact_id')==$contact->contact_id) selected @endif value="{{ $contact->contact_id }}">{{ $contact->contact_name }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                            </div> 
                        </div> 
                    </div> 
        
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                    <button type="submit" class="btn btn-info waves-effect waves-light">FILTER REPORT</button> 
                </div> 
            </form>
            </div> 
        </div>
    </div>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('public/excel/libs/FileSaver/FileSaver.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/excel/tableExport.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/excel/libs/js-xlsx/xlsx.core.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/excel/libs/jsPDF/jspdf.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/excel/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js') }}"></script>
<script type="text/javascript">
    $("#excel").click(function(){
        $('#table2excel').tableExport({
            type:'excel', 
            excelstyles:['border-bottom', 'border-top', 'border-left', 'border-right'],
            fileName : 'Payment_Report',
            exclude_links: true,
        });
    });
    $("#csv").click(function(){
        $('#table2excel').tableExport({
            type:'csv', 
            excelstyles:['border-bottom', 'border-top', 'border-left', 'border-right'],
            fileName : 'Refund_Report',
            exclude_links: true,
        });
    });
    $("#xml").click(function(){
        $('#table2excel').tableExport({
            type:'excel',
            excelFileFormat:'xmlss',
            fileName : 'Refund_Report',
            exclude_links: true,
        });
    });
        
    $("#pdf").click(function(){
        var divContents = $("#pdf-table").html();
        var printWindow = window.open('', '');
        printWindow.document.write('<html><head><title>Builders & Developers</title>');
        printWindow.document.write('<style> table{ border-collapse: collapse; } table, td, th { border: 1px solid black; padding: 5px; } .text-right { text-align:right; } .text-center { text-align:center; }  </style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write(divContents);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
        printWindow.close();
    });
</script>
<script type="text/javascript">
    $('#from_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
     $('#to_date').datetimepicker({
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

