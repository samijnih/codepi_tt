@if ($paginator->lastPage() > 1)
    <ul class="pagination @if (isset($class)){{ $class }}@endif">
        <li class="{{ ($paginator->currentPage() === 1) ? ' disabled' : '' }}">
            <a href="{{ $paginator->url(1) }}">{{ trans('pagination.previous') }}</a>
        </li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <li class="{{ ($paginator->currentPage() === $i) ? ' active' : '' }}">
                <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
            </li>
        @endfor
        <li class="{{ ($paginator->currentPage() === $paginator->lastPage()) ? ' disabled' : '' }}">
            <a href="{{ $paginator->url($paginator->lastPage()) }}">{{ trans('pagination.next') }}</a>
        </li>
    </ul>
@endif