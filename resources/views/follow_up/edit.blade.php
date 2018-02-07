@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    

                    <h4 class="page-title">Follow Ups</h4>
                   
                </div>
            </div>
            @if(session()->has('success-message'))
                <div class="alert alert-success alert-dismissable">
                    <button type="submit" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session()->get('success-message') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">Edit follow up</div>
                        <form class="form-horizontal" action="{{ url('/follow_up/update/'.$follow_up->follow_id) }}" method="POST" autocomplete="off" role="form-horizontal" id="follow_up-form" enctype="multipart/form-data">
                            <div class="panel-body">
                                {{ csrf_field() }}
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('contact_id') ? ' has-error' : '' }}">

                                        <label for="contact_id" class="control-label">Contact*</label>

                                        <div class="col-md-12">
                                          <select id="contact_id" name="contact_id" class="form-control" autofocus>
                                              <option value="">Select Contact </option>
                                              @foreach($contacts as $contact)
                                                  <option @if($follow_up->contact_id==$contact->contact_id) selected @endif value="{{ $contact->contact_id }}">{{ $contact->contact_name }}</option>
                                              @endforeach
                                          </select>
                                            @if ($errors->has('contact_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('contact_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">

                                            <label for="date" class="control-label"> Date  *</label>

                                        <div class="col-md-12">
                                            <input type="text" class="datepicker-autoclose form-control" id="date" name="date" data-date-format="dd-mm-yyyy" value="{{ date('d-m-Y',strtotime($follow_up->date)) }}">
                                            @if ($errors->has('date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">

                                            <label for="time" class="control-label">Time  *</label>

                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="time" name="time" placeholder="time " value="{{ $follow_up->time }}">
                                            @if ($errors->has('time'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('time') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                   <div class="form-group{{ $errors->has('follow_up_description') ? ' has-error' : '' }}">
                                       <div class="col-md-12">
                                         <label for="follow_up_description" class="control-label">Follow Up Description </label>
                                          </div>
                                       <div class="col-md-12">
                                           <textarea type="text" class="form-control" id="follow_up_description" name="follow up description" placeholder="follow up description">{{ $follow_up->follow_up_description }}</textarea>
                                           @if ($errors->has('follow_up_description'))
                                               <span class="help-block">
                                                   <strong>{{ $errors->first('follow_up_description') }}</strong>
                                               </span>
                                           @endif
                                       </div>
                                   </div>
                               </div>
                                <div class="col-md-12">
                                   <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                                       <div class="col-md-12">
                                         <label for="note" class="control-label">Note </label>
                                          </div>
                                       <div class="col-md-12">
                                           <textarea type="text" class="form-control" id="note" name="note" placeholder="note">{{ $follow_up->note }}</textarea>
                                           @if ($errors->has('note'))
                                               <span class="help-block">
                                                   <strong>{{ $errors->first('note') }}</strong>
                                               </span>
                                           @endif
                                       </div>
                                   </div>
                               </div>
                            </div>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                                            <a href="{{ url('/follow_up/create/'.$follow_up->contact_id) }}" class="btn btn-danger waves-effect waves-light">Discard</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">Follow Ups</div>
                        <div class="panel-body">
                            {{-- <form class="form-group" id="form" action="{{ url('/follow_up/search') }}" method="GET" autocomplete="off" role="search">
                                <div class="input-group">
                                    <input type="text" id="search" name="search" class="form-control" placeholder="Search">
                                     <span class="input-group-btn">
                                        <button type="submit" class="btn waves-effect waves-light btn-info"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </form> --}}
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th >#</th>
                                            <th class="text-nowrap">Contact</th>
                                            <th class="text-nowrap"> Date</th>
                                            <th class="text-nowrap">Time</th>
                                            <th class="text-nowrap">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=$follow_ups->perPage() * ($follow_ups->currentPage()-1); @endphp
                                        @foreach($follow_ups as $follow_up)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $follow_up->Contact->contact_name }}</td>
                                                <td>
                                                {{ date('d-m-Y',strtotime($follow_up->date)) }}
                                                </td>
                                                <td>{{ $follow_up->date }}</td>
                                                <td>{{ $follow_up->time }}</td>
                                                <td class="text-nowrap">
                                                    <a href="{{ url('/follow_up/edit/'.$follow_up->follow_id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>
                                                      @if(Auth::User()->user_role=='Super Admin')
                                                        <a onclick="Delete('{{ $follow_up->follow_id }}')" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer; cursor:hand"> <i class="fa fa-close text-danger"></i> </a>
                                                        @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($follow_ups->total() > $follow_ups->perPage())
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="pull-right">
                                         {{ $follow_ups->render() }}
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
        function Delete(follow_id)
        {
            if(confirm('Do you want to Continue...?'))
            {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('follow_up.delete') }}",
                    data: {
                            follow_id: follow_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/follow_up/create/".$contact->contact_id) }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/follow_up/create/".$contact->contact_id) }}';
                    }
                });
            }
        }
    </script>
@endsection
