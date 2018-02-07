@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="btn-group pull-right">
                        <a href="{{ url('contact/display') }}" class="btn btn-danger  waves-effect waves-light"> All Contacts <span class="m-l-5"></span></a>
                    </div>
                    <h4 class="page-title">CONTACTS</h4>
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
                <div class="col-md-12">
                    <div class="panel panel-color panel-custom">
                        <div class="panel-heading">
                            <h3 class="panel-title">EDIT CONTACT</h3>
                        </div>
                        <form class="form-horizontal" action="{{ url('/contact/update/'.$contact->contact_id) }}" method="POST" autocomplete="off" role="form-horizontal" id="contact-form" enctype="multipart/form-data">
                            <div class="panel-body">
                                {{ csrf_field() }}
                                <div class="row">
                            <div class="col-lg-12"> 
                                <ul class="nav nav-tabs tabs">
                                    <li class="active tab">
                                        <a href="#basic" data-toggle="tab" aria-expanded="false"> 
                                            <span class="visible-xs"><i class="fa fa-home"></i></span> 
                                            <span class="hidden-xs">Basic Details</span> 
                                        </a> 
                                    </li> 
                                    <li class="tab"> 
                                        <a href="#address" data-toggle="tab" aria-expanded="false"> 
                                            <span class="visible-xs"><i class="fa fa-user"></i></span> 
                                            <span class="hidden-xs">Address Details</span> 
                                        </a> 
                                    </li> 
                                    <li class="tab"> 
                                        <a href="#reference" data-toggle="tab" aria-expanded="true"> 
                                            <span class="visible-xs"><i class="fa fa-envelope-o"></i></span> 
                                            <span class="hidden-xs">Reference Details</span> 
                                        </a> 
                                    </li> 
                                    <li class="tab"> 
                                        <a href="#nominee" data-toggle="tab" aria-expanded="false"> 
                                            <span class="visible-xs"><i class="fa fa-cog"></i></span> 
                                            <span class="hidden-xs">Nominee Details</span> 
                                        </a> 
                                    </li> 
                                    <li class="tab"> 
                                        <a href="#image" data-toggle="tab" aria-expanded="false"> 
                                            <span class="visible-xs"><i class="fa fa-cog"></i></span> 
                                            <span class="hidden-xs"> Photo Upload</span> 
                                        </a> 
                                    </li> 
                                </ul> 
                                <div class="tab-content"> 
                                    <div class="tab-pane active" id="basic"> 
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('contact_code') ? ' has-error' : '' }}">
                                              
                                            <label for="contact_code" class="col-md-4 control-label">Contact Code *</label>
                                              
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="contact_code" name="contact_code" placeholder="Contact Code" value="{{ $contact->contact_code }}">
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('contact_name') ? ' has-error' : '' }}">
                                                  
                                                <label for="contact_name" class="col-md-4 control-label">Contact Name *</label>
                                                 
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Contact Name" value="{{ $contact->contact_name }}">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('contact_type') ? ' has-error' : '' }}">
                                               
                                                <label for="contact_type" class="col-md-4 control-label">Contact Type*</label>
                                                
                                                <div class="col-md-8">
                                                    <select class="select2" id="contact_type" name="contact_type" autofocus>
                                                        
                                                        <option @if($contact->contact_type=='Lead') selected @endif>Lead</option>
                                                        <option @if($contact->contact_type=='Potential') selected @endif>Potential</option>
                                                        <option @if($contact->contact_type=='Member') selected @endif>Member</option>
                                                    </select>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                             
                                                <label for="gender" class="col-md-4 control-label">Gender*</label>
                                          
                                                <div class="col-md-8">
                                                    <select class="select2" id="gender" name="gender" autofocus>
                                                       
                                                        <option @if($contact->gender=='Male') selected @endif>Male</option>
                                                        <option @if($contact->gender=='Female') selected @endif>Female</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                  
                                                <label for="email" class="col-md-4 control-label">Email *</label>
                                               
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ $contact->email }}">
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                           <div class="form-group{{ $errors->has('mobile_no') ? ' has-error' : '' }}">
                                               
                                                <label for="mobile_no" class="col-md-4 control-label">Mobile No* </label>
                                                  
                                                <div class="col-md-8">
                                                   <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Mobile No" value="{{ $contact->mobile_no }}">
                                               </div>
                                           </div>
                                        </div>
                                        <!-- <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('relationship_type') ? ' has-error' : '' }}">
                                                
                                                <label for="relationship_type" class="col-md-4 control-label">Relationship Type</label>
                                             
                                                <div class="col-md-8">
                                                    <select id="relationship_type" type="text" class="form-control" name="relationship_type">
                                                        <option value="">Select Relationship Type</option>
                                                        @foreach($relationship_types as $relationship_type)
                                                        <option @if($contact->relationship_type==$relationship_type->master_value) selected @endif>{{ $relationship_type->master_value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('relationship_name') ? ' has-error' : '' }}">
                                                
                                                <label for="relationship_name" class="col-md-4 control-label">Relationship Name</label>
                                              
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="relationship_name" name="relationship_name" placeholder="relationship name" value="{{ $contact->relationship_name }}">
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                                                
                                                <label for="dob" class="col-md-4 control-label">DOB</label>
                                                
                                                <div class="col-md-8">
                                                    <input class="form-control" data-date-format="dd-mm-yyyy" data-link-format="dd-mm-yyyy" id="dob" name="dob" size="16" type="text" value="{{ date('d-m-Y', strtotime($contact->dob )) }}" >
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('marital_status') ? ' has-error' : '' }}">
                                                
                                                <label for="marital_status" class="col-md-4 control-label">Marital Status </label>
                                             
                                                <div class="col-md-8">
                                                    <select class="select2" id="marital_status" name="marital_status" autofocus>
                                                        <option @if($contact->marital_status=='Married') selected @endif>Married</option>
                                                        <option @if($contact->marital_status=='Unmarried') selected @endif>Unmarried</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group{{ $errors->has('phone_no') ? ' has-error' : '' }}">
                                             
                                            <label for="phone_no" class="col-md-4 control-label">Phone No </label>
                                                 
                                              <div class="col-md-8">
                                                  <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Phone No" value="{{ $contact->phone_no }}">
                                              </div>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('occupation') ? ' has-error' : '' }}">
                                               
                                                <label for="occupation" class="col-md-4 control-label">Occupation</label>
                                                
                                                <div class="col-md-8">
                                                    <select type="text" id="occupation" name="occupation" class="select2" 
                                                    >
                                                        <option value="">Select Occupation</option>
                                                        @foreach($occupations  as $occupation)
                                                            <option @if($contact->occupation==$occupation->master_value) selected @endif>{{ $occupation->master_value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('annual_income') ? ' has-error' : '' }}">
                                                  
                                                <label for="annual_income" class="col-md-4 control-label">Annual Income</label>
                                                 
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="annual_income" name="annual_income"  value="{{ $contact->annual_income }}" placeholder="annual_income" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('religion') ? ' has-error' : '' }}">
                                                  
                                                <label for="religion" class="col-md-4 control-label">Religion</label>
                                                  
                                                <div class="col-md-8">
                                                    <select type="text" id="religion" name="religion" class="select2" 
                                                    >
                                                        <option value="">Select Religion</option>
                                                        @foreach($religions  as $religion)
                                                            <option @if($contact->religion==$religion->master_value) selected @endif>{{ $religion->master_value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('caste') ? ' has-error' : '' }}">
                                                
                                                <label for="caste" class="col-md-4 control-label">Caste</label>
                                                  
                                                <div class="col-md-8">
                                                    <select type="text" id="caste" name="caste" class="select2" 
                                                    >
                                                        <option value="">Select Caste</option>
                                                        @foreach($caste  as $cast)
                                                            <option @if($contact->caste==$cast->master_value) selected @endif>{{ $cast->master_value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                                 
                                                <label for="category" class="col-md-4 control-label">Category</label>
                                                  
                                                <div class="col-md-8">
                                                    <select type="text" id="category" name="category" class="select2" 
                                                    >
                                                        <option value="">Select Category</option>
                                                        @foreach($categories  as $category)
                                                            <option @if($contact->category==$category->master_value) selected @endif>{{ $category->master_value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="tab-pane" id="address">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
                                                  
                                                <label for="address1" class="col-md-4 control-label">Address1 </label>
                                               
                                                <div class="col-md-8">
                                                    <textarea type="text" class="form-control" id="address1" name="address1" placeholder="Address1" >{{ $contact->address1 }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
                                                 
                                                <label for="address2" class="col-md-4 control-label">Address2 </label>
                                               
                                                <div class="col-md-8">
                                                    <textarea type="text" class="form-control" id="address2" name="address2" placeholder="Address2">{{ $contact->address2 }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                           <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                        
                                                <label for="city" class="col-md-4 control-label">City </label>
                                                
                                                <div class="col-md-8">
                                                    <select type="text" id="city" name="city" class="select2">
                                                        <option value="">Select City</option>
                                                        @foreach($cities as $city)
                                                            <option @if($contact->city==$city->master_value) selected @endif>{{ $city->master_value }}</option>
                                                        @endforeach
                                                    </select>
                                               </div>
                                           </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                                 
                                                <label for="state" class="col-md-4 control-label">state </label>
                                               
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="state" name="state" placeholder="State" value="{{ $contact->state }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('pin_code') ? ' has-error' : '' }}">
                                                 
                                                <label for="pin_code" class="col-md-4 control-label">Pin Code </label>
                                                  
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Pin Code" value="{{ $contact->pincode }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                                                  
                                                <label for="country" class="col-md-4 control-label">Country</label>
                                               
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="country" name="country"  value="{{ $contact->country }}" placeholder="Country" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('nationality') ? ' has-error' : '' }}">
                                                 
                                                <label for="nationality" class="col-md-4 control-label">Nationality</label>
                                                  
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="nationality" name="nationality"  value="{{ $contact->nationality }}" placeholder="nationality" >
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="tab-pane" id="reference">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('reference_type') ? ' has-error' : '' }}">
                                             
                                                <label for="reference_type" class="col-md-4 control-label">Reference Type </label>
                                                
                                                <div class="col-md-8">
                                                    <select id="reference_type" type="text" class="select2" name="   reference_type" onchange="GetData()">
                                                        <option value="">Select Reference Type</option>
                                                        @foreach($reference_types as $reference_type)
                                                        <option @if($contact->reference_type==$reference_type->master_value) selected @endif>{{ $reference_type->master_value }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('reference_type'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('reference_type') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('user_id') ? ' has-error' : '' }}">
                                               
                                                <label for="user_id" class="col-md-4 control-label">Reference</label>
                                             
                                               <div class="col-md-8">
                                                    <div data-color-format="rgb"  class="colorpicker-default input-group colorpicker-element">
                                                        <select class="form-control" id="user_id" name="user_id">
                                                            <option value="">Select Reference </option> 
                                                        </select>
                                                        <span class="input-group-btn add-on">
                                                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#reference-modal"><i class="fa fa-plus" area-hidden="true"></i>
                                                            </button> 
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('society_id') ? ' has-error' : '' }}">
                                                
                                                <label for="society_id" class="col-md-4 control-label">Society</label>
                                           
                                                <div class="col-md-8">
                                                    <select id="society_id" type="text" class="select2" name="   society_id">
                                                        <option value="">Select Society</option>
                                                        @foreach($societies as $society)
                                                            <option @if($contact->society_id==$society->society_id) selected @endif value="{{ $society->society_id }}">{{ $society->society_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="tab-pane" id="nominee">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('nominee') ? ' has-error' : '' }}">
                                                  
                                                <label for="nominee" class="col-md-4 control-label">Nominee</label>
                                                
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="nominee" name="nominee"  value="{{ $contact->nominee }}" placeholder="nominee" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('nominee_relationship') ? ' has-error' : '' }}">
                                                 
                                                <label for="nominee_relationship" class="col-md-4 control-label">Nominee Relationship</label>
                                                  
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="nominee_relationship" name="nominee_relationship"  value="{{ $contact->nominee_relationship }}" placeholder="nominee_relationship" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('nominee_age') ? ' has-error' : '' }}">
                                           
                                                <label for="nominee_age" class="col-md-4 control-label">Nominee Age</label>
                                               
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="nominee_age" name="nominee_age"  value="{{ $contact->nominee_age }}" placeholder="nominee_age" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('site_dimension') ? ' has-error' : '' }}">
                                                  
                                                <label for="site_dimension" class="col-md-4 control-label">Site Dimension</label>
                                                  
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="site_dimension" name="site_dimension"  value="{{ $contact->site_dimension }}" placeholder="site_dimension" >
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="tab-pane" id="image">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                                <div class="form-group"> 
                                                    <label for="image" class="col-md-4 control-label">Image </label> 
                                                    <div class="col-md-8">
                                                        <input type="file" id="image" name="image" multiple class="dropify" data-default-file="{{ asset('public/images/user') }}/{{ $contact->image }}" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div> 
                                </div> 
                            </div> 
                        </div>     
                        </div>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pull-right">
                                            <a href="{{ url('/contact/create') }}" class="btn btn-danger waves-effect waves-light">Discard</a>
                                             <button type="submit" class="btn btn-default waves-effect waves-light">Update</button>
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
    <div class="modal fade none-border" id="reference-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><strong>New</strong>User</h4>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="username" class="control-label">User Name *</label>
                                <input type="text" class="form-control" id="reference_username" name="reference_username" placeholder="User Name" value="{{ old('username') }}">                           
                            </div>
                            <div class="col-md-6">
                                <label for="name" class="control-label"> Name *</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') }}">                           
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="control-label">Email *</label>
                                <input type="text" class="form-control" id="reference_email" name="reference_email" placeholder="Email" value="{{ old('email') }}">                           
                            </div>
                            <div class="col-md-6">
                                <label for="user_role" class="control-label">User Role* </label>
                                <select class="form-control select2" id="reference_user_role" name="reference_user_role">
                                    <option value="">Select User Role</option>
                                    
                                    <option @if(old('user_role')=='Agent') selected @endif>Agent</option>
                                    <option @if(old('user_role')=='Employee') selected @endif>Employee</option>
                                    <option @if(old('user_role')=='Others') selected @endif>Others</option>
                                </select>       
                            </div>
                            <div class="col-md-6">
                                <label for="mobile_no" class="control-label">mobile_no *</label>
                                <input type="text" class="form-control" id="reference_mobile_no" name="reference_mobile_no" placeholder="Mobile No" value="{{ old('mobile_no') }}">                           
                            </div>
                            <div class="col-md-6">
                                <label for="phone_no" class="control-label">Phone no </label>
                                <input type="text" class="form-control" id="reference_phone_no" name="reference_phone_no" placeholder="phone No" value="{{ old('phone_no') }}">                           
                            </div>
                            <div class="col-md-6">
                                <label for="address1" class="control-label">Address1 *</label>
                                <input type="text" class="form-control" id="reference_address1" name="reference_address1" placeholder="Address1" value="{{ old('address1') }}">                           
                            </div>
                            <div class="col-md-6">
                                <label for="address2" class="control-label">Address2 </label>
                                <input type="text" class="form-control" id="reference_address2" name="reference_address2" placeholder="Address2" value="{{ old('address2') }}">                           
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="control-label">City *</label>
                                <input type="text" class="form-control" id="reference_city" name="reference_city" placeholder="City" value="{{ old('city') }}">                           
                            </div>
                            <div class="col-md-6">
                                <label for="state" class="control-label">state *</label>
                                <input type="text" class="form-control" id="reference_state" name="reference_state" placeholder="State" value="{{ old('state') }}">                           
                            </div>
                            <div class="col-md-6">
                                <label for="country" class="control-label">Country *</label>
                                <input type="text" class="form-control" id="reference_country" name="reference_country" placeholder="Country" value="{{ old('country') }}">                           
                            </div>
                            <div class="col-md-6">
                                <label for="zipcode" class="control-label">Zipcode *</label>
                                <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Zipcode" value="{{ old('zipcode') }}">                           
                            </div>
                            
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal" onclick="SaveUser()">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script type="text/javascript">
        GetData();
        GetUser();
      function GetData(){
   
            $.ajax({
                method:'GET',
                url:"{{ route('contact.get_name')}}",
                data:{
                    reference_type: $('#reference_type').val().trim(),
                    
                },
                success: function(data)
                {
                   
                    var select = document.getElementById('user_id');
                    document.getElementById('user_id').options.length = 1;
                    data.forEach(function(element)
                    {
                        var opt = document.createElement('option');
                        opt.value = element.user_id;
                        opt.id = element.user_id;
                        opt.innerHTML = element.name;
                        select.appendChild(opt);
                    });
                    document.getElementById('{{ $contact->user_id }}').selected = "true";
                }

            });
        }
        function SaveUser() 
        {
            $.ajax({
                method: 'POST',
                url: "{{ route('user.save_user') }}",
                data: {
                        username: $('#reference_username').val(),
                        name: $('#name').val(),
                        email: $('#reference_email').val(),
                        user_role: $('#reference_user_role').val(),
                        mobile_no: $('#reference_mobile_no').val(),
                        phone_no: $('#reference_phone_no').val(),
                        address1: $('#reference_address1').val(),
                        address2: $('#reference_address2').val(),
                        city: $('#reference_city').val(),
                        state: $('#reference_state').val(),
                        country: $('#reference_country').val(),
                        zipcode: $('#zipcode').val(),
                        _token: '{{ Session::token() }}'
                      },
                success: function(data) 
                {
                    $('#reference-modal').modal('hide');
                    var x = document.getElementById("user_id");
                    var option = document.createElement("option");
                    option.text = data.name;
                    option.value = data.user_id;
                    x.add(option);
                    $('#user_id').val(data.user_id);
                },

                error: function(data)
                {
                    $('#reference-modal').modal('hide');
                    var errors = $.parseJSON(data.responseText);
                    var message = '';
                    $.each(errors, function(index, value) {
                        message = message+' '+value;
                    });
                    $("#error_message").html('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>'+message+'</strong></div>');
                }
            });
        }

    </script>
    <script type="text/javascript">
        $('#dob').datetimepicker({
            language:  'fr',
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0
        });
    </script>
@endsection
                
          





