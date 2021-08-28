@extends('admin.layout')
@section('title', 'Product Management')
@section('page_header', 'Product Management')
@section('projects','active')
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
                        {{ Form::open(array('url' => 'insertProjects',  'method' => 'post','enctype'=> 'multipart/form-data')) }}
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
                                <label>Type</label>
                                <select class="form-control select2 type" name="type" style="width: 100%;" required>
                                    <option value="" selected>Select Type</option>
                                    <option value="new">New Arrival Product</option>
                                    <option value="popular">Popular Product</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Product Name</label>
                                <input type="text" class="form-control name" id="name" name="name" placeholder="Product Name" required>
                            </div>
                            <div class="form-group">
                                <label for="">Cover Photo (Must be W-370px * H-270px)</label>
                                <input type="file" class="form-control image" id="image" accept="image/*"  name="image" placeholder="Enter image" required>
                            </div>
                            <div class="form-group">
                                <label for="">Slider Photo (Must be W-1880px * H-750px)</label>
                                <input type="file" class="form-control slider" id="slider" accept="image/*"  name="slider[]" placeholder="Enter slider" required>
                            </div>
                            <div id="newRow">

                            </div>
                            <div class="form-group">
                                <a type="submit" class="btn btn-primary" id="addMore"><i class="fa-fa ion-plus"></i>আরও যোগ করুন</a>
                            </div>
                            <div class="form-group">
                                <label for="">Product Info</label>
                                <textarea class="textarea info" id="info" placeholder="Product Info" name="info"
                                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Product Description</label>
                                <textarea class="textarea description" id="description" placeholder="Product Description" name="description"
                                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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
                    <h3 class="box-title">Projects</h3>
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
                            <th>Type</th>
                        </tr>
                        @foreach($projects as $project)
                            <tr>
                                <td> <img src="{{'public/images/'.$project->cover_phote}}" height="50" width="50"> </td>
                                <td> {{$project->t_name}} </td>
                                <td> {{$project->title}} </td>
                                <td> {{$project->sub_name}} </td>
                                <td> {{$project->name}} </td>
                                <td> {{$project->type}} </td>
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
                                    {{ Form::open(array('url' => 'deleteProjectList',  'method' => 'post')) }}
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
        $("#addMore").click(function () {
            var html = '';
            html += '<div class="form-group" id="inputFormRow">';
            html += '<div class="input-group">';
            html += '<input class="form-control" type="file" accept="image/*"name="slider[]" required>';
            html += '<span class="input-group-btn">';
            html += '<a class="btn btn-danger" id="remove">Remove</a>';
            html += '</span>';
            html += '</div>';
            html += '</div>';

            $('#newRow').append(html);
        });
        $(document).on('click', '#remove', function () {
            $(this).closest('#inputFormRow').remove();
        });
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
                url: 'getProjectById',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                dataType: 'json',
                success: function(response){
                    var data = response.data;
                    $('.id').val(data.id);
                    $('.type').val(data.type);
                    $('.name').val(data.name);
                    $(".image").prop('required',false);
                    $(".slider").prop('required',false);
                    $('#description ~ iframe').contents().find('.wysihtml5-editor').html(data.description);
                    $('#info ~ iframe').contents().find('.wysihtml5-editor').html(data.info);
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
