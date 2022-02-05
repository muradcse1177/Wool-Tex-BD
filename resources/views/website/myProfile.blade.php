@extends('website.layout')
@section('title', 'Project-Details')
@section('mp', 'current')
@section('content')
    @php
        use Illuminate\Support\Facades\DB;
            $rows = DB::table('company_info')->first();
            $services = DB::table('services')->get();
    @endphp
    <section class="call-to-action-section-two">
        <div class="auto-container">
            <div class="sec-title centered">
                <h2><span class="theme_color">My</span> Orders </h2>
            </div>
            <div class="row">
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Pattern </th>
                                <th>Address</th>
                                <th>Available Color </th>
                                <th>Desired Color </th>
                                <th>Quantity</th>
                                <th>Unit</th>
                            </tr>
                            @foreach($products as $product)
                                <tr>
                                    <td> <img src="{{'public/images/'.$product->c_image}}" height="50" width="50"> </td>
                                    <td> {{$product->name}} </td>
                                    <td> {{$product->pattern}} </td>
                                    <td> {{$product->address}} </td>
                                    <td> {{$product->a_color}} </td>
                                    <td> @if($product->d_color=='#000000'){{' '}} @else{{$product->d_color}}@endif </td>
                                    <td> {{$product->quantity}} </td>
                                    <td> {{$product->unit}} </td>
                                </tr>
                            @endforeach
                        </table>
                        {{$products->links()}}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
    <script>
        $(".map-section").hide();
        $(".aaaa").hide();
    </script>
@endsection
