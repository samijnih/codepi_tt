@extends('layout.master')

@section('css')
    {!! Html::style(URL::asset('css/admin.css')) !!}
@endsection

@section('content')
    <div class="row">
        <h2>{{ trans('index.h2') }}</h2>

        @if ($errors->count())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row m-t-20" id="filters-container">
            <div id="search-container">
                <div class="row">
                    <span id="submit-filters">
                        <i class="fa fa-search fa-2"></i>
                    </span>
                </div>
                <div class="row m-t-5">
                    <span id="search-label" class="col-lg-12 text-center">{{ trans('index.submit_filters') }}</span>
                </div>
            </div>

            <div class="col-lg-2">
                {!! Form::select('city', $cities, Request::input('city') , ['class'  => 'form-control']) !!}
            </div>

            <div class="col-lg-2">
                {!! Form::select('tags', $tags, Request::input('tags'), ['class'    => 'form-control']) !!}
            </div>

            <div class="col-lg-1">
                {!! Form::select('price', $prices, Request::input('price'), ['class' => 'form-control']) !!}
            </div>

            <div>
                {!! Form::label('date_start', trans('index.label_date_between'), ['class' => 'control-label pull-left middle']) !!}
                <div class="col-lg-2">
                    {!! Form::select('date_start', $dates, Request::input('date_start'), ['class' => 'form-control']) !!}
                </div>
            </div>

            <div>
                {!! Form::label('date_end', trans('index.label_date_and'), ['class' => 'control-label pull-left middle']) !!}
                <div class="col-lg-2">
                    {!! Form::select('date_end', $dates, Request::input('date_end'), ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="shows">
        @include('layout.show')
    </div>
@endsection

@section('script')
    {!! Html::script(URL::asset('js/index.js')) !!}
@endsection

@section('js')
    $("#submit-filters").click(function () {
        Show.ajax()
    });
@endsection