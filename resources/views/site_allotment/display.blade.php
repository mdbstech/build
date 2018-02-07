@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            
            @if(session()->has('success-message'))
                <div class="alert alert-success alert-dismissable">
                     <button type="submit" class="close" data-dismiss="alert" aria-hidden="true">×
                     </button>
                        {{ session()->get('success-message') }}
                </div>
            @endif
            <div class="row m-t-10">
               <div class="col-md-12">
                   <div class="panel panel-color panel-custom">
                        <div class="panel-heading">
                            <h3 class="panel-title">ASSIGN AMOUNT</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-group" id="form" action="{{ url('/site_allotment/search') }}" method="GET" autocomplete="off" role="search">
                                <div class="input-group">
                                    <input type="text" id="search" name="search" class="form-control" placeholder="Search">
                                     <span class="input-group-btn">
                                        <button type="submit" class="btn waves-effect waves-light btn-default"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </form>
                             <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Member</th>
                                            <th>Project</th>
                                            <th>Category</th>
                                          <!--   <th>Site No</th> -->
                                            <th>Site dimension</th>
                                            <th>Amount</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=0;
                                        @endphp
                                        @foreach($site_allotments as $site_allotment)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{$site_allotment->Contact->contact_name }}
                                                <td>{{ $site_allotment->Project->project_name }}</td>
                                                <td>{{ $site_allotment->Category->category_name }}</td>
                                                <!-- @if($site_allotment->site_id == null)
                                                <td> </td>
                                                @endif
                                                @if($site_allotment->site_id != null)
                                                <td>{{ $site_allotment->Site->site_no }}</td>
                                                @endif
 -->
                                                <td>{{ $site_allotment->dimension }}</td>
                                                <td>{{ $site_allotment->amount }}</td>
                                         
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($site_allotments->total() > $site_allotments->perPage())
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="pull-right m-r-15">
                                         {{ $site_allotments->render() }}
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
        function Delete(site_allotment_id)
        {
            if(confirm('Do you want to Continue...?'))
            {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('site_allotment.delete') }}",
                    data: {
                            site_allotment_id: site_allotment_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/site_allotment/display") }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/site_allotment/display") }}';
                    }
                });
            }
        }
    </script>
@endsection
