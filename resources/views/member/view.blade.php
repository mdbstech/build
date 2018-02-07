@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class=" pull-right" style="padding-top:5px; padding-right:5px;">
                    <a href="{{ url('/contact/create') }}" class="btn btn-default waves-effect waves-light">New Contact</a>
                </div>
                <div class=" pull-right" style="padding-top:5px; padding-right:5px;">
                    <a href="{{ url('/member/display') }}" class="btn btn-default waves-effect waves-light">Members</a>
                </div>
                <div class=" pull-right" style="padding-top:5px; padding-right:5px;">
                    <a href="{{ url('/member/edit/'.$contact->contact_id) }}" class="btn btn-default waves-effect waves-light">Edit</a>
                </div>
                <div class=" pull-right" style="padding-top:5px; padding-right:5px;">
                    <a href="{{ url('/site_allotment/create/'.$contact->contact_id) }}" class="btn btn-default waves-effect waves-light">Assign Amount</a>
                </div>
           
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"> 
                    <div class="panel panel-color panel-custom">
                        <div class="panel-heading">
                            <h3 class="panel-title">MEMBER DETAILS</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Information</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Member Num</td>
                                            <td>{{ $contact->membership_no }}</td>
                                        </tr>
                                        <tr>
                                            <td>Name</td>
                                            <td>{{ $contact->contact_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Mobile Num</td>
                                            <td>{{ $contact->mobile_no }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{ $contact->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Address1</td>
                                            <td>{{ $contact->address1 }}</td>
                                        </tr>
                                        <tr>
                                            <td>Address2</td>
                                            <td>{{ $contact->address2 }}</td>
                                        </tr>
                                        <tr>
                                            <td>City</td>
                                            <td>{{ $contact->city }}</td>
                                        </tr>
                                        <tr>
                                            <td>State</td>
                                            <td>{{ $contact->state }}</td>
                                        </tr>
                                        <tr>
                                            <td>Pin code</td>
                                            <td>{{ $contact->pincode }}</td>
                                        </tr>
                                        <tr>
                                            <td>Country</td>
                                            <td>{{ $contact->country }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-8"> 
                    <div class="panel panel-color panel-custom">
                        <div class="panel-heading">
                            <h3 class="panel-title">SITE DETAILS</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Project</th>
                                            <th>Category</th>
                                            <th>Site No</th>
                                            <th>Site dimension</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=0;
                                        @endphp
                                        @foreach($site_allotments as $site_allotment)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $site_allotment->Project->project_name }}</td>
                                                <td>{{ $site_allotment->Category->category_name }}</td>
                                                @if($site_allotment->site_id == null)
                                                <td> </td>
                                                @endif
                                                @if($site_allotment->site_id != null)
                                                <td>{{ $site_allotment->Site->site_no }}</td>
                                                @endif

                                                <td>{{ $site_allotment->dimension }}</td>
                                                <td>{{ $site_allotment->amount }}</td>
                                                <td>
                                                    <a href="{{ url('/site_allotment/edit/'.$site_allotment->site_allotment_id) }}" data-toggle="tooltip" data-original-title="Edit Assign amount"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>
                                                    
                                                    @if($site_allotment->PaymentAmount($site_allotment->site_allotment_id) < $site_allotment->amount)
                                                        <a href="{{ url('/payment/create/'.$site_allotment->site_allotment_id) }}" data-toggle="tooltip" data-original-title="Payment"> <i class="fa fa-money text-inverse m-r-10"></i></a>
                                                    @endif  
                                                    
                                                    @if($site_allotment->PaymentAmount($site_allotment->site_allotment_id) - $site_allotment->RefundAmount($site_allotment->site_allotment_id) > $site_allotment->amount)  
                                                        <a href="{{ url('/refund/create/'.$site_allotment->site_allotment_id) }}" data-toggle="tooltip" data-original-title="Refund"><i class="fa fa-retweet text-inverse m-r-10"></i></a>
                                                    @endif
                                                    
                                                    @if($site_allotment->PaymentAmount($site_allotment->site_allotment_id) >= $site_allotment->amount)
                                                        <a href="{{ url('/site_allotment/allotment/'.$site_allotment->site_allotment_id) }}" data-toggle="tooltip" data-original-title="Site Allotment"><i class="fa fa-home text-inverse m-r-10"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div><!--end of .table-responsive-->
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-8"> 
                    <div class="panel panel-color panel-custom">
                        <div class="panel-heading">
                            <h3 class="panel-title">PAYMENT DETAILS</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Project</th>
                                            <th>Site No</th>
                                            <th>Receipt No</th>
                                            <th>Receipt Date</th>
                                            <th>Payment Mode</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($payments as $payment)
                                            <tr>
                                                <td>{{ $payment->SiteAllotment->Project->project_name }}</td>
                                                @if($payment->SiteAllotment->site_id != null)
                                                    <td>{{ $payment->SiteAllotment->Site->site_no }}</td>
                                                @endif
                                                @if($payment->SiteAllotment->site_id == null)
                                                    <td></td>
                                                @endif
                                                <td>{{ $payment->receipt_no }}</td>
                                                <td>{{ date('d-m-Y', strtotime($payment->receipt_date)) }}</td>
                                                <td>{{ $payment->payment_mode }}</td>
                                                <td>{{ $payment->amount }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-offset-4 col-md-8"> 
                    <div class="panel panel-color panel-custom">
                        <div class="panel-heading">
                            <h3 class="panel-title">REFUND DETAILS</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Project</th>
                                            <th>Site No</th>
                                            <th>Voucher No</th>
                                            <th>Voucher Date</th>
                                            <th>Payment Mode</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($refunds as $refund)
                                            <tr>
                                                <td>{{ $refund->SiteAllotment->Project->project_name }}</td>
                                                @if($refund->SiteAllotment->site_id != null)
                                                    <td>{{ $refund->SiteAllotment->Site->site_no }}</td>
                                                @endif
                                                @if($refund->SiteAllotment->site_id == null)
                                                    <td></td>
                                                @endif
                                                <td>{{ $refund->voucher_no }}</td>
                                                <td>{{ date('d-m-Y', strtotime($refund->voucher_date)) }}</td>
                                                <td>{{ $refund->payment_mode }}</td>
                                                <td>{{ $refund->amount }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
                        window.location='{{ url("/member/display/".$contact->contact_id) }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/member/display/".$contact->contact_id) }}';
                    }
                });
            }
        }
    </script>
@endsection