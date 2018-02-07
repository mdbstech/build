@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Ticket</h4>
                </div>
            </div>
            <div class="row"> 
                <div class="col-lg-3 col-md-4">
                    <div class="p-20">
                        <a href="{{ url('ticket/create') }}" class="btn btn-danger btn-rounded btn-custom btn-block waves-effect waves-light">NEW TICKET</a>          
                        <div class="list-group mail-list  m-t-20">
                            <a href="{{ url('/ticket/display?status=All') }}" class="list-group-item b-0 active">ALL TICKETS</a>
                            <a href="{{ url('/ticket/display?status=Open') }}" class="list-group-item b-0">OPEN TICKETS</a>
                            <a href="{{ url('/ticket/display?status=Pending') }}" class="list-group-item b-0">PENDING TICKETS</a>
                            <a href="{{ url('/ticket/display?status=Close') }}" class="list-group-item b-0">CLOSED TICKETS</a> 
                        </div>
                        <h3 class="panel-title m-t-40">Labels</h3>
                                    
                        <div class="list-group b-0 mail-list">
                            <a href="#" class="list-group-item b-0"><span class="fa fa-circle text-info m-r-10"></span>Web App</a>
                            <a href="#" class="list-group-item b-0"><span class="fa fa-circle text-warning m-r-10"></span>Project 1</a>
                            <a href="#" class="list-group-item b-0"><span class="fa fa-circle text-purple m-r-10"></span>Project 2</a>
                            <a href="#" class="list-group-item b-0"><span class="fa fa-circle text-pink m-r-10"></span>Friends</a>
                            <a href="#" class="list-group-item b-0"><span class="fa fa-circle text-success m-r-10"></span>Family</a>
                        </div>                   
                    </div>            
                </div>
                <div class="col-lg-9 col-md-8">
                    <form class="form-horizontal" action="{{ url('/ticket/multiple_delete')}}" method="POST" autocomplete="off" 
                        id="ticket-form" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="btn-toolbar m-t-20" role="toolbar">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary waves-effect waves-light "><i class="fa fa-inbox"></i></button>
                                        <button type="button" class="btn btn-primary waves-effect waves-light "><i class="fa fa-exclamation-circle"></i></button>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light "><i class="fa fa-trash-o"></i></button>
                                    </div>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-folder"></i>
                                        <b class="caret"></b>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="javascript:void(0);">Closed Tickets</a></li>
                                            <li><a href="javascript:void(0);">Pending Tickets</a></li>
                                            <li><a href="javascript:void(0);">Open Tickets</a></li>
                                            <li class="divider"></li>
                                            <li><a href="javascript:void(0);">Separated link</a></li>
                                        </ul>
                                    </div>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary waves-effect waves-light  dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-tag"></i>
                                        <b class="caret"></b>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="javascript:void(0);">Action</a></li>
                                            <li><a href="javascript:void(0);">Another action</a></li>
                                            <li><a href="javascript:void(0);">Something else here</a></li>
                                            <li class="divider"></li>
                                            <li><a href="javascript:void(0);">Separated link</a></li>
                                        </ul>
                                    </div>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary waves-effect waves-light  dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                          More
                                          <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li><a href="javascript:void(0);">Closed Tickets</a></li>
                                          <li><a href="javascript:void(0);">Pending Tickets</a></li>
                                          <li><a href="javascript:void(0);">Open Tickets</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    <div class="panel panel-default m-t-20">
                        <div class="panel-body p-0">
                            <div class="table-responsive">
                                @php $i=$tickets->perPage() * ($tickets->currentPage()-1); 
                                @endphp
                                @foreach($tickets as $ticket)
                                    <table class="table table-hover mails m-0">
                                        <tbody>
                                            <tr class="unread">
                                                <td class="mail-select">
                                                    <div class="checkbox checkbox-primary m-r-15">
                                                        <input id="checked" type="checkbox" name="checked[]" value="{{ $ticket->ticket_id }}">
                                                        <label for="checkbox1"></label>
                                                    </div>
                                                    <img src="{{ asset('public/images/user') }}/{{ $ticket->Contact->image }}" class="img-circle" style="height:25px;" >
                                                    <!--  <i class="fa fa-circle m-l-5 text-warning"></i> -->
                                                </td>
                                                <td>
                                                    <a href="{{ url('/ticket/view/'.$ticket->ticket_id) }}" class="email-name"> {{ $ticket->Contact->contact_name }}</a>
                                                </td>
                                                <td class="hidden-xs">
                                                    <a href="{{ url('/ticket/view/'.$ticket->ticket_id) }}" class="email-msg">{{ $ticket->DefaultMessage($ticket->ticket_id)->message }}</a>
                                                </td>
                                                <td style="width: 20px;">
                                                    <i class="fa fa-paperclip"></i>
                                                </td>
                                                <td class="text-right"> {{date('d-m-Y',strtotime($ticket->ticket_date)) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endforeach
                            </div>         
                        </div>
                    </div> 
                    @if($tickets->total() > $tickets->perPage())           
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="btn-group pull-right">
                                    {{ $tickets->render() }}
                                </div>
                            </div>
                        </div>
                    @endif
                </form>
                </div>
            </div>     
        </div>
    </div>
@endsection
s