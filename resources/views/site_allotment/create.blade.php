@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">ASSIGN AMOUNT</h4>  
                </div>
            </div>
            @if(session()->has('success-message'))
                <div class="alert alert-success alert-dismissable">
                    <button type="submit" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       {{ session()->get('success-message') }}
               </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    @foreach($errors->all() as $error)
                       <li> <strong>{{ $error }}</strong></li>
                     @endforeach
                </div>
            @endif
            <div class="row m-t-15">
                <div class="col-md-5">
                    <div class="panel panel-color panel-custom">
                        <div class="panel-heading ">
                        <h3 class="panel-title">New Assign Amount</h3></div>
                        <form class="form-horizontal" action="{{ url('/site_allotment/store')}}" method="POST" autocomplete="off" role="form-horizontal"
                         id="site-form">
                            <input type="hidden" name="site_allotment_id" id="site_allotment_id">
                            <div class="panel-body">
                                {{ csrf_field() }}
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('reference_date') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="reference_date" class="control-label">Reference date*</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="datepicker-autoclose form-control" id="reference_date" name="reference_date" data-date-format="d-m-yyyy" value="{{ date('d-m-Y') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                   <div class="form-group{{ $errors->has('reference_no') ? ' has-error' : '' }}">
                                      <div class="col-md-12">
                                       <label for="dimension" class=" control-label">Reference No*</label>
                                   </div>
                                       <div class="col-md-12">
                                           <input type="text" class="form-control" id="reference_no" name="reference_no" placeholder="Reference No" value="{{ $reference_no }}">
                                          
                                       </div>
                                   </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('contact_id') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                        <label for="contact_id" class="control-label">Member *</label>
                                        </div>
                                        <div class="col-md-12">
                                            <select id="contact_id" name="contact_id" class="form-control " autofocus>
                                                <option @if(old('contact_id')==$contact->contact_id) selected @endif value="{{ $contact->contact_id }}">{{ $contact->contact_name }}</option>
                                            </select>
                                          
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('project_id') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                        <label for="project_id" class="control-label">Project *</label>
                                        </div>
                                        <div class="col-md-12">
                                            <select id="project_id" name="project_id" class="form-control" autofocus>
                                                <option value="">Select Project</option>
                                                @foreach($projects as $project)
                                                    <option @if(old('project_id') == $project->project_id) selected @endif value="{{ $project->project_id }}">{{ $project->project_name }}</option>
                                                @endforeach
                                            </select>
                                         
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                        <label for="category_id" class="control-label">Category *</label>
                                       </div>
                                        <div class="col-md-12">
                                            <select id="category_id" name="category_id" class="form-control" autofocus>
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option @if (old('category_id')== $category->category_id) selected @endif value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('dimension') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                        <label for="dimension"  class="control-label">Dimension*</label>
                                    </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="dimension" name="dimension" placeholder="Site dimension" value="{{ old('dimension') }}">
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="amount" class="col-md-3 control-label">Amount*</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="amount"  name="amount" placeholder="Amount" value="{{ old('amount') }}"> 
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-default waves-effect waves-light">Save</button>
                                            <a href="{{ url('/site_allotment/create/'.$contact->contact_id) }}" class="btn btn-danger waves-effect waves-light">Discard</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="panel panel-color panel-custom">
                        <div class="panel-heading">
                            <h3 class="panel-title">New Installment</h3>
                        </div>
                        <div class="panel-body">
                           
                            <input type="hidden" name="site_allotment_id" id="site_allotment_id">
                            <input type="hidden" name="installment_id" id="installment_id">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('installment_name') ? ' has-error' : '' }}">
                                   
                                    <label for="installment_name" class="control-label">Installment Name*</label>
                                    <input type="text" class="form-control" id="installment_name" name="installment_name" placeholder="Installment Name" value="{{ old('installment_name') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('no_of_days') ? ' has-error' : '' }}">
                                    <label for="no_of_days" class="control-label">No Of Days *</label>
                                    <input type="text" class="form-control" id="no_of_days" name="no_of_days" placeholder="No Of Days" value="{{ old('no_of_days') }}" onkeyup="Getdate()">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('due_date') ? ' has-error' : '' }}">
                                    <label for="due_date" class="control-label">Due Date*</label>
                                    <input type="text" class="form-control" id="due_date" name="due_date" data-date-format="d-m-yyyy" value="{{ date('d-m-Y') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('new_amount') ? ' has-error' : '' }}">
                                    <label for="new_amount" class="control-label">Amount *</label>
                                    <input type="text" class="form-control" id="new_amount" name="new_amount" placeholder="Amount" >
                                </div>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                               <div class="form-group">
                                    <a id="add_row"  onclick="AddRow()" class="btn btn-block btn-default waves-effect waves-light">Add Row</a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <table class="table table-bordered table-responsive ">
                                        <thead>
                                            <tr>
                                                <td width="10%">
                                                    <span class="label label-default col-md-12">Installment Name</span>
                                                </td>
                                                <td width="20%">
                                                    <span class="label label-default col-md-12">No Of Days</span>
                                                </td>
                                                <td width="20%">
                                                    <span class="label label-default col-md-12">Due Date</span>
                                                </td>
                                                <td width="20%">
                                                    <span class="label label-default col-md-12">Amount</span>
                                                </td>
                                                <td width="60%">
                                                    <span class="label label-default col-md-12">Action</span>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody id="my_table">
                                            @foreach($installment as $instal)
                                                <tr id="installment{{ $instal->installment_id }}">
                                                    <td>{{ $instal->installment_name }}</td>
                                                    <td >{{ $instal->no_of_days }}</td>
                                                    <td >{{ date('d-m-Y' ,strtotime($instal->due_date)) }}</td>
                                                    <td >{{ $instal->new_amount }}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <button type="button" onclick="EditRow('{{ $instal->installment_id }}')" data-toggle="tooltip" data-original-title="Edit" class="btn btn-primary waves-effect waves-light btn-xs"><i class="fa fa-pencil icon-only"></i></button>
                                                            <button type="button" onclick="DeleteRow('{{ $instal->installment_id }}')" data-toggle="tooltip" data-original-title="Delete" class="btn btn-danger waves-effect waves-light btn-xs"><i class="md md-delete"></i> 
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        sum_total();
        function Delete(site_allotment_id)
        {
            if(confirm('Do you want to Continue...?'))
            {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('site_allotment.delete') }}",
                    data: {
                            site_allotment_id: site_allotment_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/site_allotment/create/".$contact->contact_id) }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/site_allotment/create/".$contact->contact_id) }}';
                    }
                });
            }
        }
          function AddRow() 
        {
            
            $.ajax({
                method: 'POST',
                url: "{{ route('site_allotment.add_row') }}",
                data: { 
                        installment_name: $("#installment_name").val().trim(),
                        no_of_days: $("#no_of_days").val().trim(),
                        due_date: $("#due_date").val().trim(),
                        new_amount: $("#new_amount").val().trim(),
                        _token: '{{ Session::token() }}'
                    },
                success: function(data) 
                {
                     var table = "<tr id='installment"+ data.installment_id +"'><td class='text-center'>"+ data.installment_name +"</td><td class='text-right'>"+ data.no_of_days +"</td><td class='text-center'>"+ data.due_date +"</td><td>"+ data.new_amount +"</td><td class='text-center'><button type='button' onclick='EditRow("+ data.installment_id +")' data-toggle='tooltip' data-original-title='Edit' class='btn btn-primary waves-effect waves-light btn-xs'><i class='fa fa-pencil'></i> </button> <button type='button' onclick='DeleteRow("+ data.installment_id +")' data-toggle='tooltip' data-original-title='Delete' class='btn btn-danger waves-effect waves-light btn-xs'><i class='fa fa-trash'></i> </button></td></tr>";
                                       
                    $("#my_table").append(table); 
                    $("#installment_id").val('');
                    $("#installment_name").val('');
                    $("#no_of_days").val('');
                    $("#due_date").val('');
                    $("#new_amount").val('');
                   sum_total();

                },
                error: function(data)
                {
                    var errors = $.parseJSON(data.responseText);
                    var message = '';
                    $.each(errors, function(index, value) {
                        message = message+' '+value;
                    });
                    $("#error_message").html('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>'+message+'</strong></div>');
                }
            });
        }
         function EditRow(installment_id) 
        {
            $.ajax({
                method: 'GET',
                url: "{{ route('site_allotment.edit_row') }}",
                data: {
                        installment_id: installment_id
                      },
                success: function(data) 
                {

                    $("#installment_id").val(data.installment_id);
                    $("#installment_name").val(data.installment_name);
                    $("#no_of_days").val(data.no_of_days);
                    $("#due_date").val(data.due_date);
                    $("#new_amount").val(data.new_amount);
                    $("#add_row").attr("onclick","UpdateRow()");
                    $('html, body').animate({ 'scrollTop' : $("#site-form").position().top });
                }
            }); 
        }
         function UpdateRow()
        {
            $.ajax({
                method: 'POST',
                url: "{{ route('site_allotment.update_row') }}",
                data: {

                        installment_id: $("#installment_id").val().trim(),
                        installment_name: $("#installment_name").val().trim(),
                        no_of_days: $("#no_of_days").val().trim(),
                        due_date: $("#due_date").val().trim(),
                        new_amount: $("#new_amount").val().trim(),
                        _token: '{{ Session::token() }}'

                     },
                success: function(data) 
                {

                    var table = "<tr id='installment"+ data.installment_id +"'><td class='text-center'>"+ data.installment_name +"</td><td class='text-right'>"+ data.no_of_days +"</td><td class='text-center'>"+ data.due_date +"</td><td>"+ data.new_amount +"</td><td class='text-center'><button type='button' onclick='EditRow("+ data.installment_id +")' data-toggle='tooltip' data-original-title='Edit' class='btn btn-primary waves-effect waves-light btn-xs'><i class='fa fa-pencil'></i> </button> <button type='button' onclick='DeleteRow("+ data.installment_id +")' data-toggle='tooltip' data-original-title='Delete' class='btn btn-danger waves-effect waves-light btn-xs'><i class='fa fa-trash'></i> </button></td></tr>";

                    $("#installment"+data.installment_id).replaceWith(table);
                    $('#installment_id').val('').trigger('change');
                    $("#installment_name").val('');
                    $("#no_of_days").val('');
                    $("#due_date").val('');
                    $("#new_amount").val('');
                    $("#add_row").attr("onclick","AddRow()");
                    $('html, body').animate({ 'scrollTop' : $("#site-form").position().top });
                    sum_total();
                },
                error: function(data)
                {
                    var errors = $.parseJSON(data.responseText);
                    var message = '';
                    $.each(errors, function(index, value) {
                        message = message+' '+value;
                    });
                    $("#error_message").html('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>'+message+'</strong></div>');
                }
            });
        }
         function DeleteRow(installment_id) 
        {
            $.ajax({
                method: 'GET',
                url: "{{ route('site_allotment.delete_row') }}",
                data: {
                        installment_id: installment_id,
                        _token: '{{ Session::token() }}'
                      },
                success: function(data) 
                {
                    $("#installment"+data.installment_id).remove();
                    $("#installment_name").val('');
                    $("#no_of_days").val('');
                    $("#due_date").val('');
                    $("#new_amount").val('');
                    sum_total();
                }
            });
        }
  
       function Getdate() 
       {
            $.ajax({
                method: 'GET',
                url: "{{ route('site_allotment.get_date') }}",
                data: {
                        no_of_days: $("#no_of_days").val().trim(),
                        reference_date: $("#reference_date").val().trim(),
                      },
                success: function(data) 
                {
                    $('#due_date').val(data);
                }
            });
        }
        function Getamount() 
        {
            $.ajax({
                method: 'GET',
                url: "{{ route('site_allotment.get_date') }}",
                data: {
                        no_of_days: $("#no_of_days").val().trim(),
                        reference_date: $("#reference_date").val().trim(),
                      },
                success: function(data) 
                {
                    $('#due_date').val(data);
                }
            });
        }
        function sum_total() 
        {
            $.ajax({
                method: 'GET',
                url: "{{ route('site_allotment.sum_total') }}",
                data:{
                        site_allotment_id: $('#site_allotment_id').val(),
                    },
                success: function(data) 
                {
                    $('#amount').val(data);
                }
            });
        }
    </script>
    <script type="text/javascript">
    $('#reference_date').datetimepicker({
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
    $('#due_date').datetimepicker({
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
