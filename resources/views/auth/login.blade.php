@extends('layout.master')

@section('css')
    {!! Html::style(URL::asset('css/admin.css')) !!}
@endsection

@section('content')
    <div class="row">
        <h2>{{ trans('admin.login_h2') }}</h2>

        <div id="admin-login" class="m-t-30">
            {!! Form::open(['route' => 'admin::auth::login', 'id' => 'admin-login-form']) !!}
                <div class="form-group">
                    {!! Form::label('email', trans('admin.email_label'), ['class' => 'control-label pull-left m-l-30']) !!}
                    <div class="col-lg-4">
                        {!! Form::text('email', null, ['class' => 'form-control', 'autofocus']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('password', trans('admin.password_label'), ['class' => 'control-label pull-left m-l-30']) !!}
                    <div class="col-lg-4">
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
                </div>

                {!! Form::submit(trans('admin.login_button'), ['class' => 'btn btn-success m-l-30']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection