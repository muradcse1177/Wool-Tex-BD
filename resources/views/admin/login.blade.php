@extends('admin.loginLayout')
@section('title','Log In')
@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href=""><b style="color: darkgreen;">Wool Tex BD</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Log In </p>
        @if ($message = Session::get('errorMessage'))
            <center><p style="color: red">{{$message}} </p></center>
        @endif
        {{ Form::open(array('url' => 'verifyUser',  'method' => 'post')) }}
        {{ csrf_field() }}
            <div class="form-group has-feedback">
                <input type="email" class="form-control" name ="email" placeholder="Email"  required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control"  name="password" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <button type="submit" value="login"  name="login" class="btn btn-success btn-block btn-flat">Log In</button>
                </div>
            </div>
        {{ Form::close() }}

    </div>
</div>
@endsection

