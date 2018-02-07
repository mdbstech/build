@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    
                    <h4 class="page-title">Society</h4>
                   <div class=" pull-right" style="padding-top:5px; padding-right:5px;">
                            <a href="{{ url('/society/create') }}" class="btn btn-default waves-effect waves-light">New</a>
                        </div>
                        <div class=" pull-right" style="padding-top:5px; padding-right:5px;">
                            <a href="{{ url('/society/display') }}" class="btn btn-default waves-effect waves-light">All</a>
                        </div>
                </div>
            </div><br>

            <div class="row">
                <div class="col-md-12">
                 
                    <div class="panel panel-inverse">
                        <div class="panel panel-color panel-custom">
                            <div class="panel-heading">
                                <h3 class="panel-title"> SOCIETY</h3>
                            </div>
                        <div class="panel-body">

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-nowrap" >Society Code</th>
                                              <td>{{ $society->society_code }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap" >Society Name</th>
                                              <td>{{ $society->society_name }}</td>
                                          </tr>
                                          <tr>
                                            <th class="text-nowrap" >Email Address</th>
                                                <td>{{ $society->email }}</td>
                                          </tr>
                                            <tr>
                                            <th class="text-nowrap" >Mobile No</th>
                                            <td>{{ $society->mobile_no }}</td>
                                          </tr>
                                          <tr>
                                            <th class="text-nowrap">Phone No</th>
                                            <td>{{ $society->phone_no }}</td>
                                          </tr>
                                          <tr>
                                            <th class="text-nowrap">Address 1</th>
                                            <td>{{ $society->address1 }}</td>
                                          </tr>
                                          <tr>
                                            <th class="text-nowrap">Address 2</th>
                                            <td>{{ $society->address2 }}</td>
                                          </tr>
                                          <tr>
                                            <th class="text-nowrap">City</th>
                                            <td>{{ $society->city }}</td>
                                          </tr>
                                          <tr>
                                            <th class="text-nowrap">State</th>
                                            <td>{{ $society->state }}</td>
                                          </tr>
                                          
                                           <tr>
                                            <th class="text-nowrap">Country</th>
                                            <td>{{ $society->country }}</td>
                                          </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
