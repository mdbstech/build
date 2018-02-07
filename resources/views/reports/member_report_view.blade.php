@if($report_format == 'EXCEL')
    <?php
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment;Filename=MemberReport.xls");
    ?>
@endif
<!DOCTYPE html>
<html>
    <head>
	    <title>Member report</title>
	    <style>
	           table{
		          border-collapse: collapse;
	            }
		        th,td{
			         border:1px solid black;
			         font-weight: normal;
		        }
	    </style>
    </head>
    <body style="margin-left: 20%;margin-right: 20%">
        <table style="width:100%">
            <tbody>
                <tr>
                  <th colspan="12"><b>{{ $org->org_name }}</b></th>
                </tr>
                <tr>
                  <th colspan="12" align="center"><b>MEMBER REPORT <b></th>
                </tr>
                    
                <tr>
                    <th>Member No</th>
                    <th>Member Name</th>
                    <th>Society</th>
                    <th>Project</th>
                    <th colspan="2">Category</th>
                    <th>Site</th>
                    <th>Assigned Amount</th>
                    <th>Payment Amount</th>
                    <th>Payment Due</th>
                    <th>Refund Amount</th>
                </tr>
                @foreach($contacts as $contact)
                    @foreach($contact->SiteAllotments($contact->contact_id) as $site_allotment)
                        <tr>
                            <td >{{ $contact->membership_no }}</td>
                            <td >{{ $contact->contact_name }}</td>
                            @if($contact->society_id == null)
                                <td></td>
                            @endif
                            @if($contact->society_id != null)
                                <td>{{$contact->Society->society_name}}</td>
                            @endif
                            <td >{{ $site_allotment->Project->project_name }}</td>
                            <td colspan="2">{{ $site_allotment->Category->category_name }}</td>
                            
                            @if($site_allotment->site_id != null)
                                <td align="center">{{ $site_allotment->Site->site_no }}</td>
                            @endif
                            @if($site_allotment->site_id == null)
                                <td></td>
                            @endif
                            <td align="right">{{ $site_allotment->amount }}</td>
                            <td align="right">{{ $site_allotment->PaymentAmount($site_allotment->site_allotment_id) }}</td>
                            <td align="right">{{ $site_allotment->PaymentDueAmount($site_allotment->site_allotment_id) }}</td>
                            @if($site_allotment->PaymentAmount($site_allotment->site_allotment_id) > $site_allotment->amount)
                            <td align="right">{{ $site_allotment->RefundAmount($site_allotment->site_allotment_id) }}</td>
                            @endif
                            @if($site_allotment->PaymentAmount($site_allotment->site_allotment_id) <= $site_allotment->amount)
                            <td align="right">0</td>
                            @endif
                        </tr> 
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </body>
</html>