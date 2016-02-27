<div id="header" class="row m-t-30 m-b-30 separator">
    <div id="brand-logo" class="col-lg-2">
        <img src="{{ URL::asset('img/logo_codepi.png') }}" alt="{{ trans('website.brand_logo_alt') }}">
    </div>

    <div id="brand" class="col-lg-2 m-l-30">
        <h1 class="text-center">{{ strtoupper(trans('website.company')) }}</h1>
    </div>

    @if (Request::is('admin/*'))
        <div id="back-to-home" class="pull-right m-t-10">
            <a href="{{ route('index') }}">
                <i class="fa fa-home fa-1-5"></i> {{ trans('website.back_to_home') }}
            </a>
        </div>
    @endif
</div>