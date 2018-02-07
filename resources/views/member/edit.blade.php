@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    
                    <h4 class="page-title">MEMBER</h4>
                </div>
            </div>
            @if(session()->has('success-message'))
                <div class="alert alert-success alert-dismissable">
                     <button type="submit" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session()->get('success-message') }}
                </div>
            @endif
            <div class="row m-t-15">
                <div class="col-md-12">
                    <div class="panel panel-color panel-custom">
                        <div class="panel-heading">
                            <h3 class="panel-title">EDIT MEMBER</h3>
                        </div>
                        <form class="form-horizontal" action="{{ url('/member/update/'.$contact->contact_id) }}" method="POST" autocomplete="off" role="form-horizontal" id="member-form" enctype="multipart/form-data">
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
                                                    <div class="form-group{{ $errors->has('membership_no') ? ' has-error' : '' }}">
                                                        
                                                        <label for="membership_no" class="col-md-4 control-label">Membership No </label>
                                                       
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" id="membership_no" name="membership_no" placeholder="Membership No" value="{{ $contact->membership_no }}">
                                                            @if ($errors->has('membership_no'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('membership_no') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group{{ $errors->has('contact_name') ? ' has-error' : '' }}">
                                                         
                                                        <label for="contact_name" class="col-md-4 control-label">Member Name *</label>
                                                          
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Contact Name" value="{{ $contact->contact_name }}">
                                                            @if ($errors->has('contact_name'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('contact_name') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group{{ $errors->has('contact_type') ? ' has-error' : '' }}">
                                                        
                                                        <label for="contact_type" class="col-md-4 control-label">Member Type*</label>
                                                        
                                                        <div class="col-md-8">
                                                            <select class="form-control" id="contact_type" name="contact_type" autofocus>
                                                                <option value="">Select Contact Type </option>
                                                                <option @if($contact->contact_type=='Lead') selected @endif>Lead</option>
                                                                <option @if($contact->contact_type=='Potential') selected @endif>Potential</option>
                                                                <option @if($contact->contact_type=='Member') selected @endif>Member</option>
                                                            </select>
                                                            @if ($errors->has('contact_type'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('contact_type') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                                        
                                                        <label for="gender" class="col-md-4 control-label">Gender*</label>
                                                     
                                                        <div class="col-md-8">
                                                            <select class="form-control" id="gender" name="gender" autofocus>
                                                                <option value="">Select Gender </option>
                                                                <option @if($contact->gender=='Male') selected @endif>Male</option>
                                                                <option @if($contact->gender=='Female') selected @endif>Female</option>
                                                            </select>
                                                            @if ($errors->has('gender'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('gender') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                          
                                                        <label for="email" class="col-md-4 control-label">Email *</label>
                                                          
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ $contact->email }}">
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
                                                </div> -->
                                                <!-- <div class="col-md-6">
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
                                                            @if ($errors->has('dob'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('dob') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group{{ $errors->has('marital_status') ? ' has-error' : '' }}">
                                                        
                                                        <label for="marital_status" class="col-md-4 control-label">Marital Status </label>
                                                      
                                                        <div class="col-md-8">
                                                            <select class="form-control" id="marital_status" name="marital_status" autofocus>
                                                                <option value="">Select Marital Status </option>
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
                                                    <div class="form-group{{ $errors->has('religion') ? ' has-error' : '' }}">
                                                         
                                                        <label for="religion" class="col-md-4 control-label">Religion</label>
                                                          
                                                        <div class="col-md-8">
                                                            <select type="text" id="religion" name="religion" class="form-control" 
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
                                                             <select type="text" id="caste" name="caste" class="form-control" 
                                                    >
                                                        <option value="">Select Caste</option>
                                                        @foreach($caste  as $cast)
                                                            <option @if($contact->cast==$cast->master_value) selected @endif>{{ $cast->master_value }}</option>
                                                        @endforeach
                                                    </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                                          
                                                        <label for="category" class="col-md-4 control-label">Category</label>
                                                          
                                                        <div class="col-md-8">
                                                            <select type="text" id="category" name="category" class="form-control" 
                                                    >
                                                        <option value="">Select Category</option>
                                                        @foreach($categories  as $category)
                                                            <option @if($contact->category==$category->master_value) selected @endif>{{ $category->master_value }}</option>
                                                        @endforeach
                                                    </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group{{ $errors->has('occupation') ? ' has-error' : '' }}">
                                                         
                                                            <label for="occupation" class="col-md-4 control-label">Occupation</label>
                                                          
                                                        <div class="col-md-8">
                                                            <select type="text" id="occupation" name="occupation" class="form-control" 
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
                                                            <input type="text" class="form-control" id="annual_income" name="annual_income"  value="{{ $contact->annual_income }}" placeholder="Annual Income" >
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
                                                          <select type="text" id="city" name="city" class="form-control">
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
                                                            <input type="text" class="form-control" id="nationality" name="nationality"  value="{{ $contact->nationality }}" placeholder="Nationality" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            @if($contact->user_id != null)
                                            <div class="tab-pane" id="reference">
                                                <div class="col-md-6">
                                                    <div class="form-group{{ $errors->has('reference_type') ? ' has-error' : '' }}">
                                                       
                                                        <label for="reference_type" class="col-md-4 control-label">Reference Type</label>
                                                      
                                                        <div class="col-md-8">
                                                            <select id="reference_type" type="text" class="form-control" name="   reference_type" onchange="GetData()">
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
                                                    <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">

                                                        <label for="user_id" class="col-md-4 control-label">Reference</label>

                                                        <div class="col-md-8">
                                                          <select id="user_id" name="user_id" class="form-control">
                                                              <option value="{{ $contact->user_id }} ">{{ $contact->User->username }} </option>
                                                         </select>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group{{ $errors->has('society_id') ? ' has-error' : '' }}">
                                                        
                                                        <label for="society_id" class="col-md-4 control-label">Society</label>
                                                        
                                                        <div class="col-md-8">
                                                            <select id="society_id" type="text" class="form-control" name="   society_id">
                                                                <option value="">Select Society</option>
                                                                @foreach($societies as $society)
                                                                    <option @if($contact->society_id==$society->society_id) selected @endif value="{{ $society->society_id }}">{{ $society->society_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('society_id'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('society_id') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            @endif
                                            @if($contact->user_id == null)
                                            <div class="tab-pane" id="reference">
                                                <div class="col-md-6">
                                                    <div class="form-group{{ $errors->has('reference_type') ? ' has-error' : '' }}">
                                                       
                                                        <label for="reference_type" class="col-md-4 control-label">Reference Type</label>
                                                      
                                                        <div class="col-md-8">
                                                            <select id="reference_type" type="text" class="form-control" name="   reference_type" onchange="GetData()">
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
                                                @if($contact->user_id == null)
                                                <div class="col-md-6">
                                                    <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">

                                                        <label for="user_id" class="col-md-4 control-label">Reference</label>

                                                        <div class="col-md-8">
                                                          <select id="user_id" name="user_id" class="form-control">
                                                            <option value="{{ $contact->user_id }} ">{{ $contact->username }} </option>
                                                         </select>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @if($contact->user_id != null)
                                                     <div class="col-md-6">
                                                    <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">

                                                        <label for="user_id" class="col-md-4 control-label">Reference</label>

                                                        <div class="col-md-8">
                                                          <select id="user_id" name="user_id" class="form-control">
                                                            <option value="{{ $contact->user_id }} ">{{ $contact->User->username }} </option>
                                                         </select>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                <div class="col-md-6">
                                                    <div class="form-group{{ $errors->has('society_id') ? ' has-error' : '' }}">
                                                        
                                                        <label for="society_id" class="col-md-4 control-label">Society</label>
                                                        
                                                        <div class="col-md-8">
                                                            <select id="society_id" type="text" class="form-control" name="   society_id">
                                                                <option value="">Select Society</option>
                                                                @foreach($societies as $society)
                                                                    <option @if($contact->society_id==$society->society_id) selected @endif value="{{ $society->society_id }}">{{ $society->society_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('society_id'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('society_id') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="tab-pane" id="nominee">
                                                <div class="col-md-6">
                                                    <div class="form-group{{ $errors->has('nominee') ? ' has-error' : '' }}">
                                                         
                                                            <label for="nominee" class="col-md-4 control-label">Nominee</label>
                                                          
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" id="nominee" name="nominee"  value="{{ $contact->nominee }}" placeholder="Nominee" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group{{ $errors->has('nominee_relationship') ? ' has-error' : '' }}">
                                                          
                                                            <label for="nominee_relationship" class="col-md-4 control-label">Nominee Relationship</label>
                                                          
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" id="nominee_relationship" name="nominee_relationship"  value="{{ $contact->nominee_relationship }}" placeholder="Nominee Relationship" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group{{ $errors->has('nominee_age') ? ' has-error' : '' }}">
                                                         
                                                            <label for="nominee_age" class="col-md-4 control-label">Nominee Age</label>
                                                         
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" id="nominee_age" name="nominee_age"  value="{{ $contact->nominee_age }}" placeholder="Nominee Age" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group{{ $errors->has('site_dimension') ? ' has-error' : '' }}">
                                                          
                                                            <label for="site_dimension" class="col-md-4 control-label">Site Dimension</label>
                                                         
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" id="site_dimension" name="site_dimension"  value="{{ $contact->site_dimension }}" placeholder="Site Dimension" >
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
                                            <button type="submit" class="btn btn-default waves-effect waves-light">Update</button>
                                            <a href="{{ url('/contact/create') }}" class="btn btn-danger waves-effect waves-light">Discard</a>
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
@section('js')
    <script type="text/javascript">
        function Delete(contact_id)
        {
            if(confirm('Do you want to Continue...?'))
            {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('member.delete') }}",
                    data: {
                            contact_id: contact_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/member/create") }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/member/create") }}';
                    }
                });
            }
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
