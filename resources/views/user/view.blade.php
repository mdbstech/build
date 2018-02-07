@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                
                    <h4 class="page-title">User</h4>
                   
                </div>
            </div>
            <br>
            @if(session()->has('success-message'))
                <div class="alert alert-success alert-dismissable">
                    <button type="submit" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session()->get('success-message') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-4 col-lg-3">
                    <div class="profile-detail card-box">
                        <div>
                            <img src="{{ asset('public/images/User') }}/{{ $user->avatar }}" class="img-circle" >


                            <hr>
                            <h4 class="text-uppercase font-600">About Me</h4>
                                <div class="text-left">

                                    <p class="text-muted font-13"><strong>Full Name </strong><br>{{ $user->name }}</p>

                                    <p class="text-muted font-13"><strong>Mobile </strong><br>{{ $user->mobile_no }}</p>

                                    <p class="text-muted font-13"><strong>Email :</strong>{{ $user->email }}</p>

                                    <p class="text-muted font-13"><strong>Address </strong><br>{{ $user->address1 }} <br/> {{ $user->city }} <br/> {{ $user->state }}</p>

                                    <p class="text-muted font-13"><strong>Location </strong><br>{{ $user->country }} <br/> {{ $user->zipcode }} </p>
                                </div>
                                <!-- <div class="button-list m-t-20">
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
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                       <div class="panel panel-color panel-custom">
                            <div class="panel-heading">
                                <h3 class="panel-title">CONTACTS</h3>
                            </div>
                            <div class="panel-body">
                                <!-- <form class="form-group" id="form" action="{{ url('/user/user_search') }}" method="GET" autocomplete="off" role="search">
                                  <div class="input-group">
                                      <input type="text" id="search" name="search" class="form-control" placeholder="Search">
                                       <span class="input-group-btn">
                                          <button type="submit" class="btn waves-effect waves-light btn-info"><i class="fa fa-search"></i></button>
                                      </span>
                                    </div>
                                </form>   -->
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th >#</th>
                                            <th class="text-nowrap">Contact</th>
                                            <th class="text-nowrap">Contact Type</th>
                                            <th class="text-nowrap">Gender</th>
                                            <th class="text-nowrap">Mobile No</th>
                                            <th class="text-nowrap">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=$contacts->perPage() * ($contacts->currentPage()-1);
                                        @endphp
                                        @foreach($contacts as $contact)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $contact->contact_name }}</td>
                                                <td>{{ $contact->contact_type }}</td>
                                                <td>{{ $contact->gender }}</td>        
                                                <td>{{ $contact->mobile_no }}</td>
                                                
                                                <td class="text-nowrap">
                                                    <a href="{{ url('/contact/edit/'.$contact->contact_id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>

                                                    <a href="{{ url('/contact/view/'.$contact->contact_id) }}" data-toggle="tooltip" data-original-title="View"> <i class="fa fa-eye text-inverse m-r-10"></i></a>

                                                    @if(Auth::User()->user_role=='Super Admin')
                                                        <a onclick="Delete('{{ $contact->contact_id }}')" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer; cursor:hand"> <i class="fa fa-close text-danger"></i> </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($contacts->total() > $contacts->perPage())
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="pull-right">
                                       {{ $contacts->render() }}
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
