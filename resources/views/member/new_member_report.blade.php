@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card-box">
                        <h4 class="m-t-0 header-title"><b>Member Report</b></h4>    <form method="GET" action="{{ url('/reports/member_report_view') }}">
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
                            <div class="form-group {{ $errors->has('contact_id') ? ' has-error' : '' }}">
                                <label for="contact_id">Contact</label>
                                <div class="form-group">
                                    <select id="contact_id" type="text" class="form-control" name="contact_id">
                                        <option value="">Select Member</option>
                                        @foreach($contacts as $contact)
                                            <option @if(old('society_id')==$contact->contact_id) selected @endif value="{{ $contact->contact_id }}">{{ $contact->contact_name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('contact_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('contact_id') }}</strong>
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
public function member_report()
    {
        
        $societies=Society::get();
        $contacts = Contact::get();
       
        return view('reports.member_report', compact('societies','contacts'));
    }