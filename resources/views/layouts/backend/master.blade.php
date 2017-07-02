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

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ elixir('assets/css/backend/pingala.css') }}">

    <link rel="shortcut icon" href="/_img/icons/favicon.ico">
    <link rel="apple-touch-icon" href="/_img/icons/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/_img/icons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/_img/icons/apple-touch-icon-114x114.png">

    {{--<script type="text/javascript" src="_inc/plugins/Chart.js"></script>--}}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="dark">

    @yield('content')

    <nav class="navbar navbar-inverse bg-inverse pingala-footer">
        <a class="" href="http://www.pingalamedia.co.uk" target="_blank"><i class="fa fa-copyright"></i> {{ date('Y') }} Pingala Media Limited</a>
    </nav>
    <script src="{{ elixir('assets/js/backend/all.js') }}"></script>

    @if (isset($extra_js))
        @foreach ($extra_js as $js_path)
            <script src="{{ $js_path }}"></script>
        @endforeach
    @endif

    <script type="text/javascript">
        $(document).ready(function(){
            $('.extra_content_img a').click(function(event){

                var position = event;
                var element = $(this);

                $.ajax({
                    type: 'GET',
                    cache: false,
                    url: '/admin/media/json/all',
                    success: function (data) {
                        render_all_media2(data, position.pageX, position.pageY, element);
                    },
                    error: function (xml, status, error) {
                        console.log(error);
                    },
                    always: function () {
                    }
                });
                return false;
            });
        });

    </script>

</body>
</html>