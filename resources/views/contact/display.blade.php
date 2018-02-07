@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="btn-group pull-right">
                        <a href="{{ url('contact/create') }}" class="btn btn-danger  waves-effect waves-light">New Contact <span class="m-l-5"></span></a>
                    </div>
                    <div class="btn-group pull-right">
                        <a href="{{ url('/contact/upload') }}" class="btn btn-default  waves-effect waves-light">Upload Excel <span class="m-l-5"></span></a>
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
            <div class="row m-t-15">
               
                <div class="panel panel-color panel-custom">
                    <div class="panel-heading">
                        <h3 class="panel-title">CONTACTS</h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-group" id="form" action="{{ url('/contact/search') }}" method="GET" autocomplete="off" role="search">
                            <div class="col-lg-6"> 
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <select id="field" name="field" class="form-control"> 
                                            <option @if(app('request')->input('field')=='contact_type,f,Contact') selected @endif value="contact_type,f,Contact">Contact Type</option>
                                            <option @if(app('request')->input('field')=='contact_name,f,Contact') selected @endif value="contact_name,f,Contact">Name</option>
                                            <option @if(app('request')->input('field')=='gender,f,Contact') selected @endif value="gender,f,Contact">Gender</option>
                                            <option @if(app('request')->input('field')=='email,f,Contact') selected @endif value="email,f,Contact">Email</option>
                                            <option @if(app('request')->input('field')=='mobile_no,f,Contact') selected @endif value="mobile_no,f,Contact">Mobile No</option>
                                        </select>

                                    </span>
                                </div>          
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input id="search" name="search" class="form-control" placeholder="Search" type="text">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn waves-effect waves-light btn-default"><i class="fa fa-search"></i></button>
                                    </span>   
                                </div>  
                            </div>
                        </form>
                        <br><br>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th >#</th>
                                            <th class="text-nowrap">Contact Code</th>
                                            <th class="text-nowrap">Contact Name</th>
                                            <th class="text-nowrap">Contact Type</th>
                                            <th class="text-nowrap">Gender</th>
                                            <th class="text-nowrap">Email Address</th>
                                            <th class="text-nowrap">Mobile No</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=$contacts->perPage() * ($contacts->currentPage()-1); @endphp
                                        @foreach($contacts as $contact)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                @if($contact->contact_type == 'Member')
                                                    <td class=" text-uppercase"><a href="{{ url('/contact/view/'.$contact->contact_id) }}">{{ $contact->contact_code }}</a></td>
                                                @else
                                                
                                                    <td class=" text-uppercase"><a href="{{ url('/contact/lead/'.$contact->contact_id) }}">{{ $contact->contact_code }}</a></td>
                                                @endif
                                                <td>{{ $contact->contact_name }}</td>
                                                <td>{{ $contact->contact_type }}</td>
                                                <td>{{ $contact->gender }}</td>
                                                <td>{{ $contact->email }}</td>
                                               <td>{{ $contact->mobile_no }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @if($contacts->total() > $contacts->perPage())
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="pull-right m-r-15">
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
