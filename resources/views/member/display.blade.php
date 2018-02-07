@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                 <div class="col-sm-12">
                    <h4 class="page-title">MEMBERS</h4>
                </div>
            </div>
            @if(session()->has('success-message'))
                <div class="alert alert-success alert-dismissable">
                     <button type="submit" class="close" data-dismiss="alert" aria-hidden="true">×
                     </button>
                        {{ session()->get('success-message') }}
                </div>
            @endif
            <div class="row m-t-15">
                <div class="col-md-12">
                    <div class="panel panel-inverse">   
                    </div>
                </div>
                <div class="col-md-12">
                   <div class="panel panel-color panel-custom">
                        <div class="panel-heading">
                            <h3 class="panel-title">MEMBERS</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-group" id="form" action="{{ url('/member/search') }}" method="GET" autocomplete="off" role="search">
                                <div class="input-group">
                                    <input type="text" id="search" name="search" class="form-control" placeholder="Search">
                                     <span class="input-group-btn">
                                        <button type="submit" class="btn waves-effect waves-light btn-default"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th >#</th>
                                            <th class="text-nowrap" >Member Ship No</th>
                                            <th class="text-nowrap" >Member Name</th>
                                            <th class="text-nowrap" >Gender</th>
                                            <th class="text-nowrap" >Mobile No</th>
                                            <th class="text-nowrap" >Email </th>
                                            <th class="text-nowrap">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=$members->perPage() * ($members->currentPage()-1); @endphp
                                        @foreach($members as $member)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td><a href="{{ url('/member/view/'.$member->contact_id) }}">{{ $member->membership_no }}</a></td>
                                                <td>{{ $member->contact_name }}</td>
                                                <td>{{ $member->gender }}</td>
                                                <td>{{ $member->mobile_no }}</td>
                                                <td>{{ $member->email }}</td>

                                                <td class="text-nowrap">
                                                    <a href="{{ url('/member/edit/'.$member->contact_id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>
                                                  </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($members->total() > $members->perPage())
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="pull-right m-r-15">
                                         {{ $members->render() }}
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
        function Delete(member_id)
        {
            if(confirm('Do you want to Continue...?'))
            {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('member.delete') }}",
                    data: {
                            member_id: member_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/member/display") }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/member/display") }}';
                    }
                });
            }
        }
    </script>
@endsection
