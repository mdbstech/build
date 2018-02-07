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
	           table
                {

		          border-collapse: collapse;
	           }
		          th,td
              {
			     border:1px solid black;
			     font-weight: normal;
		      }
	       </style>
        </head>
        <body >
            <table style="width:100%">
                <tbody>
                    <tr>
                        <th colspan="30" align="left"><b>{{ $org->org_name }}</b></th>
                    </tr>
                    <tr>
                        <th colspan="30" align="left"><b>CONTACT REPORT <b></th>
                    </tr>
                    <tr>
                        <th>Conatct Code</th>
                        <th>Contact Name</th>
                        <th>Contact Type</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Mobile NO</th>
                        <th>Reference Type</th>
                        <th>Reference Name</th>
                        <th>DOB</th>
                        <th>Marital Status</th>
                        <th>Phone NO</th>
                        <th>Society Name</th>
                        <th>Address1</th>
                        <th>Address2</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Pincode</th>
                        <th>Country</th>
                        <th>Occupation</th>
                        <th>Annual Income</th>
                        <th>Nationality</th>
                        <th>Religion</th>
                        <th>Caste</th>
                        <th>Category</th>
                        <th>Nominee</th>
                        <th>Nominee Relationship</th>
                        <th>Nominee Age</th>
                        <th>Site Dimension</th>
                    </tr>
                        @foreach($contacts as $contact) 
                            <tr>
                                <td >{{ $contact->contact_code }}</td>
                                <td >{{ $contact->contact_name }}</td>
                                <td >{{ $contact->contact_type }}</td>
                                <td >{{ $contact->gender }}</td>
                                <td >{{ $contact->email }}</td>
                                <td >{{ $contact->mobile_no }}</td>
                                <td >{{ $contact->reference_type }}</td>
                                @if($contact->user_id == '')
                                <td></td>
                                @else
                                <td >{{ $contact->User->username }}</td>
                                @endif
                               
                                <td >{{ $contact->dob }}</td>
                                <td >{{ $contact->marital_status }}</td>
                                <td >{{ $contact->phone_no }}</td>
                                @if($contact->society_id == null)
                                    <td></td>
                                @endif
                                @if($contact->society_id != null)
                                <td>{{$contact->Society->society_name}}</td>
                                @endif
                                <td >{{ $contact->address1 }}</td>
                                <td >{{ $contact->address2 }}</td>
                                <td >{{ $contact->city }}</td>
                                <td >{{ $contact->state }}</td>
                                <td >{{ $contact->pincode }}</td>
                                <td >{{ $contact->country }}</td>
                                <td >{{ $contact->occupation }}</td>
                                <td >{{ $contact->annual_income }}</td>
                                <td >{{ $contact->nationality }}</td>
                                <td >{{ $contact->religion }}</td>
                                <td >{{ $contact->caste }}</td>
                                <td >{{ $contact->category }}</td>
                                <td >{{ $contact->nominee }}</td>
                                <td >{{ $contact->nominee_relationship }}</td>
                                <td >{{ $contact->nominee_age }}</td>
                                <td >{{ $contact->site_dimension }}</td>
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
            </body>
</html>
@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card-box">
                        <h4 class="m-t-0 header-title"><b>Contact Report</b></h4>    <form method="GET" action="{{ url('/reports/contact_report_view') }}">
                            <div class="form-group{{ $errors->has('society_id') ? ' has-error' : '' }}">
                                <label for="society_id" class="col-md-4 control-label">Society</label>
                                <div  class="form-group">
                                    <select id="society_id" type="text" class="form-control" name="society_id">
                                        <option value="">Select Society</option>
                                        @foreach($societies as $society)
                                            <option @if(old('society_id')==$society->society_id) selected @endif value="{{ $society->society_id }}">{{ $society->society_name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('society_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('society_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city">City</label>
                                <div class="form-group">
                                    <select id="city" type="text" class="form-control" name="city">
                                        <option value="">Select City</option>
                                        @foreach($cities as $city)
                                            <option @if(old('city')==$city->master_value) @endif>{{ $city->master_value }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group {{ $errors->has('occupation') ? ' has-error' : '' }}">
                                <label for="occupation">Occupation</label>
                                <div class="form-group">
                                    <select id="occupation" type="text" class="form-control" name="occupation">
                                        <option value="">Select occupation</option>
                                        @foreach($occupations as $occupation)
                                            <option @if(old('occupation')==$occupation->master_value) @endif>{{ $occupation->master_value }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('occupation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('occupation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('report_format') ? ' has-error' : '' }}">
                                <label for="report_format">Report Format</label>
                                <div class="form-group">
                                    <select class="form-control" id="report_format" name="report_format">
                                        <option>Select Report Format</option>
                                        <option value="EXCEL">EXCEL</option>
                                        <option value="PDF">PDF</option>
                                    </select>
                                    @if ($errors->has('report_format'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('report_format') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>                  
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary btn-rounded waves-effect waves-light" type="submit">
                                    <span class="btn-label"><i class="fa fa-check"></i></span>Submit
                                </button>
                            </div>
                        </form>    
                    </div>
                </div>
            </div>
        </div> 
    </div>
@endsection