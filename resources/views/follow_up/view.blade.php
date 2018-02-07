@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    
                    <h4 class="page-title">Follow Up</h4>
                    
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">Follow Ups</div>
                        <div class="panel-body">

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-nowrap" >Contact</th>
                                              <td>{{ $follow_up->Contact->contact_name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap" > Date</th>
                                              <td>{{ $follow_up->date  }}</td>
                                          </tr>
                                          <tr>
                                            <th class="text-nowrap" >Time</th>
                                              <td>{{ $follow_up->time }}</td>
                                            </tr>
                                          <tr>
                                            <th class="text-nowrap" >Follow Up Description </th>
                                              <td>{{ $follow_up->follow_up_description }}</td>
                                          </tr>
                                            <tr>
                                            <th class="text-nowrap" >Note</th>
                                            <td>{{ $follow_up->note }}</td>
                                          </tr>
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
