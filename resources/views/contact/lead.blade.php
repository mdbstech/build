@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="btn-group pull-right">
                        <a href="{{ url('contact/display') }}" class="btn btn-default  waves-effect waves-light">All Contacts <span class="m-l-5"></i></span></a>
                    </div>
                    <div class="btn-group pull-right">
                        <a href="{{ url('contact/edit/'.$contact->contact_id) }}" class="btn btn-success  waves-effect waves-light">Edit <span class="m-l-5"></i></span></a>
                    </div>
                    @if(Auth::User()->user_role=='Super Admin')
                    <div class="btn-group pull-right">
                        <a onclick="Delete('{{ $contact->contact_id }}')"  class="btn btn-danger  waves-effect waves-light">Delete<span class="m-l-5"></i></span></a>
                    </div>
                    @endif
                    <span class=" add-on btn-group pull-right">
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#reference-modal">Promotion</i>
                            </button> 
                    </span>
                    <h4 class="page-title">CONTACTS</h4>
                </div>
            </div>
            <div class="row m-t-15">
                <div class="col-md-4">
                    <div class="panel panel-color panel-custom">
                        <div class="panel-heading">
                            <h3 class="panel-title">CONTACT</h3>
                        </div>
                        <div class="panel-body">
                            <div class="card-box m-b-0 b-0 bg-primary p-lg text-center">
                                <div class="m-b-30">
                                    <img src="{{ asset('public/images/user') }}/{{ $contact->image }}" class="img-circle thumb-x-lg" alt="profile">
                                    <h4 class="text-white m-b-5">
                                        {{ $contact->contact_name }} 
                                    </h4>
                                    <small>Email: {{ $contact->email }} </small><br>
                                    <small>Mobile No: {{ $contact->mobile_no }} </small><br>
                                    <small>City: {{ $contact->city }} </small>
                                </div>
                                
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-color panel-custom">
                        <div class="panel-heading">
                            <h3 class="panel-title">View Contact</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Contact</th>
                                            <th>Contact Details</th>
                                            <th>Contact</th>
                                            <th>Contact Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Contact Code</td>
                                            <td>{{ $contact->contact_code }}</td>
                                            <td>Contact Name</td>
                                            <td>{{ $contact->contact_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Contact Type</td>
                                            <td>{{ $contact->contact_type }}</td>
                                            <td>Gender</td>
                                            <td>{{ $contact->gender }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>Mobile No</td>
                                            <td>{{ $contact->mobile_no }}</td>
                                        </tr>
                                    
                                        <tr>
                                            <td>DOB</td>
                                            <td>{{ date('d-m-Y',strtotime($contact->dob)) }} </td>
                                            <td>Marital Status</td>
                                            <td>{{ $contact->marital_status }}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone No</td>
                                            <td>{{ $contact->phone_no }}</td>
                                            <td>Society</td>
                                            @if($contact->society_id == null)
                                                <td></td>
                                            @endif
                                            @if($contact->society_id != null)
                                           
                                            <td>{{ $contact->Society->society_name }}</td>
                                            @endif
                                            
                                        </tr>
                                        <tr>
                                            <td>Address1</td>
                                            <td>{{ $contact->address1 }}</td>
                                            <td>Address2</td>
                                            <td>{{ $contact->address2 }}</td>
                                        </tr>
                                        <tr>
                                            <td>City</td>
                                            <td>{{ $contact->city }}</td>
                                            <td>State</td>
                                            <td>{{ $contact->state }}</td>
                                        </tr>
                                        <tr>
                                            <td>Pincode</td>
                                            <td>{{ $contact->pincode }}</td>
                                            <td>Country</td>
                                            <td>{{ $contact->country }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nationality</td>
                                            <td>{{ $contact->nationality }}</td>
                                            <td>Religion</td>
                                            <td>{{ $contact->religion }}</td>
                                        </tr>
                                        <tr>
                                            <td>Caste</td>
                                            <td>{{ $contact->caste }}</td>
                                            <td>Category</td>
                                            <td>{{ $contact->category }}</td>
                                        </tr>
                                        <tr>
                                            <td>Occupation</td>
                                            <td>{{ $contact->occupation }}</td>
                                            <td>Annual Income</td>
                                            <td>{{ $contact->annual_income }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nominee</td>
                                            <td>{{ $contact->nominee }}</td>
                                            <td>Nominee Relationship</td>
                                            <td>{{ $contact->nominee_relationship }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nominee Age</td>
                                            <td>{{ $contact->nominee_age }}</td>
                                            <td>Site Dimension</td>
                                            <td>{{ $contact->site_dimension }}</td>

                                        </tr>
                                       </tbody>
                                </table>
                            </div>
                        </div>
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
                            <h4 class="modal-title"><strong> Member</strong></h4>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal" action="{{ url('/contact/save_contact/'.$contact->contact_id) }}" method="POST" autocomplete="off" role="form-horizontal" id="contact-form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="membership_no" class="control-label">Membership Number *</label>
                                        <input type="text" class="form-control" id="reference_membership_no" name="membership_no" placeholder="Membership Number" value="{{$contact->membership_no}}">                           
                                    </div>
                                    <div class="col-md-6">
                                        <label for="contact_type" class="control-label">Contatct Type* </label>
                                        <select class="form-control" id="contact_type" name="contact_type">
                                            <option value="">Select Contatct Type</option>
                                            
                                           <option @if($contact->contact_type=='Lead') selected @endif>Lead</option>
                                           <option @if($contact->contact_type=='Potential') selected @endif>Potential</option>
                                           <option @if($contact->contact_type=='Member') selected @endif>Member</option>
                                           
                                        </select>       
                                    </div>
                                     <div class="col-md-6">
                                        <label for="contact_name" class="control-label"> Name *</label>
                                        <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Name" value="{{ $contact->contact_name }}" readonly="">                           
                                    </div>
                                     <div class="col-md-6">
                                        <label for="gender" class="control-label">Gender* </label>
                                        <input type="text" class="form-control" id="gender" name="gender" placeholder="Name" value="{{ $contact->gender }}" readonly="">       
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="control-label">Email *</label>
                                        <input type="text" class="form-control" id="email" name="_email" placeholder="Email" value="{{ $contact->email }}" readonly="">                           
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="mobile_no" class="control-label">mobile_no *</label>
                                        <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Mobile No" value="{{ $contact->mobile_no }}" readonly="">                           
                                    </div>
                                   
                                </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light save-category">Save</button>
                        </div>
                    </form>
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
                    url: "{{ route('contact.delete') }}",
                    data: {
                            contact_id: contact_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/contact/display") }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/contact/display") }}';
                    }
                });
            }
        }
    </script>
@endsection
