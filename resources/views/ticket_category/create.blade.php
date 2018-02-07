@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Ticket Category</h4>
                </div>
            </div><br>
            @if(session()->has('success-message'))
               <div class="alert alert-success alert-dismissable">
                    <button type="submit" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       {{ session()->get('success-message') }}
               </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    @foreach($errors->all() as $error)
                       <li> <strong>{{ $error }}</strong></li>
                     @endforeach
                </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-color panel-custom">
                        <div class="panel-heading">
                            <h3 class="panel-title">NEW TICKET CATEGORY</h3>
                        </div>
                        <form class="form-horizontal" action="{{ url('/ticket_category/store')}}" method="POST" autocomplete="off" role="form-horizontal"
                         id="ticket_category-form">
                            <div class="panel-body">
                                {{ csrf_field() }}
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('ticket_category_code') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="ticket_category_code" class="control-label">Ticket Category Code *</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="ticket_category_code" name="ticket_category_code" placeholder="Ticket Category Code" value="{{ $ticket_category_code }}">   
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('category_name') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="category_name" class="control-label">Category Name *</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Category Name" value="{{ old('category_name') }}">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('color') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="color" class="control-label">Color*</label>
                                        </div>
                                        <div class="col-md-12">
                                             <input type="text" class="colorpicker-rgba form-control"  id="color" name="color"  data-color-format="rgba" placeholder="Color"> 
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="description" class="control-label"> Description </label>
                                        </div>
                                        <div class="col-md-12">
                                            <textarea type="text" class="form-control" id=" description" name="description" placeholder="Description">{{ old('description') }}</textarea>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pull-right">
                                             <a href="{{ url('/ticket_category/create') }}" class="btn btn-danger waves-effect waves-light">Discard</a>
                                            <button type="submit" class="btn btn-default waves-effect waves-light">Save</button>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                   <div class="panel panel-color panel-custom">
                        <div class="panel-heading">
                            <h3 class="panel-title">TICKET CATEGORIES</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-group" id="form" action="{{ url('/ticket_category/search') }}" method="GET" autocomplete="off" role="search">
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
                                            <th class="text-nowrap">Code </th>
                                            <th class="text-nowrap">Category Name</th>
                                            <th class="text-nowrap">Color</th>
                                            <th class="text-nowrap">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=$ticket_categories->perPage() * ($ticket_categories->currentPage()-1); 
                                        @endphp
                                        @foreach($ticket_categories as $ticket_category)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $ticket_category->ticket_category_code }}</td>
                                                <td>{{ $ticket_category->category_name }}</td>
                                                <td>{{ $ticket_category->color }}</td>
                                                <td class="text-nowrap">
                                                    <a href="{{ url('/ticket_category/edit/'.$ticket_category->category_id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>
                                                    @if(Auth::User()->user_role=='Super Admin')
                                                        <a onclick="Delete('{{ $ticket_category->category_id }}')" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer; cursor:hand"> <i class="fa fa-close text-danger"></i> </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($ticket_categories->total() > $ticket_categories->perPage())
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="pull-right">
                                         {{ $ticket_categories->render() }}
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
        function Delete(category_id)
        {
            if(confirm('Do you want to Continue...?'))
            {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('ticket_category.delete') }}",
                    data: {
                            category_id: category_id
                          },
                    success: function(data)
                    {
                        window.location='{{ url("/ticket_category/create") }}';
                    },
                    error : function(date)
                    {
                        window.location='{{ url("/ticket_category/create") }}';
                    }
                });
            }
        }
    </script>
@endsection
