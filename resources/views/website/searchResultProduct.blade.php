@extends('website.layout')
@section('title', 'Project-Details')
@section('co', 'current')
@section('content')
    @php
        use Illuminate\Support\Facades\DB;
            $rows = DB::table('company_info')->first();
            $services = DB::table('services')->get();
    @endphp
    @if($projects)
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
                                                    <li><a href="{{url('project-artwork?id='.$project->id)}}" class="image-link"><span class="icon fa fa-link"></span></a></li>
                                                    <li><a href="{{'public/images/'.$project->c_image}}" data-fancybox="images" data-caption="" class="link"><span class="icon flaticon-picture-gallery"></span></a></li>
                                                </ul>
                                                <div class="content">
                                                    <h3><a href="{{url('project-artwork?id='.$project->id)}}">{{$project->name}}</a></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </figure>
                                </div>
                            </div>
                        @endforeach
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
