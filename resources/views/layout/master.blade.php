<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ trans('website.title') }}</title>
        {!! Html::style(URL::asset('assets/bootstrap/dist/css/bootstrap.min.css')) !!}
        {!! Html::style(URL::asset('assets/font-awesome/css/font-awesome.min.css')) !!}
        {!! Html::style(URL::asset('css/base.css')) !!}
        @yield('css')
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            @include('layout.header')
            @yield('content')
        </div>

        {!! Html::script(URL::asset('assets/jquery/dist/jquery.min.js')) !!}
        {!! Html::script(URL::asset('assets/bootstrap/dist/js/bootstrap.min.js')) !!}
        @yield('js')
    </body>
</html>