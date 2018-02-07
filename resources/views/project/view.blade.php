@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class=" pull-right" style="padding-top:5px; padding-right:5px;">
                    <a href="{{ url('/project/create') }}" class="btn btn-default waves-effect waves-light">New Project</a>
                </div>
                <div class=" pull-right" style="padding-top:5px; padding-right:5px;">
                    <a href="{{ url('/project/edit/'.$project->project_id) }}" class="btn btn-default waves-effect waves-light">Edit Project</a>
                </div>
            </div>
           
            <div class="row m-t-15">
               <div class="col-lg-3 col-md-3"> 
                    <div class="panel panel-color panel-custom">
                        <div class="panel-heading">
                            <h3 class="panel-title">PROJECT LIST</h3>
                        </div>
                        <div class="panel-body">
                            @foreach($projects as $pro)
                                
                                    <div class="mail-contnet">
                                        <h5>
                                            <a href="{{ url('/project/view/'.$pro->project_id) }}">
                                            <span>{{ $pro->project_name }}</span>
                                            </a>
                                        </h5> 
                                        <span class="mail-desc">
                                            Project Code:-{{ $pro->project_code }} 
                                        </span> <br>
                                        <span class="mail-desc">
                                            No Of Sites:-{{ $pro->no_of_sites }}
                                        </span>
                                    </div>
                                
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-3"> 
                   <div class="panel panel-color panel-custom">
                        <div class="panel-heading">
                            <h3 class="panel-title">NO OF SITES</h3>
                        </div>
                        <div class="panel-body">
                            @foreach($sites as $site)
                                <button class="btn" style="color: {{ $site->color  }}">{{ $site->site_no }}</button>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-3"> 
                    <div class="panel panel-color panel-custom">
                        <div class="panel-heading">
                            <h3 class="panel-title">PROJECT MAP</h3>
                        </div>
                        <div class="panel-body">
                            @php
                                $data = explode(',',$project->project_image);
                            @endphp
                            @for($i=0; $i<sizeOf($data)-1; $i++)
                                <div class="col-sm-6 col-lg-3 col-md-4 graphicdesign illustrator photography">
                                    <div class="gal-detail thumb">
                                        <a href="{{ asset('public/images/Project') }}/{{ $data[$i] }}" class="image-popup" title="Screenshot-2">
                                            <img height="100px" src="{{ asset('public/images/Project') }}/{{ $data[$i] }}" class="thumb-img" alt="work-thumbnail">
                                        </a>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
