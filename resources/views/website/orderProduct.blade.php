@extends('website.layout')
@section('title', 'Project-Details')
@section('co', 'current')
@section('content')
    @php
        use Illuminate\Support\Facades\DB;
            $rows = DB::table('company_info')->first();
            $services = DB::table('services')->get();
    @endphp
    @if($product)
        <section class="project-section">
            <div class="auto-container">
                <img src="{{'public/images/'.$product->image}}"><br>
                <h4 style="color: #000000;"> Product Name : {{$product->name}}</h4>
                <h5 style="color: #000000;"> Pattern ID : {{$product->pattern}}</h5>
                @php
                    $colors = explode(',',json_decode($product->color));
                    $values = json_decode($product->art_value);
                @endphp
                <h5 style="color: #000000;">Available  Color:
                    @foreach($colors as $color)
                        <button class="btn btn-success">{{$color}}</button>
                    @endforeach
                </h5>
                <h5 style="color: #000000;"> Fabric Details : {!! $product->details !!}</h5>
            </div>
        </section>
        <section class="contact-section" style="margin-top: -190px;">
            <div class="auto-container">
                <h2><span class="theme_color">Order Products</span></h2>
                <div class="row clearfix">
                    <div class="form-column col-lg-9 col-md-8 col-sm-12 col-xs-12">
                        <div class="inner-column">
                            <div class="contact-form">
                                {{ Form::open(array('url' => 'insertNewOrder', 'method' => 'post','enctype'=>'multipart/form-data')) }}
                                {{ csrf_field() }}
                                <div class="row clearfix">
                                    <div class="row clearfix">
                                        @if(!Cookie::get('user_id'))
                                        <div class="form-group col-md-6 col-sm-12 co-xs-12">
                                            <label>Name</label>
                                            <input class="form-control" type="text" name="name" value="" placeholder="Name" required>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12 co-xs-12">
                                            <label>Email</label>
                                            <input class="form-control" type="email" name="email" value="" placeholder="Email" required>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12 co-xs-12">
                                            <label>Phone</label>
                                            <input class="form-control" type="text" name="phone" value="" placeholder="Phone" required>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12 co-xs-12">
                                            <label>Password</label>
                                            <input class="form-control" type="text" name="password" value="" placeholder="Password" required>
                                        </div>
                                        @endif
                                        <div class="form-group col-md-12 col-sm-12 co-xs-12">
                                            <label>Address</label>
                                            <input class="form-control" type="text" name="address" value="" placeholder="Address" required>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12 co-xs-12">
                                            <label>Gender</label>
                                            <select class="form-control select2 gender" name="gender" style="width: 100%;" required>
                                                <option value="" selected>Select Gender</option>
                                                <option value="Male"> Male</option>
                                                <option value="Female"> Female</option>
                                                <option value="Others"> Others</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12 co-xs-12">
                                            <label>Available Color</label>
                                            <select class="form-control select2 a_color" name="a_color" style="width: 100%;">
                                                <option value="" selected>Select Available Color</option>
                                                @foreach($colors as $color)
                                                    <option value="{{$color}}">{{$color}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 co-xs-12">
                                            <label>Desired Color</label>
                                            <input class="form-control" type="color" name="d_color" value="#123" placeholder="Desired Color">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12 co-xs-12">
                                            <label>Quantity</label>
                                            <input class="form-control" type="number" name="quantity" value="" placeholder="Quantity" required>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12 co-xs-12">
                                            <label>Unit</label>
                                            <select class="form-control select2 unit" name="unit" style="width: 100%;" required>
                                                <option value="" selected>Select Unit</option>
                                                <option value="CM"> CM</option>
                                                <option value="Inch"> Inch</option>
                                            </select>
                                        </div>
                                        @foreach($values as $value)
                                            <div class="form-group col-md-6 col-sm-12 co-xs-12">
                                                <input class="form-control" type="number" name="art_value[]" value="" placeholder="{{$value." "}} In Value" required>
                                            </div>
                                        @endforeach
                                        <div class="form-group col-md-12 col-sm-12 co-xs-12">
                                            <input type="hidden" name="id" value="{{$_GET['id']}}">
                                            <button type="submit" class="theme-btn btn-style-one">Order Product</button>
                                        </div>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
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
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
@section('js')
    <script>
        $(".map-section").hide();
        $(".aaaa").hide();
    </script>
@endsection
