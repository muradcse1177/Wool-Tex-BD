@extends('website.layout')
@section('title', 'Home')
@section('hhh', 'current')
@section('content')

    @php
        use Illuminate\Support\Facades\DB;
            $rows = DB::table('company_info')->first();
            $services = DB::table('services')->get();
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
        <div class="contact-number"><span class="icon flaticon-phone-call"></span>Call Us: {{$rows->phone}}</div>
    </section>
    <section class="call-to-action-section-two" style="background-image:url(public/images/background/7.jpg)">
        <div class="auto-container">
            <div class="row clearfix">

                <div class="column col-md-7 col-sm-12 col-xs-12">
                    <h2><span class="theme_color">{{$rows->name}}</h2>
                    <div class="text">If you want to order us for our products , Simply call our 24 hour emergency number.</div>
                </div>
                <div class="btn-column col-md-5 col-sm-12 col-xs-12">
                    <div class="number">{{$rows->phone}}<span class="theme_color"> or </span> <a href="{{url('contact')}}" class="theme-btn btn-style-five">Contact Us</a> </div>
                </div>

            </div>
        </div>
    </section>
    <section class="fluid-section-one">
        <div class="outer-container clearfix">
            <!--Image Column-->
            <div class="image-column" style="background-image:url(public/images/resource/choose.jpg);">
                <figure class="image-box"><img src="{{url('public/images/resource/choose.jpg')}}" alt=""></figure>
            </div>
            <!--Content Column-->
            <div class="content-column">
                <div class="inner-box">
                    <div class="sec-title">
                        <div class="title">We Offer Best Services & Solutions</div>
                        <h2><span class="theme_color">Why </span> Choose Us</h2>
                    </div>
                    <div class="text text-justify">{!!  nl2br($infos->choose) !!}</div>
                    <ul class="list-style-one clearfix">
                        <li class="col-md-6 col-sm-6 col-xs-12"><span class="icon flaticon-briefcase-1"></span>EXPERT & PROFESSIONAL</li>
                        <li class="col-md-6 col-sm-6 col-xs-12"><span class="icon flaticon-diamond-1"></span>PROFESSIONAL APPROACH</li>
                        <li class="col-md-6 col-sm-6 col-xs-12"><span class="icon flaticon-bank-building"></span>HIGH QUALITY WORK</li>
                        <li class="col-md-6 col-sm-6 col-xs-12"><span class="icon flaticon-two-fingers-up"></span>SATISFACTION GUARANTEE</li>
                        <li class="col-md-6 col-sm-6 col-xs-12"><span class="icon flaticon-brickwall"></span>PREVIOUS EXPERIENCE </li>
                        <li class="col-md-6 col-sm-6 col-xs-12"><span class="icon flaticon-user"></span>STRONG TEAM </li>
                        <li class="col-md-6 col-sm-6 col-xs-12"><span class="icon flaticon-timer"></span>TIMELY HANDOVER </li>
                        <li class="col-md-6 col-sm-6 col-xs-12"><span class="icon flaticon-time"></span>24/7 SERVICE </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="project-section">
        <div class="auto-container">
            <div class="sec-title centered">
                <h2><span class="theme_color">Our</span> Popular Products</h2>
            </div>

            <!--MixitUp Galery-->
            <div class="mixitup-gallery">

                <!--Filter-->
                <div class="filters clearfix">
                    <ul class="filter-tabs filter-btns clearfix">
                        <li class="active filter" data-role="button" data-filter="all">Show All</li>
                        @foreach($services_g as $service)
                            <li class="filter" data-role="button" data-filter="{{'.'.$service->title.'n'}}">{{$service->title}}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="filter-list row clearfix">
                    @foreach($projects_p as $projectp)
                    <div class="gallery-item mix all {{$projectp->title.'n'}} col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="inner-box">
                            <figure class="image-box">
                                <img src="{{'public/images/'.$projectp->cover_phote}}" alt="">
                                <!--Overlay Box-->
                                <div class="overlay-box">
                                    <div class="overlay-inner">
                                        <ul>
                                            <li><a href="{{url('project-details?id='.$projectp->p_id)}}" class="image-link"><span class="icon fa fa-link"></span></a></li>
                                            <li><a href="{{'public/images/'.$projectp->cover_phote}}" data-fancybox="images" data-caption="" class="link"><span class="icon flaticon-picture-gallery"></span></a></li>
                                        </ul>
                                        <div class="content">
                                            <h3><a href="{{url('project-details?id='.$projectp->p_id)}}">{{$projectp->name}}</a></h3>
                                            <div class="category">{{$projectp->title.'/'.$projectp->sub_name}}</div>
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
    <section class="call-to-action-section" style="background-image:url(public/images/background/2.jpg)">
        <div class="auto-container">
            <div class="row clearfix">
                <!--Text Column-->
                <div class="text-column col-md-9 col-sm-12 col-xs-12">
                    <div class="text">We provide experience & <span class="theme_color">high level</span> work solution for you!!</div>
                </div>
                <!--Btn Column-->
                <div class="btn-column col-md-3 col-sm-12 col-xs-12">
                    <a href="{{url('contact')}}" class="theme-btn btn-style-three">Start A Project</a>
                </div>
            </div>
        </div>
    </section>
    <section class="clients-section">
        <div class="auto-container">
            <div class="sec-title centered">
                <h2><span class="theme_color">Our</span> Valuable Clients</h2>
            </div>
            <div class="sponsors-outer">
                <ul class="sponsors-carousel owl-carousel owl-theme">
                    @foreach($clients as $client)
                        <li class="slide-item"><figure class="image-box"><a href="#"><img src="{{url('public/images/'.$client->photo)}}" height="150" width="150" alt=""></a></figure></li>
                    @endforeach
                </ul>
            </div>

        </div>
    </section>
@endsection
@section('js')
    <script>

    </script>
@endsection
