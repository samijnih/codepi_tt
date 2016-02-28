@forelse($shows as $show)

    <div class="col-lg-4 m-t-20 show">
        <div class="show-header">
            <h5>{{ $show->artist->name }} {{ trans('index.show_header_at') }} {{ $show->place }} {{ trans('index.show_header_separator') }} {{ $show->city }}</h5>
        </div>
        <div class="thumbnail" style="background-image: url({{ $show->artist->image }})">
        </div>
        <div class="show-info">
            <div class="pull-left col-lg-6 part-one">
                <span class="datetime col-lg-12 m-b-5">{{ $show->date }} {{ $show->time }}</span>
                <span class="tags col-lg-12">{{ $show->artist->tags }}</span>
            </div>

            <div class="pull-right col-lg-6 part-two">
                <span class="price col-lg-12 m-b-5">
                    {{ trans('index.show_price') }} <b>{{ $show->price }}</b>
                </span>
                <a href="{{ route('show', [$show->id]) }}" class="col-lg-12 link_to_show">{{ trans('index.link_to_show') }}</a>
            </div>
        </div>
    </div>
@empty
    <div class="col-lg-12 m-t-30 text-center">
        {{ trans('index.no_show') }}
    </div>
@endforelse

@if ($shows->count())
    <div class="text-center">
        @include('pagination.default', [
            'paginator'   => $shows,
            'class'       => 'm-t-30',
            'queryString' => $queryString,
            'ajax'        => true,
        ])
    </div>
@endif