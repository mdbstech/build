@if($report_format == 'EXCEL')
  <?php
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment;Filename=RefundReport.xls");
  ?>
@endif
<!DOCTYPE html>
<html>
<head>
	<title>Refund report</title>

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
      <td style="font-weight: bold;" colspan="2" align="center">Refund Report</td>
      <td style="font-weight: bold;" colspan="4" align="center">From {{ $from_date }}</td>
      <td style="font-weight: bold;" colspan="4" align="center">To {{ $to_date }}</td>
    </tr>
    <tr>
      <th colspan="10" align="center">REFUND REPORT</th>
    </tr>
    <tr>
      <th>Voucher No</th>
      <th>Voucher Date</th>
      <th>Member No</th>
      <th>Member Name</th>
      <th>Project</th>
      <th colspan="2">Category</th>
      <th>Site</th>
      <th>Payment Mode</th>
      <th>Amount</th>
    </tr>
    @php $total = 0; @endphp
    @foreach($refunds as $refund)
    <tr>
      <td align="center">{{ $refund->voucher_no }}</td>
      <td align="center">{{ date('d-m-Y',strtotime($refund->voucher_date)) }}</td>
      <td align="center">{{ $refund->Contact->membership_no}}</td>
      <td align="center">{{ $refund->Contact->contact_name }}</td>
      <td>{{ $refund->SiteAllotment->Project->project_name }}</td>
      <td colspan="2">{{ $refund->SiteAllotment->Category->category_name }}</td>
      @if($refund->SiteAllotment->Site == '')
      <td></td>
      @else
      <td align="center">{{ $refund->SiteAllotment->Site->site_no }}</td>
      @endif
      <td>{{ $refund->payment_mode }}</td>
      <td style="text-align: right">{{ $refund->amount }}</td>
    </tr>
    @php $total += $refund->amount; @endphp 
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