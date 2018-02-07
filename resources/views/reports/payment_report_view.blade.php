@if($report_format == 'EXCEL')
  <?php
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment;Filename=PaymentReport.xls");
  ?>
@endif
<!DOCTYPE html>
<html>
    <head>
	   <title>Payment report</title>
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
                    <th colspan="10"><b>{{ $org->org_name }}</b></th>
                </tr>
                <tr>
                    <td style="font-weight: bold;" colspan="2" align="center">Payment Report</td>
                    <td style="font-weight: bold;" colspan="4" align="center">From {{ $from_date }}</td>
                    <td style="font-weight: bold;" colspan="4" align="center">To {{ $to_date }}</td>
                </tr>
                <tr>
                    <td colspan="10" align="center">PAYMENT REPORT</td>
                </tr>
                <tr>
                    <th>Receipt No</th>
                    <th>Receipt Date</th>
                    <th>Member No</th>
                    <th>Member Name</th>
                    <th>Project</th>
                    <th colspan="2">Category</th>
                    <th>Site</th>
                    <th>Payment Mode</th>
                    <th>Amount</th>
                </tr>
                @php $total = 0; @endphp
                @foreach($payments as $payment)
                    <tr>
                        <td align="center">{{ $payment->receipt_no }}</td>
                        <td align="center">{{ date('d-m-Y',strtotime($payment->receipt_date)) }}</td>
                        <td>{{ $payment->Contact->membership_no }}</td>
                        <td>{{ $payment->Contact->contact_name }}</td>
                        <td>{{ $payment->SiteAllotment->Project->project_name }}</td>
                        <td colspan="2">{{ $payment->SiteAllotment->Category->category_name }}</td>
                        @if($payment->SiteAllotment->site_id == null)
                            <td></td>
                        @endif
                        @if($payment->SiteAllotment->site_id !=null)
                            <td align="center">{{ $payment->SiteAllotment->Site->site_no }}</td>
                        @endif
                        <td>{{ $payment->payment_mode }}</td>
                        <td align="right">{{ $payment->amount }}</td>
                    </tr> 
                    @php $total += $payment->amount; @endphp
                @endforeach
                <tr>
                    <td colspan="8"></td>
                    <td><b>Total</b></td>
                    <td style="text-align: right"><b>{{ $total }}</b></td>
                </tr>
            </tbody>
        </table>
    </body>
</html>