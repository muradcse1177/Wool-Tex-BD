@extends('website.layout')
@section('title', 'Project-Details')
@section('co', 'current')
@section('content')
    @php
        use Illuminate\Support\Facades\DB;
            $rows = DB::table('company_info')->first();
            $services = DB::table('services')->get();
    @endphp


    <section class="contact-section">
        <div class="auto-container">
            <h2><span class="theme_color">Custom Order</span></h2>
           <div class="row clearfix">
                <div class="form-column col-lg-9 col-md-8 col-sm-12 col-xs-12">
                    <div class="inner-column">
                        <div class="contact-form">
                            {{ Form::open(array('url' => 'searchProduct', 'method' => 'get','enctype'=>'multipart/form-data')) }}
                            {{ csrf_field() }}
                            <div class="row clearfix">
                                <div class="row clearfix">
                                    <div class="form-group col-md-12 col-sm-12 co-xs-12">
                                        <select class="form-control select2 type_id" name="type_id" style="width: 100%;" required>
                                            <option value="" selected>Select Product Type</option>
                                            @foreach(@$types as $type)
                                                <option value="{{$type->id}}">{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 co-xs-12">
                                        <select class="form-control select2 cat_id" name="cat_id" style="width: 100%;" required>
                                            <option value="" selected>Select Product Category</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 co-xs-12">
                                        <select class="form-control select2 subcat_id" name="subcat_id" style="width: 100%;" required>
                                            <option value="" selected>Select Product</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 co-xs-12">
                                        <button type="submit" class="theme-btn btn-style-one">Search Product</button>
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
    @if(@$projects)
    <section class="project-section">
        <div class="auto-container">
            <div class="mixitup-gallery">
                <div class="filter-list row clearfix">
                    @foreach($projects as $project)
                        <div class="gallery-item mix all {{$project->name}} col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="inner-box">
                                <figure class="image-box">
                                    <img src="{{'public/images/'.$project->c_image}}" alt="">
                                    <!--Overlay Box-->
                                    <div class="overlay-box">
                                        <div class="overlay-inner">
                                            <ul>
                                                <li><a href="{{url('project-details?id='.$project->id)}}" class="image-link"><span class="icon fa fa-link"></span></a></li>
                                                <li><a href="{{'public/images/'.$project->c_image}}" data-fancybox="images" data-caption="" class="link"><span class="icon flaticon-picture-gallery"></span></a></li>
                                            </ul>
                                            <div class="content">
                                                <h3><a href="{{url('project-details?id='.$project->id)}}">{{$project->name}}</a></h3>
                                                <div class="category">{{$project->name.'/'.$project->name}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{$projects->links()}}
            </div>
        </div>
    </section>
    @endif
@endsection
@section('js')
    <script>
        $(".map-section").hide();
        $(".aaaa").hide();
        $(".type_id").change(function(){
            var id =$(this).val();
            $('.cat_id').find('option:not(:first)').remove();
            $.ajax({
                type: 'GET',
                url: 'getCategoryListAll',
                data: {id:id},
                dataType: 'json',
                success: function(response){
                    var data = response.data;
                    var len = data.length;
                    for( var i = 0; i<len; i++){
                        var id = data[i]['id'];
                        var name = data[i]['title'];
                        $(".cat_id").append("<option value='"+id+"'>"+name+"</option>");
                    }
                }
            });
        });
        $(".cat_id").change(function(){
            var id =$(this).val();
            $('.subcat_id').find('option:not(:first)').remove();
            $.ajax({
                type: 'GET',
                url: 'getSubCatIdListAll',
                data: {id:id},
                dataType: 'json',
                success: function(response){
                    var data = response.data;
                    var len = data.length;
                    for( var i = 0; i<len; i++){
                        var id = data[i]['id'];
                        var name = data[i]['sub_name'];
                        $(".subcat_id").append("<option value='"+id+"'>"+name+"</option>");
                    }
                }
            });
        });
    </script>
@endsection
