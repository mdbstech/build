@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                    <div class="profile-detail card-box">
                        <div>
                            <img src="{{ asset('public/images/User')}}/{{ Auth::user()->avatar }}" class="img-circle" alt="profile-image">
                            <hr>
                            <h4 class="text-uppercase font-600">About Me</h4>
                            <div class="text-left">
                                <p class="text-muted font-13"><strong>Name :</strong> <span class="m-l-15">{{ Auth::user()->username }}</span></p>

                                <p class="text-muted font-13"><strong>Mobile :</strong><span class="m-l-15">{{ Auth::user()->mobile_no }}</span></p>

                                <p class="text-muted font-13"><strong>Email:</strong> <span class="m-l-15">{{ Auth::user()->email }}</span></p>

                                <p class="text-muted font-13"><strong>Address :</strong> <span class="m-l-15">{{ Auth::user()->address1 }}</span></p>

                                <p class="text-muted font-13"><strong>State :</strong> <span class="m-l-15">{{ Auth::user()->state }}</span></p>

                                <p class="text-muted font-13"><strong>Country :</strong> <span class="m-l-15">{{ Auth::user()->country }}</span></p>
                            </div>


                            <div class="button-list m-t-20">
                                <button type="button" class="btn btn-facebook waves-effect waves-light">
                                   <i class="fa fa-facebook"></i>
                                </button>

                                <button type="button" class="btn btn-twitter waves-effect waves-light">
                                   <i class="fa fa-twitter"></i>
                                </button>

                                <button type="button" class="btn btn-linkedin waves-effect waves-light">
                                   <i class="fa fa-linkedin"></i>
                                </button>

                                <button type="button" class="btn btn-dribbble waves-effect waves-light">
                                   <i class="fa fa-dribbble"></i>
                                </button>

                            </div>
                        </div>

                    </div>

                  
                </div>


                            <div class="col-lg-9 col-md-8">
                               <div class="col-lg-12">
                    <div class="widget-profile-one">
                        <div class="card-box m-b-0 b-0 bg-primary p-lg text-center">
                            <div class="m-b-30">
                                <h3 class="text-white m-b-5">
                                    {{ Auth::user()->user_role}}
                                </h3>
                                
                            </div>
                            <img src="{{ asset('public/images/organization')}}/{{ $boot_org->logo }}" class="img-circle thumb-x-lg" alt="profile">
                            <div class="m-t-10">
                               
                            
                           
                            </div>
                        </div>
                       
                    </div>
                </div> 
                <div class="col-lg-12">
                   <div class="card-box p-0">
                       <div class="profile-widget text-center">
                            <div class="panel panel-inverse">
                                <form class="form-horizontal" action="{{ url('/user/update_profile/'.Auth::User()->user_id) }}"
                                method="POST" autocomplete="off" role="form-horizontal"
                                id="user-form" enctype="multipart/form-data">
                                    <div class="panel-body">
                                        {{ csrf_field() }}
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                                <label for="username" class="col-md-4 control-label">User Name</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="username" name="username" placeholder="User Name" value="{{ Auth::user()->username }}">
                                                    @if ($errors->has('username'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('username') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label for="name" class="col-md-4 control-label"> Name </label>
                                                <div class="col-md-8">
                                                   <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{Auth::user()->name }}">
                                                    @if ($errors->has('name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label for="email" class="col-md-4 control-label">Email </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ Auth::user()->email }}">
                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('mobile_no') ? ' has-error' : '' }}">
                                                <label for="mobile_no" class="col-md-4 control-label">Mobile No</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Mobile No" value="{{ Auth::user()->mobile_no }}">
                                                    @if ($errors->has('mobile_no'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('mobile_no') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                <label for="password" class="col-md-4 control-label">Password</label>
                                                <div class="col-md-8">
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="6 Characters" value="{{ old('password') }}">
                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                                <label for="password-confirm" class= "col-md-4 control-label">Confirm Password</label>
                                                <div class="col-md-8">
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="6 Characters">

                                                    @if ($errors->has('password_confirmation'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                           <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                                                <label for="avatar" class="col-md-4 control-label">Avatar </label>
                                                <div class="col-md-8">
                                                    <input type="file" class="form-control" id="avatar" name="avatar"  multiple value="{{ $user->avatar }}">
                                                    @if ($errors->has('avatar'))
                                                        <span class="help-block">
                                                           <strong>{{ $errors->first('avatar') }}</strong>
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
                                                    <a href="{{ url('/user/profile') }}" class="btn btn-danger waves-effect waves-light">Discard</a>
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

                        </div>

            
        </div>
    </div>
@endsection

