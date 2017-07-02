<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en-GB"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en-GB"> <!--<![endif]-->
<head>

    <meta charset="utf-8">

    <title>Reading</title>

    <meta name="description" content="">
    <meta name="author" content="Pingala Media Ltd">

    <meta name="google-site-verification" content="">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!--
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    -->

    <meta name="apple-mobile-web-app-title" content="Website Name">

    <link href="{{ elixir('assets/css/frontend/app.css') }}" rel="stylesheet" media="all" type="text/css">
    <link href="{{ asset('assets/css/frontend/style.css') }}" rel="stylesheet" media="all" type="text/css">

    <link rel="shortcut icon" href="{{ asset('/assets/img/frontend/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('/assets/img/frontend/apple-touch-icon.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/assets/img/frontend/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/assets/img/frontend/apple-touch-icon-114x114.png') }}">

</head>
<body class="">
<header class="site-header">
    <div class="container">
        <div class="row">

            <!-- Logo -->
            <div class="col-5 col-xs-9 col-sm-4 logo">
                <a href="/"><img src="{{ asset('assets/img/frontend/logo.png') }}" alt="Reading Logo" /></a>
            </div>

            <!-- Mobile nav toggle -->
            <div class="col-7 col-xs-3 nav-toggle">
                <div class="nav-icon float-right">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <!-- Phone -->
            <div class="col-xs-12 col-sm-8 promo">
                <h4>{{ $m_phone }}</h4>
                <h5>{{$m_top_heading}}</h5>
            </div>
        </div>
    </div>
    <nav class="site-navigation">
        <div class="container">
            {{--{!! $topnav_s  !!}--}}
        </div>
    </nav>
</header>

<div class="container">
    <div class="row ">
        <div class="col-xs-12">
            <h2>Sorry this page is not available</h2>
        </div>
    </div>
</div>

<footer class="site-footer">
    <div class="container">
        <div class="row">

            <!-- First block of links -->
            <div class="col-4 col-xs-12 col-sm-6 col-md-2">
                <ul>
                    <li><a href="#">Link 1</a></li>
                    <li><a href="#">Link 2</a></li>
                    <li><a href="#">Link 3</a></li>
                    <li><a href="#">Link 4</a></li>
                </ul>
            </div>

            <!-- Second block of Links -->
            <div class="col-4 col-xs-12 col-sm-6 col-md-2">
                <ul>
                    <li><a href="#">Link 1</a></li>
                    <li><a href="#">Link 2</a></li>
                    <li><a href="#">Link 3</a></li>
                    <li><a href="#">Link 4</a></li>
                </ul>
            </div>

            <!-- Company Info -->
            <div class="col-xs-12 col-sm-12 col-md-8 company-info">
                {{--{!! $footer_right !!}--}}
            </div>
        </div>
    </div>
</footer>

<script src="{{ elixir('assets/js/frontend/all.js') }}"></script>

</body>
</html>
