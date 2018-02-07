@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                   
                    <h4 class="page-title">Tickets</h4>
                    <ol class="breadcrumb">
                        <li>
                            <a> Builders &amp; Developers</a>
                        </li>
                        <li>
                           <a href="{{ url('ticket/create') }}">New Ticket</a></li>
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
                 <div class="col-md-4">
                    <div class="panel panel-inverse">
                        <div class="panel-body p-0">
                            <div class="list-group mail-list">

                              <a href="{{ url('/ticket/all') }}" class="list-group-item no-border"><i class="fa fa-paper-plane-o m-r-5"></i> All Tickets</a>
                              <a href="{{ url('/ticket/open') }}" class="list-group-item no-border"><i class="fa fa-file-text-o m-r-5"></i> Open Tickets</a>
                              <a href="{{ url('/ticket/pending') }}" class="list-group-item no-border"><i class="fa fa-paper-plane-o m-r-5"></i> Pending Tickets</a>
                              <a href="{{ url('/ticket/close') }}" class="list-group-item no-border"><i class="fa fa-paper-plane-o m-r-5"></i> Closed Tickets</a>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-md-8">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">Open Tickets</div>
                        <div class="panel-body">
                            <form class="form-group" id="form" action="{{ url('/ticket/open_search') }}" method="GET" autocomplete="off" role="search">
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
                                            <th >#</th>
                                            <th class="text-nowrap">Ticket No</th>
                                            <th class="text-nowrap">Ticket Date</th>
                                            <th class="text-nowrap">Priority</th>
                                            <th class="text-nowrap">Subject</th>
                                            <th class="text-nowrap">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=$tickets->perPage() * ($tickets->currentPage()-1);
                                        @endphp
                                        @foreach($tickets as $ticket)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $ticket->ticket_no }}</td>
                                                <td>{{ $ticket->ticket_date }}</td>

                                                <td>{{ $ticket->Priority->priority_name }}</td>
                                                <td>{{ $ticket->subject }}</td>
                                                <td class="text-nowrap">
                                                    <a href="{{ url('/ticket/edit/'.$ticket->ticket_id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>

                                                    <a href="{{ url('/ticket/view/'.$ticket->ticket_id) }}" data-toggle="tooltip" data-original-title="View"> <i class="fa fa-eye text-inverse m-r-10"></i></a>

                                                    <a href="{{ url('/ticket/update_close/'.$ticket->ticket_id) }}" data-toggle="tooltip" data-original-title="Close" style="cursor:pointer; cursor:hand"> <i class="fa fa-remove text-info m-r-10"></i></a>

                                                    @if(Auth::User()->user_role=='Super Admin')
                                                        <a onclick="Delete('{{ $ticket->ticket_id }}')" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer; cursor:hand"> <i class="fa fa-close text-danger"></i> </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($tickets->total() > $tickets->perPage())
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="pull-right">
                                         {{ $tickets->render() }}
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
        function Delete(ticket_id)
        {
            if(confirm('Do you want to Continue...?'))
            {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('ticket.delete') }}",
                    data: {
                            ticket_id: ticket_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/ticket/open") }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/ticket/open") }}';
                    }
                });
            }
        }
    </script>
@endsection
