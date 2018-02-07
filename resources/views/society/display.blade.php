@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
             <div class="row">
                <div class="col-sm-12">
                    <div class="btn-group pull-right">
                        <a href="{{ url('/society/create') }}" class="btn btn-danger waves-effect waves-light">New Society</a>
                    </div>
                    <h4 class="page-title">SOCIETY</h4>
                </div>
            </div>
            @if(session()->has('success-message'))
               <div class="alert alert-success alert-dismissable">
                    <button type="submit" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       {{ session()->get('success-message') }}
               </div>
           @endif
           <div class="row m-t-15">
                <div class="col-md-12">
                    <div class="panel panel-color panel-custom">
                        <div class="panel-heading">
                            <h3 class="panel-title">SOCIETIES</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-group" id="form" action="{{ url('/society/search') }}" method="GET" autocomplete="off" role="search">
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
                                           <th class="text-nowrap">Society Code</th>
                                           <th class="text-nowrap">Society Name</th>
                                           <th class="text-nowrap">Email Address</th>
                                           <th class="text-nowrap">Mobile No</th>
                                          
                                           <th class="text-nowrap">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=$societies->perPage() * ($societies->currentPage()-1); @endphp
                                        @foreach($societies as $society)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $society->society_code }}</td>
                                                <td>{{ $society->society_name }}</td>
                                                <td>{{ $society->email }}</td>
                                                <td>{{ $society->mobile_no }}</td>
                                                <td class="text-nowrap">
                                                    <a href="{{ url('/society/edit/'.$society->society_id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>

                                                    <a href="{{ url('/society/view/'.$society->society_id) }}" data-toggle="tooltip" data-original-title="View"> <i class="fa fa-eye text-inverse m-r-10"></i></a>
                                                    @if(Auth::User()->user_role=='Super Admin')
                                                        <a onclick="Delete('{{ $society->society_id }}')" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer; cursor:hand"> <i class="fa fa-close text-danger"></i> </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($societies->total() > $societies->perPage())
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="pull-right m-r-15">
                                        {{ $societies->render() }}
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
         function Delete(society_id)
         {
             if(confirm('Do you want to Continue...?'))
             {
                 $.ajax({
                     method: 'GET',
                     url: "{{ route('society.delete') }}",
                     data: {
                             society_id: society_id
                           },
                     success: function(data)
                     {
                         window.location='{{ url("/society/display") }}';
                     },
                     error : function(date)
                     {
                         window.location='{{ url("/society/display") }}';
                     }
                 });
             }
         }
     </script>
 @endsection


