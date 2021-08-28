@extends('website.layout')
@section('title', 'Project-Details')
@section('pd', 'current')
@section('content')
    @php
        use Illuminate\Support\Facades\DB;
            $rows = DB::table('company_info')->first();
    @endphp
    <section class="main-slider">
        <div class="rev_slider_wrapper fullwidthbanner-container"  id="rev_slider_one_wrapper" data-source="gallery">
            <div class="rev_slider fullwidthabanner" id="rev_slider_one" data-version="5.4.1">
                <ul>
                    @foreach($sliders as $slide)
                        <li data-description="Slide Description" data-easein="default" data-easeout="default" data-fsmasterspeed="1500" data-fsslotamount="7" data-fstransition="fade" data-hideafterloop="0" data-hideslideonmobile="off" data-index="rs-1687" data-masterspeed="default" data-param1="" data-param10="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-rotate="0" data-saveperformance="off" data-slotamount="default" data-thumb="{{url('public/images/'.$slide)}}" data-title="Slide Title" data-transition="parallaxvertical">
                            <img alt="" class="rev-slidebg" data-bgfit="cover" data-bgparallax="10" data-bgposition="center center" data-bgrepeat="no-repeat" data-no-retina="" src="{{url('public/images/'.$slide)}}">
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
    <section class="project-single-section">
        <div class="auto-container">
            <div class="inner-box">
                <div class="row clearfix">
                    <!--Info Column-->
                    <div class="info-column col-md-4 col-sm-12 col-xs-12">

                        <div class="sec-title">
                            <h2><span class="theme_color">Product</span> Information</h2>
                        </div>

                        <div class="text text-justify">{!! $projects->info !!}</div>

                        <div class="solution-box-two" style="background-image:url(images/background/patern-2.png)">
                            <div class="inner">
                                <div class="title">Quick Contact</div>
                                <h2>Get Solution</h2>
                                <div class="text">Contact us at the  office nearest to you or submit a business inquiry online.</div>
                                <a class="solution-btn theme-btn" href="{{url('contact')}}">Contact</a>
                            </div>
                        </div>

                    </div>
                    <!--Description Column-->
                    <div class="description-column col-md-8 col-sm-12 col-xs-12">
                        <div class="sec-title">
                            <h2><span class="theme_color">Product </span> Descripation</h2>
                        </div>
                        <div class="text text-justify">{!! $projects->description !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="related-projects-section" style="background-image:url(public/images/background/1.jpg)">
        <div class="auto-container">
            <div class="sec-title">
                <div class="title">Our Best Products</div>
                <h2><span class="theme_color">Related</span> Products</h2>
            </div>
            <div class="four-item-carousel owl-carousel owl-theme">
                @foreach($ap as $app)
                <div class="gallery-block-two">
                    <div class="inner-box">
                        <figure class="image-box">
                            <img src="{{'public/images/'.$app->cover_phote}}" alt="">
                            <!--Overlay Box-->
                            <div class="overlay-box">
                                <div class="overlay-inner">
                                    <div class="content">
                                        <ul class="clearfix">
                                            <li><a href="{{'project-details?id='.$app->p_id}}" class="image-link"><span class="icon fa fa-link"></span></a></li>
                                            <li><a href="{{'public/images/'.$app->cover_phote}}" data-fancybox="images" data-caption="" class="link"><span class="icon flaticon-picture-gallery"></span></a></li>
                                        </ul>
                                        <div class="content-text">
                                            <h3><a href="{{'project-details?id='.$app->p_id}}">{{$app->name}}</a></h3>
                                            <div class="category">{{$app->title.'/'.$app->sub_name}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </figure>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="call-to-action-section-two" style="background-image:url(public/images/background/7.jpg)">
        <div class="auto-container">
            <div class="row clearfix">

                <div class="column col-md-7 col-sm-12 col-xs-12">
                    <h2><span class="theme_color">{{$rows->name}}</h2>
                    <div class="text">If you have any work need, simply call our 24 hour emergency number.</div>
                </div>
                <div class="btn-column col-md-5 col-sm-12 col-xs-12">
                    <div class="number">{{$rows->phone}} <span class="theme_color"> or </span> <a href="{{url('contact')}}" class="theme-btn btn-style-five">Contact Us</a> </div>
                </div>

            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>

    </script>
@endsection
