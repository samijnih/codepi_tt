<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ trans('website.title') }}</title>
        {!! Html::style(URL::asset('assets/bootstrap/dist/css/bootstrap.min.css')) !!}
        {!! Html::style(URL::asset('assets/toastr/toastr.min.css')) !!}
        {!! Html::style(URL::asset('assets/font-awesome/css/font-awesome.min.css')) !!}
        {!! Html::style(URL::asset('css/base.css')) !!}
        @yield('css')
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="sk-cube-grid" id="loading">
            <div class="sk-cube sk-cube1"></div>
            <div class="sk-cube sk-cube2"></div>
            <div class="sk-cube sk-cube3"></div>
            <div class="sk-cube sk-cube4"></div>
            <div class="sk-cube sk-cube5"></div>
            <div class="sk-cube sk-cube6"></div>
            <div class="sk-cube sk-cube7"></div>
            <div class="sk-cube sk-cube8"></div>
            <div class="sk-cube sk-cube9"></div>
        </div>

        <div class="container">
            @include('layout.header')
            @yield('content')
        </div>

        {!! Html::script(URL::asset('assets/jquery/dist/jquery.min.js')) !!}
        {!! Html::script(URL::asset('assets/bootstrap/dist/js/bootstrap.min.js')) !!}
        {!! Html::script(URL::asset('assets/toastr/toastr.min.js')) !!}
        @yield('script')
        <script>
            $(document).ready(function () {
                var $loading = $("#loading").hide();

                $(document).ajaxStart(function () {
                    $loading.show();
                }).ajaxStop(function () {
                    $loading.hide();
                });

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': {!! json_encode(csrf_token()) !!},
                    }
                });

                @yield('js')
            });
        </script>
    </body>
</html>