@extends('admin.layout')
@section('title', 'Orders Management')
@section('page_header', 'Orders Management')
@section('artwork','active')
@section('extracss')
    <link rel="stylesheet" href="{{url('public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
@endsection
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
                    <h3 class="box-title">Orders</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Cover Photo </th>
                            <th>Name </th>
                            <th>Phone </th>
                            <th>Email </th>
                            <th>Products Name </th>
                            <th>Pattern Id </th>
                            <th>Available Color </th>
                            <th>Desired Color </th>
                            <th>Unit</th>
                            <th>Art Name </th>
                            <th>Art Value </th>
                        </tr>
                        @foreach($products as $product)
                            <tr>
                                <td> <img src="{{'public/images/'.$product->c_image}}" height="50" width="50"> </td>
                                <td> {{$product->a_name}} </td>
                                <td> {{$product->phone}} </td>
                                <td> {{$product->email}} </td>
                                <td> {{$product->name}} </td>
                                <td> {{$product->pattern}} </td>
                                <td> {{$product->a_color}} </td>
                                <td> @if($product->d_color=='#000000'){{' '}} @else <div style="background-color: {{$product->d_color}}; width: 120px; height: 35px;">{{'Code:'.$product->d_color}}</div> @endif </td>
                                <td> {{$product->unit}} </td>
                                <td>
                                    @foreach(json_decode($product->art_value) as $a)
                                        {{$a.','}}
                                    @endforeach
                                </td>
                                <td>
                                    @foreach(json_decode($product->a_value) as $a)
                                        {{$a.','}}
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{url('public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('.textarea').wysihtml5();
            $('.select2').select2();
            $(".addbut").click(function(){
                $(".divform").show();
                $(".rembut").show();
                $(".addbut").hide();
            });
            $(".rembut").click(function(){
                $(".divform").hide();
                $(".addbut").show();
                $(".rembut").hide();
            });

        });
        $(function(){
            $(document).on('click', '.edit', function(e){
                e.preventDefault();
                $('.divform').show();
                var id = $(this).data('id');
                getRow(id);
            });
            $(document).on('click', '.delete', function(e){
                e.preventDefault();
                $('#modal-danger').modal('show');
                var id = $(this).data('id');
                getRow(id);
            });
        });
        function getRow(id){
            $.ajax({
                type: 'POST',
                url: 'getArtworkById',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                dataType: 'json',
                success: function(response){
                    var data = response.data;
                    $('.id').val(data.id);
                    $('.pattern').val(data.pattern);
                    $('.name').val(data.name);
                    $('.color').val(data.color);
                    $(".image").prop('required',false);
                    $(".c_image").prop('required',false);
                    $('#details ~ iframe').contents().find('.wysihtml5-editor').html(data.details);
                    $('.select2').select2();
                }
            });
        }
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
