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
                                    <th colspan="29">
                                        <center>
                                            <h2>{{ $org->org_name }}</h2>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td class="text-nowrap text-center" colspan="29">
                                        <p>{{ $org->address1 }}, {{ $org->address2 }}, {{ $org->city }}, {{ $org->state }}, {{ $org->zip_code }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="29">
                                        <center>
                                            <p>Member Report</p>
                                        </center>
                                    </th>
                                </tr>
                                
                                <tr>
                                    <th>#</th>
                                    <th>Member No</th>
                                    <th>Member Name</th>
                                    <th>Society</th>
                                    <th>Project</th>
                                    <th>Category</th>
                                    <th>Site</th>
                                    <th>Assigned Amount</th>
                                    <th>Payment Amount</th>
                                    <th>Payment Due</th>
                                    <th>Refund Amount</th>
                                </tr>
                                @php 
                                    $i=0;
                                    $total = 0;
                                @endphp
                               @foreach($contacts as $contact)
                                    @foreach($contact->SiteAllotments($contact->contact_id) as $site_allotment)
                                        <tr>
                                            <td class="text-nowrap">{{ ++$i }}</td>
                                            <td class="text-nowrap">{{ $contact->membership_no }}</td>
                                            <td class="text-nowrap">{{ $contact->contact_name }}</td>
                                            @if($contact->society_id == null)
                                                <td></td>
                                            @endif
                                            @if($contact->society_id != null)
                                                <td class="text-nowrap">{{$contact->Society->society_name}}</td>
                                            @endif
                                            <td class="text-nowrap">{{ $site_allotment->Project->project_name }}</td>
                                            <td class="text-nowrap">{{ $site_allotment->Category->category_name }}</td>
                                            
                                            @if($site_allotment->site_id != null)
                                                <td align="center">{{ $site_allotment->Site->site_no }}</td>
                                            @endif
                                            @if($site_allotment->site_id == null)
                                                <td></td>
                                            @endif
                                            <td class="text-nowrap">{{ $site_allotment->amount }}</td>
                                            <td class="text-nowrap">{{ $site_allotment->PaymentAmount($site_allotment->site_allotment_id) }}</td>
                                            <td class="text-nowrap">{{ $site_allotment->PaymentDueAmount($site_allotment->site_allotment_id) }}</td>
                                            @if($site_allotment->PaymentAmount($site_allotment->site_allotment_id) > $site_allotment->amount)
                                            <td class="text-nowrap">{{ $site_allotment->RefundAmount($site_allotment->site_allotment_id) }}</td>
                                            @endif
                                            @if($site_allotment->PaymentAmount($site_allotment->site_allotment_id) <= $site_allotment->amount)
                                            <td class="text-nowrap">0</td>
                                            @endif
                                        </tr> 
                                    @endforeach
                                @endforeach
                              
                                
                    
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
                <form action="{{ url('reports/member_report') }}" method="get" autocomplete="off">
                    <div class="modal-header"> 
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                        <h4 class="modal-title" id="myModalLabel">Filters</h4> 
                    </div> 
                    <div class="modal-body"> 
                        <div class="row"> 
                            <div class="col-md-12"> 
                                <div class="form-group"> 
                                    <label for="society_id" class="control-label">Society</label> 
                                    <select class="select2" id="society_id" name="society_id" >
                                        <option value="">Select Society</option>
                                        @foreach($societies as $society)
                                             <option @if(app('request')->input('society_id')==$society->society_id) selected @endif value="{{ $society->society_id }}">{{ $society->society_name }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                            </div> 
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
            fileName : 'Member_Report',
            exclude_links: true,
        });
    });
    $("#csv").click(function(){
        $('#table2excel').tableExport({
            type:'csv', 
            excelstyles:['border-bottom', 'border-top', 'border-left', 'border-right'],
            fileName : 'Member_Report',
            exclude_links: true,
        });
    });
    $("#xml").click(function(){
        $('#table2excel').tableExport({
            type:'excel',
            excelFileFormat:'xmlss',
            fileName : 'Member_Report',
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
 
@endsection





