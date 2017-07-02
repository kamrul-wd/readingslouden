<!DOCTYPE html>
<!--[if lt IE 8]><html class="ie ie7" lang="en-GB"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en-GB"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en-GB"> <!--<![endif]-->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>{{ $title }} - Pingala CMS</title>

    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="Pingala Media Limited">

    <link rel="stylesheet" href="{{ elixir('assets/css/backend/pingala.css') }}">

    <link rel="shortcut icon" href="/_img/icons/favicon.ico">
    <link rel="apple-touch-icon" href="/_img/icons/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/_img/icons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/_img/icons/apple-touch-icon-114x114.png">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

    @yield('content')

    <script src="{{ elixir('assets/js/backend/all.js') }}"></script>
    @yield('footer-script')

</body>
</html>