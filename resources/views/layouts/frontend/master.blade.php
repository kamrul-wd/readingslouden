<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en-GB"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en-GB"> <!--<![endif]-->
<head>

    <meta charset="utf-8">

    <title>{{ $browser_title }}  Readings Louden</title>

    <meta name="description" content="{{ $meta_description }}">
    <meta name="author" content="Pingala Media Ltd">

    <meta name="google-site-verification" content="{{ $wmt_id }}">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!--
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    -->

    <meta name="apple-mobile-web-app-title" content="Website Name">

    <link href="{{ elixir('assets/css/frontend/app.css') }}" rel="stylesheet" media="all" type="text/css">
    <link href="{{ asset('assets/css/frontend/style.css') }}" rel="stylesheet" media="all" type="text/css">

    <link rel="shortcut icon" href="{{ asset('/assets/img/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('/assets/favicon_32.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/assets/img/favicon_72.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/assets/img/favicon_114.png') }}">

</head>
<body class="{{ $body_class }}">

<!-- Site Header -->
<header class="site-header">

    <!-- Logo, Email, Phone and Mobile Controls -->
    <div class="header-container container">
        <div class="row">

            <!-- Logo - All Breakpoints -->
            <div class="col-8 col-sm-10 col-md-7">
                <a href="/"><img src="{{ asset('assets/img/frontend/logo.png') }}" class="img-fluid" alt="Readings Louden Logo"></a>
            </div>

            <!-- Phone Icon, mobile only -->
            <div class="col-2 col-sm-1 hidden-md-up">
                <div class="phone">
                    <a href="{{ $m_phone }}">
                        <svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="#384348" fill-rule="evenodd">
                                <g id="icon-shape">
                                    <path d="M11.1735916,16.8264084 C7.57463481,15.3079672 4.69203285,12.4253652 3.17359164,8.82640836 L5.29408795,6.70591205 C5.68612671,6.31387329 6,5.55641359 6,5.00922203 L6,0.990777969 C6,0.45097518 5.55237094,3.33066907e-16 5.00019251,3.33066907e-16 L1.65110039,3.33066907e-16 L1.00214643,8.96910337e-16 C0.448676237,1.13735153e-15 -1.05725384e-09,0.445916468 -7.33736e-10,1.00108627 C-7.33736e-10,1.00108627 -3.44283713e-14,1.97634814 -3.44283713e-14,3 C-3.44283713e-14,12.3888407 7.61115925,20 17,20 C18.0236519,20 18.9989137,20 18.9989137,20 C19.5517984,20 20,19.5565264 20,18.9978536 L20,18.3488996 L20,14.9998075 C20,14.4476291 19.5490248,14 19.009222,14 L14.990778,14 C14.4435864,14 13.6861267,14.3138733 13.2940879,14.7059121 L11.1735916,16.8264084 Z" id="Combined-Shape"></path>
                                </g>
                            </g>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Nav Toggle - mobile only -->
            <div class="col-2 col-sm-1 hidden-md-up">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="#384348" fill-rule="evenodd">
                            <g id="icon-shape">
                                <path d="M0,3 L20,3 L20,5 L0,5 L0,3 Z M0,9 L20,9 L20,11 L0,11 L0,9 Z M0,15 L20,15 L20,17 L0,17 L0,15 Z" id="Combined-Shape"></path>
                            </g>
                        </g>
                    </svg>
                </button>
            </div>

            <!-- Phone and email - small desktop (md) up -->
            <div class="col-5 hidden-sm-down">
                <h4 class="tel">{{ $m_phone }}</h4>
                <h5 class="email">{{$m_top_heading}}</h5>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-toggleable-sm navbar-lightcontainer">
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            {!! $topnav  !!}
        </div>
    </nav>
</header>



    @yield($template)



<footer class="site-footer">
    <div class="container">
        <div class="row">

            <!-- First -->
            <div class="col-12 col-sm-4 col-md-3">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Navigation 1</a></li>
                    <li><a href="#">Navigation 2</a></li>
                    <li><a href="#">Navigation 3</a></li>
                </ul>
            </div>

            <!-- Second -->
            <div class="col-12 col-sm-4 col-md-3">
                <ul>
                    <li><a href="#">Contact Us</a>
                    <li><a href="#">Terms &amp; Conditions</a>
                    <li><a href="#">Privacy &amp; Cookies</a>
                    <li><a href="#">Text Only</a>
                </ul>
            </div>
        </div>
    </div>
</footer>

    <script src="{{ elixir('assets/js/frontend/all.js') }}"></script>

</body>
</html>
