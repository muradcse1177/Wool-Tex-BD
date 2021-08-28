<!DOCTYPE html>
<html>
@php
    use Illuminate\Support\Facades\DB;
        $rows = DB::table('company_info')->first();
        $services = DB::table('type')->orderBy('id','Asc')->get();
        $products = DB::table('projects')->take(6)->get();
@endphp
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <!-- Stylesheets -->
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link href="{{url('public/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{url('public/plugins/revolution/css/settings.css')}}" rel="stylesheet" type="text/css"><!-- REVOLUTION SETTINGS STYLES -->
    <link href="{{url('public/plugins/revolution/css/layers.css')}}" rel="stylesheet" type="text/css"><!-- REVOLUTION LAYERS STYLES -->
    <link href="{{url('public/plugins/revolution/css/navigation.css')}}" rel="stylesheet" type="text/css"><!-- REVOLUTION NAVIGATION STYLES -->
    <link href="{{url('public/css/style.css')}}" rel="stylesheet">
    <link href="{{url('public/css/responsive.css')}}" rel="stylesheet">

    <!--Color Switcher Mockup-->
    <link href="{{url('public/css/color-switcher-design.css')}}" rel="stylesheet">

    <!--Color Themes-->
    <link id="theme-color-file" href="{{url('public/css/color-themes/default-theme.css')}}" rel="stylesheet">

    <link rel="shortcut icon" href="{{$rows->photo}}" type="image/x-icon">
    <link rel="icon" href="{{$rows->photo}}" type="image/x-icon">

    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    @yield('css')
</head>

<body>

