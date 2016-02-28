@extends('layout.master')

@section('css')
    {!! Html::style(URL::asset('css/admin.css')) !!}
@endsection

@section('content')
    <div class="row">
        <a href="{{ route('admin::show::create') }}" class="btn btn-success pull-right m-t-20">{{ trans('admin/show.index_new_show') }}</a>
        
        <h2>{{ trans('admin/show.index_h2') }}</h2>

        @if (session('message'))
            <div class="alert alert-success m-t-30 text-center">
                {{ session('message') }}
            </div>
        @endif

        <table class="table table-bordered table-striped m-t-30" id="show-collection">
            <thead>
                <th>{{ trans('admin/show.index_thead_artist') }}</th>
                <th>{{ trans('admin/show.index_thead_date') }}</th>
                <th>{{ trans('admin/show.index_thead_place') }}</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
            @forelse($shows as $show)
                <tr>
                    <td>{{ $show->artist->name }}</td>
                    <td>{{ \Carbon\Carbon::createFromFormat('d/m/Y', $show->date)->formatLocalized('%d/%m/%Y') }}</td>
                    <td>{{ $show->place }}</td>
                    <td>
                        <a href="{{ route('admin::show::show', [$show->id]) }}" class="update-show">{{ trans('admin/show.edit_show') }}</a>
                    </td>
                    <td>
                        {!! Form::open(['route' => ['admin::show::destroy', $show->id], 'method' => 'DELETE']) !!}
                            {!! Form::submit(trans('admin/show.destroy_show'), ['class' => 'delete-show']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @empty
                <tr>
                    <td>{{ trans('admin/show.index_no_show') }}</td>
                </tr>
            @endforelse
        </table>

        <div class="text-center">
            @include('pagination.admin.default', ['paginator' => $shows])
        </div>
    </div>
@endsection