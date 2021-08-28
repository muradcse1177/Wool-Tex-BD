@extends('admin.layout')
@section('title', 'Received Email')
@section('page_header', 'Received Email')
@section('receivedEmail','active')
@section('content')
    @if ($message = Session::get('successMessage'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Thank You!!</h4>
            {{ $message }}</b>
        </div>
    @endif
    @if ($message = Session::get('errorMessage'))

        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-warning"></i> Sorry!</h4>
            {{ $message }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Received Email</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name </th>
                            <th>Email </th>
                            <th>Phone </th>
                            <th>Subject </th>
                            <th>File </th>
                            <th>Message </th>
                        </tr>
                        @foreach($emails as $email)
                            <tr>
                                <td> {{$email->name}} </td>
                                <td> {{$email->email}} </td>
                                <td> {{$email->phone}} </td>
                                <td> {{$email->subject}} </td>
                                @if(!empty($email->file))
                                    <?php
                                        $files = json_decode($email->file);
                                        $files = explode(',',$files);
                                        array_pop($files);
                                        $i = 1;
                                    ?>
                                    <td>
                                        @foreach($files as $file)
                                            <a href="{{$file}}" target="_blank">Download File-{{$i.','}}</a>
                                            <?php
                                                $i++;
                                            ?>
                                        @endforeach
                                    </td>
                                @endif
                                <td> {{$email->msg}} </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection
