@extends('admin.layout')
@section('title', 'Company Info')
@section('page_header', 'Company Info')
@section('index','active')
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
                </div>
                <div class="divform" style="display:none">
                    {{ Form::open(array('url' => 'insertCompanyInfo',  'method' => 'post','enctype'=> 'multipart/form-data')) }}
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">Company Name</label>
                            <input type="text" class="form-control name" id="name"  name="name" placeholder="Enter Company Name" required>
                        </div>
                        <div class="form-group">
                            <label for="">Phone Number</label>
                            <input type="tel" class="form-control phone" id="phone"  name="phone" placeholder="Enter Phone Number" required>
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" class="form-control address" id="address"  name="address" placeholder="Enter Address" required>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control email" id="email"  name="email" placeholder="Enter Email" required>
                        </div>
                        <div class="form-group">
                            <label for="">Logo(Must be h-70px * w-240px)</label>
                            <input type="file" class="form-control logo" id="logo" accept="image/*"  name="logo" placeholder="Enter Email" required>
                        </div>
                        <div class="form-group">
                            <label for="">Working Hours</label>
                            <input type="text" class="form-control working" id="working"  name="working" placeholder="Enter Working Hours" required>
                        </div>
                        <div class="form-group">
                            <label for="">Why Choose Us</label>
                            <textarea  class="form-control choose" rows="4" id="choose"  name="choose" placeholder="Enter Why Choose Us" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">About Us</label>
                            <textarea  class="form-control about" rows="4" id="about"  name="about" placeholder="Enter About  Us" required></textarea>
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
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Company Info</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Logo </th>
                            <th>Name </th>
                            <th>Phone </th>
                            <th>Email </th>
                            <th>Address </th>
                        </tr>
                        @foreach($infos as $info)
                            <tr>
                                <td> <img src="{{$info->photo}}" height="40" width="40"> </td>
                                <td> {{$info->name}} </td>
                                <td> {{$info->phone}} </td>
                                <td> {{$info->email}} </td>
                                <td> {{$info->address}} </td>
                                <td class="td-actions text-center">
                                    <button type="button" rel="tooltip" class="btn btn-success edit" data-id="{{$info->id}}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
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
                                    {{ Form::open(array('url' => 'deleteTourBookingList',  'method' => 'post')) }}
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
    <script>
        $(document).ready(function(){
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
                url: 'getCompanyInfoById',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                dataType: 'json',
                success: function(response){
                    var data = response.data;
                    $('.name').val(data.name);
                    $('.phone').val(data.phone);
                    $('.address').val(data.address);
                    $('.email').val(data.email);
                    $('.working').val(data.hours);
                    $('.choose').val(data.choose);
                    $('.about').val(data.about);
                    $('.id').val(data.id);
                }
            });
        }
    </script>
@endsection
