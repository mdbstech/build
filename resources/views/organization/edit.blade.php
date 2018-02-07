@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">ORGANIZATIONS</h4>
                    <ol></ol>
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
            <div class="row">
                <form class="form-horizontal" action="{{ url('/organization/update/'.$organization->org_id) }}" method="POST" autocomplete="off" id="organization-form" enctype="multipart/form-data">
                    <div class="col-md-9">
                        <div class="panel panel-color panel-custom">
                            <div class="panel-heading">
                                <h3 class="panel-title">Organization</h3>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    {{ csrf_field() }}
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('org_code') ? ' has-error' : '' }}">
                                            <label for="org_code" class="col-md-4 control-label">Org Code *</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="org_code" id="org_code" placeholder="Org Code" value="{{ $organization->org_code }}">
                                              
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('org_name') ? ' has-error' : '' }}">
                                            <label for="org_name" class="col-md-4 control-label">Organization Name*</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="org_name" id="org_name" placeholder="Organization Name" value="{{ $organization->org_name }}">
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('industry') ? ' has-error' : '' }}">
                                            <label for="industry" class="col-md-4 control-label">Industry*</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="industry" id="industry" placeholder="Industry" value="{{ $organization->industry }}">
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email" class="col-md-4 control-label">Email* </label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{ $organization->email }}">
                                              
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('mobile_no') ? ' has-error' : '' }}">
                                            <label for="mobile_no" class="col-md-4 control-label">Mobile No *</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="mobile_no" id="mobile_no" placeholder="Mobile No" value="{{ $organization->mobile_no }}">
                                              
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('phone_no') ? ' has-error' : '' }}">
                                            <label for="phone_no" class="col-md-4 control-label">Phone No </label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="Phone No" value="{{ $organization->phone_no }}">
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
                                                <label for="address1" class="col-md-4 control-label">Address 1*</label>
                                                <div class="col-md-8">
                                                    <textarea type="text" class="form-control" name="address1" id="address1" placeholder="Address 1">{{ $organization->address1 }}</textarea>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
                                                <label for="address2" class="col-md-4 control-label">Address 2</label>
                                                <div class="col-md-8">
                                                    <textarea type="text" class="form-control" name="address2" id="address2" placeholder="Address 2">{{$organization->address2 }}</textarea>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                                <label for="city" class="col-md-4 control-label">City*</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="city" id="city" placeholder="City" value="{{ $organization->city }}">
                                                   
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                                <label for="state" class="col-md-4 control-label">State*</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="state" id="state" placeholder="State" value="{{ $organization->state }}">
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                                                <label for="country" class="col-md-4 control-label">Country*</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="country" id="country" placeholder="Country" value="{{ $organization->country }}">
                                                  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('fiscal_year') ? ' has-error' : '' }}">
                                                <label for="fiscal_year" class="col-md-4 control-label">Fiscal Year*</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="fiscal_year" id="fiscal_year" placeholder="Fiscal Year" value="{{ $organization->fiscal_year }}">
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('gstin_no') ? ' has-error' : '' }}">
                                                <label for="gstin_no" class="col-md-4 control-label">GSTIN No</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="gstin_no" id="gstin_no" placeholder="Gstin No" value="{{ $organization->gstin_no }}">
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('pan_no') ? ' has-error' : '' }}">
                                                <label for="pan_no" class="col-md-4 control-label">PAN No</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="pan_no" id="pan_no" placeholder="Pan No" value="{{ $organization->pan_no }}">
                                                 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('cin_no') ? ' has-error' : '' }}">
                                                <label for="cin_no" class="col-md-4 control-label">CIN No</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="cin_no" id="cin_no" placeholder="Cin No" value="{{ $organization->cin_no }}">
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('tin_no') ? ' has-error' : '' }}">
                                                <label for="tin_no" class="col-md-4 control-label">TIN No</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="tin_no" id="tin_no" placeholder="Tin No" value="{{ $organization->tin_no }}">
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('cst_no') ? ' has-error' : '' }}">
                                                <label for="cst_no" class="col-md-4 control-label">CST No</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="cst_no" id="cst_no" placeholder="Cst No" value="{{ $organization->cst_no }}">
                                                  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('state_code') ? ' has-error' : '' }}">
                                                <label for="state_code" class="col-md-4 control-label">State Code*</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="state_code" id="state_code" placeholder="State Code" value="{{ $organization->state_code }}">
                                                  
                                                </div>
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
                    <div class="col-md-3">
                        <a class="btn btn-default waves-effect waves-light btn-block">ORGANIZATION LOGO</a>
                        <div class="gal-detail thumb">
                            <input type="file" id="logo" name="logo" multiple class="dropify" data-default-file="{{ asset('public/images/organization/') }}/{{ $organization->logo }}"> 
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
