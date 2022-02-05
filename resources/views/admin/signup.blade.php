@extends('admin.loginLayout')
@section('title','Sign Up')
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
            {{ Form::open(array('url' => 'insertCustomer',  'method' => 'post')) }}
            {{ csrf_field() }}
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name ="name" placeholder="Name"  required>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name ="phone" placeholder="Phone"  required>
                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
            </div>
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
                    <button type="submit" value="signup"  name="signup" class="btn btn-success btn-block btn-flat">Sign Up</button>
                </div>
            </div>
            {{ Form::close() }}

        </div>
    </div>
@endsection

