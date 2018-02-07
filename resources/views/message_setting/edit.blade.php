@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
           
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
                <form class="form-horizontal" action="{{ url('/message_setting/update/'.$message_setting->message_setting_id) }}" method="POST" autocomplete="off" id="message_setting-form" >
                    <div class="col-md-12">
                        <div class="panel panel-color panel-custom">
                            <div class="panel-heading">
                                <h3 class="panel-title">MESSAGE SETTINGS</h3>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    {{ csrf_field() }}
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                                            <label for="url" class="col-md-4 control-label">URL *</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="url" id="url" placeholder="URL" value="{{ $message_setting->url }}">
                                              
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('auth_key') ? ' has-error' : '' }}">
                                            <label for="auth_key" class="col-md-4 control-label">Auth Key*</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="auth_key" id="auth_key" placeholder="Organization Name" value="{{ $message_setting->auth_key }}">
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('promotional_route') ? ' has-error' : '' }}">
                                            <label for="promotional_route" class="col-md-4 control-label">Promotional_Route*</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="promotional_route" id="promotional_route" placeholder="Promotional_Route" value="{{ $message_setting->promotional_route }}">
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('transactional_route') ? ' has-error' : '' }}">
                                            <label for="transactional_route" class="col-md-4 control-label">Transactional_Route* </label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="transactional_route" id="transactional_route" placeholder="Transactional_Route" value="{{ $message_setting->transactional_route }}">
                                              
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('promotional_sender') ? ' has-error' : '' }}">
                                            <label for="promotional_sender" class="col-md-4 control-label">Promotional_Sender *</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="promotional_sender" id="promotional_sender" placeholder="Promotional_Sender" value="{{ $message_setting->promotional_sender }}">
                                              
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('transactional_sender') ? ' has-error' : '' }}">
                                            <label for="transactional_sender" class="col-md-4 control-label">Transactional_Sender*</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="transactional_sender" id="transactional_sender" placeholder="Transactional_Sender" value="{{ $message_setting->transactional_sender }}">
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                                            <label for="country" class="col-md-4 control-label">Country*</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="country" id="country" placeholder="Country" value="{{ $message_setting->country }}">
                                              
                                            </div>
                                        </div>
                                    </div>
                                       
                                <div class="panel-footer">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="pull-right">
                                                <button type="submit" class="btn btn-default waves-effect waves-light">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                </form>
            </div>
        </div>
    </div>
@endsection
