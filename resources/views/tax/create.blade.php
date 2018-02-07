@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    
                    <h4 class="page-title">Tax</h4>
                    <ol class="breadcrumb">
                        <li>
                            <a>Builders &amp; Developers</a>
                        </li>
                        <li>
                            <a>Configuration</a>
                        </li>
                        <li class="active">
                            New Tax

                       </li>
                    </ol>
                </div>
            </div>
            @if(session()->has('success-message'))
               <div class="alert alert-success alert-dismissable">
                    <button type="submit" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       {{ session()->get('success-message') }}
               </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-inverse">
                       <div class="panel-heading">New Tax</div>
                        <form class="form-horizontal" action="{{ url('/tax/store')}}" method="POST" autocomplete="off" role="form-horizontal"
                         id="tax-form">
                         <div class="panel-body">
                                {{ csrf_field() }}
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('tax_name') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="tax_name" class="control-label">Tax Name *</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="tax_name" name="tax_name" placeholder="tax name" value="{{ old('tax_name') }}">
                                            @if ($errors->has('tax_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('tax_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                               </div>
                             <div class="col-md-6">
                                <div class="form-group{{ $errors->has('tax_rate') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="tax_rate" class="control-label">Tax Rate *</label>
                                    </div>
                                    <div class="col-md-12">
                                       <input type="text" class="form-control" id="tax_rate" name="tax_rate" placeholder="tax rate" value="{{ old('tax_rate') }}">
                                        @if ($errors->has('tax_rate'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tax_rate') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                             </div>

                             <div class="col-md-6">
                                <div class="form-group{{ $errors->has('sgst_name') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                      <label for="sgst_name" class="control-label">SGST Name* </label>
                                       </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="sgst_name" name="sgst_name" placeholder="sgst name" value="{{ old('sgst_name') }}">
                                        @if ($errors->has('sgst_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('sgst_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                           </div>


                             <div class="col-md-6">
                                <div class="form-group{{ $errors->has('sgst_rate') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                      <label for="sgst_rate" class="control-label">SGST Rate* </label>
                                       </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="sgst_rate" name="sgst_rate" placeholder="sgst rate" value="{{ old('sgst_rate') }}">
                                        @if ($errors->has('sgst_rate'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('sgst_rate') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                             <div class="col-md-6">
                                <div class="form-group{{ $errors->has('cgst_name') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                      <label for="cgst_name" class="control-label">CGST Name* </label>
                                       </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="cgst_name" name="cgst_name" placeholder="cgst name" value="{{ old('cgst_name') }}">
                                        @if ($errors->has('cgst_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('cgst_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                             <div class="col-md-6">
                                <div class="form-group{{ $errors->has('cgst_rate') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                      <label for="cgst_rate" class="control-label">CGST Rate* </label>
                                       </div>
                                      <div class="col-md-12">
                                        <input type="text" class="form-control" id="cgst_rate" name="cgst_rate" placeholder="cgst rate" value="{{ old('cgst_rate') }}">
                                        @if ($errors->has('cgst_rate'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('cgst_rate') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                             </div>

                             <div class="col-md-6">
                                <div class="form-group{{ $errors->has('igst_name') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                      <label for="igst_name" class="control-label">IGST Name* </label>
                                       </div>
                                      <div class="col-md-12">
                                        <input type="text" class="form-control" id="igst_name" name="igst_name" placeholder="igst name" value="{{ old('igst_name') }}">
                                        @if ($errors->has('igst_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('igst_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group{{ $errors->has('igst_rate') ? ' has-error' : '' }}">
                                  <div class="col-md-12">
                                    <label for="igst_rate" class="control-label">IGST Rate* </label>
                                     </div>
                                    <div class="col-md-12">
                                      <input type="text" class="form-control" id="igst_rate" name="igst_rate" placeholder="igst rate" value="{{ old('igst_rate') }}">
                                      @if ($errors->has('igst_rate'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('igst_rate') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>
                         </div>

                          </div>
                         <div class="panel-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                            <a href="{{ url('/tax/create') }}" class="btn btn-danger waves-effect waves-light">Discard</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">Taxes</div>
                        <div class="panel-body">
                            <form class="form-group" id="form" action="{{ url('/tax/search') }}" method="GET" autocomplete="off" role="search">
                                <div class="input-group">
                                    <input type="text" id="search" name="search" class="form-control" placeholder="Search">
                                     <span class="input-group-btn">
                                        <button type="submit" class="btn waves-effect waves-light btn-info"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th >#</th>
                                            <th class="text-nowrap">Tax Name</th>
                                            <th class="text-nowrap">Tax Rate</th>
                                            <th class="text-nowrap">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=$taxes->perPage() * ($taxes->currentPage()-1); @endphp
                                        @foreach($taxes as $tax)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $tax->tax_name }}</td>
                                                <td>{{ $tax->tax_rate }}</td>
                                                <td class="text-nowrap">
                                                    <a href="{{ url('/tax/edit/'.$tax->tax_id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>
                                                      @if(Auth::User()->user_role=='Super Admin')
                                                        <a onclick="Delete('{{ $tax->tax_id }}')" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer; cursor:hand"> <i class="fa fa-close text-danger"></i> </a>
                                                        @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @if($taxes->total() > $taxes->perPage())
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="pull-right">
                                         {{ $taxes->render() }}
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
        function Delete(tax_id)
        {
            if(confirm('Do you want to Continue...?'))
            {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('tax.delete') }}",
                    data: {
                            tax_id: tax_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/tax/create") }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/tax/create") }}';
                    }
                });
            }
        }
    </script>
@endsection
