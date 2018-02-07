@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row m-t-15">
                <div class="col-md-12">
                   <div class="panel panel-inverse">
                       <div class="panel-heading">Upload Files</div>
                       <div class="panel-body">
                            <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('contact/upload_excel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="file" name="import_file">
                                <button type="submit" class="btn btn-primary">Import File</button>
                            </form>
                       </div>
                   </div>
               </div>
           </div>
        </div>
    </div>
 @endsection
 
