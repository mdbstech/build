@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <h4 class="page-title">  {{ $status }} Tickets</h4>
                </div>
            </div>
            @if(session()->has('success-message'))
                <div class="alert alert-success alert-dismissable">
                     <button type="submit" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session()->get('success-message') }}
                </div>
            @endif
            <div class="row"> 
                <div class="col-lg-3 col-md-4">
                    <div class="p-20">
                        <a href="{{ url('ticket/create') }}" class="btn btn-danger btn-rounded btn-custom btn-block waves-effect waves-light">NEW TICKET</a>          
                        <div class="list-group mail-list  m-t-20">
                          

                            <a href="{{ url('/ticket/display?status=All') }}" class="list-group-item @if($status=='All') active @endif">ALL TICKETS</a>
                            <a href="{{ url('/ticket/display?status=Open') }}" class="list-group-item @if($status=='Open') active @endif">OPEN TICKETS</a>
                            <a href="{{ url('/ticket/display?status=Pending') }}" class="list-group-item @if($status=='Pending') active  @endif">PENDING TICKETS</a>
                            <a href="{{ url('/ticket/display?status=Close') }}" class="list-group-item @if($status=='Close') active @endif">CLOSED TICKETS</a>  
                            <a href="{{ url('/ticket/display?status=Reopen') }}" class="list-group-item @if($status=='Reopen') active @endif">REOPEN TICKETS</a>  
                        </div>
                        <h3 class="panel-title m-t-40">Category</h3>
                                    
                        <div class="list-group b-0 mail-list">
                            @foreach($categories as $category)
                                <a href="{{ url('/ticket/display?status='.$status.'&category='.$category->category_id) }}" class="list-group-item b-0"><span class="fa fa-circle text-info m-r-10"></span>{{ $category->category_name }}</a>
                            @endforeach
                        </div>  
                        <h3 class="panel-title m-t-40">Priority</h3>
                                    
                        <div class="list-group b-0 mail-list">
                            @foreach($priorities as $priority)
                                <a href="{{ url('/ticket/display?status='.$status.'&priority='.$priority->priority_id )}}" class="list-group-item b-0"><span class="fa fa-circle text-info m-r-10"></span>{{ $priority->priority_name }}</a>
                            @endforeach
                        </div>                   
                    </div>            
                </div>
                <section>
                    <form class="form-horizontal" action="{{ url('/ticket/search') }}" method="GET" autocomplete="off">  
                     <input type="hidden" name="status" value="{{ $status }}">  
                        <div class="col-lg-3"> 
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <select id="field" name="field" class="form-control"> 
                                        <option @if(app('request')->input('field')=='contact_name,e,Contact') selected @endif value="contact_name,e,Contact">Member </option>
                                        <option @if(app('request')->input('field')=='message,e,Message') selected @endif value="message,e,Message">Message
                                        </option>
                                    </select>

                                </span>
                            </div>          
                        </div>
                        <div class="col-lg-3">
                            <div class="input-group">
                                <input id="search" name="search" class="form-control" placeholder="Search" type="text">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn waves-effect waves-light btn-default"><i class="fa fa-search"></i></button>
                                </span>   
                            </div>  
                        </div>
                    </form>
                </section> 
                <div class="col-lg-9 col-md-8">
                    <form class="form-horizontal" action="{{ url('/ticket/multiple_delete')}}" method="POST" autocomplete="off" 
                        id="ticket-form" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="btn-toolbar m-t-20" role="toolbar">
                                    <div class="btn-group">
                                       
                                        <button type="submit" class="btn btn-primary waves-effect waves-light "><i class="fa fa-trash-o"></i></button>
                                    </div>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary waves-effect waves-light  dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                          More
                                          <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li><a href="">Closed Tickets</a></li>
                                          <li><a href="">Pending Tickets</a></li>
                                          <li><a href="">Open Tickets</a></li>
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
                                         
                                            <tr id='ticket{{$ticket->ticket_id}}' @if($ticket->read_status == 0) class="unread" @else class="" @endif >

                                                <td width="15%">
                                                    <div class="checkbox checkbox-primary">
                                                        <input id="checked" type="checkbox" name="checked[]" value="{{ $ticket->ticket_id }}">
                                                        <label for="checkbox1"></label>
                                                    </div>
                                                    <img src="{{ asset('public/images/user') }}/{{ $ticket->Contact->image }}" class="img-circle thumb-sm"">
                                                </td>

                                                <td>
                                                    <a href="{{ url('/ticket/view/'.$ticket->ticket_id) }}" class="email-name" > {{ $ticket->Contact->contact_name }}</a>
                                                </td>
                                                <td class="hidden-xs">
                                                    <a href="{{ url('/ticket/view/'.$ticket->ticket_id) }}" class="email-msg">{{ substr(strip_tags($ticket->DefaultMessage($ticket->ticket_id)->message),0,50)}} {{ strlen(strip_tags($ticket->DefaultMessage($ticket->ticket_id)->message)) > 50 ? "...":"" }}
                                                    </a>
                                                </td>
                                                <td class="text-center" style="width: 20px;">
                                                    <label class="label label-danger">{{ $ticket->status }}</label>
                                                </td>
                                                <td class="text-right">{{$ticket->created_at->diffForHumans()}}</td>
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