<div class="page-wrapper">

    <!-- Preloader -->
    <div class="preloader"></div>

    <!-- Main Header-->
    <header class="main-header">

        <!--Header Top-->
        <div class="header-top">
            <div class="auto-container">
                <div class="clearfix">
                    <!--Top Left-->
                    <div class="top-left pull-left">
                        <ul class="clearfix">
                            <li>Welcome to {{$rows->name}}</li>
                        </ul>
                    </div>
                    <!--Top Right-->
                    <div class="top-right pull-right">
                        <ul class="social-nav">
                            <li><a href="#" target="_blank"><span class="fa fa-facebook-f"></span></a></li>
                            <li><a href="#" target="_blank"><span class="fa fa-youtube-play"></span></a></li>
                            <li><a href="#" target="_blank"><span class="fa fa-instagram"></span></a></li>
                        </ul>
                        <ul class="list">
                            <li> Any question? {{$rows->phone}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!--Header-Upper-->
        <div class="header-upper">
            <div class="auto-container">
                <div class="clearfix">

                    <div class="pull-left logo-box">
                        <div class="logo"><a href="{{url('/')}}"><img src="{{$rows->photo}}" alt="" title="" height="180" width="170"></a></div>
                    </div>

                    <div class="pull-right upper-right clearfix">

                        <!--Info Box-->
                        <div class="upper-column info-box">
                            <div class="icon-box"><span class="flaticon-home-1"></span></div>
                            <ul>
                                <li><strong>Come To Meet With Us</strong></li>
                                <li>{{$rows->address}}</li>
                            </ul>
                        </div>

                        <!--Info Box-->
                        <div class="upper-column info-box">
                            <div class="icon-box"><span class="flaticon-note"></span></div>
                            <ul>
                                <li><strong>Send your mail at</strong></li>
                                <li>{{$rows->email}}</li>
                            </ul>
                        </div>

                        <!--Info Box-->
                        <div class="upper-column info-box">
                            <div class="icon-box"><span class="flaticon-clock-1"></span></div>
                            <ul>
                                <li><strong>Working Hours</strong></li>
                                <li>{{$rows->hours}}</li>
                            </ul>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!--End Header Upper-->

        <!--Header Lower-->
        <div class="header-lower">

            <div class="auto-container">
                <div class="nav-outer clearfix">
                    <!-- Main Menu -->
                    <nav class="main-menu">
                        <div class="navbar-header">
                            <!-- Toggle Button -->
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="navbar-collapse collapse clearfix">
                            <ul class="navigation clearfix">
                                <li class="@yield('hhh')"><a href="{{url('/')}}">Home</a></li>
                                <li class="@yield('abb')"><a href="{{url('/about')}}">About us</a></li>
                                <li class="dropdown @yield('as')"><a href="#">Products</a>
                                    <ul class="dropdown-menu-left">
                                        @foreach($services as $service)
                                        <li><a href="{{'product?id='.$service->id}}">{{$service->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="@yield('ap')"><a href="{{url('all-projects')}}">All Product</a></li>
                                <li class="@yield('cl')"><a href="{{url('client')}}">Our Client</a></li>
                                <li class="@yield('cu')"><a href="{{url('contact')}}">Contact us</a></li>
                                <li><a href="{{url('login')}}">Login</a></li>
                            </ul>
                        </div>
                    </nav>
                    <!-- Main Menu End-->
                    <div class="outer-box clearfix">
                        <div class="search-box-outer">
                            <div class="dropdown">
                                <button class="search-box-btn dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-search"></span></button>
                                <ul class="dropdown-menu pull-right search-panel" aria-labelledby="dropdownMenu3">
                                    <li class="panel-outer">
                                        <div class="form-container">
                                            <form method="" action="#">
                                                <div class="form-group">
                                                    <input type="search" name="field-name" value="" placeholder="Search Here" required>
                                                    <button type="submit" class="search-btn"><span class="fa fa-search"></span></button>
                                                </div>
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="advisor-box">
                            <a href="{{url('contact')}}" class="theme-btn advisor-btn">Find Advisor <span class="fa fa-long-arrow-right"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Header Lower-->

        <!--Sticky Header-->
        <div class="sticky-header">
            <div class="auto-container clearfix">
                <!--Logo-->
                <div class="logo pull-left">
                    <a href="{{url('/')}}" class="img-responsive"><img src="{{$rows->photo}}" alt="" title="" height="160" width="170"></a>
                </div>

                <!--Right Col-->
                <div class="right-col pull-right">
                    <!-- Main Menu -->
                    <nav class="main-menu">
                        <div class="navbar-header">
                            <!-- Toggle Button -->
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="navbar-collapse collapse clearfix">
                            <ul class="navigation clearfix">
                                <li class="@yield('hhh')"><a href="{{url('/')}}">Home</a></li>
                                <li class="@yield('abb')"><a href="{{url('/about')}}">About us</a></li>
                                <li class="dropdown @yield('as')"><a href="#">Products</a>
                                    <ul class="dropdown-menu-left">
                                        @foreach($services as $service)
                                            <li><a href="{{'product?id='.$service->id}}">{{$service->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="@yield('ap')"><a href="{{url('all-projects')}}">All Product</a></li>
                                <li class="@yield('cl')"><a href="{{url('client')}}">Our Client</a></li>
                                <li class="@yield('cu')"><a href="{{url('contact')}}">Contact us</a></li>
                                <li><a href="{{url('login')}}">Login</a></li>
                            </ul>
                        </div>
                    </nav><!-- Main Menu End-->
                </div>

            </div>
        </div>
        <!--End Sticky Header-->

    </header>
    <section>
        @yield('content')
    </section>
    <section class="map-section">
        <!--Map Outer-->
        <div class="map-section">
            <!--Map Outer-->
            <div class="map-outer">
                <!--Map Canvas-->
                <iframe
                    width="100%"
                    height="600"
                    style="border:0"
                    loading="lazy"
                    allowfullscreen
                    src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAOc0-5SE59M8qVpKbDKPPt7bda9xiOEaE
					&q=Wool Tex BD">
                </iframe>
            </div>
        </div>
    </section>
    <section class="contact-section">
        <div class="auto-container">
            <h2><span class="theme_color">Get</span> in Touch</h2>
            <div class="text">You can talk to our online representative at any time. Please use our Live Chat System on our website or Fill up below instant messaging programs. <br> Please be patient, We will get back to you. Our 24/7 Support, General Inquiries Phone: {{$rows->phone}}</div>
            <div class="row clearfix">
                <div class="form-column col-lg-9 col-md-8 col-sm-12 col-xs-12">
                    <div class="inner-column">
                        <div class="contact-form">
                            {{ Form::open(array('url' => 'send-mail',  'method' => 'post','enctype'=>'multipart/form-data')) }}
                            {{ csrf_field() }}
                            <div class="row clearfix">
                                <div class="row clearfix">
                                    <div class="form-group col-md-6 col-sm-6 co-xs-12">
                                        <input type="text" name="name" value="" placeholder="Name" required>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 co-xs-12">
                                        <input type="email" name="email" value="" placeholder="Email" required>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 co-xs-12">
                                        <input type="text" name="subject" value="" placeholder="Subject" required>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 co-xs-12">
                                        <input type="text" name="phone" value="" placeholder="Phone" required>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 co-xs-12">
                                        <input type="file" class="form-control file" id="file" accept=""  name="slider[]" placeholder="Enter File">
                                    </div>
                                    <div id="newRow">

                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 co-xs-12">
                                        <a  class="btn btn-primary" id="addMore"><i class="fa-fa ion-plus"></i>Add More</a>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 co-xs-12">
                                        <textarea name="message" placeholder="Your Massage"></textarea>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 co-xs-12">
                                        <button type="submit" class="theme-btn btn-style-one">Send Message</button>
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
                <div class="info-column col-lg-3 col-md-4 col-sm-12 col-xs-12">

                    <ul class="list-style-two">
                        <li><span class="icon flaticon-home-1"></span><strong>Address</strong>{{$rows->address}}</li>
                        <li><span class="icon flaticon-envelope-1"></span><strong>Send your mail at</strong>{{$rows->email}}</li>
                        <li><span class="icon flaticon-technology-2"></span><strong>Have Any Question</strong>{{$rows->phone}}</li>
                        <li><span class="icon flaticon-clock-1"></span><strong>Working Hours</strong>{{$rows->hours}}</li>
                    </ul>

                </div>
            </div>
        </div>
    </section>
    <footer class="main-footer" style="background-image:url(images/background/3.jpg)">
        <div class="auto-container">

            <!--Widgets Section-->
            <div class="widgets-section">
                <div class="row clearfix">

                    <!--big column-->
                    <div class="big-column col-lg-7 col-md-6 col-sm-12 col-xs-12">
                        <div class="row clearfix">

                            <!--Footer Column-->
                            <div class="footer-column col-md-7 col-sm-6 col-xs-12">
                                <div class="footer-widget logo-widget">
                                    <div class="logo">
                                        <a href="{{url('/')}}"><img src="{{$rows->photo}}" alt="" title="" height="180" width="180"/></a>
                                    </div>
                                    <div class="text text-justify">{{substr($rows->about,0,400).'...'}}</div>
                                    <ul class="social-icon-one">
                                        <li><a href="#" target="_blank"><span class="fa fa-facebook-f"></span></a></li>
                                        <li><a href="#" target="_blank"><span class="fa fa-youtube-play"></span></a></li>
                                        <li><a href="#" target="_blank"><span class="fa fa-instagram"></span></a></li>
                                    </ul>
                                </div>
                            </div>

                            <!--Footer Column-->
                            <div class="footer-column col-md-5 col-sm-6 col-xs-12">
                                <div class="footer-widget links-widget">
                                    <div class="footer-title">
                                        <h2>Services</h2>
                                    </div>
                                    <ul class="footer-lists">
                                        @foreach($services as $service)
                                            <li><a href="{{'product?id='.$service->id}}">{{$service->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!--big column-->
                    <div class="big-column col-lg-5 col-md-6 col-sm-12 col-xs-12">
                        <div class="row clearfix">

                            <!--Footer Column-->
                            <div class="footer-column col-md-5 col-sm-6 col-xs-12">
                                <div class="footer-widget links-widget">
                                    <div class="footer-title">
                                        <h2>Extra Links</h2>
                                    </div>
                                    <ul class="footer-lists">
                                        <li><a href="{{url('about')}}">About Us</a></li>
                                        <li><a href="{{url('all-projects')}}">Our Products</a></li>
                                        <li><a href="{{url('contact')}}">Request Quote</a></li>
                                        <li><a href="{{url('clients')}}">Our Clients</a></li>
                                    </ul>
                                </div>
                            </div>

                            <!--Footer Column-->
                            <div class="footer-column col-md-7 col-sm-6 col-xs-12">
                                <div class="footer-widget gallery-widget">
                                    <div class="footer-title">
                                        <h2>Best Products</h2>
                                    </div>
                                    <div class="widget-content">
                                        <div class="images-outer clearfix">
                                            <div class="images-outer clearfix">
                                                @foreach($products as $product)
                                                    <figure class="image-box">
                                                        <a href="{{url('public/images/'.$product->cover_phote)}}" class="lightbox-image" data-caption="" data-fancybox="images" title="Image Title Here" data-fancybox-group="footer-gallery"><span class="overlay-box flaticon-plus"></span></a>
                                                        <img src="{{url('public/images/'.$product->cover_phote)}}" alt="">
                                                    </figure>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!--Footer Bottom-->
        <div class="footer-bottom">
            <div class="auto-container">
                <div class="row clearfix">

                    <div class="column col-md-6 col-sm-12 col-xs-12">
                        <div class="copyright">Copyright © {{Date('Y')}} <a href="#">Wool Tex BD</a> All Right Reserved.  Developed by <a href="http://www.parallax-soft.com/" target="_blank">Parallax Soft Inc</a></div>
                    </div>
                    <div class="column col-md-6 col-sm-12 col-xs-12">
                        <ul class="footer-nav">
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="{{url('contact')}}">Contact Us</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </footer>
    <!--End Main Footer-->

</div>
<!--End pagewrapper-->

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="icon fa fa-angle-double-up"></span></div>

<!-- Color Palate / Color Switcher -->
<!-- /.End Of Color Palate -->

<script src="{{url('public/js/jquery.js')}}"></script>
<!--Revolution Slider-->
<script src="{{url('public/plugins/revolution/js/jquery.themepunch.revolution.min.js')}}"></script>
<script src="{{url('public/plugins/revolution/js/jquery.themepunch.tools.min.js')}}"></script>
<script src="{{url('public/plugins/revolution/js/extensions/revolution.extension.actions.min.js')}}"></script>
<script src="{{url('public/plugins/revolution/js/extensions/revolution.extension.carousel.min.js')}}"></script>
<script src="{{url('public/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
<script src="{{url('public/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
<script src="{{url('public/plugins/revolution/js/extensions/revolution.extension.migration.min.js')}}"></script>
<script src="{{url('public/plugins/revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>
<script src="{{url('public/plugins/revolution/js/extensions/revolution.extension.parallax.min.js')}}"></script>
<script src="{{url('public/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
<script src="{{url('public/plugins/revolution/js/extensions/revolution.extension.video.min.js')}}"></script>
<script src="{{url('public/js/main-slider-script.js')}}"></script>

<script src="{{url('public/js/bootstrap.min.js')}}"></script>
<script src="{{url('public/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{url('public/js/jquery.fancybox.js')}}"></script>
<script src="{{url('public/js/owl.js')}}"></script>
<script src="{{url('public/js/mixitup.js')}}"></script>
<script src="{{url('public/js/wow.js')}}"></script>
<script src="{{url('public/js/jquery-ui.js')}}"></script>
<script src="{{url('public/js/script.js')}}"></script>
<script src="{{url('public/js/validate.js')}}"></script>
<script src="{{url('public/js/appear.js')}}"></script>
<!--Google Map APi Key-->
<script src="http://maps.google.com/maps/api/js?key=AIzaSyAOc0-5SE59M8qVpKbDKPPt7bda9xiOEaE"></script>
<script src="{{url('public/js/map-script.js')}}"></script>

<script src="{{url('public/js/color-settings.js')}}"></script>
<script>
    $("#addMore").click(function () {
        var html = '';
        html += '<div class="form-group col-md-12 col-sm-12 co-xs-12" id="inputFormRow">';
        html += '<div class="input-group">';
        html += '<input class="form-control" type="file" accept=""name="slider[]">';
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
</script>
@yield('js')
</body>

</html>
