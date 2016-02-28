@extends('layout.master')

@section('css')
    {!! Html::style(URL::asset('css/admin.css')) !!}
@endsection

@section('content')
    <div class="row">
        <h2 class="m-b-30">{{ $h2 }}</h2>

        @if ($show)
            {!! Form::model($show, ['route' => ['admin::show::update', $show->id], 'method' => 'PATCH', 'class' => 'form-horizontal col-lg-9 col-lg-offset-2']) !!}
        @else
            {!! Form::open(['route' => 'admin::show::store', 'class' => 'form-horizontal col-lg-8 col-lg-offset-2']) !!}
        @endif
            <!-- Artist -->
            <div class="form-group @if ($errors->has('artist'))has-error @endif">
                {!! Form::label('artist', trans('admin/show.label_artist'), ['class' => 'control-label col-lg-1']) !!}
                <div class="col-lg-11">
                    {!! Form::select('artist', $artists, ($show ? $show->artist->id : null), ['class' => 'form-control']) !!}
                </div>
            </div>
            @if ($errors->has('artist'))
                <div class="alert alert-danger text-center" role="alert">
                    {{ $errors->first('artist') }}
                </div>
            @endif

            <!-- Place -->
            <div class="form-group @if ($errors->has('place'))has-error @endif">
                {!! Form::label('place', trans('admin/show.label_place'), ['class' => 'control-label col-lg-1']) !!}
                <div class="col-lg-11">
                    {!! Form::select('place', $places, ($show ? $show->place : null), ['class' => 'form-control']) !!}
                </div>
            </div>
            @if ($errors->has('place'))
                <div class="alert alert-danger text-center" role="alert">
                    {{ $errors->first('place') }}
                </div>
            @endif

            <hr>

            @set($now, \Carbon\Carbon::now())

            <!-- Date -->
            <div class="form-group @if ($errors->has('date'))has-error @endif">
                {!! Form::label('date', trans('admin/show.label_date'), ['class' => 'control-label col-lg-1']) !!}
                <div class="col-lg-11">
                    {!! Form::date('date', ($show ? $show->date : $now), ['class' => 'form-control', 'required']) !!}
                </div>
            </div>
            @if ($errors->has('date'))
                <div class="alert alert-danger text-center" role="alert">
                    {{ $errors->first('date') }}
                </div>
            @endif

            <!-- Time -->
            <div class="form-group @if ($errors->has('time'))has-error @endif">
                {!! Form::label('time', trans('admin/show.label_time'), ['class' => 'control-label col-lg-1']) !!}
                <div class="col-lg-11">
                    {!! Form::time('time', ($show ? $show->time : $now->format('h:i')), ['class' => 'form-control', 'required']) !!}
                </div>
            </div>
            @if ($errors->has('time'))
                <div class="alert alert-danger text-center" role="alert">
                    {{ $errors->first('time') }}
                </div>
            @endif

            <hr>

            <!-- Price -->
            <div class="form-group @if ($errors->has('price'))has-error @endif">
                {!! Form::label('price', trans('admin/show.label_price'), ['class' => 'control-label col-lg-1']) !!}
                <div class="col-lg-11">
                    {!! Form::number('price', ($show ? $show->price : 0), ['class' => 'form-control', 'required', 'min' => 0]) !!}
                </div>
            </div>
            @if ($errors->has('price'))
                <div class="alert alert-danger text-center" role="alert">
                    {{ $errors->first('price') }}
                </div>
            @endif

            <hr>

            <div class="text-center">
                {!! Form::submit(trans('admin/show.button_store'), ['class' => 'btn btn-success m-r-30']) !!}
                <a href="{{ URL::previous() }}" class="btn btn-danger">{{ trans('admin/show.button_cancel') }}</a>
            </div>
        {!! Form::close() !!}
    </div>
@endsection