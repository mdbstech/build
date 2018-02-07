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
                                            <p>Contact Report</p>
                                        </center>
                                    </th>
                                </tr>
                                
                                <tr>
                                    <th>#</th>
                                    <th>Contact Code</th>
                                    <th>Contact Name</th>
                                    <th>Contact Type</th>
                                    <th>Gender</th>
                                    <th>Email</th>
                                    <th>Mobile NO</th>
                                    <th>Reference Type</th>
                                    <th>Reference Name</th>
                                    <th>DOB</th>
                                    <th>Marital Status</th>
                                    <th>Phone NO</th>
                                    <th>Society Name</th>
                                    <th>Address1</th>
                                    <th>Address2</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Pincode</th>
                                    <th>Country</th>
                                    <th>Occupation</th>
                                    <th>Annual Income</th>
                                    <th>Nationality</th>
                                    <th>Religion</th>
                                    <th>Caste</th>
                                    <th>Category</th>
                                    <th>Nominee</th>
                                    <th>Nominee Relationship</th>
                                    <th>Nominee Age</th>
                                    <th>Site Dimension</th>
                                </tr>
                                @php 
                                    $i=0;
                                    $total = 0;
                                @endphp
                                @foreach($contacts as $contact) 
                            <tr>
                                <td class="text-nowrap">{{ ++$i }}</td>
                                <td class="text-nowrap">{{ $contact->contact_code }}</td>
                                <td class="text-nowrap">{{ $contact->contact_name }}</td>
                                <td class="text-nowrap">{{ $contact->contact_type }}</td>
                                <td class="text-nowrap">{{ $contact->gender }}</td>
                                <td class="text-nowrap">{{ $contact->email }}</td>
                                <td class="text-nowrap">{{ $contact->mobile_no }}</td>
                                <td class="text-nowrap">{{ $contact->reference_type }}</td>
                                @if($contact->user_id == '')
                                <td></td>
                                @else
                                <td class="text-nowrap">{{ $contact->User->username }}</td>
                                @endif
                               
                                <td class="text-nowrap">{{ $contact->dob }}</td>
                                <td class="text-nowrap">{{ $contact->marital_status }}</td>
                                <td class="text-nowrap">{{ $contact->phone_no }}</td>
                                @if($contact->society_id == null)
                                    <td></td>
                                @endif
                                @if($contact->society_id != null)
                                <td class="text-nowrap">{{$contact->Society->society_name}}</td>
                                @endif
                                <td class="text-nowrap">{{ $contact->address1 }}</td>
                                <td class="text-nowrap">{{ $contact->address2 }}</td>
                                <td class="text-nowrap">{{ $contact->city }}</td>
                                <td class="text-nowrap">{{ $contact->state }}</td>
                                <td class="text-nowrap">{{ $contact->pincode }}</td>
                                <td class="text-nowrap">{{ $contact->country }}</td>
                                <td class="text-nowrap">{{ $contact->occupation }}</td>
                                <td class="text-nowrap">{{ $contact->annual_income }}</td>
                                <td class="text-nowrap">{{ $contact->nationality }}</td>
                                <td class="text-nowrap">{{ $contact->religion }}</td>
                                <td class="text-nowrap">{{ $contact->caste }}</td>
                                <td class="text-nowrap">{{ $contact->category }}</td>
                                <td class="text-nowrap">{{ $contact->nominee }}</td>
                                <td class="text-nowrap">{{ $contact->nominee_relationship }}</td>
                                <td class="text-nowrap">{{ $contact->nominee_age }}</td>
                                <td class="text-nowrap">{{ $contact->site_dimension }}</td>
                            </tr> 
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
                <form action="{{ url('reports/contact_report') }}" method="get" autocomplete="off">
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
                                    <label for="city" class="control-label">Society</label> 
                                     <select id="city" type="text" class="form-control" name="city">
                                        <option value="">Select City</option>
                                        @foreach($cities as $city)
                                            <option @if(old('city')==$city->master_value) @endif>{{ $city->master_value }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                            </div>
                            <div class="col-md-12"> 
                                <div class="form-group"> 
                                    <label for="occupation" class="control-label">Society</label> 
                                     <select id="occupation" type="text" class="form-control" name="occupation">
                                        <option value="">Select occupation</option>
                                        @foreach($occupations as $occupation)
                                            <option @if(old('occupation')==$occupation->master_value) @endif>{{ $occupation->master_value }}</option>
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
            fileName : 'Contact_Report',
            exclude_links: true,
        });
    });
    $("#csv").click(function(){
        $('#table2excel').tableExport({
            type:'csv', 
            excelstyles:['border-bottom', 'border-top', 'border-left', 'border-right'],
            fileName : 'Contact_Report',
            exclude_links: true,
        });
    });
    $("#xml").click(function(){
        $('#table2excel').tableExport({
            type:'excel',
            excelFileFormat:'xmlss',
            fileName : 'Contact_Report',
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

