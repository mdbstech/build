@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Ticket</h4>
                </div>
            </div>
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
            <div class="row"> 
                <div class="col-lg-3 col-md-4">
                    <div class="p-20">
                        <a href="{{ url('ticket/create') }}" class="btn btn-danger btn-rounded btn-custom btn-block waves-effect waves-light">NEW TICKET</a>          
                       <div class="list-group mail-list  m-t-20">
                           <a href="{{ url('/ticket/display?status=All') }}" class="list-group-item @if($status=='All') active @else  b-0 @endif">ALL TICKETS</a>
                            <a href="{{ url('/ticket/display?status=Open') }}" class="list-group-item @if($status=='Open') active @else  b-0 @endif">OPEN TICKETS</a>
                            <a href="{{ url('/ticket/display?status=Pending') }}" class="list-group-item @if($status=='Pending') active @else  b-0 @endif">PENDING TICKETS</a>
                            <a href="{{ url('/ticket/display?status=Close') }}" class="list-group-item @if($status=='Close') active @else  b-0 @endif">CLOSED TICKETS</a>  
                            <a href="{{ url('/ticket/display?status=Reopen') }}" class="list-group-item @if($status=='Reopen') active @else  b-0 @endif">REOPEN TICKETS</a>     
                        </div>
                        <h3 class="panel-title m-t-40">Category</h3>
                                    
                        <div class="list-group b-0 mail-list">
                            @foreach($categories as $category)
                                <a href="{{ url('/ticket/display?status='.$ticket->status.'&category='.$category->category_id) }}" class="list-group-item b-0"><span class="fa fa-circle text-info m-r-10"></span>{{ $category->category_name }}</a>
                            @endforeach
                        </div>  
                        <h3 class="panel-title m-t-40">Priority</h3>
                                    
                        <div class="list-group b-0 mail-list">
                            @foreach($priorities as $priority)
                                <a href="{{ url('/ticket/display?status='.$ticket->status.'&priority='.$priority->priority_id )}}" class="list-group-item b-0"><span class="fa fa-circle text-info m-r-10"></span>{{ $priority->priority_name }}</a>
                            @endforeach
                        </div>                   
                    </div>            
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="row">
                            <div class="col-lg-12">
                                <div class="btn-toolbar m-t-20" role="toolbar">
                                    <div class="btn-group">
                                        <a href="{{ url('ticket/edit/'.$ticket->ticket_id) }}" class="btn btn-primary waves-effect waves-light" data-original-title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                        <a onclick="Delete('{{ $ticket->ticket_id }}')" class="btn btn-primary waves-effect waves-light" data-original-title="Delete" data-toggle="tooltip"><i class="fa fa-trash-o"></i></a>
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
                                            
                                           
                                        </ul>
                                    </div>
                                    <div class="btn-group">
                                        @if($ticket->status == "Open" || $ticket->status == "Reopen")
                                            <a href="{{ url('ticket/pending/'.$ticket->ticket_id) }}" class="btn btn-info  waves-effect waves-light">Pending Ticket <span class="m-l-5"></i></span></a>
                                            <a href="{{ url('ticket/close/'.$ticket->ticket_id) }}" class="btn btn-danger  waves-effect waves-light">Close Ticket <span class="m-l-5"></i></span></a>
                                        @endif
                                        @if($ticket->status == "Close")
                                            <a href="{{ url('ticket/reopen/'.$ticket->ticket_id) }}" class="btn btn-danger  waves-effect waves-light">Reopen Ticket <span class="m-l-5"></i></span></a>
                                        @endif
                                        @if($ticket->status == "Pending")
                                            <a href="{{ url('ticket/close/'.$ticket->ticket_id) }}" class="btn btn-danger  waves-effect waves-light">Close Ticket <span class="m-l-5"></i></span></a>
                                        @endif

                                    </div>

                                </div>
                            </div>
                        </form>

                
                        <div class="col-sm-12">
                            <div class="card-box m-t-20">
                                <h4 class="m-t-0"><b>Ticket # {{ $ticket->ticket_no }}</b></h4>
                                <hr/> 
                                <div class="media m-b-30 ">
                                    <a href="#" class="pull-left">
                                        <img alt="{{ $ticket->Contact->contact_name }}" src="{{ asset('public/images/user') }}/{{ $ticket->Contact->image }}" class="media-object thumb-sm img-circle">
                                    </a>
                                    <div class="media-body">
                                        <span class="media-meta pull-right">{{ date('d-m-Y  ',strtotime($ticket->ticket_date)) }}</span>
                                        <h4 class="text-primary m-0">{{ $ticket->Contact->contact_name }}</h4>
                                        <small class="text-muted">Email: {{ $ticket->Contact->email }}</small>
                                    </div>
                                </div> 
                                <p>{{ $message->message }}</p>
                                <hr/>

                                <h4> <i class="fa fa-paperclip m-r-10 m-b-10"></i> Attachments </h4>
                                <div class="row">
                                    @foreach($files as $file)
                                        <div class="col-sm-2 col-xs-4">
                                            <a href="#"> <img src="{{ asset('public/images/File/') }}/{{ $file->file }}" alt="{{ $file->file }}" class="img-thumbnail img-responsive"> </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @foreach($messages as $message)
                            <div class="col-sm-12">
                                <div class="media m-b-0">
                                    <a href="#" class="pull-left">
                                        <img alt="" src="{{ asset('public/images/User') }}/{{ Auth::User()->avatar }}" class="media-object thumb-sm img-circle">
                                    </a>
                                    <div class="media-body">
                                        <div class="card-box">
                                            <p>{{ $message->message }}</p>
                                        </div>
                                    </div>
                                    
                                    <a  onclick="edit_reply('{{ $message->message_id }}')"  class="btn btn-primary waves-effect waves-light btn-xs pull-right" data-toggle="modal" data-target="#custom-width-modal"><i class="fa fa-pencil icon-only"></i></a>
                                    <a  onclick="delete_reply('{{ $message->message_id }}')"  class="btn btn-primary waves-effect waves-light btn-xs pull-right" data-toggle="modal" data-target="#custom-width-modal"><i class="fa fa-trash-o icon-only"></i></a>
                                    
                                </div>
                            </div>
                        @endforeach
                        @if($ticket->status != "Close")
                        <div class="col-sm-12">
                            <form action="{{ url('/ticket/reply/'.$ticket->ticket_id) }}" method="post">
                                {{ csrf_field() }}
                                <div class="media m-b-0">
                                    <a href="#" class="pull-left">
                                        <img alt="" src="{{ asset('public/images/User') }}/{{ Auth::User()->avatar }}" class="media-object thumb-sm img-circle">
                                    </a>
                                    
                                    <div class="media-body">
                                        <div class="card-box">
                                            <textarea class="form-control" name="message"></textarea>
                                        </div>

                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light w-md m-b-30">Send</button><br>
                                   
                                </div>
                            </form>
                        </div>
                        @endif
                    </div> 
                </div>
            </div> 
        </div>     
    </div>
</div>
<div id="edit_reply-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:55%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="custom-width-modalLabel">Message</h4>
            </div>
            <form id="edit_reply-form" method="post">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <textarea class="form-control" id="reply_message" name="reply_message"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update </button>
                </div>
            </form>
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
                        window.location='{{ url("/ticket/display?status=All") }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/ticket/display?status=All") }}';
                    }
                });
            }
        }
        function edit_reply(message_id)
        {
            $.ajax({
                method: 'GET',
                url: "{{ route('ticket.edit_reply') }}",
                data: {
                        message_id: message_id
                      },
                success: function(data)
                {
                    $('#reply_message').val(data.message);
                    $('#edit_reply-form').attr("action","{{ url('/ticket/update_reply') }}/"+message_id);
                    $('#edit_reply-modal').modal('show');
                }
            });
        }
        function delete_reply(message_id)
        {
            if(confirm('Do you want to Continue...?'))
            {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('ticket.delete_reply') }}",
                    data: {
                            message_id: message_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/ticket/view/".$ticket->ticket_id) }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/ticket/view/".$ticket->ticket_id) }}';
                    }
                });
            }
        }
    </script>

@endsection
