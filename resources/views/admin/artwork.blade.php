@extends('admin.layout')
@section('title', 'Artwork Management')
@section('page_header', 'Artwork Management')
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
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                    <h3 class="box-title addbut"><button type="button" class="btn btn-block btn-success btn-flat"><i class="fa fa-plus-square"></i> Add New </button></h3>
                    <h3 class="box-title rembut" style="display:none;"><button type="button" class="btn btn-block btn-success btn-flat"><i class="fa fa-minus-square"></i> Remove </button></h3>
                    <div class="divform" style="display:none">
                        {{ Form::open(array('url' => 'insertArtWork',  'method' => 'post','enctype'=> 'multipart/form-data')) }}
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label> Type</label>
                                <select class="form-control select2 type_id" name="type_id" style="width: 100%;" required>
                                    <option value="" selected>Select Type</option>
                                    @foreach($types as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label> Category</label>
                                <select class="form-control select2 cat_id" name="cat_id" style="width: 100%;" required>
                                    <option value="" selected>Select Category</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Sub Category</label>
                                <select class="form-control select2 subcat_id" name="subcat_id" style="width: 100%;" required>
                                    <option value="" selected>Select Sub Category</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Product Pattern Id</label>
                                <input type="text" class="form-control pattern" id="pattern" name="pattern" placeholder="Product Pattern Id" required>
                            </div>
                            <div class="form-group">
                                <label for="">Product Name</label>
                                <input type="text" class="form-control name" id="name" name="name" placeholder="Product Name" required>
                            </div>
                            <div class="form-group">
                                <label for="">Product Art Work Cover Photo(370*270)</label>
                                <input type="file" class="form-control c_image" id="c_image" accept="image/*"  name="c_image" placeholder="Enter image" required>
                            </div>
                            <div class="form-group">
                                <label for="">Product Art Work Main Photo</label>
                                <input type="file" class="form-control image" id="image" accept="image/*"  name="image" placeholder="Enter image" required>
                            </div>
                            <div class="form-group">
                                <label for="">Product Available Color</label>
                                <input type="text" class="form-control color" id="color" name="color" placeholder="Enter Color(with comma)" required>
                            </div>
                            <div class="form-group">
                                <label for="">Product Art Work Value</label>
                            </div>
                            <div class="form-group">
                                @for($i=65;$i<91;$i++)
                                    <input class="form-check-input" type="checkbox" name="art_value[]" value="{{strtoupper(chr($i))}}" id="{{strtoupper(chr($i))}}">
                                    <label class="form-check-label" for="{{strtoupper(chr($i))}}">{{strtoupper(chr($i))}}&nbsp;&nbsp;</label>
                                @endfor
                            </div>
                            <div class="form-group">
                                <label for="">Fabric Details</label>
                                <textarea class="textarea details" id="details" placeholder="Fabric Details" name="details" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="id" id="id" class="id">
                            <button type="submit" class="btn btn-success btn-flat">Save Info</button>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Products</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Cover Photo </th>
                            <th>Mother Type </th>
                            <th>Category </th>
                            <th>Sub Category </th>
                            <th>Name </th>
                            <th>Pattern Id </th>
                        </tr>
                        @foreach($projects as $project)
                            <tr>
                                <td> <img src="{{'public/images/'.$project->c_image}}" height="50" width="50"> </td>
                                <td> {{$project->t_name}} </td>
                                <td> {{$project->title}} </td>
                                <td> {{$project->sub_name}} </td>
                                <td> {{$project->p_name}} </td>
                                <td> {{$project->pattern}} </td>
                                <td class="td-actions text-center">
                                    <button type="button" rel="tooltip" class="btn btn-success edit" data-id="{{$project->p_id}}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" rel="tooltip" class="btn btn-danger delete" data-id="{{$project->p_id}}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{$projects->links()}}
                    <div class="modal modal-danger fade" id="modal-danger">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">মুছে ফেলতে চান</h4>
                                </div>
                                <div class="modal-body">
                                    <center><p>মুছে ফেলতে চান?</p></center>
                                </div>
                                <div class="modal-footer">
                                    {{ Form::open(array('url' => 'deleteArtworkList',  'method' => 'post')) }}
                                    {{ csrf_field() }}
                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">না</button>
                                    <button type="submit" class="btn btn-outline">হ্যা</button>
                                    <input type="hidden" name="id" id="id" class="id">
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
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
