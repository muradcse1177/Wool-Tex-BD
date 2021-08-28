@extends('website.layout')
@section('title', 'All Projects')
@section('ap', 'current')
@section('content')
    @php
        use Illuminate\Support\Facades\DB;
            $rows = DB::table('company_info')->first();
    @endphp
    <section class="main-slider">
        <div class="rev_slider_wrapper fullwidthbanner-container"  id="rev_slider_one_wrapper" data-source="gallery">
            <div class="rev_slider fullwidthabanner" id="rev_slider_one" data-version="5.4.1">
                <ul>
                    @foreach($slides as $slide)
                        <li data-description="Slide Description" data-easein="default" data-easeout="default" data-fsmasterspeed="1500" data-fsslotamount="7" data-fstransition="fade" data-hideafterloop="0" data-hideslideonmobile="off" data-index="rs-1687" data-masterspeed="default" data-param1="" data-param10="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-rotate="0" data-saveperformance="off" data-slotamount="default" data-thumb="images/main-slider/image-1.jpg" data-title="Slide Title" data-transition="parallaxvertical">
                            <img alt="" class="rev-slidebg" data-bgfit="cover" data-bgparallax="10" data-bgposition="center center" data-bgrepeat="no-repeat" data-no-retina="" src="{{url('public/images/'.$slide->slide)}}">
                            <div class="tp-caption"
                                 data-paddingbottom="[0,0,0,0]"
                                 data-paddingleft="[0,0,0,0]"
                                 data-paddingright="[0,0,0,0]"
                                 data-paddingtop="[0,0,0,0]"
                                 data-responsive_offset="on"
                                 data-type="text"
                                 data-height="none"
                                 data-width="['720','720','650','450']"
                                 data-whitespace="normal"
                                 data-hoffset="['15','15','15','15']"
                                 data-voffset="['-100','-110','-70','-75']"
                                 data-x="['right','right','right','right']"
                                 data-y="['middle','middle','middle','middle']"
                                 data-textalign="['top','top','top','top']"
                                 data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="contact-number"><span class="icon flaticon-phone-call"></span>Call Us: +{{$rows->phone}}</div>
    </section>
    <section class="project-section">
        <div class="auto-container">
            <div class="sec-title centered">
                <h2><span class="theme_color">Our</span> All Products</h2>
            </div>

            <!--MixitUp Galery-->
            <div class="mixitup-gallery">

                <!--Filter-->
                <div class="filters clearfix">
                    <ul class="filter-tabs filter-btns clearfix">
                        <li class="active filter" data-role="button" data-filter="all">Show All</li>
                        @foreach($services as $service)
                            <li class="filter" data-role="button" data-filter="{{'.'.$service->title}}">{{$service->title}}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="filter-list row clearfix">
                    @foreach($projects as $project)
                        <div class="gallery-item mix all {{$project->title}} col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="inner-box">
                                <figure class="image-box">
                                    <img src="{{'public/images/'.$project->cover_phote}}" alt="">
                                    <!--Overlay Box-->
                                    <div class="overlay-box">
                                        <div class="overlay-inner">
                                            <ul>
                                                <li><a href="{{url('project-details?id='.$project->p_id)}}" class="image-link"><span class="icon fa fa-link"></span></a></li>
                                                <li><a href="{{'public/images/'.$project->cover_phote}}" data-fancybox="images" data-caption="" class="link"><span class="icon flaticon-picture-gallery"></span></a></li>
                                            </ul>
                                            <div class="content">
                                                <h3><a href="{{url('project-details?id='.$project->id)}}">{{$project->name}}</a></h3>
                                                <div class="category">{{$project->title.'/'.$project->sub_name}}</div>
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
@endsection
@section('js')
    <script>

    </script>
@endsection
