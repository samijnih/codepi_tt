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
            <div class="form-group">
                {!! Form::label('artist', trans('admin/show.label_artist'), ['class' => 'control-label col-lg-1']) !!}
                <div class="col-lg-11">
                    {!! Form::select('artist', $artists, ($show ? $show->artist->id : null), ['class' => 'form-control']) !!}
                </div>
            </div>

            <!-- Place -->
            <div class="form-group">
                {!! Form::label('place', trans('admin/show.label_place'), ['class' => 'control-label col-lg-1']) !!}
                <div class="col-lg-11">
                    {!! Form::select('place', $places, ($show ? $show->place : null), ['class' => 'form-control']) !!}
                </div>
            </div>

            <hr>

            @set($now, \Carbon\Carbon::now())

            <!-- Date -->
            <div class="form-group">
                {!! Form::label('date', trans('admin/show.label_date'), ['class' => 'control-label col-lg-1']) !!}
                <div class="col-lg-11">
                    {!! Form::date('date', ($show ? $show->date : $now), ['class' => 'form-control', 'required']) !!}
                </div>
            </div>

            <!-- Time -->
            <div class="form-group">
                {!! Form::label('time', trans('admin/show.label_time'), ['class' => 'control-label col-lg-1']) !!}
                <div class="col-lg-11">
                    {!! Form::time('time', ($show ? $show->time : $now->format('h:i')), ['class' => 'form-control', 'required']) !!}
                </div>
            </div>

            <hr>

            <!-- Price -->
            <div class="form-group">
                {!! Form::label('price', trans('admin/show.label_price'), ['class' => 'control-label col-lg-1']) !!}
                <div class="col-lg-11">
                    {!! Form::number('price', ($show ? $show->price : 0), ['class' => 'form-control', 'required', 'min' => 0]) !!}
                </div>
            </div>

            <hr>

            <div class="text-center">
                {!! Form::submit(trans('admin/show.button_store'), ['class' => 'btn btn-success m-r-30']) !!}
                <a href="{{ URL::previous() }}" class="btn btn-danger">{{ trans('admin/show.button_cancel') }}</a>
            </div>
        {!! Form::close() !!}
    </div>
@endsection