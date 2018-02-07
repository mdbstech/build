@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">New Ticket</h4>
                </div>
               
            </div><br>
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
            <div class="row">
                <div class="col-md-3">
                    <div class="p-20">
                        <a href="{{ url('ticket/create') }}" class="btn btn-danger btn-rounded btn-custom btn-block waves-effect waves-light">NEW TICKET</a>          
                        <div class="list-group mail-list  m-t-20">
                             <a href="{{ url('/ticket/display?status=All') }}" class="list-group-item b-0 active">ALL TICKETS</a>
                            <a href="{{ url('/ticket/display?status=Open') }}" class="list-group-item b-0">OPEN TICKETS</a>
                            <a href="{{ url('/ticket/display?status=Pending') }}" class="list-group-item b-0">PENDING TICKETS</a>
                            <a href="{{ url('/ticket/display?status=Close') }}" class="list-group-item b-0">CLOSED TICKETS</a> 
                        </div>
                        <h3 class="panel-title m-t-40">CATEGORY</h3>         
                        <div class="list-group b-0 mail-list">
                            @foreach($categories as $category)
                                <a href="{{ url('/ticket/display?status=All'.'&category='.$category->category_id) }}" class="list-group-item b-0"><span class="fa fa-circle text-info m-r-10"></span>{{ $category->category_name }}</a>
                            @endforeach
                        </div>   
                        <h3 class="panel-title m-t-40">Priority</h3>
                                    
                        <div class="list-group b-0 mail-list">
                            @foreach($priorities as $priority)
                                <a href="{{ url('/ticket/display?status=All'.'&priority='.$priority->priority_id )}}" class="list-group-item b-0"><span class="fa fa-circle text-info m-r-10"></span>{{ $priority->priority_name }}</a>
                            @endforeach
                        </div>                  
                    </div>            
                </div>
               <div class="col-md-9">
                    <div class="panel panel-color panel-custom">
                        <div class="panel-heading">
                            <h3 class="panel-title">EDIT TICKET</h3>
                        </div>
                        <form class="form-horizontal" action="{{ url('/ticket/update/'.$ticket->ticket_id)}}" method="POST" autocomplete="off" 
                         id="ticket-form" enctype="multipart/form-data">
                            <div class="panel-body">
                                {{ csrf_field() }}
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('ticket_no') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                           <label for="ticket_no" class="control-label">Ticket No *</label>
                                        </div>
                                         <div class="col-md-12">
                                          <input type="text" class="form-control" id="ticket_no" name="ticket_no" placeholder="ticket no " value="{{ $ticket->ticket_no }}">
                                           
                                        </div>
                                     </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('ticket_date') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="ticket_date" class="control-label">Ticket Date *</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="datepicker-autoclose form-control" id="ticket_date" name="ticket_date"  data-date-format="dd-mm-yyyy" value="{{ date('d-m-Y',strtotime($ticket->ticket_date)) }}">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="category_id" class="control-label">Category*</label>
                                        </div>
                                        <div class="col-md-12">
                                            <select id="category_id" name="category_id" class="form-control" autofocus>
                                                <option value="">Select Category </option>
                                                @foreach($categories as $category)
                                                    <option @if($ticket->category_id==$category->category_id) selected @endif value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('priority_id') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                           <label for="priority_id" class="control-label">Priority*</label>
                                        </div>
                                        <div class="col-md-12">
                                            <select id="priority_id" name="priority_id" class="form-control" autofocus>
                                                <option value="">Select Priority</option>
                                                @foreach($priorities as $priority)
                                                    <option @if($ticket->priority_id==$priority->priority_id) selected @endif value="{{ $priority->priority_id }}">{{ $priority->priority_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('contact_id') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="contact_id" class="control-label">Contact*</label>
                                        </div>
                                        <div class="col-md-12">
                                             <select id="contact_id" name="contact_id" class="select2" autofocus>
                                                <option value="">Select Contact</option>
                                                @foreach($contacts as $contact)
                                                    <option @if($ticket->contact_id==$contact->contact_id) selected @endif value="{{ $contact->contact_id }}">{{ $contact->contact_name }}</option>
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                     <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                             <label for="user_id" class="control-label">User*</label>
                                        </div>
                                        <div class="col-md-12">
                                            <select id="user_id" name="user_id" class="select2" autofocus>
                                                <option value="">Select User</option>
                                                @foreach($users as $user)
                                                    <option @if($ticket->user_id==$user->user_id) selected @endif value="{{ $user->user_id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                             
                                         </div>
                                     </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="message" class="control-label">Message* </label>
                                          </div>
                                        <div class="col-md-12">
                                           <textarea rows="8" type="text" class="form-control" name="message" placeholder="Message">{{ $ticket->DefaultMessage($ticket->ticket_id)->message }}</textarea>
                                        </div>
                                   </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                                      <div class="col-md-12">
                                        <label for="file" class="control-label">Files</label>
                                         </div>
                                        <div class="col-md-12">
                                          <input type="file" class="dropify"   name="file[]" multiple value="{{ $ticket->file }}">
                                         
                                      </div>
                                  </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="note" class="control-label">Note </label>
                                          </div>
                                       <div class="col-md-12">
                                           <textarea rows="8" type="text" class="form-control" id="note" name="note" placeholder="note">{{ $ticket->note }}</textarea>
                                           
                                       </div>
                                   </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pull-right">
                                             <a href="{{ url('/ticket/create') }}" class="btn btn-danger waves-effect waves-light">Discard</a>
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

