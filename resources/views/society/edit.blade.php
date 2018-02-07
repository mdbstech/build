@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="btn-group pull-right">
                        <a href="{{ url('/society/display') }}" class="btn btn-danger waves-effect waves-light">All Socities</a>
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
                <form class="form-horizontal" action="{{ url('/society/update/'.$society->society_id) }}" method="POST" autocomplete="off" id="society-form" enctype="multipart/form-data">
                    <div class="col-md-9">
                        <div class="panel panel-color panel-custom">
                            <div class="panel-heading">
                                <h3 class="panel-title">EDIT SOCIETY</h3>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    {{ csrf_field() }}
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('society_code') ? ' has-error' : '' }}">
                                            <label for="society_code" class="col-md-4 control-label">Society Code*</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="society_code" id="society_code" placeholder="Society Code" value="{{ $society->society_code }}">
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('society_name') ? ' has-error' : '' }}">
                                            <label for="society_name" class="col-md-4 control-label">Society Name*</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="society_name" id="society_name" placeholder="Society Name" value="{{ $society->society_name }}">
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('industry') ? ' has-error' : '' }}">
                                            <label for="industry" class="col-md-4 control-label">Industry</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="industry" id="industry" placeholder="Industry" value="{{ $society->industry }}">
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email" class="col-md-4 control-label">Email* </label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{ $society->email }}">
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('mobile_no') ? ' has-error' : '' }}">
                                            <label for="mobile_no" class="col-md-4 control-label">Mobile No *</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="mobile_no" id="mobile_no" placeholder="Mobile No" value="{{ $society->mobile_no }}">
                                              
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('phone_no') ? ' has-error' : '' }}">
                                            <label for="phone_no" class="col-md-4 control-label">Phone No </label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="Phone No" value="{{ $society->phone_no }}">
                                             
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
                                            <label for="address1" class="col-md-4 control-label">Address Line 1*</label>
                                            <div class="col-md-8">
                                                <textarea type="text" class="form-control" name="address1" id="address line 1" placeholder="Address 1">{{ $society->address1 }}</textarea>
                                             
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
                                            <label for="address2" class="col-md-4 control-label">Address
                                            Line 2</label>
                                            <div class="col-md-8">
                                                <textarea type="text" class="form-control" name="address2" id="address line 2" placeholder="Address 2">{{$society->address2 }}</textarea>
                                              
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                            <label for="city" class="col-md-4 control-label">City*</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="city" id="city" placeholder="City" value="{{ $society->city }}">
                                              
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                            <label for="state" class="col-md-4 control-label">State*</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="state" id="state" placeholder="State" value="{{ $society->state }}">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                                            <label for="country" class="col-md-4 control-label">Country*</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="country" id="country" placeholder="Country" value="{{ $society->country }}">
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('gstin_no') ? ' has-error' : '' }}">
                                            <label for="gstin_no" class="col-md-4 control-label">GSTIN No</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="gstin_no" id="gstin_no" placeholder="Gstin No" value="{{ $society->gstin_no }}">
                                             
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('pan_no') ? ' has-error' : '' }}">
                                            <label for="pan_no" class="col-md-4 control-label">PAN No</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="pan_no" id="pan_no" placeholder="Pan No" value="{{ $society->pan_no }}">
                                              
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('cin_no') ? ' has-error' : '' }}">
                                            <label for="cin_no" class="col-md-4 control-label">CIN No</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="cin_no" id="cin_no" placeholder="Cin No" value="{{ $society->cin_no }}">
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('tin_no') ? ' has-error' : '' }}">
                                            <label for="tin_no" class="col-md-4 control-label">TIN No</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="tin_no" id="tin_no" placeholder="Tin No" value="{{ $society->tin_no }}">
                                            
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('cst_no') ? ' has-error' : '' }}">
                                            <label for="cst_no" class="col-md-4 control-label">CST No</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="cst_no" id="cst_no" placeholder="Cst No" value="{{ $society->cst_no }}">
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="pull-right">
                                                
                                                 <a href="{{ url('/society/create') }}" class="btn btn-danger waves-effect waves-light">Discard</a>
                                                 <button type="submit" class="btn btn-default waves-effect waves-light">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            </div> 
                        </div>
                    </div>
                </div>
                    <div class="col-md-3">
                        <div class="panel panel-color panel-custom">
                            <div class="panel-heading">
                                <h3 class="panel-title"> SOCIETY LOGO</h3>
                            </div>
                            <div class="gal-detail thumb">
                                <input type="file" id="logo" name="logo" multiple class="dropify" data-default-file="{{ asset('public/images/society/') }}/{{ $society->logo }}"> 
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
