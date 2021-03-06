@if ($paginator->lastPage() > 1)
    <ul class="pagination @if (isset($class)){{ $class }}@endif">
        <li class="{{ ($paginator->currentPage() === 1) ? ' disabled' : '' }}">
            <span onclick="Show.ajax(1);">{{ trans('pagination.previous') }}</span>
        </li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <li class="{{ ($paginator->currentPage() === $i) ? ' active' : '' }}">
                <span onclick="Show.ajax({{ $i }});">{{ $i }}</span>
            </li>
        @endfor
        <li class="{{ ($paginator->currentPage() === $paginator->lastPage()) ? ' disabled' : '' }}">
            <span onclick="Show.ajax({{ $paginator->lastPage() }});">{{ trans('pagination.next') }}</span>
        </li>
    </ul>
@endif